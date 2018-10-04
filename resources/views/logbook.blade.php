@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Logbook
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Project</th>
                            <th scope="col">Description</th>
                            <th scope="col">Duration</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <th>{{ $log->project->name }}</th>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->duration }}</td>
                            <td>{{ $log->starttime }}</td>
                            <td>{{ $log->endtime }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary">Filters</button>
                <button class="btn btn-success"  data-toggle="modal" data-target="#addNewRowModal">Add New Row</button>
            </div>
        </div>

        <div class="modal fade" id="addNewRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="/logbook/" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Add New Row</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="userid" value="{{ $userid }}">
                            <div class="form-group row">
                                <label class="col-lg-3" for="project">Project</label>
                                <div class="input-group col-lg-9">
                                    <select name="project" id="project" class="form-control">
                                        @if(isset($projects[0]->project[0]->id))
                                            @foreach($projects[0]->project as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach;
                                        @else
                                            <option disabled selected value="">No Projects to show</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3" for="description">Description</label>
                                <div class="input-group col-lg-9">
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="5" placeholder="Description..."></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3" for="startdate">Start Time</label>
                                <div class="input-group col-lg-9">
                                    <input class="form-control" type="date" name="startdate" value="<?= date('Y-m-d')?>">
                                    <input class="form-control" type="time" name="starttime" value="<?= date('H:i') ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3" for="endduration">End Time</label>
                                <div class="input-group col-lg-9">
                                    <input class="form-control" type="date" name="enddate" value="<?= date('Y-m-d')?>">
                                    <input class="form-control" type="time" name="endtime" value="<?= date('H:i') ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3" for="description">Duration</label>
                                <div class="input-group col-lg-9">
                                    <input class="form-control" type="time" name="duration" value="00:00">
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
    </div>
@endsection
