@extends('layouts.default')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Transactions</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4 card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaction Data</h6>
            <a href="{{ route('transactions.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add Transaction</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTransactions" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Transaction</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->transaction_total, 2) }}</td>
                            <td>
                                @if ($item->status == 'PENDING')
                                <span class="badge badge-info">PENDING</span>
                                @elseif ($item->status == 'SUCCESS')
                                <span class="badge badge-success">SUCCESS</span>
                                @elseif ($item->status == 'FAILED')
                                <span class="badge badge-danger">FAILED</span>
                                @else
                                <span>{{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                {{-- <a href='#mymodal' data-remote="{{ route('transactions.show', $item->id) }}" data-toggle="modal" data-target="#mymodal" data-title="Transactions Details {{ $item->id }}" class='btn btn-info btn-sm'>
                                    <i class='fa fa-eye'></i>
                                </a> --}}

                                <a href='{{ route('transactions.edit', $item->id) }}' class='btn btn-primary btn-sm'>
                                    <i class='fa fa-pencil'></i>
                                </a>
                                <form action="{{ route('transactions.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center p-5">"There are no data"</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection