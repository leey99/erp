<?
$sub_menu = "500300";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//�⵵ ����
if(!$stx_bonus_year) $stx_bonus_year = date("Y");

//���������
$sql_com = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_com = sql_fetch($sql_com);
$com_code = $row_com[com_code];
//��������� �߰�
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//��ǥ DB ���̺�
$sql_common = " from $g4[pibohum_base] ";
//������ ���
if($w == "u") {
	//���DB �󿩱�
	$sql1 = " select * $sql_common where com_code='$com_code' and sabun='$id' ";
	$result1 = sql_query($sql1);
	//���DB �ɼ�
	$sql2 = " select * from pibohum_base_opt where com_code='$com_code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row1=mysql_fetch_array($result1);
	$row2=mysql_fetch_array($result2);
	//����
	if($row2[position]) {
		$sql_position = " select * from com_code_list where item='position' and code=$row2[position] ";
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		$position = $row_position[name];
	}
	//�󿩱ݱ��� (��������, �󿩺���)
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$com_code' and sabun='$id' ";
	//echo $sql_opt2;
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2 = mysql_fetch_array($result_opt2);
}

$sub_title = "�󿩱ݰ���";
$g4[title] = $sub_title." : �빫���� : ".$easynomu_name;
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
function checkID()
{
	var frm = document.dataForm;
	if (frm.user_id.value == "")
	{
		alert("���̵� �Է��ϼ���.");
		frm.user_id.focus();
		return;
	}
	var ret = window.open("./common/member_idcheck.php?uid="+frm.user_id.value, "id_check", "top=100, left=100, width=395,height=240");
	return;
}
function checkAddress(strgbn)
{
	var ret = window.open("./common/member_address.php?frm_name=dataForm&frm_zip1=adr_zip1&frm_zip3=adr_zip2&frm_addr1=adr_adr1&frm_addr2=adr_adr2", "address", "top=100, left=100, width=410,height=285, scrollbars");
	return;
}
function checkData() {
	var frm = document.dataForm;
	var rv = 0;

	if (frm.bonus_day_1.value == "")
	{
		alert("�������ڸ� �Է��ϼ���.");
		frm.bonus_day_1.focus();
		return;
	}
	if (frm.pay_1.value == "")
	{
		alert("���޾��� �Է��ϼ���.");
		frm.pay_1.focus();
		return;
	}
	frm.action = "bonus_update.php";
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
// ���� �˻� Ȯ��
function del(page,idx) 
{
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "bonus_delete.php?page="+page+"&idx="+idx;
	}
}
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 45) event.returnValue = false;
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
	}
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script language="javascript">
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
//�������� / �󿩺���
function bonus_pay_cal(obj,n) {
	frm = document.dataForm;
	//alert(obj.name);
	var p = obj.value;
	result = frm.bonus_standard_pay.value * ( p * 0.01);
	frm['pay_'+n].value = setComma(Math.round(result));
}
//number_format �Լ�
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');    }
    return s.join(dec);
}
//õ���� �޹�
function checkThousand(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	if (inputVal.length > 3) {
		input = delCom(inputVal, inputVal.length);
		/*
		for(i=0; i<inputVal.length; i++){
			if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
				input += inputVal.substring(i,i+1);	// ���� ��� , �� ����
			}
		}*/
		chk = (input.length)/3;					// input ���� 3�Ƿ� ���� �� ���
		chk = Math.floor(chk);					// �� ������ �۰ų� ���� �� �� �ִ��� ���� ���
		share = (input.length)%3;				// 200,000 �� ���� 3�� ����� ���� �ɷ����� ���� ������ ���
		if (share == 0 ) {						
			chk = chk - 1;					// ���̰� 3�� ����� ���� ���� chk ���� �ϳ� ����.
		}
		for(i=chk; i>0; i--) {
			triple = i * 3;					// 3�� ��� ��� 9,6,3 ��� ���� ������
			end = Number(input.length)-Number(triple);	// �� ���� end ���� ���� �þ� ���� �ȴ�.
			total += input.substring(start,end)+",";	// total�� �տ��� ���� ���ʷ� ���δ�.
			start = end;					// end ���� �������� start ������ ����.
		}
		total +=input.substring(start,input.length);		// ���������� ������ 3�ڸ� ���� �ڿ� ������.
	} else {
		total = inputVal;					// 3�� ����� �Ǳ� �������� ���� �״�� �����ȴ�.
	}
	if(keydown =='Y') {
		type.value=total;					// type �� ���� �������� �־� �ش�.
	}else if(keydown =='N') {
		return total
	}
	return total
}
//õ���� �޹�(���� �ٷ� ���� ��ǥ ����)
function checkThousand_minus(inputVal, type, keydown) {
	main = document.dataForm;
	var chk		= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
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
function delCom(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=',') {		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function findNomu() {
	var ret = window.open("pop_manage_cust.php", "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
}
//�ҵ漼 �迭
var ary_tax = new Array();
var ary_tax2 = new Array();
var ary_tax3 = new Array();
var ary_tax4 = new Array();
var ary_tax5 = new Array();
var ary_tax6 = new Array();
var ary_tax7 = new Array();
var ary_tax8 = new Array();
var ary_tax9 = new Array();
var ary_tax10 = new Array();
var ary_tax11 = new Array();
<?
include "./inc/ary_tax.php";
?>
//�ҵ漼 ���
function GetTax(money_for_tax) {
	var i, money_base, smoney, emoney, tax, tax_result
	money_base = parseInt( money_for_tax / 1000 )
	tax_result = 0
	for( var i=0; i <ary_tax.length; i++ ){
		smoney = ary_tax[i][0];
		emoney = ary_tax[i][1];
		tax = ary_tax[i][2];
		if( money_base >= smoney && money_base < emoney ) {
			tax_result = tax;
			break;
		}
	}
	return tax_result;
}
function tax_so_result(no) {
	frm = document.dataForm;
	pay = toInt(frm['pay_'+no].value);
	tax_so = GetTax(pay);
	tax_ju = get_round(tax_so* 0.1 );
	frm['tax_so_'+no].value = number_format(tax_so);
	frm['tax_ju_'+no].value = number_format(tax_ju);
}
function bonus_total_result(no) {
	frm = document.dataForm;
	pay = toInt(frm['pay_'+no].value);
	tax_so = toInt(frm['tax_so_'+no].value);
	tax_ju = toInt(frm['tax_ju_'+no].value);
	minus = toInt(frm['minus_'+no].value);
	if(frm['minus_negative_'+no].value == 1) minus = minus - (minus * 2);
	bonus_total = pay - ( tax_so + tax_ju ) + minus;
	frm['bonus_total_'+no].value = number_format(bonus_total);
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname05.gif" /></td>
								</tr>
								<tr>
									<td><a href="retirement.php" onmouseover="limg1.src='images/menu05_sub01_on.gif'" onmouseout="limg1.src='images/menu05_sub01_off.gif'"><img src="images/menu05_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="annual_paid_holiday.php" onmouseover="limg2.src='images/menu05_sub02_on.gif'" onmouseout="limg2.src='images/menu05_sub02_off.gif'"><img src="images/menu05_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="bonus.php" onmouseover="limg3.src='images/menu05_sub03_on.gif'" onmouseout="limg3.src='images/menu05_sub03_off.gif'"><img src="images/menu05_sub03_off.gif" name="limg3" id="limg3" /></a></td>
								</tr>
							</table>
<?
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

							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													�󿩱� ����
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

							<form name="dataForm" method="post">
							<input type="hidden" name="w" value="<?=$w?>">
							<input type="hidden" name="com_code" value="<?=$row_com[com_code]?>">
							<input type="hidden" name="code" value="<?=$code?>">
							<input type="hidden" name="id" value="<?=$id?>">
							<input type="hidden" name="bonus_year" value="<?=$stx_bonus_year?>">
							<input type="hidden" name="idx" value="<?=$idx?>">
							<input type="hidden" name="page" value="<?=$page?>">
							<!-- �Է��� -->
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="20%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������</td>
									<td nowrap  class="tdrow" width="80%" colspan="3">
<?
//�Ի���
$in_day_array = explode(".",$row1[in_day]);
$in_day = $in_day_array[0]."�� ".$in_day_array[1]."�� ".$in_day_array[2]."��";
//ä������
if($row1[work_form] == "") $work_form = "";
else if($row1[work_form] == "1") $work_form = "������";
else if($row1[work_form] == "2") $work_form = "�����";
else if($row1[work_form] == "3") $work_form = "�Ͽ���";
//��������
if($row_opt2[bonus_standard] == "1") {
	$bonus_standard = "�⺻��";
	$bonus_standard_pay = $row_opt2[money_hour_ms];
} else if($row_opt2[bonus_standard] == "2") {
	$bonus_standard = "�����ӱ�";
	$bonus_standard_pay = $row_opt2[money_month_base];
} else if($row_opt2[bonus_standard] == "3") {
	$bonus_standard = "����ӱ�";
	$bonus_standard_pay = $row_opt2[money_month_base];
} else if($row_opt2[bonus_standard] == "4") {
	$bonus_standard = "�ѱ޿�";
	$bonus_standard_pay = $row_opt2[money_month_base];
}
//�󿩱� �����Է�
$check_bonus_money_yn = $row_opt2[check_bonus_money_yn];
$bonus_money = $row_opt2[bonus_money];
if($check_bonus_money_yn == "Y") {
	$bonus_standard = "ȸ�系��";
	$bonus_standard_pay = $bonus_money;
}
?>
										���� : <?=$row1[name]?> / ���� : <?=$position?> / �ֹε�Ϲ�ȣ : <?=$row1[jumin_no]?> / �Ի��� : <?=$in_day?> / ä������ : <?=$work_form?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" width="20%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��������</td>
									<td nowrap  class="tdrow" width="30%">
										<?=$bonus_standard?> : <?=number_format($bonus_standard_pay)?>��
										<input type="hidden" name="bonus_standard_pay" value="<?=$bonus_standard_pay?>">
									</td>
									<td nowrap class="tdrowk" width="20%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�󿩺���</td>
									<td nowrap  class="tdrow" width="30%">
										<?=$row_opt2[bonus_percent]?>%
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
													�󿩱� ���
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
$bonus_array = explode(",",$row_opt2[bonus_time]);
$bonus_time[0] = $bonus_array[0];
$bonus_time[1] = $bonus_array[1];
$bonus_time[2] = $bonus_array[2];
$bonus_time[3] = $bonus_array[3];
$bonus_time[4] = $bonus_array[4];
$bonus_time[5] = $bonus_array[5];
$bonus_p = explode(",",$row_opt2[bonus_p]);
//�󿩱� �����Է�
$check_bonus_money_yn = $row_opt2[check_bonus_money_yn];
$bonus_money = $row_opt2[bonus_money];
for($i=0;$i<6;$i++) {
	$k = $i + 1;
	$sql_bonus = " select * from pibohum_base_bonus where com_code='$com_code' and sabun='$id' and bonus_year='$stx_bonus_year' and bonus_time='$k' ";
	//echo $sql_bonus;
	$result_bonus = sql_query($sql_bonus);
	$row_bonus = mysql_fetch_array($result_bonus);
	//��������, �󿩺���, ���޾�, �޸�
	$bonus_day[$i] = $row_bonus[bonus_day];
	$bonus_percent[$i] = $row_bonus[bonus_percent];
	$bonus_pay[$i] = $row_bonus[pay];
	$tax_so[$i] = $row_bonus[tax_so];
	$tax_ju[$i] = $row_bonus[tax_ju];
	$minus[$i] = $row_bonus[minus];
	$minus_negative[$i] = $row_bonus[minus_negative];
	$bonus_total[$i] = $row_bonus[bonus_total];
	$memo[$i] = $row_bonus[memo];
	//���޽ñ⺰ �󿩺���
	if(!$bonus_p[$i]) {
		$bonus_p[$i] = $bonus_percent[$i];
	} else {
		if($bonus_p[$i]) $bonus_p[$i] = $bonus_p[$i];
		else $bonus_p[$i] = "";
	}
}
?>
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td class="tdrowk_center">�� ��</td>
									<td class="tdrowk" width="130">���޽ñ�1</td>
									<td class="tdrowk" width="130">���޽ñ�2</td>
									<td class="tdrowk" width="130">���޽ñ�3</td>
									<td class="tdrowk" width="130">���޽ñ�4</td>
									<td class="tdrowk" width="130">���޽ñ�5</td>
									<td class="tdrowk" width="130">���޽ñ�6</td>
								</tr>
								<tr>
									<td class="tdrowk" style="padding:5px">��Ī</td>
									<td class="tdrow"><b><?=$bonus_time[0]?></b></td>
									<td class="tdrow"><b><?=$bonus_time[1]?></b></td>
									<td class="tdrow"><b><?=$bonus_time[2]?></b></td>
									<td class="tdrow"><b><?=$bonus_time[3]?></b></td>
									<td class="tdrow"><b><?=$bonus_time[4]?></b></td>
									<td class="tdrow"><b><?=$bonus_time[5]?></b></td>
								</tr>
								<tr>
									<td class="tdrowk">�󿩺���</td>
<?
for($i=0;$i<6;$i++) {
	$k = $i + 1;
?>
									<td class="tdrow">
<?
	if($bonus_p[$i]) {
		if(!$bonus_percent[$i]) $bonus_percent[$i] = $bonus_p[$i];
?>
										<input name="bonus_p_<?=$k?>" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$bonus_percent[$i]?>" maxlength="3" onkeyup=""> %
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:bonus_pay_cal(document.dataForm.bonus_p_<?=$k?>,<?=$k?>);" target="">����</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
<?
	}
?>
									</td>
<?
}
?>
								</tr>
								<tr>
									<td class="tdrowk">��������<font color="red">*</font></td>
<?
for($i=0;$i<6;$i++) {
	$k = $i + 1;
?>
									<td class="tdrow">
<?
	if($bonus_p[$i]) {
?>
										<input name="bonus_day_<?=$k?>" type="text" class="textfm" style="width:76px;" value="<?=$bonus_day[$i]?>" maxlength="10">
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.bonus_day_<?=$k?>);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
<?
	}
?>
									</td>
<?
}
?>
								</tr>
								<tr>
									<td class="tdrowk">���޾�<font color="red">*</font></td>
<?
for($i=0;$i<6;$i++) {
	$k = $i + 1;
?>
									<td class="tdrow">
<?
	if($bonus_p[$i]) {
		if(!$bonus_pay[$i]) $bonus_pay[$i] = number_format($bonus_standard_pay * ($bonus_percent[$i]*0.01) );
?>
										<input name="pay_<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$bonus_pay[$i]?>" maxlength="10" onkeyup="checkThousand(this.value, this,'Y')"> ��
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:tax_so_result(<?=$k?>);" target="">����</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
<?
	}
?>
									</td>
<?
}
?>
								</tr>
								<tr>
									<td class="tdrowk">�ҵ漼<font color="red"></font></td>
<?
for($i=0;$i<6;$i++) {
	$k = $i + 1;
?>
									<td class="tdrow">
<?
	if($bonus_p[$i]) {
?>
										<input name="tax_so_<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$tax_so[$i]?>" maxlength="10" onkeyup="checkThousand(this.value, this,'Y')"> ��
<?
	}
?>
									</td>
<?
}
?>
								</tr>
								<tr>
									<td class="tdrowk">�ֹμ�<font color="red"></font></td>
<?
for($i=0;$i<6;$i++) {
	$k = $i + 1;
?>
									<td class="tdrow">
<?
	if($bonus_p[$i]) {
?>
										<input name="tax_ju_<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$tax_ju[$i]?>" maxlength="10" onkeyup="checkThousand(this.value, this,'Y')"> ��
<?
	}
?>
									</td>
<?
}
?>
								</tr>
								<tr>
									<td class="tdrowk">��Ÿ����<font color="red"></font></td>
<?
for($i=0;$i<6;$i++) {
	$k = $i + 1;
?>
									<td class="tdrow">
<?
	if($bonus_p[$i]) {
?>
										<input name="minus_<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$minus[$i]?>" maxlength="10" onkeyup="checkThousand_minus(this.value, this,'Y')"> ��<input type="checkbox" name="minus_negative_<?=$k?>" value="1" <? if($minus_negative[$i] == 1) echo "checked"; ?> style="vertical-align:middle">��
<?
	}
?>
									</td>
<?
}
?>
								</tr>
								<tr>
									<td class="tdrowk">�����޾�<font color="red"></font></td>
<?
$count = 0;
for($i=0;$i<6;$i++) {
	$k = $i + 1;
?>
									<td class="tdrow">
<?
	if($bonus_p[$i]) {
		$count++;
?>
										<input name="bonus_total_<?=$k?>" type="text" class="textfm5" readolny style="width:70px;ime-mode:disabled;" value="<?=$bonus_total[$i]?>" maxlength="10" onkeyup="checkThousand(this.value, this,'Y')"> ��
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:bonus_total_result(<?=$k?>);" target="">���</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
<?
	}
?>
									</td>
<?
}
?>
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
													�󿩱� �޸�
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
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
<?
for($i=0;$i<6;$i++) {
	$k = $i + 1;
	if($bonus_p[$i]) {
?>
								<tr>
									<td nowrap class="tdrowk" width="15%"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0"><?=$bonus_time[$i]?></td>
									<td nowrap  class="tdrow">
										<input type="text" name="memo_<?=$k?>" class="textfm" style="width:760px;" value="<?=$memo[$i]?>" maxlength="" />
									</td>
								</tr>
<?
	}
}
?>
							</table>
							<input type="hidden" name="count" value="<?=$count?>">

<?
//���Ѻ� ��ũ��
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
	$url_del = "javascript:alert_demo();";
	$url_form = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checkData();";
	$url_del = "javascript:del($page,$idx);";
	$url_form = "form_inspect.php?labor=bonus_pay_ledger_sabun&sabun=".$id;
}
?>

							<div style="height:10px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_save?>" target=""><img src="images/btn_save_big.png" border="0"></a>
										<a href="./bonus.php?page=<?=$page?>&stx_bonus_time=<?=$stx_bonus_time?>" target=""><img src="images/btn_list_big.png" border="0"></a>
										<a href="<?=$url_form?>" target=""><img src="images/btn_bonus03_big.png" border="0"></a>
									</td>
								</tr>
							</table>
							<div style="height:20px;font-size:0px"></div>
							</form>
							<!--��޴� -->
							<!-- �Է��� -->

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
