@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">

		<div class="col-md-4">

			<h1>Latest blogs!</h1>
			<hr>

		</div>

	</div>

	<?
	
	$numOfCols = 3;
	$rowCount = 0;
	
	?>

	<div class="row">
	
		@foreach ($threads as $thread)
			
			<div class="col-md-4">
			
				<div class="thumbnail">
		            <img src="http://placehold.it/500x300" alt="">
	            	<div class="caption">
	                	<h4>{{ $thread->title }}</h4>
	                	<p>{{ $thread->description }}</p>
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