<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

function getehtm($etxt,$ecolortype) //主程序,获取到易语言代码,生成易html代码
	{
	//global $_G; //全局变量
	global $parharr,$ecolormod;//定义全局线条数组  和  代码样式 1-10
	$ecolormod=$ecolortype;// 给全局变量 颜色种类  赋值
	$parharr=array();
	
	$libarr=array(); //初始化支持库数组
	$ehtm='';//初始化html代码
	$he=0; //初始化是否头部,0为否  1为子程序  2为局部变量 3为程序集 4为DLL命令和参数  5为图片  6为全局变量 7为声音  8为自定义数据类型  9为常量 10程序集变量 11子程序参数 
	$ii=0;//初始化循环统计,  用来统计大循环循环到第几个 
	
	$earr=explode("\n",$etxt);//按行分割
	foreach ($earr as $value) //遍历数组,开始循环
{
	$value=getspace($value);//去首尾空和单行换行符 这里第二版本需要加个判断,如果是循环或者判断之类的,前面的空格不去除. 根据$he判断当前是否在嵌套之内
	
	//判断和如果的转折点
	if(end($parharr)=='PDKS' || end($parharr)=='PDPD' || end($parharr)=='RG'){
	$tempii=1;//初始临时计次
	while(count($earr) > $tempii+$ii)//如果总的数组...
	{
	if($earr[$tempii+$ii]==''){
		$tempii++;
		}else 
		break;
	
	}//循环完毕
	//  这里需要把所有当行内容  去掉首空
	if(count($earr) > $tempii+$ii){//如果这个数组存在
		if(end($parharr)=='PDKS'){
			if(strpos(ltrim($earr[$tempii+$ii]),'.判断 (')===0 || strpos(ltrim($earr[$tempii+$ii]),'.判断(')===0 || getspace(ltrim($earr[$tempii+$ii]))=='.默认'){
			array_pop($parharr);
			$parharr[]='PDZZ';
			}
			
			}elseif(end($parharr)=='PDPD'){
				if(getspace(ltrim($earr[$tempii+$ii]))=='.默认'){
			array_pop($parharr);
			$parharr[]='PDPDZZ';
				}
			
				}elseif(end($parharr)=='RG'){
					if(getspace(ltrim($earr[$tempii+$ii]))=='.否则'){
					array_pop($parharr);
					$parharr[]='RGZZ';
					}
					}
	}
	}elseif(count($parharr) >=2 && count($earr)>$ii+1){//如果转折处在倒数第二个数组成员里面
		if($parharr[count($parharr)-2]=='PDKS'){
				if(strpos(ltrim($earr[$ii+1]),'.判断 (')===0 || strpos(ltrim($earr[$ii+1]),'.判断(')===0 || getspace(ltrim($earr[$ii+1]))=='.默认'){
					if(end($parharr)=='RGJS' || end($parharr)=='PDJS' || end($parharr)=='RGZWB'){					
					$parharr[count($parharr)-2]='PDZZ';	
					}elseif(strpos(ltrim($value),'.计次循环尾')===0 || strpos(ltrim($value),'.判断循环尾')===0  || strpos(ltrim($value),'.循环判断尾')===0 || strpos(ltrim($value),'.变量循环尾')===0){
						$parharr[count($parharr)-2]='PDZZtwo';
						}
				}
		
		}elseif($parharr[count($parharr)-2]=='PDPD'){
			if(strpos(ltrim($earr[$ii+1]),'.判断 (')===0 || strpos(ltrim($earr[$ii+1]),'.判断(')===0 || getspace(ltrim($earr[$ii+1]))=='.默认'){
				if(end($parharr)=='RGJS' || end($parharr)=='PDJS' || end($parharr)=='RGZWB'){
				$parharr[count($parharr)-2]='PDPDZZ';
				}elseif(strpos(ltrim($value),'.计次循环尾')===0 || strpos(ltrim($value),'.判断循环尾')===0  || strpos(ltrim($value),'.循环判断尾')===0 || strpos(ltrim($value),'.变量循环尾')===0){
					$parharr[count($parharr)-2]='PDPDZZtwo';
					}
			}  //测试判断一下 如果真 
			}elseif($parharr[count($parharr)-2]=='RG'){
				if(getspace(ltrim($earr[$ii+1]))=='.否则'){
					if(end($parharr)=='RGJS' || end($parharr)=='PDJS' || end($parharr)=='RGZWB'){
					$parharr[count($parharr)-2]='RGZZ';					
					}elseif(strpos(ltrim($value),'.计次循环尾')===0 || strpos(ltrim($value),'.判断循环尾')===0  || strpos(ltrim($value),'.循环判断尾')===0 || strpos(ltrim($value),'.变量循环尾')===0){
						$parharr[count($parharr)-2]='RGZZtwo';
						}
					} 
				}
	}
	
	$ii++;//总的计次循环次数统计
	//判断和如果的转折点完毕
	
	
	if($value == '' && count($parharr)>0) {  
             $ehtm.=getepillar();             
		}elseif($value != ''){
							  							  
if(strlen($value)<=9 && strpos($value,'.版本 ')===0) 
{
	//$elast=$value; //把本次的赋值
	continue; //如果是开头标识,那么跳过
}

/*
elseif($value=='') //如果当前为空行
{
	if(strlen($elast)<=9 && strpos($elast,'.版本 ')===0){ //如果上一行是标识,那么本次跳过
		$elast=$value; //把本次的赋值
		continue; //如果是开头标识,那么跳过
			}
	elseif($elast==''){	//如果上一行也是空行,那么本次跳过(此判断将把素有空格两行以上的清除)
		$elast=$value; //把本次的赋值
		continue; //如果是开头标识,那么跳过		
		}
	elseif(1==1){
			
			
			}
}
*/
elseif(strpos($value,'.常量 ')===0){ //常量生成显示
$ehtm.=getcodem($value,$he);
	$he=9;//表示当前为常量 
}//常量表格生成完毕
elseif(strpos($value,'.数据类型 ')===0){ //数据类型生成显示
$ehtm.=getcodek($value,$he);
	$he=8;//表示当前为数据类型 
}//数据类型表格生成完毕
elseif(strpos($value,'    .成员 ')===0){ //数据类型成员生成显示
$ehtm.=getcodel($value,$he);
	$he=8;//表示当前为数据类型成员 
}//数据类型表格生成完毕
elseif(strpos($value,'.声音 ')===0){ //声音生成显示
$ehtm.=getcodej($value,$he);
	$he=7;//表示当前为声音 
}//声音表格生成完毕
elseif(strpos($value,'.全局变量 ')===0){ //全局变量生成显示
$ehtm.=getcodei($value,$he);
	$he=6;//表示当前为全局变量
}//全局变量生成完毕
elseif(strpos($value,'.图片 ')===0){ //图片生成显示
$ehtm.=getcodeh($value,$he);
	$he=5;//表示当前为图片 
}//图片表格生成完毕
elseif(strpos($value,'.DLL命令 ')===0){ //DLL生成显示
$ehtm.=getcodef($value,$he);
	$he=4;//表示当前为DLL程序 
}//DLL主程序生成完毕
elseif(strpos($value,'    .参数 ')===0){ //取出DLL参数
	$ehtm.=getcodeg($value,$he);
	$he=4;//表示当前为DLL程序
}//取出DLL参数完毕
elseif(strpos($value,'.支持库 ')===0){ //取出支持库文本
	$libarr[]=substr($value,strlen('.支持库 '));//将支持库加入数组
}//取出支持库文本完毕
elseif(strpos($value,'.子程序 ')===0){ //子程序生成显示
$ehtm.=getcodee($value,$he);
	$he=1;//表示当前为子程序 
}//子程序集生成htm完毕
elseif(strpos($value,'.参数 ')===0){ //子程序参数判断 
$ehtm.=getcoded($value,$he);
	$he = 11;
} //子程序参数判断完毕
elseif(strpos($value,'.局部变量 ')===0){ //局部变量
$ehtm.=getcodec($value,$he);
	$he=2;//表示当前为局部变量
}//局部变量完毕
elseif(strpos($value,'.程序集 ')===0){ //程序集
	$ehtm.=getcodeb($value,$he);
	$he=3;//表示当前为程序集
}//程序集完毕
elseif(strpos($value,'.程序集变量 ')===0){ //程序集变量
	$ehtm.=getcodea($value,$he);
	$he=10;//赋值
}//程序集变量完毕

else {
   	if($he!=0){
	$ehtm=$ehtm.'</table>';
	$he=0;
	}//如果仅仅是头部表格,那么在最后一行加一个表格结尾
	
	$ehtm=$ehtm.geteyycode($value); //此处本来有个  .'<br>'    移到子程序内
	
}
	
	
} //判断空行==''完毕,后续版本需要修改
}//数组循环完毕
	
	if($he!=0)
	$ehtm=$ehtm.'</table>'; //如果最后一行没有封口,那么封起来
	
	$ehtm.=endelineimg($parharr,$ehtm); //完结所有的线条图片
	$parharr=array();//清空线条数组
	
	$ehtm=count($libarr)>0 ? $ehtm.getelib($libarr):$ehtm;//生成支持库表格
	
	return $ehtm; //返回html代码
}//主程序完毕


function getcodem($value,$he){ //常量表格生成完毕
	if($he!=0 && $he!=9) //有东西 但又不是常量
	$ehtm=$ehtm.'</table>';
	if($he!=9){
		$ehtm.='<table border="1" cellspacing="0" style="table-layout:auto;border-width: 0px; margin-top: 4px; width:0px;"><tr><td class="eHeadercolor Rowheight">常量名称</td><td class="eHeadercolor Rowheight">常量值</td><td class="eHeadercolor Rowheight">公 开</td><td class="eHeadercolor Rowheight">备 注</td></tr>';
	}
	
	$ehtm=$ehtm.'<tr><td class="eOthercolor Rowheight">';
  	$value=substr($value,strlen('.常量 '));//去除前面的标识      子程序变量2, 整数型, 静态, "33", 测试7
	$temparr=explode(', ',$value);//根据 ,  来分割
		
	$ehtm=$ehtm.$temparr['0'].'</td><td class="Constanttext Rowheight">';//第一个  变量名  /不管有没有,都有一个数组成员
	$ehtm.=count($temparr)>1 ? (getSubstr($temparr['1'],'&quot;','&quot;')):'&nbsp;';//第二个 类型  不存在就返回空
	$ehtm.='</td><td class="Rowheight eTickcolor" align="center">';
	$ehtm.=count($temparr)>2 ? ($temparr['2']=='公开'?'√':'&nbsp;'):'&nbsp;'; //第三个 传址
	$ehtm.='</td><td colspan="3" class="Remarkscolor Rowheight">';
	//$ehtm.=count($temparr)>3 ? (getSubstr($temparr['3'],'&quot;','&quot;')):'&nbsp;'; //第四个 数组成员数
	$ehtm.=count($temparr)>3 ? (substr($value,strlen($temparr['0'].$temparr['1'].$temparr['2'])+6)):''; //第五个 备注
	$ehtm.='</td></tr>';	
	
	return $ehtm;
}//常量表格生成完毕



function getcodel($value,$he){//数据类型成员表格
if($he!=0 && $he!=8) //有东西 但又不是自定义数据类型
	$ehtm=$ehtm.'</table>';
	
	if($he!=8){ //判断是否第一次加载
	$ehtm=$ehtm.'<table border="1" cellspacing="0" style="table-layout:auto;border-width: 0px; margin-top: 4px; width:0px;"><tr><td class="eHeadercolor Rowheight">数据类型名</td><td class="eHeadercolor Rowheight">公开</td><td colspan="3" class="eHeadercolor Rowheight">备 注</td></tr><tr><td class="Wrongcolor Rowheight">(未定义数据类型名)</td><td class="Rowheight">&nbsp;</td><td colspan="3" class="Rowheight">&nbsp;</td></tr><tr><td class="eHeadercolor Rowheight">成员名</td><td class="eHeadercolor Rowheight">类 型</td><td class="eHeadercolor Rowheight">传址</td><td class="eHeadercolor Rowheight">数组</td><td class="eHeadercolor Rowheight">备 注 </td></tr>';	
		}
		
	$ehtm=$ehtm.'<tr><td class="Variablescolor Rowheight">';
  	$value=substr($value,strlen('    .成员 '));//去除前面的标识      子程序变量2, 整数型, 静态, "33", 测试7
		$temparr=explode(', ',$value);//根据 ,  来分割
		
		$ehtm=$ehtm.$temparr['0'].'</td><td class="eTypecolor Rowheight">';//第一个  变量名  /不管有没有,都有一个数组成员
		$ehtm.=count($temparr)>1 ? $temparr['1']:'&nbsp;';//第二个 类型  不存在就返回空
		$ehtm.='</td><td class="Rowheight eTickcolor" align="center">';
		$ehtm.=count($temparr)>2 ? ($temparr['2']=='传址'?'√':'&nbsp;'):'&nbsp;'; //第三个 传址
		$ehtm.='</td><td class="eArraycolor Rowheight">';
		$ehtm.=count($temparr)>3 ? (getSubstr($temparr['3'],'&quot;','&quot;')):'&nbsp;'; //第四个 数组成员数
		$ehtm.='</td><td colspan="3" class="Remarkscolor Rowheight">';
		$ehtm.=count($temparr)>4 ? (substr($value,strlen($temparr['0'].$temparr['1'].$temparr['2'].$temparr['3'])+8)):''; //第五个 备注
		$ehtm.='</td></tr>';	
		
		return $ehtm;
}//数据类型成员 表格完毕


function getcodek($value,$he){//数据类型头部表格
if($he != 0){
	$ehtm=$ehtm.'</table>';
	}
	$ehtm.='<table border="1" cellspacing="0" style="table-layout:auto;border-width: 0px; margin-top: 4px; width:0px;"><tr><td class="eHeadercolor Rowheight">数据类型名</td><td class="eHeadercolor Rowheight">公开</td><td colspan="3" class="eHeadercolor Rowheight">备 注</td></tr>';

	$value=substr($value,strlen('.数据类型 '));//去除前面的标识
	$temparr=explode(', ',$value);//根据 ,  来分割
	$ehtm=$ehtm.'<tr><td class="eProcolor Rowheight">';
	$ehtm=$ehtm.$temparr['0'].'</td><td class="Rowheight eTickcolor" align="center">';//第一个/不管有没有,都有一个数组成员
		
	$ehtm.=count($temparr)>1 ? (is_int(strpos($temparr['1'],'公开'))?'√':'&nbsp;'):'&nbsp;'; //第二个 公开
	$ehtm.='</td><td colspan="3" class="Remarkscolor Rowheight">';
	$ehtm.=count($temparr)>2 ? (substr($value,strlen($temparr['0'].$temparr['1'])+4)):''; //第三个 备注
	$ehtm.='</td></tr><tr><td class="eHeadercolor Rowheight">成员名</td><td class="eHeadercolor Rowheight">类 型</td><td class="eHeadercolor Rowheight">传址</td><td class="eHeadercolor Rowheight">数组</td><td class="eHeadercolor Rowheight">备 注 </td></tr>';

return $ehtm;
}//数据类型头部表格生成完毕





function getcodej($value,$he){//声音表格表格
if($he != 0 && $he!=7){
	$ehtm=$ehtm.'</table>';
	}
	if($he !=7){
		$ehtm.='<table border="1" cellspacing="0" style="table-layout:auto;border-width: 0px; margin-top: 4px; width:0px;"><tr><td class="eHeadercolor Rowheight">声音名称</td><td class="eHeadercolor Rowheight">内容</td><td class="eHeadercolor Rowheight">公开</td><td class="eHeadercolor Rowheight">备 注</td></tr>';
		}

	$value=substr($value,strlen('.声音 '));//去除前面的标识
	$temparr=explode(', ',$value);//根据 ,  来分割
	$ehtm=$ehtm.'<tr><td class="eOthercolor Rowheight">';
	$ehtm=$ehtm.$temparr['0'].'</td><td class="Rowheight">&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="Rowheight eTickcolor" align="center">';//第一个/不管有没有,都有一个数组成员
		
	$ehtm.=count($temparr)>1 ? (is_int(strpos($temparr['1'],'公开'))?'√':'&nbsp;'):'&nbsp;'; //第二个 公开
	$ehtm.='</td><td class="Remarkscolor Rowheight">';
	$ehtm.=count($temparr)>2 ? (substr($value,strlen($temparr['0'].$temparr['1'])+4)):''; //第三个 备注
	$ehtm.='</td></tr>';

return $ehtm;
}//声音表格生成完毕




function getcodei($value,$he){//全局变量表格
if($he != 0 && $he!=6){
	$ehtm=$ehtm.'</table>';
	}
	if($he !=6){
$ehtm=$ehtm.'<table border="1" cellspacing="0" style="table-layout:auto;border-width: 0px; margin-top: 4px; width:0px;"><tr><td class="eHeadercolor Rowheight">全局变量名</td><td class="eHeadercolor Rowheight">类 型</td><td class="eHeadercolor Rowheight">数组</td><td class="eHeadercolor Rowheight">公开</td><td class="eHeadercolor Rowheight">备 注</td></tr>';
	}
	
	$value=substr($value,strlen('.全局变量 '));//去除前面的标识
	$temparr=explode(', ',$value);//根据 ,  来分割
	$ehtm=$ehtm.'<tr><td class="Variablescolor Rowheight">';
	$ehtm=$ehtm.$temparr['0'].'</td><td class="eTypecolor Rowheight">';//第一个/不管有没有,都有一个数组成员
	$ehtm.=count($temparr)>1 ? $temparr['1']:'&nbsp;';//第二个 类型  不存在就返回空
	$ehtm=$ehtm.'</td><td class="eArraycolor Rowheight">';
	$ehtm.=count($temparr)>3 ? (getSubstr($temparr['3'],'&quot;','&quot;')):'&nbsp;'; //第三个 数组成员数
	$ehtm.='</td><td class="Rowheight eTickcolor" align="center">';
	$ehtm.=count($temparr)>2 ? (is_int(strpos($temparr['2'],'公开'))?'√':'&nbsp;'):'&nbsp;'; //第四个 公开
	$ehtm.='</td><td class="Remarkscolor Rowheight">';
	$ehtm.=count($temparr)>4 ? (substr($value,strlen($temparr['0'].$temparr['1'].$temparr['2'].$temparr['3'])+8)):''; //第五个 备注
	$ehtm.='</td></tr>';

return $ehtm;
}//全局变量生成完毕

function getcodeh($value,$he){//图片表格表格
if($he != 0 && $he!=5){
	$ehtm=$ehtm.'</table>';
	}
	if($he !=5){
		$ehtm.='<table border="1" cellspacing="0" style="table-layout:auto;border-width: 0px; margin-top: 4px; width:0px;"><tr><td class="eHeadercolor Rowheight">图片或图片组名称</td><td class="eHeadercolor Rowheight">内容</td><td class="eHeadercolor Rowheight">公开</td><td class="eHeadercolor Rowheight">备 注</td></tr>';
		}

	$value=substr($value,strlen('.图片 '));//去除前面的标识
	$temparr=explode(', ',$value);//根据 ,  来分割
	$ehtm=$ehtm.'<tr><td class="eOthercolor Rowheight">';
	$ehtm=$ehtm.$temparr['0'].'</td><td class="Rowheight">&nbsp;&nbsp;&nbsp;&nbsp;</td><td class="Rowheight eTickcolor" align="center">';//第一个/不管有没有,都有一个数组成员
		
	$ehtm.=count($temparr)>1 ? (is_int(strpos($temparr['1'],'公开'))?'√':'&nbsp;'):'&nbsp;'; //第二个 公开
	$ehtm.='</td><td class="Remarkscolor Rowheight">';
	$ehtm.=count($temparr)>2 ? (substr($value,strlen($temparr['0'].$temparr['1'])+4)):''; //第三个 备注
	$ehtm.='</td></tr>';

return $ehtm;
}//图片表格生成完毕


function getcodeg($value,$he){//DLL参数表格
	if($he!=0 && $he!=4){ //如果之前已经有表格,且不是DLL相关表格
		$ehtm.='</table>';
		}
	if($he !=4){
		$ehtm.='<table border="1" cellspacing="0" style="table-layout:auto;border-width: 0px; margin-top: 4px; width:0px;"><tr><td class="eHeadercolor Rowheight">DLL命令名</td><td class="eHeadercolor Rowheight">返回值类型</td><td class="eHeadercolor Rowheight">公开</td><td colspan="2" class="eHeadercolor Rowheight">备 注</td></tr><tr><td class="Wrongcolor Rowheight">(暂未填写DLL命令名)</td><td class="eTypecolor Rowheight">&nbsp;</td><td class="Rowheight" align="center">&nbsp;</td><td colspan="2" class="Remarkscolor Rowheight">&nbsp;</td></tr><tr><td colspan="5" class="eHeadercolor Rowheight">DLL库文件名:</td></tr><tr><td colspan="5" class="Wrongcolor Rowheight">(未填写库文件名)</td></tr><tr><td colspan="5" class="eHeadercolor Rowheight">在DLL库中对应命令名:</td></tr><tr><td colspan="5" class="Wrongcolor Rowheight">(未填写命令名)</td></tr><tr><td class="eHeadercolor Rowheight">参数名</td><td class="eHeadercolor Rowheight">类 型</td><td class="eHeadercolor Rowheight">传址</td><td class="eHeadercolor Rowheight">数组</td><td class="eHeadercolor Rowheight">备 注 </td></tr>';
	}
	$value=substr($value,strlen('    .参数 '));//去除前面的标识
	$temparr=explode(', ',$value);//根据 ,  来分割
	$ehtm=$ehtm.'<tr><td class="Variablescolor Rowheight">';
	$ehtm=$ehtm.$temparr['0'].'</td><td class="eTypecolor Rowheight">';//第一个/不管有没有,都有一个数组成员
	$ehtm.=count($temparr)>1 ? $temparr['1']:'&nbsp;';//第二个 类型  不存在就返回空
	$ehtm.='</td><td class="Rowheight eTickcolor" align="center">';	
	$ehtm.=count($temparr)>2 ? (is_int(strpos($temparr['2'],'传址'))?'√':'&nbsp;'):'&nbsp;'; //第三个 传址
	$ehtm.='</td><td class="Rowheight eTickcolor" align="center">';
	$ehtm.=count($temparr)>2 ? (is_int(strpos($temparr['2'],'数组'))?'√':'&nbsp;'):'&nbsp;'; //第四个 数组
	$ehtm.='</td><td class="Remarkscolor Rowheight">';
	$ehtm.=count($temparr)>3 ? (substr($value,strlen($temparr['0'].$temparr['1'].$temparr['2'])+6)):''; //第五个 备注
	$ehtm.='</td></tr>';


return $ehtm;
}//DLL参数表格完毕



function getcodef($value,$he){//DLL主程序表格
		if($he!=0){
	$ehtm=$ehtm.'</table>';
	if($he!=4)
	$ehtm=$ehtm.'<br>';
	}	
	$ehtm=$ehtm.'<table border="1" cellspacing="0" style="table-layout:auto;border-width: 0px; margin-top: 4px; width:0px;"><tr><td class="eHeadercolor Rowheight">DLL命令名</td><td class="eHeadercolor Rowheight">返回值类型</td><td class="eHeadercolor Rowheight">公开</td><td colspan="2" class="eHeadercolor Rowheight">备 注</td></tr><tr><td class="eProcolor Rowheight">';
	
  	$value=substr($value,strlen('.DLL命令 '));//去除前面的标识
		$temparr=explode(', ',$value);//根据 ,  来分割
		$ehtm=$ehtm.$temparr['0'].'</td><td class="eTypecolor Rowheight">';//第一个/不管有没有,都有一个数组成员
		$ehtm.=count($temparr)>1 ? $temparr['1']:'&nbsp;';//第二个 类型  不存在就返回空
		$ehtm.='</td><td class="Rowheight eTickcolor" align="center">';
		$ehtm.=count($temparr)>4 ? ($temparr['4']=='公开'?'√':'&nbsp;'):'&nbsp;'; //第三个 公开
		$ehtm.='</td><td colspan="2" class="Remarkscolor Rowheight">';
		$ehtm.=count($temparr)>5 ? (substr($value,strlen($temparr['0'].$temparr['1'].$temparr['2'].$temparr['3'].$temparr['4'])+10)):''; //第三个 公开
		$ehtm.='</td></tr><tr><td colspan="5" class="eHeadercolor Rowheight">DLL库文件名:</td></tr><tr>';	
  		
		$ehtm.=count($temparr)>2 ? ($temparr['2']=='' ? '<td colspan="5" class="Wrongcolor Rowheight">(未填写库文件名)' : '<td colspan="5" class="eAPIcolor Rowheight">'.substr($temparr['2'],6,strlen($temparr['2'])-12)):'<td colspan="5" class="Wrongcolor Rowheight">(未填写库文件名)';//库文件 
		
		$ehtm.='</td></tr><tr><td colspan="5" class="eHeadercolor Rowheight">在DLL库中对应命令名:</td></tr><tr>';
		
		$ehtm.=count($temparr)>3 ? ($temparr['3']=='' ? '<td colspan="5" class="Wrongcolor Rowheight">(未填写命令名)' : '<td colspan="5" class="eAPIcolor Rowheight">'.substr($temparr['3'],6,strlen($temparr['3'])-12)):'<td colspan="5" class="Wrongcolor Rowheight">(未填写命令名)';//命令名
		
		$ehtm.='</td></tr><tr><td class="eHeadercolor Rowheight">参数名</td><td class="eHeadercolor Rowheight">类 型</td><td class="eHeadercolor Rowheight">传址</td><td class="eHeadercolor Rowheight">数组</td><td class="eHeadercolor Rowheight">备 注 </td></tr>';
		
	return $ehtm;
	
}//DLL主程序生成完毕




function getcodee($value,$he){//生成子程序表格
		if($he!=0){
	$ehtm=$ehtm.'</table>';
	if($he!=3)
	$ehtm=$ehtm.'<br>';
	}	
	$ehtm=$ehtm.'<table border="1" cellspacing="0" style="table-layout:auto; border-width:0px;margin-top:4px; width:0px;"><tr><td class="eHeadercolor Rowheight">子程序名</td><td class="eHeadercolor Rowheight">返回值类型</td><td class="eHeadercolor Rowheight">公开</td><td colspan="3" class="eHeadercolor Rowheight">备 注</td></tr><tr><td class="eProcolor Rowheight">';
  	$value=substr($value,strlen('.子程序 '));//去除前面的标识
		$temparr=explode(', ',$value);//根据 ,  来分割
		
		$ehtm=$ehtm.$temparr['0'].'</td><td class="eTypecolor Rowheight">';//第一个/不管有没有,都有一个数组成员
		$ehtm.=count($temparr)>1 ? $temparr['1']:'&nbsp;';//第二个 类型  不存在就返回空
		$ehtm.='</td><td class="Rowheight eTickcolor" align="center">';
		$ehtm.=count($temparr)>2 ? ($temparr['2']=='公开'?'√':'&nbsp;'):'&nbsp;'; //第三个 公开
		$ehtm.='</td><td colspan="3" class="Remarkscolor Rowheight">';
		$ehtm.=count($temparr)>3 ? (substr($value,strlen($temparr['0'].$temparr['1'].$temparr['2'])+6)):''; //第三个 公开
		$ehtm.='</td></tr>';	
  	return $ehtm;
	
}//生成子程序表格完毕



function getcoded($value,$he){//生成子程序参数表格	
	if($he != 1 && $he !=11){
		if($he != 0){
			$ehtm.='</table>';
			}		
	$ehtm=$ehtm.'<table border="1" cellspacing="0" style="table-layout:auto; border-width:0px;margin-top:4px;width:0px;"><tr><td class="eHeadercolor Rowheight">子程序名</td><td class="eHeadercolor Rowheight">返回值类型</td><td class="eHeadercolor Rowheight">公开</td><td colspan="3" class="eHeadercolor Rowheight">备 注</td></tr><tr><td class="Wrongcolor Rowheight">(未填写子程序名)</td><td class="Rowheight">&nbsp;</td><td class="Rowheight">&nbsp;</td><td colspan="3" class="Rowheight">&nbsp;</td></tr><tr><td class="eHeadercolor Rowheight">参数名</td><td class="eHeadercolor Rowheight">类 型</td><td class="eHeadercolor Rowheight">参考</td><td class="eHeadercolor Rowheight">可空</td><td class="eHeadercolor Rowheight">数组</td><td class="eHeadercolor Rowheight">备 注</td></tr><tr>';
	}
	if($he !=11){//如果之前不是子程序参数 那么需要价格标头
	$ehtm=$ehtm.'<tr><td class="eHeadercolor Rowheight">参数名</td><td class="eHeadercolor Rowheight">类 型</td><td class="eHeadercolor Rowheight">参考</td><td class="eHeadercolor Rowheight">可空</td><td class="eHeadercolor Rowheight">数组</td><td class="eHeadercolor Rowheight">备 注</td></tr><tr>';	
		}

	$ehtm=$ehtm.'<td class="Variablescolor Rowheight">';
	    $value=substr($value,strlen('.参数 '));//去除前面的标识
		$temparr=explode(', ',$value);//根据 ,  来分割
		
		$ehtm=$ehtm.$temparr['0'].'</td><td class="eTypecolor Rowheight">';//第一个/不管有没有,都有一个数组成员
		$ehtm.=count($temparr)>1 ? $temparr['1']:'&nbsp;';//第二个 类型  不存在就返回空
		$ehtm.='</td><td class="Rowheight eTickcolor" align="center">';	
		$ehtm.=count($temparr)>2 ? (is_int(strpos($temparr['2'],'参考'))?'√':'&nbsp;'):'&nbsp;'; //第三个 参考
		$ehtm.='</td><td class="Rowheight eTickcolor" align="center">';
		$ehtm.=count($temparr)>2 ? (is_int(strpos($temparr['2'],'可空'))?'√':'&nbsp;'):'&nbsp;'; //第三个 可空
		$ehtm.='</td><td class="Rowheight eTickcolor" align="center">';
		$ehtm.=count($temparr)>2 ? (is_int(strpos($temparr['2'],'数组'))?'√':'&nbsp;'):'&nbsp;'; //第三个 数组
		$ehtm.='</td><td colspan="3" class="Remarkscolor Rowheight">';
		$ehtm.=count($temparr)>3 ? (substr($value,strlen($temparr['0'].$temparr['1'].$temparr['2'])+6)):''; //第三个 公开
		$ehtm.='</td></tr>';
	
	return $ehtm;	
}//生成子程序参数表格完毕



function getcodec($value,$he){//生成局部变量表格
		if($he!=0 && $he!=2) //有东西 但又不是局部变量
	$ehtm=$ehtm.'</table>';
	
	if($he!=2){ //判断是否第一次加载
	$ehtm=$ehtm.'<table border="1" cellspacing="0" style="table-layout:auto;border-width: 0px; margin-top: 4px;width:0px;"><tr><td class="eVariableheadcolor Rowheight">变量名</td><td class="eVariableheadcolor Rowheight">类 型</td><td class="eVariableheadcolor Rowheight">静态</td><td class="eVariableheadcolor Rowheight">数组</td><td class="eVariableheadcolor Rowheight">备 注</td></tr>';	
		}
		
	$ehtm=$ehtm.'<tr><td class="Variablescolor Rowheight">';
  	$value=substr($value,strlen('.局部变量 '));//去除前面的标识      子程序变量2, 整数型, 静态, "33", 测试7
		$temparr=explode(', ',$value);//根据 ,  来分割
		
		$ehtm=$ehtm.$temparr['0'].'</td><td class="eTypecolor Rowheight">';//第一个  变量名  /不管有没有,都有一个数组成员
		$ehtm.=count($temparr)>1 ? $temparr['1']:'&nbsp;';//第二个 类型  不存在就返回空
		$ehtm.='</td><td class="Rowheight eTickcolor" align="center">';
		$ehtm.=count($temparr)>2 ? ($temparr['2']=='静态'?'√':'&nbsp;'):'&nbsp;'; //第三个 静态
		$ehtm.='</td><td class="eArraycolor Rowheight">';
		$ehtm.=count($temparr)>3 ? (getSubstr($temparr['3'],'&quot;','&quot;')):'&nbsp;'; //第四个 数组成员数
		$ehtm.='</td><td colspan="3" class="Remarkscolor Rowheight">';
		$ehtm.=count($temparr)>4 ? (substr($value,strlen($temparr['0'].$temparr['1'].$temparr['2'].$temparr['3'])+8)):''; //第五个 备注
		$ehtm.='</td></tr>';	
		
		return $ehtm;
}//生成局部变量表格完毕



function getcodeb($value,$he){ //生成程序集表格
		if($he!=0)
	$ehtm=$ehtm.'</table>';
	
	$ehtm=$ehtm.'<table border="0" cellspacing="0" style="table-layout:auto;border-width: 0px;width:0px;"><tr><td class="eAssemblycolor Rowheight">窗口程序集名</td><td class="eAssemblycolor Rowheight">保 留&nbsp;&nbsp;</td><td class="eAssemblycolor Rowheight">保 留</td><td class="eAssemblycolor Rowheight">备 注</td></tr><tr><td class="eProcolor Rowheight">';
	 $value=substr($value,strlen('.程序集 '));//去除前面的标识     窗口程序集1, , , 斯蒂芬
		$temparr=explode(', , , ',$value);//根据 ,,,  来分割
		if(count($temparr)==2){
			$ehtm=$ehtm.$temparr['0'].'</td><td class="Rowheight">&nbsp;</td><td class="Rowheight">&nbsp;</td><td class="Remarkscolor Rowheight">'.$temparr['1'].'</td></tr>';
			}else{
				$ehtm=$ehtm.$temparr['0'].'</td><td class="Rowheight">&nbsp;</td><td class="Rowheight">&nbsp;</td><td class="Rowheight">&nbsp;</td></tr>';				
			}

	return $ehtm;
}//生成程序集表格完毕


function getcodea($value,$he){ //生成程序集变量表格
	if($he!=3 && $he!=10){ //判断是否第一次加载
		if($he!=0){ //有东西 但又不是程序集 和 程序集变量
	$ehtm=$ehtm.'</table>';
			}
	
	$ehtm=$ehtm.'<table border="0" cellspacing="0" style="table-layout:auto;border-width: 0px;width:0px;"><tr><td class="eAssemblycolor Rowheight">窗口程序集名</td><td class="eAssemblycolor Rowheight">保 留&nbsp;&nbsp;</td><td class="eAssemblycolor Rowheight">保 留</td><td class="eAssemblycolor Rowheight">备 注</td></tr><tr><td class="Wrongcolor Rowheight">(未填写程序集名)</td><td class="Rowheight">&nbsp;</td><td class="Rowheight">&nbsp;</td><td class="Rowheight">&nbsp;</td></tr><tr><td class="eAssemblycolor Rowheight">变量名</td><td class="eAssemblycolor Rowheight">类 型</td><td class="eAssemblycolor Rowheight">数组</td><td class="eAssemblycolor Rowheight">备 注 </td></tr>';
	}//判断第一次加载完毕
	if($he!=10){//如果上一个不是程序集变量 那么加一个标头
		$ehtm.='<tr><td class="eAssemblycolor Rowheight">变量名</td><td class="eAssemblycolor Rowheight">类 型</td><td class="eAssemblycolor Rowheight">数组</td><td class="eAssemblycolor Rowheight">备 注 </td></tr>';
		}
	
		
		$ehtm.='<tr><td class="Variablescolor Rowheight">'; 
		$value=substr($value,strlen('.程序集变量 '));//去除前面的标识    窗口程序集变量, 整数型, , "2", 测试1
		$temparr=explode(', ',$value);//根据 ,  来分割
		
		$ehtm=$ehtm.$temparr['0'].'</td><td class="eTypecolor Rowheight">';//第一个  变量名  /不管有没有,都有一个数组成员
		$ehtm.=count($temparr)>1 ? $temparr['1']:'&nbsp;';//第二个 类型  不存在就返回空
		$ehtm.='</td><td class="eArraycolor Rowheight">';
		//$ehtm.=count($temparr)>3 ? (substr($temparr['3'],2,-1)):'&nbsp;'; //第三个 数组
		$ehtm.=count($temparr)>3 ? (getSubstr($temparr['3'],'&quot;','&quot;')):'&nbsp;';
		$ehtm.='</td><td class="Remarkscolor Rowheight">';
		$ehtm.=count($temparr)>4 ? (substr($value,strlen($temparr['0'].$temparr['1'].$temparr['2'].$temparr['3'])+8)):'&nbsp;'; //第五个 备注
		$ehtm.='</td></tr>';
		
		return $ehtm;
}//生成程序集变量表格完毕



function getelib($libarr){  //生成支持库表格代码
	global $_G; //全局变量,定义
	$elib='';//初始化支持库的表格文本
	if($_G['cache']['plugin']['ecode']['codelib'] !=''){ //如果设置里面有支持库文本
	$templib=explode("\n",$_G['cache']['plugin']['ecode']['codelib']); //把控制面板里面的文本分割
	$templib=array_unique($templib);//删除重复数组成员
	$libarr=array_unique($libarr);
	$elib='<br><br><table border="0" cellspacing="0" style="table-layout:auto;border-width: 0px;width:0px;"><tr><td class="eHeadercolor Rowheight"><font face=Webdings color=red>i</font>支持库列表&nbsp;&nbsp;&nbsp;</td><td class="eHeadercolor Rowheight">支持库注释&nbsp;&nbsp;&nbsp;</td></tr>';
	
foreach ($templib as $value) //控制面板的内容
{
	list($index, $choice) = explode('=', $value);
	$temparr[$index] = $choice;	
}	
	foreach ($libarr as $value)//用户代码里的支持库
{
	if($temparr[$value] != ''){
	$elib.='<tr><td class="Variablescolor Rowheight">'.$value.'</td><td class="Remarkscolor Rowheight">'.$temparr[$value].'</td></tr>';	
		}else{
		$elib.='<tr><td class="Variablescolor Rowheight">'.$value.'</td><td class="Wrongcolor Rowheight">(未知支持库)</td></tr>';	
			}
}
	return $elib.'</table>';	
	} else{
		return '';
		}
}//支持库代码生成完毕



function getepillar(){//空行时使用  根据线条数组生成线条
global $parharr,$ecolormod;//获取全局线条数组
$ekg='';

if(end($parharr)=='PDZZ' || end($parharr)=='RGZZ' || end($parharr)=='PDPDZZ' ||end($parharr)=='PDMR' || end($parharr)=='RGFZ' || end($parharr)=='PDJS' || end($parharr)=='RGJS' || end($parharr)=='RGZWB'){

foreach ($parharr as $value)
{
  	  if($value=='XH' || $value=='RGZ' || $value=='PDKS' || $value=='RG'){
  $ekg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/03.png" align="absmiddle">';
  			} elseif($value=='PDMRKS' || $value=='RGFZKS'){
				$ekg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/04.png" align="absmiddle">';				
					} elseif($value=='PDPD'){
						$ekg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/05.png" align="absmiddle">';		
							}elseif($value=='PDZZ' ||$value=='RGZZ'){
							$ekg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/08.png" align="absmiddle">';
							}elseif($value=='PDZZtwo' ||$value=='RGZZtwo'){
								$ekg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/26.png" align="absmiddle">';
								} elseif($value=='PDPDZZ'){
								$ekg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/16.png" align="absmiddle">';
								}elseif($value=='PDPDZZtwo'){
									$ekg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/25.png" align="absmiddle">';
								}elseif($value=='RGJS' || $value=='PDJS'){
									$ekg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/02.png" align="absmiddle">';
									array_pop($parharr);
									}elseif($value=='RGZWB'){
										$ekg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/01.png" align="absmiddle">';
										array_pop($parharr);
										}elseif($value=='PDMR'){
										array_pop($parharr);
										$parharr[]='PDMRKSone';
										$ekg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/09.png" align="absmiddle"><br><img src="source/plugin/ecode/image/code'.$ecolormod.'/04.png" align="absmiddle">';
									}elseif($value=='RGFZ'){
										array_pop($parharr);
										$parharr[]='RGFZKSone';	
										$ekg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/09.png" align="absmiddle"><br><img src="source/plugin/ecode/image/code'.$ecolormod.'/04.png" align="absmiddle">';
										}
}

$ekg=end($parharr)=='PDJS' || end($parharr)=='RGJS' || end($parharr)=='RGZWB'?$ekg :$ekg.'<br>';
} //判断完毕 

return $ekg;
}//生成空格子程序完



function endelineimg($earr,$ehtm){//完结所有的线条图片  这里需要做个数组循环  清空所有的数组    这里很重要   如果用户没有复制完全  这里需要完全的补全
	global $ecolormod;
	
	$endeimg=substr($ehtm,-4)=='<br>' ? '':'<br>';//定义临时文本
	
	if(count($earr)>0){//如果数组有内容
		
	if(end($earr)=='RGZWB' || end($earr)=='RGZ'){
		$endeimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/01.png" align="absmiddle">';
		}elseif(end($earr)=='PDJS' || end($earr)=='RGJS'){
			$endeimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/02.png" align="absmiddle">';
			}elseif(end($earr)=='PDMR' || end($earr)=='RGFZ'){
				$endeimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/09.png" align="absmiddle"><br><img src="source/plugin/ecode/image/code'.$ecolormod.'/02.png" align="absmiddle">';
				}elseif(end($earr)=='PDKS' ||end($earr)=='RG'){
					$endeimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/08.png" align="absmiddle"><br><img src="source/plugin/ecode/image/code'.$ecolormod.'/09.png" align="absmiddle"><br><img src="source/plugin/ecode/image/code'.$ecolormod.'/02.png" align="absmiddle">';
					}elseif(end($earr)=='PDPD'){
						$endeimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/16.png" align="absmiddle"><br><img src="source/plugin/ecode/image/code'.$ecolormod.'/09.png" align="absmiddle"><br><img src="source/plugin/ecode/image/code'.$ecolormod.'/02.png" align="absmiddle">';	
						}
		
		
		}else{ //如果数组为空
			$endeimg.='';
			}
	
	return $endeimg;
	}//完结线条图片子程序完毕
	
	


function getelineimg($etxt){//根据数组和文本生成线条图片
	global $parharr,$ecolormod;//获取全局线条数组
	$elineimg='';//定义临时图片文本
	
if(end($parharr)=='PDMR' || end($parharr)=='RGFZ'){
	$elineimg='';
				
		}else{
			
	$i=0;
	while(substr($etxt,0,4)=='    ' && $parharr[$i]!='')//如果文本前四个是空格 且对应的数组不为空
  {
	  if($parharr[$i]=='XH' || $parharr[$i]=='RGZ' || $parharr[$i]=='PDKS' || $parharr[$i]=='RG'){
  $elineimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/03.png" align="absmiddle">';
  			} elseif($parharr[$i]=='PDMRKS' || $parharr[$i]=='RGFZKS'){
				$elineimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/04.png" align="absmiddle">';				
					} elseif($parharr[$i]=='PDPD'){
						$elineimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/05.png" align="absmiddle">';		
							}elseif($parharr[$i]=='PDZZ' ||$parharr[$i]=='RGZZ'){
							$elineimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/08.png" align="absmiddle">';
							}elseif($parharr[$i]=='PDZZtwo' ||$parharr[$i]=='RGZZtwo'){
								$elineimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/26.png" align="absmiddle">';
								} elseif($parharr[$i]=='PDPDZZ'){
								$elineimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/16.png" align="absmiddle">';
								}elseif($parharr[$i]=='PDPDZZtwo'){
									$elineimg.='<img src="source/plugin/ecode/image/code'.$ecolormod.'/25.png" align="absmiddle">';
									}
  
  $etxt=substr($etxt,4);
  $i++;
  }	
	
			}

	
	return $elineimg;
}//数组生成线条图片子程序完毕



function getepathline($etxt){//定义命令的线条  判断如果 如果真 循环....   此处需要根据样式序号而选择不同的文件夹图片
	global $parharr,$ecolormod;//获取全局线条数组
	$tempelineimg='';//定义临时 数组生成的图片代码
	
	$tempelineimg=getelineimg($etxt);//根据该行文本,生成线条图片 文本
	$etxt=ltrim($etxt);//把总文本去除首空
		
	if(end($parharr)=='PDMR'){
		array_pop($parharr);
		$parharr[]='PDMRKSone';
		if(strpos($etxt,'.如果真 (')===0 || strpos($etxt,'.如果真(')===0 ||strpos($etxt,'.如果 (')===0 || strpos($etxt,'.如果(')===0){
			$tempelineimg='<img src="source/plugin/ecode/image/code'.$ecolormod.'/10.png" align="absmiddle">';
			}else {
					$tempelineimg='<img src="source/plugin/ecode/image/code'.$ecolormod.'/09.png" align="absmiddle">';
						}
				

		}elseif(end($parharr)=='RGFZ'){
			array_pop($parharr);
			$parharr[]='RGFZKSone';	
		if(strpos($etxt,'.如果真 (')===0 || strpos($etxt,'.如果真(')===0 ||strpos($etxt,'.如果 (')===0 || strpos($etxt,'.如果(')===0 ||strpos($etxt,'.判断开始')===0){
			$tempelineimg='<img src="source/plugin/ecode/image/code'.$ecolormod.'/10.png" align="absmiddle">';
			}else {
					$tempelineimg='<img src="source/plugin/ecode/image/code'.$ecolormod.'/09.png" align="absmiddle">';
						}
				
			}


	if(strpos($etxt,'.如果真 (')===0 || strpos($etxt,'.如果真(')===0){ 
		if(end($parharr)=='RGZWB'){
		$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/17.png" align="absmiddle">'.substr($etxt,1);
		array_pop($parharr);
			} elseif(end($parharr)=='PDMRKSone'){ 
			$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/19.png" align="absmiddle">'.substr($etxt,1);
			array_pop($parharr);
			$parharr[]='PDMRKS';
				}elseif(end($parharr)=='PDJS' || end($parharr)=='RGJS'){
					$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/20.png" align="absmiddle">'.substr($etxt,1);
					array_pop($parharr);					
					}else{
	$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/07.png" align="absmiddle">'.substr($etxt,1);
					}
				$parharr[]='RGZ';
	
		} elseif (strpos($etxt,'.计次循环首')===0 || strpos($etxt,'.判断循环首')===0 || strpos($etxt,'.循环判断首')===0 || strpos($etxt,'.变量循环首')===0){ 
	if(end($parharr)=='RGZWB'){
		$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/18.png" align="absmiddle">'.substr($etxt,1);
		array_pop($parharr);		
		} else {	
	$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/13.png" align="absmiddle">'.substr($etxt,1);
				}
				$parharr[]='XH';
	
			} elseif($etxt == '.如果真结束'){
				if(end($parharr)=='RGZWB'){
					$etxt='<img src="source/plugin/ecode/image/code'.$ecolormod.'/01.png" align="absmiddle"><br>';
						} else{
		$etxt='';
		array_pop($parharr);
		$parharr[]='RGZWB';//给数组定义如果真完毕		
						}
						
				} elseif(strpos($etxt,'.判断开始')===0){
			if(end($parharr)=='RGZWB'){
			$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/17.png" align="absmiddle">'.substr($etxt,1);
			array_pop($parharr);
				}elseif(end($parharr)=='RGFZKSone'){ 
					$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/19.png" align="absmiddle">'.substr($etxt,1);
					array_pop($parharr);
					$parharr[]='RGFZKS'; 
							} else{
					$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/07.png" align="absmiddle">'.substr($etxt,1);
					}
				$parharr[]='PDKS';
			
					}elseif($etxt == '.默认'){
							array_pop($parharr);
							$parharr[]='PDMR';
							$etxt=$tempelineimg;
				
						}elseif($etxt == '.判断结束'){
				if(end($parharr)=='RGZWB'){
					$etxt='<img src="source/plugin/ecode/image/code'.$ecolormod.'/01.png" align="absmiddle"><br>';
					array_pop($parharr);
					$parharr[]='PDJS';
						}elseif(end($parharr)=='RGJS'){ 
							$etxt='<img src="source/plugin/ecode/image/code'.$ecolormod.'/02.png" align="absmiddle"><br>';
							array_pop($parharr);
							array_pop($parharr);
							$parharr[]='PDJS';						
							
							}else{
							$etxt='';
							array_pop($parharr);
							$parharr[]='PDJS';//给数组定义判断结束完毕		
								}				
				
							}elseif(strpos($etxt,'.判断 (')===0 || strpos($etxt,'.判断(')===0){
									array_pop($parharr);
									$parharr[]='PDPD';
									$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/15.png" align="absmiddle">'.substr($etxt,1);
								
								}elseif(strpos($etxt,'.计次循环尾')===0 || strpos($etxt,'.判断循环尾')===0  || strpos($etxt,'.循环判断尾')===0 || strpos($etxt,'.变量循环尾')===0){
								if(end($parharr)=='RGZWB'){
								$etxt='<img src="source/plugin/ecode/image/code'.$ecolormod.'/01.png" align="absmiddle"><br>'.$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/12.png" align="absmiddle">'.substr($etxt,1);//此处有BUG
								array_pop($parharr);
								array_pop($parharr);
									}elseif(end($parharr)=='PDJS' || end($parharr)=='RGJS'){ 
									$etxt='<img src="source/plugin/ecode/image/code'.$ecolormod.'/02.png" align="absmiddle"><br>'.$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/12.png" align="absmiddle">'.substr($etxt,1);//此处有BUG
								array_pop($parharr);
								array_pop($parharr);									
									
									}else{
										array_pop($parharr);
										if(end($parharr)=='PDZZtwo' || end($parharr)=='RGZZtwo'|| end($parharr)=='PDPDZZtwo'){
										$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/14.png" align="absmiddle">'.substr($etxt,1);	
											}else{
										$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/12.png" align="absmiddle">'.substr($etxt,1);
										}
										}
							
							
							
								}elseif(strpos($etxt,'.如果 (')===0 || strpos($etxt,'.如果(')===0){
									if(end($parharr)=='RGZWB'){
										$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/17.png" align="absmiddle">'.substr($etxt,1);
										array_pop($parharr);
										
										}elseif(end($parharr)=='PDMRKSone'){ 
										$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/19.png" align="absmiddle">'.substr($etxt,1);
										array_pop($parharr);
										$parharr[]='PDMRKS';
											
											}elseif(end($parharr)=='RGFZKSone'){ 
										$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/19.png" align="absmiddle">'.substr($etxt,1);
										array_pop($parharr);
										$parharr[]='RGFZKS';
							
										}else{
											$etxt=$tempelineimg.'<img src="source/plugin/ecode/image/code'.$ecolormod.'/07.png" align="absmiddle">'.substr($etxt,1);
											}
										$parharr[]='RG';									
									
									}elseif($etxt == '.否则'){
										array_pop($parharr);
										$parharr[]='RGFZ';
										$etxt=$tempelineimg;
										
										}elseif($etxt == '.如果结束'){
											if(end($parharr)=='RGZWB'){
											$etxt='<img src="source/plugin/ecode/image/code'.$ecolormod.'/01.png" align="absmiddle"><br>';
											array_pop($parharr);
											$parharr[]='RGJS';
												}elseif(end($parharr)=='PDJS' || end($parharr)=='RGJS'){ 
													$etxt='<img src="source/plugin/ecode/image/code'.$ecolormod.'/02.png" align="absmiddle"><br>';
													array_pop($parharr);
													array_pop($parharr);
													$parharr[]='RGJS';

												} else{
													$etxt='';
													array_pop($parharr);
													$parharr[]='RGJS';//给数组定义判断结束完毕		
														}	
											
											}else{ //如果这行没有线条内容存在
												if(end($parharr)=='RGZWB'){
												array_pop($parharr);
												$etxt=$tempelineimg.'<span class="eunderimg">'.$etxt.'</span>';												
													}elseif(end($parharr)=='RGJS' || end($parharr)=='PDJS'){
													array_pop($parharr);
													$etxt=$tempelineimg.'<span class="ecenterimg">'.$etxt.'</span>';																							
													}else { //如果所有的数组都是空的.那么就正常输出
													$etxt=$tempelineimg.$etxt;
														}
												
												}


	if(end($parharr)=='PDMRKSone'){ //因为上面的代码会直接加到数组最后一个, 因此此处会被压倒倒数第二个.. 因此..  待考虑 ..
				array_pop($parharr);
				$parharr[]='PDMRKS';
		}elseif(end($parharr)=='RGFZKSone'){
					array_pop($parharr);
					$parharr[]='RGFZKS';
			}
	
	$etxt=(end($parharr)=='RGZWB' || end($parharr)=='PDMR' || end($parharr)=='RGFZ' || end($parharr)=='PDJS' || end($parharr)=='RGJS')? $etxt:$etxt.'<br>';  //此处添加换行  这里需要加数组前缀图片代码  但是还要根据etxt是否为空增加换行
	return $etxt;
}//定义线条的子程序完毕


function geteyycode($etxt){ //给命令行上色
	$etxt=getepathline($etxt);//先添加命令线条 和换行.'<br>'
	
	$temp=''; //初始化备注文本
	$place=strpos($etxt,'\'');//取得 '的位置	
while(is_int($place))//获取备注循环
  {
		if(getnum($etxt,'“',$place)==getnum($etxt,'”',$place)){
		  $temp=substr($etxt,$place+1);//取出备注
		  $temp=substr($temp,0,1)==' ' ? $temp : (' '.$temp);
		  $etxt=substr($etxt,0,$place);
		  $place=false;
		  }
		else {
			$place=strpos($etxt,'\'',$place+1);
			}
  }	//获取备注循环完毕
  
  $etxt=implode(explode('“',$etxt),"<span class=eTxtcolor>“");
  $etxt=implode(explode('”',$etxt),"”</span>");//以上两行给引号内文字上色
  
  $leftplace = -1; //初始化符号的最左边
  $place=strpos($etxt,'(');//取得 ( 的位置
  $signarr=array(".", "×", "÷", "＼", "\\", "％", "%", "＋", "+", "－", "-", "(", ")", " ", "*", "＞", ">", "<", "≥", "＜", "≤", "≈", "=","≠",";",":");
  $sparr=array("如果真","如果真结束","判断","判断开始","判断结束","默认","否则","如果","返回","结束","到循环尾","跳出循环","循环判断首","循环判断尾","判断循环首","判断循环尾","计次循环首", "计次循环尾","变量循环首","变量循环尾");
while(is_int($place))//获取命令循环
  {
		if(getnum($etxt,'“',$place)==getnum($etxt,'”',$place)){ //如果不在引号内
		$place=substr($etxt,$place-1,1)==' ' ? ($place-1) : $place;//如果(左边是空格)
		
foreach ($signarr as $value)
{
  $leftplace=is_int(strrpos(substr($etxt,0,$place),$value)) ? (strrpos(substr($etxt,0,$place),$value)>=$leftplace? strrpos(substr($etxt,0,$place),$value):$leftplace) : $leftplace;//取出最后一次出现的位置  最后找个地方放置 break; 跳出代码
}
		
		if(substr($etxt,$place,1)==' '){
		$etxt=substr($etxt,0,$place).'</span>'.substr($etxt,$place);//后续需要给括号处上色      !!! 这里可拓展,顺便加上括号的颜色 
			} else {
				$etxt=substr($etxt,0,$place).'</span> '.substr($etxt,$place);
				}
		
		$leftplace= $leftplace==-1 ? 0 : ($leftplace+1); //如果什么符号都没取到,那么左边的位置=0 
		if(in_array(substr($etxt,$leftplace,$place-$leftplace),$sparr)){ //取出命令的文本,判断是否在上面数组中存在
			$etxt=substr($etxt,0,$leftplace).'<span class="comecolor">'.substr($etxt,$leftplace); //上蓝色
			} elseif(substr($etxt,$leftplace-1,1)=='.'){ //如果左边的符号是 .
				$etxt=substr($etxt,0,$leftplace).'<span class="cometwolr">'.substr($etxt,$leftplace); //上小程序的颜色
				}else {
		$etxt=substr($etxt,0,$leftplace).'<span class="funccolor">'.substr($etxt,$leftplace); //上红色		
				}
		$place=strpos($etxt,'(',$place+33);
		  }
		else {//下面的意思是,如果在引号内
			$place=strpos($etxt,'(',$place+1);
			}
  }	//获取命令循环完毕
  
  $leftplace=strpos($etxt,'#');//取得 # 的位置
  $place=strlen($etxt);//初始化赋值 右边的值 取文本长度
  while(is_int($leftplace))//获取常量图片循环
  {
	  if(getnum($etxt,'“',$leftplace)==getnum($etxt,'”',$leftplace)){ //如果不在引号内
	  foreach ($signarr as $value)
{
  $place=is_int(strpos($etxt,$value,$leftplace)) ? (strpos($etxt,$value,$leftplace) <= $place? strpos($etxt,$value,$leftplace):$place) : $place;//取出最早一次出现的位置
}
		if(substr($etxt,$place,1)==' '){
		$etxt=substr($etxt,0,$place).'</span>'.substr($etxt,$place);//后续需要给括号处上色      !!! 这里可拓展,顺便加上括号的颜色 
			} else {
		$etxt=substr($etxt,0,$place).'</span> '.substr($etxt,$place);
				}
		if(substr($etxt,$leftplace-1,1)==' '){
		$etxt=substr($etxt,0,$leftplace).'<span class="conscolor">'.substr($etxt,$leftplace); //上常量图片色
		} else {
			$etxt=substr($etxt,0,$leftplace).' <span class="conscolor">'.substr($etxt,$leftplace);
			}
	  
	  $place=strlen($etxt);
	  $leftplace=strpos($etxt,'#',$leftplace+33);
	  } else{//下面的意思是,如果在引号内
		  $leftplace=strpos($etxt,'#',$leftplace+1);
		  }
	  
}//获取常量图片循环完毕
  
  
  $etxt=$temp !='' ? (substr($etxt,-1)==' ' ? $etxt:$etxt.' '):$etxt;//如果有备注,判断最后一格是否有空格
  $etxt=$temp !='' ? ($etxt.'<span class="Remarkscolor">\''.$temp.'</span>') : $etxt;//如果有备注,就加上
  
  $place=strpos($etxt,'<span class="comecolor">判断开始</span>');//取得 判断开始 的位置
  if(getnum($etxt,'“',$place)==getnum($etxt,'”',$place) && is_int($place)){//如果前面引号数量相等. 意思是不在引号内
  		$etxt=str_replace('<span class="comecolor">判断开始</span>','<span class="comecolor">判断</span>',$etxt);
	  }
  
  $etxt=ecodealone('真',$etxt);
  $etxt=ecodealone('假',$etxt);
  $etxt=ecodealone('(',$etxt);
  $etxt=ecodealone(')',$etxt);
  $etxt=ecodealone('{',$etxt);//这里测试下是否需要移到上面  是否跟备注冲突
  $etxt=ecodealone('}',$etxt);
  $etxt=ecodealone('且',$etxt);
  $etxt=ecodealone('或',$etxt);
  $etxt=ecodealone('[',$etxt);
  $etxt=ecodealone(']',$etxt);
  
  return $etxt;
}//命令上色子程序完毕


function ecodealone($point,$etxt){//给单独的字上色  真 假 括号 且 或 ...
	//   需要测试下  # 图片  声音 是否还有上色
	$fuhao=array(' ','=','(',')');
  $place=strpos($etxt,$point);//取得单独的字出现位置
  while(is_int($place))//获取常量图片循环
  {
	  if(strlen($point) >1){//如果关键字是中文
		  if(in_array(substr($etxt,$place-1,1),$fuhao) == false || in_array(substr($etxt,$place+strlen($point),1),$fuhao) == false){
	  $place=strpos($etxt,$point,$place+1);
	  continue;
		  }
	  }
	  
	  if(getnum($etxt,'“',$place)==getnum($etxt,'”',$place)){ //如果不在引号内

		$etxt=substr($etxt,0,strlen($point)+$place).'</span>'.substr($etxt,$place+strlen($point));  
		
		if($point=='真' || $point=='假'){
		$etxt=substr($etxt,0,$place).'<span class="conscolor">'.substr($etxt,$place); 
		} elseif($point=='且' || $point=='或') {
			$etxt=substr($etxt,0,$place).'<span class="funccolor">'.substr($etxt,$place);
			}elseif($point==')' || $point=='(' || $point=='{' || $point=='}' || $point=='[' || $point==']'){
				$etxt=substr($etxt,0,$place).'<span class="conscolor">'.substr($etxt,$place);
				}
	  
	  $place=strpos($etxt,$point,$place+33);
	  } else{//下面的意思是,如果在引号内
		  $place=strpos($etxt,$point,$place+1);
		  }
	  
}//循环完毕	
	
	return $etxt;
}

function getspace($txt){ //去首尾空和单行的换行符
//$txt = mb_ereg_replace('^(　| )+', '', $txt); 
//$txt = mb_ereg_replace('(　| )+$', '', $txt); 
//$txt = mb_ereg_replace('　　', "\n　　", $txt);	
return preg_replace("/(\r\n|\n|\r|\t)/i", '', $txt);
}

function getnum($all,$txt,$num){ //全部文本 ,指定文本 ,指定位置   获取指定位置前的指定字符出现次数  
$all=substr($all,0,$num); //从指定位置截取文本
if (strpos($all,$txt)=== false){ //如果找不到文本
return '0';
}
else {
	$numb=0;//次数初始化
	$place=0;//位置初始化
do
  {
  $place=strpos($all,$txt,$place);
  if(is_int($place)){
	  $place++;
	  $numb++;  
	  }
  
  }
while (is_int($place));	
	return $numb;
} //else完毕
}//子程序完毕

function getSubstr($str, $leftStr, $rightStr)//取文本中间
{
    $left = strpos($str, $leftStr);
   // echo '左边:'.$left;
    $right = strpos($str, $rightStr,$left);
   // echo '<br>右边:'.$right;
    if($left < 0 or $right < $left) return '';
    return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
}

?>