<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassroomSchedule;
use App\Http\Resources\PicRoomResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ClassroomScheduleResource;

class ClassroomScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $classroom_schedule = ClassroomSchedule::all();
            return response()->json([
                'status' => 200,
                'data' => ClassroomScheduleResource::collection($classroom_schedule->loadMissing(['semester:id,name', 'classroom:id,name']))
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
            "day_of_week" => "required|integer|between:1,5",
            "start_time" => "required|date_format:H:i:s",
            "end_time" => "required|date_format:H:i:s",
            "semester_id" => "required|integer|exists:semesters,id",
            "classroom_id" => "required|integer|exists:classrooms,id",
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $classroom_schedule = ClassroomSchedule::create($data);
                // dd('test');
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Added Successfully',
                    'data' => new ClassroomScheduleResource($classroom_schedule)
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
            $classroom_schedule = ClassroomSchedule::findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => new ClassroomScheduleResource($classroom_schedule->loadMissing(['semester:id,name', 'classroom:id,name']))
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
            "day_of_week" => "required|integer|between:1,5",
            "start_time" => "required|date_format:H:i:s",
            "end_time" => "required|date_format:H:i:s",
            "semester_id" => "required|integer|exists:semesters,id",
            "classroom_id" => "required|integer|exists:classrooms,id",
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $classroom_schedule = ClassroomSchedule::findOrFail($id);
                $classroom_schedule->update($data);
                // dd('test');
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Updated Successfully',
                    'data' => new ClassroomScheduleResource($classroom_schedule)
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
            $classroom_schedule = ClassroomSchedule::findOrFail($id);
            $classroom_schedule->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data Deleted Successfully',
                'data' => new ClassroomScheduleResource($classroom_schedule)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }
}
