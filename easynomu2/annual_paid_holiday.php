<?
$sub_menu = "500200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b, pibohum_base_opt2 c ";

$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//�ɼ�DB join
$sql_search .= " and ( ";
$sql_search .= " ( a.com_code = b.com_code and a.sabun = b.sabun and a.com_code = c.com_code and a.sabun = c.sabun ) ";
$sql_search .= " ) ";

// �˻� : ����
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.name like '$stx_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ���
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
// �˻� : ä������
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.work_form = $stx_work_form) ";
	$sql_search .= " ) ";
}
//����
if (!$sst) {
	if($is_admin == "super") {
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		$sst = "a.sabun";
		$sod = "asc";
	}
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

if($page == "all") $rows = 90;
else $rows = 15;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$sub_title = "��������";
$g4[title] = $sub_title." : �빫���� : ".$member['mb_nick'];

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);

$colspan = 13;
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
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function goYearHoliday() {
	var frm = document.searchForm;
	if(confirm("������ ����� ������ �ʱ�ȭ�˴ϴ�.\n���� �����Ͻðڽ��ϱ�?")) {
		frm.action = "annual_paid_holiday_apply.php";
		frm.submit();
	}
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
	var chk_data_code ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
			chk_data_code = chk_data_code + ',' + frm.codex[i].value;
		}
	}
	if(cnt==0) {
	 alert("���õ� �����Ͱ� �����ϴ�.");
	 return;
	} else{
		if(confirm("���� �����Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			chk_data_code = chk_data_code.substring(1, chk_data_code.length);
			frm.chk_data_code.value = chk_data_code;
			frm.action="annual_paid_holiday_delete.php";
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
include "./inc/left_menu5.php";
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
									<col width="6%">
									<col width="12%">
									<col width="10%">
									<col width="10%">
									<col width="10%">
									<col width="9%">
									<col width="8%">
									<col width="11%">
									<col width="">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
										<td nowrap class="tdrow">
											<input name="stx_name" type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���뿩��</td>
										<td nowrap class="tdrow">
											<select name="stx_year_holiday_yn" class="selectfm">
												<option value="">��ü</option>
												<option value="1" >����</option>
												<option value="2" >������</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������</td>
										<td nowrap class="tdrow">
											<select name="stx_work_form" class="selectfm">
												<option value="">��ü</option>
												<option value="1" >������</option>
												<option value="2" >�����</option>
												<option value="3" >�Ͽ���</option>
												<option value="4" >����ҵ�</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�Ի���</td>
										<td nowrap class="tdrow">
											<input name="stx_in_day" type="text" class="textfm" style="width:70px;ime-mode:active;" value="<?=$stx_in_day?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td align="center" nowrap class="tdrow_center">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">�� ��</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goYearHoliday();" target="" title="�Ի��� ����">�����ϰ�����</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
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
							<style>
							.btn00 {display:inline-block;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;}
							.btn00 a {display:inline-block;border-top:#FFFFFF solid 1px;background:#EFEFEF;padding:4px 7px 4px 7px;color:#444;font-family:dotum;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 a:hover {background:#E1E1E1;}
							.btn00 input {margin:0;cursor:pointer;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;background:#EFEFEF;height:18px;color:#444;font-family:dotum;font-weight:bold;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 input:hover {background:#E1E1E1;}
							</style>
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="chk_data_code">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="chk_all" value="1" class="textfm"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center" width="142">������</th>
<?
}
?>
									<td nowrap class="tdhead_center" width="40">���</td>
									<td nowrap class="tdhead_center" width="70">�̸�</td>
									<td nowrap class="tdhead_center" width="90">����</td>
									<td nowrap class="tdhead_center" width="70">��������</td>
									<td nowrap class="tdhead_center" width="80">�Ի���</td>
									<td nowrap class="tdhead_center" width="60">�ѿ���</td>
									<td nowrap class="tdhead_center" width="60">���</td>
									<td nowrap class="tdhead_center" width="60">�ܿ�</td>
									<td nowrap class="tdhead_center" width="80">�ֱٻ����</td>
									<td nowrap class="tdhead_center" width="">��������</td>
									<td nowrap class="tdhead_center" width="5%">���</td>
								</tr>
<?
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
	$com_name = $row_com['com_name'];
	$com_name = cut_str($com_name, 21, "..");
	$name = cut_str($row['name'], 6, "..");
	//�Ի���, ������
	$in_day = $row['in_day'];
	$out_day = $row['out_day'];
	//����
	if($row['position']) {
		$sql_position = " select * from com_code_list where item='position' and com_code='$code' and code=$row[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position['name'];
	} else {
		$position = "-";
	}
	//��������
	if($row[gubun] == "0") $emp_stat = "����";
	else if($row[gubun] == "1") $emp_stat = "����";
	else if($row[gubun] == "2") $emp_stat = "<span style='color:red'>����</span>";
	//ä������
	if($row[work_form] == 1) $work_form = "������";
	else if($row[work_form] == 2) $work_form = "�����";
	else if($row[work_form] == 3) $work_form = "�Ͽ���";
	else if($row[work_form] == 4) $work_form = "����ҵ�";
	else $work_form = "-";
	//�빫���� DB
	$sql_nomu = " select * from pibohum_base_nomu where com_code='$code' and sabun='$id' and annual_paid_holiday_day!='' order by annual_paid_holiday_day desc limit 0,1 ";
	//echo $sql_nomu;
	$row_nomu = sql_fetch($sql_nomu);
	//idx
	$idx = $row_nomu['idx'];
	//��������
	$annual_day = $row_nomu['annual_paid_holiday_day'];
	//��������
	$annual_reason = $row_nomu['annual_paid_holiday_reason'];
	//���� ���ϼ�
	$annual_paid_hday = $row['annual_paid_holiday'];
	//���� ����ϼ�
	$sql_common = " from pibohum_base_nomu ";
	$sql_search = " where com_code='$com_code' and annual_paid_holiday_day != '' ";
	$sql_hday = " select count(*) as hday_cnt
          $sql_common
          $sql_search and sabun='$id' ";
	//echo $sql_hday;
	$result_hday = sql_query($sql_hday);
	$row_hday = mysql_fetch_array($result_hday);
	//echo $row_hday[hday_cnt];
	$annual_paid_hday_use = $row_hday['hday_cnt'];
	//echo $annual_paid_hday_use." = ".$annual_paid_hday." - ".$row_hday[hday_cnt];
	//���� ����ϼ�
	$annual_paid_hday_rest = $annual_paid_hday - $row_hday['hday_cnt'];

	//���Ѻ� ��ũ��
	if($member['mb_profile'] == "guest") {
		$url_use = "javascript:alert_demo();";
	} else {
		$url_modify = "annual_paid_holiday_view.php?w=u&idx=$idx&page=$page";
		$url_use = "annual_paid_holiday_view.php?w=u&id=$id&page=$page";
	}
	//�����ڸ� ǥ�� => ��� ǥ�� 160317
	//if(!$out_day) {
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$idx?>" class="no_borer"><input type="hidden" name="codex" value="<?=$code?>"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$com_name?></td>
<? } ?>
									<td nowrap class="ltrow1_center_h22"><?=$id?></td>
									<td nowrap class="ltrow1_center_h22"><a href="./popup_annual_paid_holiday.php?code=<?=$code?>&id=<?=$id?>" target="" onclick="cal_open(this.href,'popup_annual_paid_holiday',800,400);return false;"><b><?=$name?></b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$position?></td>
									<td nowrap class="ltrow1_center_h22"><?=$emp_stat?></td>
									<td nowrap class="ltrow1_center_h22"><?=$in_day?></td>
									<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday?></td>
									<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday_use?></td>
									<td nowrap class="ltrow1_center_h22"><?=$annual_paid_hday_rest?></td> 
									<td nowrap class="ltrow1_center_h22"><a href="annual_paid_holiday_view.php?w=u&id=<?=$id?>&idx=<?=$idx?>&page=<?=$page?>"><b><?=$annual_day?></b></a></td>
									<td nowrap class="ltrow1_center_h22"><?=$annual_reason?></td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_use?>" target="">���</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
								</tr>
								</tr>
								<?
	//}
	//�����ڸ� ǥ��
								}
								if ($i == 0)
										echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
								?>
								<tr>
									<td nowrap class="tdhead_center"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center"></td>
<? } ?>
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
							<input type="checkbox" name="idx" value="" style="display:none">
							<input type="hidden" name="codex" value="">

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
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
	$url_apply = "javascript:alert_demo();";
	$url_form = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "annual_paid_holiday_view.php?page=$page";
	$url_apply = "javascript:alert('�غ����Դϴ�.');";
	$url_form = "form_labor.php?labor=annual_paid_holiday&page=$page";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_apply?>" target=""><img src="images/btn_choice_apply_big.png" border="0"></a>
										<a href="<?=$url_form?>" target=""><img src="images/btn_annualmanage_big.png" border="0"></a>
									</td>
								</tr>
							</table>
							</form>

							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id="Tab_cust_tab_01_0"> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="./images/g_tab_on_lt.gif"></td> 
												<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
												<a href="#">üũ ����</a> 
												</td> 
												<td><img src="./images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
								<tr>
									<td class="tdrow" style="font-size:15px">�� �Ի��� �������� �ټ� 1��Ǵ� ���� ���� 15�� �ο��˴ϴ�. �ټ� 2, 4, 6��(¦��)���� 1���� �þ�ϴ�.</td>
								</tr>
								<tr>
									<td class="tdrow" style="font-size:15px">
										�� ���� 2009�� 10�� 10���� �Ի����� ��� �ټ� 1���� �Ǵ� 2010�� 10�� 10�Ͽ� ���� <b>15��</b>�� �ο��˴ϴ�.
										<br>&nbsp;&nbsp;&nbsp;�ټ� 2���� �Ǵ� 2011�� 10�� 10���� ���� 1���� �߰��� <b>16��</b>�� �˴ϴ�. �ټ� 4����(2013.10.10)���� <b>17</b>���� �˴ϴ�.
									</td>
								</tr>
								<tr>
									<td class="tdrow" style="font-size:13px;">
										<div style="padding:4px;">
											�ٷα��ع� ��60���� ���� ����ڴ� �ٷ��ڰ� 1�Ⱓ 80% �̻� ������ ��쿡�� �⺻ 15��(��ӱٷο��� 2�⸶�� 1�� ����)�� ���������ް��� �ο��Ͽ��� �ϰ�, ��ӱٷαⰣ�� 1�� �̸��� �ٷ��� �Ǵ� 1�Ⱓ 80% �̸� ����� �ٷ��ڿ��Դ� 1���� ���ٽ� 1���� ���������ް��� �־�� �մϴ�.
											<br>���������ް��� �Ի����� �������� �ο��ϴ� ���� ��Ģ�̳� ������� �빫���� ���� ���Ǹ� ���� �����Ģ � ���Ͽ� ��ӱٷαⰣ�� ������� �� �ٷ��ڿ��� ȸ�迬���� �������� �Ϸ������� ���� �� ������ �ٷ��ڿ��� �Ҹ����� �ʾƾ� �մϴ�.
											<br>���� ȸ�迬���� �������� �ް��� ����� ��� ���� �� �Ի��ڿ��� �Ҹ����� �ʰ� �ް��� �ο��Ϸ���, �Ի��� �� 1���� ���� ���� �ٷ��ڿ� ���Ͽ��� ���������� �Ի翬���� �ټӱⰣ�� ����Ͽ� �����ް��� �ο��ϰ� ���� �������ʹ� ȸ�迬���� �������� ���������ް��� �ο��ϸ� �� ���̸�, �ٷ��� �����ÿ� �Ի����� �������� ������ �����ް��� ���� ���� �ο��� �����ް��� ���� ��쿡�� �� ���̸�ŭ ������ �����ؾ� �� ���Դϴ�.
										</div>
									</td>
								</tr>
							</table>

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
