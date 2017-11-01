<?php

define('CURSCRIPT', 'news');
require './include/common.inc.php';

$newsfile = GAME_ROOT.'./gamedata/tmp/news/newsinfo_'.$room_prefix.'.php';
$newshtm = GAME_ROOT.'./gamedata/tmp/news/newsinfo_'.$room_prefix.'.htm';
$lnewshtm = GAME_ROOT.'./gamedata/tmp/news/lastnews_'.$room_prefix.'.htm';

if(filemtime($newsfile) > filemtime($lnewshtm)) {
	$lnewsinfo = \sys\load_news(0, $newslimit);
	$lnewsinfo = '<ul>'.implode('',$lnewsinfo).'</ul>';
	writeover($lnewshtm,$lnewsinfo);
}
if(!isset($newsmode)) $newsmode = '';
if (isset($sendmode) && $sendmode == 'news' && isset($lastnid)) {//��Ϸҳ��鿴����״���ĵ��ã���Ϊ����load����Mod���Բ��ܷ�chat.php
	if($___MOD_SRV) {//���daemon����������ͼ����daemon
		$url = 'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'],0,-8).'command.php';
		$context = array('command'=>'get_news_in_game', 'lastnid'=>$lastnid, 'news_room_prefix' => $room_prefix);
		$newsinfo = send_post($url, $context);
		ob_clean();
		echo $newsinfo;
		ob_end_flush();
	}else{//����ֱ��ִ��
		$lastnid = (int)$lastnid;
		$newsinfo = \sys\getnews($lastnid);
		ob_clean();
		$jgamedata = gencode($newsinfo);
		echo $jgamedata;
		ob_end_flush();
	}
} elseif($newsmode == 'last') {//����news.php�鿴����״���ĵ��ã����ڿ��ܳ�ʱ��û���ж���ͳһ�鿴ҳ�滺��	
	//echo file_get_contents($lnewshtm);
	$newsdata['innerHTML']['newsinfo'] = file_get_contents($lnewshtm);
	if(isset($error)){$newsdata['innerHTML']['error'] = $error;}
	ob_clean();
	$jgamedata = gencode($newsdata);
	echo $jgamedata;
	ob_end_flush();
} elseif($newsmode == 'all') {
	if(filemtime($newsfile) > filemtime($newshtm)) {
		$newsinfo = \sys\load_news();
		$newsinfo = '<ul>'.implode('',$newsinfo).'</ul>';
		writeover($newshtm,$newsinfo);
	}
	//echo file_get_contents($newshtm);
	$newsdata['innerHTML']['newsinfo'] = file_get_contents($newshtm);
	if(isset($error)){$newsdata['innerHTML']['error'] = $error;}
	ob_clean();
	$jgamedata = gencode($newsdata);
	echo $jgamedata;
	ob_end_flush();	

} else {
	include template('news');
}
?>