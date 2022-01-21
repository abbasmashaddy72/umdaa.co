<?php

namespace App\Http\Controllers;

use App\PopupBuilder;
use Illuminate\Http\Request;

class PopupBuilderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function new_popup(){
        /**

         * @get('/admin-home/popup-builder/new')
         * @name('admin.popup.builder.new')
         * @middlewares(web, popup_builder, auth:admin)
         */
        return view('backend.popup-builder.popup-new');
    }

    public function store_popup(Request $request){
        /**

         * @post('/admin-home/popup-builder/new')
         * @name('')
         * @middlewares(web, popup_builder, auth:admin)
         */
        $this->validate($request,[
            'name' => 'required|string',
            'title' => 'nullable|string',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'offer_time_end' => 'nullable|string',
            'btn_status' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'background_image' => 'nullable|string',
            'image' => 'nullable|string',
        ]);
        PopupBuilder::create([
            'name' => $request->name,
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'offer_time_end' => $request->offer_time_end,
            'btn_status' => $request->btn_status,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'background_image' => $request->background_image,
            'only_image' => $request->image,
        ]);
        return redirect()->back()->with(['msg' => __('New Popup Added') , 'type' => 'success']);
    }

    public function all_popup(){
        /**

         * @get('/admin-home/popup-builder/all')
         * @name('admin.popup.builder.all')
         * @middlewares(web, popup_builder, auth:admin)
         */
        $all_popup = PopupBuilder::all();
        return view('backend.popup-builder.popup-all')->with(['all_popup' => $all_popup]);
    }

    public function delete_popup(Request $request,$id){
        /**

         * @post('/admin-home/popup-builder/delete/{id}')
         * @name('admin.popup.builder.delete')
         * @middlewares(web, popup_builder, auth:admin)
         */
        PopupBuilder::find($id)->delete();
        return redirect()->back()->with(['msg' => __('Popup Deleted...'),'type' => 'danger']);
    }

    public function edit_popup($id){
        /**

         * @get('/admin-home/popup-builder/edit/{id}')
         * @name('admin.popup.builder.edit')
         * @middlewares(web, popup_builder, auth:admin)
         */
        $popup = PopupBuilder::find($id);
        return view('backend.popup-builder.popup-edit')->with(['popup' => $popup]);
    }

    public function update_popup(Request $request,$id){
        /**

         * @post('/admin-home/popup-builder/update/{id}')
         * @name('admin.popup.builder.update')
         * @middlewares(web, popup_builder, auth:admin)
         */
        $this->validate($request,[
            'name' => 'required|string',
            'title' => 'nullable|string',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'offer_time_end' => 'nullable|string',
            'btn_status' => 'nullable|string',
            'button_text' => 'nullable|string',
            'button_link' => 'nullable|string',
            'background_image' => 'nullable|string',
            'image' => 'nullable|string',
        ]);
        PopupBuilder::find($id)->update([
            'name' => $request->name,
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'offer_time_end' => $request->offer_time_end,
            'btn_status' => $request->btn_status,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'background_image' => $request->background_image,
            'only_image' => $request->image,
        ]);
        return redirect()->back()->with(['msg' => __('Popup Update Success') , 'type' => 'success']);
    }
}
