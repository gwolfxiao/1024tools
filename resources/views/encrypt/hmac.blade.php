@extends('layouts/main')
@section('pageTitle', 'HMAC计算、HMAC-MD5、HMAC-SHA1、HMAC-SHA256、HMAC-SHA512在线计算')

@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-10"><h3>HMAC计算、HMAC-MD5、HMAC-SHA1、HMAC-SHA256、HMAC-SHA512在线计算</h3></div>
	<div class="col-xs-12 col-sm-2">
		<dl class="list-unstyled pull-right">
			<dt>相关工具:</dt>
			<dd><a href="{{URL::route('encrypt.hash')}}">HASH计算</a></dd>
		</dl>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-10 col-md-8">
		<form action="{{URL::route('encrypt.hmac.post')}}" method="post">
			<div class="form-group clearfix">
				<label for="query" class="control-label">消息：</label>
				{!! Form::input('text', 'query', $query, ['class' => 'form-control', 'id' => 'query']) !!}
			</div>
			<div class="form-group clearfix">
				<label for="algo" class="control-label">算法：</label>
				{!! Form::select('algo', array_combine($algos, $algos), $algo, ['class' => 'form-control', 'id' => 'algo']) !!}
			</div>
			<div class="form-group clearfix">
				<label for="key" class="control-label">秘钥：</label>
				{!! Form::input('text', 'key', $key, ['class' => 'form-control', 'id' => 'key']) !!}
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<button type="submit" class="btn btn-primary">计算</button>
			@if (isset($result))
			<div class="form-group mt10 clearfix">
				<label for="result" class="control-label">结果：</label>
				{!! Form::textarea('result', $result, ['class' => 'form-control', 'id' => 'result', 'rows' => 3, 'spellcheck' => "false"]) !!}
			</div>
			<div class="form-group mt10 clearfix">
				<label for="result" class="control-label">结果（按utf-8编码base64）：</label>
				{!! Form::textarea('result', base64_encode($result), ['class' => 'form-control', 'id' => 'result_base64', 'rows' => 3, 'spellcheck' => "false"]) !!}
			</div>
			@endif
		</form>
	</div>
</div>

<div class="row">
	<div class="tips">
		<ol>
			<li>HMAC (Hash-based message authentication code) 常用于接口签名验证</li>
			<li>支持的算法有 {{implode('、', $algos)}} </li>
		</ol>
	</div>
</div>

@stop