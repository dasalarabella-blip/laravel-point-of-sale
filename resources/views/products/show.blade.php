@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>{{ $product->name }}</h1>
            <p>Product details</p>
        </div>

        <div class="table-actions">
            <a
                class="button button-secondary"
                href="{{ route('products.index') }}"
            >
                Back
            </a>

            <a
                class="button"
                href="{{ route('products.edit', $product) }}"
            >
                Edit Product
            </a>
        </div>
    </div>

    <div class="product-detail-card">
        <div>
            @if ($product->image)
                <img
                    class="product-detail-image"
                    src="{{ Storage::url($product->image) }}"
                    alt="{{ $product->name }}"
                >
            @else
                <div class="product-placeholder">
                    No product image
                </div>
            @endif
        </div>

        <div class="product-information">
            <div class="detail-row">
                <strong>Product Name</strong>
                <span>{{ $product->name }}</span>
            </div>

            <div class="detail-row">
                <strong>Price</strong>
                <span>₱{{ number_format($product->price, 2) }}</span>
            </div>

            <div class="detail-row">
                <strong>Available Stock</strong>
                <span>{{ $product->stock_quantity }}</span>
            </div>

            <div class="detail-row">
                <strong>Date Added</strong>
                <span>
                    {{ $product->created_at->format('F d, Y h:i A') }}
                </span>
            </div>
        </div>
    </div>
@endsection