<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use App\Http\Resources\SemesterResource;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $semesters = Semester::all();
            return response()->json([
                'status' => 200,
                'data' => SemesterResource::collection($semesters)
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
        $validate = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "start_date" => "required|date",
            "end_date" => "required|date",
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $semester = Semester::create($data);
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Added Successfully',
                    'data' => new SemesterResource($semester)
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
            $semester = Semester::findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => new SemesterResource($semester)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "start_date" => "required|date",
            "end_date" => "required|date",
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                // $semester = Semester::create([
                //     'name' => $data['name'],
                //     'start_date' => $data['start_date'],
                //     'end_date' => $data['end_date'],
                // ]);
                $semester = Semester::findOrFail($id);
                $semester->update($data);
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Updated Successfully',
                    'data' => new SemesterResource($semester)
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
            $pic_room = Semester::findOrFail($id);
            $pic_room->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data Deleted Successfully',
                'data' => new SemesterResource($pic_room)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }
}
