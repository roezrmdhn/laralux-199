@extends('layouts.customer')
@section('content')
    @php
        $total = 0;
        $total_room = 0;
        $tax = 0.11;
        if ($cart != null) {
            foreach ($cart as $key => $value) {
                $total += $value['price'];
                $total_room += $value['qty'];
            }
            $afterTax = $total * $tax;
            $grandTotal = $total + $afterTax;
        }
    @endphp
    <!-- wrapper -->
    <div class="container py-4">

        <form method="POST" action="{{ route('checkout.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $grandTotal }}" name="grandTotal">
            <input type="hidden" value="{{ $afterTax }}" name="total_ppn">
            <input type="hidden" value="{{ $total }}" name="sub_total">
            <input type="hidden" value="{{ $total_room }}" name="total_room">
            <div class="container grid grid-cols-12 items-start pb-16 pt-4 gap-6">
                <div class="col-span-12 border border-gray-200 p-4 rounded">
                    <h4 class="text-gray-800 text-lg mb-4 font-medium uppercase">Order summary</h4>
                    @foreach ($cart as $key => $c)
                        <div class="space-y-2 mt-5">
                            <div class="flex justify-between">
                                <div>
                                    <img src="{{ asset('img/' . $c['image']) }}" width="100px" alt="">
                                </div>
                                <h5 class="text-gray-800 font-medium">{{ $c['name'] }}</h5>
                                <div class="">
                                    <p class="text-gray-500 text-sm">@currency($c['price'])</p>
                                </div>
                            </div>
                    @endforeach

                    <div class="flex justify-between text-gray-800 font-medium py-3 uppercase">
                        <p>Subtotal</p>
                        <p>@currency($total)</p>
                    </div>

                    @if (Auth::user()->point > 1)
                        <div class="flex justify-between text-gray-800 font-medium py-3 uppercase">
                            <p>Redemption</p>
                            <select name="point" id="">
                                <option value="Yes">Pakai Point</option>
                                <option value="No">Tidak Pakai Point</option>
                            </select>
                        </div>
                        @else
                        <input type="hidden" name="point" value="No">
                    @endif
                    <div class="flex justify-between text-gray-800 font-medium py-3 uppercase">
                        <p>Tax</p>
                        <p>@currency($afterTax) (11%)</p>
                    </div>

                    <div class="flex justify-between text-gray-800 font-medium py-3 uppercase">
                        <p class="font-semibold">Total</p>
                        <p>@currency($grandTotal)</p>
                    </div>

                    <button type="submit"
                        class="block w-full py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">
                        Checkout</button>
                </div>
            </div>
        </form>
    </div>
@endsection
