<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Popup Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__("Popup Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.general.popup.settings')); ?>" method="Post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <label for="popup_selected_id"><?php echo e(__('Select Popup')); ?></label>
                                        <select name="popup_selected_id" class="form-control" id="popup_selected_id">
                                            <?php $__currentLoopData = $all_popup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(get_static_option('popup_selected_id') == $item->id): ?> selected <?php endif; ?> value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                            <div class="form-group">
                                <label for="popup_enable_status"><strong><?php echo e(__('Popup Enable/Disable')); ?></strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="popup_enable_status" <?php if(!empty(get_static_option('popup_enable_status'))): ?> checked <?php endif; ?> id="popup_enable_status">
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="popup_delay_time"><?php echo e(__('Popup Delay Time')); ?></label>
                                <input type="text" class="form-control" name="popup_delay_time" id="popup_delay_time" value="<?php echo e(get_static_option('popup_delay_time')); ?>">
                                <p class="info-text"><?php echo e(__('put number in miliseconds')); ?></p>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4 margin-bottom-40" id="db_backup_btn"><?php echo e(__('Save Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/backend/general-settings/popup-settings.blade.php ENDPATH**/ ?>