<?php
namespace App\Http\Controllers\Api;

use App\Property;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return Property::all();
    }

    public function show(Property $property)
    {
        return $property;
    }

    public function store(Request $request)
    {
        $property = Property::create($request->all());

        return response()->json($property, 201);
    }

    public function update(Request $request, Property $property)
    {
        $property->update($request->all());

        return response()->json($property, 200);
    }

    public function delete(Property $property)
    {
        $property->delete();

        return response()->json(null, 204);
    }
}