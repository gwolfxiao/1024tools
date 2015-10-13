@extends('layouts/main')
@section('pageTitle', 'Http Headers查看、HTTP请求头查看、HTTP响应头查看')

@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-7"><h3>Http Headers查看、HTTP请求头查看、HTTP响应头查看</h3></div>
	<div class="col-xs-12 col-sm-5">
		<dl class="list-unstyled pull-right">
			<dt>相关工具:</dt>
			<dd><a href="/ip">IP查询</a></dd>
			<dt>文档:</dt>
			<!-- <dd><a href="/http-headers-docs">headers各项分别代表什么</a></dd> -->
			<dd><a href="/http-status-code">http状态码</a></dd>
		</dl>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<h5>Request Headers：(请求头)</h5>
		<textarea style="width:100%;word-break:break-all;padding:5px;" rows="10" spellcheck="false">{{$header}}</textarea>
	</div>
	<div class="col-xs-12">
		<h5>Response Headers：(响应头)</h5>
		<textarea style="width:100%;word-break:break-all;padding:5px;" rows="10" id="response" spellcheck="false"></textarea>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<span class="powerby">
			<span class="glyphicon glyphicon-question-sign" title="由于安全原因，headers中的cookie信息已被隐藏"></span> headers中的cookie信息已被隐藏
		</span>
	</div>
</div>
@stop
@section('footer')
<script type="text/javascript">
function initResponseHeaders() {
	$.ajax({
		'type': 'head',
		'url': '{{URL::route("http.header")}}',
		'success': function(data,status,xhr){
			$('#response').text(xhr.getAllResponseHeaders());
		},
		'error': initResponseHeaders
	})
}
initResponseHeaders();
</script>
@stop