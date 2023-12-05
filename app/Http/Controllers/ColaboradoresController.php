<?php

namespace App\Http\Controllers;

use App\Models\colaboradores;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColaboradoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['colaboradores'] = colaboradores::paginate(5);
        return view('colaboradores.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("colaboradores.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datosColaboradores = $request->except("_token");

        try {
            Colaboradores::insert($datosColaboradores);
            // Insertar exitoso, mostrar la alerta
            return response()->json(['success' => true, 'message' => 'Datos insertados correctamente']);
        } catch (\Exception $e) {
            // Ocurrió un error durante la inserción
            return response()->json(['success' => false, 'message' => 'Error al insertar los datos']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(colaboradores $colaboradores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(colaboradores $colaboradores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, colaboradores $colaboradores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            colaboradores::destroy($id);
            return response()->json(['success' => true, 'message' => 'Se eliminó el colaborador']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar al colaborador']);
        }
    }
}
