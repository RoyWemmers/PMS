@section('sidebar')
    <div id="sidebar">
        <ul>
            <li @if(str_contains(Request::url(), 'dashboard')) class="active" @endif><a href="/" >Dashboard</a></li>
            <li @if(str_contains(Request::url(), 'logbook')) class="active" @endif><a href="/logbook">Logbook</a></li>
            <li @if(str_contains(Request::url(), 'projects')) class="active" @endif><a href="/projects" >Projects</a></li>
            <li><a href="">Users</a></li>
            <li @if(str_contains(Request::url(), 'roles')) class="active" @endif><a href="/roles" >Roles</a></li>
            <li><a href="">Customers</a></li>
        </ul>
    </div>
@endsection