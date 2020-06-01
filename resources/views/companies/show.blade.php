@extends('layouts.app')
@section('content')
<div class="col-lg-9 col-md-9 col-sm-9 pull-left">
    <div class="jumbotron">
        <h1>{{ $company->name }}</h1>
        <p>{{ $company->description }}</p>
    </div>
    <div class="row col-md-12 col-lg-12 col-sm-12" style="background:white; margin: 10px;">
        <a href="/projects/create/{{ $company->id }}" class="btn btn-default btn-sm pull-right">Add Project</a>
    </div>
    <div class="row" style="background: white; maring:10px;">
        @foreach($company->projects as $project)
            <div class="col-lg-4">
                <h2>{{ $project->name }}</h2>
                <p>{{ $project->description }}</p>
                <p><a class="btn btn-primary btn-sm" href="/projects/{{ $project->id }}">View Project &raquo;</a></p>
            </div>
        @endforeach
    </div>
</div>
<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
    <div class="sidebar-module sidebar-module-inset">
        <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
                <li><a href="/companies/{{ $company->id }}/edit">Edit</a></li>
                <li><a href="/projects/create/{{ $company->id }}">Add Project</a></li>
                <li><a href="/companies">List Companies</a></li>
                <li><a href="/companies/create">Create Company</a></li>
                <br>
                <li>
                    <a href="#" onclick="var result=confirm('Are you sure to delete this project?'); if(result){ event.preventDefault(); document.getElementById('delete-form').submit(); }">Delete</a>
                    <form id="delete-form" action="{{ route('companies.destroy', [$company->id]) }}" method="post" style="display:none;">
                        <input type="hidden" name="_method" value="delete">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ol>
        </div>
        <!-- <div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
                <li><a href="">March 2014</a></li>
            </ol>
        </div> -->
    </div>
</div>
@endsection