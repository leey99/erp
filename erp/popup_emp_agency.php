<?
$sub_menu = "400101";
include_once("./_common.php");
$colspan = 12;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0 4px 0 0;">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goInsert() {
	var frm = document.dataForm;
	var rv = 0;
	if(frm.report_date.value == "") {
		alert("���������� �Է��Ͻʽÿ�.");
		frm.report_date.focus();
		return;
	}
	if(frm.staff_name.value == "") {
		alert("�ٷ��ڸ��� �Է��Ͻʽÿ�.");
		frm.staff_name.focus();
		return;
	}
	frm.action = "popup_emp_agency_update.php";
	frm.submit();
	return;
}
function memo_del(id,idx) {
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "popup_emp_agency_delete.php?id="+id+"&amp;idx="+idx;
	}
}
//����, �����¸� �Է� ����
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
//�ֹε�Ϲ�ȣ �Է� ������
function checkhyphen_ssnb(inputVal, type) {
	main = document.dataForm;
	var chk		= 0;
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	input = delhyphen(inputVal, inputVal.length);
	//�� ����Ʈ+�� �� �� Home backsp
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
		if(inputVal.length == 6) {
			total += input.substring(0,6)+"-";
		} else {
			total += inputVal;
		}
		type.value = total;
	}
	return total;
}
function delhyphen(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-') {		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
//��¥ �Է� �޸�
function checkcomma(inputVal, type, keydown) {
	var main = document.dataForm;
	var chk		= 0;
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	input = delcomma(inputVal, inputVal.length);
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
		if(inputVal.length == 4){
			total += input.substring(0,4)+".";
		} else if(inputVal.length == 7) {
			total += inputVal.substring(0,7)+".";
		} else if(inputVal.length == 12) {
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
function delcomma(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!='.') {
			tmp += inputVal.substring(i,i+1);
		}
	}
	return tmp;
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
//<![CDATA[
function loadCalendar( obj ) {
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
//]]>
</script>
<form name="dataForm" method="post" enctype="" style="margin:0 0 0 0;height:50px;">
	<input type="hidden" name="w" value="<?=$w?>" />
	<input type="hidden" name="id" value="<?=$id?>" />
	<input type="hidden" name="user_id" value="<?=$member['mb_id']?>" />
	<input type="hidden" name="idx" value="<?=$idx?>" />
	<input type="hidden" name="stx_report_kind" value="<?=$stx_report_kind?>" />
	<div style="float:left">
		<div>
			<div style="font-weight:bold;float:left;padding:4px 4px 0 0;">����</div>
<?
//textfm5
//readonly
//background:#f0f0f0;
?>
			<input name="report_date" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
			<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.report_date);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif" /></td> <td width="2"></td></tr></table>
			<div style="font-weight:bold;float:left;padding:4px 4px 0 4px;">����</div>
			<input name="staff_name" type="text" class="textfm" style="width:80px;ime-mode:active;float:left;" maxlength="14" />
			<div style="font-weight:bold;float:left;padding:4px 4px 0 4px;">�ֹι�ȣ</div>
			<input name="staff_ssnb" type="text" class="textfm" style="width:100px;ime-mode:disabled;float:left;" maxlength="14" onkeyup="checkhyphen_ssnb(this.value, this)" />
			<div style="font-weight:bold;float:left;padding:4px 4px 0 4px;">����ó</div>
			<input name="staff_tel" type="text" class="textfm" style="width:90px;float:left;" maxlength="14" />
			<div style="font-weight:bold;float:left;padding:4px 4px 0 4px;">�з�</div>
			<input name="scholarship" type="text" class="textfm" style="width:80px;ime-mode:active;float:left;" maxlength="14" />
			<div style="font-weight:bold;float:left;padding:4px 4px 0 4px;">�������</div>
			<input name="hope_job" type="text" class="textfm" style="width:80px;ime-mode:active;float:left;" maxlength="14" />
			<div style="font-weight:bold;float:left;padding:4px 4px 0 4px;">�ڰ���</div>
			<input name="certificate" type="text" class="textfm" style="width:100px;ime-mode:active;float:left;" maxlength="20" />
		</div>
		<div style="clear:both;">
			<div style="font-weight:bold;float:left;padding:4px 4px 0 0;">���</div>
			<input name="career" type="text" class="textfm" style="width:101px;ime-mode:active;float:left;" maxlength="14" />
			<div style="font-weight:bold;float:left;padding:4px 4px 0 5px;">����</div>
			<input name="com_job" type="text" class="textfm" style="width:80px;ime-mode:active;float:left;" maxlength="14" />
			<div style="font-weight:bold;float:left;padding:4px 4px 0 4px;">���</div>
			<input name="staff_memo" type="text" class="textfm" style="width:664px;ime-mode:active;float:left;" maxlength="100" />
		</div>
	</div>
	<div style="float:left;padding:4px 0 0 4px;">
		<a href="javascript:goInsert();"><img src="images/btn_reg_gray.png" border="0" /></a>
	</div>
</form>
<div style="overflow-y:auto;height:146px;width:100%;margin-bottom:9px;" id="popup_emp_agency_div">
	<table width="99%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="">
		<tr>
			<td class="tdhead_center" width="30">No</td>
			<td class="tdhead_center" width="74">��������</td>
			<td class="tdhead_center" width="80">�ٷ��ڸ�</td>
			<td class="tdhead_center" width="100">�ֹε�Ϲ�ȣ</td>
			<td class="tdhead_center" width="100">����ó</td>
			<td class="tdhead_center" width="70">�з�</td>
			<td class="tdhead_center" width="80">�������</td>
			<td class="tdhead_center" width="90">�ڰ���</td>
			<td class="tdhead_center" width="70">���</td>
			<td class="tdhead_center" width="90">����</td>
			<td class="tdhead_center">���</td>
			<td class="tdhead_center" width="40">����</td>
		</tr>
<?
//�Ű� ���к� �˻�
$sql_common = " from employment_agency ";
$sql_search = " where com_code='$id' and delete_yn != '1' ";
$order_by = " order by regdt desc, idx desc ";
$sql = " select count(*) as cnt $sql_common $sql_search ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$sql_emp_agency = "  select * $sql_common $sql_search $order_by ";
$result_emp_agency = sql_query($sql_emp_agency);
for ($i=0; $row_emp_agency=sql_fetch_array($result_emp_agency); $i++) {
	$no = $total_count - $i;
	$idx = $row_emp_agency['idx'];
	//��������
	$report_date = $row_emp_agency['report_date'];
	//���� ���� ���� : ����� �ڽ�, ������, ������(�繫��Ź �����) 151002
	if($member['mb_id'] == $row_emp_agency['user_id'] || $member['mb_id'] == "master" || $member['mb_id'] == "kcmc1007") {
		$memo_del_href = "javascript:memo_del('".$id."','".$row_emp_agency['idx']."')";
		$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	} else {
		$memo_del_href = "javascript:alert('���� ������ �����ϴ�.')";
		$comment_del = " ";
	}
	$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	//�Ǻ����� ����
	if($row_emp_agency['staff_name']) $staff_name = $row_emp_agency['staff_name'];
	else $staff_name = "�����Ű�";
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22"><?=$no?></td>
			<td class="ltrow1_center_h22"><?=$report_date?></td>
			<td class="ltrow1_center_h22"><a href="employment_agency_view.php?id=<?=$id?>&amp;w=u&amp;idx=<?=$idx?>" target="_parent"><strong><?=$staff_name?></strong></a></td>
			<td class="ltrow1_center_h22"><?=$row_emp_agency['staff_ssnb']?></td>
			<td class="ltrow1_center_h22"><?=$row_emp_agency['staff_tel']?></td>
			<td class="ltrow1_center_h22"><?=$row_emp_agency['scholarship']?></td>
			<td class="ltrow1_center_h22"><?=$row_emp_agency['hope_job']?></td>
			<td class="ltrow1_center_h22"><?=$row_emp_agency['certificate']?></td>
			<td class="ltrow1_center_h22"><?=$row_emp_agency['career']?></td>
			<td class="ltrow1_center_h22"><?=$row_emp_agency['com_job']?></td>
			<td class="ltrow1_left_h22"><?=$row_emp_agency['staff_memo']?></td>
			<td class="ltrow1_center_h22" style=""><?=$comment_del?></td>
		</tr>
<?
}
if($i == 0) echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
	</table>
</div>
</body>
</html>
