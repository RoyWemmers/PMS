@section('sidebar')
    <div id="sidebar">
        <ul>
            <li @if(str_contains(Request::url(), 'projects')) class="active" @endif><a href="/projects" >Projects</a></li>
        </ul>
    </div>
@endsection