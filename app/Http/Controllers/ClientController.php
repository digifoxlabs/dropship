<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\cruds\StoreClientRequest;
use App\Http\Requests\cruds\UpdateClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cruds.clients.index', [
            'clients' => Client::paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cruds.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'phone' => $request->phone,
            'alternate_phone' => $request->alternate_phone,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('client');
        $user->client()->create();

        return redirect()->route('clients.index')->with('message', 'Client: ' . $user->name . ' created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('cruds.clients.show', [
            'client' => $client,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('cruds.clients.edit', [
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->user->update($request->validated());
        return redirect()->route('clients.index')->with('message', 'Client: ' . $client->user->name . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
