@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Add Customer</h1>
            <p>Enter the customer contact information.</p>
        </div>
    </div>

    <form
        class="form-card"
        method="POST"
        action="{{ route('customers.store') }}"
    >
        @csrf

        @include('customers._form', [
            'customer' => null,
            'submitLabel' => 'Save Customer',
        ])
    </form>
@endsection