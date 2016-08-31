<?php

namespace skill301
{
	function init() 
	{
		define('MOD_SKILL301_INFO','achievement;');
		define('MOD_SKILL301_ACHIEVEMENT_ID','1');
	}
	
	function acquire301(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		\skillbase\skill_setvalue(301,'cnt','0',$pa);
	}
	
	function lost301(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function skill_onload_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys'));
		if ((!in_array($gametype,$ach_ignore_mode))&&(!\skillbase\skill_query(301,$pa))) 
			\skillbase\skill_acquire(301,$pa);
		$chprocess($pa);
	}
	
	function finalize301(&$pa, $data)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($data=='')					
			$x=0;						
		else	$x=base64_decode_number($data);		
		$ox=$x;
		$x+=\skillbase\skill_getvalue(301,'cnt',$pa);
		$x=min($x,(1<<30)-1);
		
		if (($ox<1)&&($x>=1)){
			\cardbase\get_qiegao(300,$pa);
		}
		if (($ox<10)&&($x>=10)){
			\cardbase\get_qiegao(1600,$pa);
		}
		
		return base64_encode_number($x,5);		
	}
	
	function itemuse(&$theitem)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player'));
		if ($theitem['itm']=="游戏解除钥匙"){
			if (\skillbase\skill_query(301)){
				\skillbase\skill_setvalue(301,'cnt',1);
				\player\player_save($sdata);//gameover的时候是不会多存一次玩家数据的，所以要加这一句卧槽
			}
		}
		$chprocess($theitem);
	}

	function show_achievement301($data)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($data=='')
			$p301=0;
		else	$p301=base64_decode_number($data);	
		$c301=0;
		if ($p301>=10){
			$c301=999;
		}else if ($p301>=1){
			$c301=1;
		}
		include template('MOD_SKILL301_DESC');
	}
}

?>
