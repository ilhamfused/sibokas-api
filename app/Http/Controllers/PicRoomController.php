<?php

namespace App\Http\Controllers;

use App\Http\Resources\PicRoomResource;
use App\Models\PicRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PicRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $pic_rooms = PicRoom::all();
            return response()->json([
                'status' => 200,
                'data' => PicRoomResource::collection($pic_rooms),
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
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors(),
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $pic_room = PicRoom::create([
                    'name' => $data['name'],
                ]);
                // dd('test');
                return response()->json([
                    'status' => 201,
                    'message' => 'Data Added Successfully',
                    'data' => new PicRoomResource($pic_room),
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
    public function show(String $picRoom)
    {
        try {
            $pic_room = PicRoom::findOrFail($picRoom);
            return response()->json([
                'status' => 200,
                'data' => new PicRoomResource($pic_room),
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
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors(),
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $pic_room = PicRoom::findOrFail($id);
                $pic_room->update($data);
                return response()->json([
                    'status' => 201,
                    'message' => 'Data Updated Successfully',
                    'data' => new PicRoomResource($pic_room),
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
            $pic_room = PicRoom::findOrFail($id);
            $pic_room->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data Deleted Successfully',
                'data' => new PicRoomResource($pic_room),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    public function showPicroom()
    {
        try {
            $pic_rooms = PicRoom::simplePaginate(10);
            return view('picroom', ['pic_rooms' => $pic_rooms]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }

    public function tambahPicroom(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Sesuaikan aturan validasi sesuai kebutuhan
        ]);

        // Simpan data ke database
        $pic_rooms = new PicRoom;
        $pic_rooms->name = $request->input('name');

        $pic_rooms->save();

        // Redirect atau berikan respons sesuai kebutuhan
        return redirect()->route('picroom')->with('success', 'Data berhasil ditambahkan!');
    }

    public function deletePicroom($id)
    {
        $pic_rooms = PicRoom::findOrFail($id);
        $pic_rooms->delete();

        return redirect()->route('picroom')->with('success', 'Data berhasil dihapus!');
    }

    public function editPicroom($id)
    {
        $pic_rooms = PicRoom::findOrFail($id);
        return view('updatePicroom', compact('pic_rooms'));
    }

    public function updatePicroom(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Aturan validasi lainnya
        ]);

        $pic_rooms = PicRoom::findOrFail($id);
        $pic_rooms->name = $request->input('name');

        $pic_rooms->save();

        return redirect()->route('picroom')->with('success', 'Data berhasil diperbarui!');
    }
}
