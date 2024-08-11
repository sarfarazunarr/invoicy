@extends('layouts.app')

@section('title', 'Update Invoice')

@section('content')
@guest
    @php
        return redirect()->route('login');
    @endphp
@endguest
<div class="p-5">
    <div class="w-2/3 mx-auto py-5 rounded-md bg-gray-700">
        <!-- Edit Invoice Form -->
        <form action="{{ route('invoice.update', $invoice->id) }}" method="POST"
            class="bg-gray-700 my-5 shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            <div class="mb-4 w-1/2 flex items-center gap-2">
            <label class="text-white">Name</label>
                <input
                    class="sshadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"
                    type="text" name="name" value="{{ $invoice->name }}">
            </div>
            <div class="mb-4 w-1/2 flex items-center gap-2">
            <label class="text-white">Email </label>
                <input
                    class="sshadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"
                    type="email" name="email" value="{{ $invoice->email }}">
            </div>
            <div class="mb-4 w-1/2 flex items-center gap-2">
            <label class="text-white">Phone</label>
                <input
                    class="sshadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"
                    type="phone" name="phone" value="{{ $invoice->phone }}">
            </div>
            <div class="mb-4 w-1/2 flex items-center gap-2">
            <label class="text-white">Payment Method</label>
                <select
                    class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"
                    name="payment_method">
                    <option value="cash" {{ $invoice->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="credit card" {{ $invoice->payment_method == 'credit card' ? 'selected' : '' }}>Credit
                        Card</option>
                </select>
            </div>
            <div class="mb-4 w-1/2 flex items-center gap-2">
            <label class="text-white">Payment Status</label>
                <select
                    class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"
                    name="payment_status">
                    <option disabled>Select Status</option>
                    <option value="paid" {{ $invoice->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="partial paid" {{ $invoice->payment_method == 'partial paid' ? 'selected' : '' }}>
                        Partial Paid</option>
                    <option value="unpaid" {{ $invoice->payment_method == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
            </div>
            <!-- Products Section -->
            <div class="mb-4">
                
                <h2 class="text-3xl text-white font-semibold">Products</h2>
                <table class="mx-auto my-2">
                    <thead>
                        <tr class="text-white font-semibold">
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="products">
                        @foreach ($invoice->products as $product)
                            <tr>
                                <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $product->id }}" class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline">
                                <td><input type="text" name="products[{{ $loop->index }}][name]"
                                        value="{{ $product->product_name }}" class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"></td>
                                <td><input type="number" name="products[{{ $loop->index }}][quantity]"
                                        value="{{ $product->quantity }}" class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"></td>
                                <td><input type="number" name="products[{{ $loop->index }}][price]"
                                        value="{{ $product->subprice }}" class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"></td>
                                <td><input type="number" name="products[{{ $loop->index }}][total]"
                                        value="{{ $product->total_price }}" class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"></td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <div class="mt-4">
                    <label class="text-white">Total Amount: </label>
                    <input type="number" name="totalAmount" id="totalAmount" class="shadow appearance-none border border-green-400 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline" value="{{ $invoice->total }}" readonly>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">Update Invoice</button>
            </div>
        </form>
    </div>
</div>
<script>
    // Function to calculate total for each product row
    function calculateRowTotal(row) {
        // Use the input names that match the new structure
        const quantity = parseFloat(row.querySelector('input[name$="[quantity]"]').value) || 0;
        const price = parseFloat(row.querySelector('input[name$="[price]"]').value) || 0;
        const total = quantity * price;
        row.querySelector('input[name$="[total]"]').value = total.toFixed(2);
        return total;
    }

    // Function to update the total amount
    function updateTotalAmount() {
        let totalAmount = 0;
        document.querySelectorAll('#products tr').forEach(row => {
            totalAmount += calculateRowTotal(row);
        });
        document.getElementById('totalAmount').value = totalAmount.toFixed(2);
    }

    // Event listeners for quantity and price changes
    document.addEventListener('input', function(event) {
        if (event.target.matches('input[name$="[quantity]"]') || event.target.matches('input[name$="[price]"]')) {
            updateTotalAmount();
        }
    });

    // Initial calculation on page load
    document.addEventListener('DOMContentLoaded', updateTotalAmount);
</script>
@endsection