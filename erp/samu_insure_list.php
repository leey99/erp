<?
$sub_menu = "400500";
include_once("./_common.php");

$sql_common = " from com_list_gy a, com_list_gy_opt b, samu_4insure c ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member[mb_profile];
}
//$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] > 6 || $search_ok == "ok") {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code ";
	//���� ������� ����
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and ( a.damdang_code='$member[mb_profile]' or a.damdang_code2='$member[mb_profile]' ) ";
	//���� ������� ����
	if($member['mb_level'] == 5) {
		$mb_id = $member['mb_id'];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and b.manage_cust_numb='$manage_code' ";
	}
}
//�⺻ �˻� : ���� ����
$sql_search .= " and c.delete_yn = '' ";
//�˻� : ������Ī
if($stx_comp_name) {
	$sql_search .= " and a.com_name like '%$stx_comp_name%' ";
}
//�˻� : ����ڵ�Ϲ�ȣ
if($stx_biz_no) {
	$sql_search .= " and a.biz_no like '%$stx_biz_no%' ";
}
//�˻� : ��ǥ��
if($stx_boss_name) {
	$sql_search .= " and a.boss_name like '%$stx_boss_name%' ";
}
//�˻� : �����
if($stx_manage_name) {
	$sql_search .= " and b.manage_cust_name = '$stx_manage_name' ";
}
//�˻� : ����������ȣ
if($stx_t_no) {
	$sql_search .= " and a.t_insureno like '%$stx_t_no%' ";
}
//�˻� : ��ȭ��ȣ
if($stx_comp_tel) {
	$sql_search .= " and a.com_tel like '%$stx_comp_tel%' ";
}
//�˻� : �ѽ���ȣ
if($stx_comp_fax) {
	$sql_search .= " and a.com_fax like '%$stx_comp_fax%' ";
}
//�˻� : �̸���
if($stx_com_mail) {
	$sql_search .= " and a.com_mail like '%$stx_ccom_mail%' ";
}
//�˻� : �̸��� ��� ����
if($stx_com_mail_yn) {
	if($stx_com_mail_yn == 1) $sql_search .= " and a.com_mail != '-' ";
	else if($stx_com_mail_yn == 2) $sql_search .= " and a.com_mail = '-' ";
}
//�˻� : ó����Ȳ
if($stx_proxy) {
	$sql_search .= " and b.proxy = '$stx_proxy' ";
}
//�˻� : ����
if($stx_man_cust_name) {
	$sql_search .= " and a.damdang_code = '$stx_man_cust_name' ";
}
//�˻��Ⱓ => �Ű�����
if($stx_search_day_chk) {
	//$sst = "a.report_date";
	//$sod = "desc";
	$sql_search .= " and (c.report_date >= '$search_sday' and c.report_date <= '$search_eday') ";
}
//�˻� : ����
if ($stx_uptae) {
	$sql_search .= " and a.uptae like '%$stx_uptae%' ";
}
//�˻� : ����
if ($stx_upjong) {
	$sql_search .= " and a.upjong like '%$stx_upjong%' ";
}
//�˻�2 : ��Ź��
if ($stx_comp_gubun2) {
	$sql_search .= " and b.samu_receive_date != '' ";
}
//�繫��Ź���� : �ʱ⼱�� ���� / ��ü �˻� 150326
//if(!$samu_req_yn) $samu_req_yn = "4";
if(!$samu_req_yn) $samu_req_yn = "all";
if ($samu_req_yn != "all") {
	$sql_search .= " and b.samu_req_yn = '$samu_req_yn' ";
}
//�ǰ�EDI����
if ($health_req_yn) {
	$sql_search .= " and b.health_req_yn = '$health_req_yn' ";
}
//��Ź��ȣ : �ʱ⼱�� �Է�
if(!$stx_samu_receive_no) $stx_samu_receive_no = "1";
if($stx_samu_receive_no != "all") {
	if($stx_samu_receive_no == 1) {
		$sql_search .= " and b.samu_receive_no != '' ";
	} else if($stx_samu_receive_no == 2) {
		$sql_search .= " and b.samu_receive_no = '' ";
	}
	$sst = "b.samu_receive_no+0";
	$sod = "desc";
}
//����ڵ�Ϲ�ȣ �̵��
if($stx_biz_no_input_not) {
	$sql_search .= " and (a.biz_no = '-' or a.biz_no = '') ";
}
//����������ȣ �̵��
if($stx_t_no_input_not) {
	$sql_search .= " and (a.t_insureno = '-' or a.t_insureno = '') ";
}
//�繫��Ź���� �̵��
if($samu_req_yn_input_not) {
	$sql_search .= " and b.samu_req_yn = '' ";
}
//�ּҰ˻�
if ($stx_addr) {
	if ($stx_addr_first) $addr_first = "";
	else $addr_first = "%";
	$sql_search .= " and a.com_juso like '".$addr_first;
	$sql_search .= "$stx_addr%' ";
}
//���豸��
if ($stx_samu_state_total != "2" && $stx_samu_state) {
	if($stx_samu_state == "1") $sql_search .= " and a.samu_state_gy <> '' ";
	else if($stx_samu_state == "2") $sql_search .= " and a.samu_state_sj <> '' ";
}
//�ΰ���������
if($stx_levy_kind) {
	$sql_search .= " and a.levy_kind = '$stx_levy_kind' ";
}
//�������� ����/�Ҹ� : �ʱ⼱�� ���� / �ٽ� ��ü�� ���� 150325
//if(!$stx_samu_state_total) $stx_samu_state_total = "1";
if($stx_samu_state_total != "all") {
	if($stx_samu_state_total == "2") {
		if($stx_samu_state == "1") {
			$sql_search .= " and a.samu_state_gy = '2' ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_sj = '1' ";
		} else if($stx_samu_state == "2") {
			$sql_search .= " and a.samu_state_sj = '2' ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_gy = '1' ";
		} else {
			$sql_search .= " and a.samu_state_gy = '2' or a.samu_state_sj = '2' ";
		}
	} else if($stx_samu_state_total == "1") {
		if($stx_samu_state == "1") {
			$sql_search .= " and a.samu_state_gy <> '2' ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_sj = '2' ";
		} else if($stx_samu_state == "2") {
			$sql_search .= " and (a.samu_state_sj <> '2') ";
			if($stx_samu_state_total_only) $sql_search .= " and a.samu_state_gy = '2' ";
		} else {
			$sql_search .= " and a.samu_state_gy <> '2' or a.samu_state_sj <> '2' ";
		}
	}
}
//������������
if($stx_samu_branch) {
	$sql_search .= " and a.samu_branch = '$stx_samu_branch' ";
}
//�������
if($stx_employer_insure) {
	$sql_search .= " and a.employer_insure = '$stx_employer_insure' ";
}
//��������
if($stx_samu_charge) {
	$sql_search .= " and a.samu_charge = '$stx_samu_charge' ";
}
//�Ű���
if($stx_report_kind) {
	$sql_search .= " and c.report_kind = '$stx_report_kind' ";
}
//�ٷ��ڸ�
if($stx_staff_name) {
	$sql_search .= " and c.staff_name like '%$stx_staff_name%' ";
}
//�������
if($stx_input_type) {
	$sql_search .= " and c.input_type = '$stx_input_type' ";
}

//����
$sst = "c.report_time";
$sod = "desc";
$sst2 = "c.report_kind";
$sod2 = "desc";
$sql_order = " order by $sst $sod , $sst2 $sod2 ";
//ī��Ʈ
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

//���� : ������ 20�� / 100�� / ��ü
if ($stx_count) {
	if($stx_count == "all") $rows = 999;
	else $rows = $stx_count;
} else {
	$rows = 20;
}
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "�Ǻ����ڽŰ�";
$g4[title] = $sub_title." : �繫��Ź : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 16;
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&amp;stx_t_no=".$stx_t_no."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_comp_tel=".$stx_comp_tel."&amp;stx_comp_fax=".$stx_comp_fax."&amp;stx_proxy=".$stx_proxy."&amp;stx_comp_gubun2=".$stx_comp_gubun2."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;stx_uptae=".$stx_uptae."&amp;stx_upjong=".$stx_upjong."&amp;search_ok=".$search_ok;
$qstr .= "&amp;samu_req_yn=".$samu_req_yn."&amp;health_req_yn=".$health_req_yn."&amp;stx_samu_receive_no=".$stx_samu_receive_no."&amp;stx_search_day_chk=".$stx_search_day_chk."&amp;search_sday=".$search_sday."&amp;search_eday=".$search_eday;
$qstr .= "&amp;stx_biz_no_input_not=".$stx_biz_no_input_not."&amp;stx_t_no_input_not=".$stx_t_no_input_not."&amp;stx_com_mail_yn=".$stx_com_mail_yn."&amp;stx_count=".$stx_count."&amp;stx_report_kind=".$stx_report_kind."&amp;stx_staff_name=".$stx_staff_name."&amp;stx_input_type=".$stx_input_type;
$qstr .= "&amp;stx_addr=".$stx_addr."&amp;stx_addr_first=".$stx_addr_first."&amp;stx_manage_name=".$stx_manage_name."&amp;stx_samu_state=".$stx_samu_state."&amp;stx_levy_kind=".$stx_levy_kind."&amp;stx_samu_state_total=".$stx_samu_state_total."&amp;stx_samu_branch=".$stx_samu_branch."&amp;stx_employer_insure=".$stx_employer_insure;

//��¥ ���
$quarter1_start = date("Y.01.01");
$quarter1_end_month = date("Y.03.01");
$quarter1_last_day = date('t', strtotime($quarter1_end_month));
$quarter1_end = date("Y.03").".".$quarter1_last_day;
$quarter2_start = date("Y.04.01");
$quarter2_end_month = date("Y.06.01");
$quarter2_last_day = date('t', strtotime($quarter2_end_month));
$quarter2_end = date("Y.06").".".$quarter2_last_day;
$quarter3_start = date("Y.07.01");
$quarter3_end_month = date("Y.09.01");
$quarter3_last_day = date('t', strtotime($quarter3_end_month));
$quarter3_end = date("Y.09").".".$quarter3_last_day;
$quarter4_start = date("Y.10.01");
$quarter4_end_month = date("Y.12.01");
$quarter4_last_day = date('t', strtotime($quarter4_end_month));
$quarter4_end = date("Y.12").".".$quarter4_last_day;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript">
function goSearch() {
	var frm = document.searchForm;
	frm.search_ok.value = "branch";
	frm.action = "<?=$_SERVER['PHP_SELF']?>";
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
			frm.action="client_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	var frm = document.searchForm;
	if(obj.style.display == "none") {
		obj.style.display = "";
		frm.search_detail.value = "ok";
	} else {
		obj.style.display = "none";
		frm.search_detail.value = "";
	}
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript">
<!--
function loadCalendar( obj )
{
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date)
	{
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$today?>";
		frm['search_eday'].value = "<?=$today?>";
	} else if(input_obj.value == 2) {
		frm['search_sday'].value = "<?=$quarter1_start?>";
		frm['search_eday'].value = "<?=$quarter1_end?>";
	} else if(input_obj.value == 3) {
		frm['search_sday'].value = "<?=$quarter2_start?>";
		frm['search_eday'].value = "<?=$quarter2_end?>";
	} else if(input_obj.value == 4) {
		frm['search_sday'].value = "<?=$quarter3_start?>";
		frm['search_eday'].value = "<?=$quarter3_end?>";
	} else if(input_obj.value == 5) {
		frm['search_sday'].value = "<?=$quarter4_start?>";
		frm['search_eday'].value = "<?=$quarter4_end?>";
	} else {
		frm['search_sday'].value = "";
		frm['search_eday'].value = "";
	}
}
//����ڹ�ȣ �Է� ������
function checkhyphen(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
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
	if(1 == 1) { //��� ����
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
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
				type.value = total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//����������ȣ �Է� ������
function checkhyphen_tno(inputVal, type, keydown) {
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
	if(1 == 1) { //��� ����
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value = total;
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
//-->
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top05.gif" border="0" alt="" /></td>
						<td width=""><a href="<?=$_SERVER['PHP_SELF']?>"><img src="images/top05_05.gif" border="0" alt="" /></a></td>
						<td>
<?
$title_main_no = "05";
include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
				</table>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--Ÿ��Ʋ -->	
							<form name="searchForm" method="get">
								<input type="hidden" name="search_ok" />
								<input type="hidden" name="search_detail" value="<?=$search_detail?>" />
								<!--������ -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="" /></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80px;text-align:center;'>�˻�</td> 
													<td><img src="images/g_tab_on_rt.gif" alt="" /></td> 
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />������Ī</td>
										<td nowrap class="tdrow">
											<input name="stx_comp_name" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_comp_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />����ڵ�Ϲ�ȣ</td>
										<td nowrap class="tdrow">
											<input name="stx_biz_no" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_biz_no?>" maxlength="12" onkeyup="checkhyphen(this.value, this,'Y')" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
											<input type="checkbox" name="stx_biz_no_input_not" value="1" <? if($stx_biz_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle" />�̵��
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />��ǥ��</td>
										<td nowrap class="tdrow">
											<input name="stx_boss_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�������</td>
										<td nowrap class="tdrow" <? if($member['mb_level'] <= 7) echo "colspan='3'"; ?> >
											<select name="stx_proxy" class="selectfm" onchange="">
												<option value=""  <? if($stx_proxy == "")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($stx_proxy == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($stx_proxy == "2") echo "selected"; ?>>ó����</option>
												<option value="3" <? if($stx_proxy == "3") echo "selected"; ?>>�Ϸ�</option>
											</select>
										</td>
<?
if($member['mb_level'] > 7) {
	//echo $stx_man_cust_name;
?>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />����</td>
										<td nowrap class="tdrow">
											<select name="stx_man_cust_name" class="selectfm">
												<option value="">��ü</option>
<?
include "inc/stx_man_cust_name.php";
?>
											</select>
										</td>
<? } ?>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�����</td>
										<td nowrap class="tdrow">
											<input name="stx_manage_name" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_manage_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />����������ȣ</td>
										<td nowrap class="tdrow">
											<input name="stx_t_no" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$stx_t_no?>" maxlength="14" onkeyup="checkhyphen_tno(this.value, this,'Y')" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
											<input type="checkbox" name="stx_t_no_input_not" value="1" <? if($stx_t_no_input_not == 1) echo "checked"; ?> style="vertical-align:middle" />�̵��
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�ּҰ˻�</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_addr"  type="text" class="textfm" style="width:75px;ime-mode:active;" value="<?=$stx_addr?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
											<input type="checkbox" name="stx_addr_first" value="1" <? if($stx_addr_first == 1) echo "checked"; ?> style="vertical-align:middle" title="���˻���" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />��ȭ��ȣ</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_comp_tel"  type="text" class="textfm" style="width:90px;ime-mode:disabled ;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<!--<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�ѽ���ȣ</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_comp_fax"  type="text" class="textfm" style="width:90px;ime-mode:disabled ;" value="<?=$stx_comp_fax?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>-->
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�̸���</td>
										<td nowrap class="tdrow" colspan="">
											��Ͽ���
											<select name="stx_com_mail_yn" class="selectfm" style="" onchange="">
												<option value="" >��ü</option>
												<option value="1" <? if($stx_com_mail_yn == "1") echo "selected"; ?>>���</option>
												<option value="2" <? if($stx_com_mail_yn == "2") echo "selected"; ?>>�̵��</option>
											</select>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />ó����Ȳ</td>
										<td nowrap class="tdrow" colspan="3">
											<b>��Ź��ȣ</b>
											<select name="stx_samu_receive_no" class="selectfm" style="" onchange="">
												<option value="all"  <? if($stx_samu_receive_no == "all")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($stx_samu_receive_no == "1") echo "selected"; ?>>�Է�</option>
												<option value="2" <? if($stx_samu_receive_no == "2") echo "selected"; ?>>���Է�</option>
											</select>
											<b>�繫��Ź����</b>
											<select name="samu_req_yn" class="selectfm" style="" onchange="">
												<option value="all" <? if($samu_req_yn == "all")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($samu_req_yn == "1") echo "selected"; ?>>�ݷ�</option>
												<option value="2" <? if($samu_req_yn == "2") echo "selected"; ?>>���Ӱ���</option>
												<option value="3" <? if($samu_req_yn == "3") echo "selected"; ?>>Ÿ����</option>
												<option value="4" <? if($samu_req_yn == "4") echo "selected"; ?>>����</option>
												<option value="5" <? if($samu_req_yn == "5") echo "selected"; ?>>����</option>
											</select>
											<input type="checkbox" name="samu_req_yn_input_not" value="1" <? if($samu_req_yn_input_not == 1) echo "checked"; ?> style="vertical-align:middle" />�̵��
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />��������</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_samu_state_total" class="selectfm" style="" onchange="">
												<option value="all"  <? if($stx_samu_state_total == "all")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($stx_samu_state_total == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($stx_samu_state_total == "2") echo "selected"; ?>>�Ҹ�</option>
											</select>
											<input type="checkbox" name="stx_samu_state_total_only" value="1" <? if($stx_samu_state_total_only == 1) echo "checked"; ?> style="vertical-align:middle" />�ܵ�
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�Ҹ�����</td>
										<td nowrap class="tdrow" colspan="3">
											<div style="float:left;">
												<select name="stx_discharge_date_chk" class="selectfm" onchange="stx_discharge_date_select(this)">
													<option value=""  <? if($stx_discharge_date_chk == "")  echo "selected"; ?>>��ü</option>
													<option value="2" <? if($stx_discharge_date_chk == "2") echo "selected"; ?>>�Ⱓ����</option>
												</select>
												<input name="discharge_date_start" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$discharge_date_start?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')" />
											</div>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="" /></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.discharge_date_start);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="" /></td> <td width="2"></td></tr></table>
											<div style="float:left;">
												~
												<input name="discharge_date_end" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$discharge_date_end?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')" />
											</div>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;margin:1px 0 0 0;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="" /></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.discharge_date_end);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="" /></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />���豸��</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_samu_state" class="selectfm" style="">
												<option value=""  <? if($stx_samu_state == "")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($stx_samu_state == "1") echo "selected"; ?>>���</option>
												<option value="2" <? if($stx_samu_state == "2") echo "selected"; ?>>����</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�ΰ���������</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_levy_kind" class="selectfm" onchange="">
												<option value=""  <? if($stx_levy_kind == "")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($stx_levy_kind == "1") echo "selected"; ?>>�ΰ�����</option>
												<option value="2" <? if($stx_levy_kind == "2") echo "selected"; ?>>�����Ű�</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />������������</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_samu_branch" class="selectfm" onchange="">
												<option value="">����</option>
<?
for($i=1;$i<count($samu_branch_arry);$i++) {
?>
												<option value="<?=$samu_branch_arry[$i]?>" <? if($stx_samu_branch == $samu_branch_arry[$i]) echo "selected"; ?>><?=$samu_branch_arry[$i]?></option>
<?
}
?>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�������</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_employer_insure" class="selectfm" onchange="">
												<option value=""  <? if($stx_employer_insure == "")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($stx_employer_insure == "1") echo "selected"; ?>>����ֻ���</option>
												<option value="2" <? if($stx_employer_insure == "2") echo "selected"; ?>>�ڿ����ڰ��</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />��������</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_samu_charge"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_samu_charge?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" style="font-weight:bold;"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�Ű���</td>
										<td nowrap class="tdrow">
											<select name="stx_report_kind" class="selectfm" style="color:red;font-weight:bold;">
												<option value=""  <? if($stx_report_kind == "")  echo "selected"; ?>>��ü</option>
<?
for($m=1;$m<count($report_kind_arry);$m++) {
?>
												<option value="<?=$m?>" <? if($stx_report_kind == $m) echo "selected"; ?>><?=$report_kind_arry[$m]?></option>
<?
}
?>
											</select>
										</td>
										<td nowrap class="tdrowk" style="font-weight:bold;"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�ٷ��ڸ�</td>
										<td nowrap class="tdrow">
											<input name="stx_staff_name"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_staff_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<td nowrap class="tdrowk" style="font-weight:bold;"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�������</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_input_type" class="selectfm" style="color:red;font-weight:bold;">
												<option value=""  <? if($stx_input_type == "")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($stx_input_type == "1") echo "selected"; ?>>�����빫</option>
												<option value="2" <? if($stx_input_type == "2") echo "selected"; ?>>Ű��빫</option>
												<option value="3" <? if($stx_input_type == "3") echo "selected"; ?>>��Ÿ</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />����</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_uptae"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />����</td>
										<td nowrap class="tdrow" colspan="">
											<input name="stx_upjong"  type="text" class="textfm" style="width:90px;ime-mode:active;" value="<?=$stx_upjong?>" onkeydown="if(event.keyCode == 13){ goSearch(); }" />
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" style="font-weight:bold;"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�Ű�����</td>
										<td nowrap class="tdrow" colspan="5">
											<select name="stx_search_day_chk" class="selectfm" onchange="stx_search_day_select(this)">
												<option value=""  <? if($stx_search_day_chk == "")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($stx_search_day_chk == "1") echo "selected"; ?>>����</option>
												<option value="2" <? if($stx_search_day_chk == "2") echo "selected"; ?>>1�б�</option>
												<option value="3" <? if($stx_search_day_chk == "3") echo "selected"; ?>>2�б�</option>
												<option value="4" <? if($stx_search_day_chk == "4") echo "selected"; ?>>3�б�</option>
												<option value="5" <? if($stx_search_day_chk == "5") echo "selected"; ?>>4�б�</option>
												<option value="6" <? if($stx_search_day_chk == "6") echo "selected"; ?>>�Ⱓ����</option>
											</select>
											<input name="search_sday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_sday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')" />
											<a href="javascript:loadCalendar(document.searchForm.search_sday);"><img src="images/icon_calender_btn.png" width="28" height="17" border="0" style="vertical-align:middle;" /></a>
											~
											<input name="search_eday" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$search_eday?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')" />
											<a href="javascript:loadCalendar(document.searchForm.search_eday);"><img src="images/icon_calender_btn.png" width="28" height="17" border="0" style="vertical-align:middle;" /></a>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />����</td>
										<td nowrap class="tdrow" colspan="">
											<select name="stx_count" class="selectfm" onchange="">
												<option value="20"  <? if($stx_count == "20" || $stx_count == "")  echo "selected"; ?>>20��</option>
												<option value="100"  <? if($stx_count == "100")  echo "selected"; ?>>100��</option>
												<option value="all"  <? if($stx_count == "all")  echo "selected"; ?>>��ü</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;" alt="" />�ǰ�EDI</td>
										<td nowrap class="tdrow" colspan="">
											<select name="health_req_yn" class="selectfm" onchange="">
												<option value=""  <? if($health_req_yn == "")  echo "selected"; ?>>��ü</option>
												<option value="1" <? if($health_req_yn == "1") echo "selected"; ?>>�ݷ�</option>
												<option value="2" <? if($health_req_yn == "2") echo "selected"; ?>>���Ӱ���</option>
												<option value="3" <? if($health_req_yn == "3") echo "selected"; ?>>Ÿ����</option>
												<option value="4" <? if($health_req_yn == "4") echo "selected"; ?>>����</option>
												<option value="5" <? if($health_req_yn == "5") echo "selected"; ?>>����</option>
											</select>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<div id="request" style="<? if(!$search_detail) echo "display:none"; ?>">

								</div>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="center">
											<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0" alt="" /></a>
											<a href="samu_insure_excel.php?<?=$qstr?>" target=""><img src="./images/btn_excel_print_big.png" border="0" alt="" /></a>
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px"></div>
							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif" alt="" /></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80px;text-align:center;'> 
												����Ʈ
												</td> 
												<td><img src="images/g_tab_on_rt.gif" alt="" /></td> 
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
								<input type="hidden" name="chk_data" />
								<input type="hidden" name="page" value="<?=$page?>" />
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="26" rowspan="2"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" /></td>
										<td class="tdhead_center" width="46" rowspan="2">No</td>
										<td class="tdhead_center" width="74" rowspan="2">�Ű�����</td>
										<td class="tdhead_center" width="80" rowspan="2">�ٷ��ڸ�</td>
										<td class="tdhead_center" width="100" rowspan="2">�ֹε�Ϲ�ȣ</td>
										<td class="tdhead_center" width="60" rowspan="2">�Ű���<br></td>
										<td class="tdhead_center" rowspan="2">������</td>
										<td class="tdhead_center" width="98" rowspan="">����ڵ�Ϲ�ȣ</td>
										<td class="tdhead_center" width="90" rowspan="">��ȭ��ȣ</td>
										<td class="tdhead_center" width="78" rowspan="2">��ǥ��</td>
										<td class="tdhead_center" width="90" rowspan="2">����</td>
										<td class="tdhead_center" width="70" rowspan="">��������</td>
										<td class="tdhead_center" width="66" rowspan="2">��Ź��ȣ</td>
										<td class="tdhead_center" width="84" rowspan="">������</td>
									</tr>
									<tr>
										<td class="tdhead_center" width="" rowspan="">����������ȣ</td>
										<td class="tdhead_center" width="" rowspan="">�ѽ���ȣ</td>
										<td class="tdhead_center" width="" rowspan="">��������</td>
										<td class="tdhead_center" width="" rowspan="">�����</td>
									</tr>
<?
//��Ź��ȣ ���� ��ȣ �ʱ�ȭ
$samu_receive_no_old = "";
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	//�ŷ�ó �ڵ�
	$id = $row['com_code'];
	//�Ǻ����ڽŰ� �ڵ�
	$idx = $row['idx'];
	//��Ź�ŷ�ó �ڵ�
	if($row['samu_receive_no'] > 0) {
		$samu_receive_no = $row['samu_receive_no']."<br>";
	} else if($row['samu_receive_no'] == "-") {
		$samu_receive_no = "";
	} else {
		$samu_receive_no = "";
	}
	//echo $samu_receive_no." != ".$samu_receive_no_old." / ";
	//if($samu_receive_no_old && $samu_receive_no != $samu_receive_no_old-1) $samu_receive_no_color = "color:red";
	//else $samu_receive_no_color = "";
	//��Ź��ȣ ���� ���� ���� 150318
	$samu_receive_no_color = "";
	//��Ź��ȣ ���� ��ȣ
	if($row['samu_receive_no_old']) {
		$samu_receive_no_old = $row['samu_receive_no_old'];
	} else {
		$samu_receive_no_old = "";
	}
	//�������
	$regdt = $row['regdt'];
	$date1 = substr($row['regdt'],0,10); //��¥ǥ�����ĺ���
	$samu_4insure_regdt_time = substr($row['regdt'],11,8); //�ð��� ǥ��
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$samu_4insure_regdt = $year.".".$month.".".$day."";
	//�Ű�����
	$report_date = $row['report_date'];
	$report_time = $row['report_time'];
	//�ΰ�����
	if($row['levy_kind'] == 1) $levy_kind = "�ΰ�����";
	else if($row['levy_kind'] == 2) $levy_kind = "�����Ű�";
	else $levy_kind = "-";
	//������
	$com_name_full = $row['com_name'];
	$com_name = cut_str($com_name_full, 28, "..");
	//���������
	if($row['registration_day']) $registration_day = $row['registration_day'];
	else $registration_day = "-";
	//���� ����
	if($row['upche_div'] == "2") {
		$upche_div = "����";
	} else {
		$upche_div = "����";
	}
	//�ּ�
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 18, "..");
	//��ȭ��ȣ
	$com_tel = $row['com_tel'];
	//1544 ���� ������ȣ ����
	$com_tel_array = explode("-", $com_tel);
	if($com_tel_array[0] == "000") $com_tel = $com_tel_array[1]."-".$com_tel_array[2];
	//����ڵ�Ϲ�ȣ
	if($row['biz_no']) $biz_no = $row['biz_no'];
	else $biz_no = "-";
	//����������ȣ
	if($row['t_insureno']) $t_insureno = $row['t_insureno'];
	else $t_insureno = "-";
	//��ǥ��
	$boss_name_full = $row['boss_name'];
	if($row['boss_name']) $boss_name = cut_str($boss_name_full, 10, "..");
	else $boss_name = "-";
	//������
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	//���Ŵ���
	$manage_cust_name = $row['manage_cust_name'];
	//����
	$uptae_full = $row['uptae'];
	if($row['uptae']) $uptae = cut_str($uptae_full, 16, "..");
	else $uptae = "-";
	//����
	$upjong_full = $row['upjong'];
	if($row['upjong']) $upjong = cut_str($upjong_full, 16, "..");
	else $upjong = "-";
	//�Ƿڼ�
	if($row['editdt']) $editdt = $row['editdt'];
	else $editdt = "-";
	//��Ź��
	if($row['samu_receive_date']) $samu_receive_date = $row['samu_receive_date'];
	else $samu_receive_date = "-";
	//������
	if($row['samu_req_date']) $samu_req_date = $row['samu_req_date'];
	else $samu_req_date = "-";
	//������
	if($row['samu_close_date']) $samu_close_date = $row['samu_close_date'];
	else $samu_close_date = "-";
	$samu_close_date_color = "";
	//ó����Ȳ (�繫��Ź)
	$samu_req_yn_array = Array("","�ݷ�","���Ӱ���","Ÿ����","����","����");
	$samu_req_yn_code = $row['samu_req_yn'];
	if($row['samu_req_yn']) $samu_req_yn_text = $samu_req_yn_array[$samu_req_yn_code];
	else $samu_req_yn_text = "-";
	//�Ҹ� �����
	if($row['samu_state_gy'] == "2") $samu_req_yn_text1 = "<span style='color:red'>�Ҹ�</span>(���)";
	else $samu_req_yn_text1 = "";
	if($row['samu_state_sj'] == "2") $samu_req_yn_text2 = "<span style='color:red'>�Ҹ�</span>(����)";
	else $samu_req_yn_text2 = "";
	if($samu_req_yn_text1) $samu_req_yn_text_br = "<br>";
	else $samu_req_yn_text_br = "";
	if($samu_req_yn_text1 || $samu_req_yn_text2) {
		$samu_req_yn_text = $samu_req_yn_text1.$samu_req_yn_text_br.$samu_req_yn_text2;
		$samu_termination = "<span style='color:red;'>(�Ҹ�)</span>";
	} else {
		$samu_req_yn_text = "";
		$samu_termination = "";
	}
	//�������� URL
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
		$com_view = "samu_insure_view.php?id=$id&amp;idx=$idx&amp;w=u&amp;$qstr&amp;page=$page";
	} else {
		$com_view = "javascript:alert('�ش� �ٷ��� ������ ������ ������ �����ϴ�.');";
	}
	//���� ����� ȸ�� �� ǥ��
	if($samu_req_yn_code == '5') {
		$tr_class = "list_row_now_gr";
		$samu_close_text = "<span style='color:red;'>(����)</span>";
	} else {
		$tr_class = "list_row_now_wh";
		$samu_close_text = "";
	}
	//�ǰ�EDI
	$health_req_yn_array = Array("","�ݷ�","���Ӱ���","Ÿ����","����","����");
	$health_req_yn_code = $row['health_req_yn'];
	if($row['health_req_yn']) $health_req_yn_text = $health_req_yn_array[$health_req_yn_code];
	else $health_req_yn_text = "-";
	//�Ű���
	$report_kind = $row['report_kind'];
	$report_kind_text = $report_kind_arry[$report_kind];
	//�Ǻ����� ����
	if($row['staff_name']) $staff_name = $row['staff_name'];
	else $staff_name = "�����Ű�";
	//�������
	if($row['staff_ssnb']) $date_birth = substr($row['staff_ssnb'], 0, 8)."*****";
	else $date_birth = "-";
?>
									<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
										<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer" /></td>
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_center_h22" ><span style="<?=$regdt_color?>" title="<?=$report_time?>"><?=$report_date?></span></td>
										<td class="ltrow1_center_h22"><a href="<?=$com_view?>" style="font-weight:bold"><?=$staff_name?></a></td>
										<td class="ltrow1_center_h22"><?=$date_birth?></td>
										<td class="ltrow1_center_h22"><?=$report_kind_text?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>"><?=$com_name?><?=$samu_close_text?><?=$samu_termination?></td>
										<td class="ltrow1_center_h22"><?=$biz_no?><br><?=$t_insureno?></td>
										<td class="ltrow1_center_h22"><?=$com_tel?><br><?=$row['com_fax']?></td>
										<td class="ltrow1_center_h22" title="<?=$boss_name_full?>"><?=$boss_name?></td>
										<td class="ltrow1_center_h22"><span title="<?=$uptae_full?>"><?=$uptae?></span></td>
										<td class="ltrow1_center_h22"><span style="<?=$samu_req_date_color?>"><?=$samu_req_date?></span><br><span style="<?=$samu_close_date_color?>"><?=$samu_close_date?></span></td>
										<td class="ltrow1_center_h22"><?=$samu_receive_no?><?=$samu_receive_no_old?></td>
										<td class="ltrow1_center_h22"><?=$branch?><br><?=$manage_cust_name?></td>
									</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
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
							</form>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
