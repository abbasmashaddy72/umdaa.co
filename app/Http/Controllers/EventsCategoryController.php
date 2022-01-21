<?php

namespace App\Http\Controllers;

use App\Events;
use App\EventsCategory;
use Illuminate\Http\Request;

class EventsCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_events_category(){
        /**

         * @get('/admin-home/events/category')
         * @name('admin.events.category.all')
         * @middlewares(web, events_manage, auth:admin)
         */

        $all_category = EventsCategory::all();
        return view('backend.events.all-events-category')->with(['all_category' => $all_category] );
    }

    public function store_events_category(Request $request){
        /**

         * @post('/admin-home/events/category/new')
         * @name('admin.events.category.new')
         * @middlewares(web, events_manage, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:events_categories',
            'status' => 'required|string|max:191'
        ]);

        EventsCategory::create($request->all());

        return redirect()->back()->with([
            'msg' => 'New Category Added...',
            'type' => 'success'
        ]);
    }

    public function update_events_category(Request $request){
        /**

         * @post('/admin-home/events/category/update')
         * @name('admin.events.category.update')
         * @middlewares(web, events_manage, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        EventsCategory::find($request->id)->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->back()->with([
            'msg' => 'Category Update Success...',
            'type' => 'success'
        ]);
    }

    public function delete_events_category(Request $request,$id){
        /**

         * @post('/admin-home/events/category/delete/{id}')
         * @name('admin.events.category.delete')
         * @middlewares(web, events_manage, auth:admin)
         */
        if (Events::where('category_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => 'You Can Not Delete This Category, It Already Associated With A Event...',
                'type' => 'danger'
            ]);
        }
        EventsCategory::find($id)->delete();
        return redirect()->back()->with([
            'msg' => 'Category Delete Success...',
            'type' => 'danger'
        ]);
    }

}
