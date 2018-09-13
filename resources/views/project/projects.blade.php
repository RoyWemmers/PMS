@extends('layouts.app')
@include('elements/projectsoverview')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Projects
            </div>
            @yield('projectoverview')
        </div>
    </div>
@endsection
