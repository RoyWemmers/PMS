@extends('layouts.app')

@section('content')
    <div class="status-messages">
        @if(!empty($_GET) && $_GET['status'] == 'success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ $_GET['statusMessage'] }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <div id="single-project" class="container-fluid">
        <div class="row">
            <div class="col-xl-3">
                <div class="card mb-2">
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
                <div class="card mb-2">
                    <div class="card-header">
                        Links
                        <i class="fas fa-edit edit-toggle"></i>
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
            <div class="col-xl-3">
                <div class="card mb-2">
                    <div class="card-header">
                        Deadlines
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
            </div>
            {{--


            <div class="col-xl-3">
                <div class="participants card mb-2">
                    <div class="card-header">
                        Participants
                    </div>
                    <div class="card-body">
                        <ul class="participant-list">
                            @foreach($participants[0]->user as $participant)
                            <li class="participant">{{ $participant->name }} <i class="fas fa-edit edit-toggle"></i></li>
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
            </div>
            <div class="col-xl-3">
                <div class="card mb-2">
                    <div class="card-header">
                        Category
                        <i class="fas fa-edit edit-toggle"></i>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>


            --}}

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
                                    <input class="form-control" name="budget" id="budget" max="100000" type="text" placeholder="Enter Budget.." value="{{ $project->budget }}">
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
                                <label class="col-lg-3" for="deadlinedate">Deadline Name</label>
                                <div class="input-group col-lg-9">
                                    <input id="deadlinedate" class="col-lg-9 form-control" type="date" name="deadlinedate" value="{{ $deadline->time }}">
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
        @endforeach
    </div>
@endsection
