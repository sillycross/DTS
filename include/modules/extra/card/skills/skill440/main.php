<?php

namespace skill440
{
	$skill440_cd = 200;
	
	function init() 
	{
		define('MOD_SKILL440_INFO','club;battle;unique;locked;');
		eval(import_module('clubbase'));
		$clubskillname[440] = '父爱';
	}
	
	function acquire440(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','skill440'));
		\skillbase\skill_setvalue(440,'lastuse',$now,$pa);
	}
	
	function lost440(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
	}

	function check_unlocked440(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		return 1;
	}
	
	//return 1:技能生效中 2:技能冷却中 3:技能冷却完毕 其他:不能使用这个技能
	function check_skill440_state(&$pa){
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if (!\skillbase\skill_query(440, $pa) || !check_unlocked440($pa)) return 0;
		eval(import_module('sys','player','skill440'));
		$l=\skillbase\skill_getvalue(440,'lastuse',$pa);
		if (($now-$l)<=$skill440_cd) return 2;
		return 3;
	}
	
	function strike_prepare(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($pa['bskill']!=440) return $chprocess($pa, $pd, $active);
		if (!\skillbase\skill_query(440,$pa) || !check_unlocked440($pa))
		{
			eval(import_module('logger'));
			$log .= '你尚未解锁这个技能！';
			$pa['bskill']=0;
		}
		else
		{
			eval(import_module('sys','skill440'));
			$l=\skillbase\skill_getvalue(440,'lastuse',$pa);
			if (($pd['type']!=0)&&($now-$l>=$skill440_cd)){
				eval(import_module('logger'));
				if ($active)
					$log.="<span class=\"lime\">你对{$pd['name']}发动了技能「父爱」！</span><br>";
				else  $log.="<span class=\"lime\">{$pa['name']}对你发动了技能「父爱」！</span><br>";
				\skillbase\skill_setvalue(440,'lastuse',$now,$pa);
				$pd['skill440_flag']=1;
				addnews ( 0, 'bskill440', $pa['name'], $pd['name'] );
			}
			else
			{
				if ($active)
				{
					eval(import_module('logger'));
					$log.='因对方非玩家或其他原因而未发动技能。<br>';
				}
				$pa['bskill']=0;
			}
		}
		$chprocess($pa, $pd, $active);
	}	
	
	function bufficons_list()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player'));
		\player\update_sdata();
		if ((\skillbase\skill_query(440,$sdata))&&check_unlocked440($sdata))
		{
			eval(import_module('skill440'));
			$skill440_lst = (int)\skillbase\skill_getvalue(440,'lastuse'); 
			$skill440_time = $now-$skill440_lst; 
			$z=Array(
				'disappear' => 0,
				'clickable' => 1,
				'hint' => '战斗技「父爱」',
				'activate_hint' => '战斗技「父爱」已就绪<br>在战斗界面可以发动',
				'onclick' => "",
			);
			if ($skill440_time<$skill440_cd)
			{
				$z['style']=2;
				$z['totsec']=$skill440_cd;
				$z['nowsec']=$skill440_time;
			}
			else 
			{
				$z['style']=3;
			}
			\bufficons\bufficon_show('img/skill440.gif',$z);
		}
		$chprocess();
	}
	
	function skill_query($skillid, &$pa = NULL)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('skillbase'));
		$skillid=(int)$skillid;
		if ($pa!=NULL && $pa['skill440_flag'])
		{
			//所有称号技能失效
			if (defined('MOD_SKILL'.$skillid.'_INFO') && strpos(constant('MOD_SKILL'.$skillid.'_INFO'),'club;')!==false && strpos(constant('MOD_SKILL'.$skillid.'_INFO'),'hidden;')===false)
				return 0;
		}
		return $chprocess($skillid,$pa);
	}
	
	function parse_news($news, $hour, $min, $sec, $a, $b, $c, $d, $e)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('sys','player'));
		
		if($news == 'bskill440') 
			return "<li>{$hour}时{$min}分{$sec}秒，<span class=\"clan\">{$a}对{$b}发动了技能<span class=\"yellow\">「父爱」</span></span><br>\n";
		
		return $chprocess($news, $hour, $min, $sec, $a, $b, $c, $d, $e);
	}
}

?>
