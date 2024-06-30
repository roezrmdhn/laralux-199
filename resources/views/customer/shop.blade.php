@extends('layouts.customer')
@section('content')
    <div class="container pb-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6 mt-10">Best Room</h2>
        <div class="grid grid-cols-6 md:grid-cols-6 gap-6">
            @foreach ($room as $item)
                <div class="bg-white shadow rounded overflow-hidden group">
                    <div class="relative">
                        <a href="/detail-product/{{ $item->id }}">
                            <img src="{{ asset('img/' . $item->image) }}" alt="product 1" class="w-full">
                        </a>
                    </div>
                    <div class="pt-4 pb-3 px-4">
                        <a href="/detail-product/{{ $item->id }}">
                            <h4 class=" font-medium text-xl text-gray-800 hover:text-primary transition">
                                {{ $item->name }} - {{ $item->brand }}</h4>
                        </a>
                        <p class="text-sm text-gray-500 transition  mb-3">Fasiltas : {{ $item->facilities->name }}
                            <br>
                            <small>Stock : {{ $item->stock }} pcs</small>
                            <br>
                            <small>Tipe : {{ $item->room_type->name }} </small>
                        </p>
                        <div class="flex items-baseline mb-1 space-x-2">
                            <p class="text-xl text-primary font-semibold">@currency($item->price)</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
