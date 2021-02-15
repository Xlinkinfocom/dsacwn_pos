 <?php $__env->startSection('content'); ?>

<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div> 
<?php endif; ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Add Commission')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <form class="form-horizontal" action="<?php echo e(route('managecommission.create')); ?>" method="POST" enctype="multipart/form-data" role="form">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group" id="category-id">
                                        <label><strong><?php echo e(trans('Category')); ?></strong>*</label>
                                        <input type="hidden" name="category_hidden" value="">
                                        <select name="category" id="category" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select Category">
                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Categorys): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($Categorys->id); ?>"><?php echo e($Categorys->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                         
                                        </select>
                                        <?php if($errors->has('category')): ?>
                                        <span>
                                            <strong><?php echo e($errors->first('category')); ?></strong>
                                         </span>
                                         <?php endif; ?>
                                    </div>
                                    <div class="form-group" id="subcat-id">
                                        <label><strong><?php echo e(trans('Sub Category')); ?></strong></label>
                                        <input type="hidden" name="subcat_hidden" value="">
                                        <select name="subcat" id="subcat" class="selectpicker form-control" data-live-search="true" 
                                        data-live-search-style="begins" title="Select Sub Category...">
                                        </select>
                                    </div>                                     
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('Commssion')); ?> *</strong></label>
                                        <input type="text" value="" name="commssion" id="commssion" placeholder="Commssion" required class="form-control">
                                        <?php if($errors->has('commssion')): ?>
                                       <span>
                                           <strong><?php echo e($errors->first('commssion')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('Payment Fee')); ?> *</strong></label>
                                        <input type="text" value="" name="payment_fee" id="payment_fee" placeholder="Payment Fee" required class="form-control">
                                        <?php if($errors->has('payment_fee')): ?>
                                       <span>
                                           <strong><?php echo e($errors->first('payment_fee')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label><strong><?php echo e(trans('Vat')); ?> *</strong></label>
                                        <input type="text" value="" name="vat" id="vat" placeholder="Vat" required class="form-control">
                                        <?php if($errors->has('vat')): ?>
                                       <span>
                                           <strong><?php echo e($errors->first('vat')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">                                        
                                        <input class="mt-2" type="checkbox" name="is_active" value="1" >                                       
                                        <label class="mt-2"><strong><?php echo e(trans('Active')); ?></strong></label>
                                    </div>
                                   
                                    <div class="form-group row">
                                        <label for="zipcode" class="col-xs-2 col-form-label"></label>
                                        <div class="col-xs-10">
                                            <button type="submit" class="btn btn-primary">Add Commission</button>
                                            <a href="<?php echo e(route('managecommission.index')); ?>" class="btn btn-default">Cancel</a>
                                        </div>
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

<script>
$('#category').on('change', function() {
           var id = $(this).val();
            var html_district = "";
           $.ajax({
               url: "<?php echo e(route('managecommission.getsubCat',['id'=>''])); ?>/"+id,
               type: "GET",
               success: function(response) {
                   if(response.length >= 1)
                   {
                    //console.log(response);
                    $('#subcat').find('option').remove();
                    //$("#chapter_id").remove();
                    var html_option = "";                    
                       for(var i=0; i<response.length; i++)
                       {
                            var id = response[i].id;
                            var name = response[i].name;

                            html_option += '<option value="'+id+'">'+name+'</option>';
                       }
                       $("#subcat").append(html_option);
                       $('.selectpicker').selectpicker('refresh');
                   }
               }
           });
       });


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>