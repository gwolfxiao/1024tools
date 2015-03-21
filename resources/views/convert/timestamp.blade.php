@extends('layouts/main')
@section('pageTitle', 'UNIX时间戳转换、UNIX时间戳普通时间相互转换、unix timestamp转换')
@section('bodyClass', 'tools-timestamp')
@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-10"><h3>UNIX时间戳转换、UNIX时间戳普通时间相互转换、unix timestamp转换</h3></div>
	<div class="col-xs-12 col-sm-2">
		<dl class="list-unstyled pull-right">
		</dl>
	</div>
</div>
<div class="row">
	<div class="col-sm-8 col-md-6">
		<form class="form-horizontal">
			<div class="form-group mt15">
				<label class="col-xs-4 control-label">UNIX时间戳：</label>
				<div class="col-xs-8">
					<input type="text" class="form-control" id="timestamp" placeholder="时间戳" spellcheck="false">
				</div>
			</div>

			<div class="form-group mt15">
				<div class="col-xs-8 col-xs-offset-4">
					<button type="button" class="btn btn-primary" id="to_str">
						转换为普通时间 <span class="glyphicon glyphicon-arrow-down  glyphicon-align-right"></span>
					</button>
					<button type="button" class="btn btn-primary" id="to_timestamp">
						转换为UNIX时间戳 <span class="glyphicon glyphicon-arrow-up  glyphicon-align-right"></span>
					</button>
				</div>
			</div>

			<div class="form-group mt15">
				<label class="col-xs-4 control-label">普通时间：</label>
				<div class="col-xs-8 form-inline">
					<select class="form-control" id="timezone">
						<option value="-12">GMT -1200</option>
						<option value="-11">GMT -1100</option>
						<option value="-10">GMT -1000</option>
						<option value="-9">GMT -0900</option>
						<option value="-8">GMT -0800</option>
						<option value="-7">GMT -0700</option>
						<option value="-6">GMT -0600</option>
						<option value="-5">GMT -0500</option>
						<option value="-4">GMT -0400</option>
						<option value="-3">GMT -0300</option>
						<option value="-2">GMT -0200</option>
						<option value="-1">GMT -0100</option>
						<option value="0">GMT</option>
						<option value="1">GMT +0100</option>
						<option value="2">GMT +0200</option>
						<option value="3">GMT +0300</option>
						<option value="4">GMT +0400</option>
						<option value="5">GMT +0500</option>
						<option value="6">GMT +0600</option>
						<option value="7">GMT +0700</option>
						<option value="8" selected>GMT +0800</option>
						<option value="9">GMT +0900</option>
						<option value="10">GMT +1000</option>
						<option value="11">GMT +1100</option>
						<option value="11">GMT +1200</option>
					</select>
					<input type="text" class="form-control" id="datetimestr" placeholder="" spellcheck="false">
				</div>
			</div>
		</form>
	</div>
</div>
<div class="row">
	<div class="tips">
		<ul>
			<li>UNIX时间戳（unix time stamp）为世界协调时间（Coordinated Universal Time 即UTC）1970年01月01日00时00分00秒到现在的总秒数，跟时区无关。</li>
			<li>当前UNIX时间戳（基于浏览器时间）：<code id="current_timestamp">-</code> </li>
		</ul>
	</div>
</div>
@stop
@section('footer')
<script src="{{statics_path()}}/libs/datejs/date.js"></script>
<script type="text/javascript">
~function($, window, Math, Date) {
	$("#to_str").click(function(e){
		var timestamp = $.trim($("#timestamp").val()),
			timezone = $("#timezone").val();
		$("#datetimestr").val(to_str(timestamp, timezone))
	});

	$("#to_timestamp").click(function(e){
		var str = $.trim($("#datetimestr").val()),
			timezone = $("#timezone").val();
		$("#timestamp").val(to_timestamp(str, timezone))
	});

	// init
	var pause = false;
	$("#timestamp").val(getCurrentTimestamp());
	$("#timezone").val(getTimezone());

	$("#to_str").trigger('click');
	current_timestamp = $("#current_timestamp");
	var interval = window.setInterval(function(){
		if (!pause) {
			current_timestamp.text(getCurrentTimestamp());
		}
	}, 1000);
	current_timestamp.hover(function(){
		pause = true;
	}, function() {
		pause = false;
	})

	function to_timestamp(str, timezone) {
		var datetime = Date.parse(str);
		return Math.ceil(datetime.getTime()/1000) - (parseInt(timezone, 10) - getTimezone()) * 3600;
	}

	function to_str(timestamp, timezone) {
		var timestamp = (parseInt(timestamp, 10) + (parseInt(timezone, 10) - getTimezone()) * 3600) * 1000,
			datetime = new Date(timestamp),
			year = datetime.getFullYear(),
			month = datetime.getMonth(),
			date = datetime.getDate(),
			hour = datetime.getHours(),
			minute = datetime.getMinutes(),
			second = datetime.getSeconds();
		month = month < 9 ? "0" + (month + 1) : month + 1;
		date = date < 10 ? "0" + date : date;
		hour = hour < 10 ? "0" + hour : hour;
		minute = minute < 10 ? "0" + minute : minute;
		second = second < 10 ? "0" + second : second;
		return "" + year + "-" + month + "-" + date + " " + hour + ":" + minute + ":" + second;
	}

	function getCurrentTimestamp() {
		return Math.ceil((new Date()).getTime()/1000);
	}

	function getTimezone(){
		return -Math.floor((new Date()).getTimezoneOffset() / 60);
	}
}(jQuery, window, Math, Date)
</script>
@stop