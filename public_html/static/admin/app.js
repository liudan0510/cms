// 当前资源URL目录
/*var baseUrl = (function () {
    var scripts = document.scripts, src = scripts[scripts.length - 1].src;
    return src.substring(0, src.lastIndexOf("/") + 1);
})();*/

var baseUrl = '/static';

var icoSelectUrl = '/admin/public/ico';

var upfileUrl = '/admin/public/upfile';

// RequireJs 配置参数
require.config({
    baseUrl: baseUrl,
    waitSeconds: 0,
    map: {'*': {css: baseUrl + '/plugs/require/require.css.js'}},
    paths: {
        // 自定义插件（源码自创建或已修改源码）
        'admin.plugs': [baseUrl+'/admin/plugs'],
        'admin.listen': [baseUrl+'/admin/listen'],
        'layui': [baseUrl+'/plugs/layui/layui'],
        'ueditor': [baseUrl+'/plugs/ueditor/ueditor'],
        'template': [baseUrl+'/plugs/template/template'],
        'pcasunzips': [baseUrl+'/plugs/jquery/pcasunzips'],
        'laydate': [baseUrl+'/plugs/layui/laydate/laydate'],
        // 开源插件（未修改源码）
        'pace': [baseUrl+'/plugs/jquery/pace.min'],
        'json': [baseUrl+'/plugs/jquery/json2.min'],
        'print': [baseUrl+'/plugs/jquery/jquery.PrintArea'],
        'base64': [baseUrl+'/plugs/jquery/base64.min'],
        'jquery': [baseUrl+'/plugs/jquery/jquery.min'],
        'websocket': [baseUrl+'/plugs/socket/websocket'],
        'bootstrap': [baseUrl+'/plugs/bootstrap/js/bootstrap.min'],
        'jquery.ztree': [baseUrl+'/plugs/ztree/jquery.ztree.all.min'],
        'zeroclipboard': [baseUrl+'/plugs/ueditor/third-party/zeroclipboard/ZeroClipboard.min'],
        'jquery.cookies': [baseUrl+'/plugs/jquery/jquery.cookie'],
        'jquery.masonry': [baseUrl+'/plugs/jquery/masonry.min'],
    },
    shim: {
        'layui': {deps: ['jquery']},
        'laydate': {deps: ['jquery']},
        'bootstrap': {deps: ['jquery']},
        'pcasunzips': {deps: ['jquery']},
        'jquery.cookies': {deps: ['jquery']},
        'jquery.masonry': {deps: ['jquery']},
        'admin.plugs': {deps: ['jquery', 'layui']},
        'websocket': {deps: [baseUrl + '/plugs/socket/swfobject.min.js']},
        'admin.listen': {deps: ['jquery', 'jquery.cookies', 'admin.plugs']},
        'jquery.ztree': {deps: ['jquery', 'css!' + baseUrl + '/plugs/ztree/zTreeStyle/zTreeStyle.css']},
    },
    deps: ['css!' + baseUrl + '/plugs/awesome/css/font-awesome.min.css'],
    // 开启debug模式，不缓存资源
    urlArgs: "ver=" + (new Date()).getTime()
});

window.WEB_SOCKET_SWF_LOCATION = baseUrl + "/plugs/socket/WebSocketMain.swf";
window.UEDITOR_HOME_URL = (window.ROOT_URL ? window.ROOT_URL + '/static/' : baseUrl) + '/plugs/ueditor/';
window.LAYDATE_PATH = baseUrl + '/plugs/layui/laydate/';

// UI框架初始化
require(['pace', 'jquery', 'layui', 'bootstrap', 'jquery.cookies'], function () {
    layui.config({dir: baseUrl + '/plugs/layui/'});
    layui.use(['layer', 'form'], function () {
        window.layer = layui.layer;
        window.form = layui.form();
        require(['admin.listen']);
    });
});
