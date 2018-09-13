@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Project: {{ $project[0]->name }}
            </div>
            <div class="card-body">
                {{ $project }}
                {{ $participants }}
                {{ $deadlines }}
                {{ $category }}
            </div>
        </div>
    </div>
@endsection
