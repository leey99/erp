<?
$sub_menu = "700200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

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

if (!$sst) {
    $sst = "wr_datetime";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 5;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$sub_title = "��Ź����";
$g4[title] = $sub_title." : 4�뺸����� : ".$member['mb_nick'];

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
// ���� �˻� Ȯ��
function del(page,id) 
{
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
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
	if(cnt==0) {
	 alert("���õ� �����Ͱ� �����ϴ�.");
	 return;
	} else{
		if(confirm("���� �����Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="4insure_delete.php";
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

<?
include "./inc/left_menu7.php";
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
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'>4�뺸�� ���/��� �Ű�</span>
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

							<!--������ -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												�˻�
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
							<!--�˻� -->
							<form name="searchForm" method="post">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="10%">
									<col width="">
									<col width="15%">
									<col width="">
									<col width="10%">
									<col width="">
									<col width="10%">
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������Ī</td>
										<td nowrap class="tdrow">
											<input name="search_comp_name" type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����ڵ�Ϲ�ȣ</td>
										<td nowrap class="tdrow">
											<input name="search_comp_bznb" type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ</td>
										<td nowrap class="tdrow">
											<input name="search_comp_tel"  type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td align="center" nowrap class="tdrow_center">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">�� ��</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												���/���
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
							<!--��޴� -->

							<!--����Ʈ -->
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<col width="3%">
								<col width="4%">
								<col width="17%">
								<col width="166">
								<col width="5%">
								<col width="">
								<col width="5%">
								<col width="5%">
								<col width="5%">
								<col width="7%">
								<col width="7%">
								<col width="5%">
								<tr>
									<td nowrap class="tdhead_center"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
									<td nowrap class="tdhead_center">No</td>
									<th nowrap class="tdhead_center">��û����</th>
									<th nowrap class="tdhead_center">�Ի��� ���</th>
									<td nowrap class="tdhead_center">����</td>
									<th nowrap class="tdhead_center">����� ���</th>
									<td nowrap class="tdhead_center">����</td>
									<td nowrap class="tdhead_center">�Ի���</td>
									<td nowrap class="tdhead_center">�����</td>
									<td nowrap class="tdhead_center">�����</td>
									<td nowrap class="tdhead_center">ó����Ȳ</td>
									<td nowrap class="tdhead_center">����</td>
								</tr>
<?
$colspan = 12;
// ����Ʈ ���
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
	$row[comp_name] = cut_str($row[comp_name], 22, "..");
	$comp_adr = cut_str($row[comp_adr], 25, "..");
	//�����
	$damdang_code_0022 = "������";
	$damdang_code_0023 = "������";
	if($row[damdang_code] == "0022") $damdang_name = $damdang_code_0022;
	else if($row[damdang_code] == "0023") $damdang_name = $damdang_code_0023;
	else $damdang_name = "";
	//ó����Ȳ
	if($row[conduct] == "0" || $row[conduct] == "") $ok = "������";
	else if($row[conduct] == "1") $ok = "ó����";
	else if($row[conduct] == "2") $ok = "ó���Ϸ�";
	else if($row[conduct] == "3") $ok = "<span style='color:red'>������</span>";
	else if($row[conduct] == "4") $ok = "<span style='color:red'>�ݷ�</span>";

	$wr_datetime = $row[wr_datetime];

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
		if($k == 4) $br_add = "<br>";
		else $br_add = "";
		if($row_join_name_add != "") {
			$join_name_add .= ", ".$br_add.$row_join_name_add;
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
		if($k == 4) $br_add = "<br>";
		else $br_add = "";
		$row_quit_add = sql_fetch($sql_quit_add);
		$row_quit_name_add = $row_quit_add['quit_name_'.$k];
		if($row_quit_name_add != "") {
			$quit_name_add .= ", ".$br_add.$row_quit_name_add;
		}
	}
	//���Ѻ� ��ũ��
	if($member['mb_profile'] == "guest") {
		$url_excel = "javascript:alert_demo();";
	} else {
		$url_excel = "4insure_excel.php?id=$row[id]";
	}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h34"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td nowrap class="ltrow1_center_h34"><?=$no?></td>
									<td nowrap style="text-align:center"><a href="4insure_view.php?id=<?=$id?><?=$qstr?>"><b><?=$wr_datetime?></b></a></td>
									<td nowrap style="text-align:center"><div style="margin:4px 0 0 0"><?=$row_join[join_name]?><?=$join_name_add?>&nbsp;</div></td>
									<td nowrap class="ltrow1_center_h34">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_excel?>" target="">����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap style="text-align:center"><?=$row_quit[quit_name]?><?=$quit_name_add?>&nbsp;</td>
									<td nowrap class="ltrow1_center_h34">
										-
									</td>
									<td nowrap class="ltrow1_center_h34"><?=$join__count?>��</td>
									<td nowrap class="ltrow1_center_h34"><?=$quit__count?>��</td>
									<td nowrap class="ltrow1_center_h34"><?=$damdang_name?></td>
									<td nowrap class="ltrow1_center_h34"><?=$ok?></td>
									<td nowrap class="ltrow1_center_h34">
<?
	//ó���Ϸ�� ���� ���� ���� �Ұ� ������ ��û 160215
	//if($ok == "ó���Ϸ�") $modify_url = "javascript:alert('ó���Ϸ�� ���� ���� ������ �Ұ����մϴ�.');";
	//else $modify_url = "4insure_write.php?w=u&page=".$page."&id=".$row['id'];
	//$modify_url = "4insure_write.php?w=u&page=".$page."&id=".$row['id'];

	//ó���Ϸ�/�ݷ��� ���� ���� ���� �Ұ� ������ ��û 161101
	if($row['conduct'] == "2" || $row['conduct'] == "4") $modify_url = "javascript:alert('ó���Ϸ�/�ݷ��� ���� ���� ������ �Ұ����մϴ�.');";
	else $modify_url = "4insure_write.php?w=u&page=".$page."&id=".$row['id'];
?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$modify_url?>">����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
								</tr>
<?
}
if ($i == 0) {
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
}
else if($i == 1) {
	echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'>";
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
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
								</tr>
							</table>
							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
<?
//����������
$sql_common = " from a4_modify ";
$sql_search = " where comp_bznb='$member[mb_id]' ";
if ($stx) {
	$sql_search .= " and ( ";
	switch ($sfl) {
		default :
			$sql_search .= " ($sfl like '$stx%') ";
			break;
	}
	$sql_search .= " ) ";
}
if (!$sst) {
	$sst = "id";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
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
?>
							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												����������
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
							<!--��޴� -->

							<!--����Ʈ -->
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<col width="3%">
								<col width="4%">
								<col width="86">
								<col width="">
								<col width="5%">
								<col width="7%">
								<col width="7%">
								<col width="5%">
								<tr>
									<td nowrap class="tdhead_center"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
									<td nowrap class="tdhead_center">No</td>
									<th nowrap class="tdhead_center">��û����</th>
									<th nowrap class="tdhead_center">�ٷ��� ���</th>
									<td nowrap class="tdhead_center">�ٷ���</td>
									<td nowrap class="tdhead_center">�����</td>
									<td nowrap class="tdhead_center">ó����Ȳ</td>
									<td nowrap class="tdhead_center">����</td>
								</tr>
<?
$colspan = 8;
// ����Ʈ ���
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

	//�ٷ���(��)
	$sql_modify = " select count(*) as cnt $sql_common $sql_search and modify_name <> '' and id = '$row[id]' ";
	//echo $sql_modify;
	$row_modify = sql_fetch($sql_modify);
	$modify__count = $row_modify[cnt];
	$sql_modify_add = " select count(*) as cnt from a4_modify_opt where mid = '$row[id]' ";
	$row_modify_add = sql_fetch($sql_modify_add);
	$modify__count += $row_modify_add[cnt];
	$row[comp_name] = cut_str($row[comp_name], 22, "..");
	$comp_adr = cut_str($row[comp_adr], 10, "..");
	//��û����
	$wr_datetime = explode(" ",$row[wr_datetime]);
	//�ٷ��� ���
	$sql_modify = " select *
					 $sql_common
					 $sql_search
							and modify_name <> '' 
							and id = '$row[id]' ";
	//echo $sql_modify;
	$row_modify = sql_fetch($sql_modify);
	//�߰� �ٷ��� �ʱ�ȭ
	$modify_name_add = "";
	
	$sql_modify_add = " select * from a4_modify_opt where mid = '$row[id]' ";
	$result_modify_add = sql_query($sql_modify_add);
	for ($k=0; $row_modify_add=sql_fetch_array($result_modify_add); $k++) {
		$row_modify_name_add = $row_modify_add[modify_name]."(".$row_modify_add[modify_reason].")";
		if($row_modify_name_add != "") {
			$modify_name_add .= ", ".$row_modify_name_add;
		}
	}
	//�ٷ���, ����� ��� ���� �� - ǥ��
	if($row_modify[modify_name]) $modify_name = $row_modify[modify_name]."(".$row_modify[modify_reason].")";
	else $modify_name = "-";
	//�����
	if($row[damdang_code] == "0022") $damdang_name = $damdang_code_0022;
	else if($row[damdang_code] == "0023") $damdang_name = $damdang_code_0023;
	else $damdang_name = "";
	//ó����Ȳ
	if($row[conduct] == "0" || $row[conduct] == "") $ok = "������";
	else if($row[conduct] == "1") $ok = "ó����";
	else if($row[conduct] == "2") $ok = "ó���Ϸ�";
	else if($row[conduct] == "3") $ok = "<span style='color:red'>������</span>";
	else if($row[conduct] == "4") $ok = "<span style='color:red'>�ݷ�</span>";
	//ó������
	$ok_datetime = explode(" ",$row[ok_datetime]);
	if($row[conduct] != "2") $ok_datetime[0] = "-";
	//4�뺸����� �������� url
	$insure_view_url = "a4_modify_view.php?id=".$id."".$qstr;
	
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td nowrap class="ltrow1_center_h22"><?=$no?></td>
									<td nowrap style="text-align:center"><a href="<?=$insure_view_url?>"><b><?=$wr_datetime[0]?></b></a></td>
									<td class="ltrow1_left_h22" style="padding:0 0 0 4px"><?=$modify_name?><?=$modify_name_add?></td>
									<td nowrap class="ltrow1_center_h22"><?=$modify__count?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=$damdang_name?></td>
									<td nowrap class="ltrow1_center_h22"><?=$ok?></td>
									<td nowrap class="ltrow1_center_h22">
<?
	//ó���Ϸ�� ���� ���� ���� �Ұ� ������ ��û 160215
	//if($ok == "ó���Ϸ�") $modify_url = "javascript:alert('ó���Ϸ�� ���� ���� ������ �Ұ����մϴ�.');";
	//else $modify_url = "a4_modify_write.php?w=u&page=".$page."&id=".$row['id'];
	//$modify_url = "a4_modify_write.php?w=u&page=".$page."&id=".$row['id'];

	//ó���Ϸ�/�ݷ��� ���� ���� ���� �Ұ� ������ ��û 161101
	if($row['conduct'] == "2" || $row['conduct'] == "4") $modify_url2 = "javascript:alert('ó���Ϸ�/�ݷ��� ���� ���� ������ �Ұ����մϴ�.');";
	else $modify_url2 = "a4_modify_write.php?w=u&page=".$page."&id=".$row['id'];
?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$modify_url2?>">����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
								</tr>
<?
}
if ($i == 0) {
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
}
else if($i == 1) {
	echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'>";
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
								</tr>
							</table>
							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
<?
//���Ѻ� ��ũ��
if($member['mb_profile'] == "guest") {
	$url_4insure_popup  = "javascript:alert_demo();";
	$url_4insure_popup2 = "javascript:alert_demo();";
	$url_4insure  = "javascript:alert_demo();";
	$url_4insure2 = "javascript:alert_demo();";
} else {
	$url_4insure_popup  = "window.open(this.href, '4insure_popup', 'height=780,width=920,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=no');";
	$url_4insure_popup2 = "window.open(this.href, '4insure_popup2', 'height=780,width=920,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=no');";
	$url_4insure  = "4insure_write.php?mode=in&page=".$page;
	$url_4insure2  = "a4_modify_write.php?mode=in&page=".$page;
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_4insure?>"  target=""><img src="images/btn_join_quit_req_big.png" border="0"></a>
										<a href="<?=$url_4insure2?>" target=""><img src="images/btn_pay_modify_big.png" border="0"></a>
									</td>
								</tr>
							</table>

						</form>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
</body>
</html>
