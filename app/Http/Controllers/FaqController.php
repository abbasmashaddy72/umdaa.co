<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        /**

         * @get('/admin-home/faq')
         * @name('admin.faq')
         * @middlewares(web, faq, auth:admin)
         */
        $all_faqs = Faq::all();
        return view('backend.pages.faqs')->with(['all_faqs' => $all_faqs]);
    }
    public function store(Request $request){
        /**

         * @post('/admin-home/faq')
         * @name('')
         * @middlewares(web, faq, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'nullable|string|max:191',
        ]);

        Faq::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'is_open' => !empty($request->is_open) ? 'on' : '',
        ]);


        return redirect()->back()->with(['msg' => 'New Faq Added...','type' => 'success']);
    }

    public function update(Request $request){
        /**

         * @post('/admin-home/update-faq')
         * @name('admin.faq.update')
         * @middlewares(web, faq, auth:admin)
         */

        $this->validate($request,[
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'nullable|string|max:191',
        ]);

        Faq::find($request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'is_open' => !empty($request->is_open) ? 'on' : '',
        ]);

        return redirect()->back()->with(['msg' => 'Faq Updated...','type' => 'success']);
    }

    public function delete($id){
        /**

         * @post('/admin-home/delete-faq/{id}')
         * @name('admin.faq.delete')
         * @middlewares(web, faq, auth:admin)
         */
        Faq::find($id)->delete();
        return redirect()->back()->with(['msg' => 'Delete Success...','type' => 'danger']);
    }
}
