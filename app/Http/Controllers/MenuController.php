<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        /**

         * @get('/admin-home/menu')
         * @name('admin.menu')
         * @middlewares(web, menus_manage, auth:admin)
         */
        $all_menu = Menu::all();
        return view('backend.pages.menu.menu-index')->with([
            'all_menu' => $all_menu,
        ]);
    }

    public function store_new_menu(Request $request){
        /**

         * @post('/admin-home/new-menu')
         * @name('admin.menu.new')
         * @middlewares(web, menus_manage, auth:admin)
         */
        $this->validate($request,[
            'content' => 'nullable',
            'title' => 'required',
        ]);

        Menu::create([
            'content' => $request->page_content,
            'title' => $request->title,
        ]);

        return redirect()->back()->with([
            'msg' => 'New Menu Created...',
            'type' => 'success'
        ]);
    }
    public function edit_menu($id){
        /**

         * @get('/admin-home/menu-edit/{id}')
         * @name('admin.menu.edit')
         * @middlewares(web, menus_manage, auth:admin)
         */
        $page_post = Menu::find($id);
        $all_page = Page::where(['status'=>'publish'])->get();
        return view('backend.pages.menu.menu-edit')->with([
            'page_post' => $page_post,
            'all_page' => $all_page,
        ]);
    }
    public function update_menu(Request $request,$id){
        /**

         * @post('/admin-home/menu-update/{id}')
         * @name('admin.menu.update')
         * @middlewares(web, menus_manage, auth:admin)
         */

        $this->validate($request,[
            'content' => 'nullable',
            'title' => 'required',
        ]);
        Menu::where('id',$id)->update([
            'content' => $request->menu_content,
            'title' => $request->title,
        ]);


        return redirect()->back()->with([
            'msg' => 'Menu updated...',
            'type' => 'success'
        ]);
    }
    public function delete_menu(Request $request,$id){
        /**

         * @post('/admin-home/menu-delete/{id}')
         * @name('admin.menu.delete')
         * @middlewares(web, menus_manage, auth:admin)
         */
        Menu::find($id)->delete();
        return redirect()->back()->with([
            'msg' => 'Menu Delete Success...',
            'type' => 'danger'
        ]);
    }

    public function set_default_menu(Request $request,$id){
        /**

         * @post('/admin-home/menu-default/{id}')
         * @name('admin.menu.default')
         * @middlewares(web, menus_manage, auth:admin)
         */
        Menu::where(['status' => 'default'])->update(['status' => '']);

        Menu::find($id)->update(['status' => 'default']);
        return redirect()->back()->with([
            'msg' => 'Default Menu Set',
            'type' => 'success'
        ]);
    }
}
