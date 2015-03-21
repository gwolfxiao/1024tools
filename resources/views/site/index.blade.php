@extends('layouts/main')
@section('pageTitle', '1024程序员开发工具箱')
@section('bodyClass', 'homepage')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="page-header col-xs-12 col-sm-8 col-sm-offset-2 col-lg-6 col-lg-offset-3">
			<h1>1024程序员开发工具箱 <small>1024tools.com</small></h1>
		</div>
	</div>

	<div class="row">
		<table class="table table-hover" id="tools-list">
			<thead>
				<tr>
					<th style="width:10%">#</th>
					<th style="width:25%">工具名</th>
					<th style="width:35%">简介</th>
					<th style="width:30%">url</th>
				</tr>
			</thead>
			<tbody>

			@foreach ($tools as $tool)
				<tr data-id="{{{$tool->id}}}" title="{{{$tool->name}}}">
					<th scope="row">{{{$tool->id}}}</th>
					<td><a href="{{{URL::route($tool->route)}}}">{{{$tool->name}}}</a></td>
					<td>{{{$tool->full_name}}}</td>
					<td>{{{URL::route($tool->route)}}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop

@section('footer')
<div class="container-fluid" id="footer">
	<p>
		1024程序员开发工具箱 1024tools.com &copy;2015 京ICP备15003178号-1
	</p>
</div>
@stop