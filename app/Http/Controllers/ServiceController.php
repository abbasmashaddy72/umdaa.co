<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use App\Services;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        /**

         * @get('/admin-home/services')
         * @name('admin.services')
         * @middlewares(web, services, auth:admin)
         */
        $all_services = Services::all();
        $service_category = BlogCategory::where(['status' => 'publish'])->get();
        return view('backend.pages.service.index')->with(['all_services' => $all_services,'service_category' => $service_category]);
    }

    public function store(Request $request){
        /**

         * @post('/admin-home/services')
         * @name('')
         * @middlewares(web, services, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'description' => 'required|string',
            'excerpt' => 'required|string',
            'categories_id' => 'required|string',
            'image' => 'nullable|string|max:191'
        ]);
        Services::create($request->all());

        return redirect()->back()->with(['msg' => 'New service Added...','type' => 'success']);
    }

    public function update(Request $request){
        /**

         * @post('/admin-home/update-services')
         * @name('admin.services.update')
         * @middlewares(web, services, auth:admin)
         */

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'icon' => 'required|string|max:191',
            'description' => 'required|string',
            'excerpt' => 'required|string',
            'categories_id' => 'required|string',
            'image' => 'nullable|string|max:191'
        ]);
        Services::find($request->id)->update($request->all());

        return redirect()->back()->with(['msg' => 'Service Item Updated...','type' => 'success']);
    }

    public function delete($id){
        /**

         * @post('/admin-home/delete-services/{id}')
         * @name('admin.services.delete')
         * @middlewares(web, services, auth:admin)
         */
        Services::find($id)->delete();

        return redirect()->back()->with(['msg' => 'Delete Success...','type' => 'danger']);
    }
}
