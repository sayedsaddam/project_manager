@if (session()->has('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-lable="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{!! session()->get('success') !!}</strong>
    </div>
@endif