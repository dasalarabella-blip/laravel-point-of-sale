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
        value="{{ old('full_name', $user?->full_name) }}"
        required
    >

    @error('full_name')
        <p class="field-error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="username">Username</label>

    <input
        id="username"
        name="username"
        type="text"
        maxlength="50"
        value="{{ old('username', $user?->username) }}"
        required
        autocomplete="username"
    >

    @error('username')
        <p class="field-error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="password">
        Password
    </label>

    <input
        id="password"
        name="password"
        type="password"
        {{ $user ? '' : 'required' }}
        autocomplete="new-password"
    >

    @if ($user)
        <small>
            Leave this blank to keep the existing password.
        </small>
    @else
        <small>
            The password must contain at least 8 characters.
        </small>
    @endif

    @error('password')
        <p class="field-error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="password_confirmation">
        Confirm Password
    </label>

    <input
        id="password_confirmation"
        name="password_confirmation"
        type="password"
        {{ $user ? '' : 'required' }}
        autocomplete="new-password"
    >
</div>

<div class="form-group">
    <label for="avatar">Profile Picture</label>

    <input
        id="avatar"
        name="avatar"
        type="file"
        accept=".jpg,.jpeg,.png,.webp"
    >

    <small>
        Allowed: JPG, PNG, or WebP. Maximum size: 2 MB.
        The image will be prepared as a 300 × 300 WebP avatar.
    </small>

    @error('avatar')
        <p class="field-error">{{ $message }}</p>
    @enderror

    @if ($user?->avatar)
        <div class="current-image">
            <p>Current profile picture:</p>

            <img
                class="avatar-preview"
                src="{{ Storage::url($user->avatar) }}"
                alt="{{ $user->full_name }}"
            >
        </div>
    @endif
</div>

<div class="form-actions">
    <a
        class="button button-secondary"
        href="{{ route('users.index') }}"
    >
        Cancel
    </a>

    <button class="button" type="submit">
        {{ $submitLabel }}
    </button>
</div>