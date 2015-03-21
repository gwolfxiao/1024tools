@extends('layouts/main')
@section('pageTitle', '随机数生成、随机字符串生成、random、密码生成器')

@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-10"><h3>随机数生成、随机字符串生成、random、密码生成器</h3></div>
	<div class="col-xs-12 col-sm-2">
		<dl class="list-unstyled pull-right">
		</dl>
	</div>
</div>
<div class="col-xs-12">
	<form class="form-horizontal">
		<div class="form-group">
			<p class="bg-success text-success">
				该功能由JS在本地完成，您的任何输入都不会提交到服务端。
			</p>
		</div>
		<div class="form-group clearfix">
				<label class="control-label col-sm-2">生成数量：</label>
				<div class="col-sm-2">
					<input type="number" class="form-control" id="random-num" value="5" placeholder="生成多少组结果">
				</div>
		</div>
		<div class="form-group clearfix">
				<label class="control-label col-sm-2">长度：</label>
				<div class="col-sm-10 form-inline">
					<input type="number" class="form-control" id="random-len-from" value="16" placeholder="最小多少位">
						~
					<input type="number" class="form-control" id="random-len-to" value="20" placeholder="最长多少位">
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">使用字符集：</label>
			<div class="col-sm-10" id="random-charset">
				<input type="text" class="form-control" value="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()_+" spellcheck="false"/>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="0123456789" checked="checked">
						数字 0123456789
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="abcdefghijklmnopqrstuvwxyz" checked="checked">
						小写字母 abcdefghijklmnopqrstuvwxyz
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="ABCDEFGHIJKLMNOPQRSTUVWXYZ" checked='checked'>
						大写字母 ABCDEFGHIJKLMNOPQRSTUVWXYZ
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="~!@#$%^&*()_+" checked='checked'>
						常用符号 ~!@#$%^&*()_+
					</label>
				</div>
			</div>
		</div>
		<div class="form-group clearfix">
			<div class="col-sm-10 col-sm-offset-2">
			<button type="button" class="btn btn-primary" id="random-generate" autofocus="autofocus">生成</button>
			</div>
		</div>
		<div class="form-group" id="random-result">
			<label class="control-label col-sm-2">结果：</label>
			<div class="col-sm-10">
				<textarea class="form-control" rows="6" spellcheck="false"></textarea>
			</div>
		</div>
	</form>
</div>
@stop
@section('footer')
<script type="text/javascript">
~function($, window, Math) {
	$("#random-generate").click(function(e){
		var charset = $('#random-charset :text').val(),
			lenfrom = parseInt($('#random-len-from').val(), 10),
			lento = parseInt($('#random-len-to').val(), 10),
			num = parseInt($('#random-num').val(), 10),
			result = '';
		for (var i = num - 1; i >= 0; i--) {
			result += generateOne(charset, lenfrom, lento) + "\r";
		}
		$('#random-result textarea').attr("rows", num + 1).val(result);
		e.preventDefault();
		return false;
	});

	$('#random-charset :checkbox').click(function(){
		var checked = $('#random-charset :checkbox:checked'),
			charset = '';
		for (var i = 0; i < checked.length; i++) {
			charset += checked[i].value
		};
		$('#random-charset :text').val(charset)
	})

	function generateOne(charset, lenfrom, lento) {
		var result = '';
		if ((lenfrom <= lento) && (charset.length > 0) && (lenfrom >= 0)) {
			var len = Math.round(Math.random() * (lento - lenfrom) + lenfrom);
			while(result.length < len) {
				result += charset.charAt(Math.floor(Math.random() * charset.length))
			}
		}
		return result;
	}
}(jQuery, window, Math)
</script>
@stop