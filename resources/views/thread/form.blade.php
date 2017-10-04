@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">

		<div class="col-md-12 well">

			<form method="POST" action="{{ url('/threads') }}" enctype="multipart/form-data">

				{{ csrf_field() }}

				<div class="form-group">
					<label for="title">
						<i class="fa fa-pencil" aria-hidden="true"></i> Title
					</label>
					<input id="title" type="text" class="form-control" name="title" required>
				</div>

				<div class="form-group">
					<label for="description">
						<i class="fa fa-info-circle" aria-hidden="true"></i> Description
					</label>
					<textarea id="description" type="text" class="form-control" name="description" required></textarea>
				</div>	

				<div class="form-group">
					<label>
						<i class="fa fa-tag" aria-hidden="true"></i> 
						Tag
					</label>
					<select class="form-control" name="tag_id" required>
						<option value="" class="display-none">Choose A Tag</option>
						@foreach ($tags as $tag)
							<option value="{{ $tag->id }}">{{ $tag->name }}</option>
						@endforeach 
					</select>
				</div>

				<div class="form-group">
					<label>
						<i class="fa fa-picture-o" aria-hidden="true"></i> Thumbnail
					</label>
					<input type="file" name="thumbnail">
				</div>

				<div class="form-group">
					<textarea class="form-control thread-body" name="body" required></textarea>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary pull-right">Submit</button>
				</div>

			</form>	

		</div>
		
	</div>

</div>

@endsection