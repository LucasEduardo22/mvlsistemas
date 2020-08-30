@if (session('success'))
    <div class="alert alert-success fade show" role="alert">
       {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> 
@endif
@if (session('message'))
    <div class="alert alert-info fade show" role="alert">
       {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> 
@endif
@if (session('error'))
    <div class="alert alert-danger fade show" role="alert">
       {{session('error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> 
@endif