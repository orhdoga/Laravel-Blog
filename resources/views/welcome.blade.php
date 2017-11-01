@extends('layouts.welcome')

@section('content')

@include('partials.welcome.banner')

<div class="container">

	<div class="row">

		<div class="col-md-12 text-center">

			<div class="page-header">

				<h1>Testimonials</h1>

			</div>

		</div>

	</div>		

	<div class="row">

		<div class="col-md-4">

			<div class="testimonial">

				<div class="testimonial-user-icon">
					<img src="{{ url('icons/user-icon.jpg') }}" style="height: inherit; width: inherit; border-radius: inherit;">
				</div>
				
				<div class="testimonial-caption">
					<i>Lorem ipsum dolor sit amet</i>
				</div>

				<div class="testimonial-quoted-by">
					Quoted by <b >John Doe</b>
				</div>

			</div>

		</div>

		<div class="col-md-4">

			<div class="testimonial">

				<div class="testimonial-user-icon">
					<img src="{{ url('icons/user-icon.jpg') }}" style="height: inherit; width: inherit; border-radius: inherit;">
				</div>

				<div class="testimonial-caption">
					<i>Lorem ipsum dolor sit amet</i>
				</div>

				<div class="testimonial-quoted-by">
					Quoted by <b >John Doe</b>
				</div>

			</div>

		</div>

		<div class="col-md-4">

			<div class="testimonial">

				<div class="testimonial-user-icon">
					<img src="{{ url('icons/user-icon.jpg') }}" style="height: inherit; width: inherit; border-radius: inherit;">
				</div>
				
				<div class="testimonial-caption">
					<i>Lorem ipsum dolor sit amet</i>
				</div>

				<div class="testimonial-quoted-by">
					Quoted by <b >John Doe</b>
				</div>

			</div>

		</div>

	</div>	

</div>	

@endsection