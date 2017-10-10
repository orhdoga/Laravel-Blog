@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">

		<div class="col-md-12 well">

			@if (isset($thread))
			<form method="POST" action="{{ url('/threads/' . $thread->tag->name . '/' . $thread->id) }}" enctype="multipart/form-data">
				{{ method_field('PATCH') }}
			@else	
			<form method="POST" action="{{ url('/threads') }}" enctype="multipart/form-data">
			@endif	

				{{ csrf_field() }}

				<div class="form-group">
					<label for="title">
						<i class="fa fa-pencil" aria-hidden="true"></i> Title
					</label>
					<input id="title" type="text" class="form-control" name="title" 
					value="{{ isset($thread) ? old('title', $thread->title) : old('title') }}" required>
				</div>

				<div class="form-group">
					<label for="description">
						<i class="fa fa-info-circle" aria-hidden="true"></i> Description
					</label>
					<textarea id="description" type="text" class="form-control" name="description" required>{{ isset($thread) ? old('description', $thread->description) : old('description') }}</textarea>
				</div>	

				<div class="form-group">
					<label>
						<i class="fa fa-tag" aria-hidden="true"></i> 
						Tag
					</label>
					<select class="form-control" name="tag_id" required>
						<option value="" class="display-none">Choose A Tag</option>
						@foreach ($tags as $tag)
							<option value="{{ $tag->id }}" 
								{{ isset($thread) && old('tag_id', $thread->tag->id) == $tag->id ? 'selected' : '' }}>
								{{ $tag->name }}
							</option>
						@endforeach 
					</select>
				</div>

				<div class="form-group">
					<label>
						<i class="fa fa-picture-o" aria-hidden="true"></i> Thumbnail
					</label>
					<input type="file" name="thumbnail" required>
				</div>

				<div class="form-group">
					<textarea class="form-control thread-body" name="body" required>{{ isset($thread) ? old('body', $thread->body) : old('body') }}</textarea>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary pull-right">Submit</button>
				</div>

			</form>	

		</div>
		
	</div>

</div>

@endsection