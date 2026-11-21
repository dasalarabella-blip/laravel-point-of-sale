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
    <label for="full_name">Full Name</label>

    <input
        id="full_name"
        name="full_name"
        type="text"
        maxlength="100"
        value="{{ old('full_name', $customer?->full_name) }}"
        required
    >

    @error('full_name')
        <p class="field-error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="email">Email</label>

    <input
        id="email"
        name="email"
        type="email"
        maxlength="100"
        value="{{ old('email', $customer?->email) }}"
        required
    >

    @error('email')
        <p class="field-error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="phone">Phone</label>

    <input
        id="phone"
        name="phone"
        type="text"
        maxlength="20"
        value="{{ old('phone', $customer?->phone) }}"
    >

    <small>Optional. Maximum 20 characters.</small>

    @error('phone')
        <p class="field-error">{{ $message }}</p>
    @enderror
</div>

<div class="form-actions">
    <a class="button button-secondary" href="{{ route('customers.index') }}">
        Cancel
    </a>

    <button class="button" type="submit">
        {{ $submitLabel }}
    </button>
</div>