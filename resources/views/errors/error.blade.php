@extends('layouts/main')
@section('pageTitle', trans('errors.error_occurred'))
@section('content')
<div class="container-fliud">
	<div class="alert alert-danger">
		{{trans('errors.error_occurred_notice')}}
	</div>
</div>
@stop