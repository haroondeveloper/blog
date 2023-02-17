@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}

                        <p><a href="{{ route('roles.create') }}">Create new role</a></p>
                        <p><a href="{{ route('permissions.create') }}">Create new permission</a></p>
                            <p><a href="{{ route('customers.create') }}">Create new customer</a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
