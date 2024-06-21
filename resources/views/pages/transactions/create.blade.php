@extends('layouts.default')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Add Transaction</h1>

    <!-- Form for Adding Transaction -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaction Data</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-control-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" />
                    @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="product_id" class="form-control-label">Product</label>
                    <select name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    @error('product_id') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="quantity" class="form-control-label">Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" class="form-control @error('quantity') is-invalid @enderror" />
                    @error('quantity') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="status" class="form-control-label">Status</label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                        <option value="PENDING">PENDING</option>
                        <option value="SUCCESS">SUCCESS</option>
                        <option value="FAILED">FAILED</option>
                    </select>
                    @error('status') <div class="text-muted">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Add Transaction</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection