@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header roles-header">
                    Logbook
                    <div class="edit-toggle" data-toggle="modal" data-target="#rolesCreateModal">Create New Role</div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Role Name</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td><i class="fas fa-edit edit-toggle" data-toggle="modal" data-target="#rolesEditModal_{{ $role->id }}"></i></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="rolesCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Create Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/roles" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-lg-3" for="rolename">Role Name</label>
                                <div class="input-group col-lg-9">
                                    <input id="rolename" class="col-lg-9 form-control" type="text" name="rolename" placeholder="Role Name...">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Create Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach($roles as $role)
        <div class="modal fade" id="rolesEditModal_{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/roles/{{ $role->id }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-lg-3" for="rolename">Role Name</label>
                                <div class="input-group col-lg-9">
                                    <input id="rolename" class="col-lg-9 form-control" type="text" name="rolename" value="{{ $role->name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3">Remove Role</label>
                                <div class="col-lg-9">
                                    <p class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#rolesRemoveModal_{{ $role->id }}">Remove</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="rolesRemoveModal_{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Are you sure?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/roles/{{ $role->id }}/destroy" method="POST">
                        @csrf
                        <div class="modal-body">
                            <p>
                                Are you sure you want to remove this role?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Remove Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
