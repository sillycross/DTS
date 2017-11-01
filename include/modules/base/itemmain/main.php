<?php

namespace itemmain
{
	function init() 
	{
		eval(import_module('player'));
		global $item_equip_list;
		$equip_list=array_merge($equip_list,$item_equip_list);
	}
	
	//1:一般可合并道具  2:食物  0:不可合并
	function check_mergable($ik){
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if(preg_match('/^(WC|WD|WF|Y|B|C|TN|GB|M|V|ygo|fy|p)/',$ik)) return 1;
		elseif(preg_match('/^(H|P)/',$ik)) return 2;
		else return 0;
	}
	
	function parse_itmname_words($name_value, $elli = 0){
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if(!$elli) return $name_value;
		
		$width=20; //显示宽度20英文字符，假设汉字的显示宽度大约是英文字母的1.8倍
		$ilen=mb_strlen($name_value);
		$slen=0;
		for($i=0;$i<$ilen;$i++){
			$c=mb_substr($name_value,$i,1);
			if(strlen($c) > mb_strlen($c)) $slen+=1.8;//是汉字或别的UTF-8字符，显示宽度+1.8
			else $slen+=1;//是英文字母或其他ascii字符，显示宽度+1
			if($slen >= $width) break;
		}
		if($i==$ilen) return $name_value;
		else return middle_abbr($name_value,$i-1);
	}
	
	function parse_itmk_words($k_value)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('itemmain'));
		if($k_value){	
			$best=-1;
			$ret='未知';
			foreach($iteminfo as $info_key => $info_value)
			{
				if(strpos($k_value,$info_key)===0){
					if (strlen($info_key)>$best)
					{
						$best=strlen($info_key);
						$ret = $info_value;
					}
				}	
			}
		} else {
			$ret = '';
		}
		return $ret;
	}
	
	function count_itmsk_num($sk_value)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$ret=0;
		for ($i=0; $i<strlen($sk_value); $i++)
		{
			if ('a'<=$sk_value[$i] && $sk_value[$i]<='z') $ret+=2;
			if ('A'<=$sk_value[$i] && $sk_value[$i]<='Z') $ret+=2;
			if ($sk_value[$i]=='^') $ret+=1;
		}
		$ret/=2; $ret=(int)$ret;
		return $ret;
	}
	
	function get_itmsk_array($sk_value)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$ret = Array();
		$i = 0;
		while ($i < strlen($sk_value))
		{
			$sub = substr($sk_value,$i,1); $i++;
			if(!empty($sub)){
				if ($sub=='^')
				{
					while ($i<strlen($sk_value) && '0'<=$sk_value[$i] && $sk_value[$i]<='9') 
					{
						$sub.=$sk_value[$i];
						$i++;
					}
					if ($i<strlen($sk_value) && $sk_value[$i]=='^')
					{
						$sub.='^'; $i++;
					}
					else  continue;
				}
				array_push($ret,$sub);
			}					
		}
		return $ret;		
	}
	
	function parse_itmsk_words($sk_value, $simple = 0)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('itemmain'));
		if($sk_value && is_numeric($sk_value) === false && strpos($sk_value,'=')!==0){
			$ret = '';
			$i = 0;
			while ($i < strlen($sk_value))
			{
				$sub = substr($sk_value,$i,1); $i++;
				if(!empty($sub)){
					if ($sub=='^')
					{
						while ($i<strlen($sk_value) && '0'<=$sk_value[$i] && $sk_value[$i]<='9') 
						{
							$sub.=$sk_value[$i];
							$i++;
						}
						if ($i<strlen($sk_value) && $sk_value[$i]=='^')
						{
							$sub.='^'; $i++;
						}
						else  continue;
					}
					
					if(!empty($ret)){
						if ($simple)
							$ret .= $itemspkinfo[$sub];
						else  $ret .= '+'.$itemspkinfo[$sub];
					}else{
						$ret = $itemspkinfo[$sub];
					}					
				}
				
			}
		} else {
			if ($simple)
				$ret='';
			else  $ret =$nospk;
		}
		return $ret;
	}
	
	//把身上装备道具的显示信息全部处理一遍
	//$elli=1时自动省略超过10个字的道具名的中间部分
	//$simple=1时没有有属性间加号，无属性直接返回空
	function parse_item_words($edata, $simple = 0, $elli = 1)	
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('player','itemmain'));
		$r=Array();
		
		foreach ($equip_list as $v) {
			$z=strlen($v)-1;
			while ('0'<=$v[$z] && $v[$z]<='9') $z--;//注意这同样也会把wep等包括进去！
			$r[$v.'_words'] = parse_itmname_words($edata[$v], $elli);
			$kv=substr($v,0,$z+1).'k'.substr($v,$z+1);
			$r[$kv.'_words'] = parse_itmk_words($edata[$kv]);
			$skv=substr($v,0,$z+1).'sk'.substr($v,$z+1);
			$r[$skv.'_words'] = parse_itmsk_words($edata[$skv],$simple);
		}
		
		return $r;
		
	}
	
	function parse_interface_profile()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('player'));
		\player\update_sdata();
		$tpldata+=parse_item_words($sdata);
		$chprocess();
	}
	
	function rs_game($xmode)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		$chprocess($xmode);
		
		eval(import_module('sys','map','itemmain'));
		if ($xmode & 16) {	//地图道具初始化
			$plsnum = sizeof($plsinfo);
			$iqry = '';
			$itemlist = get_itemfilecont();
			$in = sizeof($itemlist);
			$an = $areanum ? ceil($areanum/$areaadd) : 0;
			for($i = 1; $i < $in; $i++) {
				if(!empty($itemlist[$i]) && strpos($itemlist[$i],',')!==false){
					list($iarea,$imap,$inum,$iname,$ikind,$ieff,$ista,$iskind) = mapitem_data_process(explode(',',$itemlist[$i]));
					if(strpos($iskind,'=')===0){
						$tmp_pa_name = substr($iskind,1);
						$iskind = '';
						$result = $db->query("SELECT pid FROM {$tablepre}players WHERE name='$tmp_pa_name' AND type>0");
						if($db->num_rows($result)){
							$ipid = $db->fetch_array($result);
							$iskind = $ipid['pid'];
						}
					}
					if(($iarea == $an)||($iarea == 99)) {
						for($j = $inum; $j>0; $j--) {
							if ($imap == 99)
							{
								do {
									$rmap = rand(0,$plsnum-1);
								} while (in_array($rmap,$map_noitemdrop_arealist));
							}
							else  $rmap = $imap;
							$iqry .= "('$iname', '$ikind','$ieff','$ista','$iskind','$rmap'),";
						}
					}
				}
			}
			if(!empty($iqry)){
				$iqry = "INSERT INTO {$tablepre}mapitem (itm,itmk,itme,itms,itmsk,pls) VALUES ".substr($iqry, 0, -1);
				$db->query($iqry);
			}
		}
	}
	
	//某些模式特殊处理数据
	function mapitem_data_process($data){
		if (eval(__MAGIC__)) return $___RET_VALUE; 
		return $data;
	}
	
	function get_itemfilecont(){
		if (eval(__MAGIC__)) return $___RET_VALUE; 
		$file = __DIR__.'/config/mapitem.config.php';
		$l = openfile($file);
		return $l;
	}
	
	function get_startingitemfilecont(){
		if (eval(__MAGIC__)) return $___RET_VALUE; 
		$file = __DIR__.'/config/stitem.config.php';
		$l = openfile($file);
		return $l;
	}
	
	function get_startingwepfilecont(){
		if (eval(__MAGIC__)) return $___RET_VALUE; 
		$file = __DIR__.'/config/stwep.config.php';
		$l = openfile($file);
		return $l;
	}
	
	function discover_item()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('sys','player','logger','itemmain'));
		
		$result = $db->query("SELECT * FROM {$tablepre}mapitem WHERE pls = '$pls'");
		$itemnum = $db->num_rows($result);
		if($itemnum <= 0){
			$log .= '<span class="yellow">周围找不到任何物品。</span><br>';
			$mode = 'command';
			return;
		}
		$itemno = rand(0,$itemnum-1);
		$db->data_seek($result,$itemno);
		$mi=$db->fetch_array($result);
		$itms0 = focus_item($mi);
		if($itms0){
			itemfind();
			return;
		} else {
			$log .= "但是什么都没有发现。<br>";
		}
		$mode = 'command';
	}
	
	function focus_item($iarr){
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player'));
		if(isset($iarr['iid'])){
			$iid = $iarr['iid'];
			$db->query("DELETE FROM {$tablepre}mapitem WHERE iid='$iid'");
			$itm0=$iarr['itm'];
			$itmk0=$iarr['itmk'];
			$itme0=$iarr['itme'];
			$itms0=$iarr['itms'];
			$itmsk0=$iarr['itmsk'];
			return $itms0;
		}
		return false;
	}
	
	function calculate_itemfind_obbs()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('itemmain'));
		return $item_obbs;
	}
	
	function calculate_itemfind_obbs_multiplier()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return 1.0;
	}
	
	function discover($schmode)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$find_obbs = calculate_itemfind_obbs()*calculate_itemfind_obbs_multiplier();
		$dice = rand(0,99);
		if($dice < $find_obbs) {
			discover_item();
			return;
		}
		$chprocess($schmode);
	}
	
	function act()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player','input'));
		if ($mode == 'command' && strpos($command,'itm') === 0) 
		{
			$item = substr($command,3);
			itemuse_wrapper($item);
			return;
		} 
		if ($mode == 'command' && $command == 'itemmain' && 
			($itemcmd=='itemmerge' || $itemcmd=='itemmove' || $itemcmd=='itemdrop'))
		{
			ob_clean();
			if ($itemcmd=='itemmerge') include template(MOD_ITEMMAIN_ITEMMERGE);
			if ($itemcmd=='itemmove') include template(MOD_ITEMMAIN_ITEMMOVE);
			if ($itemcmd=='itemdrop') include template(MOD_ITEMMAIN_ITEMDROP);
			$cmd = ob_get_contents();
			ob_clean();
		}
		if($mode == 'itemmain') {
			if($command == 'itemget') {
				itemget();
			} elseif($command == 'itemadd') {
				itemadd();
			} elseif($command == 'itemmerge') {
				if($merge2 == 'n'){itemadd();}
				else{
					$merge_ret = itemmerge($merge1,$merge2);
					if(!$merge_ret && ${'itm'.$merge1} != ${'itm'.$merge2}) {
						eval(import_module('logger'));
						$log .= '<br>系统将你的命令自动识别为道具移动。';
						itemmove($merge1,$merge2);
					}
				}
			} elseif($command == 'itemmove') {
				itemmove($from,$to);
			} elseif(strpos($command,'drop') === 0) {
				$drop_item = substr($command,4);
				itemdrop($drop_item);
			} elseif(strpos($command,'off') === 0) {
				$off_item = substr($command,3);
				itemoff($off_item);
			} elseif(strpos($command,'swap') === 0) {
				$swap_item = substr($command,4);
				itemdrop($swap_item);
				itemadd();
			} 
		}
		$chprocess();
	}
}

?>
