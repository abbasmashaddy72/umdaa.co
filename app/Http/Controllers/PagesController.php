<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        /**

         * @get('/admin-home/page')
         * @name('admin.page')
         * @middlewares(web, pages, auth:admin)
         */
        $all_page = Page::all();
        return view('backend.pages.page.index')->with([
            'all_page' => $all_page,
        ]);
    }
    public function new_page(){
        /**

         * @get('/admin-home/new-page')
         * @name('admin.page.new')
         * @middlewares(web, pages, auth:admin)
         */
        return view('backend.pages.page.new');
    }
    public function store_new_page(Request $request){
        /**

         * @post('/admin-home/new-page')
         * @name('')
         * @middlewares(web, pages, auth:admin)
         */
        $this->validate($request,[
            'content' => 'nullable',
            'meta_tags' => 'nullable',
            'meta_description' => 'nullable',
            'title' => 'required',
            'status' => 'required|string|max:191',
        ]);

        Page::create([
            'status' => $request->status,
            'content' => $request->page_content,
            'title' => $request->title,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
        ]);

        return redirect()->back()->with([
            'msg' => 'New Page Created...',
            'type' => 'success'
        ]);
    }
    public function edit_page($id){
        /**

         * @get('/admin-home/page-edit/{id}')
         * @name('admin.page.edit')
         * @middlewares(web, pages, auth:admin)
         */
        $page_post = Page::find($id);
        return view('backend.pages.page.edit')->with([
            'page_post' => $page_post
        ]);
    }
    public function update_page(Request $request,$id){
        /**

         * @post('/admin-home/page-update/{id}')
         * @name('admin.page.update')
         * @middlewares(web, pages, auth:admin)
         */
        $this->validate($request,[
            'content' => 'nullable',
            'meta_tags' => 'nullable',
            'meta_description' => 'nullable',
            'title' => 'required',
            'status' => 'required|string|max:191',
        ]);
        Page::where('id',$id)->update([
            'status' => $request->status,
            'content' => $request->page_content,
            'title' => $request->title,
            'meta_tags' => $request->meta_tags,
            'meta_description' => $request->meta_description,
        ]);


        return redirect()->back()->with([
            'msg' => 'Page updated...',
            'type' => 'success'
        ]);
    }
    public function delete_page(Request $request,$id){
        /**

         * @post('/admin-home/page-delete/{id}')
         * @name('admin.page.delete')
         * @middlewares(web, pages, auth:admin)
         */
        Page::find($id)->delete();
        return redirect()->back()->with([
            'msg' => 'Page Delete Success...',
            'type' => 'danger'
        ]);
    }
}
