@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">

		<div class="col-md-3">

			<div class="well text-center user-information">

				<img src="{{ url("/icons/" . $user->icon) }}" class="img-responsive user-information__icon">
				
				<span class="user-flair">
					{{ str_replace('-', ' ', $user->name) }}
				</span>

				<p>Posts: 
					{{ count($user->threads) }}
				</p>

			</div>

			<!--<div class="panel panel-warning">

					<div class="panel-body">

						Click <a href="#">here</a> to <i class="fa fa-pencil fa-padding" aria-hidden="true" title="Edit"></i> your profile.

					</div>

				</div>

			</div>-->

		</div>

		<div class="col-md-9">

			@if (count($user->threads || $user->comments))
		
				@foreach ($user->threads as $thread)

					<div class="panel panel-default">

						<div class="panel-body">

							<span class="user-flair">
								{{ str_replace('-', ' ', $user->name) }}
							</span> 
							has posted a topic in 
							<a href="{{ url("/threads/" . $thread->tag->name) }}">
								{{ $thread->tag->name }}
							</a>

							<div class="body">
								<h4 class="margin-top-bottom">
									<a href="{{ url("/threads/" . $thread->tag->name . "/" . $thread->id) }}">
										{{ $thread->title }}
									</a>
								</h4>
							</div>
						</div>

					</div>
				@endforeach

				@foreach ($user->comments as $comment)
					<div class="panel panel-default">

						<div class="panel-body">
							<span class="user-flair">
								{{ str_replace('-', ' ', $user->name) }}
							</span> has replied to a topic in 
							
							<a href="{{ url("/threads/" . $comment->thread->tag->name) }}">
								{{ 	$comment->thread->tag->name }}
							</a> -

							<a href="{{ url("/threads/" . $comment->thread->tag->name . "/" . $comment->thread->id) }}">
								{{ $comment->thread->title }}
							</a>

							<div class="body">
								{{ $comment->body }}
							</div>
						</div>

					</div>
				@endforeach	
			@else
				This user currently has no activity going on..
			@endif

		</div>
			
	</div>				

</div>			

@endsection