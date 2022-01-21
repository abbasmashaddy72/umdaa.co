<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="<?php echo e(route('admin.home')); ?>">
                <?php
                    $site_logo = get_attachment_image_by_id(get_static_option('site_logo'), 'full', false);
                ?>
                <?php if(!empty($site_logo)): ?>
                    <img src="<?php echo e($site_logo['img_url']); ?>" alt="<?php echo e('UMDAA Health Care'); ?>">
                <?php endif; ?>
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="<?php echo e(active_menu('admin-home')); ?>">
                        <a href="<?php echo e(route('admin.home')); ?>" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span><?php echo e(('Dashboard')); ?></span>
                        </a>
                    </li>
                    <li class="<?php echo e(active_menu('admin-home/maintains-page/settings')); ?>">
                        <a href="<?php echo e(route('admin.maintains.page.settings')); ?>" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span><?php echo e('Maintain Page Manage'); ?></span>
                        </a>
                    </li>
                    <?php if(check_page_permission('newsletter_manage')): ?>
                        <li class="
                            <?php echo e(active_menu('admin-home/newsletter')); ?>

                            <?php if(request()->is('admin-home/newsletter/*')): ?> active <?php endif; ?>
                            "
                            >
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-email"></i>
                                <span><?php echo e('Newsletter Manage'); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/newsletter')); ?>"><a
                                        href="<?php echo e(route('admin.newsletter')); ?>"><?php echo e('All Subscriber'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/newsletter/all')); ?>"><a
                                        href="<?php echo e(route('admin.newsletter.mail')); ?>"><?php echo e('Send Mail To All'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('quote_manage')): ?>
                        <li class="<?php if(request()->is('admin-home/quote-manage/*')): ?> active <?php endif; ?> ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-quote-left"></i>
                                <span><?php echo e('Quote Manage'); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/quote-manage/all')); ?>"><a
                                        href="<?php echo e(route('admin.quote.manage.all')); ?>"><?php echo e('All Quote'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/quote-manage/pending')); ?>"><a
                                        href="<?php echo e(route('admin.quote.manage.pending')); ?>"><?php echo e('Pending Quote'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/quote-manage/completed')); ?>"><a
                                        href="<?php echo e(route('admin.quote.manage.completed')); ?>"><?php echo e('Complete Quote'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('doctor_details_manage')): ?>
                        <li class="<?php if(request()->is('admin-home/doctor-web-details/*')): ?> active <?php endif; ?> ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-quote-left"></i>
                                <span><?php echo e('Doctors & Clinic Details'); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/doctor-web-details/doctor-details')); ?>"><a
                                        href="<?php echo e(route('admin.doctor.details')); ?>"><?php echo e('Registed Doctor List'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/doctor-web-details/clinics-details')); ?>"><a
                                        href="<?php echo e(route('admin.clinic.details')); ?>"><?php echo e('Registed Clinic List'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('quote_page_manage')): ?>
                        <li class="<?php echo e(active_menu('admin-home/quote-page')); ?>">
                            <a href="<?php echo e(route('admin.quote.page')); ?>" aria-expanded="true">
                                <i class="ti-dashboard"></i>
                                <span><?php echo e('Quote Page Manage'); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('works')): ?>
                        <li class="
                    <?php if(request()->is('admin-home/works/*')): ?> active <?php endif; ?>
                            <?php echo e(active_menu('admin-home/works')); ?>

                            ">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-layout"></i>
                                <span><?php echo e('Works'); ?></span>
                            </a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/works')); ?>"><a
                                        href="<?php echo e(route('admin.work')); ?>"><?php echo e('New/All Works'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/works/category')); ?>"><a
                                        href="<?php echo e(route('admin.work.category')); ?>"><?php echo e('Category'); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('blogs')): ?>
                    <li class="
                        <?php echo e(active_menu('admin-home/blog')); ?>

                                <?php echo e(active_menu('admin-home/new-blog')); ?>

                                <?php if(request()->is('admin-home/blog-edit/*')): ?> active <?php endif; ?>
                                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                            <span><?php echo e(__('Blogs')); ?></span></a>
                        <ul class="collapse">
                            <li class="<?php echo e(active_menu('admin-home/blog')); ?>"><a href="<?php echo e(route('admin.blog')); ?>"><?php echo e(__('All Blog')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/new-blog')); ?>"><a href="<?php echo e(route('admin.blog.new')); ?>"><?php echo e(__('Add New Post')); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('events_manage')): ?>
                        <li class="
                    <?php echo e(active_menu('admin-home/events')); ?>

                    <?php if(request()->is('admin-home/events/*')): ?> active <?php endif; ?>
                            ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span><?php echo e('Events Manage'); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/events')); ?>"><a
                                        href="<?php echo e(route('admin.events.all')); ?>"><?php echo e('All Events'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/events/category')); ?>"><a
                                        href="<?php echo e(route('admin.events.category.all')); ?>"><?php echo e('Category'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/events/new')); ?>"><a
                                        href="<?php echo e(route('admin.events.new')); ?>"><?php echo e('Add New Event'); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('services')): ?>
                        <li class="
                    <?php if(request()->is('admin-home/services/*')): ?> active <?php endif; ?>
                            <?php echo e(active_menu('admin-home/services')); ?>

                            ">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-layout"></i>
                                <span><?php echo e('Services'); ?></span>
                            </a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/services')); ?>"><a
                                        href="<?php echo e(route('admin.services')); ?>"><?php echo e('New/All Services'); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('knowledgebase')): ?>
                        <li class="<?php echo e(active_menu('admin-home/knowledge')); ?> <?php if(request()->
                            is('admin-home/knowledge/*')): ?> active <?php endif; ?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span><?php echo e('Knowledgebase'); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/knowledge')); ?>"><a
                                        href="<?php echo e(route('admin.knowledge.all')); ?>"><?php echo e('All Articles'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/knowledge/category')); ?>"><a
                                        href="<?php echo e(route('admin.knowledge.category.all')); ?>"><?php echo e('Topics'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/new-knowledge')); ?>"><a
                                        href="<?php echo e(route('admin.knowledge.new')); ?>"><?php echo e('Add New Article'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('faq')): ?>
                        <li class="<?php echo e(active_menu('admin-home/faq')); ?>">
                            <a href="<?php echo e(route('admin.faq')); ?>" aria-expanded="true"><i
                                    class="ti-control-forward"></i>
                                <span><?php echo e('Faq'); ?></span></a>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('order_manage')): ?>
                        <li class="<?php if(request()->is('admin-home/order-manage/*')): ?> active <?php endif; ?> ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-light-bulb"></i>
                                <span><?php echo e('Order Manage'); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/order-manage/all')); ?>"><a
                                        href="<?php echo e(route('admin.order.manage.all')); ?>"><?php echo e('All Order'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/order-manage/pending')); ?>"><a
                                        href="<?php echo e(route('admin.order.manage.pending')); ?>"><?php echo e('Pending Order'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/order-manage/in-progress')); ?>"><a
                                        href="<?php echo e(route('admin.order.manage.in.progress')); ?>"><?php echo e('In Progress Order'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/order-manage/completed')); ?>"><a
                                        href="<?php echo e(route('admin.order.manage.completed')); ?>"><?php echo e('Completed Order'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/order-manage/success-page')); ?>"><a
                                        href="<?php echo e(route('admin.order.success.page')); ?>"><?php echo e('Success Order Page'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/order-manage/cancel-page')); ?>"><a
                                        href="<?php echo e(route('admin.order.cancel.page')); ?>"><?php echo e('Cancel Order Page'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('job_post_manage')): ?>
                        <li class="<?php if(request()->is('admin-home/jobs/*')): ?> active <?php endif; ?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span><?php echo e('Job Post Manage'); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/jobs')); ?>"><a
                                        href="<?php echo e(route('admin.jobs.all')); ?>"><?php echo e('All Jobs'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/jobs/category')); ?>"><a
                                        href="<?php echo e(route('admin.jobs.category.all')); ?>"><?php echo e('Category'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/jobs/new')); ?>"><a
                                        href="<?php echo e(route('admin.jobs.new')); ?>"><?php echo e('Add New Job'); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('price_plan_page_manage')): ?>
                        <li class="<?php echo e(active_menu('admin-home/price-plan-page/settings')); ?>">
                            <a href="<?php echo e(route('admin.price.plan.page.settings')); ?>" aria-expanded="true">
                                <i class="ti-dashboard"></i>
                                <span><?php echo e('Price Plan Page Manage'); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('price_plan')): ?>
                        <li class="<?php echo e(active_menu('admin-home/price-plan')); ?>">
                            <a href="<?php echo e(route('admin.price.plan')); ?>" aria-expanded="true"><i
                                    class="ti-control-forward"></i>
                                <span><?php echo e('Price Plan'); ?></span></a>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('form_builder')): ?>
                        <li class="<?php if(request()->is('admin-home/form-builder/*')): ?> active <?php endif; ?>">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-layout"></i>
                                <span><?php echo e('Form Builder'); ?></span>
                            </a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/form-builder/quote-form')); ?>"><a
                                        href="<?php echo e(route('admin.form.builder.quote')); ?>"><?php echo e('Quote Form'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/form-builder/order-form')); ?>"><a
                                        href="<?php echo e(route('admin.form.builder.order')); ?>"><?php echo e('Order Form'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/form-builder/contact-form')); ?>"><a
                                        href="<?php echo e(route('admin.form.builder.contact')); ?>"><?php echo e('Contact Form'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/form-builder/call-back-form')); ?>"><a
                                        href="<?php echo e(route('admin.form.builder.call.back')); ?>"><?php echo e('Request Call Back Form'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('pages')): ?>
                        <li class="
                        <?php echo e(active_menu('admin-home/page')); ?>

                                <?php echo e(active_menu('admin-home/new-page')); ?>

                                <?php if(request()->is('admin-home/page-edit/*')): ?> active <?php endif; ?>
                            "
                            >
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span><?php echo e('Pages'); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/page')); ?>"><a
                                        href="<?php echo e(route('admin.page')); ?>"><?php echo e('All Pages'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/new-page')); ?>"><a
                                        href="<?php echo e(route('admin.page.new')); ?>"><?php echo e('Add New Page'); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('popup_builder')): ?>
                        <li class="<?php if(request()->is('admin-home/popup-builder/*')): ?> active <?php endif; ?>">
                            <a href="javascript:void(0)"
                               aria-expanded="true">
                                <i class="ti-layout"></i>
                                <span><?php echo e(__('Popup Builder')); ?></span>
                            </a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/popup-builder/all')); ?>"><a
                                            href="<?php echo e(route('admin.popup.builder.all')); ?>"><?php echo e(__('All Popup')); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/popup-builder/new')); ?>"><a
                                            href="<?php echo e(route('admin.popup.builder.new')); ?>"><?php echo e(__('New Popup')); ?></a></li>
                            </ul>
                        </li>
                   <?php endif; ?>
                    <?php if(check_page_permission('menus_manage')): ?>
                    <li class="<?php echo e(active_menu('admin-home/menu')); ?> <?php if(request()->is('admin-home/menu-edit/*')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.menu')); ?>" aria-expanded="true">
                            <i class="ti-write"></i>
                            <span><?php echo e('Menus Manage'); ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('home_page_manage')): ?>
                        <li class="<?php if(request()->is('admin-home/home-page-01/*')): ?> active <?php endif; ?>
                            <?php echo e(active_menu('admin-home/header')); ?>

                            <?php echo e(active_menu('admin-home/keyfeatures')); ?>

                            ">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-home"></i>
                                <span><?php echo e('Home Page Manage'); ?></span>
                            </a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/header')); ?>">
                                    <a href="<?php echo e(route('admin.header')); ?>">
                                        <?php echo e('Header Area'); ?>

                                    </a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/keyfeatures')); ?>">
                                    <a href="<?php echo e(route('admin.keyfeatures')); ?>"><?php echo e('Key Features'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/home-page-01/service-area')); ?>"><a
                                        href="<?php echo e(route('admin.homeone.service.area')); ?>"><?php echo e('Service Area'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/home-page-01/about-us')); ?>"><a
                                        href="<?php echo e(route('admin.homeone.about.us')); ?>"><?php echo e('About Us Area'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/home-page-01/faq-area')); ?>"><a
                                        href="<?php echo e(route('admin.homeone.faq.area')); ?>"><?php echo e('FAQ Area'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/home-page-01/cta-area')); ?>"><a
                                        href="<?php echo e(route('admin.homeone.cta.area')); ?>"><?php echo e('Call To Action Area'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/home-page-01/newsletter')); ?>"><a
                                        href="<?php echo e(route('admin.homeone.newsletter')); ?>"><?php echo e('Newsletter Area'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('about_page_manage')): ?>
                        <li class="<?php if(request()->is('admin-home/about-page/*')): ?> active <?php endif; ?> ">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-home"></i>
                                <span><?php echo e('About Page Manage'); ?></span>
                            </a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/about-page/about-us')); ?>"><a
                                        href="<?php echo e(route('admin.about.page.about')); ?>"><?php echo e('About Us Section'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/about-page/know-about')); ?>"><a
                                        href="<?php echo e(route('admin.about.know')); ?>"><?php echo e('Know Us Section'); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('contact_page_manage')): ?>
                        <li class="<?php if(request()->is('admin-home/contact-page/*')): ?> active <?php endif; ?>">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-home"></i>
                                <span><?php echo e('Contact Page Manage'); ?></span>
                            </a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/contact-page/contact-info')); ?>"><a
                                        href="<?php echo e(route('admin.contact.info')); ?>"><?php echo e('Contact Info'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/contact-page/form-area')); ?>"><a
                                        href="<?php echo e(route('admin.contact.page.form.area')); ?>"><?php echo e('Form Area'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('order_page_manage')): ?>
                        <li class="<?php echo e(active_menu('admin-home/order-page')); ?>">
                            <a href="<?php echo e(route('admin.order.page')); ?>" aria-expanded="true">
                                <i class="ti-dashboard"></i>
                                <span><?php echo e('Order Page Manage'); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('footer_area')): ?>
                        <li class="<?php if(request()->is('admin-home/footer/*')): ?> active <?php endif; ?>">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-layout"></i>
                                <span><?php echo e('Footer Area'); ?></span>
                            </a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/footer/about')); ?>"><a
                                        href="<?php echo e(route('admin.footer.about')); ?>"><?php echo e('About Widget'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/footer/useful-links')); ?>"><a
                                        href="<?php echo e(route('admin.footer.useful.link')); ?>"><?php echo e('Useful Links Widget'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/footer/important-links')); ?>"><a
                                        href="<?php echo e(route('admin.footer.important.link')); ?>"><?php echo e('Important Links Widget'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('general_settings')): ?>
                        <li class="<?php if(request()->is('admin-home/general-settings/*')): ?> active <?php endif; ?>">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                                <span><?php echo e('General Settings'); ?></span></a>
                            <ul class="collapse ">
                                <li class="<?php echo e(active_menu('admin-home/general-settings/site-identity')); ?>"><a
                                        href="<?php echo e(route('admin.general.site.identity')); ?>"><?php echo e('Site Identity'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/basic-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.basic.settings')); ?>"><?php echo e('Basic Settings'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/seo-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.seo.settings')); ?>"><?php echo e('SEO Settings'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/email-template')); ?>"><a
                                        href="<?php echo e(route('admin.general.email.template')); ?>"><?php echo e('Email Template'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/email-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.email.settings')); ?>"><?php echo e('Email Settings'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/popup-settings')); ?>"><a
                                    href="<?php echo e(route('admin.general.popup.settings')); ?>"><?php echo e(__('Popup Settings')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/regenerate-image')); ?>"><a
                                        href="<?php echo e(route('admin.general.regenerate.thumbnail')); ?>"><?php echo e('Regenerate Media Image'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/payment-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.payment.settings')); ?>"><?php echo e('Payment Gateway Settings'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/cache-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.cache.settings')); ?>"><?php echo e('Cache Settings'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/gdpr-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.gdpr.settings')); ?>"><?php echo e('GDPR Compliant Cookies Settings'); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/general-settings/backup-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.backup.settings')); ?>"><?php echo e('Backup Settings'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('admin_role_manage')): ?>
                        <li class="
                        <?php echo e(active_menu('admin-home/new-user')); ?>

                            <?php echo e(active_menu('admin-home/all-user')); ?>

                            <?php echo e(active_menu('admin-home/all-user/role')); ?>

                                    ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>
                                <span><?php echo e('Admin Role Manage'); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/all-user')); ?>"><a
                                        href="<?php echo e(route('admin.all.user')); ?>"><?php echo e('All Admin'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/new-user')); ?>"><a
                                        href="<?php echo e(route('admin.new.user')); ?>"><?php echo e('Add New Admin'); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/all-user/role')); ?>"><a
                                        href="<?php echo e(route('admin.all.user.role')); ?>"><?php echo e('All Admin Role'); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php /**PATH /srv/http/umdaa/umdaa.co/resources/views/backend/partials/sidebar.blade.php ENDPATH**/ ?>