@extends('admin.layout.base')

@section('title', 'Update Credit Package ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('credit.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a>

			<h5 style="margin-bottom: 2em;">Update Credit Package</h5>

            <form class="form-horizontal" action="{{route('admin.credit.update', $credit_package->credit_package_id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">
				<div class="form-group row">
					<label for="name" class="col-xs-2 col-form-label">Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $credit_package->name }}" name="name" id="name" placeholder="Name" readonly>
					</div>
				</div>

                <div class="form-group row">
                    <label for="no_of_credit" class="col-xs-2 col-form-label">No. of Credit</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $credit_package->face_value }}" name="no_of_credit"  id="no_of_credit" placeholder="No. of Credit">
                    </div>
                </div>

                 <div class="form-group row">
                    <label for="price" class="col-xs-2 col-form-label">Price</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $credit_package->cost }}" name="price"  id="price" placeholder="Price">
                    </div>
                </div>

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update Credit Package</button>
						<a href="{{route('credit.index')}}" class="btn btn-default">Cancel</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection
