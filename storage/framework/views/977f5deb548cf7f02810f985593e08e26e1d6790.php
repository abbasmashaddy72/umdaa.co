<footer class="footer-area">
    <div class="footer-top padding-top-50 d-none d-lg-block d-xl-block d-md-block d-xs-none d-sm-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget">
                        <div class="about_us_widget">
                            <a href="<?php echo e(url('/')); ?>" class="footer-logo">
                                <?php
                                $site_logo = get_attachment_image_by_id(get_static_option('site_logo'), 'full', false);
                                ?>
                                <?php if (!empty($site_logo)) : ?>
                                    <img src="<?php echo e($site_logo['img_url']); ?>" alt="">
                                <?php endif; ?>
                            </a>
                            <p><?php echo e(get_static_option('about_widget_description')); ?></p>
                            <ul class="social-icons">
                                <?php if (
                                    !empty(get_static_option('about_widget_social_icon_one')) &&
                                    !empty(get_static_option('about_widget_social_icon_one_url'))
                                ) : ?>
                                    <li><a href="<?php echo e(get_static_option('about_widget_social_icon_one_url')); ?>"><i class="<?php echo e(get_static_option('about_widget_social_icon_one')); ?>"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (
                                    !empty(get_static_option('about_widget_social_icon_two')) &&
                                    !empty(get_static_option('about_widget_social_icon_two_url'))
                                ) : ?>
                                    <li><a href="<?php echo e(get_static_option('about_widget_social_icon_two_url')); ?>"><i class="<?php echo e(get_static_option('about_widget_social_icon_two')); ?>"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (
                                    !empty(get_static_option('about_widget_social_icon_three')) &&
                                    !empty(get_static_option('about_widget_social_icon_three_url'))
                                ) : ?>
                                    <li><a href="<?php echo e(get_static_option('about_widget_social_icon_three_url')); ?>"><i class="<?php echo e(get_static_option('about_widget_social_icon_three')); ?>"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (
                                    !empty(get_static_option('about_widget_social_icon_four')) &&
                                    !empty(get_static_option('about_widget_social_icon_four_url'))
                                ) : ?>
                                    <li><a href="<?php echo e(get_static_option('about_widget_social_icon_four_url')); ?>"><i class="<?php echo e(get_static_option('about_widget_social_icon_four')); ?>"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (
                                    !empty(get_static_option('about_widget_social_icon_five')) &&
                                    !empty(get_static_option('about_widget_social_icon_five_url'))
                                ) : ?>
                                    <li><a href="<?php echo e(get_static_option('about_widget_social_icon_five_url')); ?>"><i class="<?php echo e(get_static_option('about_widget_social_icon_five')); ?>"></i></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget widget_nav_menu">
                        <h2 class="widget-title"><?php echo e(get_static_option('useful_link_widget_title')); ?></h2>
                        <ul>
                            <?php
                            $useful_links_arr = json_decode($all_usefull_links->content);
                            ?>
                            <?php $__currentLoopData = $useful_links_arr;
                            $__env->addLoop($__currentLoopData);
                            foreach ($__currentLoopData as $data) : $__env->incrementLoopIndices();
                                $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(str_replace('[url]', url('/'), $data->menuUrl)); ?>"><?php echo e($data->menuTitle); ?></a>
                                </li>
                            <?php endforeach;
                            $__env->popLoop();
                            $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget widget_nav_menu">
                        <h2 class="widget-title"><?php echo e(get_static_option('important_link_widget_title')); ?></h2>
                        <ul>
                            <?php
                            $useful_links_arr = json_decode($all_important_links->content);
                            ?>
                            <?php $__currentLoopData = $useful_links_arr;
                            $__env->addLoop($__currentLoopData);
                            foreach ($__currentLoopData as $data) : $__env->incrementLoopIndices();
                                $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(str_replace('[url]', url('/'), $data->menuUrl)); ?>"><?php echo e($data->menuTitle); ?></a>
                                </li>
                            <?php endforeach;
                            $__env->popLoop();
                            $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget widget_nav_menu">
                        <h2 class="widget-title"><?php echo e('Others'); ?></h2>
                        <ul>
                            <li>
                                <a href=<?php echo e(url('sitemap.xml')); ?>>Sitemap</a>
                            </li>
                            <li>
                                <a href=<?php echo e('tel:+91-910046-2015'); ?>>Call Us</a>
                            </li>
                            <li>
                                <a href=<?php echo e('mailto:info@umdaa.co?Subject=Thanks%20for%20Connecting%20With%20Us'); ?>>Mail
                                    Us</a>
                            </li>
                            <?php if (!empty($other_links->content)) : ?>
                                <?php
                                $useful_links_arr = json_decode($other_links->content);
                                ?>
                                <?php $__currentLoopData = $useful_links_arr;
                                $__env->addLoop($__currentLoopData);
                                foreach ($__currentLoopData as $data) : $__env->incrementLoopIndices();
                                    $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(str_replace('[url]', url('/'), $data->menuUrl)); ?>"><?php echo e($data->menuTitle); ?></a>
                                    </li>
                                <?php endforeach;
                                $__env->popLoop();
                                $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-area-inner">
                        <?php
                        $footer_text = '{year} {copy} UMDAA Health Care';
                        $footer_text = str_replace('{copy}', '&copy;', $footer_text);
                        $footer_text = str_replace('{year}', date('Y'), $footer_text);
                        ?>
                        <?php echo $footer_text; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Search</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('frontend.team.search')); ?>" method="get" class="search-form example">
                        <input type="text" class="form-control" name="search" placeholder="<?php echo e(__('Search Doctors')); ?>" required>
                        <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('frontend.blog.search')); ?>" method="get" class="search-form example">
                        <input type="text" class="form-control" name="search" placeholder="<?php echo e(__('Search Blogs')); ?>" required>
                        <button class="submit-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</footer>

<div class="back-to-top">
    <i class="fas fa-angle-up"></i>
</div>
<div id="whatsdiv">
</div>
<style>
    @media only screen and (max-width: 600px) {
        #whatsdiv {
            left: 15px !important;
            right: auto !important;
        }
    }
</style>
<?php if (!empty(get_static_option('popup_enable_status') && !empty(get_static_option('popup_selected_id')))) : ?>
    <?php
    $popup_id = get_static_option('popup_selected_id');
    $popup_details = \App\PopupBuilder::find($popup_id);
    if (empty($popup_details)) {
        return;
    }
    $website_url = url('/');
    $popup_class = '';
    if ($popup_details->type == 'notice') {
        $popup_class = 'notice-modal';
    } elseif ($popup_details->type == 'only_image') {
        $popup_class = 'only-image-modal';
    } else {
        $popup_class = 'discount-modal';
    }
    ?>
    <?php echo $__env->make('frontend.partials.popup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!-- jquery -->
<script src="<?php echo e(asset('assets/frontend/js/jquery-3.4.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery-migrate-3.1.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.lazy.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/dynamic-script.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.magnific-popup.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/imagesloaded.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/isotope.pkgd.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.waypoints.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.counterup.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/owl.carousel.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/jquery.ihavecookies.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/main.js')); ?>"></script>
<?php if (!empty(get_static_option('popup_enable_status') && !empty(get_static_option('popup_selected_id')))) : ?>
    <script src="<?php echo e(asset('assets/frontend/js/countdown.jquery.js')); ?>"></script>
<?php endif; ?>

<?php echo $__env->yieldContent('scripts'); ?>

<?php if (!empty(get_static_option('site_gdpr_cookie_enabled'))) : ?>
    <?php $gdpr_cookie_link = str_replace('{url}', url('/'), get_static_option('site_gdpr_cookie_more_info_link')) ?>
    <script>
        $(document).ready(function() {
            $('body').ihavecookies({
                title: "<?php echo e(get_static_option('site_gdpr_cookie_title')); ?>",
                message: "<?php echo e(get_static_option('site_gdpr_cookie_message')); ?>",
                expires: "<?php echo e(get_static_option('site_gdpr_cookie_expire')); ?>",
                link: "<?php echo e($gdpr_cookie_link); ?>",
                delay: "<?php echo e(get_static_option('site_gdpr_cookie_delay')); ?>",
                moreInfoLabel: "<?php echo e(get_static_option('site_gdpr_cookie_more_info_label')); ?>",
                acceptBtnLabel: "<?php echo e(get_static_option('site_gdpr_cookie_accept_button_label')); ?>"
            });
            $('body').on('click', '#gdpr-cookie-close', function(e) {
                e.preventDefault();
                $(this).parent().remove();
            });
        });
    </script>
<?php endif; ?>
<!--Start of Whats App-->
<script type="text/javascript">
    $(function() {
        $('#whatsdiv').floatingWhatsApp({
            phone: "<?php echo e(get_static_option('whats_app_number')); ?>",
            popupMessage: "<?php echo e(get_static_option('whats_app_message')); ?>",
            message: "",
            showPopup: false
        });
    });
</script>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTV4366" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!--Lazy Loading-->
<script>
    $(function() {
        $('.lazy').lazy();
    });
</script>
<!--Text Loader-->
<script>
    var content = document.querySelector('p');
</script>

<script>
    (function($) {
        "use strict";
        $(document).ready(function() {

            $('[data-toggle="popover"]').popover();

            function getCookie(cname) {
                var name = cname + "=";
                var decodedCookie = decodeURIComponent(document.cookie);
                var ca = decodedCookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
            <?php if (!empty(get_static_option('popup_enable_status') && !empty(get_static_option(
                'popup_selected_id'
            ))) && !empty($popup_details)) : ?>

                var delayTime = "<?php echo e(get_static_option('popup_delay_time')); ?>";
                delayTime = delayTime ? delayTime : 4000;

                if (getCookie('nx_popup_show') == '') {
                    setTimeout(function() {
                        $('.nx-popup-backdrop').addClass('show');
                        $('.nx-popup-wrapper').addClass('show');

                    }, parseInt(delayTime));
                }

                $(document).on('click', '.nx-popup-close,.nx-popup-backdrop', function(e) {
                    e.preventDefault();
                    $('.nx-modal-content').html('');
                    $('.nx-popup-backdrop').removeClass('show');
                    $('.nx-popup-wrapper').removeClass('show');
                    setCookie('nx_popup_show', 'no', 1);
                });

                var offerTime = "<?php echo e($popup_details->offer_time_end); ?>";
                var year = offerTime.substr(0, 4);
                var month = offerTime.substr(5, 2);
                var day = offerTime.substr(8, 2);
                if (offerTime) {
                    $('#countdown').countdown({
                        year: year,
                        month: month,
                        day: day,
                        labels: true,
                        labelText: {
                            'days': "<?php echo e(__('days')); ?>",
                            'hours': "<?php echo e(__('hours')); ?>",
                            'minutes': "<?php echo e(__('min')); ?>",
                            'seconds': "<?php echo e(__('sec')); ?>",
                        }
                    });
                }
            <?php endif; ?>

        });
    }(jQuery));
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>

</html><?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/frontend/partials/footer.blade.php ENDPATH**/ ?>