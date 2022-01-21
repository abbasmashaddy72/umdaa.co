<?php if(session()->has('msg')): ?>
    <div class="alert alert-<?php echo e(session('type')); ?>">
        <?php echo e(session('msg')); ?>

    </div>
<?php endif; ?>
<?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/backend/partials/message.blade.php ENDPATH**/ ?>