@extends('layouts/main')
@section('pageTitle', 'php在线反序列化工具 unserialize serialize')
@section('bodyClass', 'tools-unserialize')
@section('content')
<div class="row ttitle clearfix">
    <div class="col-xs-12 col-sm-6"><h3>php在线反序列化工具 unserialize serialize</h3></div>
    <div class="col-xs-12 col-sm-6">
        <dl class="list-unstyled pull-right">
            
        </dl>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h4>输入需要反序列化的字符串：</h4>
        <div class="editor" id="input"></div>
    </div>
    <div class="col-md-6">
        <h4>输出结果：</h4>
        <div class="editor" id="output"></div>
    </div>
</div>
<div class="row mt10">
    <div class="col-md-6">
        <button type="button" class="btn btn-primary covert">反序列化</button>
    </div>
    <div class="col-md-6">
        <span class="powerby">
            php反序列化工具功能由@<a href="//1024tools.com">1024Tools</a>提供 编辑器由 @<a href="https://github.com/ajaxorg/ace" target="_blank">ace</a> 支持
        </span>
    </div>
</div>
<div class="mt10">
    <p id="msg"></p>
</div>
@stop

@section('footer')

<script src="{{statics_path()}}/libs/ace/ace.js"></script>
<script src="{{statics_path()}}/libs/xml/ObjTree.js"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});
</script>
<script>
var input = ace.edit("input"),
    output = ace.edit("output");

input.setShowPrintMargin(false)
input.setTheme("ace/theme/tomorrow_night")
output.setShowPrintMargin(false);
output.setTheme("ace/theme/tomorrow_night")

$('.covert').click(function(e){
    var inputdata = input.getValue();
    if (inputdata) {
        $.ajax({
            type: 'post',
            url: '{{{URL::route("convert.unserialize.post")}}}',
            data: {'query': inputdata},
            success: function(data) {
                if (data.status == 1) {
                    output.setValue(data.result);
                    output.clearSelection();
                    showmsg('success', '成功');
                } else {
                    showmsg('danger', data.error);
                }
            },
            error: function(){
                showmsg('danger', '网络错误');
            }
        })
    } else {
        showmsg('danger', '输入为空');
    }
    e.preventDefault();
});


function showmsg(type, msg) {
    $('#msg').removeClass("bg-danger").removeClass("bg-success").addClass("bg-"+type).text(msg);
}
</script>

@stop