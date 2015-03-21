@extends('layouts/main')
@section('pageTitle', '代码高亮、代码着色、在线代码美化')
@section('bodyClass', 'tools-highlight')
@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-4"><h3>代码高亮、代码着色、在线代码美化</h3></div>
	<div class="col-xs-12 col-sm-8">
		<dl class="list-unstyled pull-right">
			<dt>语言：</dt>
			<dd>
				<select id="lang"></select>
			</dd>
			<dt>输出样式：</dt>
			<dd>
				<select id="output-style">
					<option value="arta">arta</option>
					<option value="ascetic">ascetic</option>
					<option value="atelier-dune.dark">atelier-dune.dark</option>
					<option value="atelier-dune.light">atelier-dune.light</option>
					<option value="atelier-forest.dark">atelier-forest.dark</option>
					<option value="atelier-forest.light">atelier-forest.light</option>
					<option value="atelier-heath.dark">atelier-heath.dark</option>
					<option value="atelier-heath.light">atelier-heath.light</option>
					<option value="atelier-lakeside.dark">atelier-lakeside.dark</option>
					<option value="atelier-lakeside.light">atelier-lakeside.light</option>
					<option value="atelier-seaside.dark">atelier-seaside.dark</option>
					<option value="atelier-seaside.light">atelier-seaside.light</option>
					<option value="brown_paper">brown_paper</option>
					<option value="codepen-embed">codepen-embed</option>
					<option value="color-brewer">color-brewer</option>
					<option value="dark">dark</option>
					<option value="darkula">darkula</option>
					<option value="default">default</option>
					<option value="docco">docco</option>
					<option value="far">far</option>
					<option value="foundation">foundation</option>
					<option value="github">github</option>
					<option value="googlecode">googlecode</option>
					<option value="hybrid">hybrid</option>
					<option value="idea">idea</option>
					<option value="ir_black">ir_black</option>
					<option value="kimbie.dark">kimbie.dark</option>
					<option value="kimbie.light">kimbie.light</option>
					<option value="magula">magula</option>
					<option value="mono-blue">mono-blue</option>
					<option value="monokai">monokai</option>
					<option value="monokai_sublime" selected>monokai_sublime</option>
					<option value="obsidian">obsidian</option>
					<option value="paraiso.dark">paraiso.dark</option>
					<option value="paraiso.light">paraiso.light</option>
					<option value="pojoaque">pojoaque</option>
					<option value="railscasts">railscasts</option>
					<option value="rainbow">rainbow</option>
					<option value="school_book">school_book</option>
					<option value="solarized_dark">solarized_dark</option>
					<option value="solarized_light">solarized_light</option>
					<option value="sunburst">sunburst</option>
					<option value="tomorrow-night-blue">tomorrow-night-blue</option>
					<option value="tomorrow-night-bright">tomorrow-night-bright</option>
					<option value="tomorrow-night-eighties">tomorrow-night-eighties</option>
					<option value="tomorrow-night">tomorrow-night</option>
					<option value="tomorrow">tomorrow</option>
					<option value="vs">vs</option>
					<option value="xcode">xcode</option>
					<option value="zenburn">zenburn</option>
				</select>
			</dd>
			<dd><button class="btn btn-xs btn-primary" id="do-highlight" data-show-preview="off">点击高亮代码</button></dd>
			<dd><button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#show-html">查看HTML</button></dd>
		</dl>
	</div>
</div>
<div class="row">
	<div class="col-md-12 input">
		<div id="editor">{{{'<'.'?'.'php'}}}

class HighlightTool extends Tool {
    public $name = "代码高亮、代码着色、在线美化";
    public $notice = "该功能由JS在本地完成，您的输入不会发送到服务端";

    public function doHighlight() {
    
    }

}</div>
	</div>
	<div class="col-md-12 preview hidden">
		<iframe id="preview" height="500" width="100%" scrolling="no" frameborder="0" src="/statics/html/highlight-preview.html" style="border:1px solid #eee;"></iframe>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<span class="powerby">
			代码高亮/着色、在线美化功能由 @<a href="https://github.com/isagalaev/highlight.js" target="_blank">highlight.js</a> 提供，
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
<script src="{{statics_path()}}/libs/highlight.js/highlight.pack.js"></script>

<script>
~function($, ace, hljs){
	var editor = ace.edit("editor");
	editor.setTheme("ace/theme/tomorrow_night");
	init();
	$('#do-highlight').click(function(){
		if ($(this).data('show-preview') == "on") {
			$(".preview").addClass("hidden")
			$(".input").removeClass("hidden")
			$(this).text('点击高亮代码')
			$(this).data('show-preview', "off")
		} else {
			preview()
			$(".preview").removeClass("hidden")
			$(".input").addClass("hidden")
			$(this).text('返回重新输入')
			$(this).data('show-preview', "on")
		}
	});
	
	$('#show-html').on('show.bs.modal', function (e) {
		var css = '<link href="http://statics.1024tools.com/libs/highlight.js/styles/'+$('#output-style').val()+'.css"'+ ' rel="stylesheet" />' + "\r\n";
		var html = "<pre class='hljs'><code>" + 
		hljs.highlightAuto(editor.getValue()).value +
		"</code></pre>";
		$('#show-html .modal-body textarea').text(css + html);
	});

	$('#lang, #output-style').change(function(){
		if ($('#do-highlight').data('show-preview') == "on") {
			preview()
		}
	})

	function init() {
		var langs = hljs.listLanguages();
		var lang_html = '<option value="">自动检测</option>';
		for(var i = 0; i <= langs.length - 1; i++) {
			lang_html += '<option value="' + langs[i] + '">' + langs[i] +'</option>'
		}
		$('#lang').html(lang_html)
	}

	function preview() {
		if ($("#lang").val() != '') {
			var html = hljs.highlight($("#lang").val(), editor.getValue()).value;
		} else {
			var html = hljs.highlightAuto(editor.getValue()).value;
		}
		$("#preview").contents().find("#preview").html(html);
		$("#preview").contents().find('#style').attr('href', '{{{statics_path()}}}/libs/highlight.js/styles/'+$('#output-style').val()+'.css')
	}
}(jQuery, ace, hljs)
</script>
@stop