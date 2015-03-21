@extends('layouts/main')
@section('pageTitle', 'Hash在线计算、md5计算、sha1计算、sha256计算、sha512计算')

@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-8"><h3>Hash在线计算、md5计算、sha1计算、sha256计算、sha512计算</h3></div>
	<div class="col-xs-12 col-sm-4">
		<dl class="list-unstyled pull-right">
			<!-- <dt>相关工具:</dt>
			<dd><a href="{{URL::route('convert.xmljson')}}">HMAC计算</a></dd> -->
		</dl>
	</div>
</div>

<div class="row">
	<form action="{{URL::route('encrypt.hash')}}" method="post">
		<div class="col-xs-8">
			<input type="text" class="form-control" name="query" placeholder="输入要计算的字符串" value="{{{$query}}}">
		</div>
		<div class="col-xs-4">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<button type="submit" class="btn btn-primary">计算</button>
		</div>
	</form>
	
	<div class="col-xs-12">
		<table class="table table-bordered table-striped mt10" style="word-break:break-word;">
			<thead>
				<tr>
					<th width="5%">#</th>
					<th width="10%">算法</th>
					<th width="33%">结果</th>
					<th width="33%">结果(大写)</th>
					<th width="4%">长度</th>
					<th width="15%">备注</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($algos as $key => $algo)
				<tr id="{{{$algo}}}">
					<th>{{{++$key}}}</th>
					<td>{{{$algo}}}</td>
					<td>{{{$value = hash($algo, $query)}}}</td>
					<td>{{{strtoupper($value)}}}</td>
					<td>{{{strlen($value)}}}</td>
					<td>
						@if ($algo == 'md5')
							前16位：<br />小写：{{{substr($value, 0, 16)}}}<br />大写：{{{strtoupper(substr($value, 0, 16))}}}
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@stop