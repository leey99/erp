<?
$sub_menu = "300100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_a4 = " select com_code, com_name from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4['com_code'];
$com_name = $row_a4['com_name'];

$sub_title = "���µ��";
$g4[title] = $sub_title." : ���°��� : ".$member['mb_nick'];
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
function modify(id,toYear,toMonth,monthday) {
	location.href = "attendance_view.php?id="+id+"&toYear="+toYear+"&toMonth="+toMonth+"&monthday="+monthday;
}
// ���� �˻� Ȯ��
function del(id,toYear,toMonth) {
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "attendance_delete.php?id="+id+"&toYear="+toYear+"&toMonth="+toMonth;
	}
}
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function checked_ok() {
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	//alert(chk_data);
	if(cnt==0) {
	 alert("���õ� �����Ͱ� �����ϴ�.");
	 return;
	} else {
		if(confirm("���� �����Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			//alert(chk_data);
			frm.action="attendance_delete_cnt.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
</script>
<? include "./inc/top.php"; ?>
<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname03.gif" /></td>
								</tr>
								<tr>
									<td><a href="attendance.php" onmouseover="limg1.src='images/menu03_sub01_on.gif'" onmouseout="limg1.src='images/menu03_sub01_off.gif'"><img src="images/menu03_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="vacation.php" onmouseover="limg2.src='images/menu03_sub02_on.gif'" onmouseout="limg2.src='images/menu03_sub02_off.gif'"><img src="images/menu03_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
							</table>
<?
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--Ÿ��Ʋ -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height=1 bgcolor=e0e0de></td></tr>
								<tr><td height=2 bgcolor=f5f5f5></td></tr>
								<tr><td height=5></td></tr>
							</table>

<!--�޷�-->
<style>
.cal_title {font:normal 11px tahoma;color:#666666;padding:5px;}
.tit_sun {font:normal 11px tahoma;font-weight:bold;color:#ff0000;text-align:center;}
.tit_def {font:normal 11px tahoma;font-weight:bold;color:#888;text-align:center;}
.tit_sat {font:normal 11px tahoma;font-weight:bold;color:#1541be;text-align:center;}
.year_tit {font:normal 20px arial;color:#888888;text-align:center;}
.month_tit {font:normal 35px arial;color:#6699cc;font-weight:bold;text-align:center;}
.today_table {text-align:center;padding-bottom:12px;}
.bt_btn {text-align:right;padding:10px 0 30px 0;}
.moonday {font:normal 10px tahoma;color:#999;}
.c_num {font-size:10px;font-family:tahoma;color:#ff6600;}
.t_comment {text-align:left;font-size:11px;color:#888;padding-top:10px;}
</style>
<div id="rcontent" class="center m_side">
<br>
<link rel="stylesheet" href="./css/attendance.css" type="text/css">
<?
if($toYear== '') {
	$toYear = date(Y);
}else{
	$toYear = $_GET[toYear];
}
if($toMonth== '') {
	$toMonth = date(m);
}else{
	$toMonth = $_GET[toMonth];
}
/********** ����� ������ **********/
$startYear	= date( "Y" ) - 4;
$endYear	= date( "Y" ) + 4;
/********** �Է°� **********/
$year	= ( $_GET['toYear'] )? $_GET['toYear'] : date( "Y" );
$month	= ( $_GET['toMonth'] )? $_GET['toMonth'] : date( "m" );
$doms	= array( "��", "��", "ȭ", "��", "��", "��", "��" );

/********** ��갪 **********/
if( $toYear != date("Y") || $toMonth != date("m") ) {
	$mktime		= mktime( 0, 0, 0, $month, 1, $year );	// �Էµ� ������ ��-��-01�� �����
	$days		= date( "t", $mktime );					// ������ year�� month�� ���� ���� �ϼ� ���ؿ���
	$startDay	= date( "w", $mktime );					// ���ۿ��� �˾Ƴ���
} else {
/*
	$mktime		= mktime( 0, 0, 0, $month, date("j"), $year );	// �Էµ� ������ ��-��-01�� �����
	$days		= 48+date("j");					// ������ year�� month�� ���� ���� �ϼ� ���ؿ���
	$next_days	= date( "t", mktime( 0, 0, 0, $month+1, 1, $year ) );					// ������ ���� �ϼ� ���ؿ���
	$startDay	= date( "w", $mktime );					// ���ۿ��� �˾Ƴ���
*/
	$mktime		= mktime( 0, 0, 0, $month, 1, $year );	// �Էµ� ������ ��-��-01�� �����
	$days		= date( "t", $mktime );					// ������ year�� month�� ���� ���� �ϼ� ���ؿ���
	$startDay	= date( "w", $mktime );					// ���ۿ��� �˾Ƴ���
}
// ������ �ϼ� ���ϱ�
$prevDayCount	= date( "t", mktime( 0, 0, 0, $month, 0, $year ) ) - $startDay + 1;
if( $toYear != date("Y") || $toMonth != date("m") ) {
	$nowDayCount	= 1;	// �̹��� ���� ī����
} else {
	//$nowDayCount	= date("j");	// �̹��� ���� ī����
	$nowDayCount	= 1;	// �̹��� ���� ī����
}
$next_month = 0;
$nextDayCount	= 1;	// ������ ���� ī����
// ����, ���� �����
$prevYear	= ( $month == 1 )? ( $year - 1 ) : $year;
$prevMonth	= ( $month == 1 )? 12 : ( $month - 1 );
$nextYear	= ( $month == 12 )? ( $year + 1 ) : $year;
$nextMonth	= ( $month == 12 )? 1 : ( $month + 1 );
// ����� ���
// �̹� ���� �ƴѰ��
if( $toYear != date("Y") || $toMonth != date("m") ) {
	$setRows	= ceil( ( $startDay + $days ) / 7 );
} else {
	// �̹� ���� ���
	// (���� ���� + �̹��� �ϼ� - ���� ��) / 7
	// ��) ��, ��(5,6)�� 1���� �ֿ� �̹����� 30��, 31�ϱ��� �ִ� ��� 6���� ���;� �״޿� ��� ���� ǥ��(���� 36���� ��)
	//$setRows	= (($startDay + date("t") - date("j")) / 7 >= 5) ? 6 : 5;
	$setRows	= ceil( ( $startDay + $days ) / 7 );
}

//���°���DB
$sql_common = " from a4_attendance ";
//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where com_code='$com_code' ";
}
if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "att_day";
	}
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
//������ ����
if(strlen($toMonth) == 1) {
	$toMonth_0add = "0".$toMonth;
} else {
	$toMonth_0add = $toMonth;
}
$att_ym = $toYear."".$toMonth_0add;
$sql_search .= " and att_day like '$att_ym%' ";
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 30;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����
//���� ���� ����Ʈ
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
//�⺰ ���� ����Ʈ
$att_y = $toYear;
$sql_search_year = " where com_code='$com_code' and att_day like '$att_y%' ";
$sql_year = " select *
          $sql_common
          $sql_search_year
          order by att_day asc
          ";
$result_year = sql_query($sql_year);
//�������
$sql1 = " select * from $g4[pibohum_base] where com_code='$com_code' ";
//echo $sql1;
$result1 = sql_query($sql1);
for($i=0; $row1=sql_fetch_array($result1); $i++) {
	//����̸� ����
	$sql2 = " select * from $g4[pibohum_base] where com_code='$com_code' and sabun='$row1[sabun]' ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	$sabun = $row1[sabun];
	$sabun_name[$sabun] = $row2[name];
	//echo $row2[name];
	//echo $sabun_name[$sabun];
}
$colspan = 9;
?>
<table width="100%" border="0" cellpadding="10" cellspacing="1" bgcolor="#999999">
	<tr>
		<td bgcolor="white" align="left" valign="top" style="padding-left:20; line-height:200%;">
			�� ������ : <img src="./skin/attendance/1.gif" align=absmiddle> ���, <img src="./skin/attendance/2.gif" align=absmiddle> ����,
			<img src="./skin/attendance/3.gif" align=absmiddle> ����, <img src="./skin/attendance/4.gif" align=absmiddle> ����,
			<img src="./skin/attendance/5.gif" align=absmiddle> �߰�����, <img src="./skin/attendance/6.gif" align=absmiddle> �߰��ٷ�,
			<!--<img src="./skin/attendance/7.gif" align=absmiddle> ����߰�,-->
			<img src="./skin/attendance/7.gif" align=absmiddle> ����,
			<img src="./skin/attendance/8.gif" align=absmiddle> ����,
			<img src="./skin/attendance/9.gif" align=absmiddle> ����,
			<img src="./skin/attendance/10.gif" align=absmiddle> ��Ÿ,
			<img src="./skin/attendance/11.gif" align=absmiddle> ���ϱٷ�
			<img src="./skin/attendance/12.gif" align=absmiddle> ����
		</td>
	</tr>
</table>
<table width="100%" height="39" border="0" cellpadding="0" cellspacing="0" background="./skin/oc_schedule/img/bar_bg.gif">
	<tr>
		<td width="10">&nbsp;</td>
		<td>
			<p>TODAY : <?=date("Y")?>�� <?=date("m")?>�� <?=date("d")?>�� (<?=$doms[date("w")]?>����)</p>
		</td>
		<td align="right" style="padding-right:6px">
			<div align="right">
				<span class="day4"><?=$toYear?></span><span class="day5">��</span>
				<a href="<?=$_SERVER['PHP_SELF']?>?toYear=<?=$toYear-1?>&toMonth=<?=$toMonth?>" target="_self" onfocus="this.blur()"><img src="./skin/oc_schedule/img/y_prev.gif" border="0" title="2012��" align="abbottom" /></a>
				<a href="<?=$_SERVER['PHP_SELF']?>?toYear=<?=$toYear+1?>&toMonth=<?=$toMonth?>" target="_self" onfocus="this.blur()"><img src="./skin/oc_schedule/img/y_next.gif" border="0" title="2014��" align="abbottom" /></a>
				<span class="day4"><?=$toMonth?></span><span class="day5">��</span>
				<a href="<?=$_SERVER['PHP_SELF']?>?toYear=<?=$prevYear?>&toMonth=<?=$prevMonth?>" target="_self" onfocus="this.blur()"><img src="./skin/oc_schedule/img/m_prev.gif" border="0" align="abbottom" /></a>
				<a href="<?=$_SERVER['PHP_SELF']?>?toYear=<?=$nextYear?>&toMonth=<?=$nextMonth?>" target="_self" onfocus="this.blur()"><img src="./skin/oc_schedule/img/m_next.gif" border="0" align="abbottom" /></a>
			</div>
		</td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbline1">
	<tr>
<? 
for( $i = 0; $i < count( $doms ); $i++ ) {
?>
		<td class="tbline2 bbs_head bbs_fhead" align="center" width="14%">
<?
	if($doms[$i] == '��') {
?>
			<p align="center"><font color="#FF6600"><?=$doms[$i]?> </font></p>
<?
	} else {
?>
			<p align="center"><?=$doms[$i]?></p>
<?
	}
?>
		</td>
<?
}
?>
	</tr>
<?
for( $rows = 0; $rows < $setRows; $rows++ ) {
?>
	<tr>
	<?
	for( $cols = 0; $cols < 7; $cols++ ) {
		// �� �ε��� ������
		$cellIndex    = ( 7 * $rows ) + $cols;
		// �̹����̶��
		if ( $startDay <= $cellIndex && $nowDayCount <= $days ) {
			//���� ������ (���)
			$monthday = date("md", mktime(0,0,0,$toMonth,$nowDayCount,$toYear));
			if($monthday == '0101') {
				$day_title = "����";
			} else if($monthday == '0301') {
				$day_title = "������";
			} else if($monthday == '0505') {
				$day_title = "��̳�";
			} else if($monthday == '0606') {
				$day_title = "������";
			} else if($monthday == '0815') {
				$day_title = "������";
			} else if($monthday == '1003') {
				$day_title = "��õ��";
			} else if($monthday == '1009') {
				$day_title = "�ѱ۳�";
			} else if($monthday == '1225') {
				$day_title = "ũ��������";
			} else {
				$day_title = "";
			}
	?>
		<td height=100 class=tbline2 bgcolor=#FFFFFF valign=top>
			<?
			//echo $nowDayCount;
			if( (!$next_month && date( "t", $mktime ) < $nowDayCount) || ($next_month && $next_days < $nowDayCount) ) {
				$nowDayCount = 1;
				$toMonth = date( "m", mktime( 0, 0, 0, $month+$next_month+1, 1, $year ) );
				$toYear = date( "Y", mktime( 0, 0, 0, $month+$next_month+1, 1, $year ) );
				$next_month++;
			} 
			if(strlen($nowDayCount) == '1') {
				$nowDayno2 = "0".$nowDayCount;
			} else {
				$nowDayno2 = $nowDayCount;
			}
			if(strlen($toMonth) == 1) {
				$toMonth2 = "0".$toMonth;
			} else {
				$toMonth2 = $toMonth;
			}
			$checkdate = $toYear.$toMonth2.$nowDayno2;

			//������ �ݳ⵵ ���� if
			//if($month < date("m") && $year <= date("Y")) {
			//2013�� if
			if($year == 2013) {
				if($monthday >= '0209' && $monthday <= '0211') {
					$day_title = "����(����)";
				} else if($monthday == '0517') {
					$day_title = "����ź����";
				} else if($monthday >= '0918' && $monthday <= '0920') {
					$day_title = "�߼�(����)";
				}
			} else if($year == 2014) {
				if($monthday >= '0130' && $monthday <= '0201') {
					$day_title = "����(����)";
				} else if($monthday == '0506') {
					$day_title = "����ź����";
				} else if($monthday >= '0907' && $monthday <= '0910') {
					$day_title = "�߼�(����)";
				}
			} else {
				//����ó��
			}
			?>
			<div onclick="location.href='attendance_view.php?mod=write&toYear=<?=$toYear?>&toMonth=<?=$toMonth?>&monthday=<?=$monthday?>';" style="float:left;cursor:pointer;width:18px;height:15px;padding-top:3px;font-weight:bold;text-align:center;font-size:10px;font-family:tahoma;background:#efefef;color:#777">
				<?=$nowDayCount++?>
			</div>
			<div style="float:left;padding:2px 0 0 2px;height:20px;width:100px">
				<?=$day_title?>
			</div>
			<br>
<?
//�޷� ���� ǥ��
$sql_att = " select * from a4_attendance where com_code='$com_code' and att_day = '$checkdate' order by sabun desc ";
//echo $sql_att;
$result_att = sql_query($sql_att);
for($i=0; $row_att=sql_fetch_array($result_att); $i++) {
	$id = $row_att[id];
	$att_category = $row_att[att_category];
	//echo $row_att[att_category];
	echo "<img src='./skin/attendance/".$att_category.".gif' align='absmiddle'> ";
	echo "<a href='javascript:modify($id,$toYear,$toMonth,\"$monthday\");'>";
	echo $att_category_array[$att_category]." : ";
	echo $sabun_name[$row_att[sabun]];
	echo "</a><br>";
}
//���� ǥ�� (��������)
$year_monthday = $year.".".substr($monthday,0,2).".".substr($monthday,2,2);
$sql_nomu = " select * from pibohum_base_nomu where com_code='$com_code' and annual_paid_holiday_day = '$year_monthday' ";
$result_nomu = sql_query($sql_nomu);
//$row_nomu = mysql_fetch_array($result_nomu);
for($i=0; $row_nomu=sql_fetch_array($result_nomu); $i++) {
	//if($row_nomu[com_code] == $com_code) {
		echo "<img src='./skin/attendance/10.gif' align='absmiddle'> ";
		echo "���� : ";
		echo $sabun_name[$row_nomu[sabun]];
		echo "<br>";
	//}
}
?>
		</td>
<?
			// �������̶��
			} else if ( $cellIndex < $startDay ) {
?>
		<td height=80 class=tbline2 bgcolor=#FBFBFB valign=top>
<?
			// ������ �̶��
			} else if ( $cellIndex >= $days ) {
?>
		<td height=80 class=tbline2 bgcolor=#FBFBFB valign=top>
<?
		}
	}
?>
	</tr>
<?
}
?>
</table>
<!--�޷�-->

								<br />
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:90;text-align:center'> 
													<?=$toMonth?>�� ���� ��Ȳ
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--����Ʈ -->
								<form name="dataForm" method="post">
								<input type="hidden" name="chk_data">
								<input type="hidden" name="page" value="<?=$page?>">
								<input type="hidden" name="toYear" value="<?=$toYear?>">
								<input type="hidden" name="toMonth" value="<?=$toMonth?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
									<tr>
										<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
										<td nowrap class="tdhead_center" width="80">��������</td>
										<td nowrap class="tdhead_center" width="90">����ð�</td>
										<td nowrap class="tdhead_center" width="90">���¼���</td>
										<td nowrap class="tdhead_center" width="80">�з�</td>
										<td nowrap class="tdhead_center" width="70">�̸�</td>
										<td nowrap class="tdhead_center" width="">�������</td>
										<td nowrap class="tdhead_center" width="60">����</td>
										<td nowrap class="tdhead_center" width="60">����</td>
									</tr>
<?
// ����Ʈ ���
for($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
	$id = $row[id];
	$list = $i%2;
	//��������
	$att_day = date('Y-m-d',strtotime($row[att_day]));
	$monthday = date('md',strtotime($row[att_day]));
	//�з�
	$att_category = $att_category_array[$row[att_category]];
	//���¼���
	$att_rule_2 = explode(":", $row[att_time2]);
	$att_rule_1 = explode(":", $row[att_time]);
	//�� ���
	//$att_rule_min = ($att_rule_2[1] - $att_rule_1[1]);
	//���۽ð� ���� 00�� �ƴϸ�   ���ۺ� = 60 - ���۽ð� ��
	if($att_rule_1[1] != "00") $att_rule_1_min = 60 - $att_rule_1[1];
	else $att_rule_1_min = 0;
	//echo $att_rule_1_min;
	$att_rule_min = ($att_rule_1_min + $att_rule_2[1]);
	//echo $att_rule_min;
	if($att_rule_min >= 60) {
		if($att_rule_min > 60) {
			$att_rule_min = $att_rule_min - 60;
			//$att_rule_hour_plus = 1;
			$att_rule_hour_plus = 0;
		} else {
			//60���� ��� 0 ó�� 160223
			$att_rule_min = 0;
			$att_rule_hour_plus = 0;
		}
	} else {
		if($att_rule_min == 0) $att_rule_hour_plus = 0;
		else {
			if($att_rule_1[1] > $att_rule_2[1]) $att_rule_hour_plus = -1;
			else $att_rule_hour_plus = 0;
		}
	}
	//�ð� ���
	if($att_rule_2[0] < $att_rule_1[0]) {
		$att_rule_hour = (24 - $att_rule_1[0]) + $att_rule_2[0];
	} else {
		$att_rule_hour = ($att_rule_2[0] - $att_rule_1[0]);
	}
	$att_rule_hour += $att_rule_hour_plus;
	//8�ð� �Ѿ ��� �����ٷνð�(��) 8�ð� ����
	if($att_rule_hour > 8) {
		$att_rule_hour = 8;
		$att_rule_min = 0;
	} else if($att_rule_hour == 8) {
		if($att_rule_min > 0) $att_rule_min = 0;
	}
	$att_rule = $att_rule_hour."�ð�".$att_rule_min."��";
	if($att_rule_hour == 0 && $att_rule_min == 0) $att_rule = "-";
	if($row[att_category] == 1 || $row[att_category] == 9) $att_rule = "-";
	//��������
	if($row[att_annual_paid_holiday] == 1) {
		$att_annual_paid_holiday_txt = "(����)";
		$att_rule = "-";
	} else {
		$att_annual_paid_holiday_txt = "";
	}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
										<td nowrap class="ltrow1_center_h22"><?=$att_day?></td>
										<td nowrap class="ltrow1_center_h22"><?=$row[att_time]?>~<?=$row[att_time2]?></td>
										<td nowrap class="ltrow1_center_h22"><?=$att_rule?></td>
										<td nowrap class="ltrow1_center_h22"><?=$att_category?><?=$att_annual_paid_holiday_txt?></td>
										<td nowrap class="ltrow1_center_h22"><?=$sabun_name[$row[sabun]]?></td>
										<td nowrap class="ltrow1_left_h22"><?=$row[att_note]?></td>
										<td nowrap class="ltrow1_center_h22">
											<div id="btn_bsget_82">
											 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn1_lt.gif></td><td background=images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:modify(<?=$id?>,<?=$toYear?>,<?=$toMonth?>,'<?=$monthday?>');" target="">����</a></td><td><img src=images/btn1_rt.gif></td><td width=2></td></tr></table>
											</div>
										</td>
										<td nowrap class="ltrow1_center_h22">
											<div id="btn_bslost_82">
											 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn1_lt.gif></td><td background=images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:del(<?=$id?>,<?=$toYear?>,<?=$toMonth?>);" target="">����</a></td><td><img src=images/btn1_rt.gif></td><td width=2></td></tr></table>
											</div>
										</td>
									</tr>
<?
}
if($i == 0) {
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h22" colspan="<?=$colspan?>">�ڷᰡ �����ϴ�.</td>
									</tr>
<?
}
?>
									<tr>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
									</tr>
								</table>
<?
//���Ѻ� ��ũ��
if($member['mb_profile'] == "guest") {
	$url_del = "javascript:alert_demo();";
	$url_print = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_print = "javascript:alert('�غ����Դϴ�.');";
}
?>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="center">
											<a href="<?=$url_del?>" target=""><img src="images/btn_choice_big.png" border="0"></a>
										</td>
									</tr>
								</table>
								</form>
								<div style="height:20px;font-size:0px;line-height:0px;"></div>
<?
$attendance_year_width = "700";
?>
								<div style="width:<?=$attendance_year_width?>px;text-align:center;font-size:20px">
									<?=$com_name?>
								</div>
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120;text-align:center'> 
													<?=$toYear?>�� ���� ��Ȳ
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px;width:<?=$attendance_year_width?>px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--����Ʈ -->
								<table width="<?=$attendance_year_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
									<tr>
										<td nowrap class="tdhead_center" width="80">��������</td>
										<td nowrap class="tdhead_center" width="90">����ð�</td>
										<td nowrap class="tdhead_center" width="90">���¼���</td>
										<td nowrap class="tdhead_center" width="80">�з�</td>
										<td nowrap class="tdhead_center" width="70">�̸�</td>
										<td nowrap class="tdhead_center" width="">�������</td>
									</tr>
<?
// ����Ʈ ���
for($i=0; $row=sql_fetch_array($result_year); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
	$id = $row[id];
	$list = $i%2;
	//��������
	$att_day = date('Y-m-d',strtotime($row[att_day]));
	$monthday = date('md',strtotime($row[att_day]));
	//�з�
	$att_category = $att_category_array[$row[att_category]];
	//���¼���
	$att_rule_2 = explode(":", $row[att_time2]);
	$att_rule_1 = explode(":", $row[att_time]);
	//�� ���
	//$att_rule_min = ($att_rule_2[1] - $att_rule_1[1]);
	if($att_rule_1[1] != "00") $att_rule_1_min = 60 - $att_rule_1[1];
	else $att_rule_1_min = 0;
	$att_rule_min = ($att_rule_1_min + $att_rule_2[1]);
	if($att_rule_min > 59) {
		if($att_rule_min != 60) {
			$att_rule_min = $att_rule_min - 60;
			//$att_rule_hour_plus = 1;
			$att_rule_hour_plus = 0;
		} else {
			//60���� ��� 0 ó�� 160223
			$att_rule_min = 0;
			$att_rule_hour_plus = 0;
		}
	} else {
		$att_rule_hour_plus = 0;
	}
	//�ð� ���
	if($att_rule_2[0] < $att_rule_1[0]) {
		$att_rule_hour = (24 - $att_rule_1[0]) + $att_rule_2[0];
	} else {
		$att_rule_hour = ($att_rule_2[0] - $att_rule_1[0]);
	}
	$att_rule_hour += $att_rule_hour_plus;
	//8�ð� �Ѿ ��� �����ٷνð�(��) 8�ð� ����
	if($att_rule_hour > 8) {
		$att_rule_hour = 8;
		$att_rule_min = 0;
	} else if($att_rule_hour == 8) {
		if($att_rule_min > 0) $att_rule_min = 0;
	}
	$att_rule = $att_rule_hour."�ð�".$att_rule_min."��";
	if($att_rule_hour == 0 && $att_rule_min == 0) $att_rule = "-";
	if($row[att_category] == 1 || $row[att_category] == 9) $att_rule = "-";
	//��������
	if($row[att_annual_paid_holiday] == 1) {
		$att_annual_paid_holiday_txt = "(����)";
		$att_rule = "-";
	} else {
		$att_annual_paid_holiday_txt = "";
	}
?>
									<tr class="list_row_now_wh" onMouseOver="" onMouseOut="">
										<td nowrap class="ltrow1_center_h22"><?=$att_day?></td>
										<td nowrap class="ltrow1_center_h22"><?=$row[att_time]?>~<?=$row[att_time2]?></td>
										<td nowrap class="ltrow1_center_h22"><?=$att_rule?></td>
										<td nowrap class="ltrow1_center_h22"><?=$att_category?><?=$att_annual_paid_holiday_txt?></td>
										<td nowrap class="ltrow1_center_h22"><?=$sabun_name[$row[sabun]]?></td>
										<td nowrap class="ltrow1_left_h22"><?=$row[att_note]?></td>
									</tr>
<?
}
if($i == 0) {
?>
									<tr class="list_row_now_wh" onMouseOver="" onMouseOut="">
										<td nowrap class="ltrow1_center_h22" colspan="6">�ڷᰡ �����ϴ�.</td>
									</tr>
<?
}
?>
									<tr>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
										<td nowrap class="tdhead_center"></td>
									</tr>
								</table>
								<div style="width:<?=$attendance_year_width?>px;text-align:center;margin:10px 0 0 0">
									<a href="<?=$url_print?>" target=""><img src="images/btn_print_big.png" border="0"></a>
								</div>
							</div>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
<script type="text/javascript">
function scontentshow(uid,e) {
	var xy = getEventXY(e);
	var layer = getId('schedule_content_'+uid);
	var conta = getId('schedule_content_div');
	
	conta.innerHTML = '<div style="position:relative;top:-18px;left:20px;"></div>' + layer.innerHTML;
	conta.style.display = 'block';
	conta.style.top = (xy.y + 20) + 'px';
	conta.style.left = xy.x + 'px';
}
function scontenthide() {
	var conta = getId('schedule_content_div');
	conta.innerHTML = '';
	conta.style.display = 'none';
}
function scheduleWin(day,hour,uid) {
	if(!uid){
		//window.open('./index.php?q=mypage&iframe=Y&menu=_schedule&day='+day+'&hour='+hour+'&uid='+uid,'','width=450px,height=400px,scrollbars=no,status=no,resizable=no');
		location.href="attendance_view.php?mod=write&f_date="+day+"&hour="+hour;
	}
}
</script>
</body>
</html>
