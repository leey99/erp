<?
$mode = "main";
include_once("./_common.php");
include_once("$g4[path]/lib/latest.lib.php");
//include_once "../extend/schedule.lib.php";
//echo $member['mb_id'];
if(!$member['mb_id']) {
?>
<script type="text/javascript">
location.href = "login.php?url=%2Fkidsnomu%2Fmain.php";
</script>
<?
exit;
}
//echo $member['mb_level'];
if($member['mb_level'] == 5) {
	header("Location:./com_view.php");
} else if($member['mb_level'] == 7) {
	if($member['mb_id'] != "tax0001") {
		header("Location:./com_list_admin.php");
	} else {
		header("Location:./adjustment_list_admin.php");
	}
}
//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
}
//���� ���� ID
if($member['mb_level'] == 7 || $member['mb_level'] == 10) {
	$is_admin = "super";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>���� ������ : <?=$easynomu_name?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script type="text/javascript">
// ���� �˻� Ȯ��
function del(page,id) {
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
</script>
<?
if($is_admin != "super") $top_inc = "./inc/top.php";
else $top_inc = "./inc/top_admin.php";
include $top_inc;
?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1100" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!-- Ÿ��Ʋ -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>     
									<td height="18">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td style='font-size:8pt;color:#929292;'>
													<img src="images/g_title_icon.gif" align="absmiddle" style="margin:0 5 2 0"><span style="font-size:9pt;color:black;"><?=$member['mb_name']?> ����ڴ� �ȳ��ϼ���.</span>
												</td>
												<td align="right" class="navi"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height="1" bgcolor="e0e0de"></td></tr>
								<tr><td height="2" bgcolor="f5f5f5"></td></tr>
								<tr><td height="5"></td></tr>
							</table>

							<!-- ���뿵�� S -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?
if($is_admin != "super") {
?>
								<tr>
									<td valign="top">
										<table width="530" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td height="30" style="background:url(./images/main_tit_bg.gif) repeat-x;"><img src="images/main_tit_notice.gif" /></td>
												<td style="background:url(./images/main_tit_bg.gif) repeat-x;"><div align="right"><a href="list_notice.php?bo_table=oc_notice"><img src="images/btn_tit_more.gif" /></a></div></td>
											</tr>
											<tr>
												<td colspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable" style="table-layout:fixed;">
													<tr>
														<th width="15%" height="34">No</th>
														<th width="59%">����</th>
														<th width="26%">�������</th>
													</tr>
													<?=latest('oc_notice', 'oc_notice', 6, 100)?>
												</table></td>
											</tr>
											<tr>
												<td colspan="2" valign="top">
													
												</td>
											</tr>
										</table></td>
										<td width="20"></td>
										<td valign="top"><table width="530" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td height="30" style="background:url(./images/main_tit_bg.gif) repeat-x;"><img src="images/main_tit_event.gif" /></td>
												<td style="background:url(./images/main_tit_bg.gif) repeat-x;"><div align="right"><a href="list_notice.php?bo_table=oc_event"><img src="images/btn_tit_more.gif" /></a></div></td>
											</tr>
											<tr>
												<td colspan="2">
													<?//=$member['mb_id']?>
													<?=latest_schedule("calendar", "oc_event", $member['mb_id'])?>
												</td>
											</tr>
										</table>
									</td>
								</tr>
<?
}
//�������ID
if($member['mb_level'] != 7) {
?>
								<tr>
									<td colspan="3" valign="top">
										<div style="height:20px"><!--����--></div>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(./images/main_tit_bg.gif) repeat-x;">
											<tr>
												<td height="30"><img src="images/main_tit_4insure.gif" /></td>
												<td>
													<div align="right">
<?
if($is_admin != "super") {
?>
														<table border=0 cellpadding=0 cellspacing=0 style="display:inline;margin-top:9px">
															<tr>
																<td width=2></td>
																<td><img src=images/btn_lt.gif></td>
																<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="4insure_write.php" target="">�Ű� �ۼ�</a></td>
																<td><img src=images/btn_rt.gif></td>
															 <td width=2></td>
															</tr>
														</table>
														<a href="4insure_list.php"><img src="images/btn_tit_more.gif" style="margin-bottom:4px" /></a>
<?
} else {
?>
														<a href="4insure_list_admin.php"><img src="images/btn_tit_more.gif" style="margin-top:6px" /></a>
<?
}
?>
													</div>
												</td>
											</tr>
										</table>

										<!--����Ʈ -->
										<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable">
											<col width="4%">
<?
if($is_admin == "super") {
?>
											<col width="220">
											<col width="100">
											<col width="100">
<? } ?>
											<col width="100">
											<col width="">
											<col width="">
											<col width="76">
											<col width="80">
											<col width="100">
											<tr>
												<th nowrap style="text-align:center" height="34">No</th>
<?
if($is_admin == "super") {
?>
												<th nowrap style="text-align:center">������Ī</th>
												<th nowrap style="text-align:center">����ڵ�Ϲ�ȣ</th>
												<th nowrap style="text-align:center">��ȭ��ȣ</th>
<? } ?>
												<th nowrap style="text-align:center">��û����</th>
												<th nowrap style="text-align:center">�Ի��� ���</th>
												<th nowrap style="text-align:center">����� ���</th>
												<th nowrap style="text-align:center">�����</th>
												<th nowrap style="text-align:center">ó����Ȳ</th>
												<th nowrap style="text-align:center">ó������</th>
											</tr>
<?
$sql_common = " from $g4[insure_table] ";
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where comp_bznb='$member[mb_id]' ";
}
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}
$sst = "";
if (!$sst) {
    $sst = "id";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";
$total_count = 10;
$rows = 10;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����
$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";
$g4[title] = "4�뺸��";
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
$colspan = 9;
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows
	$no = $total_count - $i - ($rows*($page-1));
	$id = $row[id];
  $list = $i%2;
	$openchk = "";
	if($row[isgy] == "1")
		$openchk = "checked";
	$popchk = "";
	if($row[issj] == "1")
		$popchk = "checked";
	// �Ի���(��)
	$sql_join = " select count(*) as cnt
					 $sql_common
					 $sql_search
							and join_name <> '' 
							and id = '$row[id]' ";
	//echo $sql_join;
	$row_join = sql_fetch($sql_join);
	$join__count = $row_join[cnt];
	for($k=2; $k<=5; $k++) {
		$sql_join_add = " select count(*) as cnt
						 $sql_common
						 $sql_search
								and join_name_".$k." <> '' 
								and id = '$row[id]' ";
		//echo $sql_join_add;
		$row_join_add = sql_fetch($sql_join_add);
		$join__count += $row_join_add[cnt];
	}
	// �����(��)
	$sql_quit = " select count(*) as cnt
					 $sql_common
					 $sql_search
							and quit_name <> ''
							and id = '$row[id]' ";
	$row_quit = sql_fetch($sql_quit);
	$quit__count = $row_quit[cnt];
	for($k=2; $k<=5; $k++) {
		$sql_quit_add = " select count(*) as cnt
						 $sql_common
						 $sql_search
								and quit_name_".$k." <> '' 
								and id = '$row[id]' ";
		//echo $sql_quit_add;
		$row_quit_add = sql_fetch($sql_quit_add);
		$quit__count += $row_quit_add[cnt];
	}
	$comp_adr = cut_str($row[comp_adr], 60, "..");
	//��û����
	$wr_datetime = explode(" ",$row[wr_datetime]);
	//�Ի��� ���
	$sql_join = " select *
					 $sql_common
					 $sql_search
							and join_name <> '' 
							and id = '$row[id]' ";
	//echo $sql_join;
	$row_join = sql_fetch($sql_join);
	//�߰� �Ի��� �ʱ�ȭ
	$join_name_add = "";
	for($k=2; $k<=5; $k++) {
		$sql_join_add = " select *
						 $sql_common
						 $sql_search
								and join_name_".$k." <> '' 
								and id = '$row[id]' ";
		//echo $sql_join_add;
		$row_join_add = sql_fetch($sql_join_add);
		$row_join_name_add = $row_join_add['join_name_'.$k];
		if($row_join_name_add != "") {
			$join_name_add .= ", ".$row_join_name_add;
		}
	}
	//����� ���
	$sql_quit = " select *
					 $sql_common
					 $sql_search
							and quit_name <> '' 
							and id = '$row[id]' ";
	//echo $sql_quit;
	$row_quit = sql_fetch($sql_quit);
	//�߰� �Ի��� �ʱ�ȭ
	$quit_name_add = "";
	for($k=2; $k<=5; $k++) {
		$sql_quit_add = " select *
						 $sql_common
						 $sql_search
								and quit_name_".$k." <> '' 
								and id = '$row[id]' ";
		//echo $sql_quit_add;
		$row_quit_add = sql_fetch($sql_quit_add);
		$row_quit_name_add = $row_quit_add['quit_name_'.$k];
		if($row_quit_name_add != "") {
			$quit_name_add .= ", ".$row_quit_name_add;
		}
	}
	//�Ի���, ����� ��� ���� �� - ǥ��
	if($row_join[join_name]) $join_name = $row_join[join_name];
	else $join_name = "-";
	if($row_quit[quit_name]) $quit_name = $row_quit[quit_name];
	else $quit_name = "-";
	// �����
	if($row[damdang_code] == "0022") $damdang_name = $damdang_code_0022;
	else if($row[damdang_code] == "0023") $damdang_name = $damdang_code_0023;
	else if($row[damdang_code] == "0028") $damdang_name = $damdang_code_0028;
	else if($row[damdang_code] == "0029") $damdang_name = $damdang_code_0029;
	else $damdang_name = "&nbsp;";
	//ó����Ȳ
	if($row[conduct] == "0" || $row[conduct] == "") $ok = "������";
	else if($row[conduct] == "1") $ok = "ó����";
	else if($row[conduct] == "2") $ok = "ó���Ϸ�";
	else if($row[conduct] == "3") $ok = "������";
	else if($row[conduct] == "4") $ok = "�ݷ�";
	//ó������
	$ok_datetime = explode(" ",$row[ok_datetime]);
	if($row[conduct] != "2") $ok_datetime[0] = "-";
	//4�뺸����� �������� url
	if($is_admin != "super") $insure_view_url = "4insure_view.php?id=".$id."".$qstr;
	else $insure_view_url = "4insure_view_admin.php?id=".$id."".$qstr;
?>
											<tr>
												<td nowrap style="text-align:center"><?=$no?></td>
<?
if($is_admin == "super") {
?>
												<td nowrap style="text-align:left">
													<a href="<?=$insure_view_url?>"><b><?=$row[comp_name]?></b></a>
												</td>
												<td nowrap style="text-align:left"><?=$row[comp_bznb]?></td>
												<td nowrap style="text-align:left"><?=$row[comp_tel]?></td>
<? } ?>
												<td nowrap style="text-align:left"><a href="<?=$insure_view_url?>"><b><?=$wr_datetime[0]?></b></a></td>
												<td nowrap style="text-align:left"><?=$join__count?>��(<?=$join_name?><?=$join_name_add?>)</td>
												<td nowrap style="text-align:left"><?=$quit__count?>��(<?=$quit_name?><?=$quit_name_add?>)</td>
												<td nowrap style="text-align:center"><?=$damdang_name?></td>
												<td nowrap style="text-align:center"><?=$ok?></td>
												<td nowrap style="text-align:center"><?=$ok_datetime[0]?></td>
											</tr>
<?
}
if ($i == 0)
    echo "<tr><td colspan='$colspan' nowrap style=\"text-align:center\">�ڷᰡ �����ϴ�.</td></tr>";
//�������ID end
} else {
	//����� ����Ʈ ǥ��
	//�������� �������� �̵�
}
?>
										</table>
<?
// ���������� ����
//�������ID
if($member['mb_level'] != 7) {
?>
								<tr>
									<td colspan="3" valign="top">
										<div style="height:20px"><!--����--></div>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(./images/main_tit_bg.gif) repeat-x;">
											<tr>
												<td height="30"><img src="images/main_tit_pay_modify.gif" /></td>
												<td>
													<div align="right">

													</div>
												</td>
											</tr>
										</table>

										<!--����Ʈ -->
										<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable">
											<col width="4%">
<?
if($is_admin == "super") {
?>
											<col width="220">
											<col width="100">
											<col width="100">
<? } ?>
											<col width="100">
											<col width="">
											<col width="76">
											<col width="80">
											<col width="100">
											<tr>
												<th nowrap style="text-align:center" height="34">No</th>
<?
if($is_admin == "super") {
?>
												<th nowrap style="text-align:center">������Ī</th>
												<th nowrap style="text-align:center">����ڵ�Ϲ�ȣ</th>
												<th nowrap style="text-align:center">��ȭ��ȣ</th>
<? } ?>
												<th nowrap style="text-align:center">��û����</th>
												<th nowrap style="text-align:center">�ٷ��� ���</th>
												<th nowrap style="text-align:center">�����</th>
												<th nowrap style="text-align:center">ó����Ȳ</th>
												<th nowrap style="text-align:center">ó������</th>
											</tr>
<?
$sql_common  = " from a4_modify ";
$sql_common2 = " from a4_modify_opt ";
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where comp_bznb='$member[mb_id]' ";
}
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}
$sst = "";
if (!$sst) {
    $sst = "id";
    $sod = "desc";
}
$sql_order = " order by $sst $sod ";
$total_count = 10;
$rows = 10;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
$colspan = 6;
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
	$id = $row[id];
  $list = $i%2;
	$openchk = "";
	if($row[isgy] == "1") $openchk = "checked";
	$popchk = "";
	if($row[issj] == "1") $popchk = "checked";
	$join_count = 1;
	$comp_adr = cut_str($row[comp_adr], 60, "..");
	//��û����
	$wr_datetime = explode(" ",$row[wr_datetime]);
	//�Ի��� ���
	$sql_join = " select *
					 $sql_common
					 $sql_search
							and id = '$row[id]' ";
	//echo $sql_join;
	$row_join = sql_fetch($sql_join);
	//�߰� �Ի��� �ʱ�ȭ
	$join_name_add = "";
	$sql_join_add = " select *
					 $sql_common2
							where mid = '$row[id]' ";
	//echo $sql_join_add;
	$result_join_add = sql_query($sql_join_add);
	for($k=0; $row_join_add=sql_fetch_array($result_join_add); $k++) {
		$row_join_name_add = $row_join_add['modify_name'];
		if($row_join_name_add != "") {
			$join_name_add .= ", ".$row_join_name_add;
			$join_count++;
		}
	}
	//�Ի���, ����� ��� ���� �� - ǥ��
	if($row_join[modify_name]) $join_name = $row_join['modify_name'];
	else $join_name = "-";
	// �����
	if($row[damdang_code] == "0022") $damdang_name = $damdang_code_0022;
	else if($row[damdang_code] == "0023") $damdang_name = $damdang_code_0023;
	else if($row[damdang_code] == "0028") $damdang_name = $damdang_code_0028;
	else if($row[damdang_code] == "0029") $damdang_name = $damdang_code_0029;
	else $damdang_name = "&nbsp;";
	//ó����Ȳ
	if($row[conduct] == "0" || $row[conduct] == "") $ok = "������";
	else if($row[conduct] == "1") $ok = "ó����";
	else if($row[conduct] == "2") $ok = "ó���Ϸ�";
	else if($row[conduct] == "3") $ok = "������";
	else if($row[conduct] == "4") $ok = "�ݷ�";
	//ó������
	$ok_datetime = explode(" ",$row[ok_datetime]);
	if($row[conduct] != "2") $ok_datetime[0] = "-";
	//4�뺸����� �������� url ������
	if($is_admin != "super") $a4_modify_view_url_admin = "javascript:alert('�غ����Դϴ�.');";
	else $a4_modify_view_url_admin = "a4_modify_view_admin.php?id=".$id."".$qstr;
	//���������� url
	$a4_modify_view_url = "a4_modify_view.php?id=".$id."".$qstr;
?>
											<tr>
												<td nowrap style="text-align:center"><?=$no?></td>
<?
if($is_admin == "super") {
?>
												<td nowrap style="text-align:left">
													<a href="<?=$a4_modify_view_url_admin?>"><b><?=$row[comp_name]?></b></a>
												</td>
												<td nowrap style="text-align:left"><?=$row[comp_bznb]?></td>
												<td nowrap style="text-align:left"><?=$row[comp_tel]?></td>
<? } ?>
												<td nowrap style="text-align:left"><a href="<?=$a4_modify_view_url?>"><b><?=$wr_datetime[0]?></b></a></td>
												<td nowrap style="text-align:left"><?=$join_count?>��(<?=$join_name?><?=$join_name_add?>)</td>
												<td nowrap style="text-align:center"><?=$damdang_name?></td>
												<td nowrap style="text-align:center"><?=$ok?></td>
												<td nowrap style="text-align:center"><?=$ok_datetime[0]?></td>
											</tr>
<?
}
if ($i == 0)
    echo "<tr><td colspan='$colspan' nowrap style=\"text-align:center\">�ڷᰡ �����ϴ�.</td></tr>";
//�������ID end
} else {
	//����� ����Ʈ ǥ��
	//�������� �������� �̵�
}
?>
										</table>
<?
//������ �α��ν� ����
if($is_admin == "super") {
?>
										<div style="height:30px"><!--����� ����Ʈ--></div>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(./images/main_tit_bg.gif) repeat-x;">
											<tr>
												<td height="30"><img src="images/main_tit_com.gif" /></td>
												<td>
													<div align="right">
														<a href="com_list_admin.php"><img src="images/btn_tit_more.gif" style="margin-top:6px" /></a>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable">
														<tr>
															<th style="text-align:center" width="26" height="34">No</th>
															<th style="text-align:center" width="40">�ڵ�</th>
															<th style="text-align:center" width="">������</th>
															<th style="text-align:center" width="70">��ǥ�ڸ�</th>
															<th style="text-align:center" width="40">����</th>
															<th style="text-align:center" width="98">����ڵ�Ϲ�ȣ</th>
															<th style="text-align:center" width="94">�������ȭ</th>
															<th style="text-align:center" width="140">���񽺱Ⱓ</th>
															<th style="text-align:center" width="56">���ú�</th>
															<th style="text-align:center" width="56">������</th>
															<th style="text-align:center" width="48">������</th>
															<th style="text-align:center" width="42">����</th>
															<th style="text-align:center" width="52">�Ŵ���</th>
															<th style="text-align:center" width="40">��Ź</th>
															<th style="text-align:center" width="36">����</th>
															<th style="text-align:center" width="36">����</th>
														</tr>
<?
	$sql_common = " from com_list_gy a, com_list_gy_opt b ";
	$sql_search = " where a.com_code = b.com_code ";
	$sst = "a.com_code";
  $sod = "desc";
	$sql_order = " order by $sst $sod ";
	$total_count = 10;
	$from_record = 0;
	$rows = 10;
	$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
	$result = sql_query($sql);
	$colspan = 16;
	// ����Ʈ ���
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		//����� �ɼ� DB
		$sql_opt = " select * from com_list_gy_opt where com_code='$row[com_code]' ";
		$result_opt = sql_query($sql_opt);
		$row_opt=mysql_fetch_array($result_opt);
		//$page
		//$total_page
		//$rows

		$no = $total_count - $i - ($rows*($page-1));
		$list = $i%2;

		$id = $row[com_code];
		$com_name = cut_str($row[com_name], 28, "..");
		if($row[upche_div] == "2") {
			$upche_div = "����";
		} else {
			$upche_div = "����";
		}
		$com_juso = $row[com_juso]." ".$row[com_juso2];
		$com_juso = cut_str($com_juso, 29, "..");
		//���񽺱Ⱓ
		if($row_opt[service_day_start]) {
			$service_day = $row_opt[service_day_start]."~".$row_opt[service_day_end];
			//echo $id." ".$service_day;
		} else {
			$service_day = "";
		}
		//���ú�
		if($row_opt[setting_pay]) {
			$setting_pay = number_format($row_opt[setting_pay]);
			$setting_sum += $row_opt[setting_pay];
		} else {
			$setting_pay = "";
		}
		//�����ױ�
		if($row_opt[month_pay]) {
			$month_pay = number_format($row_opt[month_pay]);
			$month_sum += $row_opt[month_pay];
		} else {
			$month_pay = "";
		}	
		//������
		$sql1 = " select count(*) as cnt from pibohum_base where com_code='$row[com_code]' and out_day='' ";
		$result1 = sql_query($sql1);
		$row1=mysql_fetch_array($result1);
		$join_cnt = $row1[cnt];
		//������
		$sql1 = " select count(*) as cnt from pibohum_base where com_code='$row[com_code]' and out_day!='' ";
		$result1 = sql_query($sql1);
		$row1=mysql_fetch_array($result1);
		$quit_cnt = $row1[cnt];
		//�������
		$man_cusr_numb = $row_opt[man_cust_name];
		$man_cust_name = $man_cust_name_arry[$man_cusr_numb];
		//���Ŵ���
		$manage_cust_name = $row_opt[manage_cust_name];
		//�����װ�����
		if($row_opt[settlement_day] == "" || $row_opt[settlement_day] == 0) $settlement_day = "";
		else $settlement_day = $row_opt[settlement_day]."��";
		//������ ����
		if($row_opt[settlement_day_last]) $settlement_day = "����";
		//�繫��Ź
		if($row_opt[samu_req_yn] == "0" || $row_opt[samu_req_yn] == "") {
			$samu_req = "";
		} else if($row_opt[samu_req_yn] == "1") {
			$samu_req = "��û";
		}
?>
														<tr>
															<td style="text-align:center"><?=$no?></td>
															<td style="text-align:center"><?=$id?></td>
															<td style="text-align:left">
																<a href="com_view_admin.php?id=<?=$id?>&w=u"><b><?=$com_name?></b></a>
															</td>
															<td style="text-align:center"><?=$row[boss_name]?>&nbsp;</td>
															<td style="text-align:center"><?=$upche_div?>&nbsp;</td>
															<td style="text-align:center"><?=$row[biz_no]?>&nbsp;</td>
															<td style="text-align:center"><?=$row[com_tel]?>&nbsp;</td>
															<td style="text-align:center"><?=$service_day?>&nbsp;</td>
															<td style="text-align:center"><?=$setting_pay?>&nbsp;</td>
															<td style="text-align:center"><?=$month_pay?>&nbsp;</td>
															<td style="text-align:center"><?=$settlement_day?>&nbsp;</td>
															<td style="text-align:center"><?=$man_cust_name?>&nbsp;</td>
															<td style="text-align:center"><?=$manage_cust_name?>&nbsp;</td>
															<td style="text-align:center"><?=$samu_req?>&nbsp;</td>
															<td style="text-align:center"><?=$join_cnt?>&nbsp;</td>
															<td style="text-align:center"><?=$quit_cnt?>&nbsp;</td>
														</tr>
<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' style=\"text-align:center\" nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
													</table>
												</td>
											</tr>
										</table>
<?
}
?>
<?
//���Ѻ� ��ũ��
if($member['mb_profile'] == "guest") {
	$url_view = "javascript:alert_demo();";
} else {
	$url_view = "staff_view.php?w=w";
}
//������ �α��ν� ����
if($is_admin != "super") {
?>
										<div style="height:30px"><!--����--></div>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background:url(./images/main_tit_bg.gif) repeat-x;">
											<tr>
												<td height="30"><img src="images/main_tit_staff.gif" /></td>
												<td>
													<div align="right">
														<table border=0 cellpadding=0 cellspacing=0 style="display:inline;margin-top:9px">
															<tr>
																<td width=2></td>
																<td><img src=images/btn_lt.gif></td>
																<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_view?>" target="">��� ���</a></td>
																<td><img src=images/btn_rt.gif></td>
															 <td width=2></td>
															</tr>
														</table>
														<a href="staff_list.php"><img src="images/btn_tit_more.gif" style="margin-bottom:4px" /></a>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<table width="100%" border="0" cellpadding="0" cellspacing="0" class="mainlisttable">
														<tr>
															<th style="text-align:center" width="34" height="34">No</th>
															<th style="text-align:center" width="50">���</th>
															<th style="text-align:center" width="90">����</th>
															<th style="text-align:center" width="120">����</th>
															<th style="text-align:center" width="74">�޿�����</th>
															<th style="text-align:center" width="70">����</th>
															<th style="text-align:center" width="110">�ֹι�ȣ</th>
															<th style="text-align:center" width="80">ä������</th>
															<th style="text-align:center" width="90">��/�����</th>
															<th style="text-align:center" width="110">�μ�</th>
															<th style="text-align:center" width="120">��濩��</th>
															<th style="text-align:center" width="80">�ٷΰ�༭</th>
															<th style="text-align:center" width="">���</th>
															<th style="text-align:center" width="">���</th>
														</tr>
<?
$sql_common = " from $g4[pibohum_base] ";

$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where com_code='$com_code' ";
}

if($is_admin == "super") {
	$sst = "com_code";
} else {
	$sst = "sabun";
}
$sod = "desc";

$sql_order = " order by $sst $sod ";
$total_count = 5;

$rows = 5;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 13;

// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//$page
	//$total_page
	//$rows

	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//����� �ڵ� / ��� / �ڵ�_���
	$code = $row[com_code];
	$id = $row[sabun];
	$code_id = $code."_".$id;
	// ������ : ������ڵ�
	$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
	$row_com = sql_fetch($sql_com);
	$com_name = $row_com[com_name];
	$com_name = cut_str($com_name, 21, "..");
	$name = cut_str($row[name], 6, "..");
	//ä������
	if($row[work_form] == "") $work_form = "";
	else if($row[work_form] == "1") $work_form = "������";
	else if($row[work_form] == "2") $work_form = "�����";
	else if($row[work_form] == "3") $work_form = "�Ͽ���";
	//�Ի���/�����
	if($row[in_day] == "..")  $in_day = "";
	else $in_day = $row[in_day];
	if($row[out_day] == "..") $out_day = "";
	else $out_day = $row[out_day];
	//��� �߰� DB
	$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
		//�μ�
		$dept = $row2[dept_1];
		//����
		$position = " ";
		if($row2[position]) {
			$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row2[position] ";
			//echo $sql_position;
			$result_position = sql_query($sql_position);
			$row_position = sql_fetch_array($result_position);
			$position = $row_position[name];
		}
		//�޿�����
		if($row2[pay_gbn] == "0") $pay_gbn = "������";
		else if($row2[pay_gbn] == "1") $pay_gbn = "�ñ���";
		else if($row2[pay_gbn] == "2") $pay_gbn = "���ձٹ�";
		else if($row2[pay_gbn] == "3") $pay_gbn = "������";
		else $pay_gbn = "-";
	//���Ѻ� ��ũ��
	if($member['mb_level'] == 6) {
		$url_work = "javascript:alert_demo();";
	} else {
		$url_work = "work_contract.php?id=$id&code=$code&page=$page";
	}
	//���� �ٷΰ�༭
	$row2[work_contract] = 1;
	if($row2[work_contract] == 1) $work_contract = "<a href='$url_work' target=''><img src='./images/btn_work_contract.png' border='0'></a>";
	else $work_contract = "���ۼ�";
	//�������
	if($row2[pic]) {
		$pic = "./files/images/$row[com_code]_$row[sabun].jpg";
	} else {
		$pic = "./images/blank_pic.gif";
	}
	//����ó
	if(!$row[add_tel]) {
		$tel_cel = $row2[emp_cel];
	} else {
		$tel_cel = $row[add_tel];
	}
		$pay_url = "staff_view.php?w=u&id=$id&code=$code&page=$page&tab=tab2";
		$pay_info = "<a href='$pay_url' target=''><img src='./images/btn_pay_info.png' border='0'></a>";
?>
														<tr>
															<td style="text-align:center;height:55px"><?=$no?></td>
															<td style="text-align:center"><?=$id?></td>
															<td style="text-align:center"><img src="<?=$pic?>" width="50" height="50" alt="�������" style="border:solid 1px #dfdfdf;" /></td>
															<td style="text-align:center">
																<a href="staff_view.php?w=u&id=<?=$id?>&code=<?=$code?>&page=<?=$page?>"><b><?=$name?></b></a>
															</td>
															<td style="text-align:center"><?=$pay_info?></td>
															<td style="text-align:center"><?=$position?>&nbsp;</td>
															<td style="text-align:center"><?=$row[jumin_no]?></td>
															<td style="text-align:center"><?=$work_form?><br><?=$pay_gbn?>&nbsp;</td>
															<td style="text-align:center"><?=$in_day?><br><?=$out_day?></td>
															<td style="text-align:center"><?=$dept?>&nbsp;</td>
															<td style="text-align:center">
																<input type="checkbox" name="isgy" value="0" class="checkbox" disabled <? if($row[apply_gy] == "0") echo "checked"; ?> >���
																<input type="checkbox" name="issj" value="0" class="checkbox" disabled <? if($row[apply_sj] == "0") echo "checked"; ?> >����<br>
																<input type="checkbox" name="iskm" value="0" class="checkbox" disabled <? if($row[apply_km] == "0") echo "checked"; ?> >����
																<input type="checkbox" name="isgg" value="0" class="checkbox" disabled <? if($row[apply_gg] == "0") echo "checked"; ?> >�ǰ�
															</td>
															<td style="text-align:center"><?=$work_contract?></td>
															<td style="text-align:center">
																<a href="4insure_write.php?mode=in&id=<?=$id?>&code=<?=$code?>&page=<?=$page?>" target=""><img src="./images/btn_get.png"></a>
															</td>
															<td style="text-align:center">
																<a href="4insure_write.php?mode=out&id=<?=$id?>&code=<?=$code?>&page=<?=$page?>" target=""><img src="./images/btn_loss.png"></a>
															</td>
														</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' style=\"text-align:center\" nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
													</table>
												</td>
											</tr>
										</table>
<?
}
?>
									</td>
								</tr>
							</table>

						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<? include "./inc/bottom.php";?>
</div>
<?
//�˾�1
$rs[po_id] = 1;
if(trim($_COOKIE["it_ck_pop_".$rs[po_id]]) != "done") {
	//�˾�1 ��ǥ
	$pop_left = 50;
	$pop_top = 162;
	//��õ�� �Ű� ó�� ����
	$sql_account = " select * from tax_account where comp_code='$code' order by send_date desc ";
	//echo $sql_account;
	$row_account = sql_fetch($sql_account);
	//�߼�����
	$send_date = $row_account['send_date'];
	echo $send_date ;
	if($send_date." 00:00:00" >= date("Y.m.d H:i:s", time() - 24 * 3600)) { 
		$pop1_display = "";
	} else {
		$pop1_display = "display:none;";
	}
?>
<style type="text/css">
#pop1 {
	position:absolute;
	z-index:100;
	width:460px;
	left:<?=$pop_left?>px;
	top:<?=$pop_top?>px;
	cursor:;
	padding:10px 0 4px 0;background:#545454;;
}
.clsDrag {
	position:relative;
}
</style>
<!--���� �˾� ���� display:none-->
<div id="pop1" class="clsDrag" style="<?=$pop1_display?>">
	<table width="440" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td style="background:#ffffff;">
				<img src="popup_images/popup_150708.jpg" alt="popup_150708.jpg" usemap="#popup_150708.jpg" style="border:0;" />
			</td>
		</tr>
	</table>
	<div id="popup_close_bt" style="margin:4px 10px 0 10px">
		<div style="float:left" onclick="" style="cursor:pointer"><input type="checkbox" id="expirehours1" name="expirehours1" value="24" style="display:none" checked></div>
		<div style="padding:4px 0 0 0;">
			<div style="display:inline;float:left"><a href="#" class="white" onclick="layer_close(1)">24�ð� ���� �� â�� �ٽ� ���� ����</a></div>
			<div style="display:inline;float:right"><a href="#" class="white" onclick="document.getElementById('pop1').style.display='none';return false;">�ݱ�</a></div>
		</div>
	</div>
	</div>
</div>
<map name="popup_150708.jpg">
	<area shape="rect" coords="211,175,430,225" href="pay_account.php" target="" alt="" />
</map>
<?
//��õ�� �Ű� ���� �ȳ� �˾�(�ݿ� 25�� ~ �Ϳ� 10�� ǥ��) 160203
//echo $next_date_month_each;
//$next_date_month_each = "2016-3-25";
$this_date_month_each = date("Y-n-d");
$next_date_month_each = date("Y-n-d",strtotime("+1month"));
$pop2_date = explode("-", $next_date_month_each);
$pop2_date_this = explode("-", $this_date_month_each);
if($pop2_date[2] < 25 && $pop2_date[2] > 10) {
	$_COOKIE["it_ck_pop_2"] = "done";
}
//�ش� ��õ�� �� ��� 160303
if($pop2_date[2] >= 1 && $pop2_date[2] < 10) {
	$pop2_date_month = $pop2_date_this[1]-1;
} else {
	$pop2_date_month = $pop2_date_this[1];
}
$rs['po_id'] = 2;
//���� �˾� �ݱ� ���� 150824
//$_COOKIE["it_ck_pop_".$rs[po_id]] = "done";
if (trim($_COOKIE["it_ck_pop_".$rs['po_id']]) != "done") {
	$pop2_left = 510;
	$pop2_top = 162;
?>
<style type="text/css">
#pop2 {
	position:absolute;
	z-index:103;
	left:<?=$pop2_left?>px;
	top:<?=$pop2_top?>px;
	background:#545454;
	width:460px;
}
</style>
<div id="pop2" class="clsDrag" style="display:">
	<table width="440" height="500" border="0" cellspacing="0" cellpadding="0" style="margin:10px 10px 4px 10px;">
		<tr>
			<td style="background:url(../kidsnomu_home/popup_images/kidsnomu_popup_160203.png) no-repeat;" valign="top">
				<div style="margin:72px 0 0 48px;"><img src="../kidsnomu_home/images/popup_month<?=$pop2_date_month?>.png" border="0" /></div>
			</td>
		</tr>
	</table>
	<div id="popup_close_bt2" style="margin:4px 10px 10px 10px">
		<div style="float:left" onclick="" style="cursor:pointer"><input type="checkbox" id="expirehours2" name="expirehours2" value="24" style="display:none" checked></div>
		<div style="padding:4px 10px 10px 10px;">
			<div style="display:inline;float:left"><a href="#" class="white" onclick="layer_close(2)">24�ð� ���� �� â�� �ٽ� ���� ����</a></div>
			<div style="display:inline;float:right"><a href="#" class="white" onclick="document.getElementById('pop2').style.display='none';return false;">�ݱ�</a></div>
		</div>
	</div>
</div>
<?
}
?>
<?
$rs['po_id'] = 3;
//���� �˾� �ݱ� ����
//$_COOKIE["it_ck_pop_".$rs[po_id]] = "done";
if (trim($_COOKIE["it_ck_pop_".$rs['po_id']]) != "done") {
	$pop3_left = 48;
	$pop3_top = 162;
?>
<style type="text/css">
#pop3 {
	position:absolute;
	z-index:103;
	left:<?=$pop3_left?>px;
	top:<?=$pop3_top?>px;
	cursor:;padding:10px 10px 4px 10px;background:#545454;;
	width:440px;
}
</style>
<div id="pop3" class="clsDrag" style="display:">
	<!--<img src="/kidsnomu_home/popup_images/popup_20160118.png" border="0" usemap="#popup_total" />-->
	<img src="popup_images/popup_150901.png" border="0" usemap="#popup_150901" />
	<div id="popup_close_bt" style="margin:4px 0 0 0">
		<div style="float:left" onclick="" style="cursor:pointer"><input type="checkbox" id="expirehours3" name="expirehours3" value="24" style="display:none" checked></div>
		<div style="padding:4px 0 0 0;">
			<div style="display:inline;float:left"><a href="#" class="white" onclick="layer_close(3)">24�ð� ���� �� â�� �ٽ� ���� ����</a></div>
			<div style="display:inline;float:right"><a href="#" class="white" onclick="document.getElementById('pop3').style.display='none';return false;">�ݱ�</a></div>
		</div>
	</div>
</div>
<map name="popup_total">
	<area shape="rect" coords="12,371,214,426" href="https://www.hometax.go.kr/ui/pp/yrs_index.html" target="_blank" alt="" />
	<area shape="rect" coords="226,373,427,425" href="/kidsnomu_home/tax_trust.php?sub=tax_adjust2" target="_blank" alt="" />
</map>
<map name="popup_150901">
	<area shape="rect" coords="127,442,317,493" href="https://www.youtube.com/watch?v=GCqtnyr83Rc" target="_blank" alt="" />
</map>
<?
}
?>
<script type="text/javascript">
function total_pay_popup(url) {
	window.open(url, 'total_pay_popup', 'height=760,width=1260,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=yes');
}
var x, y;
var objDoc;
var objIE = document.all;
var objOtherBrowsers = document.getElementById && !document.all;
var blIsDrag = false;
function fnMoveMouse(e) {
	if (blIsDrag)
	{
		objDoc.style.left = objOtherBrowsers ? intLeftX + e.clientX - x : intLeftX + event.clientX - x;
		objDoc.style.top  = objOtherBrowsers ? intTopY  + e.clientY - y : intTopY  + event.clientY - y;

		return false;
	}
}
function fnSelectMouse(e) {
	var objF = document.getElementById('pop1');
	blIsDrag = true;
	objDoc = objF;
	intLeftX = parseInt(objDoc.style.left + <?=$pop_left?>, 10);
	intTopY = parseInt(objDoc.style.top + <?=$pop_top?>, 10);
	x = objOtherBrowsers ? e.clientX : event.clientX;
	y = objOtherBrowsers ? e.clientY : event.clientY;
	document.onmousemove = fnMoveMouse;
	return false;
}

// ��Ű �Է�
function set_cookie(name, value, expirehours, domain) 
{
		var today = new Date();
		today.setTime(today.getTime() + (60*60*1000*expirehours));
		document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
		if (domain) {
				document.cookie += "domain=" + domain + ";";
		}
}
// ��Ű ����
function get_cookie(name) 
{
		var find_sw = false;
		var start, end;
		var i = 0;
		for (i=0; i<= document.cookie.length; i++)
		{
				start = i;
				end = start + name.length;
				if(document.cookie.substring(start, end) == name) 
				{
						find_sw = true
						break
				}
		}
		if (find_sw == true) 
		{
				start = end + 1;
				end = document.cookie.indexOf(";", start);
				if(end < start)
						end = document.cookie.length;
				return document.cookie.substring(start, end);
		}
		return "";
}
// ��Ű ����
function delete_cookie(name) 
{
		var today = new Date();
		today.setTime(today.getTime() - 1);
		var value = get_cookie(name);
		if(value != "")
				document.cookie = name + "=" + value + "; path=/; expires=" + today.toGMTString();
}

function layer_close(id) {
	var obj = document.getElementById("expirehours"+ id);
	if (obj.checked == true) {
		set_cookie("it_ck_pop_"+id, "done", obj.value, window.location.host);
	}
	document.getElementById("pop"+id).style.display = "none";
	selectbox_visible();
}

function selectbox_hidden(layer_id) 
{ 
		var ly = eval(layer_id); 
		// ���̾� ��ǥ 
		var ly_left  = ly.offsetLeft; 
		var ly_top    = ly.offsetTop; 
		var ly_right  = ly.offsetLeft + ly.offsetWidth; 
		var ly_bottom = ly.offsetTop + ly.offsetHeight; 
		// ����Ʈ�ڽ��� ��ǥ 
		var el; 
		for (i=0; i<document.forms.length; i++) { 
				for (k=0; k<document.forms[i].length; k++) { 
						el = document.forms[i].elements[k];    
						if (el.type == "select-one") { 
								var el_left = el_top = 0; 
								var obj = el; 
								if (obj.offsetParent) { 
										while (obj.offsetParent) { 
												el_left += obj.offsetLeft; 
												el_top  += obj.offsetTop; 
												obj = obj.offsetParent; 
										} 
								} 
								el_left  += el.clientLeft; 
								el_top    += el.clientTop; 
								el_right  = el_left + el.clientWidth; 
								el_bottom = el_top + el.clientHeight; 
								// ��ǥ�� ���� ���̾ ����Ʈ �ڽ��� ħ�������� ����Ʈ �ڽ��� hidden ��Ŵ 
								if ( (el_left >= ly_left && el_top >= ly_top && el_left <= ly_right && el_top <= ly_bottom) || 
										(el_right >= ly_left && el_right <= ly_right && el_top >= ly_top && el_top <= ly_bottom) || 
										(el_left >= ly_left && el_bottom >= ly_top && el_right <= ly_right && el_bottom <= ly_bottom) || 
										(el_left >= ly_left && el_left <= ly_right && el_bottom >= ly_top && el_bottom <= ly_bottom) ) 
										el.style.visibility = 'hidden'; 
						} 
				} 
		} 
} 
// ���߾��� ����Ʈ �ڽ��� ��� ���̰� �� 
function selectbox_visible() 
{ 
		for (i=0; i<document.forms.length; i++) { 
				for (k=0; k<document.forms[i].length; k++) { 
						el = document.forms[i].elements[k];    
						if (el.type == "select-one" && el.style.visibility == 'hidden') 
								el.style.visibility = 'visible'; 
				} 
		} 
}
//�˾�����
//document.getElementById('pop1').style.display = "none";
//document.getElementById('pop1').style.display = "block";
//fnSelectMouse();
//selectbox_hidden("pop1");
//selectbox_visible("pop1");
//�˾��巡��
function fnSelectMouse_drag() {
	document.onmousedown = fnSelectMouse;
	document.onmouseup = new Function("blIsDrag = false");
}
//addLoadEvent(fnSelectMouse);
addLoadEvent(fnSelectMouse_drag);
</script>
<? } ?>
</body>
</html>
