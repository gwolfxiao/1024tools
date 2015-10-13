@extends('layouts/main')
@section('pageTitle', 'XML转JSON、JSON转XML、JSON/XML互转')
@section('bodyClass', 'tools-xmljson')
@section('content')
<div class="row ttitle clearfix">
	<div class="col-xs-12 col-sm-6"><h3>XML转JSON、JSON转XML、JSON/XML互转</h3></div>
	<div class="col-xs-12 col-sm-6">
		<dl class="list-unstyled pull-right">
			<dt>相关工具：</dt>
			<dd><a href="/json" class="text-info">JSON格式化/验证</a></dd>
			<!-- <dd><a href="/json" class="text-info">XML格式化/验证</a></dd>
			<dt>文档：</dt>
			<dd><a href="/json" class="text-info">什么是XML</a></dd>
			<dd><a href="/json" class="text-info">什么是JSON</a></dd> -->
		</dl>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<h4>输入数据(XML或JSON)：<a href="javascript:" id="xml-example">XML样例</a>、<a href="javascript:" id="json-example">JSON样例</a></h4>
		<div class="editor" id="input"></div>
	</div>
	<div class="col-md-6">
		<h4>转换结果：</h4>
		<div class="editor" id="output"></div>
	</div>
</div>
<div class="row mt10">
	<div class="col-md-6">
		<button type="button" class="btn btn-primary covert" data-from="xml">XML转换为JSON</button>
		<button type="button" class="btn btn-primary covert" data-from="json">JSON转换为XML</button>
		<label><input type="checkbox" id="pretty-json" checked>PRETTY JSON</label>
		
	</div>
	<div class="col-md-6">
		<span class="powerby">
			JSON/XML互转功能由 @<a href="http://www.kawa.net/works/js/xml/objtree-e.html" target="_blank">XML.ObjTree</a> 支持，
			编辑器由 @<a href="https://github.com/ajaxorg/ace" target="_blank">ace</a> 支持
		</span>
	</div>
</div>
<div class="mt10">
	<p id="message"></p>
</div>
@stop

@section('footer')

<script src="{{statics_path()}}/libs/ace/ace.js"></script>
<script src="{{statics_path()}}/libs/xml/ObjTree.js"></script>
<script>
var input = ace.edit("input"),
	output = ace.edit("output");

input.setShowPrintMargin(false)
input.setTheme("ace/theme/tomorrow_night")
input.renderer.setShowGutter(false)
output.setShowPrintMargin(false);
output.setTheme("ace/theme/tomorrow_night")
output.renderer.setShowGutter(false)

$('.covert').click(function(e){
	var from = $(this).data('from'),
		xotree = new XML.ObjTree(),
		inputdata = $.trim(input.getValue());
	if (from == 'xml') {
		var space = ($("#pretty-json").is(':checked')) ? "  " : "",
			tree = xotree.parseXML(inputdata);
		if (!tree.html) {
			output.setValue(JSON.stringify(tree, null, space));
			output.clearSelection();
			showmsg('success', '成功')
		} else {
			showmsg('danger', 'XML格式错误')
		}
	} else if (from == 'json') {
		try {
			output.setValue(xotree.writeXML(JSON.parse(inputdata)));
			output.clearSelection();
			showmsg('success', '成功')
		} catch (e) {
			showmsg('danger', 'JSON格式错误')
		}
	}
	e.preventDefault();
});
$('#xml-example').click(function(e){
	xotree = new XML.ObjTree()
	input.setValue(xotree.writeXML(JSON.parse($('#json-template').html())));
	input.clearSelection();
	e.preventDefault();
});
$('#json-example').click(function(e){
	var data = $('#json-template').html();
	input.setValue(data);
	input.clearSelection();
	e.preventDefault();
});

function showmsg(type, msg) {
	$('#message').hide().removeClass("bg-danger").removeClass("bg-success").addClass("bg-"+type).text(msg).show(100);
}
</script>

<script type="text/template" id="json-template">
{
	"tool": {
		"name":"XML转JSON、JSON转XML、JSON/XML互转",
		"url":"http://1024tools.com/xmljson",
		"keywords":["xml","json","XML转JSON","JSON转XML","JSON/XML互转"],
		"author":["dev@1024tools.com"],
		"description":"该功能由js在本地完成，您的任何输入都不会上传到服务端"
	}
}
</script>

@stop