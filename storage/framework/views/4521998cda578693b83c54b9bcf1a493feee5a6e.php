
<?php $__env->startSection('content'); ?>

    <section class="main-content-wrapper">
        <?php echo $__env->make('utilities.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <section class="content-header">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="top-left-header"><?php echo e(isset($title) && $title ? $title : ''); ?></h2>
                    <input type="hidden" class="datatable_name" data-title="<?php echo e(isset($title) && $title ? $title : ''); ?>"
                        data-id_name="datatable">
                </div>
                <div class="col-md-offset-4 col-md-2">

                </div>
            </div>
        </section>


        <div class="box-wrapper">

            <div class="table-box">
                <!-- /.box-header -->
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="ir_w_1"> Serial No.</th>
                                <th class="ir_w_25">Name</th>
                                <th class="ir_w_16">Created At</th>
                                <th class="ir_w_1 ir_txt_center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php $__currentLoopData = $productionFloors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $productionFloor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="ir_txt_center"><?php echo e($i+1); ?></td>
                                    <td><?php echo e($productionFloor->name); ?></td>
                                    <td><?php echo e($productionFloor->created_at->format('Y-M-d')); ?></td>
                                    <td class="ir_txt_center">
                                            <a href="<?php echo e(url('production-floor')); ?>/<?php echo e(encrypt_decrypt($productionFloor->id, 'encrypt')); ?>/edit" class="button-success"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Edit"><i class="fa fa-edit tiny-icon"></i></a>


                                            <a href="#" class="delete button-danger"
                                                data-form_class="alertDelete<?php echo e($productionFloor->id); ?>" type="submit"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                <form action="<?php echo e(route('production-floor.destroy', $productionFloor->id)); ?>"
                                                    class="alertDelete<?php echo e($productionFloor->id); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <i class="fa fa-trash tiny-icon"></i>
                                                </form>
                                            </a>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\iproduction_null\resources\views/pages/production-floor/index.blade.php ENDPATH**/ ?>