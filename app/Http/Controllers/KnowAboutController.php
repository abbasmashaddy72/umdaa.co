<?php

namespace App\Http\Controllers;

use App\KeyFeatures;
use App\KnowAbout;
use Illuminate\Http\Request;

class KnowAboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function store(Request $request){
        /**

         * @post('/admin-home/about-page/know-about/store')
         * @name('know.about.store')
         * @middlewares(web, about_page_manage_check, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'link' => 'required|string|max:191',
            'description' => 'required|string',
            'image' => 'nullable|string|max:191'
        ]);
        KnowAbout::create($request->all());

        return redirect()->back()->with(['msg' => 'New Know About Item Added...','type' => 'success']);
    }

    public function update(Request $request){
        /**

         * @post('/admin-home/about-page/know-about/update')
         * @name('know.about.update')
         * @middlewares(web, about_page_manage_check, auth:admin)
         */

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'link' => 'required|string|max:191',
            'description' => 'required|string',
            'image' => 'nullable|string|max:191'
        ]);
        KnowAbout::find($request->id)->update($request->all());

        return redirect()->back()->with(['msg' => 'Know About Item Updated...','type' => 'success']);
    }

    public function delete($id){
        /**

         * @post('/admin-home/about-page/know-about/delete/{id}')
         * @name('know.about.delete')
         * @middlewares(web, about_page_manage_check, auth:admin)
         */

       KnowAbout::find($id)->delete();

        return redirect()->back()->with(['msg' => 'Delete Success...','type' => 'danger']);
    }

}
