@extends('layouts.app')

@section('content')
    <div id="single-project" class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Project: {{ $project->name }}
                        <i class="fas fa-edit edit-toggle" data-toggle="modal" data-target="#projectEditModal"></i>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Project name: </td>
                                    <td>{{ $project->name }}</td>
                                </tr>
                                <tr>
                                    <td>Customer name: </td>
                                    <td>{{ $project->customer->companyname }}</td>
                                </tr>
                                <tr>
                                    <td>Description: </td>
                                    <td>{{ $project->description }}</td>
                                </tr>
                                <tr>
                                    <td>Budget: </td>
                                    <td>{{ $project->budget }}</td>
                                </tr>
                                <tr>
                                    <td>Spent: </td>
                                    <td>{{ $project->spent }}</td>
                                </tr>
                                <tr>
                                    <td>Created on: </td>
                                    <td>{{ $project->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        Links
                    </div>
                    <div class="card-body">
                        @if(!empty($project->trello_link))
                            <a class="single-project-link" target="_blank" href="{{ $project->trello_link }}">
                                <div>
                                    <p>Trello</p>
                                    <i class="fab fa-trello"></i>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Deadlines
                        <div class="edit-toggle" data-toggle="modal" data-target="#createDeadlineModal">Create Deadline</div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped single-project-deadlines">
                            <thead>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Days left</th>
                            <th scope="col"></th>
                            </thead>
                            <tbody>
                            @foreach($deadlines as $deadline)
                                <tr>
                                    <td>{{ $deadline->name }}</td>
                                    <td>{{ $deadline->time }}</td>
                                    <td>
                                        <?php
                                        $today                      = new DateTime('now');
                                        $deadlineRemainingTime      = new DateTime($deadline->time);
                                        $difference                 = $today->diff($deadlineRemainingTime);
                                        echo $difference->days;
                                        ?>
                                    </td>
                                    <td><i class="fas fa-edit edit-toggle" data-toggle="modal" data-target="#deadlineEditModal_{{ $deadline->id }}"></i></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="participants card mb-4">
                    <div class="card-header">
                        Participants
                        <div class="edit-toggle" data-toggle="modal" data-target="#addParticipantModal">Add Participant</div>
                    </div>
                    <div class="card-body">
                        <ul class="participant-list">
                            @foreach($participants[0]->user as $participant)
                                <li class="participant">{{ $participant->name }} <i class="fas fa-edit edit-toggle" data-toggle="modal" data-target="#editParticipantModal_{{ $participant->id }}"></i></li>
                                @if(isset($participant->roles[0]))
                                    <li class="roles">
                                        <ul>
                                            @foreach($participant->roles as $role)
                                                <li>- {{ $role->name }}</li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        Category
                        <i class="fas fa-edit edit-toggle"></i>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="single-project-modals">

        {{--Project Info Modal--}}
        <div class="modal fade" id="projectEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="form" action="{{ $project->id }}" method="POST">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-3" for="projectname">Project Name: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" id="projectname" name="projectname" placeholder="Enter Name.." value="{{ $project->name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3" for="customer-select">Customer: </label>
                                <div class="col-lg-9">
                                    <select name="customer_id" id="customer-select" class="form-control">
                                        @if(isset($customers[0]))
                                            @foreach($customers as $customer)
                                                <option @if($customer->id == $project->customer->id) selected @endif value="{{ $customer->id }}">{{ $customer->companyname }}</option>
                                            @endforeach
                                        @else
                                            <option disabled value="">No Customers Available</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3" for="budget">Budget</label>
                                <div class="input-group col-lg-9">
                                    <input class="form-control" name="budget" id="budget" type="text" placeholder="Enter Budget.." value="{{ $project->budget }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3" for="spent">Spent</label>
                                <div class="input-group col-lg-9">
                                    <input class="form-control" name="spent" id="spent" type="text" value="{{ $project->spent }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3" for="active">Active</label>
                                <div class="input-group col-lg-9">
                                    <input class="form-check-input" name="active" id="active" value="1" type="checkbox" @if($project->active == 1) checked @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3" for="description">Description</label>
                                <div class="col-lg-9">
                                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="Enter project description..">{{ $project->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3" for="trellolink">Trello Link</label>
                                <div class="input-group col-lg-9">
                                    <input class="form-control" name="trellolink" id="trellolink" type="text" placeholder="Enter Trello Link.." value="{{ $project->trello_link }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3">Delete Project</label>
                                <div class="col-lg-9">
                                    <p class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#projectdeleteModal">Delete</p>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Deadlines Modal --}}
        @foreach($deadlines as $deadline)
            <div class="modal fade" id="deadlineEditModal_{{ $deadline->id }}" tabindex="-2" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Project</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/deadlines/{{ $deadline->id }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="projectid" value="{{ $project->id }}">
                                <input type="hidden" name="deadlineid" value="{{ $deadline->id }}">
                                <div class="form-group row">
                                    <label class="col-lg-3" for="deadlinename">Deadline Name</label>
                                    <div class="input-group col-lg-9">
                                        <input id="deadlinename" class="col-lg-9 form-control" type="text" name="deadlinename" value="{{ $deadline->name }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3" for="deadlinedate">Deadline Date</label>
                                    <div class="input-group col-lg-9">
                                        <input id="deadlinedate" class="col-lg-9 form-control" type="date" name="deadlinedate" value="{{ $deadline->time }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3">Delete Deadline</label>
                                    <div class="col-lg-9">
                                        <p class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#deadlineDeleteModal_{{ $deadline->id }}">Delete</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Deadline Delete Modal --}}
            <div class="modal fade" id="deadlineDeleteModal_{{ $deadline->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Are you Sure</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/deadlines/{{ $deadline->id }}/destroy" method="POST">
                            @csrf
                            <input type="hidden" name="deadlineid" value="{{ $deadline->id }}">
                            <input type="hidden" name="projectid" value="{{ $project->id }}">
                            <div class="modal-body">
                                Are you sure you want to <strong>PERMANENTLY</strong> delete this deadline?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#projectEditModal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Create Deadline Modal --}}
        <div class="modal fade" id="createDeadlineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/deadlines" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="projectid" value="{{ $project->id }}">
                            <div class="form-group row">
                                <label class="col-lg-3" for="deadlinename">Deadline Name</label>
                                <div class="input-group col-lg-9">
                                    <input id="deadlinename" class="col-lg-9 form-control" type="text" name="deadlinename" placeholder="Deadline Name...">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3" for="deadlinedate">Deadline Date</label>
                                <div class="input-group col-lg-9">
                                    <input id="deadlinedate" class="col-lg-9 form-control" type="date" name="deadlinedate">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Create Deadline</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        {{-- Project Delete Modal --}}
        <div class="modal fade" id="projectdeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Are you Sure</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ $project->id }}/destroy" method="POST">
                        @csrf
                        <input type="hidden" name="projectid" value="{{ $project->id }}">
                        <div class="modal-body">
                            Are you sure you want to <strong>PERMANENTLY</strong> delete this project?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#projectEditModal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Add Participants Modal --}}
        <div class="modal fade" id="addParticipantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Participant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/participants" method="POST">
                        @csrf
                        <input type="hidden" name="projectid" value="{{ $project->id }}">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-lg-3" for="participant">User</label>
                                <div class="input-group col-lg-9">
                                    <select name="participant" id="participant" class="form-control">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <p class="col-lg-3" for="participant">Roles</p>
                                <div class="input-group col-lg-9">
                                    <div class="userroles-group">
                                        <?php $i = 0; ?>
                                        @foreach($roles as $role)
                                            <div class="form-check">
                                                <input class="form-check-input" name="role[{{ $i }}]" type="checkbox" value="add_{{ $role->id }}" id="role_{{ $role->id }}">
                                                <label class="form-check-label" for="role_{{ $role->id }}">
                                                    {{ $role->name }}
                                                </label>
                                            </div>
                                            <?php $i++; ?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#projectEditModal">Cancel</button>
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Edit Participants Modal --}}
        @foreach($participants[0]->user as $participant)
        <div class="modal fade" id="editParticipantModal_{{ $participant->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Participant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="participantEditModal_{{ $participant->id }}" action="/participants/{{ $participant->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="projectid" value="{{ $project->id }}">
                        <input type="hidden" name="userid" value="{{ $participant->pivot->user_id }}">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-lg-3" for="participant">User</label>
                                <div class="input-group col-lg-9">
                                    <input type="text" class="form-control" value="{{ $participant->name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <p class="col-lg-3" for="participant">Roles</p>
                                <div class="input-group col-lg-9">
                                    <div class="userroles-group">
                                        {{-- Format currently selected roles to array with singular ids --}}
                                        <?php $currentRoles = [] ?>
                                        @foreach($participant->roles as $role)
                                            <?php $currentRoles[] = $role['id'] ?>
                                        @endforeach
                                        <?php $i = 0; ?>
                                        @foreach($roles as $role)
                                            @if(in_array($role['id'], $currentRoles))
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="role[{{ $i }}]" checked value="remove_{{ $role->id }}">
                                                    <label class="form-check-label" for="role[{{ $i }}]">{{ $role->name }}</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" name="role[{{ $i }}]" value="add_{{ $role->id }}">
                                                    <label class="form-check-label" for="role[{{ $i }}]">{{ $role->name }}</label>
                                                </div>
                                            @endif
                                            <?php $i++; ?>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3">Remove Participant</label>
                                <div class="col-lg-9">
                                    <p class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#participantRemoveModal_{{ $participant->id }}">Remove</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#projectEditModal">Cancel</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="participantRemoveModal_{{ $participant->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Are you Sure</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/participants/{{ $participant->id }}/destroy" method="POST">
                        @csrf
                        <input type="hidden" name="projectid" value="{{ $project->id }}">
                        <input type="hidden" name="participantid" value="{{ $participant->id }}">
                        <div class="modal-body">
                            Are you sure you want to remove this participant from the project?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#projectEditModal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection