<?php

namespace App\Http\Controllers\api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use DB;

class ArticleController extends Controller
{
	public $successStatus = 200;

	public function getArticleTitle(Request $request){ 

		$name = $request->get('query');

		$article_title = DB::table('article')
					->where('title', 'like', $name.'%')
					->get(['id', 'title']);

		return response()->json($article_title);		

	}

	public function autoSave(Request $request){ 
		$id = '';
		$autosave_id = $request->get('autosave_id');
		//check if any draft available 
		

		if ($autosave_id != '' && DB::table('article_draft')->where('id','=', $autosave_id)->exists()){
			//update table
			$data = array('body'=> $request->get('article_content'), 
						'title'=>$request->get('title'), 
						'updated_by' => $request->get('user'),
						'updated_at' => now()
        	);

			DB::table('article_draft')
			->where('id',$autosave_id)
			->update($data);

			$id = $autosave_id;

		}else{
			//insert new row
			$data = array('title' => $request->get('title'),
					'created_by'=>$request->get('user'),
                    'body' => $request->get('article_content'),
                    'created_at' => now()
        	);
        	
			$id = DB::table('article_draft')->insertGetId($data);
		}

		return response()->json(['id'=> $id], $this-> successStatus);
		// return response()->json(['id'=> $request->get('title')], $this-> successStatus);

	}

	public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

}

?>