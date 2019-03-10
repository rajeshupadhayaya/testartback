@extends('admin.layout')

@section('content')

@if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
@endif
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Authors</th>
      <th scope="col">Volume</th>
      <th scope="col">Issue</th>
      <th scope="col">Category</th>
      <th scope="col">Move To</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php $i = 1; ?>
  	@foreach ($articles as $article)
  		
    	<tr>
	      	<th scope="row"><?php echo $i ?></th>
		    <td><a href='{{ asset("$article->file_path") }}' target="_blank">{{ $article->title }}</a></td>
		    <td>{{ $article->authors }}</td>
		    <td>{{ $article->volume }}</td>
		    <td>{{ $article->issue }}</td>
		    <td>{{ $article->name }}</td>
        
          
        <td>
          <select  class="form-control" id="status-sel-{{$i}}" name="status-sel" required="required" onchange="document.getElementById('status-{{$i}}').value = document.getElementById('status-sel-{{$i}}').value">
              <option value="INPRESS" @if ($article->status == 'INPRESS') selected='selected' @endif >In Press</option>
              <option value="ISSUED"  @if ($article->status == 'ISSUED') selected='selected' @endif >Issued</option>
              <option value="ARCHIVE" @if ($article->status == 'ARCHIVE') selected='selected' @endif >Archive</option>
          </select>
        </td>
		    <td><button class="btn btn-primary" type="submit" onclick="event.preventDefault();
                                     document.getElementById('movearticle-form-{{$i}}').submit();">Move</button>
            <form id="movearticle-form-{{$i}}" action="" method="POST" style="display: none;">
              {{ csrf_field() }}
                <input type="hidden" value="{{ $article->id }}" name="id" id="id">
                <input type="hidden" value="{{ $article->status }}" name="status" id="status-{{$i}}">
            </form>  
        </td>
             
            
	    </tr>
	    <?php $i += 1; ?>
	@endforeach
  </tbody>
</table>
@endsection