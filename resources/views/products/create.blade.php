@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Add Product</h1>
            <p>Enter the product information and starting stock.</p>
        </div>
    </div>

    <form
        class="form-card"
        method="POST"
        action="{{ route('products.store') }}"
        enctype="multipart/form-data"
    >
        @csrf

        @include('products._form', [
            'product' => null,
            'submitLabel' => 'Save Product',
        ])
    </form>
@endsection