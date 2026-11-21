@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Add Staff Account</h1>
            <p>Create a new staff login and profile.</p>
        </div>
    </div>

    <form
        class="form-card"
        method="POST"
        action="{{ route('users.store') }}"
        enctype="multipart/form-data"
    >
        @csrf

        @include('users._form', [
            'user' => null,
            'submitLabel' => 'Create Staff',
        ])
    </form>
@endsection