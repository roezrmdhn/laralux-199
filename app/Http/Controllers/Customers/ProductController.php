<?php

namespace App\Http\Controllers\Customers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\Room;

class ProductController extends Controller
{
    public function index()
    {
        $room = Room::all();
        return view('customer.shop', compact('room'));
    }
    public function detail($id)
    {
        $room = Room::find($id);
        return view('customer.detail-product', compact('room'));
    }
}
