@extends('layouts.app')

@section('content')
<?php //print_r($volumes); die; ?>
<div class="container bhoechie-tab-container">
	
	<div class="row">
		<!-- <div class="col-sm-12 bhoechie-tab-container"> -->
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  About Journal
                </a>
                <a href="#" class="list-group-item text-center">
                  In Press
                </a>
                <a href="#" class="list-group-item text-center">
                  Current Issue
                </a>
                <a href="#" class="list-group-item text-center">
                  Archive
                </a>
              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                
                <div class="bhoechie-tab-content active">
                    <h3>{{ ucwords($journal_info->sub_category_name) }}</h3>
                    <hr>
                    <div class="journal-desc">
                    	<div class="row">
                    		<div class="col-sm-9">{{ $journal_info->description }}</div>
                    		<div class="col-sm-3"><img src="{{ $journal_info->category_image }}"></div> 
                    	
                    	</div>
                    </div>
                </div>
                
                <div class="bhoechie-tab-content">
                    <h3> In Press</h3>
                    <hr>
                    <div class="article-lists"> 
	                    @foreach($in_press as $in_p)
							
							<div>
								<h5>{{ $in_p->title }}</h5>
								<div class="authors"> {{ $in_p->authors }}</div>
								<div>{{ ucwords($journal_info->sub_category_name) }}</div>
								{{ $in_p->volume }}
								{{ $in_p->issue }}
								<p><i class='fas fa-calendar-alt'></i> &nbsp; {{ $in_p->published_date }}</p>
								
							</div>
							
						@endforeach
					</div>
                </div>
    
                
                <div class="bhoechie-tab-content">
                    <h3> Current Issues</h3>
                    <span>Volume: {{$current_issue->volume}}</span> &nbsp;<span>Issue: {{$current_issue->issue}}</span>
                    <hr>
                    <div class="article-lists"> 
	                    @foreach($current as $current_iss)

								<div>
									<h5>{{ $current_iss->title }}</h5>
									<div class="authors"> {{ $current_iss->authors }}</div>
									<div>{{ ucwords($journal_info->sub_category_name) }}</div>
									{{ $current_iss->volume }}
									{{ $current_iss->issue }}
									<p><i class='fas fa-calendar-alt'></i> &nbsp; {{ $current_iss->published_date }}</p>
									
									
								</div>
						@endforeach
					</div>

                </div>

                <div class="bhoechie-tab-content">
                    <h3> Archive</h3>
                    <hr>
                    <div class="archive-lists">

	                    @foreach($archives as $archive)
						<div class="volume-line" onclick='showdiv("volume-content-{{$archive['volume']}}")'>Volume &nbsp; {{$archive['volume']}}</div>
						
							<div class="hide" id="volume-content-{{$archive['volume']}}">
								<ul  class="nav nav-tabs">
								@foreach($archive['issues'] as $issue)
									<li class=""><a href="#issue-{{ $issue['issue'] }}" data-toggle="tab">Issue &nbsp;{{ $issue['issue'] }}</a></li>
								@endforeach
								</ul>
								<div class="tab-content">
									@foreach($archive['issues'] as $issue)
										@foreach($issue['articles'] as $article)
												<div class="tab-pane fade" id="issue-{{ $issue['issue'] }}">
													<div class="article-title"><a href="{{asset($article->file_path)}}"> {{ ucwords($article->title) }}</a></div>
													<div class="article-authors"> {{ ucwords($article->authors) }}</div>
													{{ $article->published_date }}
												</div>
										@endforeach
									@endforeach
								</div>
							</div>
						
						@endforeach

						</div>
					</div>

                </div>
                
            </div>
	</div>
	
</div>

@endsection
