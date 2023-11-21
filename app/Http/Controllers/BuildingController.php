<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use App\Http\Resources\BuildingResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BuildingDetailResource;

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

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "building_code" => "required|string|max:255|unique:buildings,building_code",
            "name" => "required|string|max:255"
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $building = Building::create($data);
                // dd('test');
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Added Successfully',
                    'data' => new BuildingResource($building)
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 500,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }

    public function showBuildingWithClassrooms($id)
    {
        $building = Building::with('classroom')->findOrFail($id);
        return new BuildingDetailResource($building);
    }
}
