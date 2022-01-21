<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        /**

         * @get('/admin-home/blog')
         * @name('admin.blog')
         * @middlewares(web, blogs, auth:admin)
         */
        $all_blog = Blog::all();
        return view('backend.pages.blog.index')->with([
            'all_blog' => $all_blog,
        ]);
    }
    public function new_blog()
    {
        /**

         * @get('/admin-home/new-blog')
         * @name('admin.blog.new')
         * @middlewares(web, blogs, auth:admin)
         */
        $all_category = BlogCategory::all();
        return view('backend.pages.blog.new')->with([
            'all_category' => $all_category,
        ]);
    }
    public function store_new_blog(Request $request)
    {
        /**

         * @post('/admin-home/new-blog')
         * @name('')
         * @middlewares(web, blogs, auth:admin)
         */
        // dd($request->all());
        $this->validate($request, [
            'article_type' => 'required',
            'patient_visibility' => 'required',
            'doctor_visibility' => 'required',
            'partner_visibility' => 'required',
            'department_id' => 'required',
            'article_title' => 'required',
            'tags' => 'nullable',
            'article_description' => 'nullable',
            'short_description' => 'required',
            'posted_dep' => 'required',
            'article_author' => 'required',
            'read_article_link' => 'required',
            'video_url' => 'nullable',
            'posted_url_img' => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'posted_url_pdf' => 'nullable|mimes:pdf,xlx,csv|max:2048',
        ]);

        if (!empty($request->posted_url_img)) {
            $postedimg = time().'.'.$request->posted_url_img->extension();
            $request->posted_url_img->move('../../clinic.umdaa.co/uploads/article_images', $postedimg);
        }
        if (!empty($request->posted_url_pdf)) {
            $postedpdf = time().'.'.$request->posted_url_pdf->extension();
            $request->posted_url_pdf->move('../../clinic.umdaa.co/uploads/article_pdf', $postedpdf);
        }
        
        if (!empty($request->posted_url_pdf)) {
        $insertedid = DB::table('articles')->insertGetId([
            'article_type' => $request->article_type,
            'article_title' => $request->article_title,
            'tags' => $request->tags,
            'article_description' => $request->article_description,
            'short_description' => $request->short_description,
            'article_author' => $request->article_author,
            'read_article_link' => $request->read_article_link,
            'video_url' => $request->video_url,
            'posted_url' => $postedpdf,
            'posted_dep' => $request->posted_dep,
            'posted_date' => Carbon::now(),
            'posted_by' => 3023,
            'posted_by_type' => 'content_writer',
            'review_by' => 3023,
            'article_status' => 'published',
            'created_by' => 3023,
        ]);
        } elseif (!empty($request->posted_url_img)) {
        $insertedid = DB::table('articles')->insertGetId([
            'article_type' => $request->article_type,
            'article_title' => $request->article_title,
            'tags' => $request->tags,
            'article_description' => $request->article_description,
            'short_description' => $request->short_description,
            'article_author' => $request->article_author,
            'read_article_link' => $request->read_article_link,
            'video_url' => $request->video_url,
            'posted_url' => $postedimg,
            'posted_dep' => $request->posted_dep,
            'posted_date' => Carbon::now(),
            'posted_by' => 3023,
            'posted_by_type' => 'content_writer',
            'review_by' => 3023,
            'article_status' => 'published',
            'created_by' => 3023,
        ]);
        }
        else {
            $insertedid = DB::table('articles')->insertGetId([
                'article_type' => $request->article_type,
                'article_title' => $request->article_title,
                'tags' => $request->tags,
                'article_description' => $request->article_description,
                'short_description' => $request->short_description,
                'article_author' => $request->article_author,
                'read_article_link' => $request->read_article_link,
                'video_url' => $request->video_url,
                'posted_dep' => $request->posted_dep,
                'posted_date' => Carbon::now(),
                'posted_by' => 3023,
                'posted_by_type' => 'content_writer',
                'review_by' => 3023,
                'article_status' => 'published',
                'created_by' => 3023,
            ]);
            }

        foreach($request->department_id as $dep_id)
        {
            DB::table('article_department')->insert([
                'article_id' => $insertedid,
                'department_id' => $dep_id,
                'patient_visibility' => $request->patient_visibility,
                'doctor_visibility' => $request->doctor_visibility,
                'partner_visibility' => $request->partner_visibility,
            ]);
    
        }
      
        return redirect()
            ->back()
            ->with([
                'msg' => 'New Blog Post Added...',
                'type' => 'success',
            ]);
    }
    public function edit_blog($article_id)
    {
        /**

         * @get('/admin-home/blog-edit/{id}')
         * @name('admin.blog.edit')
         * @middlewares(web, blogs, auth:admin)
         */
        $blog_post = Blog::find($article_id);
        $dep_posted = DB::table('article_department')->where('article_id', '=',$article_id)->get();
        $all_category = BlogCategory::all();
        return view('backend.pages.blog.edit')->with([
            'all_category' => $all_category,
            'blog_post' => $blog_post,
            'dep_posted' => $dep_posted,
        ]);
    }
    public function update_blog(Request $request, $article_id)
    {
        /**

         * @post('/admin-home/blog-update/{id}')
         * @name('admin.blog.update')
         * @middlewares(web, blogs, auth:admin)
         */

        // dd($request->all());
        $this->validate($request, [
            'article_type' => 'required',
            'patient_visibility' => 'required',
            'doctor_visibility' => 'required',
            'partner_visibility' => 'required',
            'department_id' => 'required',
            'article_title' => 'required',
            'tags' => 'nullable',
            'article_description' => 'nullable',
            'short_description' => 'required',
            'posted_dep' => 'required',
            'article_author' => 'required',
            'read_article_link' => 'required',
            'video_url' => 'nullable',
            'posted_url_img' => 'nullable|string|max:191',
            'posted_url_pdf' => 'nullable|string|max:191',
        ]);
        if (!empty($request->posted_url_img)) {
            $postedimg = time().'.'.$request->posted_url_img->extension();
            $request->posted_url_img->move('../../clinic.umdaa.co/uploads/article_images', $postedimg);
        }
        if (!empty($request->posted_url_pdf)) {
            $postedpdf = time().'.'.$request->posted_url_pdf->extension();
            $request->posted_url_pdf->move('../../clinic.umdaa.co/uploads/article_pdf', $postedpdf);
        }
        if (!empty($request->posted_url_pdf)) {
            $insertedid = DB::table('articles')->where('article_id', $article_id)->update([
                'article_type' => $request->article_type,
                'article_title' => $request->article_title,
                'tags' => $request->tags,
                'article_description' => $request->article_description,
                'short_description' => $request->short_description,
                'article_author' => $request->article_author,
                'read_article_link' => $request->read_article_link,
                'video_url' => $request->video_url,
                'posted_url' => $postedpdf,
                'posted_dep' => $request->posted_dep,
                'modified_by' => 3023,
            ]);
            }
        elseif (!empty($request->posted_url_img)) {
            $insertedid = DB::table('articles')->where('article_id', $article_id)->update([
                'article_type' => $request->article_type,
                'article_title' => $request->article_title,
                'tags' => $request->tags,
                'article_description' => $request->article_description,
                'short_description' => $request->short_description,
                'article_author' => $request->article_author,
                'read_article_link' => $request->read_article_link,
                'video_url' => $request->video_url,
                'posted_url' => $postedimg,
                'posted_dep' => $request->posted_dep,
                'modified_by' => 3023,
            ]);
            }
        else {
            $insertedid = DB::table('articles')->where('article_id', $article_id)->update([
                'article_type' => $request->article_type,
                'article_title' => $request->article_title,
                'tags' => $request->tags,
                'article_description' => $request->article_description,
                'short_description' => $request->short_description,
                'article_author' => $request->article_author,
                'read_article_link' => $request->read_article_link,
                'video_url' => $request->video_url,
                'posted_dep' => $request->posted_dep,
                'modified_by' => 3023,
            ]);
            }
    
            foreach($request->department_id as $dep_id)
            {
                DB::table('article_department')->where('article_id', $article_id)->updateOrInsert([
                    'article_id' => $insertedid,
                    'department_id' => $dep_id,
                    'patient_visibility' => $request->patient_visibility,
                    'doctor_visibility' => $request->doctor_visibility,
                    'partner_visibility' => $request->partner_visibility,
                ]);
        
            }

        return redirect()
            ->back()
            ->with([
                'msg' => 'Blog Post updated...',
                'type' => 'success',
            ]);
    }
    public function delete_blog(Request $request, $article_id)
    {
        /**

         * @post('/admin-home/blog-delete/{id}')
         * @name('admin.blog.delete')
         * @middlewares(web, blogs, auth:admin)
         */
        Blog::find($article_id)->delete();
        DB::table('article_department')->where('article_id', '=',$article_id)->delete();

        return redirect()
            ->back()
            ->with([
                'msg' => 'Blog Post Delete Success...',
                'type' => 'danger',
            ]);
    }

}
