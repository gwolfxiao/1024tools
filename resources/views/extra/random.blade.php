@extends('layouts/main')
@section('pageTitle', trans('random.page.title'))

@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-10"><h3>{{ trans('random.page.title') }}</h3></div>
	<div class="col-xs-12 col-sm-2">
		<dl class="list-unstyled pull-right">
		</dl>
	</div>
</div>
<div class="col-xs-12">
	<form class="form-horizontal">
		<div class="form-group">
			<p class="bg-success text-success">
				{{ trans('random.page.tips') }}
			</p>
		</div>
		<div class="form-group clearfix">
				<label class="control-label col-sm-2">{{ trans('random.page.numbers') }}</label>
				<div class="col-sm-2">
					<input type="number" class="form-control" id="random-num" value="5" placeholder="{{ trans('random.page.numbers_placeholder') }}">
				</div>
		</div>
		<div class="form-group clearfix">
				<label class="control-label col-sm-2">{{ trans('random.page.length')}}</label>
				<div class="col-sm-10 form-inline">
					<input type="number" class="form-control" id="random-len-from" value="16" placeholder="{{ trans('random.page.length_placeholder_min')}}">
						~
					<input type="number" class="form-control" id="random-len-to" value="20" placeholder="{{ trans('random.page.length_placeholder_max')}}">
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">{{ trans('random.page.charset') }}</label>
			<div class="col-sm-10" id="random-charset">
				<input type="text" class="form-control" value="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()_+" spellcheck="false"/>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="0123456789" checked="checked">
						{{ trans('random.page.charset_numbers') }} 0123456789
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="abcdefghijklmnopqrstuvwxyz" checked="checked">
						{{ trans('random.page.charset_lowcase_letters') }} abcdefghijklmnopqrstuvwxyz
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="ABCDEFGHIJKLMNOPQRSTUVWXYZ" checked='checked'>
						{{ trans('random.page.charset_upcase_letters') }} ABCDEFGHIJKLMNOPQRSTUVWXYZ
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" value="~!@#$%^&*()_+" checked='checked'>
						{{ trans('random.page.charset_symbols') }} ~!@#$%^&*()_+
					</label>
				</div>
			</div>
		</div>
		<div class="form-group clearfix">
			<div class="col-sm-10 col-sm-offset-2">
			<button type="button" class="btn btn-primary" id="random-generate" autofocus="autofocus">{{ trans('random.page.submit') }}</button>
			</div>
		</div>
		<div class="form-group" id="random-result">
			<label class="control-label col-sm-2">{{ trans('random.page.result') }}</label>
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
	});

	$(document).ready(function(){
		$('#random-generate').trigger('click');
	});

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