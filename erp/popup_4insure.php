<?
$sub_menu = "400101";
include_once("./_common.php");
$colspan = 8;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0 4px 0 0;">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goInsert() {
	var frm = document.dataForm;
	var rv = 0;
	if(frm.report_kind.value == "") {
		alert("�Ű����� �Է��Ͻʽÿ�.");
		frm.memo.focus();
		return;
	}
	frm.action = "popup_4insure_update.php";
	frm.submit();
	return;
}
function memo_del(id,idx,stx_report_kind) {
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "popup_4insure_delete.php?id="+id+"&amp;idx="+idx+"&amp;stx_report_kind="+stx_report_kind;
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
</script>
<div style="overflow-y:auto;height:160px;width:100%;margin-bottom:9px;" id="popup_4insure_div">
	<table width="99%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="" align="">
		<tr>
			<td class="tdhead_center" width="30" rowspan="">No</td>
			<td class="tdhead_center" width="90" rowspan="">�Ű���</td>
			<td class="tdhead_center" width="90" rowspan="">�Ű�����</td>
			<td class="tdhead_center" width="140" rowspan="">���豸��</td>
			<td class="tdhead_center" width="120" rowspan="">�ٷ��ڸ�</td>
			<td class="tdhead_center" width="120" rowspan="">�ֹε�Ϲ�ȣ</td>
			<td class="tdhead_center">���</td>
			<td class="tdhead_center" width="40" rowspan="">����</td>
		</tr>
<?
//�Ű� ���к� �˻�
if($stx_report_kind) $sql_4insure_search = " and report_kind = '$stx_report_kind' ";
$sql_common = " from samu_4insure ";
$sql_search = " where com_code='$id' and delete_yn != '1' $sql_4insure_search ";
$order_by = " order by regdt desc, idx desc ";
$sql = " select count(*) as cnt $sql_common $sql_search ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$sql_4insure = "  select * $sql_common $sql_search $order_by ";
$result_4insure = sql_query($sql_4insure);
for ($i=0; $row_4insure=sql_fetch_array($result_4insure); $i++) {
	$no = $total_count - $i;
	$idx = $row_4insure['idx'];
	$report_kind = $row_4insure['report_kind'];
	$report_kind_text = $report_kind_arry[$report_kind];
	//�������
	$date1 = substr($row_4insure['regdt'],0,10); //��¥ǥ�����ĺ���
	$samu_4insure_regdt_time = substr($row_4insure['regdt'],11,8); //�ð��� ǥ��
	$date = explode("-", $date1); 
	$year = $date[0];
	$month = $date[1]; 
	$day = $date[2]; 
	$samu_4insure_regdt = $year.".".$month.".".$day."";
	//���豸��
	$insure_kind = "";
	if($row_4insure['isgy']) $insure_kind = "���.";
	if($row_4insure['issj']) $insure_kind .= "����.";
	if($row_4insure['iskm']) $insure_kind .= "����.";
	if($row_4insure['isgg']) $insure_kind .= "�ǰ�.";
	//���� ���� ���� : ����� �ڽ�, ������, ������(�繫��Ź �����) 151002
	if($member['mb_id'] == $row_4insure['user_id'] || $member['mb_id'] == "master" || $member['mb_id'] == "kcmc1007") {
		$memo_del_href = "javascript:memo_del('".$id."','".$row_4insure['idx']."','".$stx_report_kind."')";
		$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	} else {
		$memo_del_href = "javascript:alert('���� ������ �����ϴ�.')";
		$comment_del = " ";
	}
	$comment_del = " <a href=\"".$memo_del_href."\"><img src='images/co_btn_delete.gif' border='0' style='vertical-align:middle;'></a>";
	//�Ǻ����� ����
	if($row_4insure['staff_name']) $staff_name = $row_4insure['staff_name'];
	else $staff_name = "�����Ű�";
?>
		<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
			<td class="ltrow1_center_h22"><?=$no?></td>
			<td class="ltrow1_center_h22"><?=$report_kind_text?></td>
			<td class="ltrow1_center_h22" title="<?=$samu_4insure_regdt_time?>"><?=$samu_4insure_regdt?></td>
			<td class="ltrow1_center_h22"><?=$insure_kind?></td>
			<td class="ltrow1_center_h22"><a href="samu_insure_view.php?id=<?=$id?>&amp;w=u&amp;idx=<?=$idx?>" target="_parent"><strong><?=$staff_name?></strong></a></td>
			<td class="ltrow1_center_h22"><?=$row_4insure['staff_ssnb']?></td>
			<td class="ltrow1_left_h22"><?=$row_4insure['staff_memo']?></td>
			<td class="ltrow1_center_h22" style=""><?=$comment_del?></td>
		</tr>
<?
}
if($i == 0) echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
	</table>
</div>
<form name="dataForm" method="post" enctype="" style="margin:5px 0 0 0;height:84px;">
	<input type="hidden" name="w" value="<?=$w?>" />
	<input type="hidden" name="id" value="<?=$id?>" />
	<input type="hidden" name="user_id" value="<?=$member['mb_id']?>" />
	<input type="hidden" name="idx" value="<?=$idx?>" />
	<input type="hidden" name="stx_report_kind" value="<?=$stx_report_kind?>" />
	<div style="float:left">
		<strong>�Ű���</strong>
		<select name="report_kind" class="selectfm">
			<option value="">����</option>
<?
for($m=1;$m<count($report_kind_arry);$m++) {
?>
			<option value="<?=$m?>" <? if($stx_report_kind == $m) echo "selected"; ?> ><?=$report_kind_arry[$m]?></option>
<?
}
?>
		</select>
		<strong>���豸��</strong>
		<input type="checkbox" name="isgy" value="1" checked class="checkbox" style="vertical-align:middle;margin-bottom:4px;" />���
		<input type="checkbox" name="issj" value="1" checked class="checkbox" style="vertical-align:middle;margin-bottom:4px;" />����
		<input type="checkbox" name="iskm" value="1" checked class="checkbox" style="vertical-align:middle;margin-bottom:4px;" />����
		<input type="checkbox" name="isgg" value="1" checked class="checkbox" style="vertical-align:middle;margin-bottom:4px;" />�ǰ�
		<strong>�ٷ��ڸ�</strong> <input name="staff_name" type="text" class="textfm" style="width:80px;ime-mode:active;" value="" maxlength="14" />
		<strong>�ֹε�Ϲ�ȣ</strong> <input name="staff_ssnb" type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="" maxlength="14" onkeydown="" onkeyup="checkhyphen_ssnb(this.value, this)" />
		<strong>���</strong>
		<input name="staff_memo" type="text" class="textfm" style="width:160px;ime-mode:active;" value="<?=$row_4insure['staff_memo']?>" maxlength="30" />
	</div>
	<div style="float:left;padding:4px 0 0 4px;">
		<a href="javascript:goInsert();"><img src="images/btn_reg_gray.png" border="0" /></a>
	</div>
</form>
</body>
</html>
