@extends('layouts/main')
@section('pageTitle', 'IP查询、IP地址查询、IP归属地查询')
@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-4"><h3>IP查询、IP地址查询、IP归属地查询</h3></div>
	<div class="col-xs-12 col-sm-8">
		<dl class="list-unstyled pull-right">
			<dt>相关工具：</dt>
			<dd><a href="/ip">查询自己的IP</a></dd>
			<dd><a href="/header">HTTP Header头查看</a></dd>
			<!-- <dt>文档：</dt>
			<dd><a href="/openapi#ip">收集的IP常用API</a></dd> -->
		</dl>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<h4 style="float:left">当前查询的IP: {{{$ip}}}</h4>
		<form id="form" class="form-inline" style="margin:5px 0 15px 10px;float:left;">
			<input type="text" class="form-control" id="query" placeholder="输入其他IP查询">
			<button type="submit" class="btn btn-primary"> 点击查询 </button>
			<span id="message" class="text-warning"></span>
		</form>
	</div>
</div>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="5%">#</th>
			<th width="10%">查询源</th>
			<th width="10%">国家</th>
			<th width="28%">地区</th>
			<th width="15%">ISP</th>
			<th width="15%">经纬度</th>
			<th width="27%">备注</th>
		</tr>
	</thead>
	<tbody>
		<tr id="sina">
			<th scope="row">1</th>
			<td class="source"><a href='{{{$apis["sina"]}}}{{{$ip}}}' target="_blank">新浪</a></td>
			<td class="country">loading</td>
			<td class="address">loading</td>
			<td class="isp">loading</td>
			<td class="latlon">loading</td>
			<td class="remark">loading</td>
		</tr>
		<tr id="taobao">
			<th scope="row">2</th>
			<td class="source"><a href='{{{$apis["taobao"]}}}{{{$ip}}}' target="_blank">淘宝</a></td>
			<td class="country">loading</td>
			<td class="address">loading</td>
			<td class="isp">loading</td>
			<td class="latlon">loading</td>
			<td class="remark">loading</td>
		</tr>
		<tr id="dangdang">
			<th scope="row">3</th>
			<td class="source"><a href='{{{$apis["dangdang"]}}}{{{$ip}}}' target="_blank">当当</a></td>
			<td class="country">loading</td>
			<td class="address">loading</td>
			<td class="isp">loading</td>
			<td class="latlon">loading</td>
			<td class="remark">loading</td>
		</tr>
		<tr id="ip_api">
			<th scope="row">4</th>
			<td class="source"><a href='{{{$apis["ip_api"]}}}{{{$ip}}}' target="_blank">IP-API.COM</a></td>
			<td class="country">loading</td>
			<td class="address">loading</td>
			<td class="isp">loading</td>
			<td class="latlon">loading</td>
			<td class="remark">loading</td>
		</tr>
	</tbody>
</table>
@stop

@section('footer')
<script>
$("#form").submit(function(e){
	var query = $.trim($('#query').val());
	if (/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/.test(query)) {
		$('#message').text('');
		location.href="/ip/"+query
	} else {
		$('#message').text('IP输入有误')
		$("#query").focus()
	}
	e.preventDefault()
});

function show_result(source, data){
	source.children('.country').text(data.country);
	source.children('.address').text(data.address);
	source.children('.isp').text(data.isp);
	source.children('.latlon').text(data.latlon);
	source.children('.remark').text(data.remark);
}
function ip_api(result){
	var data = {"country":"","address":"","isp":"","remark":"","latlon":""}
	if (result.status == 1) {
		if (result.data.status == 'fail') {
			data.remark = result.data.message
		} else if (result.data.status == 'success') {
			data.country = result.data.country ? result.data.country : ''
			data.address = result.data.regionName ? result.data.regionName : ''
			data.address += result.data.city ? ' ' + result.data.city : ''
			data.isp = result.data.isp ? result.data.isp : ''
			data.remark = result.data.as ? result.data.as : ''
			data.remark += result.data.org ? ' ' + result.data.org : ''
			data.latlon = (result.data.lat && result.data.lon) ? (result.data.lat + ',' + result.data.lon) : ''
		}
	}
	show_result($('#ip_api'), data);
}

function sina(result) {
	var data = {"country":"","address":"","isp":"","remark":"","latlon":""}
	if (result.status == 1) {
		if (result.data.ret == 1) {
			var returndata = result.data;
			data.country = returndata.country ? returndata.country : ''

			data.address = returndata.province ? returndata.province : ''
			data.address += returndata.city ? ' ' + returndata.city : ''
			data.address += returndata.district ? ' ' + returndata.district : ''

			data.isp = returndata.isp ? returndata.isp : ''
			data.remark += returndata.desc ? ' ' + returndata.desc : ''
			data.remark += returndata.type ? ' ' + returndata.type : ''
		}
	}
	show_result($('#sina'), data);
}

function taobao(result) {
	var data = {"country":"","address":"","isp":"","remark":"","latlon":""}
	if (result.status == 1) {
		if (result.data.code == 0) {
			var returndata = result.data.data;
			data.country = returndata.country ? returndata.country : ''

			data.address = returndata.area ? returndata.area : ''
			data.address += returndata.region ? ' ' + returndata.region : ''
			data.address += returndata.city ? ' ' + returndata.city : ''
			data.address += returndata.county ? ' ' + returndata.county : ''

			data.isp = returndata.isp ? returndata.isp : ''
		}
	}
	show_result($('#taobao'), data);
}

function dangdang(result) {
	var data = {"country":"","address":"","isp":"","remark":"","latlon":""}
	if (result.status == 1) {
		if (result.data.ReturnCode == 0) {
			$.each(result.data.LocInfo.Loc, (function(i){
				if (i == 0) {
					data.country = result.data.LocInfo.Loc[i]
				} else {
					if (!$.isNumeric(result.data.LocInfo.Loc[i])) {
						data.address += " " + result.data.LocInfo.Loc[i]
					}
				}
			}))
			data.address = $.trim(data.address)
		}
	}
	show_result($('#dangdang'), data);
}

</script>
<script async="async" src="{{URL::route('http.ip.proxy.ipapi')}}?ip={{{$ip}}}&callback=ip_api"></script>
<script async="async" src="{{URL::route('http.ip.proxy.sina')}}?ip={{{$ip}}}&callback=sina"></script>
<script async="async" src="{{URL::route('http.ip.proxy.taobao')}}?ip={{{$ip}}}&callback=taobao"></script>
<script async="async" src="{{URL::route('http.ip.proxy.dangdang')}}?ip={{{$ip}}}&callback=dangdang"></script>
@stop