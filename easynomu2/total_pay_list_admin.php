<?
$sub_menu = "300100";
include_once("./_common.php");

if($member['mb_profile'] == 1) {
	$is_admin = "super";
}
$sql_common = " from total_pay ";

if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where t_no='$member[mb_id]' ";
}

// �˻� : ������Ī
if ($stx_comp_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (comp_name like '%$stx_comp_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ����ڵ�Ϲ�ȣ
if ($stx_t_no) {
	$sql_search .= " and ( ";
	$sql_search .= " (t_no like '%$stx_t_no%') ";
	$sql_search .= " ) ";
}
// �˻� : ��ȭ��ȣ
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (comp_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
// �˻� : ó����Ȳ
if ($stx_conduct) {
	$sql_search .= " and ( ";
	$sql_search .= " (conduct = '$stx_conduct') ";
	$sql_search .= " ) ";
} else if($stx_conduct == "0") {
	$sql_search .= " and ( ";
	$sql_search .= " (conduct = '0') ";
	$sql_search .= " ) ";
}
// �˻� : �����
if ($stx_damdang_code) {
	$sql_search .= " and ( ";
	$sql_search .= " (damdang_code = '$stx_damdang_code') ";
	$sql_search .= " ) ";
}
// ����
$sst = "wr_datetime";
$sod = "desc";
$sst2 = ", comp_email";
$sod2 = "desc";

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

$year = 2013;
$sub_title = $year."�⵵ �����Ѿ׽Ű�";
$g4[title] = $sub_title." : �����Ѿ׽Ű� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 17;
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_conduct=".$stx_conduct."&stx_damdang_code=".$stx_damdang_code;
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
			frm.action="total_pay_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
//����ڵ�Ϲ�ȣ �ڵ� ������
function checkBznb(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.searchForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	//���� �Է¸�
	//alert(event.keyCode);
	input = delhyphen(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(input.substring(0,3) == "mas" || input.substring(0,3) == "use" || input.substring(0,3) == "gue") {
		//master
	} else {
		//�齺���̽�Ű ����
		if(event.keyCode != 8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value = total;					// type �� ���� �������� �־� �ش�.
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delhyphen(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-'){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
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
							<form name="searchForm" method="get">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������Ī</td>
										<td nowrap class="tdrow">
											<input name="stx_comp_name" type="text" class="textfm" style="width:120;ime-mode:active;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����ڵ�Ϲ�ȣ</td>
										<td nowrap class="tdrow">
											<input name="stx_t_no" type="text" class="textfm" style="width:120;ime-mode:active;" value="<?=$stx_t_no?>" maxlength="12" onkeyup="checkBznb(this.value, this,'Y')" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ</td>
										<td nowrap class="tdrow">
											<input name="stx_comp_tel"  type="text" class="textfm" style="width:120;ime-mode:active;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">ó����Ȳ</td>
										<td nowrap class="tdrow">
											<select name="stx_conduct" class="selectfm" onchange="goSearch();">
												<option value=""  <? if($stx_conduct == "")  echo "selected"; ?>>��ü</option>
												<option value="0" <? if($stx_conduct == "0") echo "selected"; ?>>������</option>
												<option value="1" <? if($stx_conduct == "1") echo "selected"; ?>>ó����</option>
												<option value="2" <? if($stx_conduct == "2") echo "selected"; ?>>ó���Ϸ�</option>
												<option value="3" <? if($stx_conduct == "3") echo "selected"; ?>>������</option>
												<option value="4" <? if($stx_conduct == "4") echo "selected"; ?>>�ݷ�</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�����</td>
										<td nowrap class="tdrow">
											<select name="stx_damdang_code" class="selectfm" onchange="goSearch();">
												<option value=""  <? if($stx_damdang_code == "")  echo "selected"; ?>>��ü</option>
												<option value="0022" <? if($stx_damdang_code == "0022") echo "selected"; ?>>������</option>
												<option value="0023" <? if($stx_damdang_code == "0023") echo "selected"; ?>>�̹�ȭ</option>
												<option value="0024" <? if($stx_damdang_code == "0024") echo "selected"; ?>>�豹��</option>
												<option value="0025" <? if($stx_damdang_code == "0025") echo "selected"; ?>>������</option>
												<option value="0026" <? if($stx_damdang_code == "0026") echo "selected"; ?>>�����</option>
												<option value="0027" <? if($stx_damdang_code == "0027") echo "selected"; ?>>������</option>
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
<?
$sql_wr_count = " select count(*) as cnt $sql_common where comp_email != '' ";
$row_wr_count = sql_fetch($sql_wr_count);
$wr_count = $row_wr_count[cnt];
?>
							<!--������ -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												���
												</td> 
												<td><img src="images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
									<td valign="bottom" style="padding:0 0 0 8px">��ü : <b><?=$wr_count?></b>��</td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--�˻� -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td class="tdrow">
<?
for($i=0;$i<24;$i++) {
	$today = date("Y-m-d", strtotime(-$i." days"));
	$sql_cnt = " select count(*) as cnt $sql_common where wr_datetime like '$today%' and comp_email != '' ";
	$row_cnt = sql_fetch($sql_cnt);
	$today_count = $row_cnt[cnt];
	echo $today."(<b>".$today_count."</b>��) ";
	if($i == 11) echo "<br>";
}
?>
									</td>
								</tr>
							</table>
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
								<col width="32">
								<col width="84">
								<col width="160">
								<col width="44">
								<col width="44">
								<col width="">
								<col width="94">
								<col width="88">
								<col width="175">
								<col width="40">
								<col width="40">
								<col width="62">
								<col width="48">
								<col width="44">
								<col width="44">
								<col width="44">
								<tr>
									<td nowrap class="tdhead_center"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
									<td nowrap class="tdhead_center">No</td>
									<td nowrap class="tdhead_center">��û����</td>
									<td nowrap class="tdhead_center">������Ī</td>
									<td nowrap class="tdhead_center">�ѽ�</td>
									<td nowrap class="tdhead_center">����</td>
									<td nowrap class="tdhead_center">����������</td>
									<td nowrap class="tdhead_center">����������ȣ</td>
									<td nowrap class="tdhead_center">��ȭ��ȣ</td>
									<td nowrap class="tdhead_center">�̸���</td>
									<td nowrap class="tdhead_center">�߼�</td>
									<td nowrap class="tdhead_center">�Ű�</td>
									<td nowrap class="tdhead_center">ó����Ȳ</td>
									<td nowrap class="tdhead_center">�����</td>
									<td nowrap class="tdhead_center">����</td>
									<td nowrap class="tdhead_center">�ǰ�</td>
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

	$row[comp_name] = cut_str($row[comp_name], 22, "..");
	$comp_adr = $row[adr_adr1]." ".$row[adr_adr2];
	$comp_adr_short = cut_str($comp_adr, 13, "..");
	//��û����
	$wr_datetime = explode(" ",$row[wr_datetime]);
	//�Ű��
	$result_opt_cnt = mysql_query("select count(*) as cnt from total_pay_opt where mid = $id");
	$row_opt_cnt = mysql_fetch_array($result_opt_cnt);
	$worker_count = $row_opt_cnt[cnt];
	//�����
	$damdang_code_0022 = "������";
	$damdang_code_0023 = "�̹�ȭ";
	if($row[damdang_code] == "0022") $damdang_name = $damdang_code_0022;
	else if($row[damdang_code] == "0023") $damdang_name = $damdang_code_0023;
	else if($row[damdang_code] == "0024") $damdang_name = "�豹��";
	else if($row[damdang_code] == "0025") $damdang_name = "������";
	else if($row[damdang_code] == "0026") $damdang_name = "�����";
	else if($row[damdang_code] == "0027") $damdang_name = "������";
	else $damdang_name = "";
	//ó����Ȳ
	if($row[conduct] == "0" || $row[conduct] == "") $ok = "������";
	else if($row[conduct] == "1") $ok = "ó����";
	else if($row[conduct] == "2") $ok = "ó���Ϸ�";
	else if($row[conduct] == "3") $ok = "<span style='color:red'>������</span>";
	else if($row[conduct] == "4") $ok = "<span style='color:red'>�ݷ�</span>";
	else if($row[conduct] == "5") $ok = "<span style='color:blue'>�����Է�</span>";
	//ó����Ȳ (�̸��� ����)
	if(!$row[comp_email]) $ok = "-";
	//ó������
	$ok_datetime = explode(" ",$row[ok_datetime]);
	if($row[conduct] != "2") $ok_datetime[0] = "-";
	//�������� url
	$total_pay_view_url = "total_pay_view_admin.php?page=".$page."&id=".$id."&".$qstr;
	//���������� url
	$total_pay_write_url = "total_pay_write_admin.php?w=u&page=".$page."&id=".$id."&".$qstr;
	//���Ϲ߼�
	if($row[email_send] == "1") $mail_ok = "�߼�";
	else $mail_ok = "-";
	//�̸���
	$email_url = "<a href='popup/total_pay_email_send.php?id=".$id."' onclick='window.open(this.href, \"total_pay_email_send\", \"height=300,width=540,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=no,resizable=no\");return false;'>$row[comp_email]</a>";
	//FAX�߼ۿ� url
	$total_pay_fax_url = "total_pay_fax_admin.php?page=".$page."&id=".$id."&".$qstr;
	//���ΰǰ����� �Ű�� url
	$t_no_excel = str_replace('-','',$row[t_no]);
	$total_pay_health_url = "total_pay_health.php?page=".$page."&id=".$id."&excel=".$t_no_excel;
	//���� �Ű�� url
	$total_pay_center_url = "total_pay_center.php?page=".$page."&id=".$id."&".$qstr;
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td nowrap class="ltrow1_center_h22"><?=$no?></td>
									<td nowrap style="text-align:center"><a href="<?=$total_pay_view_url?>"><b><?=$wr_datetime[0]?></b></a></td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px">
										<a href="<?=$total_pay_view_url?>"><b><?=$row[comp_name]?></b></a>
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$total_pay_fax_url?>" target="">�ѽ�</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="total_pay_excel.php?id=<?=$id?>" target="">����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px" title="<?=$comp_adr?>"><?=$comp_adr_short?></td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px"><?=$row[t_no]?></td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px"><?=$row[comp_tel]?></td>
									<td nowrap class="ltrow1_left_h22" style="padding:0 0 0 4px"><?=$email_url?></td>
									<td nowrap class="ltrow1_center_h22"><?=$mail_ok?></td>
									<td nowrap class="ltrow1_center_h22"><?=$worker_count?></td>
									<td nowrap class="ltrow1_center_h22"><?=$ok?></td>
									<td nowrap class="ltrow1_center_h22"><?=$damdang_name?></td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$total_pay_center_url?>" target="_blank">����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
<?
	$upload_path = $_SERVER["DOCUMENT_ROOT"]."/total_pay_result";
	$upfile_path = $upload_path."/".$t_no_excel.".xls";
	if(file_exists($upfile_path)) {
?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$total_pay_health_url?>" target="_blank">�ǰ�</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
<?
	} else {
		echo "-";
	}
?>
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$total_pay_write_url?>" target="">����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
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
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="total_pay_write_admin.php" target="">�Ű� �ۼ�</a></td>
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
