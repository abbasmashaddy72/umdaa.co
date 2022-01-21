<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DoctorWebsiteController extends Controller
{
    public function doctor_website($id, $any)
    {
        /**

         * @get('/d/{id}/{any}')
         * @name('frontend.doctor.website')
         * @middlewares(web, globalVariable)
         */
        $singleDetails = DB::table('doctors')
            ->Join('department as CAT', 'doctors.department_id', '=', 'CAT.department_id')
            ->select(
                'doctors.doctor_id',
                'doctors.first_name',
                'doctors.last_name',
                'doctors.qualification',
                'doctors.tags',
                'doctors.department_id',
                'doctors.about',
                'doctors.profile_image',
                'doctors.fb_url',
                'doctors.li_url',
                'doctors.tw_url',
                'doctors.in_url',
                'doctors.gb_url',
                'CAT.department_name as dept'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();

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
            ->Join('clinic_doctor_weekdays as CDW', 'CD.clinic_doctor_id', '=', 'CDW.clinic_doctor_id')
            ->Join('clinic_doctor_weekday_slots as CDWS', 'CDW.clinic_doctor_weekday_id', '=', 'CDWS.clinic_doctor_weekday_slot_id')
            ->orderBy('C.clinic_name', 'ASC')
            ->SelectRaw('GROUP_CONCAT(DISTINCT CD.clinic_id),GROUP_CONCAT(DISTINCT C.clinic_name) as clinic_name,GROUP_CONCAT(DISTINCT C.location) as location,GROUP_CONCAT(DISTINCT C.clinic_phone) as clinic_phone,GROUP_CONCAT(DISTINCT CDW.weekday) as working_days,GROUP_CONCAT(DISTINCT CDW.slot),GROUP_CONCAT(DISTINCT CDWS.session),GROUP_CONCAT(DISTINCT CDWS.from_time) as from_time,GROUP_CONCAT(DISTINCT CDWS.to_time) as to_time')
            ->where('D.doctor_id', $id)
            ->where('CDWS.from_time','!=','00:00:00')
            ->where('CDWS.to_time','!=','00:00:00')
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

        $docServices = DB::table('doctors')
            ->Join('services as SRV', 'doctors.department_id', '=', 'SRV.categories_id')
            ->select(
                'SRV.title',
                'SRV.id'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();

        $docsavedservicess = DB::Table('doctors')
            ->where('doctors.doctor_id', $id)
            ->pluck('service_status')
            ->first();
        $docsavedservicess = json_decode($docsavedservicess);

        return view('frontend.pages.doctor-website')->with([
            'singleDetails' => $singleDetails,
            'docEdu' => $docEdu,
            'docExp' => $docExp,
            'docWrk' => $docWrk,
            'docBlogs' => $docBlogs,
            'docServices' => $docServices,
            'docsavedservicess' => $docsavedservicess,
        ]);
    }

    public function doctor_website1($id, $any)
    {
        /**

         * @get('/d1/{id}/{any}')
         * @name('frontend.doctor.website1')
         * @middlewares(web, globalVariable)
         */
        $singleDetails = DB::table('doctors')
            ->Join('department as CAT', 'doctors.department_id', '=', 'CAT.department_id')
            ->select(
                'doctors.doctor_id',
                'doctors.first_name',
                'doctors.last_name',
                'doctors.qualification',
                'doctors.tags',
                'doctors.department_id',
                'doctors.about',
                'doctors.profile_image',
                'doctors.fb_url',
                'doctors.li_url',
                'doctors.tw_url',
                'doctors.in_url',
                'doctors.gb_url',
                'CAT.department_name as dept'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();

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
            ->Join('clinic_doctor_weekdays as CDW', 'CD.clinic_doctor_id', '=', 'CDW.clinic_doctor_id')
            ->Join('clinic_doctor_weekday_slots as CDWS', 'CDW.clinic_doctor_weekday_id', '=', 'CDWS.clinic_doctor_weekday_slot_id')
            ->orderBy('C.clinic_name', 'ASC')
            ->SelectRaw('GROUP_CONCAT(DISTINCT CD.clinic_id),GROUP_CONCAT(DISTINCT C.clinic_name) as clinic_name,GROUP_CONCAT(DISTINCT C.location) as location,GROUP_CONCAT(DISTINCT C.clinic_phone) as clinic_phone,GROUP_CONCAT(DISTINCT CDW.weekday) as working_days,GROUP_CONCAT(DISTINCT CDW.slot),GROUP_CONCAT(DISTINCT CDWS.session),GROUP_CONCAT(DISTINCT CDWS.from_time) as from_time,GROUP_CONCAT(DISTINCT CDWS.to_time) as to_time')
            ->where('D.doctor_id', $id)
            ->where('CDWS.from_time','!=','00:00:00')
            ->where('CDWS.to_time','!=','00:00:00')
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

        $docServices = DB::table('doctors')
            ->Join('services as SRV', 'doctors.department_id', '=', 'SRV.categories_id')
            ->select(
                'SRV.title',
                'SRV.id'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();
        
        $ListdocServices = implode(", ", array_column($docServices, "title"));

        $docsavedservicess = DB::Table('doctors')
            ->where('doctors.doctor_id', $id)
            ->pluck('service_status')
            ->first();
        $docsavedservicess = json_decode($docsavedservicess);

        $Listdocsavedservicess = implode(", ", array_column($docsavedservicess, "title"));

        return view('frontend.pages.doctor-website1')->with([
            'singleDetails' => $singleDetails,
            'docEdu' => $docEdu,
            'docExp' => $docExp,
            'docWrk' => $docWrk,
            'docBlogs' => $docBlogs,
            'docServices' => $docServices,
            'docsavedservicess' => $docsavedservicess,
            'ListdocServices' => $ListdocServices,
            'Listdocsavedservicess' => $Listdocsavedservicess
        ]);
    }

    public function doctor_website2($id, $any)
    {
        /**

         * @get('/d2/{id}/{any}')
         * @name('frontend.doctor.website2')
         * @middlewares(web, globalVariable)
         */
        $singleDetails = DB::table('doctors')
            ->Join('department as CAT', 'doctors.department_id', '=', 'CAT.department_id')
            ->select(
                'doctors.doctor_id',
                'doctors.first_name',
                'doctors.last_name',
                'doctors.qualification',
                'doctors.tags',
                'doctors.department_id',
                'doctors.about',
                'doctors.profile_image',
                'doctors.fb_url',
                'doctors.li_url',
                'doctors.tw_url',
                'doctors.in_url',
                'doctors.gb_url',
                'CAT.department_name as dept'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();

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
            ->Join('clinic_doctor_weekdays as CDW', 'CD.clinic_doctor_id', '=', 'CDW.clinic_doctor_id')
            ->Join('clinic_doctor_weekday_slots as CDWS', 'CDW.clinic_doctor_weekday_id', '=', 'CDWS.clinic_doctor_weekday_slot_id')
            ->orderBy('C.clinic_name', 'ASC')
            ->SelectRaw('GROUP_CONCAT(DISTINCT CD.clinic_id),GROUP_CONCAT(DISTINCT C.clinic_name) as clinic_name,GROUP_CONCAT(DISTINCT C.location) as location,GROUP_CONCAT(DISTINCT C.clinic_phone) as clinic_phone,GROUP_CONCAT(DISTINCT CDW.weekday) as working_days,GROUP_CONCAT(DISTINCT CDW.slot),GROUP_CONCAT(DISTINCT CDWS.session),GROUP_CONCAT(DISTINCT CDWS.from_time) as from_time,GROUP_CONCAT(DISTINCT CDWS.to_time) as to_time')
            ->where('D.doctor_id', $id)
            ->where('CDWS.from_time','!=','00:00:00')
            ->where('CDWS.to_time','!=','00:00:00')
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

            $docServices = DB::table('doctors')
            ->Join('services as SRV', 'doctors.department_id', '=', 'SRV.categories_id')
            ->select(
                'SRV.title',
                'SRV.id'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();
        
        $ListdocServices = implode(", ", array_column($docServices, "title"));

        $docsavedservicess = DB::Table('doctors')
            ->where('doctors.doctor_id', $id)
            ->pluck('service_status')
            ->first();
        $docsavedservicess = json_decode($docsavedservicess);

        $Listdocsavedservicess = implode(", ", array_column($docsavedservicess, "title"));

        return view('frontend.pages.doctor-website2')->with([
            'singleDetails' => $singleDetails,
            'docEdu' => $docEdu,
            'docExp' => $docExp,
            'docWrk' => $docWrk,
            'docBlogs' => $docBlogs,
            'docServices' => $docServices,
            'docsavedservicess' => $docsavedservicess,
            'ListdocServices' => $ListdocServices,
            'Listdocsavedservicess' => $Listdocsavedservicess
        ]);
    }

    public function doctor_website3($id, $any)
    {
        /**

         * @get('/d3/{id}/{any}')
         * @name('frontend.doctor.website3')
         * @middlewares(web, globalVariable)
         */
        $singleDetails = DB::table('doctors')
            ->Join('department as CAT', 'doctors.department_id', '=', 'CAT.department_id')
            ->select(
                'doctors.doctor_id',
                'doctors.first_name',
                'doctors.last_name',
                'doctors.qualification',
                'doctors.tags',
                'doctors.department_id',
                'doctors.about',
                'doctors.profile_image',
                'doctors.fb_url',
                'doctors.li_url',
                'doctors.tw_url',
                'doctors.in_url',
                'doctors.gb_url',
                'CAT.department_name as dept'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();

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
            ->Join('clinic_doctor_weekdays as CDW', 'CD.clinic_doctor_id', '=', 'CDW.clinic_doctor_id')
            ->Join('clinic_doctor_weekday_slots as CDWS', 'CDW.clinic_doctor_weekday_id', '=', 'CDWS.clinic_doctor_weekday_slot_id')
            ->orderBy('C.clinic_name', 'ASC')
            ->SelectRaw('GROUP_CONCAT(DISTINCT CD.clinic_id),GROUP_CONCAT(DISTINCT C.clinic_name) as clinic_name,GROUP_CONCAT(DISTINCT C.location) as location,GROUP_CONCAT(DISTINCT C.clinic_phone) as clinic_phone,GROUP_CONCAT(DISTINCT CDW.weekday) as working_days,GROUP_CONCAT(DISTINCT CDW.slot),GROUP_CONCAT(DISTINCT CDWS.session),GROUP_CONCAT(DISTINCT CDWS.from_time) as from_time,GROUP_CONCAT(DISTINCT CDWS.to_time) as to_time')
            ->where('D.doctor_id', $id)
            ->where('CDWS.from_time','!=','00:00:00')
            ->where('CDWS.to_time','!=','00:00:00')
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

            $docServices = DB::table('doctors')
            ->Join('services as SRV', 'doctors.department_id', '=', 'SRV.categories_id')
            ->select(
                'SRV.title',
                'SRV.id'
            )
            ->where('doctors.doctor_id', $id)
            ->get()
            ->toArray();
        
        $ListdocServices = implode(", ", array_column($docServices, "title"));

        $docsavedservicess = DB::Table('doctors')
            ->where('doctors.doctor_id', $id)
            ->pluck('service_status')
            ->first();
        $docsavedservicess = json_decode($docsavedservicess);

        $Listdocsavedservicess = implode(", ", array_column($docsavedservicess, "title"));

        return view('frontend.pages.doctor-website3')->with([
            'singleDetails' => $singleDetails,
            'docEdu' => $docEdu,
            'docExp' => $docExp,
            'docWrk' => $docWrk,
            'docBlogs' => $docBlogs,
            'docServices' => $docServices,
            'docsavedservicess' => $docsavedservicess,
            'ListdocServices' => $ListdocServices,
            'Listdocsavedservicess' => $Listdocsavedservicess
        ]);
    }
    
}
