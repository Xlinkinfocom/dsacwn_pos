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
                    {!! Form::open(['route' => 'sellerpackage.create', 'method' => 'post', 'id' => 'package_frm', 'class' => 'payment-form']) !!}
                    <div class="card-body">                      
                        <div class="card-group">
                            <?php
                                //print_r($credit_packages);
                                foreach ($credit_packages as $key => $value) {
                                    # code...
                                    $packageID = $value['credit_package_id'];
                            ?>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $value['name'] ?></h4>
                                    <p class="card-text"><?php echo $value['description'] ?></p>
                                    <a href="javascript:void(0)" id="btnID{{ $packageID }}" onclick="sendPackage('{{ $packageID }}')" class="btn btn-primary"><?php echo "Buy At $ ".$value['cost']?></a>
                                </div>
                            </div>
                            <?php } ?>
                            <input type="hidden" class="form-control" id="package_id" value="" />
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
    <script>
        function sendPackage(package_id) { 
            $('#package_id').val(package_id);
            $("#package_frm").submit();
        }
    </script>
@endpush