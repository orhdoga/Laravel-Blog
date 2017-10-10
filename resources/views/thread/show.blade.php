@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">

			<div class="col-md-3">

				<div class="well text-center user-information">

					<img src="{{ url("/icons/" . $thread->user->icon) }}" class="img-responsive user-information__icon">
					
					<a href="{{ url("/users/" . str_replace(' ', '-', strtolower($thread->user->name))) }}" class="user-flair">{{ str_replace('-', ' ', $thread->user->name) }}</a>
					
					<p>Posts: 
						{{ count($thread->user->threads) }}
					</p>

				</div>

				<div class="panel panel-warning">

					<div class="panel-body">

						<div class="body">
							This thread was published 
							{{ $thread->created_at->diffForHumans() }}, 
							and currently has {{ count($comments) }} 
							{{ str_plural('comment', count($comments)) }}.
						</div>

						<div class="margin-ten-top">
							
							Click <a href="#">here</a> to 
							<i class="fa fa-pencil fa-padding" aria-hidden="true" title="Edit"></i> this thread.

							<span class="display-block">
								Click <a href="#" data-toggle="modal" data-target="#myModal">here</a> to 
								<i class="fa fa-trash fa-padding" aria-hidden="true" title="Delete"></i> this thread.
							</span>

							@include('partials.delete-modal')

						</div>	

					</div>

				</div>

				<div class="panel panel-default">

					<div class="panel-body">

						<div class="body">
							Category: 
							<a href="{{ url("/threads/" . $thread->tag->name) }}" class="thread-tag">
								{{ $thread->tag->name }}
							</a>
						</div>
						
					</div>

				</div>

			</div>

			<div class="col-md-9">

				<div class="panel panel-default">

					<div class="panel-heading padding-zero">
						<img src="{{ url("/thumbnails/" . $thread->thumbnail) }}" class="img-responsive" class="width-hunderd">
					</div>

					<div class="panel-heading">
						<h2 class="margin-zero">{{ $thread->title }}</h2>
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

								<img src="{{ url("/icons/" . $comment->user->icon) }}" class="user-icon">
								<a href="{{ url("/users/" . str_replace(' ', '-', strtolower($comment->user->name))) }}">{{ str_replace('-', ' ', $comment->user->name) }}</a> said {{ $comment->created_at->diffForHumans() }}... {{ $comment->isEdited() ? "(Edited)" : "" }}
								
								<form 
								action="{{ 
								url($thread->path() . "/" . $comment->id) }}" 
								class="comment" method="POST" id="form1">
									{{ method_field("DELETE") }}
									{{ csrf_field() }}
									<i class="fa fa-times pull-right comment-delete" aria-hidden="true" onclick="document.getElementById('form1').submit();"></i>
								</form>
									
								<a href="{{ url($thread->path() . "/" . $comment->id . "/edit") }}" class="comment-edit">
									<i class="fa fa-pencil pull-right" aria-hidden="true"></i>
								</a>	

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
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-comment" aria-hidden="true"></i> 
								Comment
							</button>
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