@extends('admin.layout')

@section('content')
	@if(session()->has('message'))
	    <div class="alert alert-success">
	        {{ session()->get('message') }}
	    </div>
	@endif	

	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	<form action="{{route('addarticle')}}" method="post" role="form" autocomplete="off" enctype="multipart/form-data" id="articleform">
		@csrf
	  	<div class="form-group">
		    <label for="article_title">Title</label>
		    <input type="text" class="form-control" id="article_title" name="article_title" required="required">
	  	</div>
	  	<div class="form-group">
	  		<div class="row">
	  			<div class="col-sm-8">
	  				<label for="authors">Authors<span class="hint">(All authors name should be semicolon(;) separated.)</span></label>
		    		<input type="text" class="form-control" id="authors" name="authors" required="required">
	  			</div>
	  			<div class="col-sm-4">
	  				<label for="status">Status</label>
			    	<select  class="form-control" id="status" name="status" required="required">
				    	<option value="INPRESS">In Press</option>
				    	<option value="ISSUED">Issued</option>
				    	<option value="ARCHIVE">Archive</option>
					</select>
	  			</div>
	  		</div>
		    
	  	</div>
	  	<div class="row">
		  	<div class="col-sm-4">
		  		<div class="form-group">
				    <label for="volume">Volume</label>
				    <input type="number" class="form-control" id="volume" name="volume" required="required">
				</div>
		  	</div>
		  	<div class="col-sm-4">
		  		<div class="form-group">
		  			<label for="issue">Issue</label>
				    <input type="number" class="form-control" id="issue" name="issue" required="required">
				</div>
		  	</div>
		  	<div class="col-sm-4">
		  		<label for="category">Category</label>
		  			<input type="text" class="form-control typeahead" id="sub_category" name="sub_category"  required="required">
		  	</div>
	  	</div>
	  	<div class="row">
	  		<div class="col-sm-4">
	  			<div class="form-group">
				    <label for="file">Upload Article(PDF)</label>
				    <input type="file" class="form-control" id="file" name="file" required="required">
			  	</div>
	  		</div>
	  		<div class="col-sm-4">
	  			<div class="form-group">
				    <label for="file">Article Image</label>
				    <input type="file" class="form-control" id="article_image" name="article_image" required="required">
			  	</div>
	  		</div>
	  		<div class="col-sm-4">
	  			<div class="form-group date">
	  				<label for="articletype">Article Type</label>
				  	<select id="articletype" name="articletype" class="form-control" required="required">
					  	<option>Type 1</option>
					  	<option>Type 2</option>
					  	<option>Type 3</option>
				  	</select>
				</div>
	  		</div>
	  	</div>
	  	<div class="row">
	  		<div class="col-sm-4">
	  			<div class="form-group date">
	  				<label for="articledate">Published Date</label>
				  	<input type="text" id="articledate" name="articledate" class="form-control" required="required"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
				</div>
	  		</div>
	  	</div>
	  	<div class="form-group">
	  		<button type="submit" class="btn btn-primary mb-2">Add Article</button>
	  	</div>
	</form>
@endsection