<?php

namespace sys
{

	/*Game resources*/

	//■ 空手武器 ■
	$nowep = '拳头';

	//■ 无防具 ■
	$noarb = '内衣';
	//■ 无道具 ■
	$noitm = '--';
	//■ 无限耐久度 ■
	$nosta = '∞';
	//■ 无属性 ■
	$nospk = '--';
	//■ 多种类武器 ■
	$mltwk = '泛用兵器';
	//■ 多重属性 ■
	//$mltspk = '多重属性';


	//游戏状态描述
	$gstate = Array(0 => '<font color="grey">已结束</font>',5 => '正在准备',10 => '即将开始',20 => '开放激活',30 => '人数已满',40=> '<font color="yellow">连斗中</font>',50=>'<font color="red">死斗中</font>');
	$gwin = Array(0 => '程序故障', 1 => '全部死亡',2 => '最后幸存',3 => '锁定解除',4 => '无人参加',5 => '核弹引爆',6 => 'GM中止',7=>'幻境解离',8=>'挑战结束');
	$gtinfo=array(
		0=>'标准模式',
		1=>'<font class="cyan">除错挑战</font>',
		2=>'<font class="orange">周五活动</font>',//未开启
		3=>'<font class="lime">宝石乱斗</font>',//未开启
		4=>'自选卡片',
		5=>'幻界叫唤',//2018圣诞模式，目前未开启
		6=>'随机卡片',
		10=>'SOLO模式',
		//11=>'二队模式',//已被组队模式取代
		//12=>'三队模式',//已被组队模式取代
		13=>'<font class="red">试炼模式</font>',
		14=>'组队模式',
		15=>'<font class="yellow">伐木挑战</font>',
		16=>'<font class="green">解离模式</font>',
		17=>'教程模式',
		18=>'<font class="cyan">荣耀模式</font>',
		19=>'<font class="red">极速模式</font>',
	);
	$gtdesc=array(
		0=>'不能使用卡片',
		4=>'入场时自选一张卡片',
		6=>'入场时使用随机卡片'
	);
	$week = Array('日','一','二','三','四','五','六');
	$gamevarsinfo = array(
		'next_gametype' => '游戏模式'
	);
	
	//状态描述和死亡语登记处，全部写在这里，不要写在模块里，不然数字编号冲突就不好了
	$stateinfo = Array(
		0=>'正常存活',
		1=>'睡眠状态',
		2=>'治疗状态',
		3=>'静养状态',
		4=>'教程获胜',
		5=>'最后幸存',//不再使用
		6=>'游戏获胜',//不再使用
		10 => '莫名身亡',
		11 => '禁区停留',
		12 => '毒发身亡', 
		13 => '意外死亡',
		14 => '系统清缴', 
		15 => '黑幕抹杀', 
		16 => '尸骨无存', 
		17 => '致命冰雹',
		18 => '烧伤不治', 
		20 => '战败身亡', //空手
		21 => '战败身亡', //殴
		22 => '战败身亡', //斩
		23 => '战败身亡', //射
		24 => '战败身亡', //投
		25 => '战败身亡', //爆
		26 => '误食毒物', 
		27 => '误触陷阱', 
		28 => '死亡笔记',
		29 => '战败身亡', //灵
		30 => '误触机关', 
		31 => 'L5病发', 
		32 => '挂机受罚', 
		33 => '天降软妹，无福消受', 
		34 => '溶剂作用', 
		35 => '救济',
		36 => '惨遭腰斩', 
		37 => '身首异处', 
		38 => '业火灼烧',
		39 => '惨遭反弹',//sc特殊技能
		40 => '自爆身亡',
		41 => '自杀袭击',
		42 => '自我完结',//技能500特殊死法
		43 => '战败身亡',//弓系
		44 => '意识散逸',
		45 => '意识散逸',
		46 => '维度跳跃',
		47 => '伐木失败',//伐木模式
		48 => '拥抱绝望',//技能500特殊死法
		49 => '迎接轮回',//技能701特殊死法
	);
	
	$dinfo = Array(
		10 => '不知道什么原因，你死去了。<br>这应该是一个BUG，请通知管理员。<br>',
		11 => '“滴滴滴——”<br>这是……手机闹铃的提示音？<br>“糟糕！还没确认这次的禁区情况——”<br>还没等你有所反应，死神一般的空间裂缝已经把你吞没了。<br>等待你的只有死亡……<br>',
		12 => '“呜……到此为止了吗……”<br>毒素造成的痛苦让你无法再坚持下去了。<br>你吐出嘴里最后一点深黑的血液，仰面倒了下去。<br>',
		13 => '“不好！”<br>也许在平时的你看来，这只是小菜一碟……<br>但对于此刻遍体鳞伤的你来说，<br>眼前的突发状况无异于压垮骆驼的最后一根稻草。<br>你不甘心地倒下了，再也没有起来。<br>',
		14 => '“糟糕，被反击系统发现了！”<br>看着设备屏幕上飞速变幻的恐怖图案，你情急之下拔出武器准备直接破坏它。<br><span class="evergreen b">“目标锁定，反击执行。”</span><br>你的全身就像冻住了一样动弹不得，你意识到自己大限已到。<br>随后，汹涌的反击代码把你彻底吞没了。<br>',
		15 => '“我很抱歉，不过这是管理员的意思。”<br>这奇怪的声音是什么意思？<br>你正要一探究竟，只见眼前白光一闪，你的意识就此烟消云散。<br>',
		16 => '“……竟然一点有用的东西都不剩下了吗？！”，又是一个失望的声音。<br>死人是无法主宰自我的，一个又一个参战者经过你的尸体，搜刮走了所有有用的东西。<br>你所有曾经在这个世界上留下的痕迹都被抹平了。<br>',
		17 => '“呜……到此为止了吗……”<br>身体已被冰雹砸得千疮百孔，伤痛让你无法再坚持下去了。<br>你脚下一软，向前栽倒，失去了意识。<br>',
		18 => '“呜……到此为止了吗……”<br>烧伤导致的伤痛让你无法再坚持下去了。<br>你脚下一软，向前栽倒，失去了意识。<br>',
		20 => '对方仅凭拳头就冲破了你的防御，<br>但你已经来不及感到惊讶了，<br>因为这一拳击穿了你的胸膛。<br>“这就是……拳法……？”你的意识就像夜幕降临一般黯淡下去。<br>黑暗中，唯有那颗象征死亡的星星闪耀着……<br>',
		21 => '已经没救了吧。<br>你两手拼命挣扎着想要逃离战场，<br>但下半身早已失去了知觉。<br>对方慢悠悠地绕到你面前，<br>扬起那根打断了你的脊梁的钝器。<br>你最后听到的声音，是你天灵盖的碎裂声。<br>',
		22 => '一切……都结束了吧……<br>对方把剑一拔，失去了支撑的你无力地倒在地上，<br>眼睁睁地看着血液从致命的刀伤喷涌而出。<br>对方若无其事、潇洒收剑的身影，<br>在你失神的瞳孔中逐渐淡去……<br>',
		23 => '你放弃了捂住伤口止血的想法。<br>毕竟浑身的血窟窿已经不可能捂得住了。<br>你轻蔑地望着端枪向你走来的对方，<br>努力抬起右手做了一个打枪的手势：“砰”。<br>之后，你的意识也随着一声枪响烟消云散了。<br>',
		24 => '对方的武器不过是用手掷出的，<br>然而那武器现在深深地嵌进了你的胸口，<br>你甚至已经没有力气把它拔出来。<br>“竟然会被这种东西打垮……”<br>你的意识同支持不住的身体一起轰然倒下了。<br>',
		25 => '“那是谁的手？”<br>被爆炸震得发晕的你，正要捡起眼前那只断手，<br>却发现你的手腕以下已经不翼而飞。<br>硝烟逐渐散去，身边散落的碎块越看越像是你自己的“零件”。<br>一阵眩晕袭来，你倒在了血泊的正中央。<br>',
		26 => '“这味道……不对！”<br>饥渴难耐的你才咬了一口手中的补给品，就觉得不对劲。<br>然而，你发现得太晚了……<br>剧毒在几秒钟之内就夺去了你的生命。<br>',
		27 => '“什么！这里竟然……”<br>没能留意到陷阱的你，只能眼睁睁看着轰然启动的陷阱无情地撕碎你的身躯。<br>“啊啊……这是……哪个混蛋……”<br>你的双眼被鲜血永远地掩盖了。<br>',
		28 => '你被很奇怪的事情夺去了生命。<br>也许这跟一个名叫夜什么月的人有一星半点的关系。<br>具体情况请参见游戏状况。<br>',
		29 => '灵力肆意灼烧着你的身躯，<br>刺骨的痛楚让你跪倒在地。<br>记忆的断片像走马灯一样在你眼前闪过，<br>然而你似乎找不到哪怕是一段温暖的回忆。<br>“这也是……灵能的攻击吗？”<br>你带着无尽的不甘闭上了双眼。<br>',
		30 => '好奇心果然杀死猫啊……<br>你勉强支起破碎的身躯，<br>看着那个你刚才按下的带按钮的小盒子无奈地笑着。<br>这真是残酷的恶作剧啊。<br>你的意识逐渐模糊了……<br>',
		31 => '注射器里的药液才打进一半，你就觉得身体有异样。<br>“脖子……好痒……”<br>你疯狂地抠着脖子上的淋巴腺，<br>很快就倒在动脉破裂而流出的血泊中……<br>',
		32 => '“就躲在这里，让那些人自相残杀去吧。”<br>你正打着自己的小算盘，却被一声怒喝打断了。<br>“来人，这里有个挂机党！”<br>你惊愕地看着不知从哪里冒出来的玩家们把你团团围住。<br>“浪费时间，快去死吧！”<br>之后的事情，就太猎奇了……<br>',
		33 => '“对不起、对不起！能让我迫降一下吗？”<br>勉强躲过弹幕的你，忽然听到头上传来这样焦急的道歉声。<br>少女的迫降……？莫非是指……<br>少女娇柔的话音让你放松了警惕。<br>还没等你反应过来，少女——以及她乘坐的、几十吨重的机体——便把你的整个世界压得粉碎……<br>',
		34 => '将手中的溶剂一饮而尽之后，你感到全身就像燃烧起来一样。<br>“没错，我需要的就是这种力量！”<br>然而，你的手腕像奶油般熔化了。<br>当你看到自己的手掌在地上扑腾的时候，你才发现这场豪赌押错了边。<br>“那么，你就燃烧殆尽吧。”在意识崩解前，传来了一个女声的叹息。<br>',
		35 => '在你失去意识之前，你仿佛听到了一个冰冷的声音。<br>“像你这样的Homo-Speculator……”<br>“……真是最差劲的个体了”<br>然后，你看着你的身体和意识在一道圣光中溶解了。<br>',
		36 => '你徒劳地想挣脱丝带的束缚，<br>但是从丝带上传来的巨大压力，简简单单地将你一分两半。<br>真是杂鱼一样的死法……<br>',
		37 => '你徒劳地想躲避丝带，<br>但是说时迟那时快，你发现你的头正在骨碌碌地往山脚下滚去。<br>真是杂鱼一样的死法……<br>',
		38 => '你成功地躲避了丝带，<br>没想到从丝带中竟然喷出了岩浆！<br>你的意识在烈火中消失了。<br>',
		39 => '“这…… 这不科学！”<br>在最后残存的意识里，你还在努力分辨着那个像U却不是U的字母究竟是什么。',
		40 => '你被对方暴风骤雨般的攻击打得毫无还手之力。对方欺身向前，准备了结你的性命。你不甘就这么死去，振臂高呼到：<br><span class="cyan">“安拉胡阿克巴！”</span><br>对方这才发现你腰间绑着一排明晃晃的炸药。<br>你用尽最后的力气拉响了引线，猛地扑了上去。剧烈的爆炸一瞬间就夺去了你的生命。',
		41 => '你暴风骤雨般的攻击将对方打得毫无还手之力，正当你欺身向前，准备了结对方的性命时，对方忽然振臂高呼：<br><span class="cyan">“安拉胡阿克巴！”</span><br>你这才发现对方腰间绑着一排明晃晃的炸药，但他已猛地扑了上来。剧烈的爆炸一瞬间就夺去了你的生命。',
		42 => '当最后一名对手倒下时，你才如梦初醒。<br>“独存……又有何用！我明明……明明发誓要拯救你、拯救所有人的！”<br>你将枪口抵住自己的太阳穴，抿着嘴唇扣动了扳机。',
		43 => '箭矢深深地嵌进了你的胸口，<br>而你甚至已经没有力气把它拔出来。<br>“死状竟然像刺猬一样呢……”<br>你的意识同支持不住的身体一起轰然倒下了。<br>',
		44 => '“不好，灯泡……”<br>激烈的战斗把你怀抱着的巨大灯泡打得粉碎。<br>虽然幻境并不需要靠它运转，但你的灵魂已然无法维系了。<br>“这又是要我要去何方……？”在那惨白到恐怖的光芒中，你的身影彻底消失无踪。',
		45 => '“不好，灯泡……”<br>你一个不留神，灯泡在清澈的撞击声中打得粉碎。<br>虽然幻境并不需要靠它运转，但你的灵魂已然无法维系了。<br>“这又是要我要去何方……？”在那惨白到恐怖的光芒中，你的身影彻底消失无踪。',
		46 => '<span class="grey b">“海干了鱼就要聚集在水洼里，水洼也在干涸，鱼都将消失……”</span><br>在倒计时即将结束之际，一阵莫名的呢喃声让你有些不安。但下一刹那，你的身体就被彻底撕碎，直至连基本粒子都不复存在……<br>——引燃维度跳跃之火的柴薪，只能是你自己。<br><span class="grey b">“我是墓地，我是死的，谁都不会攻击。不同维度之间没有黑暗森林，低维威胁不到高维，低维的资源对高维没有用。”</span><br>在你意识的最后几秒，那不祥的声音依然在低语着……',
		47 => '“麻的，才打这点钱，你是来伐木的还是来白嫖的。”伐木解除钥匙还在骂骂咧咧，而你的意识逐渐模糊……',
		48 => '“我第一的话，ta就变成全幻境最不幸的人了吧……”<br>看着远方天际逐渐逼近的禁区力场，你按捺住心中的绝望，闭上了眼睛。<br>“……先休息一下，之后再想吧。”',
		49 => '你意识到自己的生命即将走到尽头，而不知为何，你对此似乎早有预料。<br>“这就是过目不忘的代价吗？”<br>你这样想着，然后合上了双眼。',
	);
	
	$sexinfo = Array(0=> '未定', 'm' => '男生', 'f' => '女生');
	
	$chatinfo = Array(0 => '全员', 1 => '队伍', 2 => '密语', 3 => '遗言', 4 => '公告', 5 => '系统', 6 => '剧情');

	/*Infomations*/
	$_INFO = Array(
		'reg_success' => '注册成功！请返回首页登陆游戏。',
		'pass_success' => '修改密码成功。',
		'pass_failure' => '未修改密码。',
		'data_success' => '接受对帐户资料的修改。',
		'data_failure' => '未修改帐户资料。'
	);

	/*Error settings*/
	$_ERROR = Array(
		'db_failure' => '数据库读写异常，请重试或通知管理员',
		'name_not_set' => '用户名不能为空，请检查用户名输入',
		'name_too_long' => '用户名过长，请检查用户名输入',
		'name_invalid' => '用户名含有非法字符，请检查用户名输入',
		'name_banned' => '用户名含有违禁用语，请检查用户名输入',
		'name_exists' => '用户名已被注册，请更换用户名',
		'pass_not_set' => '密码不能为空，请检查密码输入',
		'pass_not_match' => '两次输入的密码不一致，请检查密码输入',
		'pass_too_short' => '密码过短，请检查密码输入',
		'pass_too_long' => '密码过长，请检查密码输入',
		'ip_banned' => '此IP已被封禁，请与管理员联系',
		'logged_in' => '用户已登录，请先退出登陆再注册',
		'user_not_exists' => '用户不存在，请检查用户名输入',
		
		'no_login' => '用户未登陆，请从首页登录后再进入游戏',
		'login_check' => '用户信息验证失败，请退出账号并重新登录，或清空缓存后尝试',
		'login_time' => '登录间隔时间过长，请重新登录后进入游戏',
		'login_info' => '用户信息不正确，请清空缓存和Cookie后进入游戏',
		'player_limit' => '本局游戏参加人数已达上限，无法进入，请下局再来',
		'wrong_pw' => '用户名或密码错误，请检查输入',
		'player_exist' => '角色已经存在，请不要重复激活',
		'no_start' => '游戏尚未开始，请稍后再登录',
		'valid_stop' => '本游戏已经停止激活，无法进入，请下局再来',
		'user_ban' => '此账号禁止进入游戏，请与管理员联系',
		'no_admin' => '你不是管理员，不能使用此功能',
		'ip_limit' => '本局此IP激活人数已满，请下局再来',
		'no_power' => '你的管理权限不够，不能进行此操作',
		'wrong_adcmd' => '指令错误，请重新输入',
		//'invalid_name' => '用户名含有非法字符，请重新输入',
		//'banned_name' => '用户名含有违禁用语，请更改用户名',
		//'banned_ip' => '此IP已被封禁，请与管理员联系',
		//'long_name' => '用户名过长，请重新输入用户名'
		'kuji_failure'=>'切糕不足，或输入了错误的抽卡参数',
	);
	
}

?>