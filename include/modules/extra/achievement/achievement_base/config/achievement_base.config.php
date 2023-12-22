<?php
namespace achievement_base{
	
	//成就总列表，按先后顺序
	//过期的成就会放到最后
	$achtype=array(
		31=>'2017十一活动',
		32=>'2017万圣节活动',
		33=>'2018春节活动',
		34=>'2018愚人节活动',
		20=>'日常任务',
		10=>'结局成就',
		3=>'战斗成就',
		1=>'道具成就',
		4=>'特殊挑战',
		2=>'竞速挑战',
		19=>'隐藏成就',//实际的判定是成就技能里的secret标签
		5=>'终生成就',
		//0=>'其他成就',
	);
	
	//生效中的所有成就
	$achlist=array(//为了方便调整各成就的显示顺序放在这里了
		1=>array(300,302,303,304,358,353,354,357,355),
		2=>array(308,309,322,323,359),
		3=>array(310,311,312,347,348,356),
		4=>array(325,313,326,367,351,352,368,369,370,380),
		5=>array(363,364),
		10=>array(371,305,301,306,307,350),
		19=>array(377,375,376,378,379),
		20=>array(314,315,316,317,318,319,320,321,324,332,333,334,335,336,337,338,339,340,341,342,343,346,372,373,374),
		31=>array(327,328,329),
		32=>array(330,331),
		33=>array(360,361,362),
		34=>array(365,366),
	);
	
	//成就起止时间，如果设置，则只认非零的数据
	$ach_available_period=array(
		31=>array(1506816000, 1508111999),
		32=>array(1509465600, 1510012799),
		33=>array(1518739200, 1521935999),
		34=>array(1522540800, 1524441599)
	);
	
	//成就编号=>允许完成的模式，未定义则用0键的数据
	$ach_allow_mode=array(
		0 => array(0, 4, 6, 10, 13, 14, 15, 16, 18, 19),//默认标准、自选、随机、SOLO、试炼、组队、伐木、解离、荣耀、极速都可以完成
		//300 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//补给成就，也允许在PVP和PVE房完成
		301 => array(0, 4, 6, 18, 19),//解禁结局，只能五大模式完成
		//302 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//KEY催泪弹总数成就
		//303 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//KEY燃烧弹总数成就
		//304 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//KEY生命弹总数成就
		305 => array(0, 4, 6, 18, 19),//幸存结局，只能五大模式完成
		306 => array(0, 4, 6, 18, 19),//核爆结局，只能五大模式完成
		307 => array(0, 4, 6, 18, 16),//解离成就，不能在极速完成但是可以在解离房完成
		308 => array(0, 4, 6, 10, 13, 15, 18, 19),//KEY弹竞速成就，SOLO和伐木也能完成。组队房、解离房都能合作加速，因此不能完成
		309 => array(0, 4, 6, 10, 13, 15, 18, 19),//贤者竞速成就，同上
		//310 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//杀NPC总数成就
		311 => array(0, 4, 6, 10, 14, 18, 19),//击杀玩家成就，不能在单机房完成
		//312 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//杀SCP总数成就
		313 => array(15),//伐木模式成就
		
		//314 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//所有日常任务也允许在PVP和PVE房完成。这个是杀10NPC任务
		315 => array(0, 4, 6, 10, 14, 18, 19),//日常杀1玩家任务，允许在PVP房完成
		//316 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//日常杀200杂兵任务
		//317废弃
		318 => array(0, 4, 6, 18, 16),//日常解离成就，只允许在标准、卡片、随机、荣耀和解离房完成
		//319废弃
		//320废弃
		//321 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//日常杀2全息任务
		322 => array(0, 4, 6, 18),//30分钟死斗成就，只允许标准、卡片、随机卡片和荣耀模式完成
		323 => array(0, 4, 6, 18, 16),//最速解离成就，只允许在标准、卡片、随机、荣耀和解离房完成
		//324 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//日常升到20级
		//325 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//常磐之心，用精灵球或小黄武器杀NPC
		326 => array(0, 4, 6, 18, 19),//全能骑士成就，只能五大模式完成		
		
		327 => array(18),//2017年十一活动，荣耀房NPC成就
		328 => array(18),//2017年十一活动，荣耀房杀玩家成就
		329 => array(18),//2017年十一活动，荣耀房破灭之诗成就
		330 => array(0, 4, 6, 19),//2017万圣节活动成就1，允许极速房完成
		331 => array(0, 4, 6, 19),//2017万圣节活动成就2，允许极速房完成
		
		//332 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//日常6熟任务
		//333 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),
		//334 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),
		//335 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),
		//336 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),
		//337 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),
		//338 => array(0, 4, 6, 10, 14, 15, 16, 18, 19),//日常最大生命任务
		
		//339-343 击杀职人等5种NPC
		
		344 => array(0, 4, 6, 10, 14, 18, 19),//日常使用KEY弹杀死1名活跃玩家，可以在PVP房完成。注意此成就已不在日常列表中
		345 => array(0, 4, 6, 10, 14, 18, 19),//日常使用小黄杀死1名活跃玩家，可以在PVP房完成。注意此成就已不在日常列表中
		346 => array(0, 4, 6, 10, 14, 18, 19),//日常使用陷阱杀死1名活跃玩家，可以在PVP房完成
		347 => array(0, 4, 6, 18, 19),//日常10分钟后入场并获胜，只能五大模式完成		
		348 => array(4, 6, 18, 19),//日常杀高级卡成就，只能在有卡片的模式完成		
		349 => array(0, 4, 6, 10, 14, 18),//危险地区杀玩家成就，可以在PVP房完成，但是极速因为没有SCP所以不行。注意此成就已不在日常列表中
		
		350 => array(19),//极速模式解禁胜利
		351 => array(1),//除错模式
		352 => array(1),//除错模式
		
		//353-355 合成一发逆转、绝冲、破则成就，都能完成
		
		356 => array(0, 4, 6, 10, 14, 18, 19),//用4种方式击杀玩家，可以在PVP房完成
		
		//357-358 合成EX和方块系，都能完成
		
		359 => array(19),//极速模式10分钟胜利
		
		361 => array(0, 4, 6),//2018年春节活动2
		365 => array(0, 4, 6),//2018年愚人节活动
		366 => array(0, 4, 6),//2018年愚人节活动
		//367 => array(0, 4, 6),//破解
		368 => array(0, 4, 6, 18),//清空NPC成就
		//369不同方式复活三次，都能完成
		//370生命上限，都能完成
		371 => array(17),//完成教程模式
		374 => array(4, 6, 18, 19),//日常用C/M卡获胜成就，只能在有卡片的模式完成
		377 => array(4, 6, 18, 19),//隐藏
		378 => array(4, 6, 18, 19),//隐藏
		379 => array(0, 4, 6, 10, 14, 18, 19),//隐藏
		380 => array(13),//试炼房专属成就
	);
	
	//日常成就间隔时间。一天四次真的是“日常”成就？
	$daily_intv = 21600;
	
	//日常成就类型列表，这里影响能够获得的日常成就。只有这里和$achlist都定义的日常成就才是有效的
	$daily_type = array(
		//类别1，自我挑战，升级、熟练等
		1=>array(324,332,333,334,335,336,337,338),
		//类别2，PVE战斗成就，杀特定NPC之类的
		2=>array(314,316,321,339,340,341,342,343),
		//类别3，挑战类成就，包括杀玩家、获取金钱等
		3=>array(315,318,346,372,373,374)
	);
	
	//成就页面每行几个成就窗格
	$ach_show_num_per_row = 3;
}
?>