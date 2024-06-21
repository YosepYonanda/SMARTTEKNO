@extends('layouts.default')
@section('content')
<div class="card m-auto w-75">
    <div class="card-header">
        <strong>Edit Transaction</strong>
        <small>{{ $item->name }}</small>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('transactions.update', $item->id) }}" method='post'>
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name" class="form-control-label">Name</label>
                <input type="text" name="name" value="{{ old('name') ? old('name') : $item->name }}" class="form-control @error('name') is-invalid @enderror" />
                @error('name') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="product_id" class="form-control-label">Product</label>
                <select name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                    <option value="">Select Product</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}" {{ (old('product_id') ? old('product_id') : $item->product_id) == $product->id ? 'selected' : '' }}>
                {{ $product->name }}
            </option>
                    @endforeach
                </select>
                @error('product_id') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="quantity" class="form-control-label">Quantity</label>
                <input type="number" name="quantity" value="{{ old('quantity') ? old('quantity') : $item->quantity }}" class="form-control @error('quantity') is-invalid @enderror" />
                @error('quantity') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label for="status" class="form-control-label">Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="PENDING" {{ (old('status') ? old('status') : $item->status) == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                    <option value="SUCCESS" {{ (old('status') ? old('status') : $item->status) == 'SUCCESS' ? 'selected' : '' }}>SUCCESS</option>
                    <option value="FAILED" {{ (old('status') ? old('status') : $item->status) == 'FAILED' ? 'selected' : '' }}>FAILED</option>
                </select>
                @error('status') <div class="text-muted">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Edit Transaction</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
