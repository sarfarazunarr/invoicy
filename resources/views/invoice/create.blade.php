@extends('layouts.app')

@section('title', 'Create Invoice')

@section('content')
@guest
    @php
        return redirect()->route('login');
    @endphp
@endguest
<div class="p-5">
    <div class="w-2/3 mx-auto py-5 rounded-md bg-gray-700">
        <form action="{{ route('invoice.store') }}" method="POST"
            class="bg-gray-700 my-5 shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4 w-1/2 flex items-center gap-2">
            <label class="text-white">Name</label>
                <input
                    class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"
                    type="text" name="name" placeholder="Name">
            </div>
            <div class="mb-4 w-1/2 flex items-center gap-2">
            <label class="text-white">Email </label>
                <input
                    class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"
                    type="email" name="email" placeholder="Email">
            </div>
            <div class="mb-4 w-1/2 flex items-center gap-2">
            <label class="text-white">Phone</label>
                <input
                    class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"
                    type="tel" name="phone" placeholder="Phone">
            </div>
            <div class="mb-4 w-1/2">
            <label class="text-white">Payment Method</label>
                <select
                    class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"
                    name="payment_method">
                    <option value="cash">Cash</option>
                    <option value="credit card">Credit Card</option>
                </select>
            </div>
            <div class="mb-4 w-1/2">
            <label class="text-white">Payment Status</label>
                <select
                    class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline"
                    name="payment_status">
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                    <option value="partial paid">Partial Paid</option>
                </select>
            </div>
            <!-- Products Section -->
            <div class="mb-4">
                <div class="flex py-2 justify-between items-center">
                <h2 class="text-3xl text-white font-semibold">Products</h2>
                <button type="button" class="px-3 py-2 rounded-md bg-blue-800 text-white hover:bg-blue-950" id="addProduct">Add Product</button>
                </div>
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
                        <tr>
                            <td><input type="text" class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline" name="product_name[]"></td>
                            <td><input type="number" class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline" name="quantity[]" oninput="updateTotal(this)"></td>
                            <td><input type="number" class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline" name="price[]" oninput="updateTotal(this)"></td>
                            <td><input type="number" class="shadow appearance-none border border-gray-600 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline" name="total[]" readonly></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-4 w-1/4">
                    <label class="text-white font-semibold">Total Amount: </label>
                    <input type="number" class="shadow appearance-none border border-green-400 rounded w-full py-2 px-3 text-gray-100 leading-tight focus:outline-none bg-gray-800 focus:border-white focus:shadow-outline" name="totalAmount" id="totalAmount" readonly>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">Create Invoice</button>
            </div>
        </form>
    </div>
</div>
    <script>
        // Add product row dynamically
        document.getElementById('addProduct').addEventListener('click', function () {

            var table = document.getElementById('products');
            var row = table.insertRow(-1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);

            var input1 = document.createElement('input');
            input1.type = 'text';
            input1.name = 'product_name[]';
            input1.classList.add('shadow', 'appearance-none', 'border', 'border-gray-600', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-100', 'leading-tight', 'focus:outline-none', 'bg-gray-800', 'focus:border-white', 'focus:shadow-outline');
            cell1.appendChild(input1);

            var input2 = document.createElement('input');
            input2.type = 'number';
            input2.name = 'quantity[]';
            input2.classList.add('shadow', 'appearance-none', 'border', 'border-gray-600', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-100', 'leading-tight', 'focus:outline-none', 'bg-gray-800', 'focus:border-white', 'focus:shadow-outline');
            input2.oninput = function () { updateTotal(this); };
            cell2.appendChild(input2);

            var input3 = document.createElement('input');
            input3.type = 'number';
            input3.name = 'price[]';
            input3.classList.add('shadow', 'appearance-none', 'border', 'border-gray-600', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-100', 'leading-tight', 'focus:outline-none', 'bg-gray-800', 'focus:border-white', 'focus:shadow-outline');
            input3.oninput = function () { updateTotal(this); };
            cell3.appendChild(input3);

            var input4 = document.createElement('input');
            input4.type = 'number';
            input4.name = 'total[]';
            input4.classList.add('shadow', 'appearance-none', 'border', 'border-gray-600', 'rounded', 'w-full', 'py-2', 'px-3', 'text-gray-100', 'leading-tight', 'focus:outline-none', 'bg-gray-800', 'focus:border-white', 'focus:shadow-outline');
            input4.readOnly = true;
            cell4.appendChild(input4);
        });

        // Function to update the total for each product and overall total amount
        function updateTotal(element) {
            var row = element.closest('tr');
            var quantity = row.querySelector('input[name="quantity[]"]').value || 0;
            var price = row.querySelector('input[name="price[]"]').value || 0;
            var total = row.querySelector('input[name="total[]"]');

            // Update the total for the row
            total.value = (quantity * price).toFixed(2);

            // Update the total amount for all products
            updateTotalAmount();
        }

        // Function to update the total amount
        function updateTotalAmount() {
            var totalAmount = 0;
            var totals = document.querySelectorAll('input[name="total[]"]');
            totals.forEach(function (total) {
                totalAmount += parseFloat(total.value) || 0;
            });
            document.getElementById('totalAmount').value = totalAmount.toFixed(2);
        }
    </script>
@endsection