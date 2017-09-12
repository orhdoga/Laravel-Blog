@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">	

		<div class="col-md-12">

			<h1 class="thread-index__headline"><i class="fa fa-rss" aria-hidden="true"></i> Latest blogs!</h1>

		</div>

	</div>

	<div class="row">

		<div class="col-md-6">

			<div class="btn-group thread-index__filter">
				<a href="{{ url("/threads") }}" class="btn btn-primary {{ (Request::is('threads') ? 'active' : '') }}">All</a>
				@foreach ($tags as $tag)
					<a href="{{ url("/threads/" . $tag->name) }}" class="btn btn-primary {{ (Request::is('threads/' . $tag->name) ? 'active' : '') }}">{{ $tag->name }}</a>
				@endforeach
			</div>
	
		</div>

		<div class="col-md-6">

			<form id="form1" action="{{ url("/threads") }}" method="GET">
			<div class="input-group thread-index__search pull-right">
				
				<input type="text" class="form-control" placeholder="Search by thread.." name="s" value="{{ isset($s) ? $s : "" }}">
				<a class="input-group-addon thread-index__search-button" onclick="document.getElementById('form1').submit();"><i class="fa fa-search" aria-hidden="true"></i></a>

			</div>
			</form>

		</div>

	</div>	

	<hr>	

	<?
	
	$numOfCols = 2;
	$rowCount = 0;
	
	?>

	<div class="row">

		@foreach ($threads as $thread)
			
			<div class="col-md-6">
			
				<div class="thumbnail">
		            <img src="{{ asset("/thumbnails/$thread->thumbnail") }}" alt="" class="thread-preview__thumbnail img-responsive">
	            	<div class="caption" style="position: relative;">
	            		<img src="{{ asset("/icons/" . $thread->user->icon) }}" class="thread-preview__user-icon img-responsive">
	                	<h4 class="thread-preview__title">
	                		@if (strlen($thread->title) > 40)
	                			{{ ucfirst(substr($thread->title, 0, 40)) }}..
	                		@else
	                			{{ ucfirst($thread->title) }}
	                		@endif	
	                	</h4>
	                	<p class="thread-preview__user">Started by <span class="user-flair">{{ $thread->user->name }}</span>, {{ $thread->created_at->diffForHumans() }}</p>
	                	<p class="thread-preview__description">{{ $thread->description }}</p>
	                	<a href="{{ url($thread->path()) }}">
	                		<button class="btn btn-primary">
	                			Read more..
	              	        </button>  			
	                	</a>
	               	</div>
	            </div>

			</div>

	<?

    $rowCount++;
    
    if ($rowCount % $numOfCols == 0) {
    	echo '</div><div class="row">';
	}

	?>

	@endforeach

	<div class="row">

		<div class="col-md-12 text-right">
			{{ $threads->links() }}
		</div>	

	</div>
	
</div>		

@endsection