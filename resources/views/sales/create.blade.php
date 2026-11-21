@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Record Sale</h1>
            <p>Select a product, customer, and quantity.</p>
        </div>

        <a
            class="button button-secondary"
            href="{{ route('sales.history') }}"
        >
            View Sales History
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            <strong>Please correct the following errors:</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($products->isEmpty())
        <div class="alert alert-error">
            There are no products with available stock. Add or restock a
            product before recording a sale.
        </div>
    @endif

    <form
        class="form-card"
        method="POST"
        action="{{ route('sales.store') }}"
    >
        @csrf

        <div class="form-group">
            <label for="product_id">Product</label>

            <select
                id="product_id"
                name="product_id"
                required
                {{ $products->isEmpty() ? 'disabled' : '' }}
            >
                <option value="">Select a product</option>

                @foreach ($products as $product)
                    <option
                        value="{{ $product->id }}"
                        data-price="{{ $product->price }}"
                        data-stock="{{ $product->stock_quantity }}"
                        @selected(old('product_id') == $product->id)
                    >
                        {{ $product->name }}
                        - ₱{{ number_format($product->price, 2) }}
                        (Stock: {{ $product->stock_quantity }})
                    </option>
                @endforeach
            </select>

            @error('product_id')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="customer_id">Customer</label>

            <select id="customer_id" name="customer_id">
                <option value="">Walk-in Customer</option>

                @foreach ($customers as $customer)
                    <option
                        value="{{ $customer->id }}"
                        @selected(old('customer_id') == $customer->id)
                    >
                        {{ $customer->full_name }}
                    </option>
                @endforeach
            </select>

            <small>
                Leave this as Walk-in Customer if no registered customer is selected.
            </small>

            @error('customer_id')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>

            <input
                id="quantity"
                name="quantity"
                type="number"
                min="1"
                step="1"
                value="{{ old('quantity', 1) }}"
                required
            >

            @error('quantity')
                <p class="field-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="sale-summary">
            <p>
                Available stock:
                <strong id="available-stock">Select a product</strong>
            </p>

            <p>
                Estimated total:
                <strong id="estimated-total">₱0.00</strong>
            </p>
        </div>

        <div class="form-actions">
            <button
                class="button"
                type="submit"
                {{ $products->isEmpty() ? 'disabled' : '' }}
            >
                Record Sale
            </button>
        </div>
    </form>

    <script>
        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const stockDisplay = document.getElementById('available-stock');
        const totalDisplay = document.getElementById('estimated-total');

        function updateSaleSummary() {
            const selectedOption =
                productSelect.options[productSelect.selectedIndex];

            const price = Number(selectedOption?.dataset.price || 0);
            const stock = Number(selectedOption?.dataset.stock || 0);
            const quantity = Number(quantityInput.value || 0);

            stockDisplay.textContent = productSelect.value
                ? stock
                : 'Select a product';

            totalDisplay.textContent =
                '₱' + (price * quantity).toFixed(2);

            if (productSelect.value) {
                quantityInput.max = stock;
            } else {
                quantityInput.removeAttribute('max');
            }
        }

        productSelect.addEventListener('change', updateSaleSummary);
        quantityInput.addEventListener('input', updateSaleSummary);

        updateSaleSummary();
    </script>
@endsection