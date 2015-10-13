@extends('layouts/main')
@section('pageTitle', $error)
@section('content')
<div class="container-fliud">
	<div class="alert alert-danger">
		{{{$error}}}
	</div>
</div>
@stop