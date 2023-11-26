<?php

/**
 * 	[¡¾ÔÆÃ¨¡¿¶¶Òô½âÎöÊÓÆµ(ya_douyin)] (C)2019-2099 Powered by ÔÆÃ¨¹¤×÷ÊÒ.
 * 	Date: 2019-10-26 21:50
 *      File: admincp.func.php
 */
if (!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}

function ya_rmdir($dir)
{
    if ($dir === '.' || $dir === '..' || strpos($dir, '..') !== false) {
        return false;
    }
    if (substr($dir, -1) === "/") {
        $dir = substr($dir, 0, -1);
    }
    if (!file_exists($dir) || !is_dir($dir)) {
        return false;
    } elseif (!is_readable($dir)) {
        return false;
    } else {
        if (($dirobj = dir($dir))) {
            while (false !== ($file = $dirobj->read())) {
                if ($file != "." && $file != "..") {
                    $path = $dirobj->path . "/" . $file;
                    if (is_dir($path)) {
                        ya_rmdir($path);
                    } else {
                        if (is_file($path)) {
                            file_put_contents($path, '');
                            @unlink($path);
                        }
                    }
                }
            }
            $dirobj->close();
        }
        rmdir($dir);
        return true;
    }
    return false;
}


function ya_select($varname, $value, $extra = '')
{
    $s .= '<select name="' . $varname[0] . '" ' . $extra . '>';
    foreach ($varname[1] as $option) {
        if (!array_key_exists(0, $option)) {
            $option = array_values($option);
        }
        $selected = $option[0] == $value ? 'selected="selected"' : '';
        if (empty($option[2])) {
            $s .= "<option value=\"$option[0]\" $selected>" . $option[1] . "</option>\n";
        } else {
            $s .= "<optgroup label=\"" . $option[1] . "\"></optgroup>\n";
        }
    }
    $s .= '</select>';


    return $s;
}
