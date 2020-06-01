@extends('layouts.app')
@section('content')
<div class="row col-lg-9 col-md-9 col-sm-9 pull-left">
    
    <div class="row col-lg-12 col-md-12 col-sm-12" style="background: white; maring:10px;">
        <h2>Create new Project</h2>
       <form action="{{ route('projects.store') }}" method="post">
            {{ csrf_field() }}
            @if($companies == null)
                <input type="hidden" name="company_id" value="{{ $company_id }}">
            @endif
            <div class="form-group">
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" name="name" id="project-name" class="form-control">
            </div>
            @if($companies != null)
                <div class="form-group">
                    <label for="company-id">Select Company</label>
                    <select name="company_id" class="form-control">
                        <option value="">Select Company</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
           <div class="form-group">
                 <label for="description">Description</label>
                <textarea name="description" id="project-description" rows="5" class="form-control" style="resize:vertical;"></textarea>
           </div>
           <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
           </div>
       </form>
    </div>
</div>
<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
    <div class="sidebar-module sidebar-module-inset">
        <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
                <li><a href="/projects">All projects</a></li>
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