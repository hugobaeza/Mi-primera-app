<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Carga las publicaciones junto con el usuario que las creó
        $publications = Publication::with('user')->orderBy('created_at', 'desc')->get();

        return view('dashboard', compact('publications'));
    }

    public function store(Request $request)
    {
        // Valida el formulario
        $request->validate([
            'title' => 'required|max:30',
            'message' => 'required|max:256',
        ]);

        // Crea la publicación asociada al usuario autenticado
        Publication::create([
            'iduser_fk' => Auth::guard('webusers')->id(), // Asegúrate de usar el guard correcto
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return redirect()->route('dashboard')->with('success', 'Publicación creada correctamente.');
    }

    // Editar publicación
    public function edit($id)
    {
        $publication = Publication::findOrFail($id);

        if ($publication->iduser_fk !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta publicación');
        }

        return view('publication.edit', compact('publication'));
    }

    // Actualizar publicación
    public function update(Request $request, $id)
    {
        $publication = Publication::findOrFail($id);

        if ($publication->iduser_fk !== auth()->id()) {
            abort(403, 'No tienes permiso para actualizar esta publicación');
        }

        $request->validate([
            'title' => 'required|max:30',
            'message' => 'required|max:256',
        ]);

        $publication->update([
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return redirect()->route('dashboard')->with('success', 'Publicación actualizada');
    }

    // Eliminar publicación
    public function destroy($id)
    {
        $publication = Publication::findOrFail($id);

        if ($publication->iduser_fk !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar esta publicación');
        }

        $publication->delete();

        return redirect()->route('dashboard')->with('success', 'Publicación eliminada');
    }

}
