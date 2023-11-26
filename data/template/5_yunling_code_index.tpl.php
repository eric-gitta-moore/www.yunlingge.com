<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $desc;?>"/>
    <meta name="keywords" content="<?php echo $keywords;?>"/>
    <link href='<?php echo $static;?>/css/ad90f9b8861d47169f8e1dfa1f2e3e00.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo $static;?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $static;?>/css/animate.css">
    <link rel="stylesheet" href="<?php echo $static;?>/css/style.css">
    <!-- Modernizr JS -->
    <script src="<?php echo $static;?>/js/modernizr-2.6.2.min.js" type="text/javascript"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="<?php echo $static;?>/js/respond.min.js" type="text/javascript"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!-- Start Sign In Form -->
            <form class="fh5co-form animate-box" style="border-radius:20px;">
                <h2><?php echo $config['nav_title'];?></h2>
                <div class="alert alert-info text-center" role="alert">
                    <?php echo $config['tips'];?>
                </div>
                <a id="zfb" class="btn btn-warning btn-block" <?php if(empty($config['zfb'])) { ?>disabled<?php } ?>>支付宝</a><p/><p/>
                <a id="wx" class="btn btn-info btn-block" <?php if(empty($config['wx'])) { ?>disabled<?php } ?>>微信</a><p/>
                <a id="qq" class="btn btn-success btn-block" <?php if(empty($config['qq'])) { ?>disabled<?php } ?>>QQ</a><p/>
                <a id="cft" class="btn btn-danger btn-block" <?php if(empty($config['cft'])) { ?>disabled<?php } ?>>财付通</a><p/>
                <div class="form-group text-center">
                    <p><a href="<?php echo $_G['setting']['siteurl'];?>"><?php echo $_G['setting']['sitename'];?></a>
                    </p>
                </div>
            </form>
            <!-- END Sign In Form -->
        </div>
    </div>
    <div class="row" style="padding-top: 60px; clear: both;">
        <div class="col-md-12 text-center">
            <p>
                <small>Copyright &copy; <?php echo date('Y');?> <a href="http://www.yunlingge.com/">云凌工作室</a> All Rights Reserved.</small>
            </p>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="<?php echo $static;?>/js/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="<?php echo $static;?>/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Placeholder -->
<script src="<?php echo $static;?>/js/jquery.placeholder.min.js" type="text/javascript"></script>
<!-- Waypoints -->
<script src="<?php echo $static;?>/js/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?php echo $static;?>/layer/layer.js" type="text/javascript"></script>
<!-- Main JS -->
<script src="<?php echo $static;?>/js/main.js" type="text/javascript"></script>

<script>
    <?php if(!empty($config['zfb'])) { ?>
    $('#zfb').on('click', function(){
        layer.open({
            type: 1,
            title: '支付宝',
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area : ['<?php echo $width;?>px' , '<?php echo $height;?>px'],
            content: '<!doctype html><html><head><meta charset="utf-8"></head><body style="text-align: center;"><img style="height:100%;width:100%" id="bg" src="<?php echo $config['zfb'];?>" /></body></html>'
        });
    });
    <?php } ?>

    <?php if(!empty($config['qq'])) { ?>
    $('#qq').on('click', function(){
        layer.open({
            type: 1,
            title: 'QQ',
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area : ['<?php echo $width;?>px' , '<?php echo $height;?>px'],
            content: '<!doctype html><html><head><meta charset="utf-8"></head><body style="text-align: center;"><img style="height:100%;width:100%" id="bg" src="<?php echo $config['qq'];?>" /></body></html>'
        });
    });
    <?php } ?>

    <?php if(!empty($config['wx'])) { ?>
    $('#wx').on('click', function(){
        layer.open({
            type: 1,
            title: '微信',
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area : ['<?php echo $width;?>px' , '<?php echo $height;?>px'],
            content: '<!doctype html><html><head><meta charset="utf-8"></head><body style="text-align: center;"><img style="height:100%;width:100%" id="bg" src="<?php echo $config['wx'];?>" /></body></html>'
        });
    });
    <?php } ?>

    <?php if(!empty($config['cft'])) { ?>
    $('#cft').on('click', function(){
        layer.open({
            type: 1,
            title: '财付通',
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area : ['<?php echo $width;?>px' , '<?php echo $height;?>px'],
            content: '<!doctype html><html><head><meta charset="utf-8"></head><body style="text-align: center;"><img style="height:100%;width:100%" id="bg" src="<?php echo $config['cft'];?>" /></body></html>'
        });
    });
    <?php } ?>
</script>
</body>
</html><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>