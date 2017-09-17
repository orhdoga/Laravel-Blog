@extends('layouts.app')

@section('content')

<div class="container">

	<div class="row">

		<div class="col-md-12 well">

			<form>

				<div class="form-group">
					<label>
						<i class="fa fa-pencil" aria-hidden="true"></i> Title
					</label>
					<input type="text" class="form-control" required>
				</div>

				<div class="form-group">
					<label>
						<i class="fa fa-info-circle" aria-hidden="true"></i> Description
					</label>
					<textarea type="text" class="form-control" required></textarea>
				</div>	

				<div class="form-group">
					<label>
						<i class="fa fa-tag" aria-hidden="true"></i> 
						Tag
					</label>
					<select class="form-control" required>
						<option value="" class="display-none">Choose A Tag</option>
					</select>
				</div>

				<div class="form-group">
					<label>
						<i class="fa fa-picture-o" aria-hidden="true"></i> Thumbnail
					</label>
					<input type="file">
				</div>

				<div class="form-group">
					<textarea class="form-control thread-body" required></textarea>
				</div>

				<div class="form-group">
					<button class="btn btn-primary pull-right">Submit</button>
				</div>

			</form>	

		</div>
		
	</div>

</div>

@endsection