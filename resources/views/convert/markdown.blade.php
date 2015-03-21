@extends('layouts/main')
@section('pageTitle', 'Markdown在线编辑、实时预览 - markdown在线编辑器')
@section('bodyClass', 'tools-markdown')
@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-4"><h3>Markdown在线编辑、实时预览</h3></div>
	<div class="col-xs-12 col-sm-8">
		<dl class="list-unstyled pull-right">
			<dd><button class="btn btn-xs btn-primary" id="show-preview" data-show-preview="on">关闭实时预览</button></dd>
			<dd><button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#show-html">查看HTML</button></dd>
			<dt>选择输出样式：</dt>
			<dd>
				<select id="output-style">
					<option value="github">github</option>
					<option value="jasonm23-dark">jasonm23-dark</option>
					<option value="jasonm23-foghorn">jasonm23-foghorn</option>
					<option value="jasonm23-markdown">jasonm23-markdown</option>
					<option value="jasonm23-swiss">jasonm23-swiss</option>
					<option value="markedapp-byword">markedapp-byword</option>
					<option value="thomasf-solarizedcssdark">thomasf-solarizedcssdark</option>
					<option value="thomasf-solarizedcsslight">thomasf-solarizedcsslight</option>
				</select>
			</dd>
			<!-- <dt>相关工具：</dt>
			<dd><a href="/markdown-docs">markdown语法文档</a></dd> -->
		</dl>
	</div>
</div>
<div class="row">
	<div class="col-md-6 markdown-code">
		<div id="markdown-input" style="visiable:none">#Markdown在线编辑、实时预览

实时转换markdown为html

可选择输出html的样式

该功能由js本地完成，您的输入不会发送到服务端

草稿箱功能需要浏览器支持window.localStorage

| 组件  |          功能         |
|-------|:---------------------:|
|marked | markdown编译为html    |
| ace   |        编辑器         |

</div>
	</div>
	<div class="col-md-6 markdown-preview">
		<iframe id="preview" width="100%" scrolling="yes" frameborder="0" src="/statics/html/markdown-preview.html" style="border:1px solid #eee"></iframe>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-6" id="md-draftbox">

		<span class="unsupport">
			<span>浏览器不支持本地草稿箱</span>
			<span class="glyphicon glyphicon-question-sign" title="本地草稿箱需要使用window.localStorage对象，您的浏览器可能不支持"></span>
		</span>
		<span class="draftbox">
			<button class="btn btn-xs btn-primary">清空草稿箱</button>
			<span class="notice"></span>
		</span>
	</div>
	<div class="col-xs-12 col-md-6">
		<span class="powerby">
			Markdown在线编辑、实时预览markdown转换功能由 @<a href="https://github.com/chjj/marked" target="_blank">marked</a> 提供，
			编辑器由 @<a href="https://github.com/ajaxorg/ace" target="_blank">ace</a> 提供
		</span>
	</div>
</div>


@stop

@section('modal')
<!-- Modal -->
<div class="modal fade" id="show-html" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">查看HTML</h4>
			</div>
			<div class="modal-body">
				<textarea rows="20" class="form-control"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
@stop
@section('footer')

<script src="{{statics_path()}}/libs/ace/ace.js"></script>
<script src="{{statics_path()}}/libs/ace/mode-markdown.js"></script>
<script src="{{statics_path()}}/libs/marked/marked.js"></script>
<script>
~function($, ace, marked){
	var editor = ace.edit("markdown-input");
	editor.setShowPrintMargin(false);
	editor.setTheme("ace/theme/tomorrow_night");
	editor.getSession().setMode("ace/mode/markdown");
	editor.on('change', function(){
		markdown_preview();
		save_to_draftbox();
	});

	init_draftbox();
	setTimeout(markdown_preview, 1000);

	function markdown_preview() {
		var html = marked(editor.getValue())
		$("#preview").contents().find("body").html(html);
		$("#preview").contents().find('#mdstyle').attr('href', '{{{statics_path()}}}/css/markdown/'+$('#output-style').val()+'.css')
	}

	function save_to_draftbox() {
		if (!window.localStorage) {
			$('#md-draftbox .draftbox').hide();
			$('#md-draftbox .unsupport').show();
		} else {
			$('#md-draftbox .unsupport').hide();
			$('#md-draftbox .draftbox .notice').text('已实时保存到草稿箱');
			$('#md-draftbox .draftbox').show();
			window.localStorage.setItem('markdown_draft', editor.getValue());
		}
	}

	function init_draftbox(){
		if (!window.localStorage) {
			$('#md-draftbox .draftbox').hide();
			$('#md-draftbox .unsupport').show();
		} else {
			var input = window.localStorage.getItem('markdown_draft');
			if (input) {
				editor.setValue(input);
				editor.clearSelection();
				$('#md-draftbox .draftbox .notice').text('已从草稿箱中恢复');
			}
			$('#md-draftbox .unsupport').hide();
			$('#md-draftbox .draftbox').show();
		}
	}

	$("#show-preview").click(function(){
		if ($(this).data('show-preview') == "on") {
			$(".markdown-preview").hide()
			$(".markdown-code").removeClass('col-md-6').addClass('col-md-12')
			$(this).text('打开实时预览')
			$(this).data('show-preview', "off")
		} else {
			$(".markdown-code").removeClass('col-md-12').addClass('col-md-6')
			$(".markdown-preview").show()
			$(this).text('关闭实时预览')
			$(this).data('show-preview', "on")
		}
	})

	$('#output-style').change(markdown_preview);
	
	$('#show-html').on('show.bs.modal', function (e) {
		var css = '<link href="http://statics.1024tools.com/css/markdown/'+$('#output-style').val()+'.css"'+ ' rel="stylesheet" />' + "\r\n";
		$('#show-html .modal-body textarea').text(css + marked(editor.getValue()));
	});

	$('#md-draftbox .draftbox button').click(function(){
		if (window.localStorage) {
			window.localStorage.removeItem('markdown_draft');
			$('#md-draftbox .draftbox .notice').text('已清空草稿箱');
		}
	})

}(jQuery, ace, marked)
</script>
@stop