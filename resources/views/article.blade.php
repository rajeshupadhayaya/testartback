@extends('layouts.app')

@section('content')
<?php print_r($content); ?>
<div class="container">
	<section>
		{{$html_present}}
		{{$article}}
		{{$content}}
	</section>
</div>
@endsection