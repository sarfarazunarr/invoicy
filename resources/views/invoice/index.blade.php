@extends('layouts.app')

@section('title', 'Invoices')

@section('content')
@guest
    @php
        return redirect()->route('login');
    @endphp
@endguest

<div class="container mx-auto px-4 py-8 h-[89vh]">

    <!-- Invoice List -->
    <h2 class="text-2xl text-white font-bold mb-4">Invoices</h2>
    <table class="w-full bg-gray-800 shadow-md rounded">
        <thead>
            <tr class="bg-gray-700 text-white">
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Phone</th>
                <th class="px-4 py-2">Payment Method</th>
                <th class="px-4 py-2">Payment Status</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr class="border-b border-gray-700 text-white">
                    <td class="px-4 py-2 capitalize text-center">{{ $invoice->name }}</td>
                    <td class="px-4 py-2 text-center">{{ $invoice->email }}</td>
                    <td class="px-4 py-2 capitalize text-center">{{ $invoice->phone }}</td>
                    <td class="px-4 py-2 capitalize text-center">{{ $invoice->payment_method }}</td>
                    <td class="px-4 py-2 capitalize text-center">{{ $invoice->payment_status }}</td>
                    <td class="px-4 py-2 capitalize text-center">
                        <div class="flex space-x-2">
                            <a href="{{ route('invoice.show', $invoice->id) }}"
                                class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-1 px-2 rounded text-sm">View</a>
                            <a href="{{ route('invoice.edit', ['id' => $invoice->id]) }}"
                                class="bg-green-600 hover:bg-green-800 text-white font-bold py-1 px-2 rounded text-sm">Edit</a>
                            <form action="{{ route('invoice.destroy', $invoice->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-800 text-white font-bold py-1 px-2 rounded text-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table></div>
@endsection