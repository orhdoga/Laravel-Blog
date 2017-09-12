@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">

			<div class="col-md-3">

				<div class="well text-center" style="height: 185px;">

					<img src="{{ url("/icons/" . $thread->user->icon) }}" class="img-responsive" style="height: 100px; width: 110px; margin: 0 auto;">
					<a href="#" class="user-flair">{{ $thread->user->name }}</a>
					<p>Posts: {{ count(auth()->user()->threads()) }}

				</div>

				<div class="panel panel-warning">

					<div class="panel-body">

						<div class="body">
							This thread was published 
							{{ $thread->created_at->diffForHumans() }}, 
							and currently has {{ count($comments) }} 
							{{ str_plural('comment', count($comments)) }}.
						</div>

					</div>

				</div>

				<div class="panel panel-default">

					<div class="panel-body">

						<div class="body">
							Category: <a href="{{ url("/threads/" . $thread->tag->name) }}" class="tag">{{ $thread->tag->name }}</a>
						</div>
						
					</div>

				</div>

			</div>

			<div class="col-md-9">

				<div class="panel panel-default">

					<div class="panel-heading" style="padding: 0;">
						<img src="{{ url("/thumbnails/" . $thread->thumbnail) }}" class="img-responsive" style="width: 100%;">
					</div>

					<div class="panel-heading">
						<h2 style="margin: 0;">{{ $thread->title }}</h2>
					</div>

					<div class="panel-body">
						<div class="body">
							{{ $thread->body }}
						</div>
					</div>

				</div>

				@if (count($thread->comments))

					@foreach ($comments as $comment)
						<div class="panel panel-default">

							<div class="panel-heading">

								<img src="{{ url("/icons/" . $comment->user->icon) }}" style="height: 32px; width: 32px; border-radius: 50%;">
								<a href="#">{{ $comment->user->name }}</a> said {{ $comment->created_at->diffForHumans() }}...
								
								<form 
								action="{{ 
								url($thread->path() . "/" . $comment->id) }}" 
								class="thread-show__comment-delete" method="POST">
									{{ method_field("DELETE") }}
									{{ csrf_field() }}
									<button type="submit" class="close">&times;</button>
								</form>

							</div>

							<div class="panel-body">
								<div class="body">{{ $comment->body }}</div>
							</div>

						</div>
					@endforeach	
						
				@endif

				@if (Auth::check())
				<form method="POST" action="{{ url($thread->path()) }}">
					{{ csrf_field() }}

					<div class="form-group">
						<textarea class="form-control" placeholder="Have something to say?" 
						rows="5" name="body" required></textarea>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary"><i class="fa fa-comment" aria-hidden="true"></i> Comment</button>
					</div>
				</form>
				@else
					<p class="text-center">
						Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.
					</p>	
				@endif		

			</div>	

	</div>

</div>	

@endsection