<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function create()
    {
        return view('invoice.create');
    }

    public function store(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'product_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);

        // Create a new invoice
        $invoice = new Invoice();
        $invoice->user_id = auth()->user()->id;
        $invoice->name = $request->input('name');
        $invoice->email = $request->input('email');
        $invoice->phone = $request->input('phone');
        $invoice->total = $request->input('totalAmount');
        $invoice->payment_method = $request->input('payment_method');
        $invoice->payment_status = $request->input('payment_status');
        $invoice->save();

        // Loop through each product and create a new InvoiceProduct
        foreach ($request->input('product_name') as $i => $productName) {
            $invoiceProduct = new InvoiceProduct();
            $invoiceProduct->invoice_id = $invoice->id;
            $invoiceProduct->product_name = $productName;
            $invoiceProduct->quantity = $request->input('quantity')[$i];
            $invoiceProduct->subprice = $request->input('price')[$i];
            $invoiceProduct->total_price = $request->input('total')[$i];
            $invoiceProduct->save();
        }

        return redirect()->route('invoices');
    }
    public function index()
    {
        $invoices = Invoice::where('user_id', auth()->user()->id)->get();
        return view('invoice.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);  // Find the invoice or fail if not found
        $products = $invoice->products;  // Retrieve the associated products using the defined relationship
        return view('invoice.show', compact('invoice', 'products'));
    }

    public function edit($id)
    {
        $invoice = Invoice::find($id);
        return view('invoice.edit', compact('invoice'));
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->name = $request->input('name');
        $invoice->email = $request->input('email');
        $invoice->phone = $request->input('phone');
        $invoice->total = $request->input('totalAmount');
        $invoice->payment_method = $request->input('payment_method');
        $invoice->payment_status = $request->input('payment_status');
        $invoice->save();

        foreach ($request->input('products') as $productData) {
            $invoiceProduct = InvoiceProduct::find($productData['id']);
            $invoiceProduct->product_name = $productData['name'];
            $invoiceProduct->quantity = $productData['quantity'];
            $invoiceProduct->subprice = $productData['price']; 
            $invoiceProduct->total_price = $productData['total'];
            $invoiceProduct->save();
        }
        
        return redirect()->route('invoices');
    }

    public function destroy($id)
    {
        Invoice::destroy($id);
        return redirect()->route('invoices');
    }
}