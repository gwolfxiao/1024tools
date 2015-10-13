@extends('layouts/main')
@section('pageTitle', 'HTTP状态码、HTTP Status Code、HTTP常见状态码查询')

@section('content')
<div class="row ttitle">
	<div class="col-xs-12 col-sm-7"><h3>HTTP状态码、HTTP Status Code、HTTP常见状态码查询</h3></div>
	<div class="col-xs-12 col-sm-5">
		<dl class="list-unstyled pull-right">
			<dt>相关工具:</dt>
			<dd><a href="/ip">IP查询</a></dd>
			<dd><a href="/header">HTTP Headers查看</a></dd>
			<dt>文档:</dt>
			<dd><a href="/http-headers-docs">HTTP Headers各项含义</a></dd>
		</dl>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="10%">类别</th>
					<th>说明</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">1xx</th>
					<td>
						<p><b>1xx类型的状态码代表请求已被接受，需要继续处理。</b>这类响应是临时响应，只包含状态行和某些可选的响应头信息，并以空行结束。</p>
						<p><u>HTTP/1.0协议中没有定义任何1xx状态码</u>，所以除非在某些试验条件下，服务器禁止向此类客户端发送1xx响应。 这些状态码代表的响应都是信息性的，标示客户应该采取的其他行动。</p></td>
				</tr>
				<tr>
					<th scope="row">2xx</th>
					<td>
						<p><b>2xx类型的状态码代表请求已成功被服务器接收、理解、并接受。</b></p>
					</td>
				</tr>
				<tr>
					<th scope="row">3xx</th>
					<td>
						<p><b>3xx类型的状态码代表需要客户端采取进一步的操作才能完成请求。</b>
						<u>通常，这些状态码用来重定向</u>，后续的请求地址（重定向目标）在本次响应的Location域中指明。</p>
						<p>当且仅当后续的请求所使用的方法是GET或者HEAD时，用户浏览器才可以在没有用户介入的情况下自动提交所需要的后续请求。按照HTTP/1.0版规范的建议，浏览器不应自动访问超过5次的重定向。</p>
					</td>
				</tr>
				<tr>
					<th scope="row">4xx</th>
					<td>
						<p><b>4xx类型的状态码代表客户端看起来可能发生了错误</b>，妨碍了服务器的处理。</p>
					</td>
				</tr>
				<tr>
					<th scope="row">5xx</th>
					<td>
						<p><b>5xx类型的状态码代表服务器在处理请求的过程中有错误或者异常状态发生</b>，也有可能是服务器意识到以当前的软硬件资源无法完成对请求的处理。</p>
					</td>
				</tr>
			</body>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<h4 id="1xx" class="bg-success">常见的HTTP状态码</h4>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th width="20%">状态码</th>
					<th>说明</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">200 OK</th>
					<td><b>请求已成功</b> 请求所希望的响应头或数据体将随此响应返回</td>
				</tr>
				<tr>
					<th scope="row">206 Partial Content</th>
					<td><b>服务器已经成功处理了部分GET请求</b> <p>类似于FlashGet或者迅雷这类的HTTP 下载工具都是使用此类响应实现断点续传或者将一个大文档分解为多个下载段同时下载。</p>
						<p>该请求必须包含Range头信息来指示客户端希望得到的内容范围，并且可能包含If-Range来作为请求条件。</p>
						<p>响应必须包含如下的头部域：
							<ul>
								<li>Content-Range用以指示本次响应中返回的内容的范围；如果是Content-Type为multipart/byteranges的多段下载，则每一multipart段中都应包含Content-Range域用以指示本段的内容范围。假如响应中包含Content-Length，那么它的数值必须匹配它返回的内容范围的真实字节数。</li>
								<li>Date</li>
								<li>ETag和／或Content-Location，假如同样的请求本应该返回200响应。</li>
								<li>Expires, Cache-Control，和／或Vary，假如其值可能与之前相同变量的其他响应对应的值不同的话。</li>
							</ul>
						</p>
						<p>假如本响应请求使用了If-Range强缓存验证，那么本次响应不应该包含其他实体头；假如本响应的请求使用了If-Range弱缓存验证，那么本次响应禁止包含其他实体头；这避免了缓存的实体内容和更新了的实体头信息之间的不一致。否则，本响应就应当包含所有本应该返回200响应中应当返回的所有实体头部域。</p>
						<p>假如ETag或Last-Modified头部不能精确匹配的话，则客户端缓存应禁止将206响应返回的内容与之前任何缓存过的内容组合在一起。</p>
						<p>任何不支持Range以及Content-Range头的缓存都禁止缓存206响应返回的内容。</p>
					</td>
				</tr>
				<tr>
					<th scope="row">301 Moved Permanently</th>
					<td>
						<p><b>被请求的资源已永久移动到新位置</b>，并且将来任何对此资源的引用都应该使用本响应返回的若干个URI之一。如果可能，拥有链接编辑功能的客户端应当自动把请求的地址修改为从服务器反馈回来的地址。除非额外指定，否则这个响应也是可缓存的。</p>
						<p>新的永久性的URI应当在响应的Location域中返回。除非这是一个HEAD请求，否则响应的实体中应当包含指向新的URI的超链接及简短说明。</p>
						<p>如果这不是一个GET或者HEAD请求，因此浏览器禁止自动进行重定向，除非得到用户的确认，因为请求的条件可能因此发生变化。</p>
						<p>注意：对于某些使用HTTP/1.0协议的浏览器，当它们发送的POST请求得到了一个301响应的话，接下来的重定向请求将会变成GET方式。</p>
					</td>
				</tr>
				<tr>
					<th scope="row">302 Found</th>
					<td>
						<p><b>请求的资源现在临时从不同的URI响应请求。</b>由于这样的重定向是临时的，客户端应当继续向原有地址发送以后的请求。只有在Cache-Control或Expires中进行了指定的情况下，这个响应才是可缓存的。</p>
						<p>新的临时性的URI应当在响应的Location域中返回。除非这是一个HEAD请求，否则响应的实体中应当包含指向新的URI的超链接及简短说明。</p>
						<p>如果这不是一个GET或者HEAD请求，那么浏览器禁止自动进行重定向，除非得到用户的确认，因为请求的条件可能因此发生变化。</p>
					</td>
				</tr>
				<tr>
					<th scope="row">304 Not Modified</th>
					<td><b></b></td>
				</tr>
				<tr>
					<th scope="row">400 Bad Request</th>
					<td><b></b></td>
				</tr>
				<tr>
					<th scope="row">401 Unauthorized</th>
					<td><b></b></td>
				</tr>
				<tr>
					<th scope="row">403 Forbidden</th>
					<td><b></b></td>
				</tr>
				<tr>
					<th scope="row">404 Not Found</th>
					<td><b></b></td>
				</tr>
				<tr>
					<th scope="row">405 Method Not Allowed</th>
					<td><b></b></td>
				</tr>
				<tr>
					<th scope="row">500 Internal Server Error</th>
					<td><b></b></td>
				</tr>
				<tr>
					<th scope="row">502 Bad Gateway</th>
					<td><b></b></td>
				</tr>
				<tr>
					<th scope="row">503 Service Unavailable</th>
					<td><b></b></td>
				</tr>
				<tr>
					<th scope="row">504 Gateway Timeout</th>
					<td><b></b></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@stop