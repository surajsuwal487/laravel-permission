@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 ">
                <div class="card">
                    <div class="card-header bg-info">
                        <h6 class="text-white">Eidt Role</h6>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('update_role') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $role->id }}">
                            <div class="form-group">
                                <label>Role Name </label>
                                <input type="text" name="name" class="form-control" autocomplete="off"
                                    value="{{ $role->name }}" />
                                @error('name')
                                    <span style="color: red;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-center" style="margin-top: 10px;">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-header bg-info">
                        <h6 class="text-white">Role Permissions</h6>
                    </div>
                    <div>
                        @if ($role->permissions)
                            @foreach ($role->permissions as $role_permission)
                                <form action="{{ route('role_permissions_delete',[$role->id, $role_permission->id]) }}"
                                    method="get">
                                    @csrf
                                    <button type="submit" class="btn btn-icon btn-danger waves-effect waves-light mb-2"
                                        data-toggle="tooltip" data-placement="top" title="remove permission"
                                        data-original-title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this item')">
                                        {{ $role_permission->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <br>
                    <br>
                    <form method="post" action="{{ route('role_permissions_add') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $role->id }}">
                        <div class="form-group">
                            <label>Permission</label>
                            <select data-live-search="true" class="form-control "
                                name="permission">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-success">Assign Permission</button>
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
