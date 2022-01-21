<?php

namespace App\Http\Controllers;

use App\Knowledgebase;
use App\KnowledgebaseTopic;
use Illuminate\Http\Request;

class KnowledgebaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function all_knowledgebases(){
        /**

         * @get('/admin-home/knowledge')
         * @name('admin.knowledge.all')
         * @middlewares(web, knowledgebase, auth:admin)
         */
        $all_articles = Knowledgebase::all();
        return view('backend.knowledgebase.all-knowledgebase')->with(['all_article' => $all_articles]);
    }

    public function new_knowledgebase(){
        /**

         * @get('/admin-home/knowledge/new')
         * @name('admin.knowledge.new')
         * @middlewares(web, knowledgebase, auth:admin)
         */
        $all_topics = KnowledgebaseTopic::get();

        return view('backend.knowledgebase.new-knowledgebase')->with(['all_topics' => $all_topics]);
    }

    public function store_knowledgebases(Request $request){
        /**

         * @post('/admin-home/knowledge/new')
         * @name('')
         * @middlewares(web, knowledgebase, auth:admin)
         */
        $this->validate($request,[
           'title' => 'required|string',
           'content' => 'required|string',
           'topic_id' => 'required|string|max:191',
           'status' => 'required|string|max:191',
        ]);

        Knowledgebase::create($request->all());

        return redirect()->back()->with(['msg' => 'New Article Added Success...','type' => 'success']);
    }

    public function edit_knowledgebases($id){
        /**

         * @get('/admin-home/knowledge/edit/{id}')
         * @name('admin.knowledge.edit')
         * @middlewares(web, knowledgebase, auth:admin)
         */
        $articles = Knowledgebase::find($id);
        $all_topics = KnowledgebaseTopic::where(['status' =>'publish'])->get();

        return view('backend.knowledgebase.edit-knowledgebase')->with(['articles' => $articles,'all_topics' => $all_topics]);
    }
    public function update_knowledgebases(Request $request){
        /**

         * @post('/admin-home/knowledge/update')
         * @name('admin.knowledge.update')
         * @middlewares(web, knowledgebase, auth:admin)
         */
        $this->validate($request,[
            'title' => 'required|string',
            'content' => 'required|string',
            'topic_id' => 'required|string|max:191',
            'status' => 'required|string|max:191',
        ]);

        Knowledgebase::find($request->article_id)->update($request->all());

        return redirect()->back()->with(['msg' => 'Article Update Success...','type' => 'success']);
    }
    public function delete_knowledgebases($id){
        /**

         * @post('/admin-home/knowledge/delete/{id}')
         * @name('admin.knowledge.delete')
         * @middlewares(web, knowledgebase, auth:admin)
         */

        Knowledgebase::find($id)->delete();
 
         return redirect()->back()->with(['msg' => 'Delete Success...','type' => 'danger']);
     }
}
