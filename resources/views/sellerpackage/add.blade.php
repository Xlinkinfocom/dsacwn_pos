@extends('layout.main') @section('content')

@if(session()->has('not_permitted'))
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}</div> 
@endif
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>{{trans('file.Add Subscription Plan')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small>{{trans('file.The field labels marked with * are required input fields')}}.</small></p>
                        <form class="form-horizontal" action="{{route('package.create')}}" method="POST" enctype="multipart/form-data" role="form">
                            {{csrf_field()}}
                            <div class="card-group">
                                <div class="card">
                                  <div class="card-body">
                                    <h4 class="card-title">Card title</h4>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <a href="#!" class="btn btn-primary">Go somewhere</a>
                                  </div>
                                  
                                </div>
                                <div class="card">
                                  <div class="card-body">
                                    <h4 class="card-title">Card title</h4>
                                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                                    <a href="#!" class="btn btn-primary">Go somewhere</a>
                                  </div>
                                  
                                </div>
                                <div class="card">
                                  <div class="card-body">
                                    <h4 class="card-title">Card title</h4>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                                    <a href="#!" class="btn btn-primary">Go somewhere</a>
                                  </div>
                                
                                </div>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
