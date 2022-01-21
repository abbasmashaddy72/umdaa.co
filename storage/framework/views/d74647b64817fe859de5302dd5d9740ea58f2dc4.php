<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Primary Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="p:domain_verify" content="2f1f47fe63622e3024a7ea74bea49058" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php if(request()->path() == '/'): ?>
        <meta name="keywords" content="<?php echo e(get_static_option('site_meta_tags')); ?>">
    <?php else: ?>
        <?php echo $__env->yieldContent('site-meta'); ?>
    <?php endif; ?>
    <?php echo $__env->yieldContent('og-meta'); ?>
    <title>
        <?php if(request()->path() == '/'): ?>
            <?php echo e(get_static_option('site_tag_line')); ?> | <?php echo e('UMDAA Health Care'); ?>

        <?php else: ?>
            <?php echo $__env->yieldContent('site-title'); ?> | <?php echo e('UMDAA Health Care'); ?>

        <?php endif; ?>
    </title>
    <?php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'), 'full', false);
    ?>
    <?php if(!empty($site_favicon)): ?>
        <link rel="icon" href="<?php echo e($site_favicon['img_url']); ?>" type="image/png">
    <?php endif; ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145261167-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-145261167-2');
    </script>
    <meta name="google-site-verification" content="fialqj0CiTba63Y3RkdX-XQ2vyNNXP9Sm-woYrJhMf0" />

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PTV4366');
    </script>
    <!-- End Google Tag Manager -->


    
    <link href="<?php echo e(Request::url()); ?>" rel="canonical" />

    
    <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "WebSite",
            "name": "UMDAA Health Care",
            "url": "https://umdaa.co/",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://umdaa.co/doctors{search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
    
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "UMDAA Health Care",
            "alternateName": "Health Care Consultancy",
            "url": "https://umdaa.co/",
            "logo": "https://umdaa.co/assets/uploads/media-uploader/umdaa-logo-for-web-psd16085351241615060687.png",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "+91-9100462015",
                "contactType": "customer service",
                "areaServed": "IN",
                "availableLanguage": ["en", "Hindi", "Telugu"]
            },
            "sameAs": [
                "https://www.facebook.com/umdaahealthcare/",
                "https://twitter.com/umdaahealthcare",
                "https://www.youtube.com/channel/UCRb7iBC1qv04EvILwrIG4zA",
                "https://www.linkedin.com/company/14751423/admin/",
                "https://umdaa.co/"
            ]
        }
    </script>
    
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "MedicalClinic",
            "name": "UMDAA Health Care",
            "image": "https://umdaa.co/assets/uploads/media-uploader/umdaa-logo-for-web-psd16085351241615060687.png",
            "url": "https://www.umdaa.co/",
            "telephone": "+91-9100462015",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Tolichowki",
                "addressLocality": "Hyderabad",
                "postalCode": "500008",
                "addressCountry": "IN"
            },
            "geo": {
                "@type": "GeoCoordinates",
                "latitude": 17.3990023,
                "longitude": 78.4156933
            },
            "openingHoursSpecification": {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": [
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday"
                ],
                "opens": "09:00",
                "closes": "18:00"
            },
            "sameAs": [
                "https://www.facebook.com/umdaahealthcare/",
                "https://twitter.com/umdaahealthcare",
                "https://www.youtube.com/channel/UCRb7iBC1qv04EvILwrIG4zA",
                "https://www.linkedin.com/company/14751423/admin/",
                "https://umdaa.co/"
            ]
        }
    </script>
    
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1197620173999981');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1197620173999981&ev=PageView&noscript=1" />
    </noscript>

    <!-- all stylesheets -->
    <link rel="preload" href="<?php echo e(asset('assets/frontend/css/bootstrap.min.css?version=2.0')); ?>" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/style.css?version=9.4')); ?>">
    <link rel="preload" href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css?version=2.0')); ?>" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo e(asset('assets/frontend/css/owl.carousel.min.css?version=2.0')); ?>" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo e(asset('assets/frontend/css/animate.css?version=2.0')); ?>" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo e(asset('assets/frontend/css/flaticon.css?version=2.0')); ?>" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo e(asset('assets/frontend/css/magnific-popup.css?version=2.0')); ?>" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo e(asset('assets/frontend/css/responsive.css?version=3.1')); ?>" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css?version=5.2')); ?>" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="<?php echo e(asset('assets/frontend/css/jquery.ihavecookies.css?version=2.0')); ?>" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload"
        href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700|Poppins:400,500,600,700&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/bootstrap.min.css?version=2.0')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/fontawesome.min.css?version=2.0')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/owl.carousel.min.css?version=2.0')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/animate.css?version=2.0')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/flaticon.css?version=2.0')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/magnific-popup.css?version=2.0')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/responsive.css?version=3.1')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/dynamic-style.css?version=5.2')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/frontend/css/jquery.ihavecookies.css?version=2.0')); ?>">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700|Poppins:400,500,600,700&display=swap">
    </noscript>

    <?php echo $__env->yieldContent('style'); ?>
    <style>
        .brsearch {
            margin-right: 25%;
            margin-top: -2%;
            background-color: transparent;
            border: transparent;
        }

        form.example input[type=text] {
            padding: 10px;
            font-size: 17px;
            float: left;
            width: 80%;
            background: #f1f1f1;
        }

        form.example button {
            float: left;
            width: 20%;
            padding: 7px;
            background: #2196F3;
            color: white;
            font-size: 17px;
            border-left: none;
            cursor: pointer;
        }

        form.example button:hover {
            background: #0b7dda;
        }

        form.example::after {
            content: "";
            clear: both;
            display: table;
        }

    </style>
</head>

<body>

    <?php echo $__env->make('frontend.partials.preloader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('frontend.partials.navbar-03', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(\Request::route()->getName() != 'homepage'): ?>
        <section class="breadcrumb-area d-none d-lg-block d-xl-block d-md-block d-xs-none d-sm-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-inner">
                            <ul class="page-list">
                                <li><a href="<?php echo e(url('/')); ?>"><?php echo e('Home'); ?></a></li>
                                <li><?php echo $__env->yieldContent('page-title'); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('frontend.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/frontend/frontend-page-master.blade.php ENDPATH**/ ?>