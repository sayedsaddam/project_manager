@extends('layouts.app')
@section('content')
<div class="row col-lg-9 col-md-9 col-sm-9 pull-left">
    <div class="well well-lg">
        <h1>{{ $project->name }}</h1>
        <p>{{ $project->description }}</p>
    </div>
    <div class="row container-fluid" style="background: white; maring:12px;"><br>
    @include('partials.comments')
        <form action="{{ route('comments.store') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="commentable_type" value="App\Project">
                <input type="hidden" name="commentable_id" value="{{ $project->id }}">
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="body" id="comment-body" rows="3" style="resize:vertical;" class="form-control autosize-target text-left"></textarea>
                </div>
                <div class="form-group">
                    <label for="url">Proof of work done (URL/Photos)</label>
                    <textarea name="url" id="url" rows="2" style="resize:vertical;" class="form-control autosize-target text-left"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-sm" value="Submit">
                </div>
        </form>
    </div>
</div>
<div class="row col-sm-3 col-md-3 col-lg-3 pull-right">
    <div class="sidebar-module sidebar-module-inset">
        <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
                <li><a href="/projects/{{ $project->id }}/edit">Edit</a></li>
                <li><a href="/projects/create">Add Project</a></li>
                <li><a href="/projects">List Projects</a></li>
                <li><a href="/projects/create">Create Project</a></li>
                <br>
                @if($project->user_id == Auth::user()->id)
                    <li>
                        <a href="#" onclick="var result=confirm('Are you sure to delete this project?'); if(result){ event.preventDefault(); document.getElementById('delete-form').submit(); }">Delete</a>
                        <form id="delete-form" action="{{ route('projects.destroy', [$project->id]) }}" method="post" style="display:none;">
                            <input type="hidden" name="_method" value="delete">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ol>
            <hr>
            <h4>Add Members</h4>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form action="{{ route('projects.adduser') }}" method="post" id="add-user">
                    {{ csrf_field() }}
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="input-group">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Add</button>
                            </span>
                        </div> <!-- Input group -->
                    </form>
                </div> <!-- /.col-lg-6 -->
            </div> <!-- .row -->
            <br>
            <h4>Team Members</h4>
            <ol class="list-unstyled">
                @foreach($project->users as $user)
                    <li><a href="">{{ $user->email }}</a></li>
                @endforeach
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