<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ClassroomResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ClassroomDetailResource;

class ClassroomController extends Controller
{
    public function index()
    {
        try {
            $classrooms = Classroom::all();
            return response()->json([
                'status' => 200,
                'data' => ClassroomResource::collection($classrooms->loadMissing(['picRoom:id,name', 'building:id,building_code,name']))
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(), [
            "name" => "required|string|max:255|unique:classrooms,name",
            "name_alias" => "nullable|string|max:255",
            "photo" => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "pic_room_id" => "required|integer|exists:pic_rooms,id",
            "building_id" => "required|integer|exists:buildings,id",
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $uploadFolder = 'classroom-photo';
                $photo = $request->file('photo');
                $image_uploaded_path = $photo->store($uploadFolder, 'public');
                $data['photo'] = Storage::disk('public')->url($image_uploaded_path);
                $classroom = classroom::create($data);
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Added Successfully',
                    'data' => new classroomResource($classroom)
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 500,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $classroom = Classroom::with(['picRoom:id,name', 'building:id,building_code,name'])->findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => new ClassroomResource($classroom)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
        $validate = Validator::make($request->all(), [
            "name" => "required|string|max:255|unique:classrooms,name,$id",
            "name_alias" => "nullable|string|max:255",
            "photo" => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "pic_room_id" => "required|integer|exists:pic_rooms,id",
            "building_id" => "required|integer|exists:buildings,id",
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $classroom = classroom::findOrFail($id);
                // Update only if there is a change in the column except photo
                $classroom->update([
                    'name' => $data['name'],
                    'name_alias' => $data['name_alias'],
                    'pic_room_id' => $data['pic_room_id'],
                    'building_id' => $data['building_id'],
                ]);
                // Update the photo if a new one is provided
                if ($request->hasFile('photo')) {
                    $uploadFolder = 'classroom-photo';
                    // Delete the old photo if it exists
                    if ($classroom->photo) {
                        $photoPath = basename($classroom->photo);
                        $storagePath = 'classroom-photo/' . $photoPath;
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
                    $classroom->update(['photo' => Storage::disk('public')->url($image_uploaded_path)]);
                }
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Updated Successfully',
                    'data' => new classroomResource($classroom)
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 500,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $classroom = Classroom::findOrFail($id);
            // Delete the photo if it exists
            if ($classroom->photo) {
                $photoPath = basename($classroom->photo);
                $storagePath = 'classroom-photo/' . $photoPath;
                // Check if the file exists before attempting to delete
                if (Storage::disk('public')->exists($storagePath)) {
                    // Delete the file from storage
                    Storage::disk('public')->delete($storagePath);
                } else {
                    \Log::info('File does not exist: ' . $storagePath);
                }
            }
            $classroom->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data Deleted Successfully',
                'data' => new ClassroomResource($classroom)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function showClassroomWithDetails($id)
    {
        try {
            $classroom = Classroom::with(['picRoom:id,name', 'building:id,building_code,name', 'classroomSchedule'])->findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => new ClassroomDetailResource($classroom)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
