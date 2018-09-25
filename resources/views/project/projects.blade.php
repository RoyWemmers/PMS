@extends('layouts.app')
@include('elements/projectsoverview')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header projects-header">
                Projects
                <a href="projects/create">Create Project</a>
            </div>
            <div class="card-body">
                @yield('projectoverview')
            </div>
        </div>
    </div>
@endsection
