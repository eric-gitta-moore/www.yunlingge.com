<?php
/**
 * 上传附件和上传视频
 * User: Jinqn
 * Date: 14-04-09
 * Time: 上午10:17
 */
include "Uploader.class.php";

/* 上传配置 */
$base64 = "upload";
switch (htmlspecialchars($_GET['action'])) {
    case 'uploadimage':
        $config = array(
            "pathFormat" => $CONFIG['imagePathFormat'],
            "maxSize" => $CONFIG['imageMaxSize'],
            "allowFiles" => $CONFIG['imageAllowFiles']
        );
        $fieldName = $CONFIG['imageFieldName'];
        break;
    case 'uploadscrawl':
        $config = array(
            "pathFormat" => $CONFIG['scrawlPathFormat'],
            "maxSize" => $CONFIG['scrawlMaxSize'],
            "allowFiles" => $CONFIG['scrawlAllowFiles'],
            "oriName" => "scrawl.png"
        );
        $fieldName = $CONFIG['scrawlFieldName'];
        $base64 = "base64";
        break;
    case 'uploadvideo':
        $config = array(
            "pathFormat" => $CONFIG['videoPathFormat'],
            "maxSize" => $CONFIG['videoMaxSize'],
            "allowFiles" => $CONFIG['videoAllowFiles']
        );
        $fieldName = $CONFIG['videoFieldName'];
        break;
    case 'uploadfile':
    default:
        $config = array(
            "pathFormat" => $CONFIG['filePathFormat'],
            "maxSize" => $CONFIG['fileMaxSize'],
            "allowFiles" => $CONFIG['fileAllowFiles']
        );
        $fieldName = $CONFIG['fileFieldName'];
        break;
}
$config['pathFormat'] = str_replace("{id}", $_GET['identifier'], $config['pathFormat']);
$config['pathFormat'] = str_replace("{mod}", $_GET['idtype'], $config['pathFormat']);

/* 生成上传实例对象并完成上传 */
$up = new Uploader($fieldName, $config, $base64);
$return = $image = $up->getFileInfo();

if ($image['state'] == 'SUCCESS') {
	$data = array(
		'uid' => $_G['uid'],
		'username' => $_G['username'],
		'identifier' => $_GET['identifier'],
		'idtype' => $_GET['idtype'],
		'idvalue' => $_GET['idvalue'],
		'filename' => $image['original'],
		'filetype' => $image['type'],
		'filesize' => $image['size'],
		'attachment' => $image['url'],
		'remote' => $image['remote'],
		'dateline' => time(),
	);


	if ($_GET['thumb_width'] && $_GET['thumb_height']) {
		require_once libfile('class/image');
		$thumb = new image();
		if ($thumb->Thumb($image['url'], '', $thumb_width, $thumb_height, 2)) {
			$data['thumb'] = 1;
		}
	}
	C::t('#wq_editor#wq_editor')->insert($data);
}
/* 返回数据 */
return json_encode($return);

/* 生成上传实例对象并完成上传 */

//if (getglobal('setting/ftp/on')) {
//    if (ftpcmd('upload', $type . '/' . $upload->attach['attachment'])) {
//        if ($result['thumb']) {
//            ftpcmd('upload', $type . '/' . getimgthumbname($upload->attach['attachment']));
//        }
//        ftpcmd('close');
//        $result['remote'] = 1;
//    } else {
//        if (getglobal('setting/ftp/mirror')) {
//            @unlink($upload->attach['target']);
//            @unlink(getimgthumbname($upload->attach['target']));
//            return array();
//        }
//    }
//}


/**
 * 得到上传文件所对应的各个参数,数组结构
 * array(
 *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
 *     "url" => "",            //返回的地址
 *     "title" => "",          //新文件名
 *     "original" => "",       //原始文件名
 *     "type" => ""            //文件类型
 *     "size" => "",           //文件大小
 * )
 */