@extends('layouts.app')

@section('content')
    <div id="single-project" class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Project: {{ $project->name }}
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="participants card mb-4">
                    <div class="card-header">
                        Participants
                    </div>
                    <div class="card-body">
                        <ul class="participant-list">
                            @foreach($participants[0]->user as $participant)
                                <li class="participant">{{ $participant->name }}</li>
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
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
