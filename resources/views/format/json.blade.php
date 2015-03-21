@extends('layouts/main')
@section('pageTitle', 'JSON格式化、JSON压缩、JSON在线解析、JSON验证')
@section('bodyClass', 'tools-json')
@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-8"><h3>JSON格式化、JSON压缩、JSON在线解析、JSON验证</h3></div>
	<div class="col-xs-12 col-sm-4">
		<dl class="list-unstyled pull-right">
			<dt>相关工具:</dt>
			<dd><a href="{{URL::route('convert.xmljson')}}">JSON转XML、XML转JSON</a></dd>
		</dl>
	</div>
</div>

<form>
	<div class="form-group">
		<div id="input">{
  "name": "JSON格式化、JSON压缩、JSON在线解析、JSON验证",
  "url": "http://1024tools.com/json",
  "description": "JSON格式化/压缩工具由JS在本地完成，您的所有输入都不会提交到服务端"
}</div>
	</div>
	<div class="form-group">
		<div class="form-inline">
			<button class="btn btn-primary format" data-type="beauty">格式化</button>
			<button class="btn btn-primary format">压缩</button>
			<span class="powerby">JSON解析提示由 @<a href="https://github.com/zaach/jsonlint" target="_blank">jsonlint</a> 提供，
		编辑器由 @<a href="https://github.com/ajaxorg/ace" target="_blank">ace</a> 提供</span>
		</div>
	</div>
	
</form>

<div>
	<p id="message"></p>
</div>
@stop

@section('footer')
<script src="{{statics_path()}}/libs/ace/ace.js"></script>
<script src="{{statics_path()}}/libs/ace/mode-json.js"></script>
<script src="{{statics_path()}}/libs/jsonlint/json2.js" ></script>
<script src="{{statics_path()}}/libs/jsonlint/jsonlint.js" ></script>
<script>
var editor = ace.edit("input");
editor.setShowPrintMargin(false);
editor.setTheme("ace/theme/tomorrow_night");
editor.getSession().setMode("ace/mode/json");
$('.format').click(function(e){
	try {
		$('#message').hide();
		var input = editor.getValue(),
			result = jsonlint.parse(input),
			glue = $(this).data('type') == 'beauty' ? '  ' : ''
		if (result) {
			result = JSON.stringify(JSON.parse(input), null, glue);
			show_success(result);
		}		
	} catch(e) {
		show_error(e);
	}
	$("#input").data('firstfocus', true);
	e.preventDefault();
	return false;
});

editor.on('focus', function(){
	if (!$("#input").data('firstfocus')) {
		editor.setValue('');
		$("#input").data('firstfocus', true)
	}
});

function show_success(data) {
	$('#message').addClass('bg-success').removeClass('bg-danger').text('成功').show(100);
	editor.setValue(data);
	editor.clearSelection();
}

function show_error(e){
	$('#message').removeClass('bg-success').addClass('bg-danger').text(e).show(100);
}
</script>
@stop