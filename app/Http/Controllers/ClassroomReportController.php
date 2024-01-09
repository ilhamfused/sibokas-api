<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClassroomReportResource;
use App\Models\BookingClassroom;
use App\Models\ClassroomReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ClassroomReportController extends Controller
{
    public function makeReport(Request $request)
    {
        $user = auth()->user();
        $validate = Validator::make($request->all(), [
            "title" => "required|string|max:255|unique:classrooms,name",
            "description" => "nullable|string|max:255",
            "photo" => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "classroom_id" => "required|integer|exists:classrooms,id",
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors(),
            ], 400);
        } else {
            $data = $validate->validated();
            $data['student_id'] = $user->id;
            $bookingClassroom = BookingClassroom::where([
                ['classroom_id', $data['classroom_id']],
                ['student_id', $data['classroom_id']],
            ])->first();
            if (!$bookingClassroom) {
                return response()->json([
                    "status" => 401,
                    "message" => "You never use this classroom before",
                ], 401);
            }
            try {
                $uploadFolder = 'reports-photo';
                $photo = $request->file('photo');
                $image_uploaded_path = $photo->store($uploadFolder, 'public');
                $data['photo'] = Storage::disk('public')->url($image_uploaded_path);
                $classroomReport = ClassroomReport::create($data);
                return response()->json([
                    'status' => 201,
                    'message' => 'Data Added Successfully',
                    'data' => new ClassroomReportResource($classroomReport),
                ], 201);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 500,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }

    public function reportHistory()
    {
        $user = auth()->user();
        try {
            $classroomReport = ClassroomReport::all()->where('student_id', $user->id);
            return response()->json([
                "status" => 200,
                "data" => ClassroomReportResource::collection($classroomReport->loadMissing(['classroom:id,name,name_alias'])),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function getAllReport()
    {
        try {
            $classroomReport = ClassroomReport::all();
            return response()->json([
                'status' => 200,
                'data' => ClassroomReportResource::collection($classroomReport->loadMissing(['classroom:id,name,name_alias'])),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    public function showReport()
    {
        try {
            $classroom_reports = ClassroomReport::simplePaginate(10);
            return view('report', ['classroom_reports' => $classroom_reports]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }
}
