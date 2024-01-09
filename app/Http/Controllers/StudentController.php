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
                'message' => $validate->errors(),
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $student = Student::findOrFail($id);
                if (!Hash::check($data['old_password'], auth()->user()->password)) {
                    return response()->json([
                        'status' => 400,
                        'message' => "Old Password doesn't match",
                    ], 400);
                }
                $student->update([
                    'password' => Hash::make($data['new_password']),
                ]);
                return response()->json([
                    'status' => 201,
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

    public function showStudents()
    {
        try {
            $students = Student::simplePaginate(10);
            return view('students', ['students' => $students]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }
    public function tambahStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
            // Sesuaikan aturan validasi sesuai kebutuhan
        ]);

        // Simpan data ke database
        $students = new Student;
        $students->name = $request->input('name');
        $students->email = $request->input('email');
        $students->password = Hash::make($request->input('password'));
        $students->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('students')->with('success', 'Data berhasil ditambahkan!');
    }

    public function deleteStudent($id)
    {
        $students = Student::findOrFail($id);
        $students->delete();

        return redirect()->route('students')->with('success', 'Data berhasil dihapus!');
    }

    public function editStudent($id)
    {
        $student = Student::findOrFail($id);
        return view('updateStudent', compact('student'));
    }

    public function updateStudent(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Aturan validasi lainnya
        ]);

        $student = Student::findOrFail($id);
        $student->name = $request->input('name');
        $student->email = $request->input('email');

        // Periksa apakah ada input baru untuk password
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8',
            ]);

            $student->password = Hash::make($request->input('password'));
        }

        $student->save();

        return redirect()->route('students')->with('success', 'Data berhasil diperbarui!');
    }
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'password' => 'required|string|min:8',
    //         // Sesuaikan aturan validasi sesuai kebutuhan
    //     ]);

    //     $student = Student::findOrFail($id);
    //     $student->name = $request->input('name');
    //     $student->email = $request->input('email');
    //     $student->password = Hash::make($request->input('password'));
    //     // Enkripsi password
    //     $student->save();

    //     return redirect()->route('students')->with('success', 'Data berhasil diperbarui!');
    // }

}
