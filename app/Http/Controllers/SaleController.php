<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function create()
    {
        $products = Product::query()
            ->where('stock_quantity', '>', 0)
            ->orderBy('name')
            ->get();

        $customers = Customer::query()
            ->orderBy('full_name')
            ->get();

        return view('sales.create', compact('products', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated, $request) {
            $product = Product::query()
                ->lockForUpdate()
                ->findOrFail($validated['product_id']);

            if ($validated['quantity'] > $product->stock_quantity) {
                throw ValidationException::withMessages([
                    'quantity' => "Insufficient stock. Only {$product->stock_quantity} item(s) are available.",
                ]);
            }

            $totalPrice = round(
                (float) $product->price * $validated['quantity'],
                2
            );

            Sale::create([
                'product_id' => $product->id,
                'customer_id' => $validated['customer_id'] ?? null,
                'sold_by' => $request->user()->id,
                'quantity' => $validated['quantity'],
                'total_price' => $totalPrice,
            ]);

            $product->decrement(
                'stock_quantity',
                $validated['quantity']
            );
        });

        return redirect()
            ->route('sales.history')
            ->with('success', 'Sale recorded successfully.');
    }

    public function history()
    {
        $sales = Sale::query()
            ->with(['product', 'customer', 'staff'])
            ->latest()
            ->paginate(10);

        return view('sales.history', compact('sales'));
    }
}