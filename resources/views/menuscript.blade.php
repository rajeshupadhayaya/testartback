@extends('layouts.app')

@section('content')
<div class="container">
	
	<section>
		@if ($errors->any())
	      	<div class="alert alert-danger">
	          <ul>
	              @foreach ($errors->all() as $error)
	                  <li>{{ $error }}</li>
	              @endforeach
	          </ul>
	      	</div><br />
  		@endif
  		
  		@if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

	    <form method="post" action="{{ route('submitmenuscript')}}" enctype="multipart/form-data">
	        @csrf
	        <div class="row">
	          <div class="col-md-3"></div>
	          <div class="form-group col-md-6">
	            <label for="journal_name">Select Journal</label>
	            <select class="form-control" name="journal_name">
	            	@foreach ($categories as $category)
	            		<option value="{{$category->id}}">{{$category->sub_category_name}}</option>
	            	@endforeach
	            </select>
	          </div>
	        </div>
	        <div class="row">
	          <div class="col-md-3"></div>
	          <div class="form-group col-md-6">
	            <label for="menuscript_title">Menuscript Title</label>
	            <input type="text" class="form-control" name="menuscript_title">
	          </div>
	        </div>
	        <div class="row">
	          <div class="col-md-3"></div>
	            <div class="form-group col-md-6">
	              <label for="Email">Email Address</label>
	              <input type="text" class="form-control" name="email">
	            </div>
	        </div>
	        <div class="row">
	          <div class="col-md-3"></div>
	            <div class="form-group col-md-6">
	              <label for="contact">Contact</label>
	              <input type="text" class="form-control" name="contact">
	            </div>
	        </div>
	        <div class="row">
	          <div class="col-md-3"></div>
	            <div class="form-group col-md-6">
	              <label for="menuscript_file">Upload File</label>
	              <input type="file" class="form-control" name="menuscript_file">
	            </div>
	        </div>
	        <div class="row">
	          <div class="col-md-3"></div>
	          <div class="form-group col-md-6">
	             <div class="captcha">
	               <span>{!! captcha_img() !!}</span>
	               <button type="button" class="btn btn-success"><i class="fas fa-refresh" id="refresh"></i></button>
	               </div>
	            </div>
	        </div>
	        <div class="row">
	          <div class="col-md-3"></div>
	            <div class="form-group col-md-6">
	             <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha"></div>
	          </div>
	        <div class="row">
	          <div class="col-md-3"></div>
	          <div class="form-group col-md-6">
	            <button type="submit" class="btn btn-success">Submit</button>
	          </div>
	        </div>
	    </form>
	</section>
</div>

<script type="text/javascript">

$('#refresh').click(function(){
  $.ajax({
     type:'GET',
     url:'api/refreshcaptcha',
     success:function(data){
        $(".captcha span").html(data.captcha);
     }
  });
});
</script>

@endsection