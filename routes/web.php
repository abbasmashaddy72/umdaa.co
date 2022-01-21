<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['globalVariable'])->group(function () {

    Route::get('awstx/{id}', 'AWSTextExtractorController@index');
    
    Route::get('sort_link', 'ShortLinkController@index');  
    Route::post('sort_link', 'ShortLinkController@store')->name('generate.shorten.link.post');  
    Route::get('/s/{code}', 'ShortLinkController@shortenLink')->name('shorten.link');

    Route::get('/', 'FrontendController@index')->name('homepage');
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('frontend.pages.login');
    Route::get('/p/{id}/{any}', 'FrontendController@dynamic_single_page')->name('frontend.dynamic.page');
    Route::get('/services_page', 'FrontendController@dynamic_service_page')->name('frontend.services.page');
    Route::get('/plan-order/{id}', 'FrontendController@plan_order')->name('frontend.plan.order');
    Route::get('/forms', 'FrontendController@request_quote')->name('frontend.request.quote');
    Route::get('/d/{id}/{any}', 'DoctorWebsiteController@doctor_website')->name('frontend.doctor.website');
    Route::get('/d1/{id}/{any}', 'DoctorWebsiteController@doctor_website1')->name('frontend.doctor.website1');
    Route::get('/d2/{id}/{any}', 'DoctorWebsiteController@doctor_website2')->name('frontend.doctor.website2');
    Route::get('/d3/{id}/{any}', 'DoctorWebsiteController@doctor_website3')->name('frontend.doctor.website3');

    //payment status route
    Route::get('/order-success/{id}', 'FrontendController@order_payment_success')->name('frontend.order.payment.success');
    Route::get('/order-cancel/{id}', 'FrontendController@order_payment_cancel')->name('frontend.order.payment.cancel');
    Route::get('/order-confirm/{id}', 'FrontendController@order_confirm')->name('frontend.order.confirm');
    Route::post('/order-confirm','PaymentLogController@DocRegistration')->name('frontend.order.payment.form');
    Route::post('/paytm-ipn', 'PaymentLogController@paytm_ipn')->name('frontend.paytm.ipn');

    Route::post('/contact-message', 'FrontendController@send_contact_message')->name('frontend.contact.message');
    Route::post('/subscribe-newsletter', 'FrontendController@subscribe_newsletter')->name('frontend.subscribe.newsletter');
    Route::post('/forms', 'FrontendController@send_quote_message')->name('frontend.quote.message');
    Route::post('/place-order', 'FrontendController@send_order_message')->name('frontend.order.message');
    Route::post('/request-call-back', 'FrontendController@send_call_back_message')->name('frontend.call.back.message');

    Route::get('/about-us', 'FrontendController@about_page')->name('frontend.about');
    Route::get('/doc-services', 'FrontendController@service_page')->name('frontend.service');
    Route::get('/a-z', 'FrontendController@work_page')->name('frontend.work');
    Route::get('/faq', 'FrontendController@faq_page')->name('frontend.faq');
    Route::get('/doc-services/category/{id}/{any}', 'FrontendController@category_wise_services_page')->name('frontend.services.category');
    Route::get('/a-z/category/{id}/{any}', 'FrontendController@category_wise_works_page')->name('frontend.works.category');
    Route::get('/doc-services/{id}/{any}', 'FrontendController@services_single_page')->name('frontend.services.single');
    Route::get('/a-z/{id}/{any}', 'FrontendController@work_single_page')->name('frontend.work.single');
    Route::get('/doctors', 'FrontendController@team_page')->name('frontend.team');
    Route::get('/doctors/search', 'FrontendController@team_search')->name('frontend.team.search');
    Route::get('/pricing', 'FrontendController@price_plan_page')->name('frontend.price.plan');
    Route::get('/contact-us', 'FrontendController@contact_page')->name('frontend.contact');

    //blogs
    Route::get('/blogs/{id}/{any}', 'FrontendController@blog_single_page')->name('frontend.blog.single');
    Route::get('/mblogs/{id}/{any}', 'FrontendController@m_blog_single_page')->name('frontend.blog.m_single');
    Route::get('/blogs/search/', 'FrontendController@blog_search_page')->name('frontend.blog.search');
    Route::get('/blogs/category/{id}/{any}', 'FrontendController@category_wise_blog_page')->name('frontend.blog.category');
    Route::get('/blogs-tags/{name}', 'FrontendController@tags_wise_blog_page')->name('frontend.blog.tags.page');
    Route::get('/blogs', 'FrontendController@blog_page')->name('frontend.blog');

    //job post
    Route::get('/career-with-us', 'FrontendController@jobs')->name('frontend.jobs');
    Route::get('/career-with-us/{id}/{any}', 'FrontendController@jobs_single')->name('frontend.jobs.single');
    Route::get('/career-with-us-category/{id}/{any}', 'FrontendController@jobs_category')->name('frontend.jobs.category');
    Route::get('/career-with-us/search', 'FrontendController@jobs_search')->name('frontend.jobs.search');

    //events
    Route::get('/events', 'FrontendController@events')->name('frontend.events');
    Route::get('/events/{id}/{any}', 'FrontendController@events_single')->name('frontend.events.single');
    Route::get('/events-category/{id}/{any}', 'FrontendController@events_category')->name('frontend.events.category');
    Route::get('/events/search', 'FrontendController@events_search')->name('frontend.events.search');

    //knowledgebase
    Route::get('/knowledgebase', 'FrontendController@knowledgebase')->name('frontend.knowledgebase');
    Route::get('/knowledgebase/{id}/{any}', 'FrontendController@knowledgebase_single')->name('frontend.knowledgebase.single');
    Route::get('/knowledgebase-category/{id}/{any}', 'FrontendController@knowledgebase_category')->name('frontend.knowledgebase.category');
    Route::get('/knowledgebase/search', 'FrontendController@knowledgebase_search')->name('frontend.knowledgebase.search');
});

//admin login
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::get('/login/admin/forget-password', 'FrontendController@showAdminForgetPasswordForm')->name('admin.forget.password');
Route::get('/login/admin/reset-password/{user}/{token}', 'FrontendController@showAdminResetPasswordForm')->name('admin.reset.password');
Route::post('/login/admin/reset-password', 'FrontendController@AdminResetPassword')->name('admin.reset.password.change');
Route::post('/login/admin/forget-password', 'FrontendController@sendAdminForgetPasswordMail');
Route::post('/logout/admin', 'AdminDashboardController@adminLogout')->name('admin.logout');
Route::post('/login/admin', 'Auth\LoginController@adminLogin');

//events routes
Route::prefix('admin-home')->middleware('events_manage')->group(function () {

    Route::get('/events', 'EventsController@all_events')->name('admin.events.all');
    Route::get('/events/new', 'EventsController@new_event')->name('admin.events.new');
    Route::post('/events/new', 'EventsController@store_event');
    Route::get('/events/edit/{id}', 'EventsController@edit_event')->name('admin.events.edit');
    Route::post('/events/update', 'EventsController@update_event')->name('admin.events.update');
    Route::post('/events/delete/{id}', 'EventsController@delete_event')->name('admin.events.delete');

    //event category
    Route::get('/events/category', 'EventsCategoryController@all_events_category')->name('admin.events.category.all');
    Route::post('/events/category/new', 'EventsCategoryController@store_events_category')->name('admin.events.category.new');
    Route::post('/events/category/update', 'EventsCategoryController@update_events_category')->name('admin.events.category.update');
    Route::post('/events/category/delete/{id}', 'EventsCategoryController@delete_events_category')->name('admin.events.category.delete');
});

//knowledgebase routes
Route::prefix('admin-home')->middleware(['knowledgebase'])->group(function () {

    Route::get('/knowledge', 'KnowledgebaseController@all_knowledgebases')->name('admin.knowledge.all');
    Route::get('/knowledge/new', 'KnowledgebaseController@new_knowledgebase')->name('admin.knowledge.new');
    Route::post('/knowledge/new', 'KnowledgebaseController@store_knowledgebases');
    Route::get('/knowledge/edit/{id}', 'KnowledgebaseController@edit_knowledgebases')->name('admin.knowledge.edit');
    Route::post('/knowledge/update', 'KnowledgebaseController@update_knowledgebases')->name('admin.knowledge.update');
    Route::post('/knowledge/delete/{id}', 'KnowledgebaseController@delete_knowledgebases')->name('admin.knowledge.delete');

    //knowledge base category
    Route::get('/knowledge/category', 'KnowledgebaseTopicsController@all_knowledgebase_category')->name('admin.knowledge.category.all');
    Route::post('/knowledge/category/new', 'KnowledgebaseTopicsController@store_knowledgebase_category')->name('admin.knowledge.category.new');
    Route::post('/knowledge/category/update', 'KnowledgebaseTopicsController@update_knowledgebase_category')->name('admin.knowledge.category.update');
    Route::post('/knowledge/category/delete/{id}', 'KnowledgebaseTopicsController@delete_knowledgebase_category')->name('admin.knowledge.category.delete');
});

//doctor web details
Route::prefix('admin-home')->middleware(['doctor_details_manage'])->group(function () {
        Route::get('/doctor-web-details/doctor-details','DocDetUpdateController@index')->name('admin.doctor.details');
        Route::get('/doctor-web-details/doctor-details/edit/{id}','DocDetUpdateController@edit')->name('admin.doctor.details.edit');
        Route::post('/doctor-web-details/doctor-details/editdpu','DocDetUpdateController@docproupdate')->name('admin.doctor.details.edit.profile');
        Route::post('/doctor-web-details/doctor-details/editadex','DocDetUpdateController@adddocexp')->name('admin.doctor.details.edit.exp');
        Route::post('/doctor-web-details/doctor-details/editadeu','DocDetUpdateController@adddocedu')->name('admin.doctor.details.edit.edu');
        Route::post('/doctor-web-details/doctor-details/editdsu','DocDetUpdateController@docserupdate')->name('admin.doctor.details.edit.service');
        Route::post('/doctor-web-details/doctor-details/updadex','DocDetUpdateController@upddocexp')->name('admin.doctor.details.update.exp');
        Route::post('/doctor-web-details/doctor-details/updadeu','DocDetUpdateController@upddocedu')->name('admin.doctor.details.update.edu');
        Route::post('/doctor-web-details/doctor-details/deladex/{id}','DocDetUpdateController@deldocexp')->name('admin.doctor.details.delete.exp');
        Route::post('/doctor-web-details/doctor-details/deladeu/{id}','DocDetUpdateController@deldocedu')->name('admin.doctor.details.delete.edu');
        Route::get('/doctor-web-details/clinics-details','ClinicUpdateController@index')->name('admin.clinic.details');
        Route::post('/doctor-web-details/clinics-details/update','ClinicUpdateController@updateclinic')->name('admin.clinic.details.update');
    });

// blogs
Route::prefix('admin-home')->middleware(['blogs'])->group(function () {
        Route::get('/blog', 'BlogController@index')->name('admin.blog');
        Route::get('/new-blog', 'BlogController@new_blog')->name('admin.blog.new');
        Route::post('/new-blog', 'BlogController@store_new_blog');
        Route::get('/blog-edit/{id}', 'BlogController@edit_blog')->name('admin.blog.edit');
        Route::post('/blog-update/{id}', 'BlogController@update_blog')->name('admin.blog.update');
        Route::post('/blog-delete/{id}', 'BlogController@delete_blog')->name('admin.blog.delete');
    });
//job post routes
Route::prefix('admin-home')->middleware('job_post_manage')->group(function () {

    Route::get('/jobs', 'JobsController@all_jobs')->name('admin.jobs.all');
    Route::get('/jobs/new', 'JobsController@new_job')->name('admin.jobs.new');
    Route::post('/jobs/new', 'JobsController@store_job');
    Route::get('/jobs/edit/{id}', 'JobsController@edit_job')->name('admin.jobs.edit');
    Route::post('/jobs/update', 'JobsController@update_job')->name('admin.jobs.update');
    Route::post('/jobs/delete/{id}', 'JobsController@delete_job')->name('admin.jobs.delete');

    //job category
    Route::get('/jobs/category', 'JobsCategoryController@all_jobs_category')->name('admin.jobs.category.all');
    Route::post('/jobs/category/new', 'JobsCategoryController@store_jobs_category')->name('admin.jobs.category.new');
    Route::post('/jobs/category/update', 'JobsCategoryController@update_jobs_category')->name('admin.jobs.category.update');
    Route::post('/jobs/category/delete/{id}', 'JobsCategoryController@delete_jobs_category')->name('admin.jobs.category.delete');
});

//quote manage route
Route::prefix('admin-home')->middleware(['quote_manage'])->group(function () {
    Route::get('/quote-manage/all', 'QuoteManageController@all_quotes')->name('admin.quote.manage.all');
    Route::get('/quote-manage/pending', 'QuoteManageController@pending_quotes')->name('admin.quote.manage.pending');
    Route::get('/quote-manage/completed', 'QuoteManageController@completed_quotes')->name('admin.quote.manage.completed');
    Route::post('/quote-manage/change-status', 'QuoteManageController@change_status')->name('admin.quote.manage.change.status');
    Route::post('/quote-manage/send-mail', 'QuoteManageController@send_mail')->name('admin.quote.manage.send.mail');
    Route::post('/quote-manage/delete/{id}', 'QuoteManageController@quote_delete')->name('admin.quote.manage.delete');
});

//order manage route
Route::prefix('admin-home')->middleware(['order_manage'])->group(function () {
    Route::get('/order-manage/all', 'OrderManageController@all_orders')->name('admin.order.manage.all');
    Route::get('/order-manage/pending', 'OrderManageController@pending_orders')->name('admin.order.manage.pending');
    Route::get('/order-manage/completed', 'OrderManageController@completed_orders')->name('admin.order.manage.completed');
    Route::get('/order-manage/in-progress', 'OrderManageController@in_progress_orders')->name('admin.order.manage.in.progress');

    Route::post('/order-manage/change-status', 'OrderManageController@change_status')->name('admin.order.manage.change.status');
    Route::post('/order-manage/send-mail', 'OrderManageController@send_mail')->name('admin.order.manage.send.mail');
    Route::post('/order-manage/delete/{id}', 'OrderManageController@order_delete')->name('admin.order.manage.delete');

    //thank you page
    Route::get('/order-manage/success-page', 'OrderManageController@order_success_payment')->name('admin.order.success.page');
    Route::post('/order-manage/success-page', 'OrderManageController@update_order_success_payment');
    //cancel page
    Route::get('/order-manage/cancel-page', 'OrderManageController@order_cancel_payment')->name('admin.order.cancel.page');
    Route::post('/order-manage/cancel-page', 'OrderManageController@update_order_cancel_payment');
});

/* media upload routes */
Route::prefix('admin-home')->group(function () {
    Route::post('/media-upload/all', 'MediaUploadController@all_upload_media_file')->name('admin.upload.media.file.all');
    Route::post('/media-upload', 'MediaUploadController@upload_media_file')->name('admin.upload.media.file');
});
Route::prefix('admin-home')->group(function () {
    Route::post('/media-upload/delete', 'MediaUploadController@delete_upload_media_file')->name('admin.upload.media.file.delete');
});
/* media upload routes end */

//user role manage
Route::prefix('admin-home')->middleware(['admin_role_manage'])->group(function () {
    //user role management
    Route::get('/new-user', 'UserRoleManageController@new_user')->name('admin.new.user');
    Route::post('/new-user', 'UserRoleManageController@new_user_add');
    Route::post('/user-update', 'UserRoleManageController@user_update')->name('admin.user.update');
    Route::post('/user-password-chnage', 'UserRoleManageController@user_password_change')->name('admin.user.password.change');
    Route::post('/delete-user/{id}', 'UserRoleManageController@new_user_delete')->name('admin.delete.user');
    Route::get('/all-user', 'UserRoleManageController@all_user')->name('admin.all.user');
    Route::get('/all-user/role', 'UserRoleManageController@all_user_role')->name('admin.all.user.role');
    Route::post('/all-user/role', 'UserRoleManageController@add_new_user_role');
    Route::post('/all-user/role/update', 'UserRoleManageController@udpate_user_role')->name('admin.user.role.edit');
    Route::post('/all-user/role/delete/{id}', 'UserRoleManageController@delete_user_role')->name('admin.user.role.delete');
});
//about us page manage
Route::prefix('admin-home')->middleware(['about_page_manage_check'])->group(function () {
    //about page
    Route::get('/about-page/about-us', 'AboutPageController@about_page_about_section')->name('admin.about.page.about');
    Route::post('/about-page/about-us', 'AboutPageController@about_page_update_about_section');
    Route::get('/about-page/know-about', 'AboutPageController@about_page_know_about_section')->name('admin.about.know');
    Route::post('/about-page/know-about', 'AboutPageController@about_page_update_know_about_section');
    Route::post('/about-page/know-about/store', 'KnowAboutController@store')->name('know.about.store');
    Route::post('/about-page/know-about/update', 'KnowAboutController@update')->name('know.about.update');
    Route::post('/about-page/know-about/delete/{id}', 'KnowAboutController@delete')->name('know.about.delete');
});
//contact page manage
Route::prefix('admin-home')->middleware(['contact_page_manage'])->group(function () {
    //contact page
    Route::get('/contact-page/form-area', 'ContactPageController@contact_page_form_area')->name('admin.contact.page.form.area');
    Route::post('/contact-page/form-area', 'ContactPageController@contact_page_update_form_area');
    //contact info
    Route::get('/contact-page/contact-info', 'ContactInfoController@index')->name('admin.contact.info');
    Route::post('/contact-page/contact-info', 'ContactInfoController@store');
    Route::post('/contact-page/contact-info/title', 'ContactInfoController@contact_info_title')->name('admin.contact.info.title');
    Route::post('contact-page/contact-info/update', 'ContactInfoController@update')->name('admin.contact.info.update');
    Route::post('contact-page/contact-info/delete/{id}', 'ContactInfoController@delete')->name('admin.contact.info.delete');
});
//faq
Route::prefix('admin-home')->middleware(['faq'])->group(function () {
    //faq
    Route::get('/faq', 'FaqController@index')->name('admin.faq');
    Route::post('/faq', 'FaqController@store');
    Route::post('/update-faq', 'FaqController@update')->name('admin.faq.update');
    Route::post('/delete-faq/{id}', 'FaqController@delete')->name('admin.faq.delete');
});
//footer
Route::prefix('admin-home')->middleware(['footer_area'])->group(function () {
    //footer
    Route::get('/footer/about', 'FooterController@about_widget')->name('admin.footer.about');
    Route::post('/footer/about', 'FooterController@update_about_widget');
    Route::post('/footer/general', 'FooterController@update_general_widget');
    Route::get('/footer/useful-links', 'FooterController@useful_links_widget')->name('admin.footer.useful.link');
    Route::post('/footer/useful-links/widget', 'FooterController@update_widget_useful_links')->name('admin.footer.useful.link.widget');
    Route::post('/footer/useful-links/menu', 'FooterController@useful_links_widget_menu_by_slug')->name('admin.footer.useful.link.menus');
    Route::get('/footer/important-links', 'FooterController@important_links_widget')->name('admin.footer.important.link');
    Route::post('/footer/important-links/widget', 'FooterController@update_widget_important_links')->name('admin.footer.important.link.widget');
    Route::post('/footer/important-links/slug', 'FooterController@important_links_widget_menu_by_slug')->name('admin.footer.important.link.menu');
});

//form builder
Route::prefix('admin-home')->middleware(['form_builder'])->group(function () {
    //form builder routes
    Route::get('/form-builder/quote-form', 'FormBuilderController@quote_form_index')->name('admin.form.builder.quote');
    Route::post('/form-builder/quote-form', 'FormBuilderController@update_quote_form');
    Route::get('/form-builder/order-form', 'FormBuilderController@order_form_index')->name('admin.form.builder.order');
    Route::post('/form-builder/order-form', 'FormBuilderController@update_order_form');
    Route::get('/form-builder/contact-form', 'FormBuilderController@contact_form_index')->name('admin.form.builder.contact');
    Route::post('/form-builder/contact-form', 'FormBuilderController@update_contact_form');
    Route::get('/form-builder/call-back-form', 'FormBuilderController@call_back_form_index')->name('admin.form.builder.call.back');
    Route::post('/form-builder/call-back-form', 'FormBuilderController@update_call_back_form');
});

//general settings
Route::prefix('admin-home')->middleware(['general_settings'])->group(function () {
    //general settings
    Route::get('/general-settings/site-identity', 'GeneralSettingsController@site_identity')->name('admin.general.site.identity');
    Route::post('/general-settings/site-identity', 'GeneralSettingsController@update_site_identity');
    Route::get('/general-settings/basic-settings', 'GeneralSettingsController@basic_settings')->name('admin.general.basic.settings');
    Route::post('/general-settings/basic-settings', 'GeneralSettingsController@update_basic_settings');
    Route::get('/general-settings/seo-settings', 'GeneralSettingsController@seo_settings')->name('admin.general.seo.settings');
    Route::post('/general-settings/seo-settings', 'GeneralSettingsController@update_seo_settings');
    Route::get('/general-settings/email-template', 'GeneralSettingsController@email_template_settings')->name('admin.general.email.template');
    Route::post('/general-settings/email-template', 'GeneralSettingsController@update_email_template_settings');
    Route::get('/general-settings/email-settings', 'GeneralSettingsController@email_settings')->name('admin.general.email.settings');
    Route::post('/general-settings/email-settings', 'GeneralSettingsController@update_email_settings');
    Route::get('/general-settings/cache-settings', 'GeneralSettingsController@cache_settings')->name('admin.general.cache.settings');
    Route::post('/general-settings/cache-settings', 'GeneralSettingsController@update_cache_settings');
    Route::get('/general-settings/backup-settings', 'GeneralSettingsController@backup_settings')->name('admin.general.backup.settings');
    Route::post('/general-settings/backup-settings', 'GeneralSettingsController@update_backup_settings');
    Route::post('/general-settings/backup-settings/delete', 'GeneralSettingsController@delete_backup_settings')->name('admin.general.backup.settings.delete');
    Route::post('/general-settings/backup-settings/restore', 'GeneralSettingsController@restore_backup_settings')->name('admin.general.backup.settings.restore');
    Route::get('/general-settings/gdpr-settings', 'GeneralSettingsController@gdpr_settings')->name('admin.general.gdpr.settings');
    Route::post('/general-settings/gdpr-settings', 'GeneralSettingsController@update_gdpr_cookie_settings');

    //regenerate media image
    Route::get('/general-settings/regenerate-image', 'GeneralSettingsController@regenerate_image_settings')->name('admin.general.regenerate.thumbnail');
    Route::post('/general-settings/regenerate-image', 'GeneralSettingsController@update_regenerate_image_settings');

    //payment gateway
    Route::get('/general-settings/payment-settings', 'GeneralSettingsController@payment_settings')->name('admin.general.payment.settings');
    Route::post('/general-settings/payment-settings', 'GeneralSettingsController@update_payment_settings');

    // popup builder
    Route::get('/general-settings/popup-settings','GeneralSettingsController@popup_settings')->name('admin.general.popup.settings');
    Route::post('/general-settings/popup-settings','GeneralSettingsController@update_popup_settings');
});

// POpup Builder
Route::prefix('admin-home')->middleware(['popup_builder'])->group(function (){
    //popup page
    Route::get('/popup-builder/all','PopupBuilderController@all_popup')->name('admin.popup.builder.all');
    Route::get('/popup-builder/new','PopupBuilderController@new_popup')->name('admin.popup.builder.new');
    Route::post('/popup-builder/new','PopupBuilderController@store_popup');
    Route::get('/popup-builder/edit/{id}','PopupBuilderController@edit_popup')->name('admin.popup.builder.edit');
    Route::post('/popup-builder/update/{id}','PopupBuilderController@update_popup')->name('admin.popup.builder.update');
    Route::post('/popup-builder/delete/{id}','PopupBuilderController@delete_popup')->name('admin.popup.builder.delete');
});

//home page manage
Route::prefix('admin-home')->middleware(['home_page_manage'])->group(function () {
    //home page one
    Route::post('/home-page-01/counterup', 'HomePageController@home_01_update_counterup');
    Route::post('/home-page-01/latest-news', 'HomePageController@home_01_update_latest_news');
    Route::post('/home-page-01/testimonial', 'HomePageController@home_01_update_testimonial');
    Route::get('/home-page-01/service-area', 'HomePageController@home_01_service_area')->name('admin.homeone.service.area');
    Route::post('/home-page-01/service-area', 'HomePageController@home_01_update_service_area');
    Route::post('/home-page-01/recent-work', 'HomePageController@home_01_update_recent_work');
    Route::get('/home-page-01/about-us', 'HomePageController@home_01_about_us')->name('admin.homeone.about.us');
    Route::post('/home-page-01/about-us', 'HomePageController@home_01_update_about_us');
    Route::get('/home-page-01/newsletter', 'HomePageController@home_01_newsletter')->name('admin.homeone.newsletter');
    Route::post('/home-page-01/newsletter', 'HomePageController@home_01_update_newsletter');
    Route::get('/home-page-01/cta-area', 'HomePageController@home_01_cta_area')->name('admin.homeone.cta.area');
    Route::post('/home-page-01/cta-area', 'HomePageController@home_01_update_cta_area');
    Route::post('/home-page-01/price-plan', 'HomePageController@home_01_update_price_plan');
    Route::post('/home-page-01/team-member', 'HomePageController@home_01_update_team_member');
    Route::get('/home-page-01/faq-area', 'HomePageController@home_01_faq_area')->name('admin.homeone.faq.area');
    Route::post('/home-page-01/faq-area', 'HomePageController@home_01_update_faq_area');
    //key features
    Route::get('/keyfeatures', 'KeyFeaturesController@index')->name('admin.keyfeatures');
    Route::post('/keyfeatures', 'KeyFeaturesController@store');
    Route::post('/home-page-01/keyfeatures', 'KeyFeaturesController@update_section_settings')->name('admin.keyfeature.section');
    Route::post('/update-keyfeatures', 'KeyFeaturesController@update')->name('admin.keyfeatures.update');
    Route::post('/delete-keyfeatures/{id}', 'KeyFeaturesController@delete')->name('admin.keyfeatures.delete');

    //header slider
    Route::get('/header', 'HeaderSliderController@index')->name('admin.header');
    Route::post('/header', 'HeaderSliderController@store');
    Route::post('/update-header', 'HeaderSliderController@update')->name('admin.header.update');
    Route::post('/delete-header/{id}', 'HeaderSliderController@delete')->name('admin.header.delete');
});
//menu manage
Route::prefix('admin-home')->middleware(['menus_manage'])->group(function () {
    //menu manage
    Route::get('/menu', 'MenuController@index')->name('admin.menu');
    Route::post('/new-menu', 'MenuController@store_new_menu')->name('admin.menu.new');
    Route::get('/menu-edit/{id}', 'MenuController@edit_menu')->name('admin.menu.edit');
    Route::post('/menu-update/{id}', 'MenuController@update_menu')->name('admin.menu.update');
    Route::post('/menu-delete/{id}', 'MenuController@delete_menu')->name('admin.menu.delete');
    Route::post('/menu-default/{id}', 'MenuController@set_default_menu')->name('admin.menu.default');
});
//navbar settings
Route::prefix('admin-home')->middleware(['nabvar_settings'])->group(function () {
    //navbar settings
    Route::post('/navbar-settings', "AdminDashboardController@update_navbar_settings");
});
//newsletter manage
Route::prefix('admin-home')->middleware(['newsletter_manage'])->group(function () {

    //newsletter
    Route::get('/newsletter', 'NewsletterController@index')->name('admin.newsletter');
    Route::post('/newsletter/delete/{id}', 'NewsletterController@delete')->name('admin.newsletter.delete');
    Route::post('/newsletter/single', 'NewsletterController@send_mail')->name('admin.newsletter.single.mail');
    Route::get('/newsletter/all', 'NewsletterController@send_mail_all_index')->name('admin.newsletter.mail');
    Route::post('/newsletter/all', 'NewsletterController@send_mail_all');
    Route::post('/newsletter/new', 'NewsletterController@add_new_sub')->name('admin.newsletter.new.add');
});
//order page
Route::prefix('admin-home')->middleware(['order_page_manage'])->group(function () {
    //order
    Route::get('/order-page', 'OrderPageController@index')->name('admin.order.page');
    Route::post('/order-page', 'OrderPageController@udpate');
});
//pages
Route::prefix('admin-home')->middleware(['pages'])->group(function () {
    //pages
    Route::get('/page', 'PagesController@index')->name('admin.page');
    Route::get('/new-page', 'PagesController@new_page')->name('admin.page.new');
    Route::post('/new-page', 'PagesController@store_new_page');
    Route::get('/page-edit/{id}', 'PagesController@edit_page')->name('admin.page.edit');
    Route::post('/page-update/{id}', 'PagesController@update_page')->name('admin.page.update');
    Route::post('/page-delete/{id}', 'PagesController@delete_page')->name('admin.page.delete');
});
//price plan
Route::prefix('admin-home')->middleware(['price_plan'])->group(function () {
    //price plan
    Route::get('/price-plan', 'PricePlanController@index')->name('admin.price.plan');
    Route::post('/price-plan', 'PricePlanController@store');
    Route::post('/update-price-plan', 'PricePlanController@update')->name('admin.price.plan.update');
    Route::post('/delete-price-plan/{id}', 'PricePlanController@delete')->name('admin.price.plan.delete');
});
//price plan page manage
Route::prefix('admin-home')->middleware(['price_plan_page_manage'])->group(function () {
    // price plan page
    Route::get('/price-plan-page/settings', 'PricePlanPageController@price_plan_page_settings')->name('admin.price.plan.page.settings');
    Route::post('/price-plan-page/settings', 'PricePlanPageController@update_price_plan_page_settings');
});

//quote page manage
Route::prefix('admin-home')->middleware(['quote_page_manage'])->group(function () {
    //quote
    Route::get('/quote-page', 'QuotePageController@index')->name('admin.quote.page');
    Route::post('/quote-page', 'QuotePageController@udpate');
});
//services
Route::prefix('admin-home')->middleware(['services'])->group(function () {
    //services
    Route::get('/services', 'ServiceController@index')->name('admin.services');
    Route::post('/services', 'ServiceController@store');
    Route::post('/update-services', 'ServiceController@update')->name('admin.services.update');
    Route::post('/delete-services/{id}', 'ServiceController@delete')->name('admin.services.delete');
});
//works
Route::prefix('admin-home')->middleware(['works'])->group(function () {
    //works
    Route::get('/works', 'WorksController@index')->name('admin.work');
    Route::post('/works', 'WorksController@store');
    Route::post('/update-works', 'WorksController@update')->name('admin.work.update');
    Route::post('/delete-works/{id}', 'WorksController@delete')->name('admin.work.delete');

    Route::get('/works/category', 'WorksController@category_index')->name('admin.work.category');
    Route::post('/works/category', 'WorksController@category_store');
    Route::post('/update-works-category', 'WorksController@category_update')->name('admin.work.category.update');
    Route::post('/delete-works-category/{id}', 'WorksController@category_delete')->name('admin.work.category.delete');
});

Route::prefix('admin-home')->group(function () {

    Route::get('/', 'AdminDashboardController@adminIndex')->name('admin.home');

    // maintains page
    Route::get('/maintains-page/settings', 'MaintainsPageController@maintains_page_settings')->name('admin.maintains.page.settings');
    Route::post('/maintains-page/settings', 'MaintainsPageController@update_maintains_page_settings');

    //admin settings
    Route::get('/profile-update', 'AdminDashboardController@admin_profile')->name('admin.profile.update');
    Route::post('/profile-update', 'AdminDashboardController@admin_profile_update');
    Route::get('/password-change', 'AdminDashboardController@admin_password')->name('admin.password.change');
    Route::post('/password-change', 'AdminDashboardController@admin_password_chagne');
});
