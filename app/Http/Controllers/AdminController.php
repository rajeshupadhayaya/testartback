<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\User; 
use Validator;
use DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function showlogin(){
    	return view('auth.login');		
    }

    
    public function showdashboard(){
        return view('admin.dashboard');      
    }

    public function showarticleform(){
        
        $category = DB::table('category')->select('id', 'name')->get();
        return view('admin.showarticleform',['categories'=>$category]);      
    }

    public function draft(){
        
        $draft = DB::table('article_draft')->select('id', 'title', 'body')->get();
        return view('admin.articleDraft',['drafts'=>$draft]);      
    }

    public function createarticle(Request $request){
        
        // $category = DB::table('category')->select('id', 'name')->get();
        $id = '';
        $title = '';
        $body = '';
        if($request->get('id')){
            $draft = DB::table('article_draft')
                        ->where('id', $request->get('id'))
                        ->select('id', 'title', 'body')
                        ->first();

            $id = $draft->id;
            $title = $draft->title;
            $body = $draft->body;
        }


        return view('admin.createarticle',['id'=>$id,'title'=>$title,'body'=>$body]);      
    }

    public function showcategoryaddform(Request $request){
        $id = '';
        $name = '';
        $sub_name = '';
        $description = '';
        if($request->get('id')){

            $cat = DB::table('sub_categories')
                    ->where('id',$request->get('id'))
                    ->select('id','category_name', 'sub_category_name', 'description')
                    ->first();
            $id = $cat->id;
            $name = $cat->category_name;
            $sub_name = $cat->sub_category_name;
            $description = $cat->description;
        }

        return view('admin.createcategory',['id'=>$id, 'name'=>$name, 'sub_name'=>$sub_name, 'description'=>$description ]);      
    }

    public function showinpressarticle(Request $request)
    {
        $article = DB::table('article')
                    ->join('category', 'article.category','=','category.id')
                    ->select('article.*', 'category.name')
                    ->where('status','=','INPRESS')
                    ->get();
        return view('admin.showarticlelist',['articles'=>$article]);      
    }

    public function showusers(Request $request)
    {
        $users = DB::table('users')
                    ->join('user_role','users.usertype', '=','role')
                    ->select('users.id','users.name', 'email', 'usertype', 'user_role.role_name')
                    ->get();
        return view('admin.showusers',['users'=>$users]);      
    }

    public function edituserform(Request $request)
    {
        if($request->get('id')){

            $id = $request->get('id');

            $user = DB::table('users')
                        ->join('user_role','users.usertype', '=','role')
                        ->select('users.id','users.name', 'email', 'usertype', 'user_role.role_name')
                        ->where('users.id','=',$id)
                        ->first();

            $roles = DB::table('user_role')
                    ->select('role','role_name')
                    ->get();

            return view('admin.edituser',['user'=>$user, 'roles'=>$roles]);      

        }else{
            return view('admin.dashboard');
        }
    }

    public function edituser(Request $request)
    {
        $validator = $request->validate([ 
            'name' => 'required', 
            'email' => 'required', 
            'usertype' => 'required', 
        ]);
        
        echo($request->user_id);

        $user = DB::table('users')
            ->where('id',$request->user_id)
            ->update(['name' => $request->name, 'email' => $request->email, 'usertype' => $request->usertype,]);


        return back()->withMessage('User '.$request['name'].' successfully updated.');  

    }

    public function showissuedarticle(Request $request)
    {
        $article = DB::table('article')
                    ->join('category', 'article.category','=','category.id')
                    ->select('article.*', 'category.name')
                    ->where('status','=','ISSUED')
                    ->get();
        return view('admin.showarticlelist',['articles'=>$article]);      
    }

    public function showarchivearticle(Request $request)
    {

        $article = DB::table('article')
                    ->join('category', 'article.category','=','category.id')
                    ->select('article.*', 'category.name')
                    ->where('status','=','ARCHIVE')
                    ->get();
        return view('admin.showarticlelist',['articles'=>$article]);      
    }

    public function showmenuscript(Request $request)
    {

        $menuscript = DB::table('menu_script_submission')
                    ->join('sub_categories', 'menu_script_submission.journal_id','=','sub_categories.id')
                    ->select('menu_script_submission.*', 'sub_categories.sub_category_name')
                    // ->where('status','=','ARCHIVE')
                    ->get();
        return view('admin.showmenuscript',['menuscripts'=>$menuscript]);      
    }

    public function listcategory(Request $request)
    {
        $category = DB::table('category')->select('id','name')->get();
        $journal_list = array();
        foreach ($category as $cat) {
            $sub_categories = DB::table('sub_categories')
                            ->select('id','sub_category_name')
                            ->where('category_name',$cat->name)
                            ->get();    
            array_push($journal_list, array('journal_name'=>$cat->name,'list'=>$sub_categories));
        }

        return view('admin.showcategorylist',['journal_lists'=>$journal_list]);      
    }

    public function movearticle(Request $request)
    {
        // $user = Auth::user();
        $request->id;
        $request->status;
        $article = DB::table('article')
                    ->where('id',$request->id)
                    ->update(['status' => $request->status]);

        return back()->withMessage('Article successfully moved.');   
    }

    public function deletedraft(Request $request)
    {
        // $user = Auth::user();
        $request->id;
        $request->status;
        $article = DB::table('article_draft')
                    ->where('id',$request->id)
                    ->delete();

        return back()->withMessage('Article Draft deleted.');   
    }

    public function deleteuser(Request $request)
    {
        // $user = Auth::user();
        $id = $request->id;
        $user = DB::table('users')
                    ->where('id',$request->id)
                    ->delete();

        return back()->withMessage('User Successfully deleted.');   
    }

    public function login(Request $request)
    {
    	// print($request);
        $user = Auth::user();
		if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
			return redirect()->intended('dashboard');
		}else{
			return 'invalid login';
		}	
    
    	
    }

	public function showcreateuserform(){
        $user = Auth::user();
        $roles = DB::table('user_role')
                    ->select('role','role_name')
                    ->get();

		return view('admin.createuser', ['roles' => $roles]);
	}

    public function createuser(Request $request)
    {
    	# code...
    	$user = Auth::user();
		$validator = $request->validate([ 
            'email' => 'required|email', 
            'password' => 'required|confirmed', 
        ]);
        

        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input);

        return back()->withMessage('User '.$request['name'].' successfully created.');  
    	
    }

    public function addarticle(Request $request)
    {
        
        $user = Auth::user();
        $url = '';

        $validator = $request->validate([ 
            'article_title' => 'required', 
            'authors' => 'required', 
            'status' => 'required', 
            'volume' => 'required', 
            'issue' => 'required', 
            'sub_category' => 'required',
            'articletype' => 'required',
            'articledate' => 'required',
            'file' => 'required|mimes:pdf',
            'article_image' => 'required|mimes:jpeg,jpg,png,gif'
        ]);

        // echo $request->get['articledate'];
        // if ($validator->fails()) { 
        //     return back()->withMessage($validator->errors());            
        // }


        $category_id = DB::table('sub_categories')
                ->select('id')
                ->where('sub_category_name',$request->get('sub_category'))
                ->first();

    
        if($category_id === null){
            return back()->withErrors('Invalid category selected. Please select from the autosuggest list');   
        }else{
            
            if($request->hasFile('file')){
                // $url = $request->file('file')->store('articles', 'public_uploads');
                // $url = Storage::disk('public-uploads')->put($request->file('file'), 'articles');
                $url = $request->file('file')->store('articles', 'public-uploads');
            }
            if($request->hasFile('article_image')){
                // $url = $request->file('file')->store('articles', 'public_uploads');
                // $url = Storage::disk('public-uploads')->put($request->file('file'), 'articles');
                $url_image = $request->file('article_image')->store('images', 'public-uploads');
            }

            $published_date = date('Y-m-d',strtotime($request->get('articledate')));

            $data = array('title' => $request->get('article_title'),
                        'authors' => $request->get('authors'),
                        'status' => $request->get('status'),
                        'volume' => $request->get('volume'),
                        'issue' => $request->get('issue'),
                        'article_type' => $request->get('articletype'),
                        'category' => $category_id->id,
                        'created_by' => $user['email'],
                        'published_date' => $published_date,
                        'article_image' => $url_image,
                        'file_path' => $url,
                        'created_at' => now()
            );

            DB::table('article')->insert($data);
            return back()->withMessage('Article successfully added.'); 
        }
        

        
        
    }

    public function postarticle(Request $request)
    {
        
        $user = Auth::user();
        $url = '';
        

        $validator = Validator::make($request->all(), [ 
            'title' => 'required', 
            'created_by' => 'required', 
            'body' => 'required', 
            'req_type' => 'required', 
        ]);
        


        if($request->get('req_type') == 'publish'){
            $data = array('title' => $request->get('title'),
                    'body' => $request->get('article_content'),
                    'status' => 'PUBLISHED',
                    'created_by'=>$request->get('user'),
                    'created_at' => now()
            );

            DB::table('article_content')->insert($data);
            return back()->withMessage('Article Successfully Published');   
        }
        else if($request->get('req_type') == 'save'){
            $data = array('title' => $request->get('title'),
                    'created_by'=>$request->get('user'),
                    'body' => $request->get('article_content'),
                    'created_at' => now()
            );

            DB::table('article_draft')->insert($data);
            return back()->withMessage('Article Successfully Saved');      
        } 
            
        
    }

    public function addcategory(Request $request)
    {
        $user = Auth::user();

        $url = '';

        if($request->get('cat_id')){
            $validator = $request->validate([ 
                'name' => 'required', 
                'sub_name' => 'required',
                'description' => 'required', 
                
            ]);

            if($request->hasFile('category_image')){
                $url = $request->file('category_image')->store('images', 'public-uploads');
                //update without url
                if($request->hasFile('category_image')){
                    $url = $request->file('category_image')->store('images', 'public-uploads');
                }
                try{

                    //check if category exist
                    if (!DB::table('category')->where('name','=',trim($request->get('name')))->exists()) {
                        DB::table('category')->insert($category_data);           
                    }

                    $categories = DB::table('sub_categories')
                        ->where('id',$request->get('cat_id'))
                        ->update(['category_name' => $request->get('name'), 'sub_category_name'=>$request->get('sub_name') , 'description'=>$request->get('description'), 'updated_by'=>$user['email'],'updated_at'=>now(), 'category_image'=>$url ]);    
                    return back()->withMessage('Category Successfully Updated');
                }
                catch(Exception $e){
                    DB::rollback();
                    return back()->withErrors('Something Went wrong');
                }

                
            }else{
                //update with url
                try{

                    //check if category exist
                    if (!DB::table('category')->where('name','=',trim($request->get('name')))->exists()) {
                        DB::table('category')->insert($category_data);           
                    }

                    $categories = DB::table('sub_categories')
                        ->where('id',$request->get('cat_id'))
                        ->update(['category_name' => $request->get('name'), 'sub_category_name'=>$request->get('sub_name') , 'description'=>$request->get('description'), 'updated_by'=>$user['email'],'updated_at'=>now()]);    
                    return back()->withMessage('Category Successfully Update');
                }
                catch(Exception $e){
                    DB::rollback();
                    return back()->withErrors('Something Went wrong');
                }


            }

        }else{

            $validator = $request->validate([ 
                'name' => 'required', 
                'sub_name' => 'required',
                'description' => 'required', 
                'category_image' => 'required',
                
            ]);
            
            if($request->hasFile('category_image')){
                $url = $request->file('category_image')->store('images', 'public-uploads');
            }

            $category_data = array('name' => $request->get('name'),
                                    'created_by' => $user['email'],
                                    'created_at' => now()
                            );
            //check if category exist
            if (!DB::table('category')->where('name','=',trim($request->get('name')))->exists()) {
                DB::table('category')->insert($category_data);           
            }

            $sub_category_data = array('category_name' => $request->get('name'),
                        'sub_category_name' => $request->get('sub_name'),
                        'category_image' => $url,
                        'description' => $request->get('description'),
                        'created_by' => $user['email'],
                        'created_at' => now()
            );
            try{
                DB::table('sub_categories')->insert($sub_category_data);    
            }catch(Exception $e){
                return back()->withErrors('Something went wrong. ');                   
            }

            return back()->withMessage('Category successfully created. ');   

        }
    }

}
