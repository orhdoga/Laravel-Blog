@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">	

		<div class="col-md-12">
			<h1 class="thread-index__headline">Latest blogs!</h1>
			<hr>
		</div>

	</div>	

	<?
	
	$numOfCols = 2;
	$rowCount = 0;
	
	?>

	<div class="row">

		@foreach ($threads as $thread)
			
			<div class="col-md-6">
			
				<div class="thumbnail">
		            <img src="{{ asset("/thumbnails/" . $thread->thumbnail) }}" alt="" class="thread-preview__thumbnail">
	            	<div class="caption" style="position: relative;">
	            		<img src="{{ asset("/icons/user-icon.jpg") }}" class="thread-preview__user-icon">
	                	<h4 class="thread-preview__title">
	                		@if (strlen($thread->title) > 40)
	                			{{ substr($thread->title, 0, 40) }}..
	                		@else
	                			{{ $thread->title }}	
	                		@endif	
	                	</h4>
	                	<p class="thread-preview__user">Started by <span class="user-flair">{{ $thread->user->name }}</span>, {{ $thread->created_at->diffForHumans() }}</p>
	                	<p class="thread-preview__description">{{ $thread->description }}</p>
	                	<a href="{{ url("/threads/" . $thread->id) }}">
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
	
</div>		

@endsection