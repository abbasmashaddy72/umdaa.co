<?php

namespace App\Http\Controllers;

use App\Events;
use App\EventsCategory;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function new_event(){
        /**

         * @get('/admin-home/events/new')
         * @name('admin.events.new')
         * @middlewares(web, events_manage, auth:admin)
         */
        $all_categories = EventsCategory::get();
        return view('backend.events.new-event')->with(['all_categories' => $all_categories]);
    }

    public function store_event(Request $request){
        /**

         * @post('/admin-home/events/new')
         * @name('')
         * @middlewares(web, events_manage, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'content' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|string',
            'date' => 'required|string',
        ]);

        Events::create($request->all());

        return redirect()->back()->with(['msg' => 'New Event Created Success...','type'=>'success']);
    }

    public function all_events(){
        /**

         * @get('/admin-home/events')
         * @name('admin.events.all')
         * @middlewares(web, events_manage, auth:admin)
         */
        $all_events = Events::all();
        return view('backend.events.all-events')->with(['all_events' => $all_events]);
    }

    public function edit_event($id){
        /**

         * @get('/admin-home/events/edit/{id}')
         * @name('admin.events.edit')
         * @middlewares(web, events_manage, auth:admin)
         */
        $event = Events::find($id);
        $all_categories = EventsCategory::where(['status' => 'publish'])->get();
        return view('backend.events.edit-event')->with(['all_categories' => $all_categories,'event' => $event]);
    }

    public function delete_event(Request $request,$id){
        /**

         * @post('/admin-home/events/delete/{id}')
         * @name('admin.events.delete')
         * @middlewares(web, events_manage, auth:admin)
         */
        Events::find($id)->delete();
        return redirect()->back()->with(['msg' => 'Event Delete Success...','type'=>'danger']);
    }

    public function update_event(Request $request){
        /**

         * @post('/admin-home/events/update')
         * @name('admin.events.update')
         * @middlewares(web, events_manage, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'content' => 'required|string',
            'location' => 'required|string',
            'image' => 'nullable|string',
            'date' => 'required|string',
        ]);

        Events::find($request->event_id)->update($request->all());

        return redirect()->back()->with(['msg' => 'Event Update Success...','type'=>'success']);
    }
}
