<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = Transaction::with('product')->get();
        return view('pages.transactions.index')->with([
            'items' => $items
        ]);
    }

    public function create()
    {
        $products = Product::all();
        return view('pages.transactions.create', compact('products'));
    }

    public function store(TransactionRequest $request)
{
    $product = Product::findOrFail($request->product_id);

    if ($request->status === 'SUCCESS') {
        if ($product->quantity < $request->quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Not enough stock available.']);
        }
    }

    DB::transaction(function () use ($request, $product) {
        $transactionTotal = $product->price * $request->quantity;

        // Create the transaction
        $transaction = Transaction::create([
            'name' => $request->name,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'transaction_total' => $transactionTotal,
            'status' => $request->status,
            'uuid' => (string) Str::uuid(), // Tambahkan UUID
        ]);

        // Decrease the product quantity if status is SUCCESS
        if ($request->status === 'SUCCESS') {
            $product->decrement('quantity', $request->quantity);
        }
    });

    return redirect()->route('transactions.index')->with('success', 'Transaction added successfully.');
}


    public function edit(string $id)
    {
        $products = Product::all();
        $item = Transaction::findOrFail($id);
        
        return view('pages.transactions.edit', compact('products'))->with([
            'item' => $item,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(TransactionRequest $request, string $id)
{
    $item = Transaction::findOrFail($id);
    $product = Product::findOrFail($request->product_id);

    // Menghitung perbedaan quantity
    $quantityDifference = $request->quantity - $item->quantity;
    $statusChangedToSuccess = $request->status === 'SUCCESS' && $item->status !== 'SUCCESS';
    $statusChangedFromSuccess = $request->status !== 'SUCCESS' && $item->status === 'SUCCESS';

    DB::transaction(function () use ($request, $item, $product, $quantityDifference, $statusChangedToSuccess, $statusChangedFromSuccess) {
        if ($statusChangedToSuccess) {
            // Jika status berubah menjadi SUCCESS
            if ($product->quantity < $request->quantity) {
                return redirect()->back()->withErrors(['quantity' => 'Not enough stock available.']);
            }
            $product->decrement('quantity', $request->quantity);
        } elseif ($statusChangedFromSuccess) {
            // Jika status berubah dari SUCCESS ke status lain
            $product->increment('quantity', $item->quantity);
        } elseif ($request->status === 'SUCCESS' && $quantityDifference != 0) {
            // Jika status tetap SUCCESS dan quantity berubah
            if ($quantityDifference > 0) {
                if ($product->quantity < $quantityDifference) {
                    return redirect()->back()->withErrors(['quantity' => 'Not enough stock available.']);
                }
                $product->decrement('quantity', $quantityDifference);
            } else {
                $product->increment('quantity', abs($quantityDifference));
            }
        }

        // Update transaction
        $transactionTotal = $product->price * $request->quantity;
        $item->update([
            'name' => $request->name,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'transaction_total' => $transactionTotal,
            'status' => $request->status,
        ]);
    });

    return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
}

    public function show(string $id)
    {
        $item = Transaction::with('details.product')->findOrFail($id);
        return view('pages.transactions.show')->with([
            'item' => $item
        ]);
    }
    
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }

    // Other methods...
}
