
@extends('layouts.apperror')
@section('content')
<div class="col-md-12 page-404">
	<div class="number font-red"> 404 </div>
	<div class="details">
		<h3>Oops! You're lost.</h3>
		<p> We can not find the page you're looking for.
			<br/>
			<a href="{{ url('/dashboard') }}"> Return home </a>  </p>
	</div>
</div>
@endsection