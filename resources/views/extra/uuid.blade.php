@extends('layouts/main')
@section('pageTitle', 'UUID在线生成')

@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-10"><h3>UUID在线生成</h3></div>
	<div class="col-xs-12 col-sm-2">
		<dl class="list-unstyled pull-right">
		</dl>
	</div>
</div>
<div class="col-xs-12">
	<form class="form-horizontal">
		<div class="form-group">
			<p class="bg-success text-success">
				Universally unique identifier（通用唯一识别码）<a href="http://en.wikipedia.org/wiki/Universally_unique_identifier" target="_blank">查看</a>
			</p>
		</div>
		<div class="form-group clearfix">
				<label class="control-label col-sm-2">生成数量：</label>
				<div class="col-sm-2">
					<input type="number" class="form-control" id="uuid-num" value="5" placeholder="生成多少组结果">
				</div>
		</div>
		<div class="form-group clearfix">
			<div class="col-sm-10 col-sm-offset-2">
			<button type="button" class="btn btn-primary" id="uuid-generate" autofocus="autofocus">生成</button>
			</div>
		</div>
		<div class="form-group" id="uuid-result">
			<label class="control-label col-sm-2">结果：</label>
			<div class="col-sm-10">
				<textarea class="form-control" rows="6" spellcheck="false"></textarea>
			</div>
		</div>
	</form>
	<div class="mt10">
		<p id="message"></p>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<span class="powerby">
			uuid在线生成使用 @<a href="https://github.com/ramsey/uuid" target="_blank">rhumsaa/uuid</a> 实现
		</span>
	</div>
</div>

@stop
@section('footer')
<script type="text/javascript">
~function($, window) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': "{{ csrf_token() }}"
		}
	});
	$("#uuid-generate").click(function(e){
		var num = parseInt($('#uuid-num').val(), 10),
			result = '';
		if (num > 10) { //限制最多生成10组
			$('#uuid-num').val('10');
			num = 10;
		}
		$.ajax({
			type: 'post',
			url: '{{URL::route("extra.uuid.post")}}',
			data: {"num":num},
			success: function(data){
				if (data.status == 1) {
					$('#uuid-result textarea').attr("rows", num + 1).val(data.result.join("\r\n"));
				} else {
					showmsg('danger', data.error);
				}
			},
			error: function(){
				showmsg('danger', '网络错误');
			}
		});
		e.preventDefault();
		return false;
	});

	function showmsg(type, msg) {
		$('#message').hide().removeClass("bg-danger").removeClass("bg-success").addClass("bg-"+type).text(msg).show(100);
	}
}(jQuery, window)
</script>
@stop