@section('projectoverview')
    <div class="card-body projects-overview">
        @foreach($projects as $project)
            <a href="/projects/{{ $project->id }}" class="card">
                <h3>{{ $project->name }}</h3>
                <p>{{ $project->spent }}</p>
            </a>
        @endforeach
    </div>
@endsection