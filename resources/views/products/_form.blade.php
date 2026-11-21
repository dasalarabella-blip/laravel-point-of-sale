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

<div class="form-group">
    <label for="name">Product Name</label>

    <input
        id="name"
        name="name"
        type="text"
        maxlength="100"
        value="{{ old('name', $product?->name) }}"
        required
    >

    @error('name')
        <p class="field-error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="price">Price</label>

    <input
        id="price"
        name="price"
        type="number"
        min="0"
        step="0.01"
        value="{{ old('price', $product?->price) }}"
        required
    >

    @error('price')
        <p class="field-error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="stock_quantity">Stock Quantity</label>

    <input
        id="stock_quantity"
        name="stock_quantity"
        type="number"
        min="0"
        step="1"
        value="{{ old('stock_quantity', $product?->stock_quantity ?? 0) }}"
        required
    >

    @error('stock_quantity')
        <p class="field-error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="image">Product Image</label>

    <input
        id="image"
        name="image"
        type="file"
        accept=".jpg,.jpeg,.png,.webp"
    >

    <small>
        Allowed: JPG, PNG, or WebP. Maximum size: 2 MB.
        The image will be prepared as a 600 × 600 WebP copy.
    </small>

    @error('image')
        <p class="field-error">{{ $message }}</p>
    @enderror

    @if ($product?->image)
        <div class="current-image">
            <p>Current image:</p>

            <img
                class="product-preview"
                src="{{ Storage::url($product->image) }}"
                alt="{{ $product->name }}"
            >
        </div>
    @endif
</div>

<div class="form-actions">
    <a
        class="button button-secondary"
        href="{{ route('products.index') }}"
    >
        Cancel
    </a>

    <button class="button" type="submit">
        {{ $submitLabel }}
    </button>
</div>
