<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        /**

         * @get('/admin-home/order-page')
         * @name('admin.order.page')
         * @middlewares(web, order_page_manage, auth:admin)
         */
        return view('backend.pages.order-page.form-section');
    }

    public function udpate(Request $request){
        /**

         * @post('/admin-home/order-page')
         * @name('')
         * @middlewares(web, order_page_manage, auth:admin)
         */
        $this->validate($request,[
            'order_page_form_mail' => 'nullable|string',
        ]);


            $this->validate($request,[
                'order_page_form_title' => 'nullable|string',
            ]);
            $field = 'order_page_form_title';
            update_static_option('order_page_form_title',$request->$field);

        update_static_option('order_page_form_mail',$request->order_page_form_mail);

        return redirect()->back()->with(['msg' => 'Settings Updated....','type' => 'success']);
    }
}
