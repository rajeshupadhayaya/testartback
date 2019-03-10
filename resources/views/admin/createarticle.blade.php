@extends('admin.layout')

@section('content')
	
@if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
	{{$id}}
	<form method="post" action="{{ route('createarticle') }}" id="article_form" autocomplete="off">
		@csrf
		<!-- <input type="hidden" name="article_id" id="article_id"> -->
		<input type="hidden" name="autosave_id" id="autosave_id" value={{ $id }}>
		<input type="hidden" name="user" id="user" value="{{ Auth::user()->email }}">
		
		<div class="form-group">
			<label for="name">Title</label>
		    <input type="text" class="form-control" id="title" name="title" value="{{ $title }}">
		</div>
		<div class="form-group">
			<lable for="createarticle">Article</lable>
    		
    		<textarea name="article_content" class="form-control" id="article_content">{{ $body }}</textarea>
    	</div>

    	<div class="form-group">
    		<div class="row">
	  			<div class="col-sm-4">
	  				<button type="submit" class="btn btn-primary mb-2" value="save" name="req_type">Save</button>
	  				<button type="submit" class="btn btn-primary mb-2" value="publish" name="req_type">Publish</button>
	  			</div>
	  		
	  			<div class="col-sm-6">
	  			</div>
	  			<div class="col-sm-2">
	  				<span id="autosave_msg" class="message"></span>
	  			</div>
	  		</div>
	  		
	  	</div>
	</form>
	
@endsection