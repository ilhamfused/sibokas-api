<?php

namespace App\Http\Controllers;

use App\Http\Resources\SemesterResource;
use App\Models\Semester;
use Illuminate\Http\Request;
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
                'data' => SemesterResource::collection($semesters),
            ], 200);
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
                'message' => $validate->errors(),
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $semester = Semester::create($data);
                return response()->json([
                    'status' => 201,
                    'message' => 'Data Added Successfully',
                    'data' => new SemesterResource($semester),
                ], 201);
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
                'data' => new SemesterResource($semester),
            ], 200);
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
                'message' => $validate->errors(),
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $semester = Semester::findOrFail($id);
                $semester->update($data);
                return response()->json([
                    'status' => 201,
                    'message' => 'Data Updated Successfully',
                    'data' => new SemesterResource($semester),
                ], 201);
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
            $semester = Semester::findOrFail($id);
            $semester->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data Deleted Successfully',
                'data' => new SemesterResource($semester),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }
    public function showSemester()
    {
        try {
            $semesters = Semester::simplePaginate(10);
            return view('semester', ['semesters' => $semesters]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    public function tambahSemester(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            // Sesuaikan aturan validasi sesuai kebutuhan
        ]);

        // Simpan data ke database
        $semesters = new Semester;
        $semesters->name = $request->input('name');
        $semesters->start_date = $request->input('start_date');
        $semesters->end_date = $request->input('end_date');
        $semesters->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('semester')->with('success', 'Data berhasil ditambahkan!');
    }

    public function deleteSemester($id)
    {
        $semesters = Semester::findOrFail($id);
        $semesters->delete();

        return redirect()->route('semester')->with('success', 'Data berhasil dihapus!');
    }

    public function editSemester($id)
    {
        $semesters = Semester::findOrFail($id);
        return view('updateSemester', compact('semesters'));
    }
    public function updateSemester(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            // Aturan validasi lainnya
        ]);

        $semesters = Semester::findOrFail($id);
        $semesters->name = $request->input('name');
        $semesters->start_date = $request->input('start_date');
        $semesters->end_date = $request->input('end_date');

        $semesters->save();

        return redirect()->route('semester')->with('success', 'Data berhasil diperbarui!');
    }
}
