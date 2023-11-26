<?php
function rand_in_str($txt,$insert){//txt 内容；insert要插入的关键字，可以是链接，数组
    //将内容拆分成数组，每个字符都是一个value，英文，中文，符号都算一个，只能在utf-8下中文才能拆分
    preg_match_all("/[\x01-\x7f]|[\xe0-\xef][\x80-\xbf]{2}/", $txt, $match);

    $delay=array();
    $add=0;
    //获取不能插入的位置索引号($delay 数组)，也就是< > 之间的位置
    foreach($match[0] as $k=>$v){
        if($v=='<') $add=1;
        if($add==1) $delay[]=$k;
        if($v=='>') $add=0;
    }

    $str_arr=$match[0];
    $len=count($str_arr);


    if(is_array($insert)){
        foreach($insert as $k=>$v){
            //获取随机插入的位置索引值
            $insertk=insertK($len-1,$delay);
            //循环将insert数据 拼接到 随机生成的索引
            $str_arr[$insertk].=$insert[$k];
        }
    }
    else{
        //获取随机插入的位置索引值
        $insertk=insertK($len-1,$delay);
        //循环将insert数据 拼接到 随机生成的索引
        $str_arr[$insertk].=$insert;
    }

    //合并插入 关键词后的数据，拼接成一段内容
    return join('',$str_arr);
}

function insertK($count,$delay){//count 随机索引值范围，也就是内容拆分成数组后的总长度-1；delay 不允许的随机索引值，也就是不能在 < > 之间
    $insertk=rand(0,$count);
    if(in_array($insertk,$delay)){//索引值不能在 不允许的位置处（也就是< > 之内的索引值）
        $insertk=insertK($count,$delay);//递归调用，直到随机插入的索引值不在 < > 这个索引值数组中
    }
    return $insertk;
}