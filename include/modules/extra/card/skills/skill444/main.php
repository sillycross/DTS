<?php

namespace skill444
{
	
	function init() 
	{
		define('MOD_SKILL444_INFO','club;unique;locked;');
		eval(import_module('clubbase'));
		$clubskillname[444] = '怒吼';
	}
	
	function acquire444(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function lost444(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function check_unlocked444(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return 1;
	}
	
	function get_final_dmg_multiplier(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$r=Array();
		if ((\skillbase\skill_query(444,$pa))&&(check_unlocked444($pa)))
		{
			eval(import_module('logger'));
			if ($active)
				$log.="<span class=\"yellow\">“就杀那个最菜的！”「怒吼」使你造成的最终伤害提高了50%！</span><br>";
			else  $log.="<span class=\"yellow\">“就杀那个最菜的！”「怒吼」使敌人造成的最终伤害提高了50%！</span><br>";
			$r=Array(1.5);	
		}
		return array_merge($r,$chprocess($pa,$pd,$active));
	}
	
	function get_hitrate(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if (!\skillbase\skill_query(444,$pa) || !check_unlocked444($pa)) return $chprocess($pa, $pd, $active);
		return $chprocess($pa, $pd, $active)*0.45;
	}
	
	function get_rapid_accuracy_loss(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if (!\skillbase\skill_query(444,$pa) || !check_unlocked444($pa)) return $chprocess($pa, $pd, $active);
		return $chprocess($pa, $pd, $active)*0.9;
	}
}

?>
