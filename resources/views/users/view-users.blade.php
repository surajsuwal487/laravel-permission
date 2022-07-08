@extends('layouts.app')
@section('content')
    <!-- dataTable starts -->
    <!-- Zero configuration table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users <small class="text-muted">List</small></h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            <div class="">
                                <table class="table zero-configuration" id='categorytable'>
                                    @role('writer|admin')
                                        <a href="{{ route('create_post') }}" class="link">Create
                                            New</a>
                                    @endrole
                                    {{-- {{ dd(auth()->user()->getRoleNames()) }} --}}
                                    <thead>
                                        <tr>
                                            <th><i class=""></i> SN</th>
                                            <th><i class="fa fa-calendar"></i> Name</th>
                                            <th><i class="fa fa-info"></i> Email</th>
                                            <th><i class="fa fa-cog"></i> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($users) > 0)
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user['name'] }}</td>
                                                    <td>{{ $user['email'] }}</td>
                                                    <td>
                                                      <div >
                                                         <form action="{{ route('show_user', $user->id) }}" method="get">
                                                             @csrf
                                                             <button type="submit"
                                                                 class="btn btn-icon btn-primary waves-effect waves-light mb-2"
                                                                 data-toggle="tooltip" data-placement="top"
                                                                 title="remove permission"
                                                                 data-original-title="Delete">Role</button>
                                                         </form>
                                                         <form action="" method="get">
                                                             @csrf
                                                             <button type="submit"
                                                                 class="btn btn-icon btn-primary waves-effect waves-light mb-2"
                                                                 data-toggle="tooltip" data-placement="top" title="Role"
                                                                 data-original-title="Delete">Permisson</button>
                                                         </form>
                                                      </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>Empty</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><i class=""></i> SN</th>
                                            <th><i class="fa fa-calendar"></i>Name</th>
                                            <th><i class="fa fa-info"></i> Email</th>
                                            <th><i class="fa fa-cog"></i> Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    </section>
    <!--/ Zero configuration table -->
    <!-- dataTable ends -->
@endsection
