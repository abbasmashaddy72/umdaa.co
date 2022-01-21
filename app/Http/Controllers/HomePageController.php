<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function home_01_update_counterup(Request $request){
        /**

         * @post('/admin-home/home-page-01/counterup')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */

        $this->validate($request ,[
            'home_01_counterup_bg_image' => 'nullable|string|max:191'
        ]);
        $save_data = [
            'home_01_counterup_bg_image'
        ];
        foreach ($save_data as $item){
            if (empty($request->$item)){continue;}
            update_static_option($item,$request->$item);
        }

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }
    public function home_01_about_us(){
        /**

         * @get('/admin-home/home-page-01/about-us')
         * @name('admin.homeone.about.us')
         * @middlewares(web, home_page_manage, auth:admin)
         */
        return view('backend.pages.home.home-01.about-us');
    }

    public function home_01_update_about_us(Request $request){
        /**

         * @post('/admin-home/home-page-01/about-us')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */

            $this->validate($request,[
                'home_page_01_about_us_title' => 'nullable|string|max:191',
                'home_page_01_about_us_description' => 'nullable|string',
                'home_page_01_about_us_button_title' => 'nullable|string|max:191',
                'home_page_01_about_us_button_url' => 'nullable|string|max:191',
                'home_page_01_about_us_signature_text' => 'nullable|string|max:191',
                'home_page_01_about_us_quote_box_title' => 'nullable|string|max:191',
                'home_page_01_about_us_quote_box_description' => 'nullable|string|max:191',
                'home_page_01_about_us_experience_title' => 'nullable|string|max:191',
                'home_page_01_about_us_experience_year' => 'nullable|string|max:191',
                'home_page_01_about_us_experience_background_image' => 'nullable|string|max:191',
                'home_page_01_about_us_right_image' => 'nullable|string|max:191',
                'home_page_01_about_us_background_image' => 'nullable|string|max:191',
                'home_page_02_about_us_background_image' => 'nullable|string|max:191',
                'home_page_01_about_us_signature_image' => 'nullable|string|max:191',
            ]);
            $save_data = [
                'home_page_01_about_us_title',
                'home_page_01_about_us_description',
                'home_page_01_about_us_button_title',
                'home_page_01_about_us_button_url',
                'home_page_01_about_us_signature_text',
                'home_page_01_about_us_quote_box_description',
                'home_page_01_about_us_experience_title',
                'home_page_01_about_us_experience_year',
                'home_page_01_about_us_quote_box_title',
                'home_page_01_about_us_signature_image',
                'home_page_01_about_us_background_image',
                'home_page_02_about_us_background_image',
                'home_page_01_about_us_right_image',
                'home_page_01_about_us_experience_background_image'
            ];
            foreach ($save_data as $item){
                if (empty($request->$item)){continue;}
                update_static_option($item,$request->$item);
            }

            $_about_us_button_status = 'home_page_01_about_us_button_status';
            update_static_option('home_page_01_about_us_button_status',$request->$_about_us_button_status);


        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_update_testimonial(Request $request){
        /**

         * @post('/admin-home/home-page-01/testimonial')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */

        $this->validate($request,[
           'home_01_testimonial_bg' => 'nullable|string|max:191',
           'home_03_testimonial_bg' => 'nullable|string|max:191'
        ]);
        $save_data = [
            'home_01_testimonial_bg',
            'home_03_testimonial_bg'
        ];
        foreach ($save_data as $item){
            if (empty($request->$item)){continue;}
            update_static_option($item,$request->$item);
        }

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_update_latest_news(Request $request){
        /**

         * @post('/admin-home/home-page-01/latest-news')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */

            $this->validate($request,[
                'home_page_01_latest_news_title' => 'nullable|string',
                'home_page_01_latest_news_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_latest_news_title';
            $field_two = 'home_page_01_latest_news_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_two,$request->$field_two);

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }


    public function home_01_service_area(){
        /**

         * @get('/admin-home/home-page-01/service-area')
         * @name('admin.homeone.service.area')
         * @middlewares(web, home_page_manage, auth:admin)
         */
        return view('backend.pages.home.home-01.service-area');
    }
    public function home_01_update_service_area(Request $request){
        /**

         * @post('/admin-home/home-page-01/service-area')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */
        $this->validate($request,[
            'home_page_01_service_area_items' => 'required|string',
            'home_page_01_service_area_background_image' => 'nullable|string|max:191',
        ]);

            $this->validate($request,[
                'home_page_01_service_area_title' => 'nullable|string',
                'home_page_01_service_area_description' => 'nullable|string'
            ]);
            $field_name = 'home_page_01_service_area_title';
            $field_name_two = 'home_page_01_service_area_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);
        update_static_option('home_page_01_service_area_items', $request->home_page_01_service_area_items);
        update_static_option('home_page_01_service_area_background_image', $request->home_page_01_service_area_background_image);

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_update_recent_work(Request $request){
        /**

         * @post('/admin-home/home-page-01/recent-work')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */
            $this->validate($request,[
                'home_page_01_recent_work_title' => 'nullable|string',
                'home_page_01_recent_work_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_recent_work_title';
            $field_name_two = 'home_page_01_recent_work_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_update_price_plan(Request $request){
        /**

         * @post('/admin-home/home-page-01/price-plan')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */

        $this->validate($request,[
            'home_page_01_price_plan_section_items' => 'required|string',
        ]);

            $this->validate($request,[
                'home_page_01_price_plan_section_title' => 'nullable|string',
                'home_page_01_price_plan_section_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_price_plan_section_title';
            $_price_plan_section_description = 'home_page_01_price_plan_section_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($_price_plan_section_description,$request->$_price_plan_section_description);

        update_static_option('home_page_01_price_plan_section_items',$request->home_page_01_price_plan_section_items);

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_update_team_member(Request $request){
        /**

         * @post('/admin-home/home-page-01/team-member')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */

            $this->validate($request,[
                'home_page_01_team_member_section_title' => 'nullable|string',
                'home_page_01_team_member_section_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_team_member_section_title';
            $field_name_two = 'home_page_01_team_member_section_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_newsletter()
    {
        /**

         * @get('/admin-home/home-page-01/newsletter')
         * @name('admin.homeone.newsletter')
         * @middlewares(web, home_page_manage, auth:admin)
         */
        return view('backend.pages.home.home-01.newsletter');
    }

    public function home_01_update_newsletter(Request $request){
        /**

         * @post('/admin-home/home-page-01/newsletter')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */
            $this->validate($request,[
                'home_page_01_newsletter_area_title' => 'nullable|string',
                'home_page_01_newsletter_area_description' => 'nullable|string',
            ]);
            $field_name = 'home_page_01_newsletter_area_title';
            $field_name_two = 'home_page_01_newsletter_area_description';
            update_static_option($field_name,$request->$field_name);
            update_static_option($field_name_two,$request->$field_name_two);

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_cta_area(){
        /**

         * @get('/admin-home/home-page-01/cta-area')
         * @name('admin.homeone.cta.area')
         * @middlewares(web, home_page_manage, auth:admin)
         */
        return view('backend.pages.home.home-01.cta-area');
    }
    public function home_01_update_cta_area(Request $request){
        /**

         * @post('/admin-home/home-page-01/cta-area')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */
            $this->validate($request,[
                'home_page_01_cta_area_title' => 'nullable|string',
                'home_page_01_cta_area_description' => 'nullable|string',
                'home_page_01_cta_area_description' => 'nullable|string',
                'home_page_01_cta_area_button_title' => 'nullable|string',
                'home_page_01_cta_area_button_url' => 'nullable|string',
                'home_page_01_cta_background_image' => 'nullable|string|max:191',
            ]);

            $_cta_area_title = 'home_page_01_cta_area_title';
            $_cta_area_description = 'home_page_01_cta_area_description';
            $_cta_area_button_status = 'home_page_01_cta_area_button_status';
            $_cta_area_button_title = 'home_page_01_cta_area_button_title';
            $_cta_area_button_url = 'home_page_01_cta_area_button_url';
            $_cta_background_image = 'home_page_01_cta_background_image';

            update_static_option($_cta_area_button_url,$request->$_cta_area_button_url);
            update_static_option($_cta_area_button_title,$request->$_cta_area_button_title);
            update_static_option($_cta_area_title,$request->$_cta_area_title);
            update_static_option($_cta_area_description,$request->$_cta_area_description);
            update_static_option($_cta_area_button_status,$request->$_cta_area_button_status);
            update_static_option($_cta_background_image, $request->$_cta_background_image);

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

    public function home_01_faq_area(){
        /**

         * @get('/admin-home/home-page-01/faq-area')
         * @name('admin.homeone.faq.area')
         * @middlewares(web, home_page_manage, auth:admin)
         */
        return view('backend.pages.home.home-01.faq-area');
    }
    public function home_01_update_faq_area(Request $request){
        /**

         * @post('/admin-home/home-page-01/faq-area')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */

        $this->validate($request,[
            'home_page_01_faq_area_items' => 'required|string|max:191',
            'home_page_01_faq_area_form_mail' => 'required|email|max:191',
            'home_page_01_faq_area_background_image' => 'nullable',
        ]);

            $this->validate($request,[
                'home_page_01_faq_area_title' => 'nullable|string',
                'home_page_01_faq_area_description' => 'nullable|string',
                'home_page_01_faq_area_form_title' => 'nullable|string',
                'home_page_01_faq_area_form_description' => 'nullable|string'
            ]);

            $_faq_area_title = 'home_page_01_faq_area_title';
            $_faq_area_description = 'home_page_01_faq_area_description';
            $_faq_area_form_title = 'home_page_01_faq_area_form_title';
            $_faq_area_form_description = 'home_page_01_faq_area_form_description';

            update_static_option($_faq_area_title,$request->$_faq_area_title);
            update_static_option($_faq_area_description,$request->$_faq_area_description);
            update_static_option($_faq_area_form_title,$request->$_faq_area_form_title);
            update_static_option($_faq_area_form_description,$request->$_faq_area_form_description);

        update_static_option('home_page_01_faq_area_items', $request->home_page_01_faq_area_items);
        update_static_option('home_page_01_faq_area_form_mail', $request->home_page_01_faq_area_form_mail);
        update_static_option('home_page_01_faq_area_background_image', $request->home_page_01_faq_area_background_image);

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }
}
