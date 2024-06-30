@extends('layouts.customer')
@section('content')
    <div class="container py-4 flex items-center gap-3">
        <a href="../index.html" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right">Riwayat Orders</i>
        </span>
    </div>
    @foreach ($orders as $item)
        <form method="GET" action="{{ route('history.detail', ['id' => $item->id]) }}" enctype="multipart/form-data">
            <div class="container grid grid-cols-2 gap-6 mb-5">
                <div class="col-span-12 space-y-4">
                    <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
                        <div class="w-1/3">
                            <h2 class="text-gray-800 text-xl font-medium">Order total : @currency($item->grand_total)</h2>
                            <p class="text-gray-500 text-sm">{{ $item->date }}</p>
                            <div class="text-primary text-lg font-semibold"></div>
                        </div>
                        <div class="w-1/3">
                            {{ $item->status }}
                        </div>
                        <div class="text-primary text-lg font-semibold">
                            <div class="container mt-2 gap-6 ">
                                <button type="submit"
                                    class="px-6 py-2 text-center text-sm text-white bg-primary border border-primary 
                        rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
@endsection
