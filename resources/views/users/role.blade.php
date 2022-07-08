@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 ">
                <div class="card">
                    <div class="card-header bg-info">
                        <div>Name: {{ $user->name }}</div>
                        <div>Email: {{ $user->email }}</div>
                    </div>
                    <br>
                    <br>
                    <div class="card-header bg-info">
                        <h6 class="text-white">User Roles</h6>
                    </div>
                    <div>
                        @if ($user->roles)
                            @foreach ($user->roles as $user_role)
                                <form action="{{ route('users_remove_role', [$user->id, $user_role->id]) }}"
                                    method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-icon btn-danger waves-effect waves-light mb-2"
                                        data-toggle="tooltip" data-placement="top" title="remove role"
                                        data-original-title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this item')">
                                        {{ $user_role->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <br>
                    <br>
                    <form method="post" action="{{ route('users_add_role', [$user->id]) }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label>Roles</label>
                            <select data-live-search="true" class="form-control " name="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-success">Assign Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    </body>
@endsection
