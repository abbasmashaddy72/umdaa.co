<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuotePageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        /**

         * @get('/admin-home/quote-page')
         * @name('admin.quote.page')
         * @middlewares(web, quote_page_manage, auth:admin)
         */
        return view('backend.pages.quote-page.form-section');
    }

    public function udpate(Request $request){
        /**

         * @post('/admin-home/quote-page')
         * @name('')
         * @middlewares(web, quote_page_manage, auth:admin)
         */
        $this->validate($request,[
            'quote_page_form_mail' => 'nullable|string',
        ]);

            $this->validate($request,[
                'quote_page_form_title' => 'nullable|string',
                'quote_page_page_title' => 'nullable|string'
            ]);

            $_form_title = 'quote_page_form_title';
            $_page_title = 'quote_page_page_title';

            update_static_option('quote_page_form_title',$request->$_form_title);
            update_static_option('quote_page_page_title',$request->$_page_title);

        update_static_option('quote_page_form_mail',$request->quote_page_form_mail);

        return redirect()->back()->with(['msg' => 'Settings Updated....','type' => 'success']);
    }
}
