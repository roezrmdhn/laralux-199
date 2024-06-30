<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\HotelType;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomType = RoomType::all();
        return view('staff.room-type.data-room-type', compact('roomType'));
    }
    // Add products
    public function store(Request $request)
    {
        $roomType = RoomType::create([
            'name' => $request->name,
        ]);
        return response()->json($roomType);
    }
    public function show($id)
    {
        $roomType = RoomType::findOrFail($id);
        return response()->json($roomType);
    }
    public function update(Request $request, $id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->update($request->all());
        return response()->json($roomType);
    }
    public function destroy($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();
        return response()->json(['success' => 'Room Type deleted successfully']);
    }
}
