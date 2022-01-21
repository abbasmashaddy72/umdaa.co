<?php

namespace App\Http\Controllers;

use App\Knowledgebase;
use App\KnowledgebaseTopic;
use Illuminate\Http\Request;

class KnowledgebaseTopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_knowledgebase_category(){
        /**

         * @get('/admin-home/knowledge/category')
         * @name('admin.knowledge.category.all')
         * @middlewares(web, knowledgebase, auth:admin)
         */

        $all_category = KnowledgebaseTopic::all();
        return view('backend.knowledgebase.all-knowledgebase-category')->with(['all_category' => $all_category] );
    }

    public function store_knowledgebase_category(Request $request){
        /**

         * @post('/admin-home/knowledge/category/new')
         * @name('admin.knowledge.category.new')
         * @middlewares(web, knowledgebase, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191|unique:events_categories',
            'status' => 'required|string|max:191'
        ]);

        KnowledgebaseTopic::create($request->all());

        return redirect()->back()->with([
            'msg' => 'New Topic Added...',
            'type' => 'success'
        ]);
    }

    public function update_knowledgebase_category(Request $request){
        /**

         * @post('/admin-home/knowledge/category/update')
         * @name('admin.knowledge.category.update')
         * @middlewares(web, knowledgebase, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string|max:191',
            'status' => 'required|string|max:191'
        ]);

        KnowledgebaseTopic::find($request->id)->update([
            'title' => $request->title,
            'status' => $request->status,
        ]);

        return redirect()->back()->with([
            'msg' => 'Topic Update Success...',
            'type' => 'success'
        ]);
    }

    public function delete_knowledgebase_category(Request $request,$id){
        /**

         * @post('/admin-home/knowledge/category/delete/{id}')
         * @name('admin.knowledge.category.delete')
         * @middlewares(web, knowledgebase, auth:admin)
         */
        if (Knowledgebase::where('topic_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => 'You Can Not Delete This Topic, It Already Associated With A Knowledge base Article...',
                'type' => 'danger'
            ]);
        }
        KnowledgebaseTopic::find($id)->delete();
        return redirect()->back()->with([
            'msg' => 'Topic Delete Success...',
            'type' => 'danger'
        ]);
    }
}
