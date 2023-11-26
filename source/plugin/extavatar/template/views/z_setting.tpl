<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="<%plugin_path%>/template/libs/mwt/4.0/mwt.min.css" type="text/css">
  <link rel="stylesheet" href="<%plugin_path%>/template/views/misadmin.css" type="text/css">
  <script src="<%plugin_path%>/template/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="<%plugin_path%>/template/libs/mwt/4.0/mwt.min.js"></script>
  <%js_script%>
  <script>
    function showErrtips() {
        var ls = [];
        for (var i=0;i<v.errtips.length;++i) {
            ls.push('<li class="err">'+v.errtips[i]+'</li>');
        }
        jQuery('#lis').append(ls.join(''));
    }

    var jq=jQuery.noConflict();
    jq(document).ready(function($) {
        showErrtips();
        jQuery("input[name=scope][value="+v.scope+"]").attr("checked",true);
        jQuery("input[name=strategy][value="+v.strategy+"]").attr("checked",true);
    });
  </script>
</head>
<body>
  <form method="post" action="admin.php?action=plugins&operation=config&identifier=extavatar&pmod=z_setting">
  <!-- 使用提示 -->
  <table class="tb tb2">
    <tr><th colspan="15" class="partition">使用提示</th></tr>
    <tr><td class="tipsblock" s="1">
      <ul id="lis">
        <li>本插件用于用户头像增强</li>
        <li>头像图片存放路径：source/plugin/extavatar/data/avatars/ </li>
        <li>可以替换自带图片文件，但不支持增加或删除文件</li>
      </ul>
    </td></tr>
  </table>
  <!-- 设置 -->
  <table class="tb tb2">
    <tr><th colspan="15" class="partition">设置</th></tr>
    <tr>
      <td width='90'>用户范围：</td>
      <td width='500'>
	    <label><input name="scope" type="radio" value="1"> 未设置过头像的用户</label>
        &nbsp;&nbsp;
	    <label><input name="scope" type="radio" value="2"> 全部用户</label>
      </td>
      <td class='tips2'></td>
    </tr>
	<tr>
	  <td>头像策略：</td>
      <td>
          <label><input name="strategy" type="radio" value="1"> 随机头像
              <span class="tips2">（从头像库中随机选择一个头像分配给用户）</span>
          </label><br>
          <label><input name="strategy" type="radio" value="2"> 首字头像
              <span class="tips2">（根据用户名首字生成头像）</span>
          </label>
      </td>
	  <td class='tips2'></td>
	</tr>
    <tr>
      <td colspan="3">
		<input type="hidden" id="reset" name="reset" value="0"/>
        <input type="submit" id='subbtn' class='btn' value="保存设置"/>
        &nbsp;&nbsp;
		<input type="submit" class='btn' onclick="jQuery('#reset').val(1);" value="恢复默认设置"/>
      </td>
    </tr>
  </table>
  </form>
</body>
</html>
