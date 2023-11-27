<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AdminResource;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function showAllAdmin()
    {
        try {
            $admin = Admin::all();
            return response()->json([
                'status' => 200,
                'data' => AdminResource::collection($admin)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    public function showAllStudent()
    {
        try {
            $student = Student::all();
            return response()->json([
                'status' => 200,
                'data' => StudentResource::collection($student)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    public function registerAdmin(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $admin = Admin::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);
                return response()->json([
                    'status' => 201,
                    'message' => 'User Admin Added Successfully',
                    'data' => $admin,
                ], 201);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 500,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }

    public function registerStudent(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|unique:students,name',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:8',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $student = Student::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);
                return response()->json([
                    'status' => 201,
                    'message' => 'User Student Added Successfully',
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

    public function showAdmin($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => [
                    'id' => $admin->id,
                    'name' => $admin->name,
                    'email' => $admin->email
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    public function showStudent($id)
    {
        try {
            $student = Student::findOrFail($id);
            return response()->json([
                'status' => 200,
                'data' => [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    public function editAdmin(Request $request, String $id)
    {
        // return $request;
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => "required|email|unique:admins,email,$id",
            'password' => 'required|string|min:8',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $admin = Admin::findOrFail($id);
                $password = '';
                if (!$data['password']) {
                    $password = $admin->password;
                } else {
                    $password = Hash::make($data['password']);
                }
                $admin->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $password,
                ]);
                return response()->json([
                    'message' => 'User Admin Updated Successfully',
                    'data' => $admin,
                ], 201);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => 500,
                    'message' => $th->getMessage(),
                ], 500);
            }
        }
    }

    public function editStudent(Request $request, String $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => "required|string|unique:students,name,$id",
            'email' => "required|email|unique:students,email,$id",
            'password' => 'required|string|min:8',
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
                $password = '';
                if (!$data['password']) {
                    $password = $student->password;
                } else {
                    $password = Hash::make($data['password']);
                }
                $student->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $password,
                ]);
                return response()->json([
                    'message' => 'User Student Updated Successfully',
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

    public function deleteAdmin(String $id)
    {
        try {
            $admin = Admin::findOrFail($id);
            if (Auth::user()->id === intval($id)) {
                return response()->json([
                    'status' => 500,
                    'message' => "Can't delete user",
                ], 500);
            }
            $admin->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data Deleted Successfully',
                'data' => $admin
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function deleteStudent(String $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data Deleted Successfully',
                'data' => $student
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
