@extends('layouts/main')
@section('pageTitle', 'jQuery中文文档、jQuery速查表、jQuery在线手册')
@section('content')
<div class="row">
<iframe src="{{statics_path()}}/html/jquery_manual/index.htm" width="100%" height="100%" style="border:0; height:2000px" class="col-xs-12"></iframe>
</div>
@stop