<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\HotelType;
use App\Models\Membership;
use Illuminate\Http\Request;

class HotelTypeController extends Controller
{
    public function index()
    {
        $hotelType = HotelType::all();
        return view('staff.hotel-type.data-hotel-type', compact('hotelType'));
    }
    // Add products
    public function store(Request $request)
    {
        $hotelType = HotelType::create([
            'name' => $request->name,
        ]);
        return response()->json($hotelType);
    }
    public function show($id)
    {
        $hotelType = HotelType::findOrFail($id);
        return response()->json($hotelType);
    }
    public function update(Request $request, $id)
    {
        $hotelType = HotelType::findOrFail($id);
        $hotelType->update($request->all());
        return response()->json($hotelType);
    }
    public function destroy($id)
    {
        $hotelType = HotelType::findOrFail($id);
        $hotelType->delete();
        return response()->json(['success' => 'Hotel deleted successfully']);
    }
}
