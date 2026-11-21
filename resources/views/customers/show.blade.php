@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <h1>{{ $customer->full_name }}</h1>
            <p>Customer details</p>
        </div>

        <div class="table-actions">
            <a class="button button-secondary"
               href="{{ route('customers.index') }}">
                Back
            </a>

            <a class="button"
               href="{{ route('customers.edit', $customer) }}">
                Edit Customer
            </a>
        </div>
    </div>

    <div class="product-detail-card">
        <div class="product-information">
            <div class="detail-row">
                <strong>Full Name</strong>
                <span>{{ $customer->full_name }}</span>
            </div>

            <div class="detail-row">
                <strong>Email</strong>
                <span>{{ $customer->email }}</span>
            </div>

            <div class="detail-row">
                <strong>Phone</strong>
                <span>{{ $customer->phone ?: 'Not provided' }}</span>
            </div>

            <div class="detail-row">
                <strong>Date Added</strong>
                <span>
                    {{ $customer->created_at->format('F d, Y h:i A') }}
                </span>
            </div>
        </div>
    </div>
@endsection