<?php

namespace skill423
{
	function init() 
	{
		define('MOD_SKILL423_INFO','card;unique;hidden;');
		eval(import_module('clubbase'));
		$clubskillname[423] = '魔鬼';
	}
	
	function acquire423(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		\skillbase\skill_setvalue(423,'lvl','0',$pa);
	}
	
	function lost423(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		\skillbase\skill_delvalue(423,'lvl',$pa);
	}
	
	function check_unlocked423(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return 1;
	}

	function apply_total_damage_modifier_down(&$pa,&$pd,$active){
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if (!\skillbase\skill_query(423,$pd) || !check_unlocked423($pd)) return $chprocess($pa,$pd,$active);
		eval(import_module('logger'));
		if ($pa['type']==88){
			$pa['dmg_dealt']=0;
			if ($active) $log .= "<span class=\"yellow\">你的攻击被敌人完全化解了！</span><br>";
			else $log .= "<span class=\"yellow\">不知为什么，敌人穷凶极恶的攻击只是轻轻地落在了你的身后。</span><br>";
		}
		$chprocess($pa,$pd,$active);
	}
	
	//面对scp时，玩家攻击获得经验恒为1。
	function apply_attack_exp_gain(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if (!\skillbase\skill_query(423,$pa) || !check_unlocked423($pa)) return $chprocess($pa,$pd,$active);
		
		if ($pd['type']==88){
			\lvlctl\getexp(1, $pa);
		}else return $chprocess($pa,$pd,$active);
	}
}

?>
