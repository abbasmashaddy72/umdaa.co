<?php

namespace App\Http\Controllers;

use App\Admin;
use App\MediaUpload;
use App\Services;
use App\Blog;
use App\ContactInfoItem;
use App\KeyFeatures;
use App\PricePlan;
use App\TeamMember;
use App\Testimonial;
use App\Works;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\Process\Process;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function adminIndex()
    {
        /**

         * @get('/admin-home')
         * @name('admin.home')
         * @middlewares(web, auth:admin)
         */

        $all_blogs = Blog::count();
        $total_admin = Admin::count();
        $total_testimonial = Testimonial::count();
        $total_team_member = TeamMember::count();
        $total_price_plan = PricePlan::count();
        $total_services = Services::count();
        $total_key_features = KeyFeatures::count();
        $total_works = Works::count();

        return view('backend.admin-home')->with([
            'blog_count' => $all_blogs,
            'total_admin' => $total_admin,
            'total_testimonial' => $total_testimonial,
            'total_team_member' => $total_team_member,
            'total_price_plan' => $total_price_plan,
            'total_works' => $total_works,
            'total_services' => $total_services,
            'total_key_features' => $total_key_features,
        ]);
    }

    public function admin_profile_update(Request $request)
    {
        /**

         * @post('/admin-home/profile-update')
         * @name('')
         * @middlewares(web, auth:admin)
         */
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'username' => 'required|string|max:191',
            'image' => 'nullable|string|max:191'
        ]);
        Admin::find(Auth::user()->id)->update(['name' => $request->name, 'email' => $request->email,'username' => str_replace(' ','_',$request->username), 'image' => $request->image]);

        return redirect()->back()->with(['msg' => 'Profile Update Success', 'type' => 'success']);
    }

    public function admin_password_chagne(Request $request)
    {
        /**

         * @post('/admin-home/password-change')
         * @name('')
         * @middlewares(web, auth:admin)
         */
        $this->validate($request, [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = Admin::findOrFail(Auth::id());

        if (!Hash::check($request->old_password, $user->password)){

        return redirect()->back()->with(['msg' => 'Somethings Going Wrong! Please Try Again or Check Your Old Password', 'type' => 'danger']);
    } 

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('admin.login')->with(['msg' => 'Password Changed Successfully', 'type' => 'success']);
        }

    public function adminLogout()
    {
        /**

         * @post('/logout/admin')
         * @name('admin.logout')
         * @middlewares(web, auth:admin)
         */
        Auth::logout();
        return redirect()->route('admin.login')->with(['msg' => 'You Logged Out !!', 'type' => 'danger']);
    }

    public function admin_profile()
    {
        /**

         * @get('/admin-home/profile-update')
         * @name('admin.profile.update')
         * @middlewares(web, auth:admin)
         */
        return view('auth.admin.edit-profile');
    }

    public function admin_password()
    {
        /**

         * @get('/admin-home/password-change')
         * @name('admin.password.change')
         * @middlewares(web, auth:admin)
         */
        return view('auth.admin.change-password');
    }

    public function update_navbar_settings(Request $request)
    {
        /**

         * @post('/admin-home/navbar-settings')
         * @name('')
         * @middlewares(web, nabvar_settings, auth:admin)
         */

        $this->validate($request, [
            'navbar_button' => 'nullable|string',
            'navbar_button_custom_url' => 'nullable|string',
            'navbar_button_custom_url_status' => 'nullable|string',
        ]);

        update_static_option('navbar_button', $request->navbar_button);
        update_static_option('navbar_button_custom_url', $request->navbar_button_custom_url);
        update_static_option('navbar_button_custom_url_status', $request->navbar_button_custom_url_status);
        update_static_option('site_header_type', $request->site_header_type);
        update_static_option('navbar_button_text', $request->navbar_button_text);



        return redirect()->back()->with(['msg' => 'Navbar Settings Updated..', 'type' => 'success']);
    }
}


