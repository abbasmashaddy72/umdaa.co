<?php

namespace App\Http\Controllers;

use App\Jobs;
use App\JobsCategory;
use Illuminate\Http\Request;

class JobsCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_jobs_category(){
        /**

         * @get('/admin-home/jobs/category')
         * @name('admin.jobs.category.all')
         * @middlewares(web, job_post_manage, auth:admin)
         */

        $all_category = JobsCategory::all();
        return view('backend.jobs.all-jobs-category')->with(['all_category' => $all_category] );
    }

    public function store_jobs_category(Request $request){
        /**

         * @post('/admin-home/jobs/category/new')
         * @name('admin.jobs.category.new')
         * @middlewares(web, job_post_manage, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:jobs_categories',
            'status' => 'required|string|max:191'
        ]);

        JobsCategory::create($request->all());

        return redirect()->back()->with([
            'msg' => 'New Category Added...',
            'type' => 'success'
        ]);
    }

    public function update_jobs_category(Request $request){
        /**

         * @post('/admin-home/jobs/category/update')
         * @name('admin.jobs.category.update')
         * @middlewares(web, job_post_manage, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        JobsCategory::find($request->id)->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->back()->with([
            'msg' => 'Category Update Success...',
            'type' => 'success'
        ]);
    }

    public function delete_jobs_category(Request $request,$id){
        /**

         * @post('/admin-home/jobs/category/delete/{id}')
         * @name('admin.jobs.category.delete')
         * @middlewares(web, job_post_manage, auth:admin)
         */
        if (Jobs::where('category_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => 'You Can Not Delete This Category, It Already Associated With A Post...',
                'type' => 'danger'
            ]);
        }
        JobsCategory::find($id)->delete();
        return redirect()->back()->with([
            'msg' => 'Category Delete Success...',
            'type' => 'danger'
        ]);
    }

}
