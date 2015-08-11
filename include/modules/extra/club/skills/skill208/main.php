<?php

namespace skill208
{

	$ragecost=70;
	
	function init() 
	{
		define('MOD_SKILL208_INFO','club;battle;');
		eval(import_module('clubbase'));
		$clubskillname[208] = '强袭';
	}
	
	function acquire208(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function lost208(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}
	
	function check_unlocked208(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return $pa['lvl']>=10;
	}
	
	function skill_onload_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$chprocess($pa);
	}
	
	function skill_onsave_event(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$chprocess($pa);
	}
	
	function get_rage_cost208(&$pa = NULL)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('skill208'));
		return $ragecost;
	}
	
	function strike_prepare(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($pa['bskill']!=208) return $chprocess($pa, $pd, $active);
		if (!\skillbase\skill_query(208,$pa) || !check_unlocked208($pa))
		{
			eval(import_module('logger'));
			$log .= '你尚未解锁这个技能！';
			$pa['bskill']=0;
		}
		else
		{
			$rcost = get_rage_cost208($pa);
			if (($pa['rage']>=$rcost)&&($pa['wep_kind']=="K"))
			{
				eval(import_module('logger'));
				if ($active)
					$log.="<span class=\"lime\">你对{$pd['name']}发动了技能「强袭」！</span><br>";
				else  $log.="<span class=\"lime\">{$pa['name']}对你发动了技能「强袭」！</span><br>";
				$pa['rage']-=$rcost;
				addnews ( 0, 'bskill208', $pa['name'], $pd['name'] );
			}
			else
			{
				if ($active)
				{
					eval(import_module('logger'));
					$log.='怒气不足或其他原因不能发动。<br>';
				}
				$pa['bskill']=0;
			}
		}
		$chprocess($pa, $pd, $active);
	}	
	
	function get_ex_phy_def_proc_rate(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($pa['bskill']!=208) return $chprocess($pa, $pd, $active);
		return 0;
	}
	
	function get_ex_dmg_def_proc_rate(&$pa, &$pd, $active, $key)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($pa['bskill']!=208) return $chprocess($pa, $pd, $active);
		return 0;
	}
	
	function get_final_dmg_multiplier(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$r=Array();
		if ($pa['bskill']==208) 
		{
			eval(import_module('logger'));
			if ($active)
				$log.='<span class="yellow">「强袭」使你造成的最终伤害提高了35%！</span><br>';
			else  $log.='<span class="yellow">「强袭」使敌人造成的最终伤害提高了35%！</span><br>';
			$r=Array(1.35);
		}
		return array_merge($r,$chprocess($pa,$pd,$active));
	}

	function parse_news($news, $hour, $min, $sec, $a, $b, $c, $d, $e)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('sys','player'));
		
		if($news == 'bskill208') 
			return "<li>{$hour}时{$min}分{$sec}秒，<span class=\"clan\">{$a}对{$b}发动了技能<span class=\"yellow\">「强袭」</span></span><br>\n";
		
		return $chprocess($news, $hour, $min, $sec, $a, $b, $c, $d, $e);
	}
}

?>
