<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\HotelType;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{
    public function index()
    {
        $membership = Membership::all();
        $user = User::all();
        return view('staff.membership.data-membership', compact('membership', 'user'));
    }
    // Add products
    public function store(Request $request)
    {
        $rules = [
            'users_id' => 'required|integer|exists:users,id|unique:memberships,users_id',
        ];
        // Validate the incoming request data
        // Define custom error messages
        $messages = [
            'users_id.unique' => 'This user already has a membership.',
        ];
        // Validate the request data with custom messages
        $validator = Validator::make($request->all(), $rules, $messages);
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $membership = Membership::create([
            'status' => $request->status,
            'users_id' => $request->users_id,
        ]);
        User::whereId($request->users_id)
            ->update([
                'membership_id' => $membership->id
            ]);
        return response()->json($membership);
    }
    public function show($id)
    {
        $membership = Membership::findOrFail($id);
        return response()->json($membership);
    }
    public function update(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);
        $membership->update($request->all());
        return response()->json($membership);
    }
    public function destroy($id)
    {
        $membership = Membership::findOrFail($id);
        User::whereId($membership->users_id)
            ->update([
                'membership_id' => null
            ]);
        $membership->delete();
        return response()->json(['success' => 'Hotel deleted successfully']);
    }
}
