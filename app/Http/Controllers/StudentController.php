<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function changePassword(Request $request, String $id)
    {
        $validate = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:new_password',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $student = Student::findOrFail($id);
                if (!Hash::check($data['old_password'], auth()->user()->password)) {
                    return response()->json([
                        'status' => 400,
                        'message' => "Old Password doesn't match"
                    ]);
                }
                $student->update([
                    'password' => Hash::make($data['new_password']),
                ]);
                return response()->json([
                    'message' => 'Password Student Updated Successfully',
                    'data' => $student,
                ], 201);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 500,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }

    public function me()
    {
        return Auth::user();
    }
}
