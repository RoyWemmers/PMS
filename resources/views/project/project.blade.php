@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
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
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header">
                        Deadlines
                    </div>
                    <div class="car-body">
                        <table>
                            <thead>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time left</th>
                            </thead>
                            <tbody>
                            @foreach($deadlines as $deadline)
                                <tr>
                                    <td>{{ $deadline->name }}</td>
                                    <td>{{ $deadline->time }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header">
                        Participants
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach($participants as $participant)
                            <li>{{ $participant }}</li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
