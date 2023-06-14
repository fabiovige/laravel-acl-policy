<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientFormRequest;
use App\Http\Requests\ClientStoreFormRequest;
use App\Http\Requests\ClientUpdateFormRequest;
use App\Models\Client;
use GuzzleHttp\Client as ClientHttp;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('clients.index');

        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('clients.roles');

        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientStoreFormRequest $request)
    {
        $this->authorize('clients.create');

        $data = $request->all();
        $data['user_id'] = auth()->id();

        Client::create($data);

        return redirect()->route('clients.index')->with('success', __('Client created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $this->authorize('view', $client);

        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $this->authorize('clients.edit');

        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientUpdateFormRequest $request, Client $client)
    {
        $this->authorize('clients.edit');

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', __('Client updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->authorize('clients.destroy');

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', __("Client removed successfully"));
    }

    public function getCnpj($cnpj)
    {
        $clientHttp = new ClientHttp([
            'verify' => false
        ]);

        $url = 'https://www.receitaws.com.br/v1/cnpj/' . $cnpj;

        try {
            $response = $clientHttp->get($url);
            $body = $response->getBody();
            $dadosEmpresa = json_decode($body, true);

            return response()->json($dadosEmpresa);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro na consulta do CNPJ ' . $e->getMessage()], 500);
        }
    }
}
