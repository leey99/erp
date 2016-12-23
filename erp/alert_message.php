<?
$sub_menu = "100100";
include_once("./_common.php");
$mb_profile_code = $member['mb_profile'];
if($mb_profile_code != "1") {
	$sql_search = " where read_branch = '' ";
} else {
	$sql_search = " where read_main = '' ";
}
if($member['mb_id'] == "master") $sql_search .= " and alert_code = '90001' ";
else $sql_search .= " and alert_code != '90001' ";

if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search .= " and send_to not like '%branch%' ";
} else {
	$sql_search .= " and ( branch='$mb_profile_code' or branch2='$mb_profile_code' ) ";
}

$sql = "select * from erp_alert $sql_search order by idx desc limit 0, 2 ";
$result = sql_query($sql);
//echo $sql;
$now_time = date("Y-m-d H:i:s");
$now = strtotime($now_time);
/*
$row = sql_fetch($sql);

//echo $end." ".$now;

//echo "<span style='color:white'>".$time."<BR>".$on1."day".$diff_in_hours."시간 남음";
//if ($row['com_code']) {
*/
?>
<div style="">
	<div style="float:left;background: url('images/top_bar.gif') repeat-x;padding:7px 0 0 20px">
<?
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$idx = $row['idx'];
	$id = $row['com_code'];
	$qstr = "";
	$page = "";
	$alert_code = $row['alert_code'];
	$client_process_view = "alert_read_link.php?link_url=process&idx=$idx&id=$id&w=u&$qstr&page=$page&alert_code=$alert_code";
	$com_name_full = $row['com_name'];
	$com_name_full_text = iconv("CP949", "UTF-8", rawurldecode($row['com_name']));
	$com_name = cut_str($com_name_full, 16, "..");
	$com_name = iconv("CP949", "UTF-8", rawurldecode($com_name));
	$memo_full = $row['memo'];
	$memo_full_text = iconv("CP949", "UTF-8", rawurldecode($row['memo']));
	$memo = cut_str($memo_full, 28, "..");
	$memo = iconv("CP949", "UTF-8", rawurldecode($memo));
	$end = strtotime($row['wr_datetime']);
	$time = $now - $end;
	$on1 = floor($time / 86400);
	$rest_hours = $time % 86400;
	$diff_in_hours = floor($rest_hours / 3600);
	if($on1 == 0 && $diff_in_hours < 2) $new_icon = "<img src='images/new_big.gif' width='35' height='15' style='vertical-align:middle'>";
	else $new_icon = "";
	echo "<div id='blink".$i."'>";
	echo "<img src='images/icon_02_white.gif' width='2' height='2' style='vertical-align:middle'><a style='color:white;' href='".$client_process_view."'> ".$com_name." ".$memo."</a>";
	echo  $new_icon;
	echo "</div>";
}
if ($i == 0) {
	$no_memo = "새로운 알림이 없습니다.";
	$no_memo = iconv("CP949", "UTF-8", rawurldecode($no_memo));
	echo "<div style='color:white;height:40px'><img src='images/icon_02_white.gif' width='2' height='2' style='vertical-align:middle'> $no_memo</div>";
}
//담당자 읽지 않은 알림 있을 경우 내알림 버튼 깜빡임
if($member['mb_id'] == "kcmc1004" || $member['mb_id'] == "kcmc1005") $mb_id = "manager";
else $mb_id = $member['mb_id'];
$sql_my = " select count(*) as cnt from erp_alert where read_main = '' and ( send_to like '%$mb_id%' ) ";
//echo $sql_my;
$row_my = sql_fetch($sql_my);
if($row_my['cnt'] > 0) $btn_alert_my = "images/btn2_alert_my_blink.gif";
else $btn_alert_my = "images/btn2_alert_my.gif";
?>
	</div>
	<div style="float:left;padding:7px 0 0 14px">
<?
if($member['mb_profile'] == 1) {
?>
		<img src="<?=$btn_alert_my?>" style="margin:0 0 0 0;cursor:pointer;vertical-align:middle" onclick="self.location.href='alert_my.php';" usemap="">
<?
}
?>
		<img src="images/btn2_alert_total.gif" style="margin:0 0 0 0;cursor:pointer;vertical-align:middle" onclick="self.location.href='alert_list.php';" usemap="">
	</div>
</div>
<map name="plus.gif">
	<area shape="rect" coords="-2,0,50,15" href="alert_my.php" target="" alt="" />
	<area shape="rect" coords="1,16,49,31" href="alert_list.php" target="" alt="" />
</map>
<?
mysql_close();
?>