@extends('admin.layout')

@section('content')

@if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
@endif
<section class="category-list">
@foreach($journal_lists as $key=>$journal_list)
	<h4>{{ucfirst($journal_list['journal_name'])}}</h4>
	<ul>
	@foreach($journal_list['list'] as $sub_cat)
		<li><a href="{{ route('addcategory') }}?id={{ $sub_cat->id }}">{{ucfirst($sub_cat->sub_category_name)}}</a></li>
	@endforeach
	</ul>

@endforeach
</section>
@endsection