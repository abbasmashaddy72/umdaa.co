<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function contact_page_form_area(){
        /**

         * @get('/admin-home/contact-page/form-area')
         * @name('admin.contact.page.form.area')
         * @middlewares(web, contact_page_manage, auth:admin)
         */
        return view('backend.pages.contact-page.form-section');
    }
    public function contact_page_update_form_area(Request $request){
        /**

         * @post('/admin-home/contact-page/form-area')
         * @name('')
         * @middlewares(web, contact_page_manage, auth:admin)
         */

            $this->validate($request,[
                'contact_page_form_section_title' => 'nullable|string',
                'contact_page_form_section_description' => 'nullable|string'
            ]);
            $field = 'contact_page_form_section_title';
            $field_two = 'contact_page_form_section_description';

            update_static_option('contact_page_form_section_title',$request->$field);
            update_static_option('contact_page_form_section_description',$request->$field_two);

        return redirect()->back()->with(['msg' => 'Settings Updated..','type' => 'success']);
    }

}
