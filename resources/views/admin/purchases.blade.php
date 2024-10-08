@extends('layouts.app')

@section('content')
    <h2>Purchases</h2>

    <table class="table">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Total Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchases as $purchase)
                <tr>
                    <td>{{ $purchase->user_name }}</td>
                    <td>${{ $purchase->total_price }}</td>
                    <td>{{ $purchase->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
