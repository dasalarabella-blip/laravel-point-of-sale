@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>Staff Accounts</h1>
            <p>Manage staff login details and profile pictures.</p>
        </div>

        <a class="button" href="{{ route('users.create') }}">
            Add Staff
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->has('delete'))
        <div class="alert alert-error">
            {{ $errors->first('delete') }}
        </div>
    @endif

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                        <tr>
                            <td>
                                <img src="{{ $user->avatar
                    ? Storage::url($user->avatar)
                    : asset('images/avatar-placeholder.svg') }}" alt="{{ $user->full_name }}" style="
                                    display: block;
                                    width: 55px;
                                    height: 55px;
                                    min-width: 55px;
                                    max-width: 55px;
                                    border-radius: 50%;
                                    object-fit: cover;
                                ">
                            </td>

                            <td>
                                <div class="staff-name">
                                    <a href="{{ route('users.show', $user) }}">
                                        {{ $user->full_name }}
                                    </a>

                                </div>
                                </td>

                                <td>{{ $user->username }}</td>

                                <td>
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>

                                <td>
                                    <div class="table-actions">
                                        <a class="button button-secondary" href="{{ route('users.edit', $user) }}">
                                            Edit
                                        </a>

                                        @if (auth()->id() !== $user->id)
                                            <form method="POST" action="{{ route('users.destroy', $user) }}"
                                                onsubmit="return confirm('Delete this staff account?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="button button-danger" type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                        </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            No staff accounts were found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
@endsection