@extends('layouts/main')
@section('pageTitle', 'SQL格式化、SQL压缩、SQL高亮、SQL FORMATTER')
@section('bodyClass', 'tools-sqlformat')
@section('content')
<div class="row ttitle clearfix">
	<div class="col-xs-12 col-sm-6"><h3>SQL格式化、SQL压缩、SQL高亮、SQL FORMATTER</h3></div>
	<div class="col-xs-12 col-sm-6">
		<dl class="list-unstyled pull-right">
			<dt>相关工具：</dt>
			<dd><a href="{{URL::route('format.json')}}" class="text-info">JSON格式化/验证</a></dd>
		</dl>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<h4>输入数据：<a href="javascript:" id="sql-example">SQL样例</a></h4>
		<div class="editor" id="input"></div>
	</div>
	<div class="col-md-6">
		<h4>结果：</h4>
		<div id="output"></div>
	</div>
</div>
<div class="row mt10">
	<div class="col-md-6">
		<button type="button" class="btn btn-primary format" data-type="format">格式化</button>
		<button type="button" class="btn btn-primary format" data-type="compress">压缩</button>
	</div>
	<div class="col-md-6">
		<span class="powerby">
			SQL格式化/压缩功能由 @<a href="https://github.com/jdorn/sql-formatter" target="_blank">sql-formatter</a> 支持，
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
<script>
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': "{{ csrf_token() }}"
	}
});
</script>
<script>
var input = ace.edit("input");
input.setShowPrintMargin(false);
input.setTheme("ace/theme/tomorrow_night");
input.renderer.setShowGutter(false);
$('.format').click(function(e){
	var inputdata = input.getValue();
	if (inputdata) {
		$.ajax({
			type: 'post',
			url: '{{URL::route("format.sql.post")}}',
			data: {"query":inputdata, "type": $(this).data('type')},
			success: function(data){
				$('#output').html(data.result);
				showmsg('success', '成功');
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
$('#sql-example').click(function(e){
	input.setValue($('#sql-template').html());
	input.clearSelection();
	e.preventDefault();
});

function showmsg(type, msg) {
	$('#message').hide().removeClass("bg-danger").removeClass("bg-success").addClass("bg-"+type).text(msg).show(100);
}
</script>

<script type="text/template" id="sql-template">SELECT DATE_FORMAT(b.t_create, '%Y-%c-%d') dateID, b.title memo 
FROM (SELECT id FROM orc_scheme_detail d WHERE d.business=208 
AND d.type IN (29,30,31,321,33,34,3542,361,327,38,39,40,41,42,431,4422,415,4546,47,48,'a',
29,30,31,321,33,34,3542,361,327,38,39,40,41,42,431,4422,415,4546,47,48,'a') 
AND d.title IS NOT NULL AND t_create >= 
DATE_FORMAT((DATE_SUB(NOW(),INTERVAL 1 DAY)),'%Y-%c-%d') AND t_create 
< DATE_FORMAT(NOW(), '%Y-%c-%d') ORDER BY d.id LIMIT 2,10) a, 
orc_scheme_detail b WHERE a.id = b.id</script>

@stop