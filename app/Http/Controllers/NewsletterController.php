<?php

namespace App\Http\Controllers;

use App\Mail\SubscriberMessage;
use App\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        /**

         * @get('/admin-home/newsletter')
         * @name('admin.newsletter')
         * @middlewares(web, newsletter_manage, auth:admin)
         */
        $all_subscriber = Newsletter::all();

        return view('backend.newsletter.newsletter-index')->with(['all_subscriber' => $all_subscriber]);
    }

    public function send_mail(Request $request){
        /**

         * @post('/admin-home/newsletter/single')
         * @name('admin.newsletter.single.mail')
         * @middlewares(web, newsletter_manage, auth:admin)
         */
        $this->validate($request,[
           'email' => 'required|email',
           'subject' => 'required',
           'message' => 'required',
        ]);

        $data = [
          'email' => $request->email,
          'subject' => $request->subject,
          'message' => $request->message,
        ];

        Mail::to($request->email)->send(new SubscriberMessage($data));

        return redirect()->back()->with([
            'msg' => 'Mail Send Success...',
            'type' => 'danger'
        ]);
    }
    public function delete($id){
        /**

         * @post('/admin-home/newsletter/delete/{id}')
         * @name('admin.newsletter.delete')
         * @middlewares(web, newsletter_manage, auth:admin)
         */
        Newsletter::find($id)->delete();
        return redirect()->back()->with(['msg' => 'Subscriber Delete Success....','type' => 'danger']);
    }

    public function send_mail_all_index(){
        /**

         * @get('/admin-home/newsletter/all')
         * @name('admin.newsletter.mail')
         * @middlewares(web, newsletter_manage, auth:admin)
         */
        return view('backend.newsletter.send-main-to-all');
    }

    public function send_mail_all(Request $request){
        /**

         * @post('/admin-home/newsletter/all')
         * @name('')
         * @middlewares(web, newsletter_manage, auth:admin)
         */
        $this->validate($request,[
            'subject' => 'required',
            'message' => 'required',
        ]);
        $all_subscriber = Newsletter::all();

        foreach ($all_subscriber as $subscriber){
            $data = [
                'subject' => $request->subject,
                'message' => $request->message,
            ];

            Mail::to($subscriber->email)->send(new SubscriberMessage($data));
        }

        return redirect()->back()->with([
            'msg' => 'Mail Send Success..',
            'type' => 'success'
        ]);
    }

    public function add_new_sub(Request $request){
        /**

         * @post('/admin-home/newsletter/new')
         * @name('admin.newsletter.new.add')
         * @middlewares(web, newsletter_manage, auth:admin)
         */
        $this->validate($request,[
            'email' => 'required|email|unique:newsletters'
        ]);

        Newsletter::create($request->all());
        return redirect()->back()->with([
            'msg' => 'New Subscriber Added..',
            'type' => 'success'
        ]);
    }
}
