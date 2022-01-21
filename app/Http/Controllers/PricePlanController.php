<?php

namespace App\Http\Controllers;

use App\PricePlan;
use Illuminate\Http\Request;

class PricePlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        /**

         * @get('/admin-home/price-plan')
         * @name('admin.price.plan')
         * @middlewares(web, price_plan, auth:admin)
         */
        $all_price_plan = PricePlan::all();
        return view('backend.pages.price-plan')->with(['all_price_plan' => $all_price_plan ]);
    }

    public function store(Request $request){
        /**

         * @post('/admin-home/price-plan')
         * @name('')
         * @middlewares(web, price_plan, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'price' => 'required|string|max:191',
            'type' => 'nullable|string|max:191',
            'icon' => 'nullable|string|max:191',
            'btn_text' => 'required|string|max:191',
            'btn_url' => 'nullable|string|max:191',
            'features' => 'required|string',
        ]);
        PricePlan::create($request->all());
        return redirect()->back()->with(['msg' => 'New Price Plan Added...','type' => 'success']);
    }

    public function update(Request $request){
        /**

         * @post('/admin-home/update-price-plan')
         * @name('admin.price.plan.update')
         * @middlewares(web, price_plan, auth:admin)
         */

        $this->validate($request,[
            'title' => 'required|string|max:191',
            'price' => 'required|string|max:191',
            'type' => 'nullable|string|max:191',
            'icon' => 'nullable|string|max:191',
            'btn_text' => 'required|string|max:191',
            'btn_url' => 'nullable|string|max:191',
            'features' => 'required|string',
        ]);

        PricePlan::find($request->id)->update($request->all());

        return redirect()->back()->with(['msg' => 'Price Plan Updated...','type' => 'success']);
    }

    public function delete($id){
        /**

         * @post('/admin-home/delete-price-plan/{id}')
         * @name('admin.price.plan.delete')
         * @middlewares(web, price_plan, auth:admin)
         */
        PricePlan::find($id)->delete();
        return redirect()->back()->with(['msg' => 'Delete Success...','type' => 'danger']);
    }
}
