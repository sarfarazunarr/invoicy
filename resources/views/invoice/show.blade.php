@extends('layouts.app')

@section('title', 'Invoice Detail')

@section('content')
@guest
    @php
        return redirect()->route('login');
    @endphp
@endguest
<div class="flex full h-[89vh] justify-center items-center shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="bg-white w-1/2  p-5 rounded-md" id="invoice">
        <div class="flex justify-between">
            <div>
                <h2 class="text-2xl font-bold mb-4">Invoice Details</h2>
                <p class="mb-2"><span class="font-semibold">Name:</span> {{ $invoice->name }}</p>
                <p class="mb-2"><span class="font-semibold">Email:</span> {{ $invoice->email }}</p>
                <p class="mb-2"><span class="font-semibold">Phone:</span> {{ $invoice->phone }}</p>
            </div>
            <div class="pt-10">
                <p class="mb-2"><span class="font-semibold">Total Price</span> {{$invoice->total}}</p>
                <p class="mb-2"><span class="font-semibold">Payment Method:</span> {{ $invoice->payment_method }}</p>
                <p class="mb-2"><span class="font-semibold">Payment Status:</span> {{ $invoice->payment_status }}</p>
            </div>
        </div>
        <!-- Products Table -->
        @if ($invoice->products)
            <table class="w-full border mt-3 border-gray-200 table-borders">
                <thead>
                    <tr class="bg-blue-800 text-white">
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Subprice</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->products as $product)
                        <tr class="text-center border border-gray-200">
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->subprice }}</td>
                            <td>{{ $product->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="text-gray-800 py-3 px-2">Date of creation: {{$invoice->created_at}}</p>
            <div class="flex justify-center items-center">
                <button class="bg-green-600 text-white px-10 py-1 hover:bg-green-950 rounded-md" id="loadImage">Download Image</button>
            </div>
        @else
            <p>No products associated with this invoice.</p>
        @endif
    </div>
</div>
<script>
    document.getElementById('loadImage').addEventListener('click', function () {
    var element = document.getElementById('invoice');
    
    html2canvas(element).then(function (canvas) {
        // Convert the canvas to a data URL
        var dataURL = canvas.toDataURL('image/png');
        
        // Create a temporary link element
        var link = document.createElement('a');
        link.href = dataURL;
        link.download = 'invoice.png';
        
        // Append the link to the body
        document.body.appendChild(link);
        
        // Trigger the download by simulating a click
        link.click();
        
        // Remove the link from the document
        document.body.removeChild(link);
    });
});


</script>
@endsection