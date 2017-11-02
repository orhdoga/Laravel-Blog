@extends('layouts.app')

@section('content')

<div class="container">

	<form method="POST" action="{{ route('users.destroy') }}">

		{{ method_field('DELETE') }}
		{{ csrf_field() }}

		<div class="row">

			<div class="col-md-12">

				<h1>User overview <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button></h1>

				<hr>

			</div>	

		</div>

		<div class="row">

			<div class="col-md-12">

				<table class="table table-hover">

					<thead>
						<tr>
							<th><input id="select-all" type="checkbox"></th>
							<th><i class="fa fa-key" aria-hidden="true"></i> Id</th>
							<th><i class="fa fa-user" aria-hidden="true"></i> Name</th>
							<th><i class="fa fa-envelope-open" aria-hidden="true"></i> Email</th>
						</tr>	
					</thead>

					<tbody>
						@foreach ($users as $user)
							<tr>
								<td><input type="checkbox" name="users[]" value="{{ $user->id }}"></td>
								<td>{{ $user->id }}</td>
								<td>
									<a href="{{ url('/users/' . strtolower($user->name)) }}">
										{{ str_replace("-", ' ', $user->name) }}
									</a>	
								</td>
								<td>
									<a href="mailto: {{ $user->email }}"> 
										{{ $user->email }}
									</a>	
								</td>
							</tr>
						@endforeach	
					</tbody>
						
				</table>	

			</div>
			
		</div>

	</form>

	<div class="row">

		<div class="col-md-12 text-right">
			{{ $users->links() }}
		</div>	

	</div>			

</div>	

@endsection