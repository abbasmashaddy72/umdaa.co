<?php

namespace App\Http\Controllers;

use App\Mail\OrderReply;
use App\Mail\PaymentSuccess;
use App\Mail\QuoteReply;
use App\Order;
use App\PaymentLogs;
use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_orders(){
        /**

         * @get('/admin-home/order-manage/all')
         * @name('admin.order.manage.all')
         * @middlewares(web, order_manage, auth:admin)
         */
        $all_orders = Order::all();
        return view('backend.order-manage.order-manage-all')->with(['all_orders' => $all_orders]);
    }

    public function pending_orders(){
        /**

         * @get('/admin-home/order-manage/pending')
         * @name('admin.order.manage.pending')
         * @middlewares(web, order_manage, auth:admin)
         */
        $all_orders = Order::where('status','pending')->get();
        return view('backend.order-manage.order-manage-all')->with(['all_orders' => $all_orders]);
    }

    public function completed_orders(){
        /**

         * @get('/admin-home/order-manage/completed')
         * @name('admin.order.manage.completed')
         * @middlewares(web, order_manage, auth:admin)
         */
        $all_orders = Order::where('status','completed')->get();
        return view('backend.order-manage.order-manage-all')->with(['all_orders' => $all_orders]);
    }
    public function in_progress_orders(){
        /**

         * @get('/admin-home/order-manage/in-progress')
         * @name('admin.order.manage.in.progress')
         * @middlewares(web, order_manage, auth:admin)
         */
        $all_orders = Order::where('status','in_progress')->get();
        return view('backend.order-manage.order-manage-all')->with(['all_orders' => $all_orders]);
    }

    public function change_status(Request $request){
        /**

         * @post('/admin-home/order-manage/change-status')
         * @name('admin.order.manage.change.status')
         * @middlewares(web, order_manage, auth:admin)
         */
        $this->validate($request,[
            'order_status' => 'required|string|max:191',
            'order_id' => 'required|string|max:191'
        ]);
        Order::find($request->order_id)->update(['status' => $request->order_status]);

        return redirect()->back()->with(['msg' => 'Order Status Update Success...','type' => 'success']);
    }

    public function order_delete(Request $request,$id){
        /**

         * @post('/admin-home/order-manage/delete/{id}')
         * @name('admin.order.manage.delete')
         * @middlewares(web, order_manage, auth:admin)
         */
        Order::find($id)->delete();
        return redirect()->back()->with(['msg' => 'Order Status Deleted Success...','type' => 'danger']);
    }


    public function send_mail(Request $request){
        /**

         * @post('/admin-home/order-manage/send-mail')
         * @name('admin.order.manage.send.mail')
         * @middlewares(web, order_manage, auth:admin)
         */
        $this->validate($request,[
            'email' => 'required|string|max:191',
            'name' => 'required|string|max:191',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
        $data = [
            'name' => $request->name,
            'message' => $request->message,
            'subject' => str_replace('{site}','UMDAA Health Care',$request->subject)
        ];
        Mail::to($request->email)->send(new OrderReply($data));
        return redirect()->back()->with(['msg' => 'Order Reply Mail Send Success...','type' => 'success']);
    }

    public function order_success_payment(){
        /**

         * @get('/admin-home/order-manage/success-page')
         * @name('admin.order.success.page')
         * @middlewares(web, order_manage, auth:admin)
         */
        return view('backend.order-manage.order-success-page');
    }

    public function update_order_success_payment(Request $request){
        /**

         * @post('/admin-home/order-manage/success-page')
         * @name('')
         * @middlewares(web, order_manage, auth:admin)
         */

            $this->validate($request, [
                'site_order_success_page_title' => 'nullable',
                'site_order_success_page_subtitle' => 'nullable',
                'site_order_success_page_description' => 'nullable',
            ]);
            $title = 'site_order_success_page_title';
            $subtitle = 'site_order_success_page_subtitle';
            $description = 'site_order_success_page_description';

            update_static_option($title, $request->$title);
            update_static_option($subtitle, $request->$subtitle);
            update_static_option($description, $request->$description);
        return redirect()->back()->with(['msg' => 'Order Success Page Update Success...','type' => 'success']);
    }

    public function order_cancel_payment(){
        /**

         * @get('/admin-home/order-manage/cancel-page')
         * @name('admin.order.cancel.page')
         * @middlewares(web, order_manage, auth:admin)
         */
        return view('backend.order-manage.order-cancel-page');
    }

    public function update_order_cancel_payment(Request $request){
        /**

         * @post('/admin-home/order-manage/cancel-page')
         * @name('')
         * @middlewares(web, order_manage, auth:admin)
         */

            $this->validate($request, [
                'site_order_cancel_page_title' => 'nullable',
                'site_order_cancel_page_subtitle' => 'nullable',
                'site_order_cancel_page_description' => 'nullable',
            ]);
            $title = 'site_order_cancel_page_title';
            $subtitle = 'site_order_cancel_page_subtitle';
            $description = 'site_order_cancel_page_description';

            update_static_option($title, $request->$title);
            update_static_option($subtitle, $request->$subtitle);
            update_static_option($description, $request->$description);
        return redirect()->back()->with(['msg' => 'Order Cancel Page Update Success...','type' => 'success']);
    }
}
