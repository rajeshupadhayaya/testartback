@extends('layouts.app')

@section('content')
<div class="container">
	<div class="header-section">
	</div>
	<section class="journal-header">
		<h2>Journal By Subject</h2>
		<ul class="journal-list">
		<li><a href="#all-journal">All Journals</a></li>
		@foreach ($journals as $journal)
			<li><a href="#{{ str_replace(' ', '-', $journal->name) }}">{{ucfirst($journal->name)}}</a>
		@endforeach
		</ul>	
	</section>
	<div class="all-journal">
		<div id='all-journal' class="journal-block">
			<h2>All Journals</h2>
			<hr>
			<ul>
			@foreach ($all_journals as $all_journal)
				<li><a href="{{ str_replace(' ','-', $all_journal->sub_category_name) }}">{{ucfirst($all_journal->sub_category_name)}}</a></li>
			@endforeach
			</ul>
		</div>
	
		@foreach($journal_lists as $key=>$journal_list)
			<div id="{{ str_replace(' ', '-', $journal_list['journal_name']) }}" class="journal-list">
				<h2>{{ucfirst($journal_list['journal_name'])}}</h2>
				<hr>
				<ul>
				@foreach($journal_list['list'] as $sub_cat)
					<li><a href="{{ str_replace(' ','-', $sub_cat->sub_category_name) }}">{{ucfirst($sub_cat->sub_category_name)}}</a></li>
				@endforeach
				</ul>
			</div>
		@endforeach
	</div>

</div>
@endsection