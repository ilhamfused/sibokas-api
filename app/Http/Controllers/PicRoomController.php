<?php

namespace App\Http\Controllers;

use App\Models\PicRoom;
use Illuminate\Http\Request;
use App\Http\Resources\PicRoomResource;
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
                'data' => PicRoomResource::collection($pic_rooms)
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
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $pic_room = PicRoom::create([
                    'name' => $data['name']
                ]);
                // dd('test');
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Added Successfully',
                    'data' => new PicRoomResource($pic_room)
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
    public function show(String $picRoom)
    {
        try {
            $pic_room = PicRoom::findOrFail($picRoom);
            return response()->json([
                'status' => 200,
                'data' => new PicRoomResource($pic_room)
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
        ]);
        if ($validate->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validate->errors()
            ], 400);
        } else {
            $data = $validate->validated();
            try {
                $pic_room = PicRoom::findOrFail($id);
                $pic_room->update($data);
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Updated Successfully',
                    'data' => new PicRoomResource($pic_room)
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
            $pic_room = PicRoom::findOrFail($id);
            $pic_room->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Data Deleted Successfully',
                'data' => new PicRoomResource($pic_room)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'Something wrong',
            ], 500);
        }
    }
}
