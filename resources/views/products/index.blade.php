@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Products</h1>
            <p>Manage product prices, stock, and images.</p>
        </div>

        <a class="button" href="{{ route('products.create') }}">
            Add Product
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
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            @if ($product->image)
                                <img
                                    class="product-thumbnail"
                                    src="{{ Storage::url($product->image) }}"
                                    alt="{{ $product->name }}"
                                >
                            @else
                                <span>No image</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('products.show', $product) }}">
                                {{ $product->name }}
                            </a>
                        </td>

                        <td>
                            ₱{{ number_format($product->price, 2) }}
                        </td>

                        <td>
                            {{ $product->stock_quantity }}
                        </td>

                        <td>
                            <div class="table-actions">
                                <a
                                    class="button button-secondary"
                                    href="{{ route('products.edit', $product) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('products.destroy', $product) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this product?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="button button-danger"
                                        type="submit"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            No products have been added yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $products->links() }}
    </div>
@endsection