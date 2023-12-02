<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use Throwable;
use Carbon\Carbon;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\BookingClassroom;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function checkIn(Request $request)
    {
        $student = auth()->user();
        // Cek apakah ada booking untuk classroom ini yang belum check-out
        $uncheckoutBooking  = BookingClassroom::where([
            ['student_id', $student->id],
            ['status', 1], // status checked in
        ])->first();
        if ($uncheckoutBooking) {
            return response()->json([
                "status" => 401,
                "message" => "You already use a classroom",
            ], 401);
        }
        $validate = Validator::make($request->all(), [
            "classroom_id" => "required|integer|exists:classrooms,id"
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $classroom = Classroom::findOrFail($data['classroom_id']);
                if ($classroom->status === 2) {
                    return response()->json([
                        "status" => 400,
                        "message" => "The classroom is currently in-use",
                        // "classroom_id" => $classroom->id
                    ], 400);
                }
                $bookingClassroom = BookingClassroom::create([
                    "time_in" => Carbon::now(),
                    // "time_out" => null,
                    "status" => 1,
                    "student_id" => $student->id,
                    "classroom_id" => $classroom->id
                ]);
                $classroom->update([
                    "status" => 2
                ]);
                return response()->json([
                    "status" => 200,
                    "message" => "Successfully Check-in to classroom",
                    "data" => $bookingClassroom
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 500,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }

    public function checkOut(Request $request, String $bookingId)
    {
        $student = auth()->user();
        $validate = Validator::make($request->all(), [
            "classroom_id" => "required|integer|exists:classrooms,id"
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            // dd($data['classroom_id']);
            try {
                $bookingClassroom = BookingClassroom::findOrFail($bookingId);
                $classroom = Classroom::findOrFail($data['classroom_id']);
                // dd($data['classroom_id']);
                if ($student->id !== $bookingClassroom->student_id || $bookingClassroom->classroom_id !== $data['classroom_id']) {
                    return response()->json([
                        "status" => 401,
                        "message" => "Unauthorized to perform this action",
                    ], 401);
                }
                $bookingClassroom->update([
                    "time_out" => Carbon::now(),
                    "status" => 2,
                ]);
                $classroom->update([
                    "status" => 1
                ]);
                return response()->json([
                    "status" => 200,
                    "message" => "Successfully Check-out from classroom",
                    "data" => $bookingClassroom
                ], 200);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 500,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }

    public function bookingHistory()
    {
        $user = auth()->user();
        try {
            $bookingClassroom = BookingClassroom::all()->where('student_id', $user->id);
            return response()->json([
                "status" => 200,
                "data" => BookingResource::collection($bookingClassroom->loadMissing(['classroom:id,name,name_alias'])),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function getAllBooking()
    {
        try {
            $bookingClassrooms = BookingClassroom::all();
            return response()->json([
                'status' => 200,
                'data' => BookingResource::collection($bookingClassrooms)
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }
}
