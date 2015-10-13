@extends('layouts/main')
@section('pageTitle', 'URL解码、URL编码、urlencode/urldecode')

@section('content')
<div class="row ttitle clearfix">
	<div class="col-xs-12 col-sm-8"><h3>URL解码、URL编码、urlencode/urldecode</h3></div>
	<div class="col-xs-12 col-sm-4">
		<dl class="list-unstyled pull-right">
			
		</dl>
	</div>
</div>
<form>
	<div class="form-group">
		<textarea id="query" class="form-control" rows="8" spellcheck="false">{{{@$query ?: "请输入要转换的内容、批量转换时一行一个"}}}</textarea>
	</div>
	<div class="form-group">
		<div class="form-inline">
			<button id="decode" class="btn btn-primary" data-type="decode">解码(decode)</button>
			<button id="encode" class="btn btn-primary" data-type="encode">编码(encode)</button>
			<select id="method" class="form-control">
				<option value="encodeURIComponent">encodeURIComponent/decodeURIComponent （javascript）</option>
				<option value="encodeURI">encodeURI/decodeURI （javascript）</option>
				<option value="rawurlencode">rawurlencode/rawurldecode（php、RFC3986）</option>
				<option value="urlencode">urlencode/urldecode（php）</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<textarea id="result" class="form-control" rows="8" spellcheck="false"></textarea>
	</div>
</form>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group bg-danger" id="message"></div>
	</div>
</div>
@stop

@section('footer')
<script>
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': "{{ csrf_token() }}"
	}
});
$("#query").on('click', function(){
	if (!$(this).data('firstfocus')) {
		if ($(this).val() == '请输入要转换的内容、批量转换时一行一个'){
			$(this).val('');
		}
		$(this).data('firstfocus', true)
	}
});
$('#encode, #decode').click(function(){
	var query = $('#query').val().replace("\r", "").split("\n"),
		type = $(this).data('type'),
		method = $('#method').val();
	if (query.length) {
		$("#result").val('');
		if ((method == "encodeURI") || (method == "encodeURIComponent")) {
			var theFunction = {
				"encodeURI": {"encode":encodeURI, "decode":decodeURI},
				"encodeURIComponent": {"encode":encodeURIComponent, "decode":decodeURIComponent}
			}, result = new Array();
			for (var i = 0; i <query.length; i++) {
				result.push(theFunction[method][type](query[i]));
			};
			$('#result').val(result.join("\n"));
		} else {
			$.ajax({
				type:"post",
				url:'{{URL::route("convert.urlencode.post")}}',
				data:{'query':query.join("\n"), 'type':type, 'method':method},
				dataType:'json',
				success:function(result){
					if (result.status == 1) {
						$('#message').text('');
						$('#result').val(result.result.join("\n"));
					} else {
						$('#message').text(result.error);
					}
				}
			})
		}
	}
	return false;
});
</script>
@stop