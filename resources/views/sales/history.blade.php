@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Sales History</h1>
            <p>View all recorded sales transactions.</p>
        </div>

        <a class="button" href="{{ route('sales.create') }}">
            Record New Sale
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Sale ID</th>
                    <th>Date and Time</th>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Recorded By</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($sales as $sale)
                    <tr>
                        <td>#{{ $sale->id }}</td>

                        <td>
                            {{ $sale->created_at->format('M d, Y h:i A') }}
                        </td>

                        <td>
                            {{ $sale->product->name }}
                        </td>

                        <td>
                            {{ $sale->customer?->full_name ?? 'Walk-in Customer' }}
                        </td>

                        <td>
                            {{ $sale->quantity }}
                        </td>

                        <td>
                            ₱{{ number_format($sale->total_price, 2) }}
                        </td>

                        <td>
                            {{ $sale->staff->full_name }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            No sales have been recorded yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $sales->links() }}
    </div>
@endsection