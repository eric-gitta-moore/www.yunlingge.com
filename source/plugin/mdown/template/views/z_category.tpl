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
    admincp.run("category");
	//console.log(mwt);
  });
  </script>
</head>
<body>
  <div id="msg-div" class="err"></div>
  <div id="grid-div" class="fill-layout"></div>
</body>
</html>
