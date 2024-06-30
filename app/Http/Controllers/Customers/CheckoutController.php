<?php

namespace App\Http\Controllers\Customers;

use App\Models\Customer;
use App\Models\Membership;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart');
        $user = Auth::user()->id;
        $point = Auth::user()->point;
        $cart = session()->get('cart');
        // return dd($cart);
        return view('customer.checkout',  compact('cart', 'point'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();
        $cart = session()->get('cart');
        $transaction = new Transaction();
        $transaction->date = Carbon::now();
        $transaction->user_id = $user->id;
        $transaction->total_ppn = $request->total_ppn;
        $transaction->sub_total = $request->sub_total;
        $transaction->grand_total = $request->grandTotal;
        $transaction->status = 'Sedang Diproses';
        $saved =  $transaction->save();

        foreach ($cart as $item) {
            // dd($cart);
            $details = new TransactionDetail();
            $details->rooms_id = $item['id'];
            $details->price = $item['price'];
            $details->transactions_id = $transaction->id;
            $details->name = $user->name;
            $details->address = $user->address;
            $details->phone = $user->phone;
            $details->save();
            if ($item['room_type'] == 'Deluxe' || $item['room_type'] == 'Superior' || $item['room_type'] == 'Suite') {
                if ($request->sub_total >= 100000) {
                    $getMember = Membership::whereUsersId($user->id)->first();
                    $getPoint = 0;
                    $getPoint = floor($request->sub_total / 100000);
                    if ($getMember->status == 'Active') {
                        if ($request->point == 'Yes') {
                            // Redeem Point
                            User::where('id', $user->id)
                                ->update(
                                    [
                                        'point' => abs($user->point + (5 * 1)) - $getPoint,
                                    ]
                                );
                        } else {
                            User::where('id', $user->id)
                                ->update(
                                    [
                                        'point' => $user->point + (5 * 1),
                                    ]
                                );
                        }
                    }
                } else {
                    // Not Reedem
                    User::where('id', $user->id)
                        ->update(
                            [
                                'point' => $user->point + (5 * 1),
                            ]
                        );
                }
            } else {
                if ($request->sub_total >= 300000) {
                    $getMember = Membership::whereUsersId($user->id)->first();
                    $getPoint = 0;
                    $getPoint = floor($request->sub_total / 100000);
                    if ($getMember->status == 'Active') {
                        if ($request->point == 'Yes') { // Redemption Point.
                            User::where('id', $user->id)
                                ->update(
                                    [
                                        'point' => $user->point - $getPoint,
                                    ]
                                );
                        } else {
                            User::where('id', $user->id)
                                ->update(
                                    [
                                        'point' => $user->point + $getPoint,
                                    ]
                                );
                        }
                    }
                    // } else if ($request->sub_total >= 100000) {
                } else {
                    $getMember = Membership::whereUsersId($user->id)->first();
                    $getPoint = 0;
                    $getPoint = floor($request->sub_total / 100000);
                    if ($getMember->status == 'Active') {
                        if ($request->point == 'Yes') {
                            User::where('id', $user->id)
                                ->update(
                                    [
                                        'point' => $user->point - $getPoint,
                                    ]
                                );
                        } else {
                            User::where('id', $user->id)
                                ->update(
                                    [
                                        'point' => $user->point + $getPoint,
                                    ]
                                );
                        }
                    }
                }
            }
            // else {
            //     if ($item['room_type'] == 'Deluxe' || $item['room_type'] == 'Superior' || $item['room_type'] == 'Suite') {
            //         User::where('id', $user->id)
            //             ->update(
            //                 [
            //                     'point' => $user->point + (5 * 1),
            //                 ]
            //             );
            //     } else {
            //         if ($request->sub_total >= 300000) {
            //             $getPoint = 0;
            //             $getPoint = floor($request->sub_total / 300000);
            //             User::where('id', $user->id)
            //                 ->update(
            //                     [
            //                         'point' => $user->point + $getPoint,
            //                     ]
            //                 );
            //         } else if ($request->sub_total >= 100000) {
            //             $getMember = Membership::whereUsersId($user->id)->first();
            //             $getPoint = 0;
            //             $getPoint = floor($request->sub_total / 100000);
            //             if ($getMember->status == 'Active') {
            //                 User::where('id', $user->id)
            //                     ->update(
            //                         [
            //                             'point' => $user->point + $getPoint,
            //                         ]
            //                     );
            //             }
            //         }
            //     }
            // }
            $room = Room::find($item['id']);
            $room::where('id', $item['id'])
                ->update(
                    [
                        'status' => 'Booked',
                    ]
                );
        }

        if (!$saved) {
            return redirect('/')->with('warning', 'Silahkan Menyelesaikan Pembayaran');
        } else {
            session()->forget('cart');
            return redirect('/shop')->with('success', 'Produk berhasil di order');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
