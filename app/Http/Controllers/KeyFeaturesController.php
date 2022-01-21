<?php

namespace App\Http\Controllers;

use App\KeyFeatures;
use Illuminate\Http\Request;

class KeyFeaturesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        /**

         * @get('/admin-home/keyfeatures')
         * @name('admin.keyfeatures')
         * @middlewares(web, home_page_manage, auth:admin)
         */
        $all_key_features = KeyFeatures::all();
        return view('backend.pages.key-features')->with(['all_key_features' => $all_key_features]);
    }

    public function store(Request $request){
        /**

         * @post('/admin-home/keyfeatures')
         * @name('')
         * @middlewares(web, home_page_manage, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'description' => 'required|string',
            'image' => 'nullable|string|max:191',
        ]);

        KeyFeatures::create($request->all());

        return redirect()->back()->with(['msg' => 'New Key Feature Added...','type' => 'success']);
    }

    public function update(Request $request){
        /**

         * @post('/admin-home/update-keyfeatures')
         * @name('admin.keyfeatures.update')
         * @middlewares(web, home_page_manage, auth:admin)
         */

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'description' => 'required|string',
            'image' => 'nullable|string|max:191',
        ]);

        KeyFeatures::find($request->id)->update($request->all());

        return redirect()->back()->with(['msg' => 'Key Feature Updated...','type' => 'success']);
    }

    public function delete($id){
        /**

         * @post('/admin-home/delete-keyfeatures/{id}')
         * @name('admin.keyfeatures.delete')
         * @middlewares(web, home_page_manage, auth:admin)
         */
        KeyFeatures::find($id)->delete();
        return redirect()->back()->with(['msg' => 'Delete Success...','type' => 'danger']);
    }

    public function update_section_settings(Request $request){
        /**

         * @post('/admin-home/home-page-01/keyfeatures')
         * @name('admin.keyfeature.section')
         * @middlewares(web, home_page_manage, auth:admin)
         */


            $this->validate($request,[
               'home_01_key_feature_section_title' => 'nullable|string',
               'home_01_key_feature_section_description' => 'nullable|string',
            ]);

            $filed_one = 'home_01_key_feature_section_title';
            $filed_two = 'home_01_key_feature_section_description';
            update_static_option('home_01_key_feature_section_title',$request->$filed_one);
            update_static_option('home_01_key_feature_section_description', $request->$filed_two);
        return redirect()->back()->with(['msg' => 'Settings Updated...','type' => 'success']);
    }
}
