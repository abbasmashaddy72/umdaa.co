<?php

namespace App\Http\Controllers;

use App\Works;
use App\WorksCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class WorksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        /**

         * @get('/admin-home/works')
         * @name('admin.work')
         * @middlewares(web, works, auth:admin)
         */
        $all_works = Works::all();
        $work_category = WorksCategory::where(['status'=> 'publish'])->get();
        return view('backend.pages.works.index')->with(['all_works' => $all_works, 'works_category' => $work_category]);
    }

    public function store(Request $request)
    {
        /**

         * @post('/admin-home/works')
         * @name('')
         * @middlewares(web, works, auth:admin)
         */
        $this->validate($request, [
            'title' => 'required|string|max:191',
            'start_date' => 'nullable|string|max:191',
            'end_date' => 'nullable|string|max:191',
            'clients' => 'nullable|string',
            'description' => 'required|string',
            'categories_id' => 'required',
            'image' => 'nullable|string|max:191',
        ]);
        Works::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'clients' => $request->clients,
            'description' => $request->description,
            'image' => $request->image,
            'categories_id' => serialize($request->categories_id),
        ]);

        return redirect()->back()->with(['msg' => 'New work Added...', 'type' => 'success']);
    }

    public function update(Request $request)
    {
        /**

         * @post('/admin-home/update-works')
         * @name('admin.work.update')
         * @middlewares(web, works, auth:admin)
         */
        $this->validate($request, [
            'title' => 'required|string|max:191',
            'start_date' => 'nullable|string|max:191',
            'end_date' => 'nullable|string|max:191',
            'clients' => 'nullable|string',
            'description' => 'required|string',
            'categories_id' => 'required',
            'image' => 'nullable|string|max:191',
        ]);
        Works::find($request->id)->update(
            [
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'clients' => $request->clients,
                'description' => $request->description,
                'image' => $request->image,
                'categories_id' => serialize($request->categories_id),
            ]
        );
        return redirect()->back()->with(['msg' => 'Works Item Updated...', 'type' => 'success']);
    }

    public function delete($id)
    {
        /**

         * @post('/admin-home/delete-works/{id}')
         * @name('admin.work.delete')
         * @middlewares(web, works, auth:admin)
         */
        Works::find($id)->delete();
        return redirect()->back()->with(['msg' => 'Delete Success...', 'type' => 'danger']);
    }

    public function category_index()
    {
        /**

         * @get('/admin-home/works/category')
         * @name('admin.work.category')
         * @middlewares(web, works, auth:admin)
         */
        $all_category = WorksCategory::all();
        return view('backend.pages.works.category')->with(['all_category' => $all_category]);
    }

    public function category_store(Request $request)
    {
        /**

         * @post('/admin-home/works/category')
         * @name('')
         * @middlewares(web, works, auth:admin)
         */
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        WorksCategory::create($request->all());

        return redirect()->back()->with([
            'msg' => 'New Category Added...',
            'type' => 'success'
        ]);
    }

    public function category_update(Request $request)
    {
        /**

         * @post('/admin-home/update-works-category')
         * @name('admin.work.category.update')
         * @middlewares(web, works, auth:admin)
         */
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        WorksCategory::find($request->id)->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        return redirect()->back()->with([
            'msg' => 'Category Update Success...',
            'type' => 'success'
        ]);
    }

    public function category_delete(Request $request, $id)
    {
        /**

         * @post('/admin-home/delete-works-category/{id}')
         * @name('admin.work.category.delete')
         * @middlewares(web, works, auth:admin)
         */
        if (Works::where('categories_id', $id)->first()) {
            return redirect()->back()->with([
                'msg' => 'You Can Not Delete This Category, It Already Associated With A Works ...',
                'type' => 'danger'
            ]);
        }
        WorksCategory::find($id)->delete();
        return redirect()->back()->with([
            'msg' => 'Category Delete Success...',
            'type' => 'danger'
        ]);
    }
}


