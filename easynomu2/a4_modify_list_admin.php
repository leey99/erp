<?
$sub_menu = "700220";
include_once("./_common.php");

if($member['mb_profile'] == 1) {
	$is_admin = "super";
}
$sql_common = " from a4_modify ";

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

$rows = 15;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$sub_title = "����պ�������Ű�";
$g4[title] = $sub_title." : ����������Ű� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
$colspan = 13;
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
			frm.action="a4_modify_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
</script>
<? include "./inc/top_admin.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
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
												����Ʈ
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
								<col width="26">
								<col width="34">
								<col width="160">
								<col width="84">
								<col width="98">
								<col width="89">
								<col width="94">
								<col width="">
								<col width="64">
								<col width="70">
								<col width="80">
								<col width="45">
								<tr>
									<td nowrap class="tdhead_center"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
									<td nowrap class="tdhead_center">No</td>
									<td nowrap class="tdhead_center">������Ī</td>
									<td nowrap class="tdhead_center">����������</td>
									<td nowrap class="tdhead_center">����ڵ�Ϲ�ȣ</td>
									<td nowrap class="tdhead_center">��ȭ��ȣ</td>
									<td nowrap class="tdhead_center">��û����</td>
									<td nowrap class="tdhead_center">�ٷ��� ���</td>
									<td nowrap class="tdhead_center">�����</td>
									<td nowrap class="tdhead_center">ó����Ȳ</td>
									<td nowrap class="tdhead_center">ó������</td>
									<td nowrap class="tdhead_center">����</td>
								</tr>
<?
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
		$row_modify_name_add = $row_modify_add[modify_name];
		if($row_modify_name_add != "") {
			$modify_name_add .= ", ".$row_modify_name_add;
		}
	}
	//�ٷ���, ����� ��� ���� �� - ǥ��
	if($row_modify[modify_name]) $modify_name = $row_modify[modify_name];
	else $modify_name = "-";
	//�����
	$damdang_code_0022 = "������";
	$damdang_code_0023 = "�̹�ȭ";
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
	$insure_view_url = "a4_modify_view_admin.php?id=".$id."".$qstr;
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td nowrap class="ltrow1_center_h22"><?=$no?></td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px">
										<a href="<?=$insure_view_url?>"><b><?=$row[comp_name]?></b></a>
									</td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px" title="<?=$row[comp_adr]?>"><?=$comp_adr?></td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px"><?=$row[comp_bznb]?></td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px"><?=$row[comp_tel]?></td>
									<td nowrap style="text-align:center"><a href="<?=$insure_view_url?>"><b><?=$wr_datetime[0]?></b></a></td>
									<td class="ltrow1_left_h22" style="padding:0 0 0 4px"><?=$modify__count?>��(<?=$modify_name?><?=$modify_name_add?>)</td>
									<td nowrap class="ltrow1_center_h22"><?=$damdang_name?></td>
									<td nowrap class="ltrow1_center_h22"><?=$ok?></td>
									<td nowrap class="ltrow1_center_h22"><?=$ok_datetime[0]?></td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="a4_modify_write_admin.php?w=u&page=<?=$page?>&id=<?=$row[id]?>" target="">����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
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
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="left">
<?
if($member['mb_level'] >= 7) {
	$url_del = "javascript:checked_ok();";
?>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_del?>" target="">���û���</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
<?
}
?>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="a4_modify_write_admin.php" target="">�Ű� �ۼ�</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
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
