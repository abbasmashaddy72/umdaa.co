<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.home') }}">
                @php
                    $site_logo = get_attachment_image_by_id(get_static_option('site_logo'), 'full', false);
                @endphp
                @if (!empty($site_logo))
                    <img src="{{ $site_logo['img_url'] }}" alt="{{ 'UMDAA Health Care' }}">
                @endif
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ active_menu('admin-home') }}">
                        <a href="{{ route('admin.home') }}" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>{{ ('Dashboard') }}</span>
                        </a>
                    </li>
                    <li class="{{ active_menu('admin-home/maintains-page/settings') }}">
                        <a href="{{ route('admin.maintains.page.settings') }}" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>{{ 'Maintain Page Manage' }}</span>
                        </a>
                    </li>
                    @if (check_page_permission('newsletter_manage'))
                        <li class="
                            {{ active_menu('admin-home/newsletter') }}
                            @if (request()->is('admin-home/newsletter/*')) active @endif
                            "
                            >
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-email"></i>
                                <span>{{ 'Newsletter Manage' }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/newsletter') }}"><a
                                        href="{{ route('admin.newsletter') }}">{{ 'All Subscriber' }}</a></li>
                                <li class="{{ active_menu('admin-home/newsletter/all') }}"><a
                                        href="{{ route('admin.newsletter.mail') }}">{{ 'Send Mail To All' }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('quote_manage'))
                        <li class="@if (request()->is('admin-home/quote-manage/*')) active @endif ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-quote-left"></i>
                                <span>{{ 'Quote Manage' }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/quote-manage/all') }}"><a
                                        href="{{ route('admin.quote.manage.all') }}">{{ 'All Quote' }}</a></li>
                                <li class="{{ active_menu('admin-home/quote-manage/pending') }}"><a
                                        href="{{ route('admin.quote.manage.pending') }}">{{ 'Pending Quote' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/quote-manage/completed') }}"><a
                                        href="{{ route('admin.quote.manage.completed') }}">{{ 'Complete Quote' }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('doctor_details_manage'))
                        <li class="@if (request()->is('admin-home/doctor-web-details/*')) active @endif ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-quote-left"></i>
                                <span>{{ 'Doctors & Clinic Details' }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/doctor-web-details/doctor-details') }}"><a
                                        href="{{ route('admin.doctor.details') }}">{{ 'Registed Doctor List' }}</a></li>
                                <li class="{{ active_menu('admin-home/doctor-web-details/clinics-details') }}"><a
                                        href="{{ route('admin.clinic.details') }}">{{ 'Registed Clinic List' }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('quote_page_manage'))
                        <li class="{{ active_menu('admin-home/quote-page') }}">
                            <a href="{{ route('admin.quote.page') }}" aria-expanded="true">
                                <i class="ti-dashboard"></i>
                                <span>{{ 'Quote Page Manage' }}</span>
                            </a>
                        </li>
                    @endif
                    @if (check_page_permission('works'))
                        <li class="
                    @if (request()->is('admin-home/works/*')) active @endif
                            {{ active_menu('admin-home/works') }}
                            ">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-layout"></i>
                                <span>{{ 'Works' }}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/works') }}"><a
                                        href="{{ route('admin.work') }}">{{ 'New/All Works' }}</a></li>
                                <li class="{{ active_menu('admin-home/works/category') }}"><a
                                        href="{{ route('admin.work.category') }}">{{ 'Category' }}</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(check_page_permission('blogs'))
                    <li class="
                        {{active_menu('admin-home/blog')}}
                                {{active_menu('admin-home/new-blog')}}
                                @if(request()->is('admin-home/blog-edit/*')) active @endif
                                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{__('Blogs')}}</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/blog')}}"><a href="{{route('admin.blog')}}">{{__('All Blog')}}</a></li>
                            <li class="{{active_menu('admin-home/new-blog')}}"><a href="{{route('admin.blog.new')}}">{{__('Add New Post')}}</a></li>
                        </ul>
                    </li>
                    @endif
                    @if (check_page_permission('events_manage'))
                        <li class="
                    {{ active_menu('admin-home/events') }}
                    @if (request()->is('admin-home/events/*')) active @endif
                            ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{ 'Events Manage' }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/events') }}"><a
                                        href="{{ route('admin.events.all') }}">{{ 'All Events' }}</a></li>
                                <li class="{{ active_menu('admin-home/events/category') }}"><a
                                        href="{{ route('admin.events.category.all') }}">{{ 'Category' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/events/new') }}"><a
                                        href="{{ route('admin.events.new') }}">{{ 'Add New Event' }}</a></li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('services'))
                        <li class="
                    @if (request()->is('admin-home/services/*')) active @endif
                            {{ active_menu('admin-home/services') }}
                            ">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-layout"></i>
                                <span>{{ 'Services' }}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/services') }}"><a
                                        href="{{ route('admin.services') }}">{{ 'New/All Services' }}</a></li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('knowledgebase'))
                        <li class="{{ active_menu('admin-home/knowledge') }} @if (request()->
                            is('admin-home/knowledge/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{ 'Knowledgebase' }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/knowledge') }}"><a
                                        href="{{ route('admin.knowledge.all') }}">{{ 'All Articles' }}</a></li>
                                <li class="{{ active_menu('admin-home/knowledge/category') }}"><a
                                        href="{{ route('admin.knowledge.category.all') }}">{{ 'Topics' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/new-knowledge') }}"><a
                                        href="{{ route('admin.knowledge.new') }}">{{ 'Add New Article' }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('faq'))
                        <li class="{{ active_menu('admin-home/faq') }}">
                            <a href="{{ route('admin.faq') }}" aria-expanded="true"><i
                                    class="ti-control-forward"></i>
                                <span>{{ 'Faq' }}</span></a>
                        </li>
                    @endif
                    @if (check_page_permission('order_manage'))
                        <li class="@if (request()->is('admin-home/order-manage/*')) active @endif ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-light-bulb"></i>
                                <span>{{ 'Order Manage' }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/order-manage/all') }}"><a
                                        href="{{ route('admin.order.manage.all') }}">{{ 'All Order' }}</a></li>
                                <li class="{{ active_menu('admin-home/order-manage/pending') }}"><a
                                        href="{{ route('admin.order.manage.pending') }}">{{ 'Pending Order' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/order-manage/in-progress') }}"><a
                                        href="{{ route('admin.order.manage.in.progress') }}">{{ 'In Progress Order' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/order-manage/completed') }}"><a
                                        href="{{ route('admin.order.manage.completed') }}">{{ 'Completed Order' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/order-manage/success-page') }}"><a
                                        href="{{ route('admin.order.success.page') }}">{{ 'Success Order Page' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/order-manage/cancel-page') }}"><a
                                        href="{{ route('admin.order.cancel.page') }}">{{ 'Cancel Order Page' }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('job_post_manage'))
                        <li class="@if (request()->is('admin-home/jobs/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{ 'Job Post Manage' }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/jobs') }}"><a
                                        href="{{ route('admin.jobs.all') }}">{{ 'All Jobs' }}</a></li>
                                <li class="{{ active_menu('admin-home/jobs/category') }}"><a
                                        href="{{ route('admin.jobs.category.all') }}">{{ 'Category' }}</a></li>
                                <li class="{{ active_menu('admin-home/jobs/new') }}"><a
                                        href="{{ route('admin.jobs.new') }}">{{ 'Add New Job' }}</a></li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('price_plan_page_manage'))
                        <li class="{{ active_menu('admin-home/price-plan-page/settings') }}">
                            <a href="{{ route('admin.price.plan.page.settings') }}" aria-expanded="true">
                                <i class="ti-dashboard"></i>
                                <span>{{ 'Price Plan Page Manage' }}</span>
                            </a>
                        </li>
                    @endif
                    @if (check_page_permission('price_plan'))
                        <li class="{{ active_menu('admin-home/price-plan') }}">
                            <a href="{{ route('admin.price.plan') }}" aria-expanded="true"><i
                                    class="ti-control-forward"></i>
                                <span>{{ 'Price Plan' }}</span></a>
                        </li>
                    @endif
                    @if (check_page_permission('form_builder'))
                        <li class="@if (request()->is('admin-home/form-builder/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-layout"></i>
                                <span>{{ 'Form Builder' }}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/form-builder/quote-form') }}"><a
                                        href="{{ route('admin.form.builder.quote') }}">{{ 'Quote Form' }}</a></li>
                                <li class="{{ active_menu('admin-home/form-builder/order-form') }}"><a
                                        href="{{ route('admin.form.builder.order') }}">{{ 'Order Form' }}</a></li>
                                <li class="{{ active_menu('admin-home/form-builder/contact-form') }}"><a
                                        href="{{ route('admin.form.builder.contact') }}">{{ 'Contact Form' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/form-builder/call-back-form') }}"><a
                                        href="{{ route('admin.form.builder.call.back') }}">{{ 'Request Call Back Form' }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('pages'))
                        <li class="
                        {{ active_menu('admin-home/page') }}
                                {{ active_menu('admin-home/new-page') }}
                                @if (request()->is('admin-home/page-edit/*')) active @endif
                            "
                            >
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{ 'Pages' }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/page') }}"><a
                                        href="{{ route('admin.page') }}">{{ 'All Pages' }}</a></li>
                                <li class="{{ active_menu('admin-home/new-page') }}"><a
                                        href="{{ route('admin.page.new') }}">{{ 'Add New Page' }}</a></li>
                            </ul>
                        </li>
                    @endif
                    @if(check_page_permission('popup_builder'))
                        <li class="@if(request()->is('admin-home/popup-builder/*')) active @endif">
                            <a href="javascript:void(0)"
                               aria-expanded="true">
                                <i class="ti-layout"></i>
                                <span>{{__('Popup Builder')}}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/popup-builder/all')}}"><a
                                            href="{{route('admin.popup.builder.all')}}">{{__('All Popup')}}</a></li>
                                <li class="{{active_menu('admin-home/popup-builder/new')}}"><a
                                            href="{{route('admin.popup.builder.new')}}">{{__('New Popup')}}</a></li>
                            </ul>
                        </li>
                   @endif
                    @if (check_page_permission('menus_manage'))
                    <li class="{{ active_menu('admin-home/menu') }} @if (request()->is('admin-home/menu-edit/*')) active @endif">
                        <a href="{{ route('admin.menu') }}" aria-expanded="true">
                            <i class="ti-write"></i>
                            <span>{{ 'Menus Manage' }}</span>
                        </a>
                    </li>
                    @endif
                    @if (check_page_permission('home_page_manage'))
                        <li class="@if (request()->is('admin-home/home-page-01/*')) active @endif
                            {{ active_menu('admin-home/header') }}
                            {{ active_menu('admin-home/keyfeatures') }}
                            ">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-home"></i>
                                <span>{{ 'Home Page Manage' }}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/header') }}">
                                    <a href="{{ route('admin.header') }}">
                                        {{ 'Header Area' }}
                                    </a>
                                </li>
                                <li class="{{ active_menu('admin-home/keyfeatures') }}">
                                    <a href="{{ route('admin.keyfeatures') }}">{{ 'Key Features' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/home-page-01/service-area') }}"><a
                                        href="{{ route('admin.homeone.service.area') }}">{{ 'Service Area' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/home-page-01/about-us') }}"><a
                                        href="{{ route('admin.homeone.about.us') }}">{{ 'About Us Area' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/home-page-01/faq-area') }}"><a
                                        href="{{ route('admin.homeone.faq.area') }}">{{ 'FAQ Area' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/home-page-01/cta-area') }}"><a
                                        href="{{ route('admin.homeone.cta.area') }}">{{ 'Call To Action Area' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/home-page-01/newsletter') }}"><a
                                        href="{{ route('admin.homeone.newsletter') }}">{{ 'Newsletter Area' }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('about_page_manage'))
                        <li class="@if (request()->is('admin-home/about-page/*')) active @endif ">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-home"></i>
                                <span>{{ 'About Page Manage' }}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/about-page/about-us') }}"><a
                                        href="{{ route('admin.about.page.about') }}">{{ 'About Us Section' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/about-page/know-about') }}"><a
                                        href="{{ route('admin.about.know') }}">{{ 'Know Us Section' }}</a></li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('contact_page_manage'))
                        <li class="@if (request()->is('admin-home/contact-page/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-home"></i>
                                <span>{{ 'Contact Page Manage' }}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/contact-page/contact-info') }}"><a
                                        href="{{ route('admin.contact.info') }}">{{ 'Contact Info' }}</a></li>
                                <li class="{{ active_menu('admin-home/contact-page/form-area') }}"><a
                                        href="{{ route('admin.contact.page.form.area') }}">{{ 'Form Area' }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('order_page_manage'))
                        <li class="{{ active_menu('admin-home/order-page') }}">
                            <a href="{{ route('admin.order.page') }}" aria-expanded="true">
                                <i class="ti-dashboard"></i>
                                <span>{{ 'Order Page Manage' }}</span>
                            </a>
                        </li>
                    @endif
                    @if (check_page_permission('footer_area'))
                        <li class="@if (request()->is('admin-home/footer/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true">
                                <i class="ti-layout"></i>
                                <span>{{ 'Footer Area' }}</span>
                            </a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/footer/about') }}"><a
                                        href="{{ route('admin.footer.about') }}">{{ 'About Widget' }}</a></li>
                                <li class="{{ active_menu('admin-home/footer/useful-links') }}"><a
                                        href="{{ route('admin.footer.useful.link') }}">{{ 'Useful Links Widget' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/footer/important-links') }}"><a
                                        href="{{ route('admin.footer.important.link') }}">{{ 'Important Links Widget' }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('general_settings'))
                        <li class="@if (request()->is('admin-home/general-settings/*')) active @endif">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                                <span>{{ 'General Settings' }}</span></a>
                            <ul class="collapse ">
                                <li class="{{ active_menu('admin-home/general-settings/site-identity') }}"><a
                                        href="{{ route('admin.general.site.identity') }}">{{ 'Site Identity' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/general-settings/basic-settings') }}"><a
                                        href="{{ route('admin.general.basic.settings') }}">{{ 'Basic Settings' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/general-settings/seo-settings') }}"><a
                                        href="{{ route('admin.general.seo.settings') }}">{{ 'SEO Settings' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/general-settings/email-template') }}"><a
                                        href="{{ route('admin.general.email.template') }}">{{ 'Email Template' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/general-settings/email-settings') }}"><a
                                        href="{{ route('admin.general.email.settings') }}">{{ 'Email Settings' }}</a>
                                </li>
                                <li class="{{active_menu('admin-home/general-settings/popup-settings')}}"><a
                                    href="{{route('admin.general.popup.settings')}}">{{__('Popup Settings')}}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/general-settings/regenerate-image') }}"><a
                                        href="{{ route('admin.general.regenerate.thumbnail') }}">{{ 'Regenerate Media Image' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/general-settings/payment-settings') }}"><a
                                        href="{{ route('admin.general.payment.settings') }}">{{ 'Payment Gateway Settings' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/general-settings/cache-settings') }}"><a
                                        href="{{ route('admin.general.cache.settings') }}">{{ 'Cache Settings' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/general-settings/gdpr-settings') }}"><a
                                        href="{{ route('admin.general.gdpr.settings') }}">{{ 'GDPR Compliant Cookies Settings' }}</a>
                                </li>
                                <li class="{{ active_menu('admin-home/general-settings/backup-settings') }}"><a
                                        href="{{ route('admin.general.backup.settings') }}">{{ 'Backup Settings' }}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if (check_page_permission('admin_role_manage'))
                        <li class="
                        {{ active_menu('admin-home/new-user') }}
                            {{ active_menu('admin-home/all-user') }}
                            {{ active_menu('admin-home/all-user/role') }}
                                    ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>
                                <span>{{ 'Admin Role Manage' }}</span></a>
                            <ul class="collapse">
                                <li class="{{ active_menu('admin-home/all-user') }}"><a
                                        href="{{ route('admin.all.user') }}">{{ 'All Admin' }}</a></li>
                                <li class="{{ active_menu('admin-home/new-user') }}"><a
                                        href="{{ route('admin.new.user') }}">{{ 'Add New Admin' }}</a></li>
                                <li class="{{ active_menu('admin-home/all-user/role') }}"><a
                                        href="{{ route('admin.all.user.role') }}">{{ 'All Admin Role' }}</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
