<?php

namespace skill325
{
	function init() 
	{
		define('MOD_SKILL325_INFO','achievement;');
		define('MOD_SKILL325_ACHIEVEMENT_ID','25');
	}
	
	function acquire325(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function lost325(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function skill_onload_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys'));
		if ((!in_array($gametype,$ach_ignore_mode))&&(!\skillbase\skill_query(325,$pa)))
		{
			\skillbase\skill_acquire(325,$pa);
			\skillbase\skill_setvalue(325,'cnt','0',$pa);
		}
		$chprocess($pa);
	}
	
	function finalize325(&$pa, $data)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($data=='')					
			$x=0;						
		else	$x=base64_decode_number($data);	
		
		$z=(int)\skillbase\skill_getvalue(325,'cnt',$pa);
		$ox=$x;
		$x=$ox+$z;
		
		if (($ox<1)&&($x>=1)){
			\cardbase\get_qiegao(233,$pa);
		}
		
		if (($ox<100)&&($x>=100)){
			\cardbase\get_qiegao(2333,$pa);
			\cardbase\get_card(119,$pa);
		}
		
		return base64_encode_number($x,5);		
	}
	
	function player_kill_enemy(&$pa,&$pd,$active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('map'));
		if (\skillbase\skill_query(325,$pa) && $pd['type']>0 && $pa['attackwith']=='精灵球' && $areanum==0 && (!isset($pa['bskill']) || $pa['bskill']==0))
		{
			$x=(int)\skillbase\skill_getvalue(325,'cnt',$pa);
			$x+=1;
			\skillbase\skill_setvalue(325,'cnt',$x,$pa);
		}
		$chprocess($pa, $pd, $active);
	}	
	
	function show_achievement325($data)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($data=='')
			$p325=0;
		else	$p325=base64_decode_number($data);	
		$c325=0;
		if ($p325>=100)
			$c325=999;
		else if ($p325>=1)
			$c325=1;
		include template('MOD_SKILL325_DESC');
	}
}

?>
