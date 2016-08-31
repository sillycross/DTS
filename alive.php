<?php

define('CURSCRIPT', 'alive');

require './include/common.inc.php';
//extract(gkillquotes($_POST));
//unset($_GET);

if(!isset($alivemode) || $alivemode == 'last'){
	$query = $db->query("SELECT name,gd,sNo,icon,lvl,exp,killnum,teamID,nskillpara,pid FROM {$tablepre}players WHERE type=0 AND hp>0 order by killnum desc, lvl desc limit $alivelimit");
}elseif($alivemode == 'all'){
	$query = $db->query("SELECT name,gd,sNo,icon,lvl,exp,killnum,teamID,nskillpara,pid FROM {$tablepre}players WHERE type=0 AND hp>0 order by killnum desc, lvl desc");
}else{
	echo 'error';
	exit();
}
//if($alivemode == 'all') {
//	$query = $db->query("SELECT name,gd,sNo,icon,lvl,exp,killnum,teamID FROM {$tablepre}players WHERE type=0 AND hp>0 order by killnum desc, lvl desc");
//} else {
//	$query = $db->query("SELECT name,gd,sNo,icon,lvl,exp,killnum,teamID FROM {$tablepre}players WHERE type=0 AND hp>0 order by killnum desc, lvl desc limit $alivelimit");
//}
while($playerdata = $db->fetch_array($query)) {
	$playerdata['iconImg'] = "{$playerdata['gd']}_{$playerdata['icon']}.gif";
	$result = $db->query("SELECT motto FROM {$gtablepre}users WHERE username = '".$playerdata['name']."'");
	$playerdata['motto'] = $db->result($result, 0);
	/**
	 * 摸东西模式下按照破解层数排名，而不是按照杀人数
	 */
	if ($gametype==1)
	{
		$playerdata['killnum']=(int)\skillbase\skill_getvalue_direct(424,'lvl',$playerdata['nskillpara']);
	}
	
	$alivedata[] = $playerdata;
}

function cmp_by_killnum($a, $b)
{
	if ($a['killnum']==$b['killnum']) 
	{
		if ($a['pid']==$b['pid']) return 0;
		if ($a['pid']>$b['pid']) return -1; else return 1;	//杀人数相同的，后入场靠前
	}
	else  
	{
		if ($a['killnum']>$b['killnum']) return -1; else return 1;
	}
}

usort($alivedata, "cmp_by_killnum");

if(!isset($alivemode)){
	include template('alive');
}else{
	include template('alivelist');
	$alivedata['innerHTML']['alivelist'] = ob_get_contents();
	if(isset($error)){$alivedata['innerHTML']['error'] = $error;}
	ob_clean();
	$jgamedata = compatible_json_encode($alivedata);
	echo $jgamedata;
	ob_end_flush();
}

//include template('alive');

?>