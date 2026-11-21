@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Edit Customer</h1>
            <p>Update {{ $customer->full_name }}’s information.</p>
        </div>
    </div>

    <form
        class="form-card"
        method="POST"
        action="{{ route('customers.update', $customer) }}"
    >
        @csrf
        @method('PUT')

        @include('customers._form', [
            'customer' => $customer,
            'submitLabel' => 'Update Customer',
        ])
    </form>
@endsection