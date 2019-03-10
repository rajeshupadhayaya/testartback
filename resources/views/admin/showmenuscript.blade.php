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
      <th scope="col">Journal</th>
      <th scope="col">Email Id</th>
      <th scope="col">Contact No</th>
      
    </tr>
  </thead>
  <tbody>
  	<?php $i = 1; ?>
  	@foreach ($menuscripts as $menuscript)
  		
    	<tr>
	      	<th scope="row"><?php echo $i ?></th>
		    
		    <td><a href='{{ asset("$menuscript->file_path") }}' target="_blank">{{ $menuscript->title }}</a></td>
		    <td>{{ $menuscript->sub_category_name }}</td>
		    <td>{{ $menuscript->email }}</td>
		    <td>{{ $menuscript->contact }}</td>
		    
	    </tr>
	    <?php $i += 1; ?>
	@endforeach
  </tbody>
</table>
@endsection