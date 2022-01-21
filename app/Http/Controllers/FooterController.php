<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function about_widget(){
        /**

         * @get('/admin-home/footer/about')
         * @name('admin.footer.about')
         * @middlewares(web, footer_area, auth:admin)
         */
        return view('backend.pages.footer.about');
    }
    public function update_about_widget(Request $request){
        /**

         * @post('/admin-home/footer/about')
         * @name('')
         * @middlewares(web, footer_area, auth:admin)
         */
        $this->validate($request,[
            'about_widget_social_icon_one' => 'string|max:191',
            'about_widget_social_icon_two' => 'string|max:191',
            'about_widget_social_icon_three' => 'string|max:191',
            'about_widget_social_icon_four' => 'string|max:191',
            'about_widget_social_icon_five' => 'string|max:191',
            'about_widget_social_icon_one_url' => 'string|max:191',
            'about_widget_social_icon_two_url' => 'string|max:191',
            'about_widget_social_icon_three_url' => 'string|max:191',
            'about_widget_social_icon_four_url' => 'string|max:191',
            'about_widget_social_icon_five_url' => 'string|max:191',
        ]);
        update_static_option('about_widget_social_icon_one',$request->about_widget_social_icon_one);
        update_static_option('about_widget_social_icon_two',$request->about_widget_social_icon_two);
        update_static_option('about_widget_social_icon_three',$request->about_widget_social_icon_three);
        update_static_option('about_widget_social_icon_four',$request->about_widget_social_icon_four);
        update_static_option('about_widget_social_icon_five',$request->about_widget_social_icon_five);
        update_static_option('about_widget_social_icon_one_url',$request->about_widget_social_icon_one_url);
        update_static_option('about_widget_social_icon_two_url',$request->about_widget_social_icon_two_url);
        update_static_option('about_widget_social_icon_three_url',$request->about_widget_social_icon_three_url);
        update_static_option('about_widget_social_icon_four_url',$request->about_widget_social_icon_four_url);
        update_static_option('about_widget_social_icon_five_url',$request->about_widget_social_icon_five_url);

            $this->validate($request,[
                'about_widget_description' => 'nullable',
            ]);
            $field = 'about_widget_description';

            update_static_option('about_widget_description',$request->$field);


        return redirect()->back()->with([
            'msg' => 'About Widget Update Success...',
            'type' => 'success'
        ]);
    }

    public function useful_links_widget(){
        /**

         * @get('/admin-home/footer/useful-links')
         * @name('admin.footer.useful.link')
         * @middlewares(web, footer_area, auth:admin)
         */
        $all_menu = Menu::get();
        return view('backend.pages.footer.useful-link')->with([
            'all_menu' => $all_menu,
        ]);
    }

    public function update_widget_useful_links(Request $request){
        /**

         * @post('/admin-home/footer/useful-links/widget')
         * @name('admin.footer.useful.link.widget')
         * @middlewares(web, footer_area, auth:admin)
         */
            $this->validate($request,[
                'useful_link_widget_title' => 'nullable',
                'useful_link_widget_menu_id' => 'nullable',
            ]);
            $filed = 'useful_link_widget_title';
            $filed_two = 'useful_link_widget_menu_id';
            update_static_option('useful_link_widget_title',$request->$filed);
            update_static_option('useful_link_widget_menu_id',$request->$filed_two);

        return redirect()->back()->with([
            'msg' => 'Useful Widget Settings Success...',
            'type' => 'success'
        ]);
    }
    public function update_widget_important_links(Request $request){
        /**

         * @post('/admin-home/footer/important-links/widget')
         * @name('admin.footer.important.link.widget')
         * @middlewares(web, footer_area, auth:admin)
         */

            $this->validate($request,[
                'important_link_widget_title' => 'nullable',
                'important_link_widget_menu_id' => 'nullable',
            ]);
            $filed = 'important_link_widget_title';
            $filed_two = 'important_link_widget_menu_id';
            update_static_option('important_link_widget_title',$request->$filed);
            update_static_option('important_link_widget_menu_id',$request->$filed_two);

        return redirect()->back()->with([
            'msg' => 'Important Widget Settings Success...',
            'type' => 'success'
        ]);
    }


    public function important_links_widget(){
        /**

         * @get('/admin-home/footer/important-links')
         * @name('admin.footer.important.link')
         * @middlewares(web, footer_area, auth:admin)
         */
        $all_menu = Menu::get();
        return view('backend.pages.footer.important-links')->with([
            'all_menu' => $all_menu,
        ]);
    }

    public function update_general_widget(Request $request){
        /**

         * @post('/admin-home/footer/general')
         * @name('')
         * @middlewares(web, footer_area, auth:admin)
         */
        $this->validate($request,[
            'footer_background_image' => 'mimes:jpg,jpeg,png|max:10064',
        ]);

        if (!$request->hasFile('footer_background_image')){

        return redirect()->back()->with([
            'msg' => 'General Settings Update Success...',
            'type' => 'success'
        ]);
    }
            $image = $request->footer_background_image;
            $image_extenstion = $image->getClientOriginalExtension();
            $image_name = 'footer-background-image-'.rand(999,999999).'.'.$image_extenstion;
            if (check_image_extension($image)){
                $image->move('assets/uploads/',$image_name);
                update_static_option('footer_background_image',$image_name);
            }
        

        return redirect()->back()->with([
            'msg' => 'General Settings Update Success...',
            'type' => 'success'
        ]);
    }

    public function useful_links_widget_menu_by_slug(Request $request){
        /**

         * @post('/admin-home/footer/useful-links/menu')
         * @name('admin.footer.useful.link.menus')
         * @middlewares(web, footer_area, auth:admin)
         */
        $all_menu = Menu::get();
        return response()->json($all_menu);
    }
    public function important_links_widget_menu_by_slug(Request $request){
        /**

         * @post('/admin-home/footer/important-links/slug')
         * @name('admin.footer.important.link.menu')
         * @middlewares(web, footer_area, auth:admin)
         */
        $all_menu = Menu::get();
        return response()->json($all_menu);
    }
}
