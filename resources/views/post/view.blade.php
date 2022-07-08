@extends('layouts.app')
@section('content')
    <!-- dataTable starts -->
    <!-- Zero configuration table -->
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Post <small class="text-muted">List</small></h4>
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
                                            <th><i class="fa fa-calendar"></i> Title</th>
                                            <th><i class="fa fa-info"></i> Body</th>
                                            <th><i class="fa fa-cog"></i> Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($posts) > 0)
                                            @foreach ($posts as $post)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $post['title'] }}</td>
                                                    <td>{{ $post['body'] }}</td>
                                                    @can('edit post')
                                                    <td class="row">
                                                        <form action="{{ route('edit_post') }}"
                                                            method="get">
                                                            <input type="hidden" name="post"
                                                            value="{{ $post['id'] }}">
                                                            <button type="submit"
                                                                class="btn btn-icon btn-primary mr-1 waves-effect waves-light"
                                                                data-toggle="tooltip" data-placement="top" title="edit"
                                                                data-original-title="Edit">
                                                                <i class="feather icon-edit"></i>Edit</button>
                                                        </form>
                                                    </td>
                                                    @endcan
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
                                            <th><i class="fa fa-calendar"></i>Title</th>
                                            <th><i class="fa fa-info"></i> Body</th>
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
