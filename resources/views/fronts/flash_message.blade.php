

@if(session('success'))
<div class="alert alert-success bg-success alert-dismissible fade show" role="alert">
    <strong>{{Session::get('success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

@elseif(session('warning'))
<div class="alert alert-warning bg-warning alert-dismissible fade show" role="alert">
    <strong>{{Session::get('warning')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

