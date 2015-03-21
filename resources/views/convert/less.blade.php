@extends('layouts/main')
@section('pageTitle', 'LESS编译、LESS转换为CSS、LESS编译为CSS')
@section('bodyClass', 'tools-less')
@section('content')
<div class="row ttitle clearfix">
	<div class="col-xs-12 col-sm-6"><h3>LESS编译、LESS转换为CSS、LESS编译为CSS</h3></div>
	<div class="col-xs-12 col-sm-6">
		<dl class="list-unstyled pull-right">
			<!-- <dt>相关工具：</dt>
			<dd><a href="/css" class="text-info">CSS压缩/混淆</a></dd>
			<dt>文档：</dt>
			<dd><a href="/less-docs" class="text-info">什么是LESS</a></dd> -->
		</dl>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<h4>输入LESS：<a href="javascript:" id="less-example">LESS样例</a></h4>
		<div class="editor" id="input"></div>
	</div>
	<div class="col-md-6">
		<h4>输出CSS：</h4>
		<div class="editor" id="output"></div>
	</div>
</div>
<div class="row mt10">
	<div class="col-md-6">
		<button type="button" class="btn btn-primary covert" data-from="less">LESS转换为CSS</button>
	</div>
	<div class="col-md-6">
		<span class="powerby">
			LESS编译CSS功能由 @<a href="https://github.com/leafo/lessphp" target="_blank">lessphp</a> 支持，
			编辑器由 @<a href="https://github.com/ajaxorg/ace" target="_blank">ace</a> 支持
		</span>
	</div>
</div>
<div class="mt10">
	<p id="msg"></p>
</div>
@stop

@section('footer')

<script src="{{statics_path()}}/libs/ace/ace.js"></script>
<script src="{{statics_path()}}/libs/xml/ObjTree.js"></script>
<script>
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': "{{ csrf_token() }}"
	}
});
</script>
<script>
var input = ace.edit("input"),
	output = ace.edit("output");

input.setShowPrintMargin(false)
input.setTheme("ace/theme/tomorrow_night")
output.setShowPrintMargin(false);
output.setTheme("ace/theme/tomorrow_night")

$('.covert').click(function(e){
	var inputdata = input.getValue();
	if (inputdata) {
		$.ajax({
			type: 'post',
			url: '{{{URL::route("convert.less.post")}}}',
			data: {'query': inputdata},
			success: function(data) {
				if (data.status == 1) {
					output.setValue(data.result);
					output.clearSelection();
					showmsg('success', '成功');
				} else {
					showmsg('danger', data.error);
				}
			},
			error: function(){
				showmsg('danger', '网络错误');
			}
		})
	} else {
		showmsg('danger', '输入为空');
	}
	e.preventDefault();
});

$('#less-example').click(function(e){
	var data = $('#less-template').html();
	input.setValue(data);
	input.clearSelection();
	e.preventDefault();
});

function showmsg(type, msg) {
	$('#msg').removeClass("bg-danger").removeClass("bg-success").addClass("bg-"+type).text(msg);
}
</script>

<script type="text/template" id="less-template">
@base: #f938ab;

.box-shadow(@style, @c) when (iscolor(@c)) {
  -webkit-box-shadow: @style @c;
  box-shadow:         @style @c;
}
.box-shadow(@style, @alpha: 50%) when (isnumber(@alpha)) {
  .box-shadow(@style, rgba(0, 0, 0, @alpha));
}
.box {
  color: saturate(@base, 5%);
  border-color: lighten(@base, 30%);
  div { .box-shadow(0 0 5px, 30%) }
}
</script>

@stop