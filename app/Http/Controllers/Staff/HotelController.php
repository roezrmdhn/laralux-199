<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelType;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotel = Hotel::all();
        $hotelType = HotelType::all();
        return view('staff.hotel.data-hotel', compact('hotel', 'hotelType'));
    }
    // Add products
    public function store(Request $request)
    {
        $hotel = Hotel::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'hotels_type_id' => $request->hotels_type,
        ]);
        return response()->json($hotel);
        // return redirect('/data-hotel');
    }
    public function show($id)
    {
        // Fetch the hotel details by ID and return them as JSON
        $hotel = Hotel::findOrFail($id);
        return response()->json($hotel);
    }
    public function update(Request $request, $id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->all());
        return response()->json($hotel);
    }
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return response()->json(['success' => 'Hotel deleted successfully']);
    }
}
