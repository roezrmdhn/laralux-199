<?php

namespace App\Http\Controllers\Customers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $orders = Transaction::whereUserId($user)->get(); // already declated a has many from categories, its mean it is beloangsto categories
        return view('customer.riwayat-order', compact('orders'));
    }
    public function detail($id)
    {
        
        $details = TransactionDetail::whereTransactionsId($id)->get(); // already declated a has many from categories, its mean it is beloangsto categories
        // $test = OrderDetail::whereOrderId($id)->get('price'); // already declated a has many from categories, its mean it is beloangsto categories
        // $sumPendapatan = collect($details)->sum('price');
        // return dd($sumPendapatan);
        return view('customer.riwayat-detail', compact('details'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
