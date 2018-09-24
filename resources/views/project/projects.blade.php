@extends('layouts.app')
@include('elements/projectsoverview')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Projects
            </div>
            <div class="card-body">
                @yield('projectoverview')
            </div>
        </div>
    </div>
@endsection
