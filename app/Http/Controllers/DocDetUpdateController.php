<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\DB;

class DocDetUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        /**

         * @get('/admin-home/doctor-web-details/doctor-details')
         * @name('admin.doctor.details')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */
        $alldoc = DB::table('doctors')
            ->Join('department as CAT', 'doctors.department_id', '=', 'CAT.department_id')
            ->select(
                'doctors.doctor_id',
                'doctors.first_name',
                'doctors.last_name',
                'doctors.about',
                'doctors.profile_image',
                'CAT.department_name as dept'
            )
            ->get()
            ->toArray();

        return view('backend.pages.doc-web.index')->with([
            'alldoc' => $alldoc,
        ]);
    }

    public function docproupdate(Request $request)
    {
        /**

         * @post('/admin-home/doctor-web-details/doctor-details/editdpu')
         * @name('admin.doctor.details.edit.profile')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */

        // check DB available data
        $orginal_dep = DB::table('doctors')->where('doctor_id', $request->doctor_id)->get('department_id');
        $reqested_dep = $request->department_id;
        $ar =  json_decode($orginal_dep);
        $og_dr_dep = $ar[0]->department_id;

        if ($og_dr_dep != $reqested_dep) {
            DB::Table('doctors')
                ->where('doctor_id', $request->doctor_id)
                ->update(['service_status' => NULL]);
        }

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'nullable',
            'tags' => 'nullable',
            'department_id' => 'required',
            'testimonial' => 'nullable',
            'languages' => 'nullable',
            'about' => 'required',
            'profile_image' => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'fb_url' => 'nullable',
            'li_url' => 'nullable',
            'tw_url' => 'nullable',
            'in_url' => 'nullable',
            'gb_url' => 'nullable',
        ]);

        if (!empty($request->profile_image)) {
            $profileimg = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move('../../clinic.umdaa.co/uploads/doctors', $profileimg);
        } else {
            $profileimg = Null;
        }

        if (!empty($request->profile_image)) {
            DB::Table('doctors')
            ->where('doctor_id', $request->doctor_id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'tags' => $request->tags,
                'department_id' => $request->department_id,
                'languages' => $request->languages,
                'testimonial' => $request->testimonial,
                'about' => $request->about,
                'profile_image' => $profileimg,
                'fb_url' => $request->fb_url,
                'li_url' => $request->li_url,
                'tw_url' => $request->tw_url,
                'in_url' => $request->in_url,
                'gb_url' => $request->gb_url,
            ]);
        } else {
            DB::Table('doctors')
            ->where('doctor_id', $request->doctor_id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'tags' => $request->tags,
                'department_id' => $request->department_id,
                'languages' => $request->languages,
                'testimonial' => $request->testimonial,
                'about' => $request->about,
                'fb_url' => $request->fb_url,
                'li_url' => $request->li_url,
                'tw_url' => $request->tw_url,
                'in_url' => $request->in_url,
                'gb_url' => $request->gb_url,
            ]);
        }
        return redirect()->back()->with([
            'msg' => 'Doctor Profile updated...',
            'type' => 'success',
        ]);
    }

    public function adddocexp(Request $request)
    {
        /**

         * @post('/admin-home/doctor-web-details/doctor-details/editadex')
         * @name('admin.doctor.details.edit.exp')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */
        $this->validate($request, [
            'timeline' => 'required',
            'designation' => 'nullable',
            'location_about' => 'nullable',
        ]);
        DB::Table('doctor_experience')
            ->insert([
                'timeline' => $request->timeline,
                'designation' => $request->designation,
                'location_about' => $request->location_about,
                'doctor_id' => $request->doctor_id,
            ]);

        return redirect()->back()->with([
            'msg' => 'Doctor Experience Added...',
            'type' => 'success',
        ]);
    }

    public function adddocedu(Request $request)
    {
        /**

         * @post('/admin-home/doctor-web-details/doctor-details/editadeu')
         * @name('admin.doctor.details.edit.edu')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */
        $this->validate($request, [
            'year' => 'required',
            'university' => 'nullable',
            'degree_name' => 'nullable',
            'location_about' => 'nullable',
        ]);
        DB::Table('doctor_degrees')
            ->insert([
                'year' => $request->year,
                'university' => $request->university,
                'degree_name' => $request->degree_name,
                'location_about' => $request->location_about,
                'doctor_id' => $request->doctor_id,
            ]);

        return redirect()->back()->with([
            'msg' => 'Doctor Experience Added...',
            'type' => 'success',
        ]);
    }

    public function docserupdate(Request $request)
    {
        /**

         * @post('/admin-home/doctor-web-details/doctor-details/editdsu')
         * @name('admin.doctor.details.edit.service')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */
        unset($request['_token']);
        $data = [];
        for ($i = 0; $i < count($request->id); $i++) {
            array_push($data, [
                'id' => $request->id[$i],
                'title' => $request->title[$i],
                'service_status' => $request->service_status[$i]
            ]);
        }

        DB::table('doctors')->where('doctor_id', $request->doctor_id)->update([
            'service_status' => $data,
        ]);

        return redirect()->back()->with([
            'msg' => 'Services updated...',
            'type' => 'success'
        ]);
    }

    public function upddocexp(Request $request)
    {
        /**

         * @post('/admin-home/doctor-web-details/doctor-details/updadex')
         * @name('admin.doctor.details.update.exp')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */
        $this->validate($request, [
            'timeline' => 'required',
            'designation' => 'nullable',
            'location_about' => 'nullable',
        ]);
        DB::Table('doctor_experience')
            ->where('id', $request->id)
            ->update([
                'timeline' => $request->timeline,
                'designation' => $request->designation,
                'location_about' => $request->location_about,
            ]);

        return redirect()->back()->with([
            'msg' => 'Doctor Experience Updated...',
            'type' => 'success',
        ]);
    }

    public function upddocedu(Request $request)
    {
        /**

         * @post('/admin-home/doctor-web-details/doctor-details/updadeu')
         * @name('admin.doctor.details.update.edu')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */
        $this->validate($request, [
            'year' => 'required',
            'university' => 'nullable',
            'degree_name' => 'nullable',
            'location_about' => 'nullable',
        ]);
        DB::Table('doctor_degrees')
            ->where('doctor_degree_id', $request->id)
            ->update([
                'year' => $request->year,
                'university' => $request->university,
                'degree_name' => $request->degree_name,
                'location_about' => $request->location_about,
            ]);

        return redirect()->back()->with([
            'msg' => 'Doctor Education Updated...',
            'type' => 'success',
        ]);
    }

    public function edit($id)
    {
        /**

         * @get('/admin-home/doctor-web-details/doctor-details/edit/{id}')
         * @name('admin.doctor.details.edit')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */
        $singleDetails = DB::table('doctors')
            ->Join('department as CAT', 'doctors.department_id', '=', 'CAT.department_id')
            ->select(
                'doctors.doctor_id',
                'doctors.first_name',
                'doctors.last_name',
                'doctors.qualification',
                'doctors.languages',
                'doctors.tags',
                'doctors.department_id',
                'doctors.about',
                'doctors.profile_image',
                'doctors.fb_url',
                'doctors.li_url',
                'doctors.tw_url',
                'doctors.in_url',
                'doctors.gb_url',
                'doctors.testimonial',
                'CAT.department_name as dept'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();

        // dd($singleDetails);

        $docEdu = DB::table('doctor_degrees as EDU')
            ->Join('doctors', 'doctors.doctor_id', '=', 'EDU.doctor_id')
            ->select(
                'EDU.year as edu_timeline',
                'EDU.university',
                'EDU.degree_name as degree',
                'EDU.location_about as edu_location_about',
                'EDU.doctor_degree_id as edu_id'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();

        $docExp = DB::table('doctors')
            ->Join('doctor_experience as EXP', 'doctors.doctor_id', '=', 'EXP.doctor_id')
            ->select(
                'EXP.timeline as exp_timeline',
                'EXP.designation as exp_designation',
                'EXP.location_about as exp_location_about',
                'EXP.id as exp_id'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();

        $docWrk = DB::table('clinic_doctor as CD')
            ->Join('doctors as D', 'D.doctor_id', '=', 'CD.doctor_id')
            ->Join('clinics as C', 'CD.clinic_id', '=', 'C.clinic_id')
            ->orderBy('C.clinic_name', 'ASC')
            ->SelectRaw('GROUP_CONCAT(DISTINCT CD.clinic_id) as id,GROUP_CONCAT(DISTINCT C.clinic_name) as clinic_name,GROUP_CONCAT(DISTINCT C.location) as location,GROUP_CONCAT(DISTINCT C.clinic_phone) as clinic_phone')
            ->where('D.doctor_id', $id)
            ->groupBy('CD.clinic_id')
            ->get()
            ->toArray();

        $docBlogs = DB::table('doctors')
            ->Join('articles', 'doctors.doctor_id', '=', 'articles.posted_by')
            ->Join('department as CAT', 'doctors.department_id', '=', 'CAT.department_id')
            ->select(
                'articles.article_title',
                'articles.article_type',
                'articles.posted_url',
                'articles.article_image',
                'articles.short_description',
                'articles.article_id',
                'CAT.department_name as dept'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();

        $docsavedservicess = DB::Table('doctors')
            ->where('doctors.doctor_id', $id)
            ->pluck('service_status')
            ->first();

        if ($docsavedservicess != '') {
            $docsavedservicess = json_decode($docsavedservicess);
            $avbid = array_column($docsavedservicess, 'id');
        } else {
            $avbid = [0];
        }

        $docServices = DB::table('doctors')
            ->Join('services as SRV', 'doctors.department_id', '=', 'SRV.categories_id')
            ->select('SRV.title', 'SRV.id', 'doctors.department_id')
            ->whereNotIn('SRV.id', $avbid)
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();
        // dd($docServices);

        $all_category = BlogCategory::all();

        return view('backend.pages.doc-web.edit')->with([
            'singleDetails' => $singleDetails,
            'docEdu' => $docEdu,
            'docExp' => $docExp,
            'docWrk' => $docWrk,
            'docBlogs' => $docBlogs,
            'docServices' => $docServices,
            'all_category' => $all_category,
            'docsavedservicess' => $docsavedservicess,
        ]);
    }

    public function deldocexp($exp_id)
    {
        /**

         * @post('/admin-home/doctor-web-details/doctor-details/deladex/{id}')
         * @name('admin.doctor.details.delete.exp')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */
        DB::Table('doctor_experience')
            ->where('id', $exp_id)
            ->delete();

        return redirect()->back()->with([
            'msg' => 'Doctor Experience Deleted...',
            'type' => 'danger',
        ]);
    }

    public function deldocedu($edu_id)
    {
        /**

         * @post('/admin-home/doctor-web-details/doctor-details/deladeu/{id}')
         * @name('admin.doctor.details.delete.edu')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */
        DB::Table('doctor_degrees')
            ->where('doctor_degree_id', $edu_id)
            ->delete();

        return redirect()->back()->with([
            'msg' => 'Doctor Education Deleted...',
            'type' => 'danger',
        ]);
    }
}
