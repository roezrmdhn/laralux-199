@extends('layouts.customer')
@section('content')
    <div class="container py-4 flex items-center gap-3">
        <a href="../index.html" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right">Keranjang</i>
        </span>
    </div>
    @if ($cart == null)
        <div class="wrap-iten-in-cart">
            <div class="container-fluid ">
                <div class="row">
                    <div class="card-body cart">
                        <div class="col-sm-12 empty-cart-cls text-center">
                            <h4><strong>Keranjang Kosong</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- {{ dd($cart) }} --}}
        @foreach ($cart as $key => $c)
            <div class="container grid grid-cols-2 gap-6 mb-5">
                <div class="col-span-12 space-y-4">
                    <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
                        <div class="w-28">
                            <img src="{{ asset('img/' . $c['image']) }}" alt="product 6" class="w-full">
                        </div>
                        <div class="w-1/3">
                            <h2 class="text-gray-800 text-xl font-medium uppercase">{{ $c['name'] }}</h2>
                            <p class="text-gray-500 text-sm">@currency($c['price'])</p>
                            <div class="text-primary text-lg font-semibold"></div>
                        </div>
                        <form action="{{ route('cart.remove', ['id' => $c['id']]) }}" method="GET">
                            <button type="submit"
                                class="deleteCart flex items-center px-2 py-1 pl-0 space-x-1 text-red-600">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <form method="POST" action="{{ route('checkout.index') }}" enctype="multipart/form-data">
            @csrf
            <div class="container mt-2 gap-6 ">
                <button type="submit"
                    class="px-6 py-2  text-sm text-white bg-primary border border-primary  rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">Checkout</button>
            </div>
        </form>
    @endif
@endsection
