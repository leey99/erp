<?
$sub_menu = "101001";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code='$id' ";
$sql_order = "";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$top_sub_title = "images/top_data_subtile.png";
$sub_title = "÷������(��)";
$g4['title'] = $sub_title." : �ŷ�ó : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[com_code];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
	if(!$row['com_code']) alert("�ش� �ŷ�ó�� ���� �Ǿ��ų� �������� �ʽ��ϴ�.","main.php");
	//master �α��ν� com_code ����
	if(!$com_code) $com_code = $id;
	//�ű԰��Ȯ�� DB
	$sql2 = " select * from com_employment where com_code='$com_code' ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//�����DB �ɼ�2
	$sql_opt2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
	//echo $sql_opt2;
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2=mysql_fetch_array($result_opt2);
	//����Ȯ���� �α� ���� (������ ����)
	if($member['mb_level'] != 10) {
		$mb_profile_code = $member['mb_profile'];
		$mb_id = $member['mb_id'];
		$sql_erp_view_log = " insert erp_view_log set branch='$mb_profile_code', user_id='$mb_id', com_code='$com_code', wr_datetime='$now_time' ";
		sql_query($sql_erp_view_log);
	}
}
//�޸�
$memo = $row['memo'];
//�˻� �Ķ���� ����
$qstr = "stx_process=".$stx_process."&amp;stx_comp_name=".$stx_comp_name."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_comp_tel=".$stx_comp_tel."&amp;stx_contract=".$stx_contract."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;stx_man_cust_name2=".$stx_man_cust_name2."&amp;stx_uptae=".$stx_uptae."&amp;stx_upjong=".$stx_upjong."&amp;stx_search_day_chk=".$stx_search_day_chk;
$qstr .= "&amp;stx_addr=".$stx_addr."&amp;stx_addr_first=".$stx_addr_first."&amp;stx_employment_kind1=".$stx_employment_kind1."&amp;stx_employment_kind2=".$stx_employment_kind2."&amp;stx_employment_kind3=".$stx_employment_kind3."&stx_employment_manager_name=".$stx_employment_manager_name;
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<title><?=$g4[title]?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/style_admin.css">
	<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
	<script type="text/javascript"  src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd;">
<script type="text/javascript"  src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
<script type="text/javascript">
//<![CDATA[
function checkID() {
	var frm = document.dataForm;
	if (frm.comp_bznb.value == "")
	{
		alert("����ڹ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
	var ret = window.open("./common/member_idcheck.php?user_id="+frm.comp_bznb.value, "id_check", "top=100, left=100, width=395,height=240");
	return;
}
function id_copy() {
	var frm = document.dataForm;
	frm.user_id.value = frm.comp_bznb.value;
}
function checkData(action_file) {
	var frm = document.dataForm;
	var rv = 0;
	frm.action = action_file;
	frm.submit();
	return;
}
// ���� �˻� Ȯ��
function del(page,id) {
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
function only_number() {
	//alert(event.keyCode);
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
			if(event.keyCode != 45) event.preventDefault ? event.preventDefault() : event.returnValue = false;
		}
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			if(event.keyCode != 46) event.returnValue = false;
		}
	}
}
function only_number_isnan() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			event.preventDefault ? event.preventDefault() : event.returnValue = false;
		}
	}
}
//]]>
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

	function onSelect(calendar, date) {
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};
	function onClose(calendar) {
		calendar.hide();
		calendar.destroy();
	};
}
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
//����� ���� "2" ���������
function findNomu(branch,kind) {
	var ret = window.open("pop_manage_cust.php?search_belong="+branch+"&kind="+kind, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
}
//����ڹ�ȣ �Է� ������
function checkhyphen(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
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
				if ( type =='1' ) {
					main.comp_bznb.value=total;					// type �� ���� �������� �־� �ش�.
				}
				else if ( type =='2' ) {
					main.t_insureno.value=total;					// type �� ���� �������� �־� �ش�.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//����������ȣ �Է� ������
function checkhyphen_tno(inputVal, type, keydown) {
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
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
				main.t_insureno.value=total;
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
//����/������
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122))  event.preventDefault ? event.preventDefault() : event.returnValue = false;
}
//����Խ��� �Է� �޸�
function checkcomma(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	var main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;			// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	//���� �Է¸�
	//alert(event.keyCode);
	input = delcomma(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(1 == 1) { // ��� ����
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 4){
				//input = delhyphen(inputVal, inputVal.length);
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
function pay_day_last_chk(val) {
	var main = document.dataForm;
	if(val.checked == true) {
		if(main.pay_day.value != "") main.pay_day_old.value = main.pay_day.value;
		main.pay_day.value = "";
	} else {
		//alert(main.pay_day_old.value);
		main.pay_day.value = main.pay_day_old.value;
	}
}
//���ε�Ϲ�ȣ �Է� ������
function checkhyphen_bupin_no(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
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
			if(inputVal.length == 6){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,6)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				if ( type =='1' ) {
					main.bupin_no.value=total;					// type �� ���� �������� �־� �ش�.
				}
				else if ( type =='2' ) {
					main.cust_ssnb.value=total;					// type �� ���� �������� �־� �ش�.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
	}
}
//]]>
</script>
<?
include "inc/top.php";
//��� ���� �������� ����
$php_self_list = "data_list.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top01.gif" border="0" alt="�ŷ�ó" /></td>
						<td width="130"><img src="<?=$top_sub_title?>" border="0" alt="<?=$sub_title?>" /></td>
						<td>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--Ÿ��Ʋ -->	
<?
//$samu_list = "ok";
$report = "ok";
//������ �����
if(!$w || $row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code || $member['mb_level'] >= 9) $hidden_branch = "";
else $hidden_branch = "ok";
include "inc/client_basic_info.php";
?>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
								</div><!--����Ʈ ���� DIV ����-->
								<!--�Ǹ޴� -->
<?
//���� �� �޴� ��ȣ
//$tab_onoff_this = 15;
//���α׷� ����
if($row['easynomu_yn'] == 1) {
	$tab_program_url = 1;
} else if($row['easynomu_yn'] == 2) {
	$tab_program_url = 2;
} else {
	$tab_program_url = 1;
	if($row['construction_yn'] == 1) $tab_program_url = 3;
}
if( ($row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code) || $mb_profile_code == 1 ) include "inc/tab_menu.php";
?>

									<!--÷�μ���-->
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='filename_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif"></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:140;text-align:center'> 
															÷�μ��� (���� �� ����)
														</td> 
														<td><img src="images/sb_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="middle"></td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bbtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
//��ǥ�� ����
if($member['mb_id'] == "kcmc1001") $filename_div_display = "display:none;";
else $filename_div_display = "";
?>
									<div id="filename_div" style="<?=$filename_div_display?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>�⺻����</b><font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
<?
$file_check = explode(',',$row['file_check']);
$file_easynomu = explode(',',$row['file_easynomu']);
/*
if($file_check[0]) echo "�������Ƿڼ�. ";
if($file_check[1]) echo "��༭. ";
if($file_check[2]) echo "�繫��Ź��. ";
if($file_check[3]) echo "�븮�μ���(����). ";
if($file_check[4]) echo "���ڹο�(����). ";
if($file_check[5]) echo "����ڵ����. ";
if($file_check[6]) echo "����纻. ";
if($file_check[7]) echo "���/��Ǹ���Ʈ. ";
if($file_check[8]) echo "�ð�������. ";
if($file_check[9]) echo "��å�ڱ��Ƿڼ�. ";
if($file_check[10]) echo "�������������. ";
if($file_check[11]) echo "��ü�η�������. ";
*/
for($fc=0;$fc<=count($file_check_array);$fc++) {
	if($file_check[$fc]) echo $file_check_array[$fc].". ";
}
//���ϸ� ��¥ �ð� ���� ǥ�� 160201
if($row['filename_1']) $filename_1 = mb_substr($row['filename_1'],16,99,'euc-kr');
if($row['filename_2']) $filename_2 = mb_substr($row['filename_2'],16,99,'euc-kr');
if($row['filename_3']) $filename_3 = mb_substr($row['filename_3'],16,99,'euc-kr');
if($row['filename_4']) $filename_4 = mb_substr($row['filename_4'],16,99,'euc-kr');
if($row['filename_5']) $filename_5 = mb_substr($row['filename_5'],16,99,'euc-kr');
if($row['filename_6']) $filename_6 = mb_substr($row['filename_6'],16,99,'euc-kr');
if($row['filename_7']) $filename_7 = mb_substr($row['filename_7'],16,99,'euc-kr');
if($row['filename_8']) $filename_8 = mb_substr($row['filename_8'],16,99,'euc-kr');
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1
											</td>
											<td   class="tdrow" width="373">
												<a href="files/contract/<?=$row['filename_1']?>" target="_blank"><?=$filename_1?></a>
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_2']?>" target="_blank"><?=$filename_2?></a>
											</td>
										</tr>
										<tr id="file_tr2" style="<? if(!$row['filename_3'] && !$row['filename_4']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����3</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_3']?>" target="_blank"><?=$filename_3?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����4</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_4']?>" target="_blank"><?=$filename_4?></a>
											</td>
										</tr>
										<tr id="file_tr3" style="<? if(!$row['filename_5'] && !$row['filename_6']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����5</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_5']?>" target="_blank"><?=$filename_5?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����6</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_6']?>" target="_blank"><?=$filename_6?></a>
											</td>
										</tr>
										<tr id="file_tr4" style="<? if(!$row['filename_7'] && !$row['filename_8']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����7</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_7']?>" target="_blank"><?=$filename_7?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����8</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_8']?>" target="_blank"><?=$filename_8?></a>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>�����빫 ����</b><font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
<?
if($file_easynomu[0]) echo "�����빫 ��༭. ";
if($file_easynomu[1]) echo "�ٷΰ�༭. ";
if($file_easynomu[2]) echo "�����Ģ üũ����Ʈ. ";
if($file_easynomu[3]) echo "�ֱ�3���� �޿�����. ";
if($row['file_easynomu_1']) $file_easynomu_1 = mb_substr($row['file_easynomu_1'],16,99,'euc-kr');
if($row['file_easynomu_2']) $file_easynomu_2 = mb_substr($row['file_easynomu_2'],16,99,'euc-kr');
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1
											</td>
											<td   class="tdrow" width="373">
												<a href="files/easynomu/<?=$row['file_easynomu_1']?>" target="_blank"><?=$file_easynomu_1?></a>
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2</td>
											<td   class="tdrow" >
												<a href="files/easynomu/<?=$row['file_easynomu_2']?>" target="_blank"><?=$file_easynomu_2?></a>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��Ÿ ����<font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
<?
echo $row['file_etc'];
?>
											</td>
										</tr>
									</table>
									</div>
									<div style="height:10px;font-size:0px"></div>
									<a name="80002"><!--÷�μ��� (���� �� ����)--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='convey_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif"></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:140;text-align:center'> 
															÷�μ��� (���� �� ����)
														</td> 
														<td><img src="images/sb_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=2></td> 
											<td valign="bottom"></td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bbtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<div id="convey_div">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���޼��� �޸�<font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
												<?=$row_opt2['convey_name']?>
<?
//���ϸ� ��¥ �ð� ���� ǥ�� 160201
if($row_opt2['convey_file_1']) $convey_file_1 = mb_substr($row_opt2['convey_file_1'],16,99,'euc-kr');
if($row_opt2['convey_file_2']) $convey_file_2 = mb_substr($row_opt2['convey_file_2'],16,99,'euc-kr');
if($row_opt2['convey_file_3']) $convey_file_3 = mb_substr($row_opt2['convey_file_3'],16,99,'euc-kr');
if($row_opt2['convey_file_4']) $convey_file_4 = mb_substr($row_opt2['convey_file_4'],16,99,'euc-kr');
if($row_opt2['convey_file_5']) $convey_file_5 = mb_substr($row_opt2['convey_file_5'],16,99,'euc-kr');
if($row_opt2['convey_file_6']) $convey_file_6 = mb_substr($row_opt2['convey_file_6'],16,99,'euc-kr');
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1</td>
											<td   class="tdrow" width="365">
												<a href="files/convey_file/<?=$row_opt2['convey_file_1']?>" target="_blank"><?=$convey_file_1?></a>
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2</td>
											<td   class="tdrow" >
												<a href="files/convey_file/<?=$row_opt2['convey_file_2']?>" target="_blank"><?=$convey_file_2?></a>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����3</td>
											<td   class="tdrow" width="">
												<a href="files/convey_file/<?=$row_opt2['convey_file_3']?>" target="_blank"><?=$convey_file_3?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����4</td>
											<td   class="tdrow" >
												<a href="files/convey_file/<?=$row_opt2['convey_file_4']?>" target="_blank"><?=$convey_file_4?></a>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����5</td>
											<td   class="tdrow" width="">
												<a href="files/convey_file/<?=$row_opt2['convey_file_5']?>" target="_blank"><?=$convey_file_5?></a>
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����6</td>
											<td   class="tdrow" >
												<a href="files/convey_file/<?=$row_opt2['convey_file_6']?>" target="_blank"><?=$convey_file_6?></a>
											</td>
										</tr>
									</table>
									</div>
									<div style="height:10px;font-size:0px"></div>

									<a name="17001"><!--��������--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='job_file_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/so_tab_on_lt.gif"></td> 
														<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															������Ʒ�
														</td> 
														<td><img src="images/so_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="bottom" style="padding-left:10px;"></td> 
											</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="botr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<div id="job_file_div">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="120">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">÷�μ������
											</td>
											<td nowrap  class="tdrow" width="" colspan="4">
<?
$job_file_check = explode(',',$row['job_file_check']);

if($is_damdang == "ok") {
	for($i=0;$i<=7;$i++) {
		$k = $i + 1;
?>
												<input type="checkbox" name="job_file_check<?=$k?>" value="1" <? if($job_file_check[$i] == 1) echo "checked"; ?> style="vertical-align:middle"><? if($i == 0) echo "<span style='color:red;font-weight:bold;'>"; ?><?=$job_file_check_array[$i]?><? if($i == 0) echo "</span>"; ?>
<?
	}
} else {
	if($job_file_check[0]) echo $job_file_check_array[0].". ";
	if($job_file_check[1]) echo $job_file_check_array[1].". ";
	if($job_file_check[2]) echo $job_file_check_array[2].". ";
	if($job_file_check[3]) echo $job_file_check_array[3].". ";
	if($job_file_check[4]) echo $job_file_check_array[4].". ";
	if($job_file_check[5]) echo $job_file_check_array[5].". ";
	if($job_file_check[6]) echo $job_file_check_array[6].". ";
	if($job_file_check[7]) echo $job_file_check_array[7];
}
//���ϸ� ��¥ �ð� ���� ǥ�� 160201
if($row['job_file_1']) $job_file_1 = mb_substr($row['job_file_1'],16,99,'euc-kr');
if($row['job_file_2']) $job_file_2 = mb_substr($row['job_file_2'],16,99,'euc-kr');
if($row['job_file_3']) $job_file_3 = mb_substr($row['job_file_3'],16,99,'euc-kr');
if($row['job_file_4']) $job_file_4 = mb_substr($row['job_file_4'],16,99,'euc-kr');
if($row['job_file_5']) $job_file_5 = mb_substr($row['job_file_5'],16,99,'euc-kr');
if($row['job_file_6']) $job_file_6 = mb_substr($row['job_file_6'],16,99,'euc-kr');
if($row['job_file_7']) $job_file_7 = mb_substr($row['job_file_7'],16,99,'euc-kr');
if($row['job_file_8']) $job_file_8 = mb_substr($row['job_file_8'],16,99,'euc-kr');
?>
											</td>
										</tr>
										<tr>
											<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����1</td>
											<td   class="tdrow" width="365">
												<div style="padding-top:4px;">
													<a href="files/job_file/<?=$row['job_file_1']?>" target="_blank"><?=$job_file_1?></a>
												</div>
											</td>
											<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����2</td>
											<td   class="tdrow" colspan="">
												<div style="padding-top:4px;">
													<a href="files/job_file/<?=$row['job_file_2']?>" target="_blank"><?=$job_file_2?></a>
												</div>
											</td>
										</tr>
										<tr>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����3</td>
											<td   class="tdrow" width="">
												<div style="padding-top:4px;">
													<a href="files/job_file/<?=$row['job_file_3']?>" target="_blank"><?=$job_file_3?></a>
												</div>
											</td>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����4</td>
											<td   class="tdrow" colspan="">
												<div style="padding-top:4px;">
													<a href="files/job_file/<?=$row['job_file_4']?>" target="_blank"><?=$job_file_4?></a>
												</div>
											</td>
										</tr>
										<tr>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����5</td>
											<td   class="tdrow" width="">
												<div style="padding-top:4px;">
													<a href="files/job_file/<?=$row['job_file_5']?>" target="_blank"><?=$job_file_5?></a>
												</div>
											</td>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����6</td>
											<td   class="tdrow" colspan="">
												<div style="padding-top:4px;">
													<a href="files/job_file/<?=$row['job_file_6']?>" target="_blank"><?=$job_file_6?></a>
												</div>
											</td>
										</tr>
										<tr>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����7</td>
											<td   class="tdrow" width="">
												<div style="padding-top:4px;">
													<a href="files/job_file/<?=$row['job_file_7']?>" target="_blank"><?=$job_file_7?></a>
												</div>
											</td>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����8</td>
											<td   class="tdrow" colspan="">
												<div style="padding-top:4px;">
													<a href="files/job_file/<?=$row['job_file_8']?>" target="_blank"><?=$job_file_8?></a>
												</div>
											</td>
										</tr>
									</table>
									</div>
									<div style="height:10px;font-size:0px"></div>

								<!--÷�μ���-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:110px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														÷�μ���(������)
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
<?
if($row['electric_charges_file_1']) $electric_charges_file_1 = mb_substr($row['electric_charges_file_1'],16,99,'euc-kr');
if($row['electric_charges_file_2']) $electric_charges_file_2 = mb_substr($row['electric_charges_file_2'],16,99,'euc-kr');
if($row['electric_charges_file_3']) $electric_charges_file_3 = mb_substr($row['electric_charges_file_3'],16,99,'euc-kr');
if($row['electric_charges_file_4']) $electric_charges_file_4 = mb_substr($row['electric_charges_file_4'],16,99,'euc-kr');
if($row['electric_charges_file_5']) $electric_charges_file_5 = mb_substr($row['electric_charges_file_5'],16,99,'euc-kr');
if($row['electric_charges_file_6']) $electric_charges_file_6 = mb_substr($row['electric_charges_file_6'],16,99,'euc-kr');
if($row['electric_charges_file_7']) $electric_charges_file_7 = mb_substr($row['electric_charges_file_7'],16,99,'euc-kr');
if($row['electric_charges_file_8']) $electric_charges_file_8 = mb_substr($row['electric_charges_file_8'],16,99,'euc-kr');
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����1</td>
										<td   class="tdrow" width="365">
											<a href="files/electric_charges/<?=$row['electric_charges_file_1']?>" target="_blank"><?=$electric_charges_file_1?></a>
										</td>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����2</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_file_2']?>" target="_blank"><?=$electric_charges_file_2?></a>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����3</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_file_3']?>" target="_blank"><?=$electric_charges_file_3?></a>
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����4</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_file_4']?>" target="_blank"><?=$electric_charges_file_4?></a>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����5</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_file_5']?>" target="_blank"><?=$electric_charges_file_5?></a>
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����6</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_file_6']?>" target="_blank"><?=$electric_charges_file_6?></a>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����7</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_file_7']?>" target="_blank"><?=$electric_charges_file_7?></a>
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����8</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_file_8']?>" target="_blank"><?=$electric_charges_file_8?></a>
										</td>
									</tr>
								</table>
<?
//���� ����
if($member['mb_level'] != 6) {
	if($row['electric_charges_secret_1']) $electric_charges_secret_1 = mb_substr($row['electric_charges_secret_1'],16,99,'euc-kr');
	if($row['electric_charges_secret_2']) $electric_charges_secret_2 = mb_substr($row['electric_charges_secret_2'],16,99,'euc-kr');
	if($row['electric_charges_secret_3']) $electric_charges_secret_3 = mb_substr($row['electric_charges_secret_3'],16,99,'euc-kr');
	if($row['electric_charges_secret_4']) $electric_charges_secret_4 = mb_substr($row['electric_charges_secret_4'],16,99,'euc-kr');
	if($row['electric_charges_secret_5']) $electric_charges_secret_5 = mb_substr($row['electric_charges_secret_5'],16,99,'euc-kr');
	if($row['electric_charges_secret_6']) $electric_charges_secret_6 = mb_substr($row['electric_charges_secret_6'],16,99,'euc-kr');
	if($row['electric_charges_secret_7']) $electric_charges_secret_7 = mb_substr($row['electric_charges_secret_7'],16,99,'euc-kr');
	if($row['electric_charges_secret_8']) $electric_charges_secret_8 = mb_substr($row['electric_charges_secret_8'],16,99,'euc-kr');
?>
								<div style="height:10px;font-size:0px"></div>
								<!--���ȼ���-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:110px;text-align:center;background:url('images/g_tab_on_bg.gif');"> 
														���ȼ���(������)
													</td> 
													<td><img src="images/g_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����1</td>
										<td   class="tdrow" width="365">
											<a href="files/electric_charges/<?=$row['electric_charges_secret_1']?>" target="_blank"><?=$electric_charges_secret_1?></a>
										</td>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����2</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_secret_2']?>" target="_blank"><?=$electric_charges_secret_2?></a>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����3</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_secret_3']?>" target="_blank"><?=$electric_charges_secret_3?></a>
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����4</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_secret_4']?>" target="_blank"><?=$electric_charges_secret_4?></a>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����5</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_secret_5']?>" target="_blank"><?=$electric_charges_secret_5?></a>
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����6</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_secret_6']?>" target="_blank"><?=$electric_charges_secret_6?></a>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����7</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_secret_7']?>" target="_blank"><?=$electric_charges_secret_7?></a>
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����8</td>
										<td   class="tdrow" >
											<a href="files/electric_charges/<?=$row['electric_charges_secret_8']?>" target="_blank"><?=$electric_charges_secret_8?></a>
										</td>
									</tr>
								</table>
<?
}
?>

									<div style="height:10px;font-size:0px"></div>

								<table border="0" cellpadding="0" cellspacing="0" style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='branch_file_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
														�ű԰��Ȯ��(�Ƿ�)
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
//��� ����, ���� ����, ���� ����
if(!$w || $row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code || $member['mb_level'] >= 9) $is_damdang = "ok";
else $is_damdang = "";
//��ǥ�� ����
if($member['mb_id'] == "kcmc1001") $branch_file_div_display = "display:none;";
else $branch_file_div_display = "";
//���ϸ� ��¥ �ð� ���� ǥ�� 160201
if($row2['branch_file_1']) $branch_file_1 = mb_substr($row2['branch_file_1'],16,99,'euc-kr');
if($row2['branch_file_2']) $branch_file_2 = mb_substr($row2['branch_file_2'],16,99,'euc-kr');
if($row2['branch_file_3']) $branch_file_3 = mb_substr($row2['branch_file_3'],16,99,'euc-kr');
if($row2['branch_file_4']) $branch_file_4 = mb_substr($row2['branch_file_4'],16,99,'euc-kr');
?>
								<!-- �Է��� -->
								<div id="branch_file_div" style="<?=$branch_file_div_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1</td>
										<td   class="tdrow" width="365">
											<a href="files/employment_file/<?=$row2['branch_file_1']?>" target="_blank"><?=$branch_file_1?></a>
										</td>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2</td>
										<td   class="tdrow" >
											<a href="files/employment_file/<?=$row2['branch_file_2']?>" target="_blank"><?=$branch_file_2?></a>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����3</td>
										<td   class="tdrow" width="">
											<a href="files/employment_file/<?=$row2['branch_file_3']?>" target="_blank"><?=$branch_file_3?></a>
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����4</td>
										<td   class="tdrow" >
											<a href="files/employment_file/<?=$row2['branch_file_4']?>" target="_blank"><?=$branch_file_4?></a>
										</td>
									</tr>
								</table>
								</div>
								<div style="height:10px;font-size:0px"></div>
<?
//����, ���� ���� : ����, ������, �뱸�������� 151116
if($member['mb_profile'] == 1 || $member['mb_id'] == 'master' || $member['mb_profile'] == 16) {
?>
								<table border="0" cellpadding="0" cellspacing="0" style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='main_file_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
														�ű԰��Ȯ��(����)
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
<?
	//���� ����
	if($member['mb_level'] != 6) $is_damdang = "ok";
	else $is_damdang = "";
	//��ǥ�� ����
	if($member['mb_id'] == "kcmc1001") $main_file_div_display = "display:none;";
	else $main_file_div_display = "";
	//���ϸ� ��¥ �ð� ���� ǥ�� 160201
	if($row2['main_file_1']) $main_file_1 = mb_substr($row2['main_file_1'],16,99,'euc-kr');
	if($row2['main_file_2']) $main_file_2 = mb_substr($row2['main_file_2'],16,99,'euc-kr');
	if($row2['main_file_3']) $main_file_3 = mb_substr($row2['main_file_3'],16,99,'euc-kr');
	if($row2['main_file_4']) $main_file_4 = mb_substr($row2['main_file_4'],16,99,'euc-kr');
?>
								<!-- �Է��� -->
								<div id="main_file_div" style="<?=$main_file_div_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1</td>
										<td   class="tdrow" width="365">
											<a href="files/employment_file/<?=$row2['main_file_1']?>" target="_blank"><?=$main_file_1?></a>
										</td>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2</td>
										<td   class="tdrow" >
											<a href="files/employment_file/<?=$row2['main_file_2']?>" target="_blank"><?=$main_file_2?></a>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����3</td>
										<td   class="tdrow" width="">
											<a href="files/employment_file/<?=$row2['main_file_3']?>" target="_blank"><?=$main_file_3?></a>
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����4</td>
										<td   class="tdrow" >
											<a href="files/employment_file/<?=$row2['main_file_4']?>" target="_blank"><?=$main_file_4?></a>
										</td>
									</tr>
								</table>
								</div>
								<div style="height:10px;font-size:0px"></div>
								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
														�ű԰��Ȯ��(����)
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
	//�뱸���� ����
	if($member['mb_profile'] == 16) $is_damdang = "ok";
	else $is_damdang = "";
	//���ϸ� ��¥ �ð� ���� ǥ�� 160201
	if($row2['employment_file_1']) $employment_file_1 = mb_substr($row2['employment_file_1'],16,99,'euc-kr');
	if($row2['employment_file_2']) $employment_file_2 = mb_substr($row2['employment_file_2'],16,99,'euc-kr');
	if($row2['employment_file_3']) $employment_file_3 = mb_substr($row2['employment_file_3'],16,99,'euc-kr');
	if($row2['employment_file_4']) $employment_file_4 = mb_substr($row2['employment_file_4'],16,99,'euc-kr');
?>
								<!-- �Է��� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1 <? if($is_damdang) { ?><input type="checkbox" name="employment_file_del_1" value="1" style="vertical-align:middle">����<? } ?></td>
										<td   class="tdrow" width="365">
											<a href="files/employment_file/<?=$row2['employment_file_1']?>" target="_blank"><?=$employment_file_1?></a>
										</td>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2 <? if($is_damdang) { ?><input type="checkbox" name="employment_file_del_2" value="1" style="vertical-align:middle">����<? } ?></td>
										<td   class="tdrow" >
											<a href="files/employment_file/<?=$row2['employment_file_2']?>" target="_blank"><?=$employment_file_2?></a>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����3 <? if($is_damdang) { ?><input type="checkbox" name="employment_file_del_3" value="1" style="vertical-align:middle">����<? } ?></td>
										<td   class="tdrow" width="">
											<a href="files/employment_file/<?=$row2['employment_file_3']?>" target="_blank"><?=$employment_file_3?></a>
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����4 <? if($is_damdang) { ?><input type="checkbox" name="employment_file_del_4" value="1" style="vertical-align:middle">����<? } ?></td>
										<td   class="tdrow" >
											<a href="files/employment_file/<?=$row2['employment_file_4']?>" target="_blank"><?=$employment_file_4?></a>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
<?
}
//���� ���� ȭ�� ǥ�� (Ȯ�� ������ ǥ��) 151116
?>
							</div>
							<div id="tab2" >
								<a name="40001"><!--���޻���--></a>
<?
//$memo_type = 13;
include "inc/client_comment_only.php";
?>
							<div style="height:20px;font-size:0px"></div>
							<input type="hidden" name="id" value="<?=$id?>" />
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
