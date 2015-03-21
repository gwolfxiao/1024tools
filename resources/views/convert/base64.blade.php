@extends('layouts/main')
@section('pageTitle', 'Base64解码、Base64编码、base64加密解密、base64encode/base64decode')

@section('content')
<div class="row ttitle clearfix">
	<div class="col-xs-12 col-sm-8"><h3>Base64解码、Base64编码、base64加密解密</h3></div>
	<div class="col-xs-12 col-sm-4">
		<dl class="list-unstyled pull-right">
			<!-- <dt>相关工具：</dt>
			<dd><a href="/base64-img" class="text-info">图片base64互转</a></dd> -->
		</dl>
	</div>
</div>
<form>
	<div class="form-group">
		<textarea id="query" class="form-control" rows="10" spellcheck="false">{{{$query ?: "请输入要编码或解码的字符串"}}}</textarea>
	</div>
	<div class="form-group">
		<div class="form-inline">
			<button id="decode" class="btn btn-primary" data-type="decode">解码(decode)</button>
			<button id="encode" class="btn btn-primary" data-type="encode">编码(encode)</button>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			{!! Form::select('encoding', array_combine($encoding, $encoding), null, ['class' => 'form-control', 'id' => 'encoding']) !!}
		</div>
	</div>
	<p class="bg-danger" id="message"></p>
</form>

<div class="row">
	<div class="tips">
		<ol>
			<li>转换规则：进行Base64转换的时候，将3个byte（3*8bit = 24bit）的数据，先后放入一个24bit的缓冲区中，先来的byte占高位。数据不足3byte的话，于缓冲器中剩下的bit用0补足。然后，每次取出6个bit（24/6 = 4），因为2^6=64，按照其值选择ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/这64个字符中对应的字符作为编码后的输出。不断进行，直到全部输入数据转换完成。当原数据长度不是3byte的整数倍时, 如果最后剩下1个输入数据，在编码结果后加2个“=”；如果最后剩下2个输入数据，编码结果后加1个“=”；如果没有剩下任何数据，就什么都不要加。</li>
			<li>Base64编码后的数据比原始数据略长，为原来的4/3。</li>
			<li>base64编码对同一字符在不同的编码下结果可能不同。</li>
			<li>因为编码后的+/=字符，标准的Base64并不适合直接放在URL里传输。</li>
			<li>有一些base64的变种，它们将+/等符合转换为其他符号（如_-），这样就能安全的在url中传输了（url safe）。</li>
		</ol>
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
		if ($(this).val() == '请输入要编码或解码的字符串'){
			$(this).val('');
		}
		$(this).data('firstfocus', true)
	}
});

$('#encode, #decode').click(function(){
	var query = $('#query').val(),
		type = $(this).data('type'),
		encoding = $('#encoding').val();
	if (query.length) {

		$.ajax({
			type:"post",
			url:'{{URL::route("convert.base64.post")}}',
			data:{'query':query, 'type':type, 'encoding':encoding},
			dataType:'json',
			success:function(result){
				$('#message').hide();
				if (result.status == 1) {
					$('#query').val(result.result);
				} else {
					$('#message').text(result.error).show(100);
				}
			}
		})
	}
	return false;
});
</script>
@stop