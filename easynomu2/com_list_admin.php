<?
$sub_menu = "100100";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where a.com_code = b.com_code ";
} else {
	$sql_search = " where a.com_code='$member[mb_id]' ";
}

// �˻� : ��������
if ($stx_man_cust_name) {
	if($stx_man_cust_name == "no") $stx_man_cust_name = "";
	$sql_search .= " and ( ";
	if($stx_man_cust_name == "yes") {
		$sql_search .= " (b.man_cust_name != '') ";
	} else {
		$sql_search .= " (b.man_cust_name = '$stx_man_cust_name') ";
	}
	$sql_search .= " ) ";
}
// �˻� : �繫��Ź
if($stx_samu_req_yn != "") {
	$sql_search .= " and ( ";
	if($stx_samu_req_yn == "0") {
		$sql_search .= " (b.samu_req_yn != '1') ";
	} else {
		$sql_search .= " (b.samu_req_yn = '1') ";
	}
	$sql_search .= " ) ";
}
//echo $stx_samu_req_yn;
// �˻� : ������
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ��ü����
if ($stx_upche_div) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.upche_div = '$stx_upche_div') ";
	$sql_search .= " ) ";
}

if (!$sst) {
    $sst = "a.com_code";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$sub_title = "�⺻����";
$g4[title] = $sub_title." : �������� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 17;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;">

<script language="javascript">
// ���� �˻� Ȯ��
function del(page,id) {
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch() {
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
			frm.action="com_delete.php";
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
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
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
<?
if($is_admin == "super") {
	//echo $stx_man_cust_name;
?>
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
										</t able> 
									</td> 
									<td width=2></td> 
									<td valign="bottom"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--�˻� -->
							<form name="searchForm" method="post">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��������</td>
										<td nowrap class="tdrow">
											<select name="stx_man_cust_name" class="selectfm" onchange="goSearch();">
												<option value="" <? if($stx_man_cust_name == "") echo "selected"; ?>>��ü</option>
												<option value="yes" <? if($stx_man_cust_name == "yes") echo "selected"; ?>>�з�</option>
												<option value="no" <? if($stx_man_cust_name == "no") echo "selected"; ?>>�̺з�</option>
<?
for($i=1;$i<count($man_cust_name_arry);$i++) {
	if($stx_man_cust_name == $i) $sel_man_cust_name[$i] = "selected";
?>
												<option value="<?=$i?>" <?=$sel_man_cust_name[$i]?>><?=$man_cust_name_arry[$i]?></option>
<?
}
?>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�繫��Ź</td>
										<td nowrap class="tdrow">
											<select name="stx_samu_req_yn" class="selectfm" onchange="goSearch();">
												<option value="" <? if($stx_samu_req_yn == "") echo "selected"; ?>>��ü</option>
												<option value="1" <? if($stx_samu_req_yn == "1") echo "selected"; ?>>��û</option>
												<option value="0" <? if($stx_samu_req_yn == "0") echo "selected"; ?>>�̽�û</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������</td>
										<td nowrap class="tdrow">
											<input name="stx_name" type="text" class="textfm" style="width:120;ime-mode:active;" value="" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ü����</td>
										<td nowrap class="tdrow">
											<select name="stx_upche_div" class="selectfm">
												<option value="">��ü</option>
												<option value="1" >����</option>
												<option value="2" >����</option>
											</select>
										</td>
										<td align="center" nowrap class="tdrow_center">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">�� ��</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
<? } ?>
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
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
									<td nowrap class="tdhead_center" width="26">No</td>
									<td nowrap class="tdhead_center" width="40">�ڵ�</td>
									<td nowrap class="tdhead_center">������</td>
									<td nowrap class="tdhead_center" width="70">��ǥ�ڸ�</td>
									<td nowrap class="tdhead_center" width="40">����</td>
									<td nowrap class="tdhead_center" width="98">����ڵ�Ϲ�ȣ</td>
									<td nowrap class="tdhead_center" width="94">�������ȭ</td>
									<td nowrap class="tdhead_center" width="140">���񽺱Ⱓ</td>
									<td nowrap class="tdhead_center" width="56">���ú�</td>
									<td nowrap class="tdhead_center" width="56">������</td>
									<td nowrap class="tdhead_center" width="48">������</td>
									<td nowrap class="tdhead_center" width="42">����</td>
									<td nowrap class="tdhead_center" width="52">�Ŵ���</td>
									<td nowrap class="tdhead_center" width="40">��Ź</td>
									<td nowrap class="tdhead_center" width="36">����</td>
									<td nowrap class="tdhead_center" width="36">����</td>
								</tr>
<?
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
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td nowrap class="ltrow1_center_h22"><?=$no?></td>
									<td nowrap class="ltrow1_center_h22"><?=$id?></td>
									<td nowrap class="ltrow1_left_h22">
										<a href="com_view_admin.php?id=<?=$id?>&w=u<?=$qstr?>" style="font-weight:bold"><?=$com_name?></a>
									</td>
									<td nowrap class="ltrow1_center_h22"><?=$row[boss_name]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$upche_div?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[biz_no]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row[com_tel]?></td>
									<td nowrap class="ltrow1_center_h22"><?=$service_day?></td>
									<td nowrap class="ltrow1_center_h22"><?=$setting_pay?></td>
									<td nowrap class="ltrow1_center_h22"><?=$month_pay?></td>
									<td nowrap class="ltrow1_center_h22"><?=$settlement_day?></td>
									<td nowrap class="ltrow1_center_h22"><?=$man_cust_name?></td>
									<td nowrap class="ltrow1_center_h22"><?=$manage_cust_name?></td>
									<td nowrap class="ltrow1_center_h22"><?=$samu_req?></td>
									<td nowrap class="ltrow1_center_h22"><?=$join_cnt?></td>
									<td nowrap class="ltrow1_center_h22"><?=$quit_cnt?></td>
								</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
								<tr>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center">�հ�(���ú�, ������)</td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"><?=number_format($setting_sum)?></td>
									<td nowrap class="tdhead_center"><?=number_format($month_sum)?></td>
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
if($is_admin == "super" && $member['mb_level'] != 6) {
?>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="left">
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checked_ok();" target="">���û���</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="com_view_admin.php" target="">�űԵ��</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
<? } ?>
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
