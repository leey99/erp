<?
$sub_menu = "700100";
$now_date = date("Y.m.d");

/*
//W3C Markup �˻� ���� �α��� ����
$mb['mb_id'] = "kcmc2006";
$g4_path = ".."; // common.php �� ��� ���
include_once("$g4_path/common_erp.php");
set_session('erp_mb_id', $mb['mb_id']);
$member['mb_name'] = "�̿���";
*/
//���� ���� �ε�
include_once("./_common.php");
$sql_common = " from business_log a ";
$sql_search = " where a.id='$id' ";

if(!$sst) {
    $sst = "a.id";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$top_sub_title = "images/top07_01.png";
$sub_title = "��������";
$g4['title'] = $sub_title." : �׷���� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
	//DB �ɼ�
	//$sql_opt = " select * from job_time_opt where id='$id' ";
	//echo $sql1;
	//$result_opt = sql_query($sql_opt);
	//$row_opt=mysql_fetch_array($result_opt);
}

//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_upjong=".$stx_upjong."&stx_boss_name=".$stx_boss_name;
$qstr .= "&stx_process=".$stx_process."&stx_joindt=".$stx_joindt;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<title><?=$g4['title']?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
	<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
	<script type="text/javascript"  src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript"  src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
<script type="text/javascript">
//<![CDATA[
function checkAddress(strgbn)
{
	//var ret = window.open("./common/member_address.php?frm_name=dataForm&frm_zip1=adr_zip1&frm_zip2=adr_zip2&frm_addr1=adr_adr1&frm_addr2=adr_adr2", "address", "top=100, left=100, width=410,height=285, scrollbars");
	var ret = window.open("../road_address/search.php", "address", "width=496,height=522,scrollbars=0");
	return;
}
function id_copy() {
	var frm = document.dataForm;
	frm.user_id.value = frm.comp_bznb.value;
}
function checkData(id) {
	var frm = document.dataForm;
	if (frm.manage_cust_name.value == "") {
		alert("����ڸ� �Է��ϼ���.");
		frm.manage_cust_name.focus();
		return;
	}
	if (frm.subject.value == "") {
		alert("������ �Է��ϼ���.");
		frm.subject.focus();
		return;
	}
	if(id == "report") frm.report_bt.value = 1;
	frm.action = "groupware_business_update.php";
	frm.submit();
	return;
}
function radio_chk(x,t){
	var count=0;
	for(i=0;i<x.length;i++){
		if(x[i].checked){
			count += 1;
			radio_name_val = x[i].value; 
		}
	}
	if(count == 0){
		alert(t+" ������ �ּ���.");
		return rv = 0;
	}else{
		//alert(radio_name_val);
		return rv = 1;
	}
}
function only_number() {
	//Ű���� ��� ����Ű
	if (event.keyCode < 48 || event.keyCode > 57) {
		//Ű���� ���� ����Ű
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//hyphen 109 , del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 109 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//comma 110 , del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 110 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
//]]>
</script>
<?
$mb_id = $member['mb_id'];
$sql_manage = " select * from a4_manage where state=1 and user_id='$mb_id' ";
$result_manage = sql_query($sql_manage);
$row_manage = mysql_fetch_array($result_manage);
$damdang_code_no = $row_manage['belong'];
//�������� ��� ���� �ڵ� ��� 160414
if($mb_id == "master") $damdang_code_no = 1;

//���� ����
//�μ�
$dept_code = $row_manage['dept_code'];
$dept_name = $dept_code_arry[$dept_code];
//���� �� ����
$subject_end = " ".$dept_name." ".$row_manage['name']." ��������";

if(!$w) {
	$row['drafter_code'] = $row_manage['code'];
	$row['drafter_name'] = $row_manage['name'];
	//�ű� ��� �� ���� ��¥ ǥ��
	$row['subject_date'] = $now_date;
	$now_date_arry = explode(".", $now_date);
	$row['subject'] = $now_date_arry[0]."�� ".$now_date_arry[1]."�� ".$now_date_arry[2]."��".$subject_end;
}
?>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
//<![CDATA[
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
		//����� ���� �� ���� ��¥(�� �� ��) �������� �Է� 160419
		subject_date_change(date);
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
function findNomu(branch,kind) {
	var ret = window.open("pop_manage_cust.php?search_belong="+branch+"&amp;kind="+kind, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
}
//����/������
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122)) event.returnValue = false;
}
//����Խ��� �Է� �޸�
function checkcomma(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	var main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
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
	input = delcomma(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(1 == 1) { // ��� ����
		//�齺���̽�Ű ����
		if(event.keyCode != 8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 4){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,4)+".";
			} else if(inputVal.length == 7){
				total += inputVal.substring(0,7)+".";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value=total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delcomma(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='.'){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
//õ���� �޹�
function checkThousand(inputVal, type, keydown) {
	main = document.dataForm;
	var chk		= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	//�� ����Ʈ+�� �� �� Home
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36) {
		if (inputVal.length > 3) {
			input = delCom(inputVal, inputVal.length);
			chk = (input.length)/3;
			chk = Math.floor(chk);
			share = (input.length)%3;
			if (share == 0 ) {						
				chk = chk - 1;
			}
			for(i=chk; i>0; i--) {
				triple = i * 3;
				end = Number(input.length)-Number(triple);
				total += input.substring(start,end)+",";
				start = end;
			}
			total +=input.substring(start,input.length);
		} else {
			total = inputVal;
		}
		if(keydown =='Y') {
			type.value=total;
		}else if(keydown =='N') {
			return total
		}
		return total
	}
}
function delCom(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!=',') {
			tmp += inputVal.substring(i,i+1);
		}
	}
	return tmp;
}
function field_add(div_id) {
	var v2 = document.getElementById(div_id+'2');
	var v3 = document.getElementById(div_id+'3');
	var v4 = document.getElementById(div_id+'4');
	if(v2.style.display == "none") {
		v2.style.display = "";
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
			} else {
				alert("�ִ� 8������ �߰� �����մϴ�.");
			}
		}
	}
}
//������ �ŷ�ó �˻�
function schedule_com_find() {
	alert("�غ����Դϴ�.");
}
//����� ���� �� ���� ���� 160419
function subject_date_change(date) {
	var frm = document.dataForm;
	var date_kor_arry = date.split(".");
	var date_kor = date_kor_arry[0]+"�� "+date_kor_arry[1]+"�� "+date_kor_arry[2]+"��<?=$subject_end?>";
	frm.subject.value = date_kor;
	//������ iframe src ����
	getId("popup_schedule_iframe_today").src = "popup_schedule.php?manage_code=<?=$row['drafter_code']?>&search_sday="+date+"&today_chk=1";
	getId("popup_schedule_iframe").src = "popup_schedule.php?manage_code=<?=$row['drafter_code']?>&search_sday="+date;
}
//]]>
</script>
<?
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
$is_damdang = "ok";
$url_list = "groupware_business_log.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top07.gif" border="0" alt="�׷����" /></td>
						<td><a href="<?=$url_list?>"><img src="<?=$top_sub_title?>" border="0" alt="��������" /></a></td>
						<td></td>
					</tr>
					<tr><td colspan="3" style="background:#cccccc;height:1px;"></td></tr>
				</table>
				<table width="900" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0;">
							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA">
								<input type="hidden" name="dept_code" value="<?=$dept_code?>" />
								<input type="hidden" name="report_bt" value="" />
								<!--�Է���-->
								<table border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="background:url('images/g_tab_on_bg.gif');width:90px;text-align:center;"> 
														�⺻����
													</td> 
													<td><img src="images/g_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="2"></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<table border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed;width:100%;height:200px;">
									<tr>
										<td class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�����<font color="red">*</font></td>
										<td class="tdrow" colspan="3">
											<input type="text" name="manage_cust_numb" class="textfm" style="float:left;width:34px;background:#bbbbbb;" readonly value="<?=$row['drafter_code']?>">
											<input type="text" name="manage_cust_name" class="textfm" style="float:left;width:82px;background:#bbbbbb;" readonly value="<?=$row['drafter_name']?>">
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white nowrap"><a href="javascript:findNomu(<?=$damdang_code_no?>,1);" target="">�˻�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����<font color="red">*</font></td>
										<td class="tdrow" colspan="3">
											<input name="subject" type="text" class="textfm" style="width:300px;ime-mode:active;vertical-align:middle;float:left;background:#dddddd;" readonly value="<?=$row['subject']?>" maxlength="100" />
											<input name="subject_date" type="text" class="textfm" style="width:78px;ime-mode:disabled;float:left;background:#dddddd;" readonly value="<?=$row['subject_date']?>" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.subject_date);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
											<div style="margin:4px 0 0 8px;float:left;">�� ����� ������ �޷��� Ŭ�� �� ��¥�� �����ϸ� �˴ϴ�.</div>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�������<font color="red">*</font></td>
										<td class="tdrow" colspan="3">
<?
//�������
$sql_approval = " select * from business_approval where code='$row[drafter_code]' ";
$result_approval = sql_query($sql_approval);
$row_approval = mysql_fetch_array($result_approval);
$approval_cnt = 0;
for($i=1;$i<=5;$i++) {
	$approval[$i] = $row_approval['approval'.$i];
	//�ݷ��� ��� ���� ��� �ݷ� ǥ��
	if($row['approval'.$i.'_process'] == 3) $approval_sign[$i] = "return";
	else $approval_sign[$i] = $approval[$i];
	//�����Ͻ�
	$approval_time[$i] = $row['approval'.$i.'_time'];
	//����
	$sql_position = " select position from a4_manage where user_id='$approval[$i]' and state=1 ";
	//echo $sql_position;
	$result_position = sql_query($sql_position);
	$row_position = mysql_fetch_array($result_position);
	$position[$i] = $row_position['position'];
	if($approval[$i]) {
		$approval_cnt ++;
?>
											<div style="width:80px;height:70px;border-right:1px solid #cccccc;text-align:center;float:left;">
												<input type="hidden" name="approval_<?=$i?>" value="<?=$approval[$i]?>" />
												<input type="hidden" name="approval<?=$i?>_process" value="<?=$row['approval'.$i.'_process']?>" />
												<?=$position[$i]?><br />
<?
		if($row['approval'.$i.'_time']) {
?>
												<img src="images/sign_<?=$approval_sign[$i]?>.png" title="<?=$approval_time[$i]?>" />
<?
		}
?>
											</div>
<?
	}
}
?>
											<input type="hidden" name="approval_cnt" value="<?=$approval_cnt?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����</td>
										<td class="tdrow" colspan="3">
<?
//����� ���θ� ���� ����
if($is_damdang == "ok") {
?>
											<textarea name="work_forenoon" class="textfm" style='width:100%;height:76px;word-break:break-all;'><?=$row['work_forenoon']?></textarea>
<?
} else {
	if($row['work_forenoon']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['work_forenoon']."</pre>";
}
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����</td>
										<td class="tdrow" colspan="3">
<?
//����� ���θ� ���� ����
if($is_damdang == "ok") {
?>
											<textarea name="work_afternoon" class="textfm" style='width:100%;height:76px;word-break:break-all;'><?=$row['work_afternoon']?></textarea>
<?
} else {
	if($row['work_afternoon']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['work_afternoon']."</pre>";
}
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�߰�</td>
										<td class="tdrow" colspan="3">
<?
//����� ���θ� ���� ����
if($is_damdang == "ok") {
?>
											<textarea name="work_night" class="textfm" style='width:100%;height:76px;word-break:break-all;'><?=$row['work_night']?></textarea>
<?
} else {
	if($row['work_night']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['work_night']."</pre>";
}
?>
										</td>
									</tr>
<?
//������ ǥ�� ���� : ����� ����, �豹�� ����, �ӿ��� ����, ����� ���� (����), ������, ����� (TM)
if($row['drafter_code'] == 110 || $row['drafter_code'] == 26 || $row['drafter_code'] == 122 || $row['drafter_code'] == 126 || $row['drafter_code'] == 1030 || $row['drafter_code'] == 1000) {
?>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />������</td>
										<td class="tdrow" colspan="3">
<script type="text/javascript">
//<![CDATA[
function resizeFrame(frm) {
	frm.style.height = "auto";
	contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
	frm.style.height = contentHeight + 0 + "px";
}
//]]>
</script>
											<iframe id="popup_schedule_iframe" src="popup_schedule.php?manage_code=<?=$row['drafter_code']?>&amp;search_sday=<?=$row['subject_date']?>" frameborder="0" width="100%" height="200" onload="resizeFrame(this)" scrolling="no" style="margin:10px 0 0 0"></iframe>
										</td>
									</tr>
<?
}
?>
									<tr>
										<td class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />��������
											<br /><img src="./images/blank.gif" width="7" height="2">��������
										</td>
										<td class="tdrow" colspan="3">
<?
//����� ���θ� ���� ����
if($is_damdang == "ok") {
?>
											<textarea name="work_plan" class="textfm" style='width:100%;height:76px;word-break:break-all;'><?=$row['work_plan']?></textarea>
<?
} else {
	if($row['work_plan']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['work_plan']."</pre>";
}
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />Ư�̻���</td>
										<td class="tdrow" colspan="3">
<?
//����� ���θ� ���� ����
if($is_damdang == "ok") {
?>
											<textarea name="memo" class="textfm" style='width:100%;height:76px;word-break:break-all;'><?=$row['memo']?></textarea>
<?
} else {
	if($row['memo']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['memo']."</pre>";
}
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

<?
//�����
$subject_date = $row['subject_date'];
//����� �ڵ�
$drafter_code = $row['drafter_code'];
//���� �Է� ����
$report_input = 1;
//�渮�� ����, 101 ������
if($row['drafter_code'] == 101) {
	include "./inc/business_log_101.php";
//�繫��Ź, Ű��빫 ����, 23 ������
} else if($row['drafter_code'] == 23) {
	include "./inc/business_log_23.php";
//TM�� ����, 1030 ������, 1000 �����
} else if($row['drafter_code'] == 1030 || $row['drafter_code'] == 1000) {
	include "./inc/business_log_1030.php";
//��������� ����, 122 �ӿ���, 126 �����
} else if($row['drafter_code'] == 122 || $row['drafter_code'] == 126) {
	include "./inc/business_log_122.php";
}
?>

								<!--÷�μ���-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														÷�μ���
													</td> 
													<td><img src="images/sb_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_1" value="1" style="vertical-align:middle" />����<? } ?>
											<div style="margin:4px 0 0 0">
												<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /><a href="javascript:field_add('file_tr');"><img src="images/btn_add.png" border="0" style="vertical-align:middle" alt="+" /> <span  style="">�߰�</span></a>
											</div>
										</td>
										<td   class="tdrow" width="320">
											<? if($is_damdang == "ok") { ?><input name="filename_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/business_log/<?=$row['filename_1']?>" target="_blank"><?=$row['filename_1']?></a>
											<input type="hidden" name="file_1" value="<?=$row['filename_1']?>" />
										</td>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_2" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/business_log/<?=$row['filename_2']?>" target="_blank"><?=$row['filename_2']?></a>
											<input type="hidden" name="file_2" value="<?=$row['filename_2']?>" />
										</td>
									</tr>
									<tr id="file_tr2" style="<? if(!$row['filename_3'] && !$row['filename_4']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����3 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_3" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/business_log/<?=$row['filename_3']?>" target="_blank"><?=$row['filename_3']?></a>
											<input type="hidden" name="file_3" value="<?=$row['filename_3']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����4 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_4" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/business_log/<?=$row['filename_4']?>" target="_blank"><?=$row['filename_4']?></a>
											<input type="hidden" name="file_4" value="<?=$row['filename_4']?>" />
										</td>
									</tr>
									<tr id="file_tr3" style="<? if(!$row['filename_5'] && !$row['filename_6']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����5 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_5" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/business_log/<?=$row['filename_5']?>" target="_blank"><?=$row['filename_5']?></a>
											<input type="hidden" name="file_5" value="<?=$row['filename_5']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����6 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_6" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/business_log/<?=$row['filename_6']?>" target="_blank"><?=$row['filename_6']?></a>
											<input type="hidden" name="file_6" value="<?=$row['filename_6']?>" />
										</td>
									</tr>
									<tr id="file_tr4" style="<? if(!$row['filename_7'] && !$row['filename_8']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����7 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_7" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_7" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<br/><a href="files/business_log/<?=$row['filename_7']?>" target="_blank"><?=$row['filename_7']?></a>
											<input type="hidden" name="file_7" value="<?=$row['filename_7']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����8 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_8" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_8" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<br/><a href="files/business_log/<?=$row['filename_8']?>" target="_blank"><?=$row['filename_8']?></a>
											<input type="hidden" name="file_8" value="<?=$row['filename_8']?>" />
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
								<div style="height:30px;font-size:0px;text-align:center;margin-top:10px;" id="btn_new_client_register">
									<a href="#submitTemp"   onclick="checkData('temp');  return false;" onkeypress="this.onclick;" style="margin-left:0;"   ><img src="images/btn_temp_save_big.png" width="78" height="30" border="0" /></a>
<?
//�̹� ��� �����̰ų� ��������� ������ �� �Ѹ��̶� ���縦 �� ��� ��� ��ư ����
if($report_chk != 1) {
?>
									<a href="#submitReport" onclick="checkData('report');return false;" onkeypress="this.onclick;" style="margin-left:10px;"><img src="images/btn_report_big.png"    width="78" height="30" border="0" /></a>
<?
}
?>
									<a href="groupware_business_log.php?<?=$qstr?>" style="margin-left:10px;"><img src="images/btn_list_big.png" border="0" /></a>
								</div>
								<div style="height:20px;font-size:0px"></div>
								<input type="hidden" name="w" value="<?=$w?>" />
								<input type="hidden" name="id" value="<?=$id?>" />
								<input type="hidden" name="page" value="<?=$page?>" />
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
