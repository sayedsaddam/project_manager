@extends('layouts.app')
@section('content')
<div class="row col-lg-9 col-md-9 col-sm-9 pull-left">
    
    <div class="row col-lg-12 col-md-12 col-sm-12" style="background: white; maring:10px;">
        <h2>Create new company</h2>
       <form action="{{ route('companies.store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" name="name" id="company-name" class="form-control">
            </div>
           <div class="form-group">
                 <label for="description">Description</label>
                <textarea name="description" id="company-description" rows="5" class="form-control" style="resize:vertical;"></textarea>
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
                <li><a href="/companies">All Companies</a></li>
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