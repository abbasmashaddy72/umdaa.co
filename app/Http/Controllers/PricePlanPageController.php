<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricePlanPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function price_plan_page_settings(){
        /**

         * @get('/admin-home/price-plan-page/settings')
         * @name('admin.price.plan.page.settings')
         * @middlewares(web, price_plan_page_manage, auth:admin)
         */
        return view('backend.pages.price-plan-page.price-plan-page-settings');
    }

    public function update_price_plan_page_settings(Request $request){
        /**

         * @post('/admin-home/price-plan-page/settings')
         * @name('')
         * @middlewares(web, price_plan_page_manage, auth:admin)
         */
            $this->validate($request,[
                'price_plan_page_section_description' => 'nullable|string',
                'price_plan_page_section_title' => 'nullable|string',
            ]);
            $section_title =  'price_plan_page_section_title';
            $section_description =  'price_plan_page_section_description';

            update_static_option($section_title,$request->$section_title);
            update_static_option($section_description,$request->$section_description);

        update_static_option('price_plan_page_items',$request->price_plan_page_items);
        return redirect()->back()->with(['msg' => 'Price Plan Page Updated...','type' => 'success']);
    }
}
