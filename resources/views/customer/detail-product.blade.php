@extends('layouts.customer')
@section('content')
    <div class="container py-4 flex items-center gap-3">
        <a href="../index.html" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </a>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
    </div>
    <form action="{{ route('cart.add', ['id' => $room->id]) }}" method="POST">
        @csrf
        <div class="container grid grid-cols-2 gap-6">
            <div>
                <img src="{{ asset('img/' . $room->image) }}" alt="product" class="w-full">
            </div>
            <div>
                <h2 class="text-3xl font-medium uppercase mb-2"> {{ $room->name }}</h2>
                <h3 class="mb-2"> @currency($room->price) </h3>
                <div class="space-y-2">
                    <p class="text-gray-800 font-semibold space-x-2">
                        <span>Status: </span>
                        @if ($room->status == '`ilable')
                            <span class="text-red-600">{{ $room->status }}</span>
                        @else
                            <span class="text-green-600">{{ $room->status }}</span>
                        @endif
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">Fasilitas: </span>
                        <span class="text-gray-600">{{ $room->facilities->name }}</span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">Hotel: </span>
                        <span class="text-gray-600">{{ $room->hotels->name }}</span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">Room Tipe: </span>
                        <span class="text-gray-600">{{ $room->room_type->name }}</span>
                    </p>
                    <p class="space-x-2">
                        <span class="text-gray-800 font-semibold">Rating: </span>
                        @if ($room->rating == null)
                            <span class="text-gray-600"><i>No Rating Yet</i></span>
                        @else
                            <span class="text-gray-600">{{ $room->rating }}</span>
                        @endif
                    </p>
                </div>
                <div class="flex items-baseline mb-1 space-x-2 font-roboto mt-4">
                    <p class="text-xl text-primary font-semibold"></p>
                </div>

                <p class="mt-4 text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos eius eum
                    reprehenderit dolore vel mollitia optio consequatur hic asperiores inventore suscipit, velit
                    consequuntur, voluptate doloremque iure necessitatibus adipisci magnam porro.</p>

                {{-- <h3 class="text-sm text-gray-800 uppercase mb-1">Quantity</h3>
                    <div class="flex border border-gray-300 text-gray-600 divide-x divide-gray-300 w-max">
                        <a
                            class="btn btn-reduce h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">
                            -</a>
                        <input class="count" type="number" name="quantity" value="1" data-max="120" pattern="[0-9]*">
                        <a
                            class="btn btn-increase h-8 w-8 text-xl flex items-center justify-center cursor-pointer select-none">
                            +</a>
                    </div> --}}
                <div class="my-10">
                    <button type="submit"
                        class="add-to-cart bg-primary border border-primary text-white px-8 py-2 font-medium rounded uppercase flex items-center gap-2 hover:bg-transparent hover:text-primary transition">Add
                        To Cart</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.add-to-cart', function(e) {
                e.preventDefault();
                if ({{ $room->status != 'Available' }}) {
                    Swal.fire({
                        title: 'Room is unavailable',
                        text: 'Please select another room',
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
@endsection
