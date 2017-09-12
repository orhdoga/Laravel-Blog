@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">

			<div class="col-md-8">

				<div class="panel panel-default">

					<div class="panel-heading" style="padding: 0;">
						<img src="{{ url("/thumbnails/" . $thread->thumbnail) }}" style="width: 100%;">
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
								<i class="fa fa-commenting" aria-hidden="true"></i>
								<a href="#">
									{{ $comment->user->name }}
								</a> said {{ $comment->created_at->diffForHumans() }}...
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

			<div class="col-md-4">

				<div class="panel panel-default">

					<div class="panel-body">
						<div class="body">
							<p style="margin: 0;">Posted by <a href="#">{{ $thread->user->name }}</a>, {{ $thread->created_at->diffForHumans() }}</p>
						</div>
					</div>

				</div>

			</div>	

	</div>

</div>	

@endsection