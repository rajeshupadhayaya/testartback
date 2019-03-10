@extends('admin.layout')

@section('content')
	@if(session()->has('message'))
	    <div class="alert alert-success">
	        {{ session()->get('message') }}
	    </div>
	@endif	
	<?php $i = 1; ?>
  	@foreach ($drafts as $draft)
	
  	<div class="draft">
  		<a href="{{ route('createarticle') }}?id={{$draft->id}}">
	    	<p class="draft-title">{{$draft->title}}</p>
	    	<p class="draft-body">{{$draft->body}}</p>
    	</a>
    	<!-- <button class="but btn-danger">Delete</button> -->

    	<button class="btn btn-danger" type="submit" onclick="event.preventDefault();
                                     document.getElementById('draft-form-{{$i}}').submit();">Delete</button>
        <form id="draft-form-{{$i}}" action="" method="POST" style="display: none;">
          {{ csrf_field() }}
            <input type="hidden" value="{{ $draft->id }}" name="id" id="id">
            
        </form>
	</div>  		
  	<?php $i += 1; ?>
	@endforeach

@endsection