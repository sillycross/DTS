<?php

namespace clubbase
{
	function init() {}
	
	//获得内定称号，$pa为NULL时代表当前玩家
	//注意这个函数不检查玩家是否可以获得这个称号
	function club_acquire($clubid, &$pa = NULL)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('clubbase'));
		
		if ($pa == NULL)
		{
			eval(import_module('player'));
			$club = $clubid;
		}
		else  $pa['club'] = $clubid;
		
		foreach ($clublist[$clubid]['skills'] as $key)
			if (defined('MOD_SKILL'.$key))
				\skillbase\skill_acquire($key,$pa);
	}
	
	//因为某些原因失去内定称号，$pa为NULL时代表当前玩家
	function club_lost(&$pa = NULL)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('clubbase','logger'));
		
		foreach (\skillbase\get_acquired_skill_array($pa) as $skillid) 
			if (defined('MOD_SKILL'.$skillid.'_INFO') && strpos(constant('MOD_SKILL'.$skillid.'_INFO'),'club;')!==false)
				\skillbase\skill_lost($skillid,$pa);

		if ($pa == NULL)
		{
			$club = 0;
		}
		else  $pa['club'] = 0;
	}
	
	function club_randseed_calc($modval, $baseval, $curgid, $curuid, $curpid, $sttime, $vatime)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$s=((string)$baseval).((string)$curgid).((string)$baseval).((string)$curuid).((string)$curpid).((string)$sttime).((string)$baseval).((string)$vatime).((string)$baseval);
		$s=md5($s);
		$hashval=0;
		for ($i=0; $i<strlen($s); $i++) $hashval=($hashval*269+ord($s[$i]))%$modval;
		return $hashval;
	}
	
	function get_club_choice_array()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('sys','player','clubbase'));
		
		//取消了费时的数据库查询，反正现在这样也预测不了了
		$curgid=$gamenum;
		$curuid=233;
		$curpid=$pid+3;
		
		$mod_value = 5000077;
		$base_value = 6397;
		
		$sttime = $starttime;
		$vatime = 233;
		
		$ret = Array(0);
		for ($clubtype = 0; $clubtype <= 1; $clubtype++)
		{
			$clubcnt = 0; $club_waitlist = Array(); $p_sum = 0;
			foreach ($clublist as $key => $value) 
				if ($value['type']==$clubtype)
				{ 
					$clubcnt ++; 
					array_push($club_waitlist, Array('id' => $key, 'pr' => $value['probability']));
					$p_sum += $value['probability'];
				}
			
			for ($k=0; $k<min($max_club_choice_num[$clubtype],$clubcnt); $k++)
			{
				if ($p_sum == 0) break;
				$base_value = ($base_value + club_randseed_calc($mod_value, $base_value, $curgid, $curuid, $curpid, $sttime, $vatime)) % $mod_value;
				$dice = club_randseed_calc($mod_value, $base_value, $curgid, $curuid, $curpid, $sttime, $vatime);
				$dice = $dice % $p_sum + 1;
				for ($i=0; $i<count($club_waitlist); $i++)
				{
					if ($dice <= $club_waitlist[$i]['pr'])
					{
						array_push($ret,$club_waitlist[$i]['id']);
						$p_sum -= $club_waitlist[$i]['pr'];
						$club_waitlist[$i]['pr']=0;
						break;
					}
					else  $dice -= $club_waitlist[$i]['pr'];
				}
			}
		}
		
		sort($ret);
		return $ret;
	}
	
	function player_selectclub($id)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('sys','player','clubbase'));
		if ($club!=0) return 1;
		if ($id==0) return 2;
		if ($id<0) return 3;
		$ret = get_club_choice_array();
		if ($id>=count($ret)) return 3;
		club_acquire($ret[$id]);
		return 0;
	}

	function act()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		
		eval(import_module('sys','player','logger','input'));
		
		if($mode == 'special' && strpos($command,'clubsel') === 0) 
		{
			$clubchosen = substr($command,7); $clubchosen = (int)$clubchosen;
			$retval = player_selectclub($clubchosen);
			if ($retval==0)
				$log.="称号选择成功。<br>";
			else if ($retval==1)
				$log.="称号选择失败，称号一旦被选择便无法更改。<br>";
			else if ($retval==2)
				$log.="未选择称号。<br>";
			else  $log.="称号选择非法！<br>";
			$mode = 'command';
			return;
		}
		
		if ($mode == 'special' && $command == 'viewskills') 
		{
			$mode = MOD_CLUBBASE_SKILLPAGE;
			return;
		}
		
		if ($mode == 'special' && substr($command,0,5) == 'skill' && substr($command,-8)=='_special' && $subcmd=='upgrade') 
		{
			$id=substr($command,5,-8); $id=(int)$id;
			if (defined('MOD_SKILL'.$id.'_INFO') && strpos(constant('MOD_SKILL'.$id.'_INFO'),'upgrade;')!==false && \skillbase\skill_query($id))
			{
				$func='skill'.$id.'\\upgrade'.$id;
				$func();
			}
			else
			{
				$log.='你不能发动这个技能。<br>';
			}
			$mode = MOD_CLUBBASE_SKILLPAGE;
			return;
		}
			
		$chprocess();
	}
	
	function skill_query_unlocked($id)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		$id=(int)$id;
		$func = 'skill'.$id.'\\check_unlocked'.$id;
		eval(import_module('player'));
		return $func($sdata);
	}
	
	function get_battle_skill_entry(&$edata,$which)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		if ($which==3) $zflag = 1; else $zflag = 0;
		eval(import_module('clubbase','player'));
		foreach ($clublist[$club]['skills'] as $key) 
			if (defined('MOD_SKILL'.$key.'_INFO'))
				if (strpos(constant('MOD_SKILL'.$key.'_INFO'),'club;')!==false && strpos(constant('MOD_SKILL'.$key.'_INFO'),'battle;')!==false && \skillbase\skill_query($key))
				{
					$flag = 0;
					if (strpos(constant('MOD_SKILL'.$key.'_INFO'),'hidden;')!==false) $flag = 1;
					if (!$flag) 
					{
						$func = 'skill'.$key.'\\check_unlocked'.$key;
						if ($func($sdata)) $flag = 1;
					}
					if ($flag)
					{
						$which--;
						if ($which==0)
						{
							if ($zflag) echo '<span style="display:block;height:6px;">&nbsp;</span>';
							include template(constant('MOD_SKILL'.$key.'_BATTLECMD'));
							return;
						}
					}
				}
		foreach (\skillbase\get_acquired_skill_array() as $key) 
			if (!in_array($key,$clublist[$club]['skills']))
				if (defined('MOD_SKILL'.$key.'_INFO'))
					if (strpos(constant('MOD_SKILL'.$key.'_INFO'),'club;')!==false && strpos(constant('MOD_SKILL'.$key.'_INFO'),'battle;')!==false)
					{
						$flag = 0;
						if (strpos(constant('MOD_SKILL'.$key.'_INFO'),'hidden;')!==false) $flag = 1;
						if (!$flag) 
						{
							$func = 'skill'.$key.'\\check_unlocked'.$key;
							if ($func($sdata)) $flag = 1;
						}
						if ($flag)
						{
							$which--;
							if ($which==0)
							{
								if ($zflag) echo '<span style="display:block;height:6px;">&nbsp;</span>';
								include template(constant('MOD_SKILL'.$key.'_BATTLECMD'));
								return;
							}
						}
					}
	}
					
	function get_profile_skill_buttons()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('player','clubbase'));
		$___TEMP_inclist = Array();
		foreach ($clublist[$club]['skills'] as $key) 
			if (defined('MOD_SKILL'.$key.'_INFO') && strpos(constant('MOD_SKILL'.$key.'_INFO'),'club;')!==false && strpos(constant('MOD_SKILL'.$key.'_INFO'),'active;')!==false && \skillbase\skill_query($key)) 
			{ 
				$flag = 0; 
				if (strpos(constant('MOD_SKILL'.$key.'_INFO'),'hidden;')!==false) $flag = 1; 
				if (!$flag) 
				{ 
					$func = 'skill'.$key.'\\check_unlocked'.$key; 
					if ($func($sdata)) $flag = 1; 
				} 
				if ($flag) 
					array_push($___TEMP_inclist,template(constant('MOD_SKILL'.$key.'_PROFILECMD')));
			}
		foreach (\skillbase\get_acquired_skill_array() as $key) 
			if (!in_array($key,$clublist[$club]['skills']))
				if (defined('MOD_SKILL'.$key.'_INFO') && strpos(constant('MOD_SKILL'.$key.'_INFO'),'club;')!==false && strpos(constant('MOD_SKILL'.$key.'_INFO'),'active;')!==false) 
				{ 
					$flag = 0; 
					if (strpos(constant('MOD_SKILL'.$key.'_INFO'),'hidden;')!==false) $flag = 1; 
					if (!$flag) 
					{ 
						$func = 'skill'.$key.'\\check_unlocked'.$key; 
						if ($func($sdata)) $flag = 1; 
					} 
					if ($flag) 
						array_push($___TEMP_inclist,template(constant('MOD_SKILL'.$key.'_PROFILECMD'))); 
				}
		
		foreach ($___TEMP_inclist as $___TEMP_template_name) include $___TEMP_template_name;
		
	}
	
	function get_skillpage()
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('player','clubbase'));
		$___TEMP_inclist = Array();
		foreach ($clublist[$club]['skills'] as $key) 
			if (defined('MOD_SKILL'.$key.'_INFO') && strpos(constant('MOD_SKILL'.$key.'_INFO'),'club;')!==false && strpos(constant('MOD_SKILL'.$key.'_INFO'),'hidden;')===false && \skillbase\skill_query($key)) 
				array_push($___TEMP_inclist,template(constant('MOD_SKILL'.$key.'_DESC')));

		foreach (\skillbase\get_acquired_skill_array() as $key) 
			if (!in_array($key,$clublist[$club]['skills']))
				if (defined('MOD_SKILL'.$key.'_INFO') && strpos(constant('MOD_SKILL'.$key.'_INFO'),'club;')!==false && strpos(constant('MOD_SKILL'.$key.'_INFO'),'hidden;')===false) 
					array_push($___TEMP_inclist,template(constant('MOD_SKILL'.$key.'_DESC'))); 
		
		foreach ($___TEMP_inclist as $___TEMP_template_name) include $___TEMP_template_name;
	}
	
	//载入玩家发动的攻击技能
	function load_user_combat_command(&$pdata)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('input'));
		$pdata['bskill']=$bskill; $pdata['bskillpara']=$bskillpara;
		$chprocess($pdata);
	}
	
	function check_npc_clubskill_load(&$pa)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('clubbase','logger'));
		
		if (!isset($clublist[$pa['club']]) || !isset($clublist[$pa['club']]['skills']) || count($clublist[$pa['club']]['skills'])==0)
			return;
			
		if (!\skillbase\skill_query($clublist[$pa['club']]['skills'][0],$pa))
		{
			club_acquire($pa['club'],$pa);
		}
	}
			
	//让NPC获取称号技能
	function battle_prepare(&$pa, &$pd, $active)
	{
		if (eval(__MAGIC__)) return $___RET_VALUE;
		eval(import_module('clubbase'));
		if ($pa['type'] && $pa['club']) check_npc_clubskill_load($pa);
		if ($pd['type'] && $pd['club']) check_npc_clubskill_load($pd);
		$chprocess($pa, $pd, $active);
	}
	
}

?>
