<?php

namespace skill316
{
	function init() 
	{
		define('MOD_SKILL316_INFO','achievement;daily;');
		define('MOD_SKILL316_ACHIEVEMENT_ID','16');
	}
	
	function acquire316(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		\skillbase\skill_setvalue(316,'cnt','0',$pa);
	}
	
	function lost316(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}

	function finalize316(&$pa, $data)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($data=='')					
			$x=0;						
		else	$x=base64_decode_number($data);		
		$ox=$x;
		$x+=\skillbase\skill_getvalue(316,'cnt',$pa);		
		$x=min($x,(1<<30)-1);
		
		if (($ox<200)&&($x>=200)){
			\cardbase\get_qiegao(250,$pa);
		}
		
		return base64_encode_number($x,5);		
	}
	
	function player_kill_enemy(&$pa,&$pd,$active){
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ( \skillbase\skill_query(316,$pa) && $pd['type']==90 && $pd['hp'] <= 0)
		{
			$x=(int)\skillbase\skill_getvalue(316,'cnt',$pa);
			$x+=1;
			\skillbase\skill_setvalue(316,'cnt',$x,$pa);
		}
		$chprocess($pa, $pd, $active);
	}	
	
	function show_achievement316($data)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($data=='')
			$p316=0;
		else	$p316=base64_decode_number($data);	
		$c316=0;
		if ($p316>=200){
			$c316=999;
		}
		include template('MOD_SKILL316_DESC');
	}
}

?>
