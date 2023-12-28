<?php

namespace App\Http\Controllers;

use App\Http\Resources\BuildingDetailResource;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BuildingController extends Controller
{
    public function index()
    {
        try {
            $buildings = Building::all();
            return response()->json([
                'status' => 200,
                'data' => BuildingResource::collection($buildings),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $building = Building::findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => new BuildingResource($building),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        // return $request->file('photo');
        $validate = Validator::make($request->all(), [
            // ['required', 'string', 'max:255', Rule::unique('buildings', 'building_code')->whereNull('deleted_at')]
            "building_code" => "required|string|max:255|unique:buildings,building_code",
            "name" => "required|string|max:255",
            "photo" => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors(),
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $uploadFolder = 'building-photo';
                $photo = $request->file('photo');
                $image_uploaded_path = $photo->store($uploadFolder, 'public');
                $data['photo'] = Storage::disk('public')->url($image_uploaded_path);
                $building = Building::create($data);
                return response()->json([
                    'status' => 201,
                    'message' => 'Data Added Successfully',
                    'data' => new BuildingResource($building),
                ], 201);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 500,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }

    public function update(Request $request, String $id)
    {
        // return $request->all();
        $validate = Validator::make($request->all(), [
            "building_code" => "required|string|max:255|unique:buildings,building_code,$id",
            "name" => "required|string|max:255",
            "photo" => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors(),
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $building = Building::findOrFail($id);
                // Update only if there is a change in the building_code or name
                $building->update([
                    'building_code' => $data['building_code'],
                    'name' => $data['name'],
                ]);
                // Update the photo if a new one is provided
                if ($request->hasFile('photo')) {
                    $uploadFolder = 'building-photo';
                    // Delete the old photo if it exists
                    if ($building->photo) {
                        $photoPath = basename($building->photo);
                        $storagePath = 'building-photo/' . $photoPath;
                        // Check if the file exists before attempting to delete
                        if (Storage::disk('public')->exists($storagePath)) {
                            // Delete the file from storage
                            Storage::disk('public')->delete($storagePath);
                        } else {
                            \Log::info('File does not exist: ' . $storagePath);
                        }
                    }
                    $photo = $request->file('photo');
                    $image_uploaded_path = $photo->store($uploadFolder, 'public');
                    $building->update(['photo' => Storage::disk('public')->url($image_uploaded_path)]);
                }
                return response()->json([
                    'status' => 201,
                    'message' => 'Data Updated Successfully',
                    'data' => new BuildingResource($building),
                ], 201);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 500,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }

    public function destroy(String $id)
    {
        try {
            $building = Building::findOrFail($id);
            // Delete the photo if it exists
            if ($building->photo) {
                $photoPath = basename($building->photo);
                $storagePath = 'building-photo/' . $photoPath;
                // Check if the file exists before attempting to delete
                if (Storage::disk('public')->exists($storagePath)) {
                    // Delete the file from storage
                    Storage::disk('public')->delete($storagePath);
                } else {
                    \Log::info('File does not exist: ' . $storagePath);
                }
            }
            $building->delete();
            return response()->json([
                'status' => 201,
                'message' => 'Data Deleted Successfully',
                'data' => new BuildingResource($building),
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    public function showBuildingWithClassrooms($id)
    {
        try {
            // Langkah 1: Mengecek semester terakhir yang masih berjalan
            $latestSemester = Semester::latest('end_date')->first();
            if (!$latestSemester || $latestSemester->end_date < Carbon::now()->toDateString()) {
                // Jika tidak ada semester terakhir atau semester terakhir sudah berakhir
                return response()->json(['status' => 'error', 'message' => 'Tidak ada semester yang berjalan saat ini.']);
            }
            // Langkah 2: Mengecek apakah hari ini adalah hari Senin - Jumat
            $currentDayOfWeek = Carbon::now()->dayOfWeek;
            if ($currentDayOfWeek < 1 || $currentDayOfWeek > 5) {
                // Jika hari ini bukan hari Senin - Jumat
                return response()->json(['status' => 'error', 'message' => 'Hari ini bukan hari Senin - Jumat.']);
            }
            // Langkah 3: Jika lolos kedua pengecekan di atas, maka eksekusi query untuk memuat Classroom
            $building = Building::with('classroom')->findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => new BuildingDetailResource($building),
                // 'latestSemester' => $latestSemester,
                // 'currentDayOfWeek' => $currentDayOfWeek
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    public function building()
    {
        return view('building');
    }
}
