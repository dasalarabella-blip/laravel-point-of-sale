@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>{{ $user->full_name }}</h1>
            <p>Staff account details</p>
        </div>

        <div class="table-actions">
            <a
                class="button button-secondary"
                href="{{ route('users.index') }}"
            >
                Back
            </a>

            <a
                class="button"
                href="{{ route('users.edit', $user) }}"
            >
                Edit Staff
            </a>
        </div>
    </div>

    <div class="staff-detail-card">
        <div>
            <img
                class="staff-detail-avatar"
                src="{{ $user->avatar
                    ? Storage::url($user->avatar)
                    : asset('images/avatar-placeholder.svg') }}"
                alt="{{ $user->full_name }}"
            >
        </div>

        <div class="staff-information">
            <div class="detail-row">
                <strong>Full Name</strong>
                <span>{{ $user->full_name }}</span>
            </div>

            <div class="detail-row">
                <strong>Username</strong>
                <span>{{ $user->username }}</span>
            </div>

            <div class="detail-row">
                <strong>Account Status</strong>

                <span>
                    @if (auth()->id() === $user->id)
                        Currently logged-in account
                    @else
                        Active staff account
                    @endif
                </span>
            </div>

            <div class="detail-row">
                <strong>Date Created</strong>

                <span>
                    {{ $user->created_at->format('F d, Y h:i A') }}
                </span>
            </div>

            <div class="detail-row">
                <strong>Last Updated</strong>

                <span>
                    {{ $user->updated_at->format('F d, Y h:i A') }}
                </span>
            </div>
        </div>
    </div>
@endsection 