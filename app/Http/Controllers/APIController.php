<?php

namespace App\Http\Controllers;

use App\PricePlan;
use App\ShortLink;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use GuzzleHttp\Client;

class APIController extends Controller
{
    public function price_plans()
    {
        /**

         * @get('/api/price')
         * @name('')
         * @middlewares(api)
         */

        $pricing_plan = PricePlan::orderBy('id', 'asc')->get()->toJson(JSON_PRETTY_PRINT);
        return response($pricing_plan, 200);
    }

    public function sort_url(Request $request)
    {
        /**

         * @post('/api/sort_url')
         * @name('')
         * @middlewares(api)
         */
        if (App::environment('local')) {
            $input['link'] = 'https://citizen.devumdaa.in/#/msg-videocall/' . $request->channel . '/' . $request->token;
        } else {
            $input['link'] = 'https://citizen.umdaa.co/#/msg-videocall/' . $request->channel . '/' . $request->token;
        }
        $input['code'] = str_random(6);
        $input['created_at'] = Carbon::now()->toDateTimeString();
        
        $data = ShortLink::insertGetId($input);

        // $id = $data->id();

        $baseurl = URL::to('/');

        $smsurl = $baseurl.'/s/'.$input['code'];

        return response()->json([$smsurl, $data], 200);
    }

    public function edit_sort_url(Request $request)
    {
        /**

         * @post('/api/edit_sort_url')
         * @name('')
         * @middlewares(api)
         */
        $url = ShortLink::findOrFail($request->id);
        $data['expires_at'] = Carbon::now()->toDateTimeString();
        
        $url->update($data);

        return response()->json([$url,$data], 200);
    }

    public function doctors(Request $request)
    {
        /**
         * @post('/api/doctors')
         * @name('')
         * @middlewares(api)
         */
        $data = DB::table('doctors')
            ->Join('department as CAT', 'doctors.department_id', '=', 'CAT.department_id')
            ->Join('clinic_doctor as CD', 'doctors.doctor_id', '=', 'CD.doctor_id')
            ->Join('clinics as C', 'CD.clinic_id', '=', 'C.clinic_id')
            ->select(
                'doctors.doctor_id',
                'doctors.first_name',
                'doctors.last_name',
                'doctors.qualification',
                'doctors.profile_image',
                'CAT.department_name as dept',
                'C.location as location',
            )
            ->get();
        return response()->json([$request->id,$data], 200);
    }
}
