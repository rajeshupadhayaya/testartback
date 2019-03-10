<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth; 
// use App\User; 
use Validator;
use DB;
use Illuminate\Support\Facades\Storage;

class publicController extends Controller
{
    //
    public function showhome(){
    	$category = DB::table('sub_categories')
                    ->select('id','sub_category_name', 'description','category_image')
                    ->latest()
                    ->limit(3)
                    ->get();
        $articles = DB::table('article')
                    ->select('id','title', 'authors', 'article_image', 'published_date')
                    ->latest()
                    ->limit(6)
                    ->get();
        return view('welcome',['journals'=>$category, 'articles'=>$articles]);
    }

    public function getjournal(){
        $category = DB::table('category')->select('id','name')->get();
    
        $journal_list = array();
        $all_journals = DB::table('sub_categories')->select('id','sub_category_name')->get();
        foreach ($category as $cat) {
            $sub_categories = DB::table('sub_categories')
                            ->select('id','sub_category_name')
                            ->where('category_name',$cat->name)
                            ->get();    
            array_push($journal_list, array('journal_name'=>$cat->name,'list'=>$sub_categories));
        }
        
        
        return view('journal',['journals'=>$category,'all_journals'=>$all_journals,'journal_lists'=>$journal_list]);
    }

    public function showjournal(Request $request){
        // $journal = $request->segment(1);
        $journal = str_replace('-',' ',$request->segment(1));

        //check if journal name is valid or not, if not throw 402 page
        $all_journals = DB::table('sub_categories')
                        ->where('sub_category_name', $journal)
                        ->select('id','sub_category_name','description' ,'category_image')
                        ->first();
        
        if($all_journals === null){
            //redirect 402
            return abort(404);
        }
        else{
            //get all articles
            $current_issue = DB::table('article')
                            ->where('status','INPRESS')
                            ->select('volume','issue')
                            ->first();

            $inpress = DB::table('article')
                            ->where([['category','=', $all_journals->id], ['status','=','INPRESS']])
                            ->select('title','authors', 'volume', 'issue', 'status','published_date', 'file_path')
                            ->orderBy('published_date')
                            ->get();

            $current = DB::table('article')
                            ->where([['category','=',$all_journals->id],['status','=','ISSUED']])
                            ->select('title','authors', 'volume', 'issue', 'status','published_date', 'file_path')
                            ->orderBy('published_date')
                            ->get();

            //get archieve logic
            

            $volumes = DB::table('article')
                        ->where([['category','=',$all_journals->id],['status','=','ARCHIVE']])
                        ->select('volume')
                        ->orderBy('volume','desc')
                        ->distinct()
                        ->get();

            $archive = array();

            foreach($volumes as $vol){
                
                $issue_content = DB::table('article')
                            ->where([['category','=',$all_journals->id],['status','=','ARCHIVE'],['volume','=',$vol->volume]])
                            ->select('issue')
                            ->orderBy('issue','desc')
                            ->get();
                $issues_arr = array();

                foreach($issue_content as $issue){

                    $article = DB::table('article')
                            ->where([['category','=',$all_journals->id],['status','=','ARCHIVE'],['volume','=',$vol->volume],['issue','=',$issue->issue]])
                            ->select('title', 'authors','category','volume','issue', 'file_path','published_date')
                            ->orderBy('published_date','desc')
                            ->get();
                    array_push($issues_arr, ['issue'=>$issue->issue, 'articles'=>$article]);
                }

                array_push($archive, ['volume'=>$vol->volume, 'issues'=>$issues_arr]);

            }
            

            // $archive = DB::table('article')
            //                 ->where([['category','=',$all_journals->id],['status','=','ARCHIVE']])
            //                 ->select('title','authors', 'volume', 'issue', 'status','published_date', 'file_path')
            //                 ->orderBy('published_date')
            //                 ->get();


            return view('publicjournal', ['volumes'=>$volumes,'journal_info'=>$all_journals ,'current_issue'=>$current_issue,'in_press'=>$inpress,
                                          'current'=>$current,'archives'=>$archive  ]);
        }

    }

    public function getguidelines(){
    
        return view('guidelines');
    }
    public function getmenuscriptform(){
        $category = DB::table('sub_categories')
                    ->select('id','sub_category_name')
                    ->get();
    
        return view('menuscript',['categories'=>$category]);
    }
    public function getcontactusform(){
    
        return view('contactus');
    }
    public function getarticle(Request $request){

        // $title = str_replace('-',' ',$request->segment(2));
        $title = str_replace('-',' ',$request->get('title'));
        
        $html_present = false;
        $article_content = '';

        $article = DB::table('article')
                    ->join('category', 'article.category','=','category.id')
                    ->select('article.*', 'category.name')
                    ->where('title','=' , $title)
                    ->first();
        
        if (DB::table('article_content')->where('title',$title)->exists()){
            $html_present = true;
            $article_content = DB::table('article_content')
                    ->select('body')
                    ->where('title','=', $title,'and','status','=','PUBLISHED')
                    ->first(); 
        }
        
        return view('article', ['html_present' => $html_present, 'article' => $article,'content' => $article_content]);
    }

    public function submitmenuscript(Request $request)
    {
        $request->validate([
            'journal_name' => 'required',
            'menuscript_title' => 'required',
            'contact' => 'required',
            'email' => 'required|email',
            'menuscript_file' => 'required|mimes:pdf',
            'captcha' => 'required|captcha'
        ]);

        if($request->hasFile('menuscript_file')){
                $url = $request->file('menuscript_file')->store('articles', 'public-uploads');
        }

        $data = array('journal_id' => $request->get('journal_name'),
                        'title' => $request->get('menuscript_title'),
                        'email' => $request->get('email'),
                        'contact' => $request->get('contact'),
                        'file_path' => $url,
                        'created_at' => now()
        );

        DB::table('menu_script_submission')->insert($data);

        return back()->withMessage('Your MenuScript sucessfully submitted.');

    }

    
}
