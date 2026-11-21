@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Edit Product</h1>
            <p>Update {{ $product->name }}.</p>
        </div>
    </div>

    <form
        class="form-card"
        method="POST"
        action="{{ route('products.update', $product) }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('products._form', [
            'product' => $product,
            'submitLabel' => 'Update Product',
        ])
    </form>
@endsection