<?php

namespace App\Http\Controllers;

use App\Admin;
use App\ContactInfoItem;
use App\Events;
use App\EventsCategory;
use App\Faq;
use App\Jobs;
use App\JobsCategory;
use App\KnowAbout;
use App\Knowledgebase;
use App\KnowledgebaseTopic;
use App\Mail\AdminResetEmail;
use App\Mail\CallBack;
use App\Mail\ContactMessage;
use App\Mail\PlaceOrder;
use App\Mail\RequestQuote;
use App\Menu;
use App\Newsletter;
use App\Order;
use App\Page;
use App\PaymentLogs;
use App\Quote;
use App\ServiceCategory;
use App\Services;
use App\Blog;
use App\BlogCategory;
use App\HeaderSlider;
use App\KeyFeatures;
use App\PricePlan;
use App\TeamMember;
use App\Testimonial;
use App\Works;
use App\WorksCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class FrontendController extends Controller
{

    public function index()
    {
        /**

         * @get('//')
         * @name('homepage')
         * @middlewares(web, globalVariable)
         */
        if (!empty(get_static_option('site_maintenance_mode'))) {
            return view('frontend.maintain');
        }
        $all_header_slider = HeaderSlider::get();
        $doc_count = TeamMember::count();
        $dep_count = BlogCategory::count();
        $clinic_count = DB::table('clinics')->count();
        $app_count = DB::table('appointments')->where('status', '=', 'closed')->where('slot_type', '=', 'walkin')->count();
        $all_service = Services::orderBy('id', 'asc')->take(3)->get();
        $all_testimonial = Testimonial::where('profile_image', '!=', '')->where('testimonial', '!=', 'Null')->take(10)->get();
        $all_faq = Faq::orderBy('id', 'asc')->take(5)->get();

        return view('frontend.partials.home')->with([
            'all_header_slider' => $all_header_slider,
            'all_service' => $all_service,
            'all_testimonial' => $all_testimonial,
            'all_faq' => $all_faq,
            'doc_count' => $doc_count,
            'dep_count' => $dep_count,
            'clinic_count' => $clinic_count,
            'app_count' => $app_count,
        ]);
    }

    public function dynamic_service_page()
    {
        $all_key_features = KeyFeatures::get();

        return view('frontend.dynamic_service')->with([
            'all_key_features' => $all_key_features,
        ]);
    }

    public function blog_page(Request $request)
    {
        /**

         * @get('/blogs')
         * @name('frontend.blog')
         * @middlewares(web, globalVariable)
         */
        $all_recent_blogs = Blog::orderBy('article_id', 'desc')->take(3)->get();
        $all_blogs = Blog::orderBy('article_id', 'desc')->paginate(8);
        $m_all_blogs = Blog::orderBy('article_id', 'desc')->take(10)->get();
        $all_category = BlogCategory::where(['status' => '0'])->orderBy('department_id', 'desc')->get();

        return view('frontend.pages.blogs.blog')->with([
            'all_blogs' => $all_blogs,
            'all_categories' => $all_category,
            'all_recent_blogs' => $all_recent_blogs,
            'm_all_blogs' => $m_all_blogs,
        ]);
    }

    public function category_wise_blog_page($id)
    {
        /**

         * @get('/blogs/category/{id}/{any}')
         * @name('frontend.blog.category')
         * @middlewares(web, globalVariable)
         */
        $all_blogs = Blog::where(['posted_dep' => $id])->orderBy('article_id', 'desc')->paginate(8);
        $all_recent_blogs = Blog::orderBy('article_id', 'desc')->take(3)->get();
        $all_category = BlogCategory::where(['status' => '0',])->orderBy('department_id', 'desc')->take(6)->get();
        $category_name = BlogCategory::where(['department_id' => $id])->first()->department_name;
        return view('frontend.pages.blogs.blog-category')->with([
            'all_blogs' => $all_blogs,
            'all_categories' => $all_category,
            'category_name' => $category_name,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }

    public function tags_wise_blog_page($tag)
    {
        /**

         * @get('/blogs-tags/{name}')
         * @name('frontend.blog.tags.page')
         * @middlewares(web, globalVariable)
         */
        $all_blogs = Blog::Where('tags', 'LIKE', '%' . $tag . '%')
            ->orderBy('article_id', 'desc')->paginate(8);
        $all_recent_blogs = Blog::orderBy('article_id', 'desc')->take(3)->get();
        $all_category = BlogCategory::where(['status' => '0'])->orderBy('department_id', 'desc')->get();
        return view('frontend.pages.blogs.blog-tags')->with([
            'all_blogs' => $all_blogs,
            'all_categories' => $all_category,
            'tag_name' => $tag,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }

    public function blog_search_page(Request $request)
    {
        /**

         * @get('/blogs/search')
         * @name('frontend.blog.search')
         * @middlewares(web, globalVariable)
         */
        $all_recent_blogs = Blog::orderBy('article_id', 'desc')->take(3)->get();
        $all_category = BlogCategory::where(['status' => 'publish'])->orderBy('department_id', 'desc')->get();
        $all_blogs = Blog::Where('article_title', 'LIKE', '%' . $request->search . '%')
            ->orderBy('article_id', 'desc')->paginate(8);
        return view('frontend.pages.blogs.blog-search')->with([
            'all_blogs' => $all_blogs,
            'all_categories' => $all_category,
            'search_term' => $request->search,
            'all_recent_blogs' => $all_recent_blogs,
        ]);
    }

    public function blog_single_page($id, $any)
    {
        /**

         * @get('/blogs/{id}/{any}')
         * @name('frontend.blog.single')
         * @middlewares(web, globalVariable)
         */
        $blog_post = Blog::where('article_id', $id)->first();
        $m_all_blogs = Blog::orderByRaw("article_id = $id DESC")->take(10)->get();
        $all_recent_blogs = Blog::orderBy('article_id', 'desc')->paginate(3);
        $all_category = BlogCategory::where(['status' => '0'])->orderBy('department_id', 'desc')->get();
        $all_related_blog = Blog::Where('article_id', $blog_post->id)->orderBy('article_id', 'desc')->take(6)->get();
        return view('frontend.pages.blogs.blog-single')->with([
            'blog_post' => $blog_post,
            'all_categories' => $all_category,
            'all_recent_blogs' => $all_recent_blogs,
            'all_related_blog' => $all_related_blog,
            'm_all_blogs' => $m_all_blogs,
        ]);
    }

    public function m_blog_single_page($id, $any)
    {
        /**

         * @get('/mblogs/{id}/{any}')
         * @name('frontend.blog.m_single')
         * @middlewares(web, globalVariable)
         */
        $blog_post = Blog::where('article_id', $id)->first();
        $m_all_blogs = Blog::orderByRaw("article_id = $id DESC")->take(10)->get();
        $all_recent_blogs = Blog::orderBy('article_id', 'desc')->paginate(3);
        $all_category = BlogCategory::where(['status' => '0'])->orderBy('department_id', 'desc')->get();
        $all_related_blog = Blog::Where('article_id', $blog_post->id)->orderBy('article_id', 'desc')->take(6)->get();
        return view('frontend.pages.blogs.mblog-single')->with([
            'blog_post' => $blog_post,
            'all_categories' => $all_category,
            'all_recent_blogs' => $all_recent_blogs,
            'all_related_blog' => $all_related_blog,
            'm_all_blogs' => $m_all_blogs,
        ]);
    }

    public function dynamic_single_page($id, $any)
    {
        /**

         * @get('/p/{id}/{any}')
         * @name('frontend.dynamic.page')
         * @middlewares(web, globalVariable)
         */
        $page_post = Page::where('id', $id)->first();
        return view('frontend.pages.dynamic-single')->with([
            'page_post' => $page_post
        ]);
    }

    public function showAdminForgetPasswordForm()
    {
        /**

         * @get('/login/admin/forget-password')
         * @name('admin.forget.password')
         * @middlewares(web)
         */
        return view('auth.admin.forget-password');
    }

    public function sendAdminForgetPasswordMail(Request $request)
    {
        /**

         * @post('/login/admin/forget-password')
         * @name('')
         * @middlewares(web)
         */
        $this->validate($request, [
            'username' => 'required|string:max:191'
        ]);
        $user_info = Admin::where('username', $request->username)->orWhere('email', $request->username)->first();
        if (empty($user_info)) {
            return redirect()->back()->with([
                'msg' => 'Your Username or Email Is Wrong!!!',
                'type' => 'danger'
            ]);
        }
        $token_id = Str::random(30);
        $existing_token = DB::table('password_resets')->where('email', $user_info->email)->delete();
        if (empty($existing_token)) {
            DB::table('password_resets')->insert(['email' => $user_info->email, 'token' => $token_id]);
        }
        $message = 'Here is you password reset link, If you did not request to reset your password just ignore this mail. <a class="btn" href="' . route('admin.reset.password', ['user' => $user_info->username, 'token' => $token_id]) . '">Click Reset Password</a>';
        $data = [
            'username' => $user_info->username,
            'message' => $message
        ];
        Mail::to($user_info->email)->send(new AdminResetEmail($data));

        return redirect()->back()->with([
            'msg' => 'Check Your Mail For Reset Password Link',
            'type' => 'success'
        ]);
    }

    public function showAdminResetPasswordForm($username, $token)
    {
        /**

         * @get('/login/admin/reset-password/{user}/{token}')
         * @name('admin.reset.password')
         * @middlewares(web)
         */
        return view('auth.admin.reset-password')->with([
            'username' => $username,
            'token' => $token
        ]);
    }

    public function AdminResetPassword(Request $request)
    {
        /**

         * @post('/login/admin/reset-password')
         * @name('admin.reset.password.change')
         * @middlewares(web)
         */
        $this->validate($request, [
            'token' => 'required',
            'username' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user_info = Admin::where('username', $request->username)->first();
        $user = Admin::findOrFail($user_info->id);
        $token_iinfo = DB::table('password_resets')->where(['email' => $user_info->email, 'token' => $request->token])->first();
        if (!empty($token_iinfo)) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('admin.login')->with(['msg' => 'Password Changed Successfully', 'type' => 'success']);
        }

        return redirect()->back()->with(['msg' => 'Somethings Going Wrong! Please Try Again or Check Your Old Password', 'type' => 'danger']);
    }

    public function send_contact_message(Request $request)
    {
        /**

         * @post('/contact-message')
         * @name('frontend.contact.message')
         * @middlewares(web, globalVariable)
         */

        $all_quote_form_fields = json_decode(get_static_option('contact_page_form_fields'));
        $required_fields = [];
        $fileds_name = [];
        $attachment_list = [];
        foreach ($all_quote_form_fields->field_type as $key => $value) {
            if (is_object($all_quote_form_fields->field_required) && !empty($all_quote_form_fields->field_required->$key) && $value != 'file') {

                $sanitize_rule = ($value == 'email') ? 'email' : 'string';
                $required_fields[$all_quote_form_fields->field_name[$key]] = 'required|' . $sanitize_rule;
            } elseif (is_object($all_quote_form_fields->field_required) && $value == 'file') {

                $file_required = isset($all_quote_form_fields->field_required->$key) ? 'required|' : '';
                $file_mimes_type = isset($all_quote_form_fields->mimes_type->$key) ? $all_quote_form_fields->mimes_type->$key : '';
                $required_fields[$all_quote_form_fields->field_name[$key]] = $file_required . $file_mimes_type . '|max:6054';
            } elseif (is_array($all_quote_form_fields->field_required) && $value == 'file') {

                $file_required = isset($all_quote_form_fields->field_required->$key) ? 'required|' : '';
                $file_mimes_type = isset($all_quote_form_fields->mimes_type->$key) ? $all_quote_form_fields->mimes_type->$key : '';
                $required_fields[$all_quote_form_fields->field_name[$key]] = $file_required . $file_mimes_type . '|max:6054';
            } else if (!(is_array($all_quote_form_fields->field_required) && !empty($all_quote_form_fields->field_required[$key]) && $value != 'file')) {
                continue;
            }

            $sanitize_rule = ($value == 'email') ? 'email' : 'string';
            $required_fields[$all_quote_form_fields->field_name[$key]] = 'required|' . $sanitize_rule;
        }
        $this->validate($request, $required_fields);

        foreach ($all_quote_form_fields->field_type as $key => $value) {
            if ($value != 'file') {
                $singule_field_name = $all_quote_form_fields->field_name[$key];
                $checkbox_value = ($value == 'checkbox' && !empty($request->$singule_field_name)) ? 'Yes' : 'No';
                $fileds_name[$singule_field_name] = ($value != 'checkbox') ? $request->$singule_field_name : $checkbox_value;
            } elseif ($value == 'file') {
                $singule_field_name = $all_quote_form_fields->field_name[$key];
                if ($request->hasFile($singule_field_name)) {
                    $filed_instance = $request->file($singule_field_name);
                    $file_extenstion = $filed_instance->getClientOriginalExtension();
                    $attachment_name = 'attachment-' . $singule_field_name . '.' . $file_extenstion;
                    $filed_instance->move('assets/uploads/attachment/', $attachment_name);
                    $attachment_list[$singule_field_name] = 'assets/uploads/attachment/' . $attachment_name;
                }
            }
        }

        $google_captcha_result = google_captcha_check($request->captcha_token);

        if (!$google_captcha_result['success']) {
            return redirect()->back()->with(['msg' => 'Something goes wrong, Please try again later !!', 'type' => 'danger']);
        }

        $succ_msg = get_static_option('contact_mail_subject');
        $success_message = !empty($succ_msg) ? $succ_msg : 'Thanks for your contact!!';
        Mail::to(get_static_option('site_global_email'))->send(new ContactMessage($fileds_name, $attachment_list));
        return redirect()->back()->with(['msg' => $success_message, 'type' => 'success']);
    }

    public function services_single_page($id, $any)
    {
        /**

         * @get('/doc-services/{id}/{any}')
         * @name('frontend.services.single')
         * @middlewares(web, globalVariable)
         */
        $service_item = Services::where('id', $id)->first();
        $service_category = BlogCategory::get();
        return view('frontend.pages.services.service-single')->with(['service_item' => $service_item, 'service_category' => $service_category]);
    }

    public function category_wise_services_page($id)
    {
        /**

         * @get('/doc-services/category/{id}/{any}')
         * @name('frontend.services.category')
         * @middlewares(web, globalVariable)
         */
        $category_name = BlogCategory::where(['department_id' => $id, 'status' => '0',])->first()->department_name;
        $service_item = Services::where(['categories_id' => $id])->paginate(6);
        return view('frontend.pages.services.services')->with(['service_items' => $service_item, 'category_name' => $category_name]);
    }

    public function work_single_page($id, $any)
    {
        /**

         * @get('/a-z/{id}/{any}')
         * @name('frontend.work.single')
         * @middlewares(web, globalVariable)
         */
        $work_item = Works::where('id', $id)->first();
        $all_works = [];
        $all_related_works = [];
        foreach ($work_item->categories_id as $cat) {
            $all_by_cat = Works::where('categories_id', 'LIKE', '%' . $work_item->$cat . '%')->take(6)->get();
            for ($i = 0; $i < count($all_by_cat); $i++) {
                array_push($all_works, $all_by_cat[$i]);
            }
        }
        array_unique($all_works);
        return view('frontend.pages.works.work-single')->with(['work_item' => $work_item, 'related_works' => $all_works]);
    }

    public function about_page()
    {
        /**

         * @get('/about-us')
         * @name('frontend.about')
         * @middlewares(web, globalVariable)
         */
        $all_blog = Blog::orderBy('article_id', 'desc')->take(9)->get();
        $all_testimonial = Testimonial::get();
        $all_know_about = KnowAbout::get();
        $all_service = Services::orderBy('id', 'desc')->take(4)->get();
        return view('frontend.pages.about')->with([
            'all_blog' => $all_blog,
            'all_testimonial' => $all_testimonial,
            'all_service' => $all_service,
            'all_know_about' => $all_know_about,
        ]);
    }

    public function service_page()
    {
        /**

         * @get('/doc-services')
         * @name('frontend.service')
         * @middlewares(web, globalVariable)
         */
        $count = Services::count();
        $skip = 3;
        $limit = $count - $skip;
        $all_services = Services::orderBy('id', 'desc')->take($limit)->paginate(12);
        $all_price_plan = PricePlan::get();
        return view('frontend.pages.services.service')->with(['all_services' => $all_services, 'all_price_plan' => $all_price_plan]);
    }

    public function work_page()
    {
        /**

         * @get('/a-z')
         * @name('frontend.work')
         * @middlewares(web, globalVariable)
         */
        $all_work = Works::orderBy('id', 'desc')->paginate(12);
        $all_work_category = WorksCategory::where(['status' => 'publish'])->get();
        return view('frontend.pages.works.work')->with(['all_work' => $all_work, 'all_work_category' => $all_work_category]);
    }

    public function team_page()
    {
        /**

         * @get('/doctors')
         * @name('frontend.team')
         * @middlewares(web, globalVariable)
         */
        $all_team_members = TeamMember::orderBy('doctor_id', 'asc')->paginate(12);

        return view('frontend.pages.team-page')->with(['all_team_members' => $all_team_members]);
    }

    public function team_search(Request $request)
    {
        /**

         * @get('/doctors/search')
         * @name('frontend.team.search')
         * @middlewares(web, globalVariable)
         */
        $dep = BlogCategory::Where('department_name', 'LIKE', '%' . $request->search . '%')->get('department_id');
        $all_team_members = TeamMember::orWhere('first_name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('last_name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('diseases_dealt', 'LIKE', '%' . $request->search . '%')
            ->orWhereIn('department_id', $dep)
            ->orderBy('doctor_id', 'asc')->paginate(12);

        return view('frontend.pages.team-search')->with([
            'all_team_members' => $all_team_members,
            'dep' => $dep,
            'search_term' => $request->search,
        ]);
    }

    public function faq_page()
    {
        /**

         * @get('/faq')
         * @name('frontend.faq')
         * @middlewares(web, globalVariable)
         */
        $all_faq = Faq::get();
        $all_testimonial = Testimonial::get();
        return view('frontend.pages.faq-page')->with([
            'all_testimonial' => $all_testimonial,
            'all_faqs' => $all_faq
        ]);
    }

    public function contact_page()
    {
        /**

         * @get('/contact-us')
         * @name('frontend.contact')
         * @middlewares(web, globalVariable)
         */
        $all_contact_info = ContactInfoItem::get();
        return view('frontend.pages.contact-page')->with([
            'all_contact_info' => $all_contact_info
        ]);
    }

    public function plan_order($id)
    {
        /**

         * @get('/plan-order/{id}')
         * @name('frontend.plan.order')
         * @middlewares(web, globalVariable)
         */
        $order_details = PricePlan::find($id);
        $deptartment = BlogCategory::orderBy('department_name', 'asc')->get(['department_id', 'department_name']);
        $clinics = DB::table('clinics')->get(['clinic_id', 'clinic_name', 'location']);
        return view('frontend.pages.order-page')->with([
            'order_details' => $order_details,
            'deptartment' => $deptartment,
            'clinics' => $clinics,
        ]);
    }

    public function request_quote()
    {
        /**

         * @get('/forms')
         * @name('frontend.request.quote')
         * @middlewares(web, globalVariable)
         */
        $contact_info = ContactInfoItem::get();
        return view('frontend.pages.quote-page')->with(['all_contact_info' => $contact_info]);
    }

    public function send_quote_message(Request $request)
    {
        /**

         * @post('/forms')
         * @name('frontend.quote.message')
         * @middlewares(web, globalVariable)
         */

        $all_quote_form_fields = json_decode(get_static_option('quote_page_form_fields'));
        $required_fields = [];
        $fileds_name = [];
        $attachment_list = [];
        foreach ($all_quote_form_fields->field_type as $key => $value) {
            if (is_object($all_quote_form_fields->field_required) && !empty($all_quote_form_fields->field_required->$key) && $value != 'file') {

                $sanitize_rule = ($value == 'email') ? 'email' : 'string';
                $required_fields[$all_quote_form_fields->field_name[$key]] = 'required|' . $sanitize_rule;
            } elseif (is_object($all_quote_form_fields->field_required) && $value == 'file') {

                $file_required = isset($all_quote_form_fields->field_required->$key) ? 'required|' : '';
                $file_mimes_type = isset($all_quote_form_fields->mimes_type->$key) ? $all_quote_form_fields->mimes_type->$key : '';
                $required_fields[$all_quote_form_fields->field_name[$key]] = $file_required . $file_mimes_type . '|max:6054';
            } elseif (is_array($all_quote_form_fields->field_required) && $value == 'file') {

                $file_required = isset($all_quote_form_fields->field_required->$key) ? 'required|' : '';
                $file_mimes_type = isset($all_quote_form_fields->mimes_type->$key) ? $all_quote_form_fields->mimes_type->$key : '';
                $required_fields[$all_quote_form_fields->field_name[$key]] = $file_required . $file_mimes_type . '|max:6054';
            } else if (!(is_array($all_quote_form_fields->field_required) && !empty($all_quote_form_fields->field_required[$key]) && $value != 'file')) {
                continue;
            }

            $sanitize_rule = ($value == 'email') ? 'email' : 'string';
            $required_fields[$all_quote_form_fields->field_name[$key]] = 'required|' . $sanitize_rule;
        }
        $this->validate($request, $required_fields);
        //have to insert quote data to database to show all quote in backend;
        $all_field_serialize_data = $request->all();
        unset($all_field_serialize_data['_token']);
        unset($all_field_serialize_data['captcha_token']);
        foreach ($all_field_serialize_data as $field_name => $field_value) {
            if ($request->hasFile($field_name)) {
                unset($all_field_serialize_data[$field_name]);
            }
        }
        $quote_id = Quote::create([
            'custom_fields' => serialize($all_field_serialize_data),
            'status' => 'pending'
        ])->id;

        foreach ($all_quote_form_fields->field_type as $key => $value) {
            if ($value != 'file') {
                $singule_field_name = $all_quote_form_fields->field_name[$key];
                $checkbox_value = ($value == 'checkbox' && !empty($request->$singule_field_name)) ? 'Yes' : 'No';
                $fileds_name[$singule_field_name] = ($value != 'checkbox') ? $request->$singule_field_name : $checkbox_value;
            } elseif ($value == 'file') {
                $singule_field_name = $all_quote_form_fields->field_name[$key];
                if ($request->hasFile($singule_field_name)) {
                    $filed_instance = $request->file($singule_field_name);
                    $file_extenstion = $filed_instance->getClientOriginalExtension();
                    $attachment_name = 'attachment-' . $quote_id . '-' . $singule_field_name . '.' . $file_extenstion;
                    $filed_instance->move('assets/uploads/attachment/', $attachment_name);

                    $attachment_list[$singule_field_name] = 'assets/uploads/attachment/' . $attachment_name;
                }
            }
        }

        Quote::find($quote_id)->update(['attachment' => serialize($attachment_list)]);

        $google_captcha_result = google_captcha_check($request->captcha_token);
        if (!$google_captcha_result['success']) {

            return redirect()->back()->with(['msg' => 'Something went wrong, Please try again later !!', 'type' => 'danger']);
        }
        //have to check mail
        $succ_msg = get_static_option('quote_mail_subject');
        $success_message = !empty($succ_msg) ? $succ_msg : 'Thanks for your quote. we will get back to you very soon.';

        Mail::to(get_static_option('quote_page_form_mail'))->send(new RequestQuote($fileds_name, $attachment_list));

        return redirect()->back()->with(['msg' => $success_message, 'type' => 'success']);
    }

    public function send_order_message(Request $request)
    {
        /**

         * @post('/place-order')
         * @name('frontend.order.message')
         * @middlewares(web, globalVariable)
         */
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";
        // exit();
        /**

         * @post('/place-order')
         * @name('frontend.order.message')
         * @middlewares(web, globalVariable)
         */

        $all_quote_form_fields = json_decode(get_static_option('order_page_form_fields'));
        $required_fields = [];
        $fileds_name = [];
        $attachment_list = [];
        foreach ($all_quote_form_fields->field_type as $key => $value) {
            if (is_object($all_quote_form_fields->field_required) && !empty($all_quote_form_fields->field_required->$key) && $value != 'file') {

                $sanitize_rule = ($value == 'email') ? 'email' : 'string';
                $required_fields[$all_quote_form_fields->field_name[$key]] = 'required|' . $sanitize_rule;
            } elseif (is_object($all_quote_form_fields->field_required) && $value == 'file') {

                $file_required = isset($all_quote_form_fields->field_required->$key) ? 'required|' : '';
                $file_mimes_type = isset($all_quote_form_fields->mimes_type->$key) ? $all_quote_form_fields->mimes_type->$key : '';
                $required_fields[$all_quote_form_fields->field_name[$key]] = $file_required . $file_mimes_type . '|max:6054';
            } elseif (is_array($all_quote_form_fields->field_required) && $value == 'file') {

                $file_required = isset($all_quote_form_fields->field_required->$key) ? 'required|' : '';
                $file_mimes_type = isset($all_quote_form_fields->mimes_type->$key) ? $all_quote_form_fields->mimes_type->$key : '';
                $required_fields[$all_quote_form_fields->field_name[$key]] = $file_required . $file_mimes_type . '|max:6054';
            } else if (!(is_array($all_quote_form_fields->field_required) && !empty($all_quote_form_fields->field_required[$key]) && $value != 'file')) {
                continue;
            }

            $sanitize_rule = ($value == 'email') ? 'email' : 'string';
            $required_fields[$all_quote_form_fields->field_name[$key]] = 'required|' . $sanitize_rule;
        }
        $this->validate($request, $required_fields);
        if (!empty(get_static_option('site_payment_gateway'))) {
            $this->validate(
                $request,
                [
                    'selected_payment_gateway' => 'required|string'
                ],
                [
                    'selected_payment_gateway.required' => "select one payment gateway to place order"
                ]
            );
        }
        $package_detials = PricePlan::find($request->package);
        $all_field_serialize_data = $request->all();
        unset($all_field_serialize_data['_token']);
        unset($all_field_serialize_data['captcha_token']);
        foreach ($all_field_serialize_data as $field_name => $field_value) {
            if ($request->hasFile($field_name)) {
                unset($all_field_serialize_data[$field_name]);
            }
        }
        $order_id = Order::create([
            'custom_fields' => serialize($all_field_serialize_data),
            'status' => 'pending',
            'package_name' => $package_detials->title,
            'package_price' => $package_detials->price,
            'package_id' => $package_detials->id,
        ])->id;

        foreach ($all_quote_form_fields->field_type as $key => $value) {
            if ($value != 'file') {
                $singule_field_name = $all_quote_form_fields->field_name[$key];
                $checkbox_value = ($value == 'checkbox' && !empty($request->$singule_field_name)) ? 'Yes' : 'No';
                $fileds_name[$singule_field_name] = ($value != 'checkbox') ? $request->$singule_field_name : $checkbox_value;
            } elseif ($value == 'file') {
                $singule_field_name = $all_quote_form_fields->field_name[$key];
                if ($request->hasFile($singule_field_name)) {
                    $filed_instance = $request->file($singule_field_name);
                    $file_extenstion = $filed_instance->getClientOriginalExtension();
                    $attachment_name = 'attachment-' . $order_id . '-' . $singule_field_name . '.' . $file_extenstion;
                    $filed_instance->move('assets/uploads/attachment/', $attachment_name);

                    $attachment_list[$singule_field_name] = 'assets/uploads/attachment/' . $attachment_name;
                }
            }
        }
        Order::find($order_id)->update(['attachment' => serialize($attachment_list)]);



        //for development purpose
        if (!empty(get_static_option('site_payment_gateway'))) {

            $succ_msg = get_static_option('order_mail_subject');
            $success_message = !empty($succ_msg) ? $succ_msg : 'Thanks for your order. we will get back to you very soon.';

            Mail::to(get_static_option('order_page_form_mail'))->send(new PlaceOrder($fileds_name, $attachment_list, $package_detials));

            return redirect()->route('frontend.order.confirm', $order_id);
        }
        //for development purpose

        $google_captcha_result = google_captcha_check($request->captcha_token);
        if (!$google_captcha_result['success']) {
            return redirect()->back()->with(['msg' => 'Something goes wrong, Please try again later !!', 'type' => 'danger']);
        }

        $succ_msg = get_static_option('order_mail_subject');
        $success_message = !empty($succ_msg) ? $succ_msg : 'Thanks for your order. we will get back to you very soon.';

        Mail::to(get_static_option('order_page_form_mail'))->send(new PlaceOrder($fileds_name, $attachment_list, $package_detials));

        //have to set condition for redirect in payment page with payment information
        if (!empty(get_static_option('site_payment_gateway'))) {
            return redirect()->route('frontend.payment.' . $request->selected_payment_gateway);
        }
        return redirect()->back()->with(['msg' => $success_message, 'type' => 'success']);
    }

    public function subscribe_newsletter(Request $request)
    {
        /**

         * @post('/subscribe-newsletter')
         * @name('frontend.subscribe.newsletter')
         * @middlewares(web, globalVariable)
         */
        $this->validate($request, [
            'email' => 'required|string|email|max:191|unique:newsletters'
        ]);
        Newsletter::create($request->all());
        return redirect()->back()->with([
            'msg' => 'Thanks for Subscribe Our Newsletter',
            'type' => 'success'
        ]);
    }

    public function category_wise_works_page($id)
    {
        /**

         * @get('/a-z/category/{id}/{any}')
         * @name('frontend.works.category')
         * @middlewares(web, globalVariable)
         */
        $category = WorksCategory::find($id);
        $all_works = Works::where('categories_id', 'LIKE', '%' . $id . '%')->paginate(12);
        $category_name = $category->name;
        $all_category = WorksCategory::get();
        return view('frontend.pages.works.work-category')->with(['all_work' => $all_works, 'category_name' => $category_name, 'all_work_category' => $all_category]);
    }

    public function send_call_back_message(Request $request)
    {
        /**

         * @post('/request-call-back')
         * @name('frontend.call.back.message')
         * @middlewares(web, globalVariable)
         */

        $all_quote_form_fields = json_decode(get_static_option('call_back_page_form_fields'));
        $required_fields = [];
        $fileds_name = [];
        $attachment_list = [];
        foreach ($all_quote_form_fields->field_type as $key => $value) {
            if (is_object($all_quote_form_fields->field_required) && !empty($all_quote_form_fields->field_required->$key) && $value != 'file') {

                $sanitize_rule = ($value == 'email') ? 'email' : 'string';
                $required_fields[$all_quote_form_fields->field_name[$key]] = 'required|' . $sanitize_rule;
            } elseif (is_object($all_quote_form_fields->field_required) && $value == 'file') {

                $file_required = isset($all_quote_form_fields->field_required->$key) ? 'required|' : '';
                $file_mimes_type = isset($all_quote_form_fields->mimes_type->$key) ? $all_quote_form_fields->mimes_type->$key : '';
                $required_fields[$all_quote_form_fields->field_name[$key]] = $file_required . $file_mimes_type . '|max:6054';
            } elseif (is_array($all_quote_form_fields->field_required) && $value == 'file') {

                $file_required = isset($all_quote_form_fields->field_required->$key) ? 'required|' : '';
                $file_mimes_type = isset($all_quote_form_fields->mimes_type->$key) ? $all_quote_form_fields->mimes_type->$key : '';
                $required_fields[$all_quote_form_fields->field_name[$key]] = $file_required . $file_mimes_type . '|max:6054';
            } else if (!(is_array($all_quote_form_fields->field_required) && !empty($all_quote_form_fields->field_required[$key]) && $value != 'file')) {
                continue;
            }

            $sanitize_rule = ($value == 'email') ? 'email' : 'string';
            $required_fields[$all_quote_form_fields->field_name[$key]] = 'required|' . $sanitize_rule;
        }
        $this->validate($request, $required_fields);

        foreach ($all_quote_form_fields->field_type as $key => $value) {
            if ($value != 'file') {
                $singule_field_name = $all_quote_form_fields->field_name[$key];
                $checkbox_value = ($value == 'checkbox' && !empty($request->$singule_field_name)) ? 'Yes' : 'No';
                $fileds_name[$singule_field_name] = ($value != 'checkbox') ? $request->$singule_field_name : $checkbox_value;
            } elseif ($value == 'file') {
                $singule_field_name = $all_quote_form_fields->field_name[$key];
                if ($request->hasFile($singule_field_name)) {
                    $filed_instance = $request->file($singule_field_name);
                    $file_extenstion = $filed_instance->getClientOriginalExtension();
                    $attachment_name = 'attachment-' . $singule_field_name . '.' . $file_extenstion;
                    $filed_instance->move('assets/uploads/attachment/', $attachment_name);
                    $attachment_list[$singule_field_name] = 'assets/uploads/attachment/' . $attachment_name;
                }
            }
        }


        $succ_msg = get_static_option('request_call_back_mail_subject');
        $success_message = !empty($succ_msg) ? $succ_msg : 'Thanks for Your Contact!!! We Will Contact You Soon';

        Mail::to(get_static_option('home_page_01_faq_area_form_mail'))->send(new CallBack($fileds_name, $attachment_list));;

        return redirect()->back()->with([
            'msg' => $success_message,
            'type' => 'success'
        ]);
    }

    public function price_plan_page()
    {
        /**

         * @get('/pricing')
         * @name('frontend.price.plan')
         * @middlewares(web, globalVariable)
         */
        $all_price_plan = PricePlan::orderBy('id', 'asc')->skip(1)->take(3)->get();

        return view('frontend.pages.price-plan')->with(['all_price_plan' => $all_price_plan]);
    }

    public function order_confirm($id)
    {
        /**

         * @get('/order-confirm/{id}')
         * @name('frontend.order.confirm')
         * @middlewares(web, globalVariable)
         */
        $order_details = Order::find($id);
        $custom_fields = unserialize($order_details->custom_fields);
        $departmentid = !empty($custom_fields['department']) ? $custom_fields['department'] : '';
        // $arr = explode(",", $departmentid, 2);
        // $departmentid = $arr[0];
        $clinic_hospital = !empty($custom_fields['clinichospital']) ? $custom_fields['clinichospital'] : '';
        $deptartment = BlogCategory::orderBy('department_name', 'asc')->where('department_id', $departmentid)->get(['department_id', 'department_name']);
        // echo ($deptartment);
        // exit();
        $clinics = DB::table('clinics')->where('clinic_id', $clinic_hospital)->get(['clinic_id', 'clinic_name', 'location']);
        return view('frontend.payment.order-confirm')->with(['order_details' => $order_details, 'deptartment' => $deptartment, 'clinics' => $clinics]);
    }

    public function order_payment_success($id)
    {
        /**

         * @get('/order-success/{id}')
         * @name('frontend.order.payment.success')
         * @middlewares(web, globalVariable)
         */
        $order_details = Order::find($id);
        return view('frontend.payment.success')->with(['order_details' => $order_details]);
    }
    public function order_payment_cancel($id)
    {
        /**

         * @get('/order-cancel/{id}')
         * @name('frontend.order.payment.cancel')
         * @middlewares(web, globalVariable)
         */
        $order_details = Order::find($id);
        return view('frontend.payment.cancel')->with(['order_details' => $order_details]);
    }

    //jobs
    public function jobs()
    {
        /**

         * @get('/career-with-us')
         * @name('frontend.jobs')
         * @middlewares(web, globalVariable)
         */
        $all_jobs = Jobs::where(['status' => 'publish'])->orderBy('id', 'desc')->paginate(5);
        $all_job_category = JobsCategory::where(['status' => 'publish'])->get();
        return view('frontend.pages.jobs.jobs')->with([
            'all_jobs' => $all_jobs,
            'all_job_category' => $all_job_category,
        ]);
    }

    public function jobs_category($id, $any)
    {
        /**

         * @get('/career-with-us-category/{id}/{any}')
         * @name('frontend.jobs.category')
         * @middlewares(web, globalVariable)
         */

        $all_jobs = Jobs::where(['status' => 'publish', 'category_id' => $id])->orderBy('id', 'desc')->paginate(5);
        $all_job_category = JobsCategory::where(['status' => 'publish'])->get();
        $category_name = JobsCategory::find($id)->title;
        return view('frontend.pages.jobs.jobs-category')->with([
            'all_jobs' => $all_jobs,
            'all_job_category' => $all_job_category,
            'category_name' => $category_name,
        ]);
    }

    public function jobs_search(Request $request)
    {
        /**

         * @get('/career-with-us/search')
         * @name('frontend.jobs.search')
         * @middlewares(web, globalVariable)
         */
        $all_jobs = Jobs::where(['status' => 'publish'])->where('title', 'LIKE', '%' . $request->search . '%')->paginate(5);
        $all_job_category = JobsCategory::where(['status' => 'publish'])->get();
        $search_term = $request->search;

        return view('frontend.pages.jobs.jobs-search')->with([
            'all_jobs' => $all_jobs,
            'all_job_category' => $all_job_category,
            'search_term' => $search_term,
        ]);
    }

    public function jobs_single($id)
    {
        /**

         * @get('/career-with-us/{id}/{any}')
         * @name('frontend.jobs.single')
         * @middlewares(web, globalVariable)
         */
        $job = Jobs::find($id);
        $all_job_category = JobsCategory::where(['status' => 'publish'])->get();
        return view('frontend.pages.jobs.jobs-single')->with([
            'job' => $job,
            'all_job_category' => $all_job_category
        ]);
    }

    //events
    public function events()
    {
        /**

         * @get('/events')
         * @name('frontend.events')
         * @middlewares(web, globalVariable)
         */
        $all_events = Events::where(['status' => 'publish'])->orderBy('id', 'desc')->paginate(6);
        $all_event_category = EventsCategory::where(['status' => 'publish'])->get();
        return view('frontend.pages.events.event')->with([
            'all_events' => $all_events,
            'all_event_category' => $all_event_category,
        ]);
    }

    public function events_category($id, $any)
    {
        /**

         * @get('/events-category/{id}/{any}')
         * @name('frontend.events.category')
         * @middlewares(web, globalVariable)
         */

        $all_events = Events::where(['status' => 'publish', 'category_id' => $id])->orderBy('id', 'desc')->paginate(6);
        $all_events_category = EventsCategory::where(['status' => 'publish'])->get();
        $category_name = EventsCategory::find($id)->title;
        return view('frontend.pages.events.event-category')->with([
            'all_events' => $all_events,
            'all_events_category' => $all_events_category,
            'category_name' => $category_name,
        ]);
    }

    public function events_search(Request $request)
    {
        /**

         * @get('/events/search')
         * @name('frontend.events.search')
         * @middlewares(web, globalVariable)
         */
        $all_events = Events::where(['status' => 'publish'])->where('title', 'LIKE', '%' . $request->search . '%')->paginate(6);
        $all_events_category = EventsCategory::where(['status' => 'publish'])->get();
        $search_term = $request->search;

        return view('frontend.pages.events.event-search')->with([
            'all_events' => $all_events,
            'all_event_category' => $all_events_category,
            'search_term' => $search_term,
        ]);
    }

    public function events_single($id)
    {
        /**

         * @get('/events/{id}/{any}')
         * @name('frontend.events.single')
         * @middlewares(web, globalVariable)
         */
        $event = Events::find($id);
        $all_events_category = EventsCategory::where(['status' => 'publish'])->get();
        return view('frontend.pages.events.event-single')->with([
            'event' => $event,
            'all_event_category' => $all_events_category
        ]);
    }

    //knowledgebase
    public function knowledgebase()
    {
        /**

         * @get('/knowledgebase')
         * @name('frontend.knowledgebase')
         * @middlewares(web, globalVariable)
         */
        $all_knowledgebase = Knowledgebase::where(['status' => 'publish'])->paginate(12)->groupBy('topic_id');
        $all_knowledgebase_category = KnowledgebaseTopic::where(['status' => 'publish'])->get();
        $popular_articles = Knowledgebase::where(['status' => 'publish'])->orderBy('views', 'desc')->get()->take(5);
        return view('frontend.pages.knowledgebase.knowledgebase')->with([
            'all_knowledgebase' => $all_knowledgebase,
            'popular_articles' => $popular_articles,
            'all_knowledgebase_category' => $all_knowledgebase_category,
        ]);
    }

    public function knowledgebase_category($id, $any)
    {
        /**

         * @get('/knowledgebase-category/{id}/{any}')
         * @name('frontend.knowledgebase.category')
         * @middlewares(web, globalVariable)
         */

        $all_knowledgebase = Knowledgebase::where(['status' => 'publish', 'topic_id' => $id])->orderBy('views', 'desc')->paginate(12);
        $all_knowledgebase_category = KnowledgebaseTopic::where(['status' => 'publish'])->get();
        $popular_articles = Knowledgebase::where(['status' => 'publish'])->orderBy('views', 'desc')->get()->take(5);
        $category_name = KnowledgebaseTopic::find($id)->title;
        return view('frontend.pages.knowledgebase.knowledgebase-category')->with([
            'all_knowledgebase' => $all_knowledgebase,
            'all_knowledgebase_category' => $all_knowledgebase_category,
            'popular_articles' => $popular_articles,
            'category_name' => $category_name,
        ]);
    }

    public function knowledgebase_search(Request $request)
    {
        /**

         * @get('/knowledgebase/search')
         * @name('frontend.knowledgebase.search')
         * @middlewares(web, globalVariable)
         */

        $all_knowledgebase = Knowledgebase::where(['status' => 'publish'])->where('title', 'LIKE', '%' . $request->search . '%')->orderBy('views', 'desc')->paginate(12);
        $all_knowledgebase_category = KnowledgebaseTopic::where(['status' => 'publish'])->get();
        $popular_articles = Knowledgebase::where(['status' => 'publish'])->orderBy('views', 'desc')->get()->take(5);
        $search_term = $request->search;

        return view('frontend.pages.knowledgebase.knowledgebase-search')->with([
            'all_knowledgebase' => $all_knowledgebase,
            'all_knowledgebase_category' => $all_knowledgebase_category,
            'popular_articles' => $popular_articles,
            'search_term' => $search_term,
        ]);
    }

    public function knowledgebase_single($id)
    {
        /**

         * @get('/knowledgebase/{id}/{any}')
         * @name('frontend.knowledgebase.single')
         * @middlewares(web, globalVariable)
         */
        $knowledgebase = Knowledgebase::find($id);
        $old_views = is_null($knowledgebase->views) ? 0 : $knowledgebase->views + 1;
        Knowledgebase::find($id)->update(['views' => $old_views]);

        $all_knowledgebase_category = KnowledgebaseTopic::where(['status' => 'publish'])->get();
        $popular_articles = Knowledgebase::where(['status' => 'publish'])->orderBy('views', 'desc')->get()->take(5);
        return view('frontend.pages.knowledgebase.knowledgebase-single')->with([
            'knowledgebase' => $knowledgebase,
            'all_knowledgebase_category' => $all_knowledgebase_category,
            'popular_articles' => $popular_articles,
        ]);
    }
}//end class