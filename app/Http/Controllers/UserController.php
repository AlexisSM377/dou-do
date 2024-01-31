<?php

namespace App\Http\Controllers;

use App\Filters\Api\UserFilter;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //* Generamos una entidad de la clase UserFilter
        $filter = new UserFilter();
         //* Mandamos a llamar la función "build" para construir los arrays con: columna, operador, valor a buscar... en base a lo que se tenga en el $request
         //* Esto se guarda en un array en la variable $q
        $q = $filter->build($request);

        //* Aqui ya solo hacemos la consulta en base a el array que contiene los parametros de busqueda.
        //* EJ: Asi se veria internamente
        //* User::where('name', '=', 'Rafa');
        $users = User::where($q)->paginate(10);

        //* 1) Enviamos el objeto paginado de los usuarios, al UserResource insertando en la misma paginación, el $request->query, con esto hacemos que prevalescan los filtros...
        //* 2) El UserResource nos devuelve todo ya parseado a JSON, para poderlo servir via API
        return new UserResource($users->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
