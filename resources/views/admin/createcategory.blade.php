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

	<form action="{{route('addcategory')}}" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
		@csrf
	  	<div class="form-group">
	  		<input type="hidden" value="{{ $id }}" name="cat_id" id="cat_id" >
	  		<div class="row">
	  			<div class="col-sm">
				    <label for="name">Category Name * &nbsp;<span class="input-info">This name should be unique</span></label>
				    <input type="text" class="form-control" id="category_name" name="name" required="required" value="{{ $name }}">
				</div>
				<div class="col-sm">
					<label for="sub_name">Sub Category Name * &nbsp;<span class="input-info">This name should belong to category name field </span></label>
		    		<input type="text" class="form-control" id="sub_name" name="sub_name" value="{{ $sub_name }}" required="required">
				</div>
			</div>
	  	</div>
	  	<div class="form-group">
		    <label for="description" >Category Description *</label>
		    <textarea name="description" class="form-control" id="description" rows="10" required="required">{{ $description }}</textarea>
	  	</div>
	  	<div class="form-group">
		    <label for="category_image">Category Image</label>
		    <input type="file" name="category_image" class="form-control" id="category_image" >
	  	</div>
		    
	  	<div class="form-group">
	  		<button type="submit" class="btn btn-primary mb-2">Add</button>
	  	</div>
	</form>
	
@endsection