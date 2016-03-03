<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="dev@1024tools.com">
	<title>@yield('pageTitle', '1024tools') - {{ trans('site.name') }}</title>
	<script src="{{statics_path()}}/libs/pace/1.0.0/pace.min.js"></script>
	<link rel="shortcut icon" href="/favicon.ico" /> 
	<link rel="apple-touch-icon" href="{{statics_path()}}/images/icon_192.png" />
	<link rel="stylesheet" href="{{statics_path()}}/libs/bootstrap/customize/css/bootstrap.min.css" />
	<link rel="stylesheet" href="{{statics_path()}}/css/main.css?20160303" />
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="{{{URL::route('site.browserDetect')}}}"></script>
		<script src="{{statics_path()}}/libs/html5shiv/html5shiv.min.js"></script>
		<script src="{{statics_path()}}/libs/respond/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
		var site_config = {
			"tools_version": "0.0.8"
		};
	</script>
	@yield('header')
</head>
<body id="body" class="@yield('bodyClass', '')">
	<noscript><div class="noscript"></div></noscript>

	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="/" class="hidden-900 navbar-brand" title="1024程序员开发工具箱">1024Tools</a>
			</div>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="nav navbar-nav">
					<li class="dropdown visible-900" onmouseover="this.className='dropdown open'" onmouseout="this.className='dropdown'">
						<a href="/" class="dropdown-toggle navbar-brand" title="1024程序员开发工具箱">1024Tools</a>
						<ul class="dropdown-menu multi-column columns-3">
							<li>
								<div class="row">
									<div class="col-sm-4">
										<ul class="multi-column-dropdown">
											<li class="dropdown-header">编码/格式转换：</li>
											<li><a href="{{{URL::route('convert.base64')}}}">Base64编码解码</a></li>
											<li><a href="{{{URL::route('convert.urlencode')}}}">Url编码解码</a></li>
											<li><a href="{{{URL::route('convert.markdown')}}}">Markdown转HTML</a></li>
											<li><a href="{{{URL::route('convert.xmljson')}}}">XML/JSON互转</a></li>
											<li><a href="{{{URL::route('convert.less')}}}">LESS转CSS</a></li>
											<li><a href="{{{URL::route('convert.timestamp')}}}">UNIX时间戳转换</a></li>
											<li><a href="{{{URL::route('convert.unserialize')}}}">PHP反序列化</a></li>
											<li class="divider"></li>
											<li class="dropdown-header">加解密/HASH：</li>
											<li><a href="{{{URL::route('encrypt.hash')}}}">HASH计算/MD5/SHA1</a></li>
											<li><a href="{{{URL::route('encrypt.hmac')}}}">HMAC计算</a></li>
										</ul>
									</div>
									<div class="col-sm-4">
										<ul class="multi-column-dropdown">
											<li class="dropdown-header">格式化/压缩/混淆：</li>
											<li><a href="{{{URL::route('format.json')}}}">JSON格式化</a></li>
											<li><a href="{{{URL::route('format.sql')}}}">SQL格式化/压缩</a></li>
											<li><a href="{{{URL::route('format.highlight')}}}">代码高亮/着色/美化</a></li>
											<li class="divider"></li>
											<li class="dropdown-header">文档/手册：</li>
											<li><a href="{{{URL::route('manual.jquery')}}}">jQuery手册</a></li>
											<li><a href="{{{URL::route('manual.ascii')}}}">ASCII码表</a></li>
											<li><a href="{{{URL::route('manual.httpStatusCode')}}}">HTTP状态码</a></li>
										</ul>
									</div>
									<div class="col-sm-4">
										<ul class="multi-column-dropdown">
											<li class="dropdown-header">其它：</li>
											<li><a href="{{{URL::route('http.ip')}}}">IP地址查询</a></li>
											<li><a href="{{{URL::route('http.header')}}}">HTTP头查看</a></li>
											<li><a href="{{{URL::route('extra.random')}}}">随机数/密码生成</a></li>
											<li><a href="{{{URL::route('extra.uuid')}}}">UUID生成</a></li>
										</ul>
									</div>
								</div>
							</li>
						</ul>
					</li>
					<li class="dropdown" onmouseover="this.className='dropdown open'" onmouseout="this.className='dropdown'">
						<a href="javascript:" class="dropdown-toggle">热门工具<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{{URL::route('format.json')}}}">JSON格式化</a></li>
							<li><a href="{{{URL::route('convert.base64')}}}">Base64编码解码</a></li>
							<li><a href="{{{URL::route('convert.markdown')}}}">Markdown在线编辑器</a></li>
							<li><a href="{{{URL::route('extra.random')}}}">随机数/密码生成</a></li>
							<li><a href="{{{URL::route('http.ip')}}}">IP查询</a></li>
							<li><a href="{{{URL::route('format.highlight')}}}">代码高亮/着色/美化</a></li>
						</ul>
					</li>
					<li class="dropdown" onmouseover="this.className='dropdown open'" onmouseout="this.className='dropdown'">
						<a href="javascript:" class="dropdown-toggle">编码/格式转换<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{{URL::route('convert.base64')}}}">Base64编码解码</a></li>
							<li><a href="{{{URL::route('convert.urlencode')}}}">Url编码解码</a></li>
							<li><a href="{{{URL::route('convert.unserialize')}}}">PHP反序列化</a></li>
							<li class="divider"></li>
							<li><a href="{{{URL::route('convert.markdown')}}}">Markdown转HTML</a></li>
							<li><a href="{{{URL::route('convert.xmljson')}}}">XML/JSON互转</a></li>
							<li><a href="{{{URL::route('convert.less')}}}">LESS转CSS</a></li>
							<li class="divider"></li>
							<li><a href="{{{URL::route('convert.timestamp')}}}">UNIX时间戳转换</a></li>
						</ul>
					</li>
					<li class="dropdown" onmouseover="this.className='dropdown open'" onmouseout="this.className='dropdown'">
						<a href="javascript:" class="dropdown-toggle">格式化/压缩/混淆<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{{URL::route('format.json')}}}">JSON格式化</a></li>
							<li><a href="{{{URL::route('format.sql')}}}">SQL格式化/压缩</a></li>
							<li><a href="{{{URL::route('format.highlight')}}}">代码高亮/着色/美化</a></li>
						</ul>
					</li>
					<li class="dropdown" onmouseover="this.className='dropdown open'" onmouseout="this.className='dropdown'">
						<a href="javascript:" class="dropdown-toggle">加解密/HASH<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{{URL::route('encrypt.hash')}}}">HASH计算/MD5/SHA1</a></li>
							<li><a href="{{{URL::route('encrypt.hmac')}}}">HMAC计算</a></li>
						</ul>
					</li>
					<li class="dropdown" onmouseover="this.className='dropdown open'" onmouseout="this.className='dropdown'">
						<a href="javascript:" class="dropdown-toggle">文档/手册<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{{URL::route('manual.jquery')}}}">jQuery手册</a></li>
							<li><a href="{{{URL::route('manual.ascii')}}}">ASCII码表</a></li>
							<li><a href="{{{URL::route('manual.httpStatusCode')}}}">HTTP状态码</a></li>
						</ul>
					</li>
					<li class="dropdown" onmouseover="this.className='dropdown open'" onmouseout="this.className='dropdown'">
						<a href="javascript:" class="dropdown-toggle">其它<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="{{{URL::route('http.ip')}}}">IP地址查询</a></li>
							<li><a href="{{{URL::route('http.header')}}}">HTTP头查看</a></li>
							<li><a href="{{{URL::route('extra.random')}}}">随机数/密码生成</a></li>
							<li><a href="{{{URL::route('extra.uuid')}}}">UUID生成</a></li>
						</ul>
					</li>
				</ul>
				<form class="navbar-form navbar-left visible-1120">
					<div class="form-group">

						<input type="text" class="form-control typeahead" placeholder="试试快速导航">
					</div>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown" onmouseover="this.className='dropdown open'" onmouseout="this.className='dropdown'">
						<a href="javascript:" class="dropdown-toggle">#1024<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="https://github.com/cnxh/1024tools" target="_blank">Fork me on Github !</a></li>
							<li><a href="https://github.com/cnxh/1024tools/issues" target="_blank">bug/建议提交</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!--/.navbar-->

	<div id="content" class="container-fluid">
		@yield('content')
	</div>
	<!-- /.container -->
	@yield('modal')
	<script src="{{statics_path()}}/libs/jquery/1.11.1/jquery-1.11.1.min.js"></script>
	<script src="{{statics_path()}}/libs/bootstrap/customize/js/bootstrap.min.js"></script>
	<script src="{{{statics_path()}}}/libs/bootstrap3-typeahead/bootstrap3-typeahead.min.js"></script>
	<script src="{{statics_path()}}/js/main.js"></script>

	@yield('footer')

<div class="hidden">
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?c4ddd9b935fc38a7aa0448bc092ace0a";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</div>
</body>

</html>