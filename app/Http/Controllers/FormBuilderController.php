<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function quote_form_index(){
        /**

         * @get('/admin-home/form-builder/quote-form')
         * @name('admin.form.builder.quote')
         * @middlewares(web, form_builder, auth:admin)
         */
        return view('backend.form-builder.quote-form');
    }
    public function update_quote_form(Request $request){
        /**

         * @post('/admin-home/form-builder/quote-form')
         * @name('')
         * @middlewares(web, form_builder, auth:admin)
         */
         unset($request['_token']);
        $all_fields_name = [];
        $all_request_except_token = $request->all();
        foreach ($request->field_name as $fname){
            array_push($all_fields_name,Str::slug($fname));
        }
        $all_request_except_token['field_name'] = $all_fields_name;
        $json_encoded_data = json_encode($all_request_except_token);

        update_static_option('quote_page_form_fields',$json_encoded_data);
        return redirect()->back()->with(['msg' => 'Form Updated...','type' => 'success']);
    }

    public function order_form_index(){
        /**

         * @get('/admin-home/form-builder/order-form')
         * @name('admin.form.builder.order')
         * @middlewares(web, form_builder, auth:admin)
         */
        return view('backend.form-builder.order-form');
    }
    public function update_order_form(Request $request){
        /**

         * @post('/admin-home/form-builder/order-form')
         * @name('')
         * @middlewares(web, form_builder, auth:admin)
         */
        unset($request['_token']);
        $all_fields_name = [];
        $all_request_except_token = $request->all();
        foreach ($request->field_name as $fname){
            array_push($all_fields_name,Str::slug($fname));
        }
        $all_request_except_token['field_name'] = $all_fields_name;
        $json_encoded_data = json_encode($all_request_except_token);

        update_static_option('order_page_form_fields',$json_encoded_data);
        return redirect()->back()->with(['msg' => 'Form Updated...','type' => 'success']);
    }
    public function contact_form_index(){
        /**

         * @get('/admin-home/form-builder/contact-form')
         * @name('admin.form.builder.contact')
         * @middlewares(web, form_builder, auth:admin)
         */
        return view('backend.form-builder.contact-form');
    }
    public function update_contact_form(Request $request){
        /**

         * @post('/admin-home/form-builder/contact-form')
         * @name('')
         * @middlewares(web, form_builder, auth:admin)
         */
        unset($request['_token']);
        $all_fields_name = [];
        $all_request_except_token = $request->all();
        foreach ($request->field_name as $fname){
            array_push($all_fields_name,Str::slug($fname));
        }
        $all_request_except_token['field_name'] = $all_fields_name;
        $json_encoded_data = json_encode($all_request_except_token);

        update_static_option('contact_page_form_fields',$json_encoded_data);
        return redirect()->back()->with(['msg' => 'Form Updated...','type' => 'success']);
    }

    public function call_back_form_index(){
        /**

         * @get('/admin-home/form-builder/call-back-form')
         * @name('admin.form.builder.call.back')
         * @middlewares(web, form_builder, auth:admin)
         */
        return view('backend.form-builder.call-back-form');
    }
    public function update_call_back_form(Request $request){
        /**

         * @post('/admin-home/form-builder/call-back-form')
         * @name('')
         * @middlewares(web, form_builder, auth:admin)
         */
        unset($request['_token']);
        $all_fields_name = [];
        $all_request_except_token = $request->all();
        foreach ($request->field_name as $fname){
            array_push($all_fields_name,Str::slug($fname));
        }
        $all_request_except_token['field_name'] = $all_fields_name;
        $json_encoded_data = json_encode($all_request_except_token);

        update_static_option('call_back_page_form_fields',$json_encoded_data);
        return redirect()->back()->with(['msg' => 'Form Updated...','type' => 'success']);
    }
}
