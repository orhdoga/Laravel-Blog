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

				{{ var_dump(isset($thread->comments)) }}

				@if (isset($thread->comments))

					<div class="panel panel-default">

						@foreach ($comments as $comment)

							<div class="panel-heading">
								<i class="fa fa-comment" aria-hidden="true"></i>
								<a href="#">
									{{ $comment->user->name }}
								</a> said {{ $comment->created_at->diffForHumans() }}...
							</div>

							<div class="panel-body">
								<div class="body">{{ $comment->body }}</div>
							</div>

						@endforeach	
				
					</div>

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