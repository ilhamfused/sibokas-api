<?php

namespace App\Http\Controllers;

use App\Http\Resources\BuildingDetailResource;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        $buildings = Building::all();
        return BuildingResource::collection($buildings);
    }

    public function show($id)
    {
        $building = Building::findOrFail($id);
        return new BuildingDetailResource($building);
    }

    public function showBuildingWithClassrooms($id)
    {
        $building = Building::with('classroom')->findOrFail($id);
        return new BuildingDetailResource($building);
    }
}
