<?php

namespace App\Http\Controllers;

use App\ContactInfoItem;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        /**

         * @get('/admin-home/contact-page/contact-info')
         * @name('admin.contact.info')
         * @middlewares(web, contact_page_manage, auth:admin)
         */
        $all_contact_info = ContactInfoItem::all();
        return view('backend.pages.contact-info')->with(['all_contact_info' => $all_contact_info]);
    }

    public function store(Request $request){
        /**

         * @post('/admin-home/contact-page/contact-info')
         * @name('')
         * @middlewares(web, contact_page_manage, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'description' => 'required|string',
        ]);
        ContactInfoItem::create($request->all());
        return redirect()->back()->with(['msg' => 'New Contact Info Item Added...','type' => 'success']);
    }

    public function update(Request $request){
        /**

         * @post('/admin-home/contact-page/contact-info/update')
         * @name('admin.contact.info.update')
         * @middlewares(web, contact_page_manage, auth:admin)
         */

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'description' => 'required|string',
        ]);
        ContactInfoItem::find($request->id)->update($request->all());
        return redirect()->back()->with(['msg' => 'Contact Info Item Updated...','type' => 'success']);
    }

    public function delete($id){
        /**

         * @post('/admin-home/contact-page/contact-info/delete/{id}')
         * @name('admin.contact.info.delete')
         * @middlewares(web, contact_page_manage, auth:admin)
         */
        ContactInfoItem::find($id)->delete();
        return redirect()->back()->with(['msg' => 'Delete Success...','type' => 'danger']);
    }

    public function contact_info_title(Request $request){
        /**

         * @post('/admin-home/contact-page/contact-info/title')
         * @name('admin.contact.info.title')
         * @middlewares(web, contact_page_manage, auth:admin)
         */


            $this->validate($request,[
                'contact_page_contact_info_title' => 'nullable|string|max:191',
            ]);
            $field = 'contact_page_contact_info_title';
            update_static_option('contact_page_contact_info_title',$request->$field);

        return redirect()->back()->with(['msg' => 'Settings Updated...','type' => 'success']);
    }
}
