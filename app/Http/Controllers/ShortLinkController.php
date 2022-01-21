<?php  
    
namespace App\Http\Controllers;  
     
use Carbon\Carbon;
use Illuminate\Http\Request;  
use App\ShortLink;  
    
class ShortLinkController extends Controller  
{  
    /**  
     * It is used to show the resource list.  
     *  
     * @return \Illuminate\Http\Response  
     */  
    public function index()  
    {
        /**

         * @get('/sort_link')
         * @name('')
         * @middlewares(web, globalVariable)
         */  
        $shortLinks = ShortLink::latest()->get();  
     
        return view('shortenLink', compact('shortLinks'));  
    }  
       
    /**  
     * It is used to show the resource list.  
     *  
     * @return \Illuminate\Http\Response  
     */  
    public function store(Request $request)  
    {
        /**

         * @post('/sort_link')
         * @name('generate.shorten.link.post')
         * @middlewares(web, globalVariable)
         */  
        $request->validate([  
           'link' => 'required|url'  
        ]);

        if ($request->filled('expires_at')) {
            $input['expires_at'] = Carbon::parse($request->get('expires_at'))->toDateTimeString();
        }
     
        $input['link'] = $request->link;  
        $input['code'] = str_random(6);  
     
        ShortLink::create($input);  
    
        return redirect('generate-shorten-link')  
             ->with('success', 'Shorten Link Generated Successfully!');  
    }  
     
    /**  
     * It is used to show the resource list.  
     *  
     * @return \Illuminate\Http\Response  
     */  
    public function shortenLink($code)  
    {
        /**

         * @get('/s/{code}')
         * @name('shorten.link')
         * @middlewares(web, globalVariable)
         */  
        $headers=array('Cache-Control'=>'no-cache, no-store, max-age=0, must-revalidate','Pragma'=>'no-cache','Expires'=>'Fri, 01 Jan 1990 00:00:00 GMT');
        $url = ShortLink::where('code', $code)->first();  
        if ($url === null){
     
        abort(404);  
    return;} 
            if ($url->hasExpired()) {
                abort(410);
            }

            return redirect()->away($url->link, $url->couldExpire() ? 302 : 301, $headers);
        }  
}