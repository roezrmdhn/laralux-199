<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Facilities;
use App\Models\Hotel;
use App\Models\ProductType;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = Room::all();
        $facilities = Facilities::all();
        $room_type = RoomType::all();
        $hotel = Hotel::all();
        return view('staff.room.data-room', compact('room', 'facilities', 'room_type', 'hotel'));
    }
    // Add products
    public function store(Request $request)
    {
        $cleanedFilename = str_replace("C:\\fakepath\\", "", $request->image);
        // if ($request->image != null) {
        // $destinationPath = '/img';
        // $cleanedFilename->move(public_path($destinationPath), $cleanedFilename);
        // }
        $room = Room::create([
            'name' => $request->name,
            'image' => $cleanedFilename,
            'price' => $request->price,
            // 'rating' => $request->rating,
            'status' => $request->status,
            'facilities_id' => $request->facilities,
            'room_type_id' => $request->room_type,
            'hotels_id' => $request->hotels,
        ]);
        return response()->json($room);

        // return redirect('/data-room');
    }
    public function show($id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room);
    }
    public function update(Request $request, $id)
    {
        // dd($cleanedFilename)
        $room = Room::findOrFail($id);
        $cleanedFilename = str_replace("C:\\fakepath\\", "", $request->image);
        // if ($request->image != null) {
        // $destinationPath = '/img';
        // $cleanedFilename->move(public_path($destinationPath), $cleanedFilename);
        // }
        Room::where('id', $id)
            ->update(
                [
                    'name' => $request->name,
                    'image' => $cleanedFilename ? $cleanedFilename : $room->image,
                    'price' => $request->price,
                    'status' => $request->status,
                    'facilities_id' => $request->facilities ? $request->facilities : $room->facilities_id,
                    'room_type_id' => $request->room_type ? $request->room_type : $room->room_type_id,
                    'hotels_id' => $request->hotels ? $request->hotels : $room->hotels_id,
                ]
            );
        return response()->json($room);
        // return redirect('/data-room');
    }
    public function updateStatusRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->update([
            'status' => 'Available'
        ]);
        return response()->json($room);
    }
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return response()->json(['success' => 'Room deleted successfully']);
    }
}
