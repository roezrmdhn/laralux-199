<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Facilities;
use App\Models\Jenis;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    public function index()
    {
        $facilities = Facilities::all();
        return view('staff.facilities.data-facilities', compact('facilities'));
    }
    // Add products
    public function store(Request $request)
    {
        $facilities = Facilities::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response()->json($facilities);
        // return redirect('/data-hotel');
    }
    public function show($id)
    {
        // Fetch the hotel details by ID and return them as JSON
        $facilities = Facilities::findOrFail($id);
        return response()->json($facilities);
    }
    public function update(Request $request, $id)
    {
        $facilities = Facilities::findOrFail($id);
        $facilities->update($request->all());
        return response()->json($facilities);
    }
    public function destroy($id)
    {
        $facilities = Facilities::findOrFail($id);
        $facilities->delete();
        return response()->json(['success' => 'Facilities deleted successfully']);
    }
}
