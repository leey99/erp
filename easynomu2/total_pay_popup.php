<? 
$mode = "popup";
$mode2 = "";
$member['mb_id'] = "test";
include_once("_common.php");
//include_once("$g4[path]/lib/popup.lib.php"); 
$year = "2013";
$s_title = $year."�⵵ �����Ѿ� �Ű�";

// ���� ���¸� �۵�
if($w == "u") {
	$sql1 = " select * from total_pay where id = $id ";
	echo $sql;
	$result1=mysql_query($sql1);
	$row1=mysql_fetch_array($result1);
	$t_no = $row1[t_no];
	$comp_bznb = $row1[comp_bznb];
	$comp_name = $row1[comp_name];
	$boss_name = $row1[boss_name];
	$adr_zip = explode("-",$row1[adr_zip]);
	$adr_zip1 = $adr_zip[0];
	$adr_zip2 = $adr_zip[1];
	$adr_adr1 = $row1[adr_adr1];
	$adr_adr2 = $row1[adr_adr2];
	$sj_upjong_code = $row1[sj_upjong_code];
	if($sj_upjong_code) {
		$sj_upjong = $row1[sj_upjong];
		$sj_percent = $row1[sj_percent];
	}
	$comp_email = $row1[comp_email];
	$comp_tel = $row1[comp_tel];
	$comp_fax = $row1[comp_fax];
	//�ٷ��� �Ű�Ǽ�
	$sql2 = "select count(*) as cnt from total_pay_opt where mid = $id";
	$result2=mysql_query($sql2);
	//echo $sql2;
	$row2=mysql_fetch_array($result2);
	if($row2[cnt] < 6) {
		$worker_count = 5;
	} else {
		$worker_count = $row2[cnt];
	}
} else {
	$worker_count = 5;
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$s_title?></title>
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<br>
<h1>2013�⵵ ���,���� �����Ѿ׽Ű� ���� �Ǿ����ϴ�.</h1>
</body>
</html>
<? exit; ?>
<script language="javascript">
function checkData(mode2) {
	var frm = document.dataForm;
	if (frm.comp_bznb.value == "")
	{
		alert("����ڵ�Ϲ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.comp_name.value == "")
	{
		alert("������Ī�� �Է��ϼ���.");
		frm.comp_name.focus();
		return;
	}
	if (frm.boss_name.value == "")
	{
		alert("��ǥ�ڸ� �Է��ϼ���.");
		frm.boss_name.focus();
		return;
	}
	if (frm.adr_adr1.value == "")
	{
		alert("������������ �Է��ϼ���.");
		frm.adr_adr1.focus();
		return;
	}
	if (frm.comp_email.value == "")
	{
		alert("�̸����� �Է��ϼ���.");
		frm.comp_email.focus();
		return;
	}
	if (frm.comp_tel.value == "")
	{
		alert("��ȭ��ȣ�� �Է��ϼ���.");
		frm.comp_tel.focus();
		return;
	}
	if (frm.name_1.value == "")
	{
		alert("�ٷ��� ������ �Է��ϼ���.");
		frm.name_1.focus();
		return;
	}
	if (frm.ssnb1_1.value == "")
	{
		alert("�ٷ��� �ֹε�Ϲ�ȣ(���ڸ�)�� �Է��ϼ���.");
		frm.ssnb1_1.focus();
		return;
	}
	if (frm.ssnb2_1.value == "")
	{
		alert("�ٷ��� �ֹε�Ϲ�ȣ(���ڸ�)�� �Է��ϼ���.");
		frm.ssnb2_1.focus();
		return;
	}
	if(frm.agree_check1.checked == false) {
		alert("���� �ۼ� Ȯ�ο� üũ�� �ּ���.");
		frm.agree_check1.focus();
		return;
	}
	if(frm.agree_check2.checked == false) {
		alert("��������ó����ħ ���ǿ� üũ�� �ּ���.");
		frm.agree_check2.focus();
		return;
	}
	if(mode2 == "popup") {
		frm.mode2.value = "popup";
		document.getElementById('save_bt').style.display = "none";
		document.getElementById('save_ing').style.display = "inline";
	}
	frm.action = "total_pay_update.php";
	frm.submit();
	return;
}
function t_no_data() {
	var frm = document.dataForm;
	frm.action = "<?=$_PHP_SELF?>";
	frm.method = "post";
	frm.submit();
	return;
}
function checkThousand(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	//�� ����Ʈ+�� �� �� Home
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36) {
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
}
function delCom(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
//��¥ �Է� �޸�
function checkcomma(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
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
	input = delcomma(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	//�齺���̽� �� ����Ʈ+�� �� �� Del
	if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
		//alert(inputVal.length);
		//alert(input);
		if(inputVal.length == 4){
			//input = delhyphen(inputVal, inputVal.length);
			total += input.substring(0,4)+".";
			//alert(type.name);
		} else if(inputVal.length == 7){
			total += inputVal.substring(0,7)+".";
		} else if(inputVal.length == 12){
			total += inputVal.substring(0,14)+"";
		} else {
			total += inputVal;
		}
		if(keydown =='Y'){
			type.value = total;
		}else if(keydown =='N'){
			return total;
		}
	}
	return total;
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
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 45) event.returnValue = false;
	}
}
function only_number() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		event.returnValue = false;
	}
}
function open_comp() {
	//�����Ѿ׽Ű� ���� �˸�
	alert("�����Ѿ׽Ű� ���� �Ǿ����ϴ�.");
	return;
	var frm = document.dataForm;
	n = frm.comp_bznb.value;
	if(frm.comp_bznb.value == "") {
		alert("����ڵ�Ϲ�ȣ�� �Է� �� �˻��� �ֽʽÿ�.");
		frm.comp_bznb.focus();
		return;
	}
	window.open("popup/t_no_popup.php?comp_bznb="+n, "comp_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function open_sj_upjong(n) {
	window.open("popup/sj_upjong_popup.php?n=_"+n, "sj_upjong_popup", "width=640, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
//õ���� �޹�
function checkBznb(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
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
				if ( type =='1' ) {
					main.comp_bznb.value=total;					// type �� ���� �������� �־� �ش�.
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
//�ֹε�Ϲ�ȣ �Է� ������
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
				type.value = total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//�����ȣ �Է� ������
function checkhyphen_post(inputVal, type, keydown) {
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
	if(event.keyCode != 8) {
		if(inputVal.length == 3){
			total += input.substring(0,3)+"-";
		} else {
			total += inputVal;
		}
		if(keydown =='Y'){
			type.value = total;
		}else if(keydown =='N'){
			return total;
		}
	}
	return total;
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
	}
}
function worker_count_apply() {
	main = document.dataForm;
	//alert(main.worker_count.value);
	worker_count = main.worker_count.value;
	if(worker_count > 80) {
		alert("�ִ� 80����� ��� �����մϴ�.");
		main.worker_count.focus();
		return;
	}
	for(i=1;i<=worker_count;i++) {
		document.getElementById('worker_tr'+i).style.display = "";
	}
	//alert(worker_count+1);
	for(i=toInt(worker_count)+1;i<=80;i++) {
		document.getElementById('worker_tr'+i).style.display = "none";
	}
}
function checkAddress(strgbn) {
	var ret = window.open("../road_address/search.php", "address", "width=496,height=522,scrollbars=0");
	return;
}
//���纸�� ���������Ѿ� �հ�
function sj_ypay_sum() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	sj_ysum = 0;
	//alert(frm.sj_ypay1.value);
	for(i=1;i<=worker_count;i++) {
		sj_ysum += toInt(frm['sj_ypay_'+i].value);
		//alert(frm['sj_ypay'+i].value);
	}
	sj_ysum += toInt(frm['temp_sj_ypay'].value);
	sj_ysum += toInt(frm['etc_sj_ypay'].value);
	sj_ysum += toInt(frm['etc2_sj_ypay'].value);
	frm.sj_ysum.value = setComma(sj_ysum);
}
//��뺸�� ���������Ѿ� �հ� 1~6��
function gy_ypay_sum() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	gy_ysum = 0;
	for(i=1;i<=worker_count;i++) {
		gy_ysum += toInt(frm['gy_ypay_'+i].value);
	}
	gy_ysum += toInt(frm['temp_gy_ypay'].value);
	frm.gy_ysum.value = setComma(gy_ysum);
}
//��뺸�� ���������Ѿ� �հ� 7~12��
function gy_ypay_sum2() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	gy_ysum2 = 0;
	for(i=1;i<=worker_count;i++) {
		gy_ysum2 += toInt(frm['gy_ypay2_'+i].value);
	}
	gy_ysum2 += toInt(frm['temp_gy_ypay2'].value);
	frm.gy_ysum2.value = setComma(gy_ysum2);
}
//���纸�� -> ��뺸�� ����
function worker_copy() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	for(i=1;i<=worker_count;i++) {
		frm['gy_sdate_'+i].value = frm['sj_sdate_'+i].value;
		frm['gy_edate_'+i].value = frm['sj_edate_'+i].value;
		//frm['gy_ypay_'+i].value = frm['sj_ypay_'+i].value;
		frm['gy_mpay_'+i].value = frm['sj_mpay_'+i].value;
	}
	//frm.temp_gy_ypay.value = frm.temp_sj_ypay.value;
	gy_ypay_sum();
}
//���纸�� -> �ǰ����� ����
function worker_copy_gg() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	for(i=1;i<=worker_count;i++) {
		frm['gg_sdate_'+i].value = frm['sj_sdate_'+i].value;
		frm['gg_ypay_'+i].value = frm['sj_ypay_'+i].value;
	}
	frm.temp_gg_ypay.value = frm.temp_sj_ypay.value;
	frm.etc_gg_ypay.value = frm.etc_sj_ypay.value;
	frm.etc2_gg_ypay.value = frm.etc2_sj_ypay.value;
	gg_ypay_sum();
}
//�ǰ����� ���������Ѿ� �հ�
function gg_ypay_sum() {
	frm = document.dataForm;
	worker_count = frm.worker_count.value;
	gg_ysum = 0;
	for(i=1;i<=worker_count;i++) {
		gg_ysum += toInt(frm['gg_ypay_'+i].value);
	}
	gg_ysum += toInt(frm['temp_gg_ypay'].value);
	gg_ysum += toInt(frm['etc_gg_ypay'].value);
	gg_ysum += toInt(frm['etc2_gg_ypay'].value);
	frm.gg_ysum.value = setComma(gg_ysum);
}
function u_total_copy() {
	frm = document.dataForm;
	for(i=1;i<=5;i++) {
		frm['u_gy_sdate_'+i].value = frm['u_sj_sdate_'+i].value;
		frm['u_gy_edate_'+i].value = frm['u_sj_edate_'+i].value;
		frm['u_gy_mpay_'+i].value = frm['u_sj_mpay_'+i].value;
	}
	gy_ypay_sum();
}
//�ۼ����
function total_pay_rule() {
	var ret = window.open("total_pay_rule.php", "total_pay_rule", "width=496,height=522,scrollbars=1");
	return;
}
</script>
<div style="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="200"><img src="images/logo.png" /></td>
						<td width="700" style="padding-top:10px">
							<table width="90%" border="0" cellpadding="0" cellspacing="0" id="tables">
								<tr>
									<td>
										<div align="right" class="">
											[ �ѱ�����濵�� ]&nbsp;&nbsp;&nbsp;
											TEL : 1544-4519&nbsp;&nbsp;&nbsp;
											<!--���� : 02-1111-1111&nbsp;&nbsp;&nbsp;-->
											FAX : 0505-609-0001
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="background:#2a549c;height:9px"></td>
		</tr>
	</table>
</div>
<div>
<table width="1240" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" style="padding:10px 10px 10px 10px">
			<!--Ÿ��Ʋ -->
			<table width="100%" border=0 cellspacing=0 cellpadding=0>
				<tr>     
					<td height="18">
						<table width=100% border=0 cellspacing=0 cellpadding=0>
							<tr>
								<td><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$s_title?></span>
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
			<form name="dataForm" method="post">
			<input type="hidden" name="mode" value="<?=$mode?>">
			<input type="hidden" name="mode2" value="<?=$mode2?>">
			<input type="hidden" name="year" value="<?=$year?>">
			<input type="hidden" name="w" id="w" value="<?=$w?>">
			<input type="hidden" name="id" id="id" value="<?=$id?>">
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="images/g_tab_on_lt.gif"></td> 
									<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
									���������
									</td> 
									<td><img src="images/g_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
						<td valign="">
							<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:total_pay_rule();" target="">�ۼ����</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
							�����Ѿ� �Ű� �ۼ���� �ȳ�
						</td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px;line-height:0px;"></div>
				<!--�˻� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
					<col width="120">
					<col width="320">
					<col width="112">
					<col width="230">
					<col width="110">
					<col width="">
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����ڵ�Ϲ�ȣ<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="comp_bznb" id="comp_bznb" type="text" class="textfm" style="width:100px;" value="<?=$comp_bznb?>" maxlength="12" onkeyup="checkBznb(this.value, '1','Y')" >
							<label onclick="open_comp();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
							��) 123-12-12345
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������Ī<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="comp_name" id="comp_name" type="text" class="textfm" style="width:223px;" value="<?=$comp_name?>" maxlength="25">
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ǥ��<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="boss_name" id="boss_name" type="text" class="textfm" style="width:100px;" value="<?=$boss_name?>" maxlength="6"> ����������ȣ : <span id="t_no"><?=$t_no?></span>
						</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����������<font color="red">*</font></td>
						<td nowrap class="tdrow" colspan="3">
							<input name="adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip1?>" readonly>
							-
							<input name="adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip2?>" readonly>
							<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:checkAddress('cust');" target="">�ּ�ã��</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
							<input name="adr_adr1" type="text" class="textfm" style="width:270px;ime-mode:active;" value="<?=$adr_adr1?>" readonly>
							<input name="adr_adr2" type="text" class="textfm" style="width:250px;ime-mode:active;" value="<?=$adr_adr1?>" maxlength="150">
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������</td>
						<td nowrap class="tdrow">
							<input name="sj_upjong_code" id="sj_upjong_code" type="text" class="textfm" style="width:40px;" value="<?=$sj_upjong_code?>" maxlength="5" readonly>
							<input name="sj_upjong"  id="sj_upjong" type="text" class="textfm" style="width:180px;" value="<?=$sj_upjong?>" maxlength="25" readonly>
							<input name="sj_percent" id="sj_percent" type="text" class="textfm" style="width:40px;" value="<?=$sj_percent?>" maxlength="25" readonly> %
							<label onclick="open_sj_upjong();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
						</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�̸���<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="comp_email" id="comp_email" type="text" class="textfm" style="width:210px;" value="<?=$comp_email?>" maxlength="30">
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ<font color="red">*</font></td>
						<td nowrap class="tdrow">
							<input name="comp_tel" id="comp_tel" type="text" class="textfm" style="width:100px;" value="<?=$comp_tel?>" maxlength="15"> ��) 055-1234-1234
						</td>
						<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ѽ���ȣ<font color="red"></font></td>
						<td nowrap class="tdrow">
							<input name="comp_fax" id="comp_fax" type="text" class="textfm" style="width:100px;" value="<?=$comp_fax?>" maxlength="15"> ��) 055-1234-1234
						</td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>

				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="images/g_tab_on_lt.gif"></td> 
									<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'>
									�ٷ��� �����Ѿ�
									</td> 
									<td><img src="images/g_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=4></td> 
						<td valign="bottom">
							<input name="worker_count" type="text" class="textfm" style="width:30px;height:19px;ime-mode:active;" value="<?=$worker_count?>">��
							<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:worker_count_apply();" target="">����</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
							(�ִ� 80����� ��� ����) �� �ٷ��� �߰��� ���� ���� �� "����" ��ư�� Ŭ���Ͻʽÿ�.
						</td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px;line-height:0px;"></div>
				<!--�˻� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
					<tr>
						<td nowrap class="tdrowk_center" rowspan="3">No</td>
						<td nowrap class="tdrowk_center" rowspan="3">����<font color="red">*</font></td>
						<td nowrap class="tdrowk_center" rowspan="3">�ֹε�Ϲ�ȣ<font color="red">*</font></td>
						<td nowrap class="tdrowk_center" rowspan="3">��<br>�����<br>�ΰ�<br>����</td>
						<td nowrap class="tdrowk_center" colspan="4">���纸��</td>
						<td nowrap class="tdrowk_center" colspan="5">��뺸�� <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:worker_copy();" target="">����</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table></td>
						<td nowrap class="tdrowk_center" colspan="3">�ǰ����� <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:worker_copy_gg();" target="">����</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table></td>
					</tr>
					<tr>
						<td nowrap class="tdrowk_center" rowspan="2">�����</td>
						<td nowrap class="tdrowk_center" rowspan="2">�����</td>
						<td nowrap class="tdrowk_center" rowspan="2">��<br>���������Ѿ�(��)</td>
						<td nowrap class="tdrowk_center" rowspan="2">��<br>����պ���(��)</td>
						<td nowrap class="tdrowk_center" rowspan="2">�����</td>
						<td nowrap class="tdrowk_center" rowspan="2">�����</td>
						<td nowrap class="tdrowk_center" colspan="2">���������Ѿ�(��)</td>
						<td nowrap class="tdrowk_center" rowspan="2">��<br>����պ���(��)</td>
						<td nowrap class="tdrowk_center" rowspan="2">�ڰ����<br>(����)��</td>
						<td nowrap class="tdrowk_center" rowspan="2">���������Ѿ�<br>(��)</td>
						<td nowrap class="tdrowk_center" rowspan="2">�ٹ�<br>����</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk_center" rowspan="">�� (1~6��)</td>
						<td nowrap class="tdrowk_center" rowspan="">�� (7~12��)</td>
					</tr>
<?
// ���� ���¸� �۵�
if($w == "u") {
	$result_opt = mysql_query("select * from total_pay_opt where mid = $id order by id asc");
	for($i=1; $row_opt=sql_fetch_array($result_opt); $i++) {
		$name[$i] = $row_opt[name1];
		//�ֹε�Ϲ�ȣ ���ڸ� ��ǥ ó��
		$ssnb[$i] = explode("-",$row_opt[ssnb1]);
		$ssnb1[$i] = $ssnb[$i][0];
		$ssnb2[$i] = $ssnb[$i][1];
		$bohum_code[$i] = $row_opt[bohum_code1];
		$sj_sdate[$i] = $row_opt[sj_sdate1];
		$sj_edate[$i] = $row_opt[sj_edate1];
		$sj_ypay[$i] = number_format($row_opt[sj_ypay1]);
		$sj_mpay[$i] = number_format($row_opt[sj_mpay1]);
		$gy_sdate[$i] = $row_opt[gy_sdate1];
		$gy_edate[$i] = $row_opt[gy_edate1];
		$gy_ypay[$i] = number_format($row_opt[gy_ypay1]);
		$gy_ypay2[$i] = number_format($row_opt[gy_ypay2]);
		$gy_mpay[$i] = number_format($row_opt[gy_mpay1]);
		$gy_post[$i] = $row_opt[gy_post1];
		$gg_sdate[$i] = $row_opt[gg_sdate1];
		$gg_ypay[$i] = number_format($row_opt[gg_ypay1]);
		$gg_month[$i] = number_format($row_opt[gg_month1]);
	}
	$temp_sj_ypay = number_format($row1[temp_sj_ypay]);
	$temp_gy_ypay = number_format($row1[temp_gy_ypay]);
	$temp_gy_ypay2 = number_format($row1[temp_gy_ypay2]);
	$etc_sj_ypay = number_format($row1[etc_sj_ypay]);
	$etc2_sj_ypay = number_format($row1[etc2_sj_ypay]);
	$sj_ysum = number_format($row1[sj_ysum]);
	$gy_ysum = number_format($row1[gy_ysum]);
	$gy_ysum2 = number_format($row1[gy_ysum2]);
	$temp_gg_ypay = number_format($row1[temp_gg_ypay]);
	$etc_gg_ypay = number_format($row1[etc_gg_ypay]);
	$etc2_gg_ypay = number_format($row1[etc2_gg_ypay]);
	$gg_ysum = number_format($row1[gg_ysum]);
}

for($i=1;$i<81;$i++) {
	if($i > $worker_count) {
	 $worker_display[$i] = "display:none";
	}
?>
					<tr id="worker_tr<?=$i?>" style="<?=$worker_display[$i]?>" class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24"><?=$i?></td>
						<td nowrap class="ltrow1_center_h24"><input name="name_<?=$i?>" type="text" class="textfm" style="width:60px;"  value="<?=$name[$i]?>" maxlength="10"></td>
						<td nowrap class="ltrow1_center_h24"><input name="ssnb1_<?=$i?>" type="text" class="textfm" style="width:46px;" value="<?=$ssnb1[$i]?>" maxlength="6" onKeyPress="only_number();" onkeyup=""><input name="ssnb2_<?=$i?>" type="password" class="textfm" style="width:52px;" value="<?=$ssnb2[$i]?>" maxlength="7" onKeyPress="only_number();" onkeyup=""></td>
						<td nowrap class="ltrow1_center_h24"><input name="bohum_code_<?=$i?>" type="text" class="textfm" style="width:30px;" value="<?=$bohum_code[$i]?>" maxlength="2"></td>
						<td nowrap class="ltrow1_center_h24"><input name="sj_sdate_<?=$i?>" type="text" class="textfm" style="width:64px;" value="<?=$sj_sdate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="sj_edate_<?=$i?>" type="text" class="textfm" style="width:64px;" value="<?=$sj_edate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="sj_ypay_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$sj_ypay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="sj_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="sj_mpay_<?=$i?>" type="text" class="textfm" style="width:90px;" value="<?=$sj_mpay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_sdate_<?=$i?>" type="text" class="textfm" style="width:64px;" value="<?=$gy_sdate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_edate_<?=$i?>" type="text" class="textfm" style="width:64px;" value="<?=$gy_edate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_ypay_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$gy_ypay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="gy_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_ypay2_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$gy_ypay2[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="gy_ypay_sum2();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_mpay_<?=$i?>" type="text" class="textfm" style="width:90px;" value="<?=$gy_mpay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gg_sdate_<?=$i?>" type="text" class="textfm" style="width:64px;"  value="<?=$gg_sdate[$i]?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gg_ypay_<?=$i?>" type="text" class="textfm" style="width:94px;" value="<?=$gg_ypay[$i]?>" maxlength="14" onkeypress="only_number();" onkeyup="gg_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gg_month_<?=$i?>" type="text" class="textfm" style="width:30px;" value="<?=$gg_month[$i]?>" maxlength="2"></td>
					</tr>
<?
}
?>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24" colspan="6">�� �Ͽ�ٷ��� �����Ѿ�</td>
						<td nowrap class="ltrow1_center_h24"><input name="temp_sj_ypay" type="text" class="textfm" style="width:94px;" value="<?=$temp_sj_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="sj_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"><input name="temp_gy_ypay" type="text" class="textfm" style="width:94px;" value="<?=$temp_gy_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="gy_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="temp_gy_ypay2" type="text" class="textfm" style="width:94px;" value="<?=$temp_gy_ypay2?>" maxlength="14" onkeypress="only_number();" onkeyup="gy_ypay_sum2();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"><input name="temp_gg_ypay" type="text" class="textfm" style="width:94px;" value="<?=$temp_gg_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="gg_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"></td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24" colspan="6">�� �� ���� �ٷ��� �����Ѿ�(60�ð� �̸�)</td>
						<td nowrap class="ltrow1_center_h24"><input name="etc_sj_ypay" type="text" class="textfm" style="width:94px;" value="<?=$etc_sj_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="sj_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"><input name="etc_gg_ypay" type="text" class="textfm" style="width:94px;" value="<?=$etc_gg_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="gg_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"></td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24" colspan="6">�� �� ���� �ٷ��� �����Ѿ�(�ܱ��� �ٷ���)</td>
						<td nowrap class="ltrow1_center_h24"><input name="etc2_sj_ypay" type="text" class="textfm" style="width:94px;" value="<?=$etc2_sj_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="sj_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"><input name="etc2_gg_ypay" type="text" class="textfm" style="width:94px;" value="<?=$etc2_gg_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="gg_ypay_sum();checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"></td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24" colspan="6">�� �� ��</td>
						<td nowrap class="ltrow1_center_h24"><input name="sj_ysum" type="text" class="textfm5" readonly style="width:94px;" value="<?=$sj_ysum?>" ></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_ysum" type="text" class="textfm5" readonly style="width:94px;" value="<?=$gy_ysum?>" ></td>
						<td nowrap class="ltrow1_center_h24"><input name="gy_ysum2" type="text" class="textfm5" readonly style="width:94px;" value="<?=$gy_ysum2?>" ></td>
						<td nowrap class="ltrow1_center_h24"></td>
						<td nowrap class="ltrow1_center_h24"></td> 
						<td nowrap class="ltrow1_center_h24"><input name="gg_ysum" type="text" class="textfm5" readonly style="width:90px;" value="<?=$gg_ysum?>"></td>
						<td nowrap class="ltrow1_center_h24"></td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
$etc_count = explode(",",$row1[etc_count]);
?>
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="images/g_tab_on_lt.gif"></td> 
									<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:180;text-align:center'> 
									<a href="javascript:tab_view('temp_etc_count');">�Ͽ�ٷ��� �� �׹��� �ٷ��ڼ�</a>
									</td> 
									<td><img src="images/g_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=4></td> 
						<td valign="bottom"> �� �Ͽ�ٷ��� �� �׹��� �ٷ��ڼ�(��)</td>  
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px;line-height:0px;"></div>
				<!--�˻� -->
				<div id="temp_etc_count" style="<?=$change_total_display?>">
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="tdrowk_center">����</td>
<?
for($i=1;$i<13;$i++) {
?>
						<td nowrap class="ltrow1_center_h24"><?=$i?>��</td>
<?
}
?>
					</tr>

					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="tdrowk_center">�ٷ��ڼ�</td>
<?
for($i=1;$i<13;$i++) {
	$k = $i - 1;
?>
						<td nowrap class="ltrow1_center_h24"><input name="etc_count<?=$i?>" type="text" class="textfm" style="width:40px;" value="<?=$etc_count[$k]?>" maxlength="3" onkeypress="only_number();"></td>
<?
}
?>
					</tr>
				</table>
				</div>
				<!--�˻� -->
				<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
$change_sdate = $row1[change_sdate];
$change_edate = $row1[change_edate];
if($change_sdate) {
	$change_total_display = "";
} else {
	$change_total_display = "display:none";
}
$now_sdate = $row1[now_sdate];
$now_edate = $row1[now_edate];
$change_ypay = number_format($row1[change_ypay]);
$now_ypay = number_format($row1[now_ypay]);
$etc_count = explode(",",$row1[etc_count]);
?>
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="images/g_tab_on_lt.gif"></td> 
									<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:244;text-align:center'> 
									<a href="javascript:tab_view('change_total');">���纸�� �������� ����� �Ⱓ�� �����Ѿ�</a>
									</td> 
									<td><img src="images/g_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=4></td> 
						<td valign="bottom"> �� (���� �� ���纸�� ���������� �ִ� ��쿡�� ����)</td>  
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px;line-height:0px;"></div>
				<!--�˻� -->
				<div id="change_total" style="<?=$change_total_display?>">
				<table width="40%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
					<tr>
						<td nowrap class="tdrowk_center">�� ��</td>
						<td nowrap class="tdrowk_center">�������� ��</td>
						<td nowrap class="tdrowk_center">�������� ��</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk_center">�ش�Ⱓ</td>
						<td nowrap class="tdrowk_center"><input name="change_sdate" type="text" class="textfm" style="width:70px;" value="<?=$change_sdate?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')">~<input name="change_edate" type="text" class="textfm" style="width:70px;" value="<?=$change_edate?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="tdrowk_center"><input name="now_sdate"    type="text" class="textfm" style="width:70px;" value="<?=$now_sdate?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')">~<input name="now_edate" type="text" class="textfm" style="width:70px;" value="<?=$now_edate?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
					</tr>

					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24">����庸���Ѿ�</td>
						<td nowrap class="ltrow1_center_h24"><input name="change_ypay" type="text" class="textfm" style="width:100px;" value="<?=$change_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
						<td nowrap class="ltrow1_center_h24"><input name="now_ypay" type="text" class="textfm" style="width:100px;" value="<?=$now_ypay?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
					</tr>
				</table>
				</div>
				<!--�˻� -->
				<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
$u_name1 = $row1[u_name1];
if($u_name1) {
	$u_total_display = "";
	$u_ssnb1 = $row1[u_ssnb1];
	$u_bohum_code1 = $row1[u_bohum_code1];
	$u_sj_sdate1 = $row1[u_sj_sdate1];
	$u_sj_edate1 = $row1[u_sj_edate1];
	$u_sj_ypay1 = number_format($row1[u_sj_ypay1]);
	$u_sj_mpay1 = number_format($row1[u_sj_mpay1]);
	$u_gy_sdate1 = $row1[u_gy_sdate1];
	$u_gy_edate1 = $row1[u_gy_edate1];
	$u_loss_pay1 = number_format($row1[u_loss_pay1]);
	$u_hire_pay1 = number_format($row1[u_hire_pay1]);
	$u_gy_mpay1 = number_format($row1[u_gy_mpay1]);
} else {
	$u_total_display = "display:none";
}
$u_name2 = $row1[u_name2];
if($u_name2) {
	$u_ssnb2 = $row1[u_ssnb2];
	$u_bohum_code2 = $row1[u_bohum_code2];
	$u_sj_sdate2 = $row1[u_sj_sdate2];
	$u_sj_edate2 = $row1[u_sj_edate2];
	$u_sj_ypay2 = number_format($row1[u_sj_ypay2]);
	$u_sj_mpay2 = number_format($row1[u_sj_mpay2]);
	$u_gy_sdate2 = $row1[u_gy_sdate2];
	$u_gy_edate2 = $row1[u_gy_edate2];
	$u_loss_pay2 = number_format($row1[u_loss_pay2]);
	$u_hire_pay2 = number_format($row1[u_hire_pay2]);
	$u_gy_mpay2 = number_format($row1[u_gy_mpay2]);
}
$u_name3 = $row1[u_name3];
if($u_name3) {
	$u_ssnb3 = $row1[u_ssnb3];
	$u_bohum_code3 = $row1[u_bohum_code3];
	$u_sj_sdate3 = $row1[u_sj_sdate3];
	$u_sj_edate3 = $row1[u_sj_edate3];
	$u_sj_ypay3 = number_format($row1[u_sj_ypay3]);
	$u_sj_mpay3 = number_format($row1[u_sj_mpay3]);
	$u_gy_sdate3 = $row1[u_gy_sdate3];
	$u_gy_edate3 = $row1[u_gy_edate3];
	$u_loss_pay3 = number_format($row1[u_loss_pay3]);
	$u_hire_pay3 = number_format($row1[u_hire_pay3]);
	$u_gy_mpay3 = number_format($row1[u_gy_mpay3]);
}
$u_name4 = $row1[u_name4];
if($u_name4) {
	$u_ssnb4 = $row1[u_ssnb4];
	$u_bohum_code4 = $row1[u_bohum_code4];
	$u_sj_sdate4 = $row1[u_sj_sdate4];
	$u_sj_edate4 = $row1[u_sj_edate4];
	$u_sj_ypay4 = number_format($row1[u_sj_ypay4]);
	$u_sj_mpay4 = number_format($row1[u_sj_mpay4]);
	$u_gy_sdate4 = $row1[u_gy_sdate4];
	$u_gy_edate4 = $row1[u_gy_edate4];
	$u_loss_pay4 = number_format($row1[u_loss_pay4]);
	$u_hire_pay4 = number_format($row1[u_hire_pay4]);
	$u_gy_mpay4 = number_format($row1[u_gy_mpay4]);
}
$u_name5 = $row1[u_name5];
if($u_name5) {
	$u_ssnb5 = $row1[u_ssnb5];
	$u_bohum_code5 = $row1[u_bohum_code5];
	$u_sj_sdate5 = $row1[u_sj_sdate5];
	$u_sj_edate5 = $row1[u_sj_edate5];
	$u_sj_ypay5 = number_format($row1[u_sj_ypay5]);
	$u_sj_mpay5 = number_format($row1[u_sj_mpay5]);
	$u_gy_sdate5 = $row1[u_gy_sdate5];
	$u_gy_edate5 = $row1[u_gy_edate5];
	$u_loss_pay5 = number_format($row1[u_loss_pay5]);
	$u_hire_pay5 = number_format($row1[u_hire_pay5]);
	$u_gy_mpay5 = number_format($row1[u_gy_mpay5]);
}
?>
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="images/g_tab_on_lt.gif"></td> 
									<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:130;text-align:center'> 
									<a href="javascript:tab_view('u_total');">���������� �����Ѿ�</a>
									</td> 
									<td><img src="images/g_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=4></td> 
						<td valign="bottom">(��Ȱ�ٷ������� �� �뵿���� �����κ��� ��ǰ�� ���޹޴� "����������" �����Ѿ� �Ű�) �� �ش�ٷ��ڰ� �ִ� ��쿡�� ����</td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px;line-height:0px;"></div>
				<!--�˻� -->
				<div id="u_total" style="<?=$u_total_display?>">
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
					<tr>
						<td nowrap class="tdrowk_center" rowspan="3">����</td>
						<td nowrap class="tdrowk_center" rowspan="3">�ֹε�Ϲ�ȣ</td>
						<td nowrap class="tdrowk_center" rowspan="3">�����<br>�ΰ�<br>����</td>
						<td nowrap class="tdrowk_center" colspan="4">���纸��</td>
						<td nowrap class="tdrowk_center" colspan="5">��뺸��</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk_center" rowspan="2">�����</td>
						<td nowrap class="tdrowk_center" rowspan="2">�����</td>
						<td nowrap class="tdrowk_center" rowspan="2">���������Ѿ�(��)</td>
						<td nowrap class="tdrowk_center" rowspan="2">����պ���(��)</td>
						<td nowrap class="tdrowk_center" rowspan="2">�����</td>
						<td nowrap class="tdrowk_center" rowspan="2">�����</td>
						<td nowrap class="tdrowk_center" colspan="2">���������Ѿ�(��)</td>
						<td nowrap class="tdrowk_center" rowspan="2">����պ���(��)</td>
					</tr>
					<tr>
						<td nowrap class="tdrowk_center" rowspan="">�Ǿ��޿�</td>
						<td nowrap class="tdrowk_center" rowspan="">������/�����ɷ°���</td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24"><input name="u_name1" type="text" class="textfm" style="width:50px;"  value="<?=$u_name1?>" maxlength="10"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_ssnb1" type="text" class="textfm" style="width:110px;" value="<?=$u_ssnb1?>" maxlength="14" onKeyPress="only_number();" onkeyup="checkhyphen_bupin_no(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_bohum_code1" type="text" class="textfm" style="width:30px;" value="<?=$u_bohum_code1?>" maxlength="2"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_sdate1" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_sdate1?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_edate1" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_edate1?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_ypay1" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_ypay1?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_mpay1" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_mpay1?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_sdate1" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_sdate1?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_edate1" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_edate1?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_loss_pay1" type="text" class="textfm" style="width:100px;" value="<?=$u_loss_pay1?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_hire_pay1" type="text" class="textfm" style="width:100px;" value="<?=$u_hire_pay1?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_mpay1" type="text" class="textfm" style="width:100px;"  value="<?=$u_gy_mpay1?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24"><input name="u_name2" type="text" class="textfm" style="width:50px;"  value="<?=$u_name2?>" maxlength="10"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_ssnb2" type="text" class="textfm" style="width:110px;" value="<?=$u_ssnb2?>" maxlength="14" onKeyPress="only_number();" onkeyup="checkhyphen_bupin_no(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_bohum_code2" type="text" class="textfm" style="width:30px;" value="<?=$u_bohum_code2?>" maxlength="2"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_sdate2" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_sdate2?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_edate2" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_edate2?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_ypay2" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_ypay2?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_mpay2" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_mpay2?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_sdate2" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_sdate2?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_edate2" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_edate2?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_loss_pay2" type="text" class="textfm" style="width:100px;" value="<?=$u_loss_pay2?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_hire_pay2" type="text" class="textfm" style="width:100px;" value="<?=$u_hire_pay2?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_mpay2" type="text" class="textfm" style="width:100px;"  value="<?=$u_gy_mpay2?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24"><input name="u_name3" type="text" class="textfm" style="width:50px;"  value="<?=$u_name3?>" maxlength="10"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_ssnb3" type="text" class="textfm" style="width:110px;" value="<?=$u_ssnb3?>" maxlength="14" onKeyPress="only_number();" onkeyup="checkhyphen_bupin_no(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_bohum_code3" type="text" class="textfm" style="width:30px;" value="<?=$u_bohum_code3?>" maxlength="2"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_sdate3" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_sdate3?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_edate3" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_edate3?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_ypay3" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_ypay3?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_mpay3" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_mpay3?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_sdate3" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_sdate3?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_edate3" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_edate3?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_loss_pay3" type="text" class="textfm" style="width:100px;" value="<?=$u_loss_pay3?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_hire_pay3" type="text" class="textfm" style="width:100px;" value="<?=$u_hire_pay3?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_mpay3" type="text" class="textfm" style="width:100px;"  value="<?=$u_gy_mpay3?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24"><input name="u_name4" type="text" class="textfm" style="width:50px;"  value="<?=$u_name4?>" maxlength="10"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_ssnb4" type="text" class="textfm" style="width:110px;" value="<?=$u_ssnb4?>" maxlength="14" onKeyPress="only_number();" onkeyup="checkhyphen_bupin_no(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_bohum_code4" type="text" class="textfm" style="width:30px;" value="<?=$u_bohum_code4?>" maxlength="2"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_sdate4" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_sdate4?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_edate4" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_edate4?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_ypay4" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_ypay4?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_mpay4" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_mpay4?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_sdate4" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_sdate4?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_edate4" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_edate4?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_loss_pay4" type="text" class="textfm" style="width:100px;" value="<?=$u_loss_pay4?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_hire_pay4" type="text" class="textfm" style="width:100px;" value="<?=$u_hire_pay4?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_mpay4" type="text" class="textfm" style="width:100px;"  value="<?=$u_gy_mpay4?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
					</tr>
					<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
						<td nowrap class="ltrow1_center_h24"><input name="u_name5" type="text" class="textfm" style="width:50px;"  value="<?=$u_name5?>" maxlength="10"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_ssnb5" type="text" class="textfm" style="width:110px;" value="<?=$u_ssnb5?>" maxlength="14" onKeyPress="only_number();" onkeyup="checkhyphen_bupin_no(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_bohum_code5" type="text" class="textfm" style="width:30px;" value="<?=$u_bohum_code5?>" maxlength="2"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_sdate5" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_sdate5?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_edate5" type="text" class="textfm" style="width:70px;" value="<?=$u_sj_edate5?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_ypay5" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_ypay5?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_sj_mpay5" type="text" class="textfm" style="width:100px;" value="<?=$u_sj_mpay5?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_sdate5" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_sdate5?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_edate5" type="text" class="textfm" style="width:70px;" value="<?=$u_gy_edate5?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_loss_pay5" type="text" class="textfm" style="width:100px;" value="<?=$u_loss_pay5?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_hire_pay5" type="text" class="textfm" style="width:100px;" value="<?=$u_hire_pay5?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
						<td nowrap class="ltrow1_center_h24"><input name="u_gy_mpay5" type="text" class="textfm" style="width:100px;"  value="<?=$u_gy_mpay5?>" maxlength="14" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
					</tr>
				</table>
				</div>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>

				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:">
					<tr>
						<td align="" style="padding-bottom:5px;">
							<span style="font-weight:bold">�� �ǰ����� ����� (�ٷ��� + ��ǥ��) : ��ǥ�ڴ� "�ٷ��� �����Ѿ�" ����Ʈ�� �߰� �Է� �ٶ��ϴ�.</span>
						</td>
					</tr>
					<tr>
						<td align="" style="padding-bottom:5px;">
							<input type="checkbox" name="chk_temp_etc" value="Y" <? if($row1[chk_temp_etc] == "Y") echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold"> 2013�⵵�� �ٷ���(�Ͽ�ٷ���, �׹��� ��Ÿ�ٷ���, ��Ȱ�ٷ���, ����������, �Ƹ�����Ʈ �� ����)�� �������� �Ű��մϴ�.</span>
						</td>
					</tr>
					<tr>
						<td align="" style="padding-bottom:15px;font-size:16px;font-weight:bold">
							<input type="checkbox" name="agree_check1" value="Y" <? if($ok == 1) echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> �� ���׿� ���� ��ü���� ���� �ۼ��Ͽ����� Ȯ���մϴ�.
						</td>
					</tr>
					<tr>
						<td align="" style="padding-bottom:5px;font-size:16px;font-weight:bold">
<style type="text/css">
em {
	font-style: normal;
}
.agree {
	width:1214px;height:120px;overflow:auto; overflow-x:hidden;
	border:1px solid #cccccc;
	padding:5px;
	color: rgb(85, 85, 85); font-family: "����", Gulim, "����", Dotum, AppleGothic, Sans-serif; font-size: 0.75em; position: relative;
}
.agree_check {
	text-align:left;padding:10px 0 10px 0;
}
.ls2 {
	margin-left: 0.83em !important;
}
.lh6 {
	line-height: 1.8em;
}
.bs5 {
	margin-bottom: 2.08em !important;
}
.ts4 {
	margin-top: 1.67em !important;
}
.article_child1 em.emphasis {
	color: rgb(200, 77, 39); font-style: normal; font-weight: normal;
}
</style>
							<div class="agree">
								<p><p class="ls2 lh6 bs5 ts4"><em class="emphasis">&lt;(��)�ѱ�����濵��&gt;('easynomu.com'����  '�����빫')</em>��(��) ����������ȣ���� ���� �̿����� �������� ��ȣ �� ������ ��ȣ�ϰ� ���������� ������ �̿����� ������ ��Ȱ�ϰ� ó���� �� �ֵ��� ������ ���� ó����ħ�� �ΰ� �ֽ��ϴ�.</p><p class="ls2 lh6 bs5 ts4"><em class="emphasis">&lt;(��)�ѱ�����濵��&gt;('�����빫')</em> ��(��) ȸ��� ��������ó����ħ�� �����ϴ� ��� ������Ʈ ��������(�Ǵ� ��������)�� ���Ͽ� ������ ���Դϴ�.</p><p class="ls2">�� �� ��ħ������ <em class="emphasis">2013</em>�� <em class="emphasis">11</em>�� <em class="emphasis">1</em>�Ϻ��� ����˴ϴ�.</p><br><p class="lh6 bs4"><strong>1. ���������� ó�� ���� <em class="emphasis">&lt;(��)�ѱ�����濵��&gt;('easynomu.com'����  '�����빫')</em>��(��) ���������� ������ ������ ���� ó���մϴ�. ó���� ���������� ������ �����̿��� �뵵�δ� ������ ������ �̿� ������ ����� �ÿ��� �������Ǹ� ���� �����Դϴ�.</strong></p><p class="ls2">��. Ȩ������ ȸ������ �� ����</p><p class="ls2">ȸ�� �����ǻ� Ȯ��, ȸ���� ���� ������ ���� ���� �ĺ�������, ȸ���ڰ� ����������, ���� �����̿� ����, ���� ���������� ���� �������� ���������� ó���մϴ�.</p><br><p class="ls2">��. �ο��繫 ó��</p><p class="ls2">�ο����� �ſ� Ȯ��, �ο����� Ȯ��, ó����� �뺸 ���� �������� ���������� ó���մϴ�.</p><br><p class="ls2">��. ��ȭ �Ǵ� ���� ����</p><p class="ls2">���� ����, û���� �߼�, ��ݰ��������� ���� �������� ���������� ó���մϴ�.</p><br><p class="ls2">��. ������ �� ������ Ȱ��</p><p class="ls2">�ű� ����(��ǰ) ���� �� ���� ���� ����, ������ ��ȿ�� Ȯ�� ���� �������� ���������� ó���մϴ�.</p><br><br><br><p class="lh6 bs4"><strong>2. �������� ���� ��Ȳ<br>('easynomu.com'����  '�����빫')�� �������� ��ȣ�� ��32���� ���� ���/�����ϴ� �������������� ó�������� ������ �����ϴ�.</strong></p><p class="ls2">1. �������� ���ϸ� : privacy_information<br> - �������� �׸� : �����ּ�, ��й�ȣ, �������, ������ȭ��ȣ, �α���ID, �޴���ȭ��ȣ, �̸�, �̸���, ȸ���, ��å, ȸ����ȭ��ȣ, ����, �μ�, �з�, �ֹε�Ϲ�ȣ, �����������, ���� IP ����, ��Ű, ���� �̿� ���, ���� �α�<br> - ������� : ������, Ȩ������, ��ȭ/�ѽ�<br> - �����ٰ� : ȸ��DB<br>  - �����Ⱓ : 1��<br>  - ���ù��� : ��� �Ǵ� û��öȸ � ���� ��� : 5��</p><br><br>�� ��Ÿ('easynomu.com'����  '�����빫')�� ������������ ��ϻ��� ������ ���������� ����������ȣ �������� ����(www.privacy.go.kr) �� ���������ο� �� �������������� �䱸 �� ������������ ��ϰ˻� �޴��� Ȱ�����ֽñ� �ٶ��ϴ�.<br><br><p class="lh6 bs4"><strong>3. ���������� ó�� �� ���� �Ⱓ</strong><br><br>�� <em class="emphasis">&lt;(��)�ѱ�����濵��&gt;('�����빫')</em>��(��) ���ɿ� ���� �������� �������̿�Ⱓ �Ǵ� ������ü�κ��� ���������� �����ÿ� ���� ���� �������� ����,�̿�Ⱓ ������ ���������� ó��,�����մϴ�.<br><br>�� ������ �������� ó�� �� ���� �Ⱓ�� ������ �����ϴ�.</p>1.&lt;Ȩ������ ȸ������ �� ����&gt;<br>&lt;Ȩ������ ȸ������ �� ����&gt;�� ������ ���������� ����.�̿뿡 ���� �����Ϸκ���&lt;1��&gt;���� �� �̿������ ���Ͽ� ����.�̿�˴ϴ�.<br>-�����ٰ� : ȸ��DB<br>-���ù��� : ��� �Ǵ� û��öȸ � ���� ��� : 5��<br>-���ܻ��� : �繫��Ź ����<br><br><br><br><p class="lh6 bs4"><strong>4. ���������� ��3�� ������ ���� ����</strong><br><br> �� <em class="emphasis">&lt;(��)�ѱ�����濵��&gt;('easynomu.com'���� '�����빫')</em>��(��) ������ü�� ����, ������ Ư���� ���� �� �������� ��ȣ�� ��17�� �� ��18���� �ش��ϴ� ��쿡�� ���������� ��3�ڿ��� �����մϴ�.</p>��  <em class="emphasis">&lt;(��)�ѱ�����濵��&gt;('easynomu.com')</em>��(��) ������ ���� ���������� ��3�ڿ��� �����ϰ� �ֽ��ϴ�.<br><br><p class="ls2"><br>1. &lt;&gt;<br>- ���������� �����޴� �� : <br>- �����޴� ���� �������� �̿���� : <br>- �����޴� ���� ����.�̿�Ⱓ: </p><br><br><p class="lh6 bs4"><strong>5. ��������ó�� ��Ź</strong><br><br> �� <em class="emphasis">&lt;(��)�ѱ�����濵��&gt;('�����빫')</em>��(��) ��Ȱ�� �������� ����ó���� ���Ͽ� ������ ���� �������� ó�������� ��Ź�ϰ� �ֽ��ϴ�.</p><p class="ls2">1. &lt;&gt;<br>- ��Ź�޴� �� (��Ź��) : <br>- ��Ź�ϴ� ������ ���� : <br>- ��Ź�Ⱓ : </p><p>��  <em class="emphasis">&lt;(��)�ѱ�����濵��&gt;('easynomu.com'���� '�����빫')</em>��(��) ��Ź��� ü��� �������� ��ȣ�� ��25���� ���� ��Ź���� ������� �� �������� ó������, �����?������ ��ȣ��ġ, ����Ź ����, ��Ź�ڿ� ���� ����?����, ���ع�� �� å�ӿ� ���� ������ ��༭ �� ������ ����ϰ�, ��Ź�ڰ� ���������� �����ϰ� ó���ϴ����� �����ϰ� �ֽ��ϴ�.<br><br>�� ��Ź������ �����̳� ��Ź�ڰ� ����� ��쿡�� ��ü���� �� �������� ó����ħ�� ���Ͽ� �����ϵ��� �ϰڽ��ϴ�.<br><br><br></p><p class="lh6 bs4"><strong>6. ������ü�� �Ǹ�,�ǹ� �� �� ����� �̿��ڴ� ����������ü�μ� ������ ���� �Ǹ��� ����� �� �ֽ��ϴ�.</strong></p><p class="ls2">�� ������ü�� (��)�ѱ�����濵��(��easynomu.com������ �������빫) �� ���� �������� ���� �� ȣ�� �������� ��ȣ ���� �Ǹ��� ����� �� �ֽ��ϴ�.<br>1. �������� �����䱸<br>2. ���� ���� ���� ��� ���� �䱸<br>3. �����䱸<br>4. ó������ �䱸<br>�� ��1�׿� ���� �Ǹ� ����(��)�ѱ�����濵��(��easynomu.com������ �������빫) �� ���� �������� ��ȣ�� �����Ģ ���� ��8ȣ ���Ŀ� ���� ����, ���ڿ���, �������(FAX) ���� ���Ͽ� �Ͻ� �� ������ &lt;���/ȸ���&gt;(������ƮURL������ ������Ʈ��) ��(��) �̿� ���� ��ü ���� ��ġ�ϰڽ��ϴ�.<br>�� ������ü�� ���������� ���� � ���� ���� �Ǵ� ������ �䱸�� ��쿡�� &lt;���/ȸ���&gt;(������ƮURL������ ������Ʈ��) ��(��) ���� �Ǵ� ������ �Ϸ��� ������ ���� ���������� �̿��ϰų� �������� �ʽ��ϴ�.<br>�� ��1�׿� ���� �Ǹ� ���� ������ü�� �����븮���̳� ������ ���� �� �� �븮���� ���Ͽ� �Ͻ� �� �ֽ��ϴ�. �� ��� �������� ��ȣ�� �����Ģ ���� ��11ȣ ���Ŀ� ���� �������� �����ϼž� �մϴ�.</p><br><br><p class="lh6 bs4"><strong>7. ó���ϴ� ���������� �׸� �ۼ� </strong><br><br> �� <em class="emphasis">&lt;(��)�ѱ�����濵��&gt;('easynomu.com'����  '�����빫')</em>��(��) ������ �������� �׸��� ó���ϰ� �ֽ��ϴ�.</p><p class="ls2">1&lt;Ȩ������ ȸ������ �� ����&gt;<br>- �ʼ��׸� : �����ּ�, ��й�ȣ ������ ��, ��й�ȣ, �������, ������ȭ��ȣ, �α���ID, �޴���ȭ��ȣ, �̸�, �̸���, ȸ���, ��å, ȸ����ȭ��ȣ, ����, �μ�, �з�, �ֹε�Ϲ�ȣ, �����������, ���� IP ����, ��Ű, ���� �̿� ���, ���� �α�<br>- �����׸� : �����ּ�, ��й�ȣ, �������, ������ȭ��ȣ, �α���ID, �޴���ȭ��ȣ, �̸�, �̸���, ȸ���, ��å, ȸ����ȭ��ȣ, ����, �μ�, �з�, �ֹε�Ϲ�ȣ, �����������, ���� IP ����, ��Ű, ���� �̿� ���, ���� �α�</p><br><br><br><p class="lh6 bs4"><strong>8. ���������� �ı�<em class="emphasis">&lt;(��)�ѱ�����濵��&gt;('�����빫')</em>��(��) ��Ģ������ �������� ó�������� �޼��� ��쿡�� ��ü���� �ش� ���������� �ı��մϴ�. �ı��� ����, ���� �� ����� ������ �����ϴ�.</strong></p><p class="ls2">-�ı�����<br>�̿��ڰ� �Է��� ������ ���� �޼� �� ������ DB�� �Ű���(������ ��� ������ ����) ���� ��ħ �� ��Ÿ ���� ���ɿ� ���� �����Ⱓ ����� �� Ȥ�� ��� �ı�˴ϴ�. �� ��, DB�� �Ű��� ���������� ������ ���� ��찡 �ƴϰ��� �ٸ� �������� �̿���� �ʽ��ϴ�.<br>-�ı����<br>�̿����� ���������� ���������� �����Ⱓ�� ����� ��쿡�� �����Ⱓ�� �����Ϸκ��� 5�� �̳���, ���������� ó�� ���� �޼�, �ش� ������ ����, ����� ���� �� �� ���������� ���ʿ��ϰ� �Ǿ��� ������ ���������� ó���� ���ʿ��� ������ �����Ǵ� ���κ��� 5�� �̳��� �� ���������� �ı��մϴ�.</p><p class="ls2">-�ı���<br>������ ���� ������ ������ ����� ����� �� ���� ����� ����� ����մϴ�.<br>���̿� ��µ� ���������� �м��� �м��ϰų� �Ұ��� ���Ͽ� �ı��մϴ�.</p><br><br><p class="lh6 bs4"><strong>9. ���������� ������ Ȯ�� ��ġ <em class="emphasis">&lt;(��)�ѱ�����濵��&gt;('�����빫')</em>��(��) ����������ȣ�� ��29���� ���� ������ ���� ������ Ȯ���� �ʿ��� �����/������ �� ������ ��ġ�� �ϰ� �ֽ��ϴ�.</strong></p><p class="ls2">1. �������� ��� ������ �ּ�ȭ �� ����<br> ���������� ����ϴ� ������ �����ϰ� ����ڿ� �������� �ּ�ȭ �Ͽ� ���������� �����ϴ� ��å�� �����ϰ� �ֽ��ϴ�.<br><br>2. �������� ��ü ���� �ǽ�<br> �������� ��� ���� ������ Ȯ���� ���� ������(�б� 1ȸ)���� ��ü ���縦 �ǽ��ϰ� �ֽ��ϴ�.<br><br>3. ���ΰ�����ȹ�� ���� �� ����<br> ���������� ������ ó���� ���Ͽ� ���ΰ�����ȹ�� �����ϰ� �����ϰ� �ֽ��ϴ�.<br><br>4. ���������� ��ȣȭ<br> �̿����� ���������� ��й�ȣ�� ��ȣȭ �Ǿ� ���� �� �����ǰ� �־�, ���θ��� �� �� ������ �߿��� �����ʹ� ���� �� ���� �����͸� ��ȣȭ �ϰų� ���� ��� ����� ����ϴ� ���� ���� ���ȱ���� ����ϰ� �ֽ��ϴ�.<br><br>5. ��ŷ � ����� ����� ��å<br> &lt;<em class="emphasis">(��)�ѱ�����濵��</em>&gt;('<em class="emphasis">�����빫</em>')�� ��ŷ�̳� ��ǻ�� ���̷��� � ���� �������� ���� �� �Ѽ��� ���� ���Ͽ� �������α׷��� ��ġ�ϰ� �ֱ����� ���š������� �ϸ� �ܺηκ��� ������ ������ ������ �ý����� ��ġ�ϰ� �����/���������� ���� �� �����ϰ� �ֽ��ϴ�.<br><br>6. ���������� ���� ���� ����<br> ���������� ó���ϴ� �����ͺ��̽��ý��ۿ� ���� ���ٱ����� �ο�,����,���Ҹ� ���Ͽ� ���������� ���� ���������� ���Ͽ� �ʿ��� ��ġ�� �ϰ� ������ ħ�����ܽý����� �̿��Ͽ� �ܺηκ����� ���� ������ �����ϰ� �ֽ��ϴ�.<br><br>7. ���ӱ���� ���� �� ������ ����<br> ��������ó���ý��ۿ� ������ ����� �ּ� 6���� �̻� ����, �����ϰ� ������, ���� ����� ������ �� ����, �нǵ��� �ʵ��� ���ȱ�� ����ϰ� �ֽ��ϴ�.<br><br>8. ���������� ���� �����ġ ���<br> ���������� ���Ե� ����, ���������ü ���� �����ġ�� �ִ� ������ ��ҿ� �����ϰ� �ֽ��ϴ�.<br><br>9. ���ΰ��ڿ� ���� ���� ����<br> ���������� �����ϰ� �ִ� ������ ���� ��Ҹ� ������ �ΰ� �̿� ���� �������� ������ ����, ��ϰ� �ֽ��ϴ�.<br><br></p><br><br><p class="lh6 bs4"><strong>10. �������� ��ȣå���� �ۼ� </strong></p><br> ��  (��)�ѱ�����濵��(��easynomu.com������ �������빫) ��(��) �������� ó���� ���� ������ �Ѱ��ؼ� å������, �������� ó���� ������ ������ü�� �Ҹ�ó�� �� ���ر��� ���� ���Ͽ� �Ʒ��� ���� �������� ��ȣå���ڸ� �����ϰ� �ֽ��ϴ�.<p class="ls2"><br>
								�� �������� ��ȣå���� <br>���� :�����<br>��å :�����<br>���� :����<br>����ó :1544-4519, kcmc4519@naver.com, 055-299-1272<br>�� �������� ��ȣ ���μ��� ����˴ϴ�.<br> <br>
								�� �������� ��ȣ ���μ�<br>�μ��� :�濵������<br>����� :�����<br>����ó :1544-4519, kcmc4519@naver.com, 055-299-1272<br>�� ������ü������ (��)�ѱ�����濵��(��easynomu.com������ �������빫) �� ����(�Ǵ� ���)�� �̿��Ͻø鼭 �߻��� ��� �������� ��ȣ ���� ����, �Ҹ�ó��, ���ر��� � ���� ������ �������� ��ȣå���� �� ���μ��� �����Ͻ� �� �ֽ��ϴ�. (��)�ѱ�����濵��(��easynomu.com������ �������빫) ��(��) ������ü�� ���ǿ� ���� ��ü ���� �亯 �� ó���ص帱 ���Դϴ�.</p><br><br><p class="lh6 bs4"><strong>11. �������� ó����ħ ���� </strong></p><p>�� �� ��������ó����ħ�� �����Ϸκ��� ����Ǹ�, ���� �� ��ħ�� ���� ���泻���� �߰�, ���� �� ������ �ִ� ��쿡�� ��������� ���� 7�� ������ ���������� ���Ͽ� ������ ���Դϴ�.</p><p></p>
							</div>
							<div class="agree_check">
								<input type="checkbox" name="agree_check2" value="Y" <? if($ok == 1) echo "checked"; ?> style="border:0;margin:0 5px 0 0; vertical-align: middle;"><img src="privacy_information/images/safe_agree.png" style="margin: 6px 0; vertical-align: middle;">
							</div>
						</td>
					</tr>
					<tr>
						<td align="" style="padding:5px;border:1px solid #cccccc">
							<span style="font-weight:bold">�� ���꺸��� ���Ұ��� �����</span>
							<p>�����¡���� ��16���� 9 ��4�׿� ���� ������Ḧ �ʰ��ϴ� ���꺸����� ��� 2�����Ͽ� �����˴ϴ�. ���꺸��� �Ͻó��� ���Ͻ� ��� �Ʒ������� �����Ͽ� �ֽñ� �ٶ��ϴ�.</p>
							<p><input type="checkbox" name="chk_divide" value="Y" <? if($row1[chk_divide] == "Y") echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold"> ���Ұ��� �����</span></p>
						</td>
					</tr>
					<tr>
						<td align="" style="padding:4px;border:0px solid #cccccc">
						</td>
					</tr>
					<tr>
						<td align="" style="padding:5px;border:1px solid #cccccc">
							<span style="font-weight:bold">�� ��������� ����û��</span>
							<p>"��뺸�� �� ������غ������� �����¡�� � ���� ���� �����" ��31�� ��2�� ("�ӱ�ä�Ǻ���� ����� ��21��")�� ���� �Ʒ��� ���� ��������Ḧ ��� ��û�մϴ�.
							<br>������ ���纸���, ��뺸��ᰡ ���� ��� ���� ��(<font color="blue">������ �߻��Ǵ�</font>) ������ �� ���� ¡���ݿ� ����Ͽ� �ֽñ� �ٶ��ϴ�.</p>
							<p><input type="checkbox" name="chk_appropriate" value="Y" <? if($row1[chk_appropriate] == "Y") echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold"> ����</span></p>
						</td>
					</tr>
					<tr>
						<td align="center" style="padding:10px 0 0 0">
							<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
								<tr>
									<td width=2></td>
									<td><img src=images/btn_lt.gif></td>
									<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">����</a></td>
									<td><img src=images/btn_rt.gif></td>
								 <td width=2></td>
								</tr>
							</table>
							<div id="save_ing" style="display:none"><img src="images/save_ing.gif"></div>
							<table border=0 cellpadding=0 cellspacing=0 style="display:inline;" id="save_bt">
								<tr>
									<td width=2></td>
									<td><img src=images/btn_lt.gif></td>
									<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData('popup');" target="">����</a></td>
									<td><img src=images/btn_rt.gif></td>
								 <td width=2></td>
								</tr>
							</table>
							<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
							 <tr>
								 <td width=2></td>
									<td><img src=images/btn_lt.gif></td>
									<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:close();" target="">�ݱ�</a></td>
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

</div>
</body>
</html>
