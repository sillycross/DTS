<?php

//房间设置

//最大房间数目
$max_room_num = 5;

//长轮询端口号范围
$room_poll_port_low = 25000;
$room_poll_port_high = 35000;

//房间类型
$roomtypelist = Array(
	
	0 => Array(
		'name' => 'SOLO模式',
		'gtype' => 10, //对应的游戏模式编号
		'continuous' => false,//唯一房间，只有不存在时才会新建房间。
		'pnum' => 2,	//最大参与人数
		'leader-position' => Array(	//各个编号位置的所属队伍队长位置
			0 => 0,
			1 => 1,
		),
		'color' => Array(		//队伍颜色，只需对队长设置即可
			0 => 'ff0022',
			1 => '5900ff',
		),
		'teamID' => Array(	//队伍名，只需对队长设置即可
			0 => '红队',
			1 => '蓝队',
		),
		'show-team-leader' => 0,	//是否显示“队长”标签（如队伍大于1人设为1）
	),
	
	1 => Array(
		'name' => '二队模式',
		'gtype' => 11, //对应的游戏模式编号
		'continuous' => false,//唯一房间，只有不存在时才会新建房间。
		'pnum' => 10,
		'leader-position' => Array(
			0 => 0,
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 5,
			6 => 5,
			7 => 5,
			8 => 5,
			9 => 5,
		),
		'color' => Array(
			0 => 'ff0022',
			5 => '5900ff',
		),
		'teamID' => Array(
			0 => '红队',
			5 => '蓝队',
		),
		'show-team-leader' => 1,
	),
	/*
	2 => Array(
		'name' => '3v3模式',
		'pnum' => 6,
		'leader-position' => Array(
			0 => 0,
			1 => 0,
			2 => 0,
			3 => 3,
			4 => 3,
			5 => 3,
		),
		'color' => Array(
			0 => 'ff0022',
			3 => '5900ff',
		),
		'teamID' => Array(
			0 => '红队',
			3 => '蓝队',
		),
		'show-team-leader' => 1,
	),*/
	2 => Array(
		'name' => '三队模式',
		'gtype' => 12, //对应的游戏模式编号
		'continuous' => false,//唯一房间，只有不存在时才会新建房间。
		'pnum' => 15,
		'leader-position' => Array(
			0 => 0,
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 5,
			6 => 5,
			7 => 5,
			8 => 5,
			9 => 5,
			10 => 10,
			11 => 10,
			12 => 10,
			13 => 10,
			14 => 10,
		),
		'color' => Array(
			0 => 'ff0022',
			5 => '5900ff',
			10 => '8cff00',
		),
		'teamID' => Array(
			0 => '红队',
			5 => '蓝队',
			10 => '绿队',
		),
		'show-team-leader' => 1,
	),
	3 => Array(
		'name' => '四队模式',
		'gtype' => 13, //对应的游戏模式编号
		'continuous' => false,//唯一房间，只有不存在时才会新建房间。
		'pnum' => 20,
		'leader-position' => Array(
			0 => 0,
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 5,
			6 => 5,
			7 => 5,
			8 => 5,
			9 => 5,
			10 => 10,
			11 => 10,
			12 => 10,
			13 => 10,
			14 => 10,
			15 => 15,
			16 => 15,
			17 => 15,
			18 => 15,
			19 => 15,
		),
		'color' => Array(
			0 => 'ff0022',
			5 => '5900ff',
			10 => '8cff00',
			15 => 'ffc700',
		),
		'teamID' => Array(
			0 => '红队',
			5 => '蓝队',
			10 => '绿队',
			15 => '黄队',
 		),
		'show-team-leader' => 1,
	),
	4 => Array(
		'name' => '五队模式',
		'gtype' => 14, //对应的游戏模式编号
		'continuous' => false,//唯一房间，只有不存在时才会新建房间。
		'pnum' => 25,
		'leader-position' => Array(
			0 => 0,
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 5,
			6 => 5,
			7 => 5,
			8 => 5,
			9 => 5,
			10 => 10,
			11 => 10,
			12 => 10,
			13 => 10,
			14 => 10,
			15 => 15,
			16 => 15,
			17 => 15,
			18 => 15,
			19 => 15,
			20 => 20,
			21 => 20,
			22 => 20,
			23 => 20,
			24 => 20,
		),
		'color' => Array(
			0 => 'ff0022',
			5 => '5900ff',
			10 => '8cff00',
			15 => 'ffc700',
			20 => 'fefefe',
		),
		'teamID' => Array(
			0 => '红队',
			5 => '蓝队',
			10 => '绿队',
			15 => '黄队',
			20 => '白队',
 		),
		'show-team-leader' => 1,
	),
	5 => Array(
		'name' => '<span class="yellow">伐木挑战</span>',
		'gtype' => 15, //对应的游戏模式编号
		'continuous' => false,//唯一房间，只有不存在时才会新建房间。
		'pnum' => 1,	//最大参与人数
		'leader-position' => Array(	//各个编号位置的所属队伍队长位置
			0 => 0,
		),
		'color' => Array(		//队伍颜色，只需对队长设置即可
			0 => 'ff0022',
		),
		'teamID' => Array(	//队伍名，只需对队长设置即可
			0 => '挑战者',
		),
		'show-team-leader' => 0,	//是否显示“队长”标签（如队伍大于1人设为1）
		'card' => array(
			0 => '0',
		)
	),
	6 => Array(
		'name' => '<span class="green">PVE</span> 解离模式',
		'gtype' => 16, //对应的游戏模式编号
		'continuous' => false,//唯一房间，只有不存在时才会新建房间。
		'pnum' => 3,	//最大参与人数
		'leader-position' => Array(	//各个编号位置的所属队伍队长位置
			0 => 0,
			1 => 0,
			2 => 0,
		),
		'color' => Array(		//队伍颜色，只需对队长设置即可
			0 => 'ff0022',
		),
		'teamID' => Array(	//队伍名，只需对队长设置即可
			0 => '挑战者',
		),
		'show-team-leader' => 1,	//是否显示“队长”标签（如队伍大于1人设为1）
		'card' => array(
			0 => '90',
			1 => '91',
			2 => '92',
		)
	),
	7 => Array(//教程模式为唯一房间
		'name' => '<span class="red">教程模式</span>',
		'gtype' => 17, //对应的游戏模式编号
		'continuous' => true,//永续房间，只有不存在时才会新建房间。此外，启用这个设置时不显示等待界面直接进入游戏
		'req-mod' => 'gtype17_tutorial',//暂时只是摆设
		'pnum' => 999,	//最大参与人数，负数表示无限
		'leader-position' => Array(	//各个编号位置的所属队伍队长位置
			0 => 0,
		),
		'color' => Array(		//队伍颜色，只需对队长设置即可
			0 => 'ff0022',
		),
		'teamID' => Array(	//队伍名，只需对队长设置即可
			0 => '试炼者',
		),
		'show-team-leader' => 0,	//是否显示“队长”标签（如队伍大于1人设为1）
		'card' => array(
			0 => '0',
		)
	),
);
	
?>