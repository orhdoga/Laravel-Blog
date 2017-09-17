@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">

		<div class="col-md-3">

			<div class="well text-center" style="height: 185px;">

				<img src="{{ url("/icons/" . $user->icon) }}" class="img-responsive" style="height: 100px; width: 110px; margin: 0 auto;">
				
				<span class="user-flair">{{ str_replace('-', ' ', $user->name) }}</span>

				<p>Posts: 
					{{ count($user->threads) }}
				</p>

			</div>

			<!--<div class="panel panel-warning">

					<div class="panel-body">

						Click <a href="#">here</a> to <i class="fa fa-pencil" aria-hidden="true" style="padding-left: 3px; padding-right: 3px;" title="Edit"></i> your profile.

					</div>

				</div>

			</div>-->

		</div>

		<div class="col-md-9">

			@if (count($user->threads || $user->comments))
		
				@foreach ($user->threads as $thread)
					<div class="panel panel-default">

						<div class="panel-body">

							<span class="user-flair">{{ str_replace('-', ' ', $user->name) }}</span> has posted a topic in <a href="{{ url("/threads/" . $thread->tag->name) }}">{{ $thread->tag->name }}</a>

							<div class="body">
								<h4 style="margin: 3px 0;">
									<a href="{{ url("/threads/" . $thread->tag->name . "/" . $thread->id) }}">{{ $thread->title }}</a>
								</h4>
							</div>
						</div>

					</div>
				@endforeach

				@foreach ($user->comments as $comment)
					<div class="panel panel-default">

						<div class="panel-body">
							<span class="user-flair">{{ str_replace('-', ' ', $user->name) }}</span> has replied to a topic in 
							
							<a href="{{ url("/threads/" . $comment->thread->tag->name) }}">{{ $comment->thread->tag->name }}</a> -

							<a href="{{ url("/threads/" . $comment->thread->tag->name . "/" . $comment->thread->id) }}">{{ $comment->thread->title }}</a>

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