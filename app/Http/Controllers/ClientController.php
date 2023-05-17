<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        $this->authorize('clients.create');

        request()->validate([
            'user_id' => 'nullable',
            'corporate_name' => 'required',
            'cnpj'=> 'required|cnpj',
            'responsible_name' => 'required',
            'cell_phone' => 'required',
            'email' => 'required|email',
            'zip_code' => 'required',
            'address' => 'required',
            'number' => 'required',
            'complement' => 'required',
            'neighborhood' => 'required',
            'city'=> 'required',
            'state'=> 'required|uf',
        ]);

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
        $this->authorize('update', $client);
        $users = User::pluck('name', 'id');
        $userClient = $client->user->id;

        return view('clients.edit', compact('client',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        request()->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully');
    }

    public function getCnpj($cnpj)
    {
        $clientHttp = new ClientHttp([
            'verify' => false
        ]);

        //$cnpj = $request->all();
        //dd($cnpj);

        $url = 'https://www.receitaws.com.br/v1/cnpj/' . $cnpj;

        try {
            $response = $clientHttp->get($url);
            $body = $response->getBody();
            $dadosEmpresa = json_decode($body, true);

            // Faça o tratamento dos dados recebidos aqui

            return response()->json($dadosEmpresa);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro na consulta do CNPJ ' . $e->getMessage()], 500);
        }
    }
}
