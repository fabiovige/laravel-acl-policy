<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Client::class);

        $clients =  auth()->user()->hasRole('Admin') ? Client::All() : Client::where('user_id','=', auth()->id())->get();

        return view('clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Client::class);

        return view('clients.create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Client::class);

        request()->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $data = $request->all();
        $data['created_by'] = auth()->id();

        Client::create($data);

        return redirect()->route('clients.index')
                        ->with('success','Client created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $this->authorize('view', $client);

        return view('clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $this->authorize('update', $client);

        return view('clients.edit',compact('client'));
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
                        ->with('success','Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return redirect()->route('clients.index')
                        ->with('success','Client deleted successfully');
    }
}
