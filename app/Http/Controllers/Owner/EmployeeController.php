<?php

namespace App\Http\Controllers\Owner;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class EmployeeController extends Controller
{

    public function index()
    {
        // if (Auth::check()) {
        $employees = User::all();
        return view('owner.employees.data-employee', compact('employees'));
        // }
    }
    // Add products

    public function create()
    {
        return view('owner.employees.create');
    }
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'address' => $request->address,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/data-employee');
    }
    public function edit($id)
    {
        $employees = User::find($id);
        return view('owner.employees.edit', compact('employees'));
    }
    public function update(Request $request, $id)
    {
        User::where('id', $id)
            ->update(
                [
                    'username' => $request->username,
                    'password' => $request->password,
                    'name' => $request->name,
                    'role' => $request->role,
                    'address' => $request->address,
                    'phone' => $request->phone,
                ]
            );
        return redirect('/data-employee');
    }
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back();
    }
}
