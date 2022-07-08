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
                </div>
            </div>
            <a href="{{ route('view_posts') }}" class="link">View Posts</a>
            <br>
            <a href="{{ route('view_roles') }}" class="link">View Role</a>
            <br>
            <a href="{{ route('view_permissions') }}" class="link">View Permission</a>
            <br>
            <a href="{{ route('view_users') }}" class="link">View Users</a>
            
        </div>
    </div>
</div>
@endsection
