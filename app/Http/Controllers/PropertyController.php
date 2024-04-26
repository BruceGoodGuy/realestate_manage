<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Property\PropertyRepositoryInterface;

class PropertyController extends Controller
{
    //

    private $_propertyinterface;
    public function __construct(PropertyRepositoryInterface $propertyinterface)
    {
        $this->_propertyinterface = $propertyinterface;
    }
    public function add()
    {
        return view('property.add');
    }

    public function store(\App\Http\Requests\PropertyRequest $request)
    {
        $propertydata = $request->only([
            'name',
            'note',
            'price',
            'address',
            'content',
            'active',
            'province_value',
            'district_value',
            'avatar',
            'avatar_name',
            'ward_value',
        ]);

        $response = $this->_propertyinterface->storeProperty($propertydata);

        if ($response->success) {
            return redirect()->route('property.index')->with([
                'message' => $response->message, 'warning' => $response->warning,
                'pid' => $response->data['id']
            ]);
        }

        return redirect()->back()->withInput()->withErrors(['general_errors' => $response->message]);
    }

    public function index()
    {
        $response = $this->_propertyinterface->getProperties([]);
        if (!$response->success) {
            return view('property.list', ['properties' => [], 'generalerrors' => [$response->message]]);
        }

        return view('property.list', ['properties' => $response->data]);
    }
}
