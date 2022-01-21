<?php $__env->startSection('og-meta'); ?>
    <meta name="title" content="<?php echo e('UMDAA Health Care'); ?> - <?php echo e(get_static_option('site_tag_line')); ?>" />
    <meta name="description" content="<?php echo e(get_static_option('about_widget_description')); ?>">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo e(url('/')); ?>" />
    <meta property="og:title" content="<?php echo e('UMDAA Health Care'); ?> - <?php echo e(get_static_option('site_tag_line')); ?>" />
    <meta property="og:description" content="<?php echo e(get_static_option('about_widget_description')); ?>" />
    <meta property="og:image" content="<?php echo e(url('assets/uploads/media-uploader/thumb-logo.png')); ?>" />
    <!-- Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:url" content="<?php echo e(url('/')); ?>" />
    <meta name="twitter:title" content="<?php echo e('UMDAA Health Care'); ?> - <?php echo e(get_static_option('site_tag_line')); ?>" />
    <meta name="twitter:description" content="<?php echo e(get_static_option('about_widget_description')); ?>" />
    <meta name="twitter:image" content="<?php echo e(url('assets/uploads/media-uploader/thumb-logo.png')); ?>" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <?php $__currentLoopData = $all_header_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $header_bg_img = get_attachment_image_by_id($data->image, null, false);
        ?>
        <style>
            #hero {
                color: white;
                background-image: url(<?php echo e($header_bg_img['img_url']); ?>);
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                height: 88vh;
                box-shadow: inset 0 0 0 1000px rgb(0 0 0 / 50%);
            }

        </style>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <style>
        .btn-colour-1 {
            color: #fff;
            background-color: #2685f9;
            border-color: #2685f9;
            border-radius: 4px;
            font-weight: bold;
            letter-spacing: 0.05em;
        }

        .btn-colour-1:hover,
        .btn-colour-1:active,
        .btn-colour-1:focus,
        .btn-colour-1.active {
            /* let's darken #004E64 a bit for hover effect */
            background: #111d5c;
            color: #ffffff;
            border-color: #111d5c;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section id="hero" class="d-flex align-items-center jumbotron">
        <div class="container">
            <?php $__currentLoopData = $all_header_slider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-lg-8 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <?php if(!empty($data->title)): ?>
                            <h1>
                                <?php echo e($data->title); ?>

                            </h1>
                        <?php endif; ?>
                        <?php if(!empty($data->description)): ?>
                            <h2>
                                <?php echo e($data->description); ?>

                            </h2>
                        <?php endif; ?>
                        <div class="d-flex">
                            <?php if(!empty($data->btn_01_status)): ?>
                                <a href="<?php echo e($data->btn_01_url); ?>"
                                    class="btn-get-started scrollto"><?php echo e($data->btn_01_text); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <section class="our-cover-area padding-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title desktop-center margin-bottom-55">
                        <h2 class="title"><?php echo e(get_static_option('home_page_01_service_area_title')); ?></h2>
                        <p><?php echo e(get_static_option('home_page_01_service_area_description')); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $all_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="icon-box-two margin-bottom-30">
                            <div class="icon">
                                <i class="<?php echo e($data->icon); ?>"></i>
                            </div>
                            <div class="content">
                                <h4 class="title"><?php echo e($data->title); ?></h4>
                                <p> <?php echo e($data->excerpt); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php if(count($all_testimonial) > 0): ?>
        <section class="testimonial-area testimonial-bg padding-50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="testimonial-carousel">
                            <?php $__currentLoopData = $all_testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="single-testimonial-item white">
                                    <div class="icon">
                                        <i class="flaticon-quote"></i>
                                    </div>
                                    <p><?php echo e($data->testimonial); ?> </p>
                                    <div class="author-meta">
                                        <h4 class="name"><?php echo e('Dr.'); ?> <?php echo e($data->first_name); ?>

                                            <?php echo e($data->last_name); ?></h4>
                                        <span class="designation"><?php echo e($data->qualification); ?></span>
                                    </div>
                                    <div class="thumb">
                                        <?php if(!empty($data->profile_image)): ?>
                                            <img src="<?php echo e('https://clinic.umdaa.co/uploads/doctors/' . $data->profile_image); ?>"
                                                alt="<?php echo e(__($data->first_name)); ?>" />
                                        <?php endif; ?>
                                        <?php
                                            $testimonial_image = get_attachment_image_by_id($data->image, 'full', false);
                                        ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <div class="aboutus-two-area aboutus-bg padding-50" <?php
        $about_us_background_image = get_attachment_image_by_id(get_static_option('home_page_01_about_us_background_image'), null, false);
    ?> <?php if(!empty($about_us_background_image)): ?> style="background-image: url(<?php echo e($about_us_background_image['img_url']); ?>)" <?php endif; ?>>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-6">
                    <div class="aboutus-content-block">
                        <h4 class="title"><?php echo e(get_static_option('home_page_01_about_us_title')); ?></h4>
                        <p><?php echo e(get_static_option('home_page_01_about_us_description')); ?></p>
                        <?php if(get_static_option('home_page_01_about_us_button_status')): ?>
                            <div class="btn-wrapper desktop-left">
                                <a href="<?php echo e(get_static_option('home_page_01_about_us_button_url')); ?>"
                                    class="boxed-btn btn-rounded"><?php echo e(get_static_option('home_page_01_about_us_button_title')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="counterup-area counterup-bg padding-top-115 padding-bottom-115">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="singler-counterup-item-01 white">
                        <div class="icon">
                            <i class="fas fa-user-md" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="count-wrap"><span class="count-num"><?php echo e($doc_count); ?></span></div>
                            <h4 class="title"><?php echo e('No. of Doctors'); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="singler-counterup-item-01 white">
                        <div class="icon">
                            <i class="fas fa-university" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="count-wrap"><span class="count-num"><?php echo e($dep_count); ?></span></div>
                            <h4 class="title"><?php echo e('No. of Dept.'); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="singler-counterup-item-01 white">
                        <div class="icon">
                            <i class="fas fa-ambulance" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="count-wrap"><span class="count-num"><?php echo e($clinic_count); ?></span></div>
                            <h4 class="title"><?php echo e('No. of Clinics'); ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="singler-counterup-item-01 white">
                        <div class="icon">
                            <i class="fas fa-diagnoses" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <div class="count-wrap"><span class="count-num"><?php echo e($app_count); ?></span><?php echo e('+'); ?>

                            </div>
                            <h4 class="title"><?php echo e('No. of Consultations'); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="faq-area bg-image padding-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <div class="section-title desktop-left tablet-center mobile-center">
                            <h2 class="title"><?php echo e(get_static_option('home_page_01_faq_area_title')); ?></h2>
                            <p><?php echo e(get_static_option('home_page_01_faq_area_description')); ?></p>
                        </div>
                        <div class="accordion-wrapper">
                            <?php $rand_number = rand(9999,99999999); ?>
                            <div id="accordion_<?php echo e($rand_number); ?>">
                                <?php $__currentLoopData = $all_faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $aria_expanded = 'false';
                                        if ($data->is_open == 'on') {
                                            $aria_expanded = 'true';
                                        }
                                    ?>
                                    <div class="card">
                                        <div class="card-header" id="headingOne_<?php echo e($key); ?>">
                                            <h5 class="mb-0">
                                                <a data-toggle="collapse" data-target="#collapseOne_<?php echo e($key); ?>"
                                                    role="button" aria-expanded="<?php echo e($aria_expanded); ?>"
                                                    aria-controls="collapseOne_<?php echo e($key); ?>">
                                                    <?php echo e($data->title); ?>

                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne_<?php echo e($key); ?>" class="collapse <?php if($data->is_open == 'on'): ?> show <?php endif; ?>
                                            "
                                            aria-labelledby="headingOne_<?php echo e($key); ?>"
                                            data-parent="#accordion_<?php echo e($rand_number); ?>">
                                            <div class="card-body">
                                                <?php echo e($data->description); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <div class="request-call">
                            <h4 class="title"><?php echo e(get_static_option('home_page_01_faq_area_form_title')); ?></h4>
                            <p><?php echo e(get_static_option('home_page_01_faq_area_form_description')); ?></p>
                            <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php if($errors->any()): ?>
                                <ul class="alert alert-danger">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                            <form action="<?php echo e(route('frontend.call.back.message')); ?>"
                                class="request-call-form margin-top-60" enctype="multipart/form-data" method="post">
                                <?php echo csrf_field(); ?>
                                <?php
                                    $form_fields = json_decode(get_static_option('call_back_page_form_fields'));
                                    $select_index = 0;
                                    $options = [];
                                ?>
                                <?php $__currentLoopData = $form_fields->field_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($value)): ?>
                                        <?php if($value == 'select'): ?> <?php $options = explode(';',$form_fields->select_options[$select_index]);?>
                                        <?php endif; ?>
                                        <?php $required = isset($form_fields->field_required->$key) ? $form_fields->field_required->$key : '' ?>
                                        <?php $mimes = isset($form_fields->mimes_type->$key) ? $form_fields->mimes_type->$key : '' ?>
                                        <?php echo get_field_by_type($value, $form_fields->field_name[$key], $form_fields->field_placeholder[$key], $options, $required, $mimes); ?>

                                        <?php if($value == 'select'): ?> <?php $select_index++?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <button type="submit" class="submit-btn white"><?php echo e('Submit'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cta-area-one cta-bg-one padding-top-95 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="left-content-area">
                        <h3 class="title"><?php echo e(get_static_option('home_page_01_cta_area_title')); ?></h3>
                        <p><?php echo e(get_static_option('home_page_01_cta_area_description')); ?></p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="right-content-area">
                        <div class="btn-wrapper">
                            <a href="<?php echo e(get_static_option('home_page_01_cta_area_button_url')); ?>"
                                class="boxed-btn btn-rounded white"><?php echo e(get_static_option('home_page_01_cta_area_button_title')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        $(".jumbotron").css({
            height: $(window).height() + "px"
        });

        $(window).on("resize", function() {
            $(".jumbotron").css({
                height: $(window).height() + "px"
            });
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/frontend/partials/home.blade.php ENDPATH**/ ?>