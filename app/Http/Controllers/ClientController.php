<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Client\ClientRepositoryInterface;
use App\Services\Client;

class ClientController extends Controller
{
    private $_clientinterface;
    public function __construct(ClientRepositoryInterface $clientinterface)
    {
        $this->_clientinterface = $clientinterface;
    }

    //
    public function index(Request $request)
    {
        $response = $this->_clientinterface->getClients([]);
        if (!$response->success) {
            return view('client.list', ['clients' => [], 'generalerrors' => [$response->message]]);
        }

        return view('client.list', ['clients' => $response->data]);
    }

    public function view(Request $request, $clientId)
    {
        $client = $this->_clientinterface->getClient($clientId);
        if (!$client->success) {
            return redirect()->route('client.index')->withErrors(['general_errors' => $client->message]);
        }

        $relations = $this->_clientinterface->getRelations($clientId);

        return view('client.view', ['client' => $client->data, 'relations' => $relations->data]);
    }

    public function add(Request $request)
    {
        return view('client.add');
    }

    public function edit(Request $request, $clientId)
    {
        $client = $this->_clientinterface->getClient($clientId);

        if (!$client->success) {
            return redirect()->route('client.index')->withErrors(['general_errors' => $client->message]);
        }

        return view('client.edit', ['client' => $client->data]);
    }

    public function update(\App\Http\Requests\ClientUpdateRequest $request, $clientId)
    {
        $clientdata = $request->only(Client::getAllowedFields());
        $clientdata['id'] = $clientId;
        $client = $this->_clientinterface->updateClient($clientdata);

        if (!$client->success) {
            return redirect()->back()->withInput()->withErrors(['general_errors' => $client->message]);
        }

        return redirect()->route('client.view', $clientId)->with([
            'message' => $client->message, 'warning' => $client->warning,
        ]);
    }


    public function store(\App\Http\Requests\ClientCreateRequest $request)
    {
        $clientdata = $request->only(Client::getAllowedFields());
        $clientdata['created_from'] = config('constants.platform.web');
        $clientdata['created_by'] = config('constants.user.kind.admin');
        $response = $this->_clientinterface->storeClient($clientdata);
        if ($response->success) {
            return redirect()->route('client.index')->with([
                'message' => $response->message, 'warning' => $response->warning,
                'clientid' => $response->data['id']
            ]);
        }

        return redirect()->back()->withInput()->withErrors(['general_errors' => $response->message]);
    }

    public function setting() {
        return view('client.setting');
    }
}
