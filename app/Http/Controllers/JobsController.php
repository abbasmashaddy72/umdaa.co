<?php

namespace App\Http\Controllers;

use App\Jobs;
use App\JobsCategory;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_jobs(){
        /**

         * @get('/admin-home/jobs')
         * @name('admin.jobs.all')
         * @middlewares(web, job_post_manage, auth:admin)
         */
        $all_jobs = Jobs::all();
        return view('backend.jobs.all-jobs')->with(['all_jobs' => $all_jobs]);
    }

    public function edit_job($id){
        /**

         * @get('/admin-home/jobs/edit/{id}')
         * @name('admin.jobs.edit')
         * @middlewares(web, job_post_manage, auth:admin)
         */

        $job_post = Jobs::find($id);
        $all_category = JobsCategory::where(['status' => 'publish'])->get();

        return view('backend.jobs.edit-job')->with([
            'all_category' => $all_category,
            'job_post' => $job_post
        ]);
    }

    public function new_job(){
        /**

         * @get('/admin-home/jobs/new')
         * @name('admin.jobs.new')
         * @middlewares(web, job_post_manage, auth:admin)
         */
        $all_category = JobsCategory::get();
        return view('backend.jobs.new-job')->with(['all_category' => $all_category]);
    }

    public function store_job(Request $request){
        /**

         * @post('/admin-home/jobs/new')
         * @name('')
         * @middlewares(web, job_post_manage, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string',
            'position' => 'required|string|max:191',
            'company_name' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'vacancy' => 'required|string|max:191',
            'job_responsibility' => 'required|string',
            'employment_status' => 'required|string',
            'education_requirement' => 'nullable|string',
            'job_context' => 'nullable|string',
            'experience_requirement' => 'nullable|string',
            'additional_requirement' => 'nullable|string',
            'job_location' => 'required|string',
            'salary' => 'required|string',
            'other_benefits' => 'nullable|string',
            'email' => 'required|string|max:191',
            'status' => 'nullable|string|max:191',
            'deadline' => 'required|string|max:191',
        ]);

        Jobs::create($request->all());

        return redirect()->back()->with(['msg' => 'New Job Post Added','type' => 'success']);
    }

    public function update_job(Request $request){
        /**

         * @post('/admin-home/jobs/update')
         * @name('admin.jobs.update')
         * @middlewares(web, job_post_manage, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string',
            'position' => 'required|string|max:191',
            'company_name' => 'required|string|max:191',
            'category_id' => 'required|string|max:191',
            'vacancy' => 'required|string|max:191',
            'job_responsibility' => 'required|string',
            'employment_status' => 'required|string',
            'education_requirement' => 'nullable|string',
            'experience_requirement' => 'nullable|string',
            'additional_requirement' => 'nullable|string',
            'job_context' => 'nullable|string',
            'job_location' => 'required|string',
            'salary' => 'required|string',
            'other_benefits' => 'nullable|string',
            'email' => 'required|string|max:191',
            'status' => 'nullable|string|max:191',
            'deadline' => 'required|string|max:191',
        ]);

        Jobs::find($request->job_id)->update($request->all());

        return redirect()->back()->with(['msg' => 'Job Post Update Success...','type' => 'success']);
    }

    public function delete_job(Request $request,$id){
        /**

         * @post('/admin-home/jobs/delete/{id}')
         * @name('admin.jobs.delete')
         * @middlewares(web, job_post_manage, auth:admin)
         */
        Jobs::find($id)->delete();

        return redirect()->back()->with(['msg' => 'Job Post Deleted Success','type' => 'danger']);
    }
}
