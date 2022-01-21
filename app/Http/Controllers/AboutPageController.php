<?php

namespace App\Http\Controllers;

use App\KnowAbout;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function about_page_about_section(){
        /**

         * @get('/admin-home/about-page/about-us')
         * @name('admin.about.page.about')
         * @middlewares(web, about_page_manage_check, auth:admin)
         */
        return view('backend.pages.about.about-section');
    }
    public function about_page_update_about_section(Request $request){
        /**

         * @post('/admin-home/about-page/about-us')
         * @name('')
         * @middlewares(web, about_page_manage_check, auth:admin)
         */

            $this->validate($request ,[
                'about_page_about_section_title' => 'nullable|string',
                'about_page_about_section_description' => 'nullable|string',
                'about_page_about_section_right_image' => 'nullable|string'
            ]);

            $image_filed = 'about_page_about_section_right_image';
            update_static_option('about_page_about_section_right_image', $request->$image_filed);

            $_about_section_title = 'about_page_about_section_title';
            $_about_section_description = 'about_page_about_section_description';

            update_static_option('about_page_about_section_title',$request->$_about_section_title);
            update_static_option('about_page_about_section_description',$request->$_about_section_description);


        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }
    public function about_page_know_about_section(){
        /**

         * @get('/admin-home/about-page/know-about')
         * @name('admin.about.know')
         * @middlewares(web, about_page_manage_check, auth:admin)
         */
        $all_know_about_items = KnowAbout::all();
        return view('backend.pages.about.know-section')->with(['all_know_about_items' => $all_know_about_items]);
    }
    public function about_page_update_know_about_section(Request $request){
        /**

         * @post('/admin-home/about-page/know-about')
         * @name('')
         * @middlewares(web, about_page_manage_check, auth:admin)
         */
            $this->validate($request ,[
                'about_page_know_about_section_title' => 'nullable|string',
                'about_page_know_about_section_description' => 'nullable|string',
            ]);
            $filed = 'about_page_know_about_section_title';
            $filed_two = 'about_page_know_about_section_description';

            update_static_option('about_page_know_about_section_title',$request->$filed);
            update_static_option('about_page_know_about_section_description',$request->$filed_two);

        return redirect()->back()->with([
            'msg' => 'Settings Updated ...',
            'type' => 'success'
        ]);
    }

}
