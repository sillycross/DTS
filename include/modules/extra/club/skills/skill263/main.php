<?php

namespace skill263
{
	function init() 
	{
		define('MOD_SKILL263_INFO','club;');
		eval(import_module('clubbase'));
		$clubskillname[263] = '格斗';
	}
	
	function acquire263(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function lost263(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function check_unlocked263(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return $pa['lvl']>=11;
	}
	
	function get_internal_def(&$pa,&$pd,$active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ((\skillbase\skill_query(263,$pd))&&(check_unlocked263($pd))) return $chprocess($pa,$pd,$active)+$pd['wp'];
		return $chprocess($pa,$pd,$active);
	}
	
	function strike_finish(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if (\skillbase\skill_query(263,$pd) && check_unlocked263($pd))
		{
			if (\skillbase\skill_query(261,$pd))
			{
				$t=(int)\skillbase\skill_getvalue(261,'lastuse',$pd);
				if ($t>0) $chance=35; else $chance=20;
			}
			else	$chance=20;
			if ($pd['club']!=19) $chance=10;
			if (rand(0,99)<$chance)
			{
				eval(import_module('logger'));
				$dmgred=min($pd['wp'],800);
				if ($active)
					$log.='<span class="yellow">敌人精湛的格斗技术抵挡了'.$dmgred.'点伤害！</span><br>';
				else	$log.='<span class="yellow">你精湛的格斗技术抵挡了'.$dmgred.'点伤害！</span><br>';
				$pa['dmg_dealt']-=$dmgred;
				if ($pa['dmg_dealt']<1) $pa['dmg_dealt']=1;
			}
		}
		return $chprocess($pa,$pd,$active);
	}
}

?>
