<?
//$sub_menu = "1900100";
$sub_menu = "200700";
/*
//W3C Markup �˻� ���� �α��� ����
$member['mb_id'] = "kcmc2006";
$g4_path = ".."; // common.php �� ��� ���
include_once("$g4_path/common_erp.php");
set_session('erp_mb_id', $mb['mb_id']);
$member['mb_name'] = "�̿���";
*/
//���� ���� �ε�
include_once("./_common.php");
$sql_common = " from job_time a ";
//�α��� ���� code
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
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

$top_sub_title = "images/top19_01.gif";
$sub_title = "���â��";
//$g4['title'] = $sub_title." : ����о� : ".$easynomu_name;
$g4['title'] = $sub_title." : ������ : ".$easynomu_name;

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
	$sql_opt = " select * from job_time_opt where id='$id' ";
	//echo $sql1;
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
}
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_upjong=".$stx_upjong."&stx_boss_name=".$stx_boss_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_comp_juso=".$stx_comp_juso."&stx_man_cust_name=".$stx_man_cust_name;
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
function new_client_register() {
	var frm = document.dataForm;
	if(frm.comp_bznb.value == "") {
		alert("����ڵ�Ϲ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
	if(frm.rst_chk.value == "y") {
		alert("�̹� ��ϵ� ����ڹ�ȣ�Դϴ�. Ȯ�� �� ��� �ٶ��ϴ�.");
		frm.comp_bznb.focus();
		return;
	}
	getId('btn_new_client_register').style.display = "none";
	frm.action = "job_time_client_register.php";
	frm.submit();
	return;
}
function checkData() {
	var frm = document.dataForm;
	var rv = 0;
	if (frm.manage_cust_name.value == "")
	{
		alert("����ڸ� �Է��ϼ���.");
		frm.manage_cust_name.focus();
		return;
	}
	if (frm.com_name.value == "")
	{
		alert("��ȣ�� �Է��ϼ���.");
		frm.com_name.focus();
		return;
	}
	if (frm.regdt.value == "")
	{
		alert("������ڸ� �Է��ϼ���.");
		frm.regdt.focus();
		return;
	}
	if (frm.boss_name.value == "")
	{
		alert("��ǥ�ڸ��� �Է��ϼ���.");
		frm.boss_name.focus();
		return;
	}
	if(frm.rst_chk.value == "y") {
		alert("�̹� ��ϵ� ����ڹ�ȣ�Դϴ�. Ȯ�� �� ��� �ٶ��ϴ�.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.upjong.value == "")
	{
		alert("������ �Է��ϼ���.");
		frm.upjong.focus();
		return;
	}
	if (frm.com_tel1.value == "")
	{
		alert("��ȭ��ȣ�� �Է��ϼ���.");
		frm.com_tel1.focus();
		return;
	}
	if (frm.com_tel2.value == "")
	{
		alert("��ȭ��ȣ�� �Է��ϼ���.");
		frm.com_tel2.focus();
		return;
	}
	if (frm.com_tel3.value == "")
	{
		alert("��ȭ��ȣ�� �Է��ϼ���.");
		frm.com_tel3.focus();
		return;
	}
/*
	if (frm.cust_cel1.value == "")
	{
		alert("�ڵ����� �Է��ϼ���.");
		frm.cust_cel1.focus();
		return;
	}
	if (frm.cust_cel2.value == "")
	{
		alert("�ڵ����� �Է��ϼ���.");
		frm.cust_cel2.focus();
		return;
	}
	if (frm.cust_cel3.value == "")
	{
		alert("�ڵ����� �Է��ϼ���.");
		frm.cust_cel3.focus();
		return;
	}
*/
	if(frm.adr_zip1.value == "") {
		alert("�ּҸ� �Է��ϼ���.");
		return;
	}
	if(frm.visitdt.value == "") {
		alert("�湮�������ڸ� �Է��ϼ���.");
		frm.visitdt.focus();
		return;
	}
/*
	if(frm.job_placement.value == "") {
		alert("����ó�� �Է��ϼ���.");
		frm.job_placement.focus();
		return;
	}
	if(frm.type_occupation.value == "") {
		alert("������ �Է��ϼ���.");
		frm.type_occupation.focus();
		return;
	}
	if(frm.charge_job.value == "") {
		alert("�������� �Է��ϼ���.");
		frm.charge_job.focus();
		return;
	}
	if(frm.worktime.value == "") {
		alert("�ٹ��ð��� �Է��ϼ���.");
		frm.worktime.focus();
		return;
	}
	if(frm.workday_week.value == "") {
		alert("�ٹ������� �Է��ϼ���.");
		frm.workday_week.focus();
		return;
	}
	if(frm.recruit_personnel.value == "") {
		alert("�����ο��� �Է��ϼ���.");
		frm.recruit_personnel.focus();
		return;
	}
*/
	frm.action = "job_time_update.php";
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
//����ڵ�Ϲ�ȣ �ߺ� Ȯ��
function getCont( id, code ) {
	var frm = document.dataForm;
	//alert(id);
	var xmlhttp = fncGetXMLHttpRequest();
	// ���̵� üũ�� php �������� üũ �Ϸ��ϴ� id ���� �Ķ���ͷ� �Ѱ� �ݴϴ�.
	xmlhttp.open('POST', 'ajax_check_bizno_confirm.php?id='+id+'&code='+code, false);
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=euc-kr');
	xmlhttp.onreadystatechange = function () {
		//alert(xmlhttp.readyState);
		//alert(xmlhttp.status);
		if(xmlhttp.readyState=='4' && xmlhttp.status==200) {
			if(xmlhttp.status==500 || xmlhttp.status==404 || xmlhttp.status==403)	alert("������ ���� : "+xmlhttp.status);
			else {
				var dp  = document.getElementById('rst');
				//alert(xmlhttp.responseText);
				if(xmlhttp.responseText=='Y') {
					dp.innerHTML = "�̹� ��ϵ� ������Դϴ�.<br />(���繮�ǿ��)";
					frm.rst_chk.value = "y";
				} else {
					dp.innerHTML = "";
					frm.rst_chk.value = "";
				}
			}
		}
	}
	xmlhttp.send();
}
//Ajax �Լ�
function fncGetXMLHttpRequest() {
	if(window.ActiveXObject) {
		try {
			return new ActiveXObject("Msxml2.XMLHTTP");
		}	catch(e) {
			try {
				return new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e1) {
				return null;
			}
		}
		//IE �� ���̾����� ����� ���� ���������� XMLHttpRequest ��ü ���ϱ�
	} else if(window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else {
		return null;
	}
}
//]]>
</script>
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
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
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
				if ( type =='1' ) {
					main.comp_bznb.value=total;					// type �� ���� �������� �־� �ش�.
				}
				else if ( type =='2' ) {
					main.user_id.value=total;					// type �� ���� �������� �־� �ش�.
				}
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
		//�齺���̽�Ű ����
		if(event.keyCode != 8) {
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
					main.jumin_no.value=total;					// type �� ���� �������� �־� �ش�.
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
//iframe resize
function resizeFrame(frm) {
 frm.style.height = "auto";
 contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
 frm.style.height = contentHeight + 0 + "px";
}
//]]>
</script>
<script type="text/javascript" src="https://spi.maps.daum.net/imap/map_js_init/postcode.js"></script>
<script type="text/javascript">
//<![CDATA[
function openDaumPostcode(zip1,zip2,addr1,addr2) {
	new daum.Postcode({
			oncomplete: function(data) {
					frm = document.dataForm;
					frm[zip1].value = data.postcode1;
					frm[zip2].value = data.postcode2;
					frm[addr1].value = data.address;
					frm[addr2].focus();
			}
	}).open();
}
//���
function pagePrint(Obj, orientation_var) {  
  var W = 920;        //screen.availWidth;  
  var H = 600;       //screen.availHeight; 
 
  var features = "menubar=no,toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=yes,width=" + W + ",height=" + H + ",left=0,top=0";  
  var PrintPage = window.open("about:blank",Obj.id,features);  
 
	var iepage_script = "<style type='text/css'>\n@media print{ \n#noPrint1{display: none;} \n} \n</style> \n<script language='javascript' type='text/javascript'> \nfunction Installed() \n{ \ntry \n{ \nreturn (new ActiveXObject('IEPageSetupX.IEPageSetup')); \n} \ncatch (e) \n{ \nreturn false; \n} \n} \nfunction PrintTest() \n{ \nif (!Installed()) \nalert('��Ʈ���� ��ġ���� �ʾҽ��ϴ�. ���������� �μ���� ���� �� �ֽ��ϴ�.') \nelse \nalert('���������� ��ġ�Ǿ����ϴ�.'); \n} \nfunction printsetup()\n{ \nIEPageSetupX.header = '';\nIEPageSetupX.footer = '';\nIEPageSetupX.leftMargin = 10;\nIEPageSetupX.rightMargin = 10;\nIEPageSetupX.topMargin = 20;\nIEPageSetupX.bottomMargin = 10;\nIEPageSetupX.PrintBackground = true;\nIEPageSetupX.Orientation = 0;\nIEPageSetupX.PaperSize = 'A4';\n</sc"+"ript>";
	var iepage_object = "<script language='JavaScript' for='IEPageSetupX' event='OnError(ErrCode, ErrMsg)'>\nalert('���� �ڵ�: ' + ErrCode + '\n���� �޽���: ' + ErrMsg);\n</sc"+"ript>\n<object id=IEPageSetupX classid='clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586' codebase='/IEPageSetupX/IEPageSetupX.cab#version=1,4,0,3' width=0 height=0>\n<param name='copyright' value='http://isulnara.com'>\n<div style='position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;'><FONT style='font-family: '����', 'Verdana'; font-size: 9pt; font-style: normal;'>\n<BR>  �μ� �������� ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.  <BR>  <a href='/IEPageSetupX/IEPageSetupX.exe'><font color=red>�̰�</font></a>�� Ŭ���Ͽ� �������� ��ġ�Ͻñ� �ٶ��ϴ�.  </FONT>\n</div>\n</object>";

  PrintPage.document.open();  
  PrintPage.document.write("<html><head><title></title><link rel='stylesheet' type='text/css' href='css/style.css'>\n<link rel='stylesheet' type='text/css' href='css/style_admin.css'>\n</head>\n<body style='margin:0'>\n<div style='text-align:center;'>\n"+iepage_script+"\n"+iepage_object+"\n<div style='width:1004px;margin:0 auto;'>\n" + Obj.innerHTML + "\n</div>\n</div>\n</body></html>");
  PrintPage.document.close();  
  PrintPage.document.title = document.domain;
	// �������
	PrintPage.IEPageSetupX.Orientation = orientation_var;
	PrintPage.IEPageSetupX.PrintBackground = true;
	PrintPage.IEPageSetupX.ShrinkToFit = true;
	// �μ�̸�����
	PrintPage.IEPageSetupX.Preview();
}
function Installed() {
	try 
	{ 
		return (new ActiveXObject('IEPageSetupX.IEPageSetup')); 
	} 
	catch (e) 
	{ 
		return false; 
	} 
} 
function PrintTest() {
	if (!Installed()) 
		alert("��Ʈ���� ��ġ���� �ʾҽ��ϴ�. ���������� �μ���� ���� �� �ֽ��ϴ�.") 
	else 
		alert("���������� ��ġ�Ǿ����ϴ�."); 
}
function printsetup() {
	IEPageSetupX.header = ""; // ������� 
	IEPageSetupX.footer = ""; // Ǫ�ͼ��� 
	IEPageSetupX.leftMargin = 10; // ���ʿ��鼳�� 
	IEPageSetupX.rightMargin = 10; // �����ʿ��� ���� 
	IEPageSetupX.topMargin = 20; // ���ʿ��� ���� 
	IEPageSetupX.bottomMargin = 10; // �Ʒ��� ���鼳�� 
	IEPageSetupX.PrintBackground = true; // ���� �� �̹��� �μ� 
	IEPageSetupX.Orientation = 1; // ���� ����� ���Ͻø� 0�� ������ �˴ϴ�. ��������� 1�Դϴ�. 
	IEPageSetupX.PaperSize = 'A4'; // ���������Դϴ�. 
}
//]]>
</script>
<?
include "inc/top.php";
//���Ѻ� ��ũ�� : ��ü ����
if($member['mb_level'] == 0) {
	$url_save = "javascript:alert_no_right();";
} else {
	$url_save = "javascript:checkData();";
}
$url_print = "javascript:pagePrint(document.getElementById('print_page'), '0')";
$url_list = "./job_time_list.php?page=".$page."&".$qstr;
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<!--<td width="100"><img src="images/top19.gif" border="0" alt="����о�" /></td>-->
						<td width="100"><img src="images/top02.gif" border="0" alt="������" /></td>
						<td><a href="<?=$url_list?>"><img src="<?=$top_sub_title?>" border="0" alt="�ð�������" /></a></td>
						<td></td>
					</tr>
					<tr><td colspan="3" style="background:#cccccc;height:1px;"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0;">
							<!--���������-->	
							<div id="print_page" style="display:none">
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
										<td class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�����</td>
										<td class="tdrow" width="170">
<?
$writer_name = $row['writer_name'];
echo $writer_name;
echo "(".$row['writer'].")";
?>
										</td>
										<td class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />������</td>
										<td class="tdrow" width="210">
											<?=$row['com_name']?>
										</td>
										<td class="tdrowk" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�������<font color="red"></font></td>
										<td class="tdrow" width="">
<?
if($row['upche_div'] == "1") {
	$chk_comp_type1 = "checked";
	$comp_type_text = "����";
} else if($row[upche_div] == "2") {
	$chk_comp_type2 = "checked";
	$comp_type_text = "����";
} else if($row[upche_div] == "3") {
	$chk_comp_type3 = "checked";
	$comp_type_text = "����";
}
echo $comp_type_text;
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�������</td>
										<td class="tdrow" width="">
											<?=$row['regdt']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />��ǥ�ڸ�</td>
										<td class="tdrow">
											<?=$row['boss_name']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����ڵ�Ϲ�ȣ</td>
										<td class="tdrow">
											<?=$row['comp_bznb']?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����</td>
										<td class="tdrow">
											<?=$row['upjong']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />��ȭ��ȣ</td>
										<td class="tdrow">
<?
echo $row['com_tel'];
?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�ڵ���<font color="red"></font></td>
										<td class="tdrow">
<?
echo $row['com_hp'];
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" rowspan="2"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�ּ�</td>
										<td class="tdrow"  rowspan="2" colspan="3">
<?
echo $row['com_postno'];
?>
<br />
<?=$row['com_juso']?>
<br />
<?=$row['com_juso2']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���谡���ο�</td>
										<td class="tdrow">
											<?=$row['insurance_persons']?>
											��
											<?=$row['insurance_persons_over']?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�湮��������</td>
										<td class="tdrow" width="160">
											<?=$row['visitdt']?>
<?
$visitdt_time = $row['visitdt_time'];
echo $visitdt_time;
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����ó</td>
										<td class="tdrow">
											<?=$row_opt['job_placement']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����</td>
										<td class="tdrow">
											<?=$row_opt['type_occupation']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />������</td>
										<td class="tdrow">
											<?=$row_opt['charge_job']?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�ٹ��ð�</td>
										<td class="tdrow">
											<?=$row_opt['worktime']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�ٹ�����</td>
										<td class="tdrow">
											<?=$row_opt['workday_week']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�����ο�</td>
										<td class="tdrow">
											<?=$row_opt['recruit_personnel']?>
											��
											����:
<?
$distinction_sex = $row_opt['distinction_sex'];
echo $distinction_sex;
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���޸�</td>
										<td class="tdrow" colspan="5">
<?
if($row['memo']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['memo']."</pre>";
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/g_tab_on_bg.gif')"> 
														ó����Ȳ
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />ó����Ȳ<font color="red"></font></td>
										<td class="tdrow" width="160">
<?
//ó����Ȳ
$check_ok_id = $row_opt['check_ok'];
echo $job_time_process_arry[$check_ok_id];
?>
										</td>
										<td class="tdrowk" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />������û��</td>
										<td class="tdrow" width="140">
											<?=$row_opt['joindt']?>
										</td>
										<td class="tdrowk" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���οϷ���</td>
										<td class="tdrow" width="140">
											<?=$row_opt['approval']?>
										</td>
										<td class="tdrowk" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />������</td>
										<td class="tdrow">
<?
if($row['damdang_code']) {
	$damdang_code = $row['damdang_code'];
} else {
	$damdang_code = $stx_man_cust_name;
}
echo $man_cust_name_arry[$damdang_code];
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���������</td>
										<td class="tdrow">
<?
$etc_user = $row_opt['etc_user'];
echo $etc_user;
?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���������Ͻ�</td>
										<td class="tdrow" colspan="5">
<?
$editdt = $row_opt['editdt'];
echo $editdt;
?>
										</td>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />ó�����</td>
										<td class="tdrow" colspan="7">
<?
if($row_opt['etc']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row_opt['etc']."</pre>";
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/g_tab_on_bg.gif')"> 
														��㳻��
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
									<tr>
										<td class="tdrowk" width="96"><div style="float:left;padding:5px 0 0 5px;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /></div><div style="float:left;">ä�� ����</div></td>
										<td class="tdrow" width="380">
											<div style="height:50px;"></div>
										</td>
										<td class="tdrowk" width="96"><div style="float:left;padding:5px 0 0 5px;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /></div><div style="float:left;">���ü<br />��ð�</div></td>
										<td class="tdrow">
											<div style="height:50px;"></div>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><div style="float:left;padding:5px 0 0 5px;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /></div><div style="float:left;">���� �ٷ���<br />�ٷνð�</div></td>
										<td class="tdrow">
											<div style="height:50px;"></div>
										</td>
										<td class="tdrowk"><div style="float:left;padding:5px 0 0 5px;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /></div><div style="float:left;">���� �ٷ���<br />�޿�</div></td>
										<td class="tdrow">
											<div style="height:50px;"></div>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><div style="float:left;padding:5px 0 0 5px;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /></div><div style="float:left;">�ű� ä����<br />�ٷνð�</div></td>
										<td class="tdrow">
											<div style="height:50px;"></div>
										</td>
										<td class="tdrowk"><div style="float:left;padding:5px 0 0 5px;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /></div><div style="float:left;">�ű� ä����<br />�޿�</div></td>
										<td class="tdrow">
											<div style="height:50px;"></div>
										</td>
									</tr>
								</table>
							</div><!--��� ����-->

							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA" action="job_time_update.php">
								<input type="hidden" name="w" value="<?=$w?>" />
								<input type="hidden" name="com_code" value="<?=$row['com_code']?>" />
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
										<td class="tdrow" width="170">
<?
$damdang_code_no = $damdang_code;
if(!$w) {
	$sql_manage = " select * from a4_manage where item='manage' and state='1' and user_id='$member[mb_id]' ";
	//echo $sql_manage;
	$result_manage = sql_query($sql_manage);
	$row_manage = mysql_fetch_array($result_manage);
	$row['writer'] = $row_manage['code'];
	$row['writer_name'] = $row_manage['name'];
}
?>
											<div style="float:left;"><input type="text" name="manage_cust_numb" class="textfm" style="width:34px" readonly value="<?=$row['writer']?>" /></div>
											<div style="float:left;"><input type="text" name="manage_cust_name" class="textfm" style="width:82px" readonly value="<?=$row['writer_name']?>" /></div>
											<div style="float:left;"><table border="0" cellpadding="0" cellspacing="0" style=""><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white nowrap"><a href="javascript:findNomu(<?=$damdang_code_no?>,1);" target="">�˻�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table></div>
										</td>
										<td class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />������<font color="red">*</font></td>
										<td class="tdrow" width="210">
											<input name="com_name" type="text" class="textfm" style="width:97%;ime-mode:active;" value="<?=$row['com_name']?>" maxlength="50" />
										</td>
										<td class="tdrowk" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�������<font color="red"></font></td>
										<td class="tdrow" width="">
<?
if($row['upche_div'] == "1") {
	$chk_comp_type1 = "checked";
	$comp_type_text = "����";
} else if($row[upche_div] == "2") {
	$chk_comp_type2 = "checked";
	$comp_type_text = "����";
} else if($row[upche_div] == "3") {
	$chk_comp_type3 = "checked";
	$comp_type_text = "����";
}
?>
											<input type="radio" name="comp_type" value="1" <?=$chk_comp_type1?> />����
											<input type="radio" name="comp_type" value="2" <?=$chk_comp_type2?> />����
											<input type="radio" name="comp_type" value="3" <?=$chk_comp_type3?> />����
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�������<font color="red">*</font></td>
										<td class="tdrow" width="">
											<div style="float:left;"><input name="regdt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['regdt']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" /></div>
											<div style="float:left;"><table border="0" cellpadding="0" cellspacing="0"><tr><td width='2'></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td class="ftbutton3_white" style="background:url('./images/btn2_bg.gif');"><a href="javascript:loadCalendar(document.dataForm.regdt);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table></div>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />��ǥ�ڸ�<font color="red">*</font></td>
										<td class="tdrow">
											<input name="boss_name" type="text" class="textfm" style="width:150px;ime-mode:active;" value="<?=$row['boss_name']?>" maxlength="25" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����ڵ�Ϲ�ȣ</td>
										<td class="tdrow">
											<input name="comp_bznb" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['comp_bznb']?>" maxlength="12"  onkeypress="only_number_hyphen()" onkeyup="checkhyphen(this.value, '1','Y')" onblur="getCont(this.value, '<?=$row['com_code']?>');" />
											<div id='rst' style="color:red;"></div>
											<input type="hidden" name="rst_chk" value="" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����<font color="red">*</font></td>
										<td class="tdrow">
											<input name="upjong" type="text" class="textfm" style="width:97%;" value="<?=$row['upjong']?>" maxlength="12" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />��ȭ��ȣ<font color="red">*</font></td>
										<td class="tdrow">
<?
$com_tel = explode("-",$row['com_tel']);
$com_tel1 = $com_tel[0];
$sel_cust_tel1 = array();
$sel_cust_tel1[$com_tel1] = "selected";
$com_tel2 = $com_tel[1];
$com_tel3 = $com_tel[2];
?>
											<select name="com_tel1" class="selectfm">
												<option value="">����</option>
												<option value="02"  <?=$sel_cust_tel1['02']?> >02</option>
												<option value="031" <?=$sel_cust_tel1['031']?>>031</option>
												<option value="032" <?=$sel_cust_tel1['032']?>>032</option>
												<option value="033" <?=$sel_cust_tel1['033']?>>033</option>
												<option value="041" <?=$sel_cust_tel1['041']?>>041</option>
												<option value="042" <?=$sel_cust_tel1['042']?>>042</option>
												<option value="043" <?=$sel_cust_tel1['043']?>>043</option>
												<option value="044" <?=$sel_cust_tel1['044']?>>044</option>
												<option value="051" <?=$sel_cust_tel1['051']?>>051</option>
												<option value="052" <?=$sel_cust_tel1['052']?>>052</option>
												<option value="053" <?=$sel_cust_tel1['053']?>>053</option>
												<option value="054" <?=$sel_cust_tel1['054']?>>054</option>
												<option value="055" <?=$sel_cust_tel1['055']?>>055</option>
												<option value="061" <?=$sel_cust_tel1['061']?>>061</option>
												<option value="062" <?=$sel_cust_tel1['062']?>>062</option>
												<option value="063" <?=$sel_cust_tel1['063']?>>063</option>
												<option value="064" <?=$sel_cust_tel1['064']?>>064</option>
												<option value="070" <?=$sel_cust_tel1['070']?>>070</option>
												<option value="000" <?=$sel_cust_tel1['000']?>>��ĭ</option>
												<option value="010" <?=$sel_cust_tel1['010']?>>010</option>
												<option value="011" <?=$sel_cust_tel1['011']?>>011</option>
												<option value="016" <?=$sel_cust_tel1['016']?>>016</option>
												<option value="017" <?=$sel_cust_tel1['017']?>>017</option>
												<option value="018" <?=$sel_cust_tel1['018']?>>018</option>
												<option value="019" <?=$sel_cust_tel1['019']?>>019</option>
											</select>
											-
											<input name="com_tel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_tel2?>" maxlength="4" onkeypress="onlyNumber();" />
											-
											<input name="com_tel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_tel3?>" maxlength="4" onkeypress="onlyNumber();" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�޴���ȭ<font color="red"></font></td>
										<td class="tdrow">
<?
$cust_cel = explode("-",$row['com_hp']);
$cust_cel1 = $cust_cel[0];
//echo $cust_cel1;
$sel_cust_cel1 = array();
$sel_cust_cel1[$cust_cel1] = "selected";
//echo $sel_cust_cel1[$cust_cel1];
$cust_cel2 = $cust_cel[1];
$cust_cel3 = $cust_cel[2];
?>
											<select name="cust_cel1" class="selectfm">
												<option value="">����</option>
												<option value="010" <?=$sel_cust_cel1['010']?>>010</option>
												<option value="011" <?=$sel_cust_cel1['011']?>>011</option>
												<option value="016" <?=$sel_cust_cel1['016']?>>016</option>
												<option value="017" <?=$sel_cust_cel1['017']?>>017</option>
												<option value="018" <?=$sel_cust_cel1['018']?>>018</option>
												<option value="019" <?=$sel_cust_cel1['019']?>>019</option>
												<option value="070" <?=$sel_cust_cel1['070']?>>070</option>
											</select>
											-
											<input name="cust_cel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$cust_cel2?>" maxlength="4" onkeypress="onlyNumber();" />
											-
											<input name="cust_cel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$cust_cel3?>" maxlength="4" onkeypress="onlyNumber();" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk" rowspan="3"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�ּ�<font color="red">*</font></td>
										<td class="tdrow"  rowspan="3" colspan="3">
<?
$adr_zip = explode("-",$row['com_postno']);
?>
											<div style="float:left;">
												<input name="adr_zip1" type="text" class="textfm" style="width:30px;" value="<?=$adr_zip[0]?>" />
												-
												<input name="adr_zip2" type="text" class="textfm" style="width:30px;" value="<?=$adr_zip[1]?>" />
											</div>
											<div style="float:left;margin-left:5px;"><table border="0" cellspacing="0" cellpadding="0"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif');" class="ftbutton3_white"><a href="javascript:openDaumPostcode('adr_zip1','adr_zip2','adr_adr1','adr_adr2');">�ּ�ã��</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td><td width="2"></td></tr></table></div>
											<div style="clear:both;height:4px;font-size:0px"></div>
											<input name="adr_adr1" type="text" class="textfm" style="width:450px;" value="<?=$row['com_juso']?>" />
											<div style="height:4px;font-size:0px"></div>
											<input name="adr_adr2" type="text" class="textfm" style="width:450px;" value="<?=$row['com_juso2']?>" maxlength="150" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�ѽ���ȣ<font color="red"></font></td>
										<td class="tdrow">
<?
$com_fax = explode("-",$row['com_fax']);
$com_fax1 = $com_fax[0];
$sel_cust_fax1 = array();
$sel_cust_fax1[$com_fax1] = "selected";
$com_fax2 = $com_fax[1];
$com_fax3 = $com_fax[2];
?>
											<select name="cust_fax1" class="selectfm">
												<option value="">����</option>
												<option value="02"  <?=$sel_cust_fax1['02']?> >02</option>
												<option value="031" <?=$sel_cust_fax1['031']?>>031</option>
												<option value="032" <?=$sel_cust_fax1['032']?>>032</option>
												<option value="033" <?=$sel_cust_fax1['033']?>>033</option>
												<option value="041" <?=$sel_cust_fax1['041']?>>041</option>
												<option value="042" <?=$sel_cust_fax1['042']?>>042</option>
												<option value="043" <?=$sel_cust_fax1['043']?>>043</option>
												<option value="044" <?=$sel_cust_fax1['044']?>>044</option>
												<option value="051" <?=$sel_cust_fax1['051']?>>051</option>
												<option value="052" <?=$sel_cust_fax1['052']?>>052</option>
												<option value="053" <?=$sel_cust_fax1['053']?>>053</option>
												<option value="054" <?=$sel_cust_fax1['054']?>>054</option>
												<option value="055" <?=$sel_cust_fax1['055']?>>055</option>
												<option value="061" <?=$sel_cust_fax1['061']?>>061</option>
												<option value="062" <?=$sel_cust_fax1['062']?>>062</option>
												<option value="063" <?=$sel_cust_fax1['063']?>>063</option>
												<option value="064" <?=$sel_cust_fax1['064']?>>064</option>
												<option value="070" <?=$sel_cust_fax1['070']?>>070</option>
												<option value="0303" <?=$sel_cust_fax1['0303']?>>0303</option>
												<option value="0502" <?=$sel_cust_fax1['0502']?>>0502</option>
												<option value="0505" <?=$sel_cust_fax1['0505']?>>0505</option>
												<option value="0507" <?=$sel_cust_fax1['0507']?>>0507</option>
											</select>
											-
											<input name="cust_fax2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_fax2?>" maxlength="4" onKeyPress="onlyNumber();">
											-
											<input name="cust_fax3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_fax3?>" maxlength="4" onKeyPress="onlyNumber();">
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���谡���ο�</td>
										<td class="tdrow">
											<input name="insurance_persons" type="text" class="textfm" style="width:24px;ime-mode:disabled;" value="<?=$row['insurance_persons']?>" maxlength="20" onkeypress="onlyNumber();" />
											��
<?
$insurance_persons_over = $row['insurance_persons_over'];
$sel_insurance_persons_over = array();
$sel_insurance_persons_over[$insurance_persons_over] = "selected";
?>
											<select name="insurance_persons_over" class="selectfm">
												<option value="">����</option>
												<option value="�̻�" <?=$sel_insurance_persons_over['�̻�']?>>�̻�</option>
												<option value="����" <?=$sel_insurance_persons_over['����']?>>����</option>
											</select>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�湮��������<font color="red">*</font></td>
										<td class="tdrow" width="160">
											<div style="float:left;"><input name="visitdt" type="text" class="textfm" style="width:78px;ime-mode:disabled;" value="<?=$row['visitdt']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" /></div>
											<div style="float:left;"><table border="0" cellspacing="0" cellpadding="0"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.visitdt);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table></div>
<?
$visitdt_time = $row['visitdt_time'];
$sel_visitdt_time = array();
$sel_visitdt_time[$visitdt_time] = "selected";
?>
											<div style="float:left;">
												<select name="visitdt_time" class="selectfm">
													<option value="">����</option>
													<option value="����" <?=$sel_visitdt_time['����']?>>����</option>
													<option value="����" <?=$sel_visitdt_time['����']?>>����</option>
												</select>
											<input type="checkbox" name="visitdt_ok" <? if($row['visitdt_ok']) echo "checked"; ?> value="1" onclick="" style="vertical-align:middle;" />�Ϸ�
											</div>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����ó<font color="red"></font></td>
										<td class="tdrow">
											<input name="job_placement" type="text" class="textfm" style="width:150px;ime-mode:active;" value="<?=$row_opt['job_placement']?>" maxlength="25" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����<font color="red"></font></td>
										<td class="tdrow">
											<input name="type_occupation" type="text" class="textfm" style="width:150px;ime-mode:active;" value="<?=$row_opt['type_occupation']?>" maxlength="25" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />������<font color="red"></font></td>
										<td class="tdrow">
											<input name="charge_job" type="text" class="textfm" style="width:150px;ime-mode:active;" value="<?=$row_opt['charge_job']?>" maxlength="25" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�ٹ��ð�<font color="red"></font></td>
										<td class="tdrow">
											<input name="worktime" type="text" class="textfm" style="width:150px;ime-mode:active;" value="<?=$row_opt['worktime']?>" maxlength="25" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�ٹ�����<font color="red"></font></td>
										<td class="tdrow">
											<input name="workday_week" type="text" class="textfm" style="width:150px;ime-mode:active;" value="<?=$row_opt['workday_week']?>" maxlength="25" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�����ο�<font color="red"></font></td>
										<td class="tdrow">
											<input name="recruit_personnel" type="text" class="textfm" style="width:30px;ime-mode:disabled;" value="<?=$row_opt['recruit_personnel']?>" maxlength="20" onkeypress="onlyNumber();" />
											��
<?
$distinction_sex = $row_opt['distinction_sex'];
$sel_distinction_sex = array();
$sel_distinction_sex[$distinction_sex] = "selected";
?>
											����
											<select name="distinction_sex" class="selectfm">
												<option value="����">����</option>
												<option value="����" <?=$sel_distinction_sex['����']?>>����</option>
												<option value="����" <?=$sel_distinction_sex['����']?>>����</option>
											</select>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���޸�</td>
										<td class="tdrow" colspan="5">
											<textarea name="memo" class="textfm" style='width:99%;height:112px;word-break:break-all;' rows="7" cols=""><?=$row[memo]?></textarea>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
							<!--�Ǹ޴� -->
<?
//�ŷ�ó ���� ��� ����
if($row['com_code']) {
	$com_code = $row['com_code'];
	//���� �� �޴� ��ȣ
	$tab_onoff_this = 11;
	//�ŷ�ó �⺻ ���� DB
	$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
	$result_com_opt = sql_query($sql_com_opt);
	$row_com_opt=mysql_fetch_array($result_com_opt);
	//���α׷� ����
	if($row_com_opt['easynomu_yn'] == 1) {
		$tab_program_url = 1;
	} else if($row_com_opt['easynomu_yn'] == 2) {
		$tab_program_url = 2;
	} else {
		$tab_program_url = 1;
		if($row_com_opt['construction_yn'] == 1) $tab_program_url = 3;
	}
	include "inc/tab_menu.php";
	//���� ����Ʈ �� ���
	$report = "ok";
}
//���� ��� ����
$is_damdang = "ok";
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
<?
if($is_damdang == "ok") {
?>
											<div style="margin:4px 0 0 0">
												<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /><a href="javascript:field_add('file_tr');"><img src="images/btn_add.png" border="0" style="vertical-align:middle" alt="+" /> <span  style="">�߰�</span></a>
											</div>
<?
}
?>
										</td>
										<td   class="tdrow" width="320">
											<? if($is_damdang == "ok") { ?><input name="filename_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/job_time/<?=$row_opt['filename_1']?>" target="_blank"><?=$row_opt['filename_1']?></a>
											<input type="hidden" name="file_1" value="<?=$row_opt['filename_1']?>" />
										</td>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_2" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/job_time/<?=$row_opt['filename_2']?>" target="_blank"><?=$row_opt['filename_2']?></a>
											<input type="hidden" name="file_2" value="<?=$row_opt['filename_2']?>" />
										</td>
									</tr>
									<tr id="file_tr2" style="<? if(!$row_opt['filename_3'] && !$row_opt['filename_4']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����3 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_3" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/job_time/<?=$row_opt['filename_3']?>" target="_blank"><?=$row_opt['filename_3']?></a>
											<input type="hidden" name="file_3" value="<?=$row_opt['filename_3']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����4 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_4" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/job_time/<?=$row_opt['filename_4']?>" target="_blank"><?=$row_opt['filename_4']?></a>
											<input type="hidden" name="file_4" value="<?=$row_opt['filename_4']?>" />
										</td>
									</tr>
									<tr id="file_tr3" style="<? if(!$row_opt['filename_5'] && !$row_opt['filename_6']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����5 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_5" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/job_time/<?=$row_opt['filename_5']?>" target="_blank"><?=$row_opt['filename_5']?></a>
											<input type="hidden" name="file_5" value="<?=$row_opt['filename_5']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����6 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_6" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/job_time/<?=$row_opt['filename_6']?>" target="_blank"><?=$row_opt['filename_6']?></a>
											<input type="hidden" name="file_6" value="<?=$row_opt['filename_6']?>" />
										</td>
									</tr>
									<tr id="file_tr4" style="<? if(!$row_opt['filename_7'] && !$row_opt['filename_8']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����7 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_7" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_7" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<br/><a href="files/job_time/<?=$row_opt['filename_7']?>" target="_blank"><?=$row_opt['filename_7']?></a>
											<input type="hidden" name="file_7" value="<?=$row_opt['filename_7']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����8 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_8" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="filename_8" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<br/><a href="files/job_time/<?=$row_opt['filename_8']?>" target="_blank"><?=$row_opt['filename_8']?></a>
											<input type="hidden" name="file_8" value="<?=$row_opt['filename_8']?>" />
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<!--��޴� -->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/g_tab_on_bg.gif')"> 
														ó����Ȳ
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

								<!-- �Է��� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
									<tr>
										<td class="tdrowk" width="74"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />ó����Ȳ<font color="red"></font></td>
										<td class="tdrow" width="">
<?
$sel_check_ok = array();
$check_ok_id = $row_opt['check_ok'];
$sel_check_ok[$check_ok_id] = "selected";
?>
											<select name="check_ok" class="selectfm">
												<option value="">����</option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$job_time_process_arry[9]?></option>
												<option value="10" <?=$sel_check_ok['10']?>><?=$job_time_process_arry[10]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$job_time_process_arry[8]?></option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$job_time_process_arry[1]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$job_time_process_arry[2]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$job_time_process_arry[3]?></option>
												<option value="4" <?=$sel_check_ok['4']?>><?=$job_time_process_arry[4]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$job_time_process_arry[6]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$job_time_process_arry[7]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$job_time_process_arry[5]?></option>
											</select>
										</td>
										<td class="tdrowk" width="90"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�翬����</td>
										<td class="tdrow" width="128">
											<input name="recall" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row_opt['recall']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.recall);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
										</td>
										<td class="tdrowk" width="84"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />������û��</td>
										<td class="tdrow" width="126">
											<input name="joindt" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row_opt['joindt']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.joindt);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
										</td>
										<td class="tdrowk" width="84"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���οϷ���</td>
										<td class="tdrow" width="126">
											<input name="approval" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row_opt['approval']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.approval);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�����</td>
										<td class="tdrow">
											<input type="text" name="manager_code" class="textfm" style="width:34px;float:left;" readonly value="<?=$row['manager']?>">
											<input type="text" name="manager_name" class="textfm" style="width:66px;float:left;" readonly value="<?=$row['manager_name']?>">
											<table border="0" cellpadding="0" cellspacing="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white nowrap"><a href="javascript:findNomu(<?=$damdang_code_no?>,2);" target="">�˻�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���������Ͻ�</td>
										<td class="tdrow">
<?
$editdt = $row_opt['editdt'];
echo $editdt;
?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����������</td>
										<td class="tdrow">
											<strong>
<?
$etc_user = $row_opt['etc_user'];
echo $etc_user;
?>
											</strong>
										</td>
										<td class="tdrowk" width="90"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />������</td>
										<td class="tdrow">
<?
if($member['mb_level'] >= 7) {
?>
											<select name="damdang_code" class="selectfm">
<?
	for($i=1;$i<count($man_cust_name_arry)-$man_cust_name_arry_cnt_add;$i++) {
		if($row['damdang_code'] == $i) $sel_damdang_code[$i] = "selected";
		if(!$man_cust_name_arry[$i]) $man_cust_name_arry[$i] = $ban_cust_name_arry[$i];
?>
												<option value="<?=$i?>" <?=$sel_damdang_code[$i]?>><?=$man_cust_name_arry[$i]?></option>
<?
	}
?>
												<option value="101" <? if($damdang_code == 101) echo "selected"; ?>>���»�1</option>
												<option value="110" <? if($damdang_code == 110) echo "selected"; ?>>������</option>
											</select>
<?
} else {
	echo $man_cust_name_arry[$damdang_code];
	echo "<input type='hidden' name='damdang_code' value='".$damdang_code."' />";
}
?>
											<input type="hidden" name="damdang_code2" value="<?=$row['damdang_code2']?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />ó�����</td>
										<td class="tdrow" colspan="7">
											<textarea name="etc" class="textfm" style='width:99%;height:98px;word-break:break-all;' rows="7" cols=""><?=$row_opt['etc']?></textarea>
										</td>
									</tr>
								</table>

								<div style="height:20px;font-size:0px"></div>

								<table border="0" cellpadding="0" cellspacing="0" align="center">
									<tr>
										<td>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif" alt="" /></td><td class="ftbutton1" style="background:url('images/btn_bg.gif');" nowrap="nowrap"><a href="<?=$url_save?>">�� ��</a></td><td><img src="images/btn_rt.gif" alt="" /></td><td width="2"></td></tr></table>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_print?>" target="">�� ��</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif" alt="" /></td><td class="ftbutton1" style="background:url('images/btn_bg.gif');" nowrap="nowrap"><a href="<?=$url_list?>">�� ��</a></td><td><img src="images/btn_rt.gif" alt="" /></td><td width="2"></td></tr></table>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif" alt="" /></td><td class="ftbutton1" style="background:url('images/btn_bg.gif');" nowrap="nowrap"><a href="list_notice.php?bo_table=erp_schedule">������</a></td><td><img src="images/btn_rt.gif" alt="" /></td><td width="2"></td></tr></table>
<?
//�ŷ�ó ���� ��� ����
if($row['com_code']) {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_view.php?w=<?=$w?>&id=<?=$row['com_code']?>" target="">�ŷ�ó����</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
}
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
<?
//�ŷ�ó ���� ��� ���� : �̵�� �� �ŷ�ó ��� ��ư ǥ�� 150729
if($w == "u" && !$row['com_code']) {
?>
								<div style="height:30px;font-size:0px;text-align:center;margin-top:10px;" id="btn_new_client_register">
									<span onclick="new_client_register();" style="cursor:pointer;"><img src="images/btn_new_client_register.png" width="111" height="30" border="0" /></span>
								</div>
<?
}
//�ű� ��Ͻ� ����
if($w == "u") {
	//�ŷ�ó ��No
	$memo_type = 10;
	$job_id = $id;
	include "inc/client_comment_only.php";
}
?>
								<div style="height:20px;font-size:0px"></div>
								<input type="hidden" name="prv_dojang_img" value="<?$row1['dojang_img']?>" />
								<input type="hidden" name="prv_cust_tell"  value="<?=$row['com_tel']?>" />
								<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>" />
								<input type="hidden" name="w" value="<?=$w?>" />
								<input type="hidden" name="id" value="<?=$id?>" />
								<input type="hidden" name="page" value="<?=$page?>" />
								<input type="hidden" name="tab" value="<?=$tab?>" />
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
