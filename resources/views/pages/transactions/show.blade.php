<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <td> {{ $item->name }} </td>
    </tr>
    <tr>
        <th>Email</th>
        <td> {{ $item->email }} </td>
    </tr>
    <tr>
        <th>Phone</th>
        <td> {{ $item->number }} </td>
    </tr>
    <tr>
        <th>Address</th>
        <td> {{ $item->address }} </td>
    </tr>
    <tr>
        <th>Transaction Total</th>
        <td> {{ $item->transaction_total }} </td>
    </tr>
    <tr>
        <th>Transaction Status</th>
        <td> {{ $item->transaction_status }} </td>
    </tr>
    <tr>
        <th>Ticket Detaiis</th>
        <td>
            <table class="table table-bordered w-100">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
                </tr>
                @foreach($item->details as $detail)
                <tr>
                    @if ($detail->ticket)
                    <td> {{ $detail->ticket->name }} </td>
                    <td> {{ $detail->ticket->type }} </td>
                    <td> {{ $detail->ticket->price }} </td>
                    @else
                        <td colspan="3">Product not found</td>
                    @endif
                </tr>
                @endforeach
            </table>
            {{-- <div class="row">
                <div class="col-4">
                    <a href="{{ route('transactions.status', $item->id) }}?status=SUCCESS" class="btn btn-success btn-block">
                        <i class="fa fa-check"></i>
                        SET SUCCESS
                    </a>
                </div>
                <div class="col-4">
                    <a href="{{ route('transactions.status', $item->id) }}?status=FAILED" class="btn btn-danger btn-block">
                        <i class="fa fa-check"></i>
                        SET GAGAL
                    </a>
                </div>
                <div class="col-4">
                    <a href="{{ route('transactions.status', $item->id) }}?status=PENDING" class="btn btn-info btn-block">
                        <i class="fa fa-check"></i>
                        SET PENDING
                    </a>
                </div>
            </div> --}}
        </td>
    </tr>
</table>
