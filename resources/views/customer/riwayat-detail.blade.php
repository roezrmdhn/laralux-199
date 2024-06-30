@extends('layouts.customer')
@section('content')
    @php
        $total = 0;
        $tax = 0.11;
        foreach ($details as $key => $value) {
            $total = $value['price'] + $total;
        }
        $afterTax = $total * $tax;
        $grandTotal = $total + $afterTax;
    @endphp
    <div class="container py-4 flex items-center gap-3">
        <a href="../index.html" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right">Detail Orders</i>
        </span>
    </div>
    @foreach ($details as $item)
        <div class="container grid grid-cols-2 gap-6 mb-5">
            <div class="col-span-12 space-y-4">
                <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
                    <div class="w-1/3">
                        <h2 class="text-gray-800 text-xl font-medium">Penerima: {{ $item->name }}</h2>
                        <p class="text-gray-500 text-sm">Alamat : {{ $item->address }}</p>
                        <p class="text-gray-500 text-sm">Nomor Handphone : {{ $item->phone }}</p>
                    </div>
                    <div class="text-primary text-lg font-semibold">@currency($item->price)</div>
                </div>
            </div>
        </div>
    @endforeach
    <div class="container grid grid-cols-2 gap-6 mb-5">
        <div class="col-span-12 space-y-4">
            <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
                <div class="w-1/3">
                    <h2 class="text-gray-800 text-xl font-medium">Grand total </h2>
                    <p class="text-gray-500 text-sm">Tax : @currency($afterTax) (11%)</p>
                </div>
                <div class="text-primary text-lg font-semibold">@currency($grandTotal)</div>
            </div>
          
        </div>
    </div>
@endsection
