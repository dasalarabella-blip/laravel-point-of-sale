@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Edit Staff Account</h1>
            <p>Update {{ $user->full_name }}’s account information.</p>
        </div>
    </div>

    <form
        class="form-card"
        method="POST"
        action="{{ route('users.update', $user) }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        @include('users._form', [
            'user' => $user,
            'submitLabel' => 'Update Staff',
        ])
    </form>
@endsection