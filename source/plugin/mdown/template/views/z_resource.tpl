<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="<%plugin_path%>/template/libs/mwt/4.0/mwt.min.css" type="text/css">
  <link rel="stylesheet" href="<%plugin_path%>/template/views/misadmin.css" type="text/css">
  <script src="<%plugin_path%>/template/libs/jquery/1.11.2/jquery.min.js" charset="utf-8"></script>
  <script src="<%plugin_path%>/template/libs/mwt/4.0/mwt.min.js" charset="utf-8"></script>
  <script src="<%plugin_path%>/template/libs/requirejs/2.1.9/require.js" charset="utf-8"></script>
  <script src="<%plugin_path%>/template/views/src/admincp.js" charset="utf-8"></script>
  <%js_script%>
  <script>
  var jq=jQuery.noConflict();
  jq(document).ready(function($) {
    admincp.forbidIE('grid-div');
	admincp.init('<%plugin_path%>/template/views/src/');
    admincp.run("resource");
  });
  var dz = {siteurl:'<%siteurl%>',pluginPath:'<%plugin_path%>',defaultIcon:'<%plugin_path%>'+"/template/static/word.png",sysimgs:[]};
  // 插件提供的图片
  var imgs = ["zip.png","word.png","ppt.png","excel.png","pdf.png","txt.png",
    "image.png","ttf.png","audio.png","video.png","flash.png",
    "data.png","disc.png","cloud.png","discuz.png"];
  for (var i=0;i<imgs.length;++i) {
    dz.sysimgs.push('<%plugin_path%>/template/static/'+imgs[i]);
  }
  // dz内置的一些图片
  if (v.sysimgs) {
    // 添加dz内置的一些图片
    for (var i=0;i<v.sysimgs.length;++i) {
      dz.sysimgs.push(v.sysimgs[i]);
    }
  }
  </script>
</head>
<body>
  <div id="grid-div"></div>
</body>
</html>
