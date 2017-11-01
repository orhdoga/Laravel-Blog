@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">	

		<div class="col-md-12">

			<h1><i class="fa fa-rss" aria-hidden="true"></i> Latest blogs!</h1>

		</div>

	</div>

	<div class="row">

		<div class="col-md-6">

			<div class="btn-group">
				
				<a href="{{ url("/threads") }}" class="btn btn-primary {{ (Request::is('threads') ? 'active' : '') }}">
					All
				</a>
				
				@foreach ($tags as $tag)
					<a href="{{ url('/threads/' . $tag->name) }}" class="btn btn-primary {{ (Request::is('threads/' . $tag->name) ? 'active' : '') }}">
						{{ $tag->name }}
					</a>
				@endforeach

			</div>

			@if (isset($s))
				<br>
				<br>

                Found 
                <span class="query-results">
                	{{ count($threads) }} {{ str_plural('result', count($threads)) }}
                </span>             
			@endif

		</div>

		<div class="col-md-6">

			<form id="form1" action="{{ url("/threads") }}" method="GET">
				
				<div class="input-group search pull-right">

					<input type="text" class="form-control" placeholder="Search by thread.." name="s" value="{{ isset($s) ? $s : "" }}">

					<a class="input-group-addon search-button" onclick="document.getElementById('form1').submit();">
						<i class="fa fa-search" aria-hidden="true"></i>
					</a>

				</div>

			</form>

		</div>

	</div>	

	<hr>  	

	@php
	
	$numOfCols = 2;
	$rowCount = 0;
	
	@endphp

	<div class="row">

		@forelse ($threads as $thread)
			
			<div class="col-md-6">
			
				<div class="thumbnail">
		            
		            <img src="{{ asset("/thumbnails/$thread->thumbnail") }}" class="preview-thumbnail img-responsive">
	            	
	            	<div class="caption caption--absolute">
	            		
	            		<img src="{{ asset("/icons/" . $thread->user->icon) }}" class="preview-user-icon img-responsive">
	                	
	                	<h4 class="preview-title">
	                		@if (strlen($thread->title) > 37)
	                			{{ ucfirst(substr($thread->title, 0, 37)) }}
	                		@else
	                			{{ ucfirst($thread->title) }}
	                		@endif	
	                	</h4>

	                	<p class="user-caption">
	                		Started by 
	                		<a href="{{ url("/users/" . str_replace(' ', '-', strtolower($thread->user->name))) }}">
	                			<span class="user-flair">
	                				{{ str_replace('-', ' ', $thread->user->name) }},
	                			</span>
	                		</a> {{ $thread->created_at->diffForHumans() }}
	                	</p>

	                	<p class="preview-description">
	                		@if (strlen($thread->description) > 200)
	                			{{ ucfirst(substr($thread->description, 0, 200)) }}
	                		@else
	                			{{ ucfirst($thread->description) }}
	                		@endif	
	                	</p>

	                	<a href="{{ url($thread->path()) }}">
	                		<button class="btn btn-primary">
	                			Read more..
	              	        </button>  			
	                	</a>
	               	</div>

	            </div>

			</div>

	@php
    	$rowCount++;
	@endphp

    @if ($rowCount % $numOfCols == 0)
    	</div><div class="row">
	@endif

	@empty
		<p>There are no relevant results at this time.</p>
	@endforelse

	<div class="row">

		<div class="col-md-12 text-right">
			{{ $threads->links() }}
		</div>	

	</div>
	
</div>		

@endsection