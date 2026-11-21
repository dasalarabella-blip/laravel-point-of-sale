@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Customers</h1>
            <p>Manage customer contact information.</p>
        </div>

        <a class="button" href="{{ route('customers.create') }}">
            Add Customer
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
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td>
                            <a href="{{ route('customers.show', $customer) }}">
                                {{ $customer->full_name }}
                            </a>
                        </td>

                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone ?: '—' }}</td>
                        <td>{{ $customer->created_at->format('M d, Y') }}</td>

                        <td>
                            <div class="table-actions">
                                <a class="button button-secondary"
                                   href="{{ route('customers.edit', $customer) }}">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('customers.destroy', $customer) }}"
                                      onsubmit="return confirm('Delete this customer?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="button button-danger" type="submit">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No customers have been added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $customers->links() }}
    </div>
@endsection