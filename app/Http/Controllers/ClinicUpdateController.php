<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClinicUpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        /**

         * @get('/admin-home/doctor-web-details/clinics-details')
         * @name('admin.clinic.details')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */
        $allclinic = DB::table('clinics')
            ->select(
                'clinics.clinic_id',
                'clinics.clinic_name',
                'clinics.location',
                'clinics.clinic_phone',
            )
            ->get()
            ->toArray();

        return view('backend.pages.clinic')->with([
            'allclinic' => $allclinic,
        ]);
    }

    public function updateclinic(Request $request)
    {
        /**

         * @post('/admin-home/doctor-web-details/clinics-details/update')
         * @name('admin.clinic.details.update')
         * @middlewares(web, doctor_details_manage, auth:admin)
         */
        $this->validate($request, [
            'clinic_name' => 'required',
            'location' => 'nullable',
            'clinic_phone' => 'nullable',
        ]);
        DB::Table('clinics')
            ->where('clinic_id', $request->id)
            ->update([
                'clinic_name' => $request->clinic_name,
                'location' => $request->location,
                'clinic_phone' => $request->clinic_phone,
            ]);

        return redirect()->back()->with([
            'msg' => 'Clinic Details Updated...',
            'type' => 'success',
        ]);
    }
}