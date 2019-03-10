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
      <th scope="col">Name</th>
      <th scope="col">Email Id</th>
      
      <th scope="col">Role</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
  	<?php $i = 1; ?>
  	@foreach ($users as $user)
  		
    	<tr>
	      	<th scope="row"><?php echo $i ?></th>
        <td class="editable"><a href="{{ route('edituser') }}?id={{ $user->id }}" title="edit">{{ $user->name }}</a></td>
        <td>{{ $user->email }}</a></td>
        
        <td>{{ $user->role_name }}</a></td>
		    
		    <td>
          <button class="btn btn-primary" type="submit">Reset Password</button>
          <button class="btn btn-danger" type="submit" onclick="event.preventDefault();
                                     if(confirm('Are you Sure you want to delete this user?')){document.getElementById('delete-form-{{$i}}').submit();}">Delete</button>
            <form id="delete-form-{{$i}}" action="{{ route('deleteuser') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
                <input type="hidden" value="{{ $user->id }}" name="id" id="id">
                <!-- <input type="hidden" value="delete" name="delete" id="action-{{$i}}"> -->
            </form> 
        </td>
             
            
	    </tr>
	    <?php $i += 1; ?>
	@endforeach
  </tbody>
</table>
@endsection