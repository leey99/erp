<? 
$mode = "popup";
$member['mb_id'] = "test";
include_once("_common.php");
//include_once("$g4[path]/lib/popup.lib.php"); 

// �α��� �� ��������� �α���
if($member['mb_id']) {
	$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
	$row_a4 = sql_fetch($sql_a4);
	$row1['comp_name'] = $row_a4['com_name'];
	$row1['comp_adr']  = $row_a4['com_juso']." ".$row_a4['com_juso2'];
	$row1['comp_bznb'] = $row_a4['t_insureno'];
	$row1['comp_tel']  = $row_a4['com_tel'];
	$row1['comp_mail']  = $row_a4['com_mail'];
	$row1['comp_fax']  = $row_a4['com_fax'];
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>4�뺸�� ���/��� �Ű�</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
function checkData() {
	var frm = document.dataForm;
/*
	//alert(frm.quit_count.value);
	if(frm.quit_count.value == 3) {
		if(frm['quit_sum_pre_[]'].value == "") {
			alert("2��° ����� ���⵵�ӱ��Ѿ��� �Է��ϼ���.");
			frm['quit_sum_pre_[]'].focus();
			return;
		}
	}
	if(frm.quit_count.value > 3) {
		if(frm['quit_sum_pre_[]'][0].value == "") {
			alert("2��° ����� ���⵵�ӱ��Ѿ��� �Է��ϼ���.");
			frm['quit_sum_pre_[]'][0].focus();
			return;
		}
		if(frm['quit_sum_pre_[]'][1].value == "") {
			alert("3��° ����� ���⵵�ӱ��Ѿ��� �Է��ϼ���.");
			frm['quit_sum_pre_[]'][1].focus();
			return;
		}
	}
	return;
*/
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
	if (frm.comp_adr.value == "")
	{
		alert("������������ �Է��ϼ���.");
		frm.comp_adr.focus();
		return;
	}
	if (frm.comp_tel.value == "")
	{
		alert("��ȭ��ȣ(�����)�� �Է��ϼ���.");
		frm.comp_tel.focus();
		return;
	}
	if (frm.comp_email.value == "")
	{
		alert("�̸����� �Է��ϼ���.");
		frm.comp_email.focus();
		return;
	}
	if (!frm.join_ok.checked && !frm.quit_ok.checked)
	{
		alert("�Ի��� �Ǵ� ����� ������ �Է��ϼ���.");
		frm.join_ok.focus();
		return;
	}

	if(frm.join_ok.checked) {

		if (frm.join_name.value == "")
		{
			alert("����(�Ի���)�� �Է��ϼ���.");
			frm.join_name.focus();
			return;
		}
		if (frm.join_ssnb.value == "")
		{
			alert("�ֹε�Ϲ�ȣ(�Ի���)�� �Է��ϼ���.");
			frm.join_ssnb.focus();
			return;
		}
		if (frm.join_date.value == "")
		{
			alert("�Ի����� �Է��ϼ���.");
			frm.join_date.focus();
			return;
		}
		if (frm.join_jikjong.value == "")
		{
			alert("������ �Է��ϼ���.");
			frm.join_jikjong.focus();
			return;
		}
		if (frm.join_time.value == "")
		{
			alert("�ּ����ٷνð��� �Է��ϼ���.");
			frm.join_time.focus();
			return;
		}
		if (frm.join_salary.value == "")
		{
			alert("���ӱ��� �Է��ϼ���.");
			frm.join_salary.focus();
			return;
		}
		//alert(frm.isgy.checked);
		if (!frm.isgy.checked && !frm.issj.checked && !frm.iskm.checked && !frm.isgg.checked)
		{
			alert("�������뿩�θ� ������ �ּ���.");
			frm.isgy.focus();
			return;
		}
	}
	//����� üũ
	if(frm.quit_ok.checked) {
		if (frm.quit_name.value == "")
		{
			alert("����(�����)�� �Է��ϼ���.");
			frm.quit_name.focus();
			return;
		}
		if (frm.quit_ssnb.value == "")
		{
			alert("�ֹε�Ϲ�ȣ(�����)�� �Է��ϼ���.");
			frm.quit_ssnb.focus();
			return;
		}
		if (frm.quit_tel.value == "")
		{
			alert("��ȭ��ȣ(�����)�� �Է��ϼ���.");
			frm.quit_tel.focus();
			return;
		}
		if (frm.quit_date.value == "")
		{
			alert("�������ٹ����� �Է��ϼ���.");
			frm.quit_date.focus();
			return;
		}
		if (frm.quit_cause.value == "")
		{
			alert("���������� �Է��ϼ���.");
			frm.quit_cause.focus();
			return;
		}
		if (frm.quit_sum_now.value == "")
		{
			alert("�ش翬���ӱ��Ѿ��� �Է��ϼ���.");
			frm.quit_sum_now.focus();
			return;
		}
		if (frm.quit_sum_now_month.value == "")
		{
			alert("�ش翬���ӱ��Ѿ� ���������� �Է��ϼ���.");
			frm.quit_sum_now_month.focus();
			return;
		}
/*
		if (frm.quit_3month.value == "")
		{
			alert("������3������ ����ӱ��� �Է��ϼ���.");
			frm.quit_3month.focus();
			return;
		}
*/
		if (frm.quit_sum_pre.value == "")
		{
			alert("���⵵�ӱ��Ѿ��� �Է��ϼ���.");
			frm.quit_sum_pre.focus();
			return;
		}
		if (frm.quit_sum_pre_month.value == "")
		{
			alert("���⵵�ӱ��Ѿ� ���������� �Է��ϼ���.");
			frm.quit_sum_pre_month.focus();
			return;
		}
		//����� �߰�
		if(frm.quit_count.value == 3) {
			if(frm['quit_name_[]'].value != "") {
				if(frm['quit_ssnb_[]'].value == "") {
					alert("2��° ����� �ֹε�Ϲ�ȣ�� �Է��ϼ���.");
					frm['quit_ssnb_[]'].focus();
					return;
				}
				if(frm['quit_tel_[]'].value == "") {
					alert("2��° ����� ��ȭ��ȣ�� �Է��ϼ���.");
					frm['quit_tel_[]'].focus();
					return;
				}
				if(frm['quit_date_[]'].value == "") {
					alert("2��° ����� �������ٹ����� �Է��ϼ���.");
					frm['quit_date_[]'].focus();
					return;
				}
				if(frm['quit_cause_[]'].value == "") {
					alert("2��° ����� ���������� �Է��ϼ���.");
					frm['quit_cause_[]'].focus();
					return;
				}
				if(frm['quit_sum_now_[]'].value == "") {
					alert("2��° ����� �ش翬���ӱ��Ѿ��� �Է��ϼ���.");
					frm['quit_sum_now_[]'].focus();
					return;
				}
				if(frm['quit_sum_now_month_[]'].value == "") {
					alert("2��° ����� �ش翬���ӱ��Ѿ� ���������� �Է��ϼ���.");
					frm['quit_sum_now_month_[]'].focus();
					return;
				}
/*
				if(frm['quit_3month_[]'].value == "") {
					alert("2��° ������3������ ����ӱ��� �Է��ϼ���.");
					frm['quit_3month_[]'].focus();
					return;
				}
*/
				if(frm['quit_sum_pre_[]'].value == "") {
					alert("2��° ����� ���⵵�ӱ��Ѿ��� �Է��ϼ���.");
					frm['quit_sum_pre_[]'].focus();
					return;
				}
				if(frm['quit_sum_pre_month_[]'].value == "") {
					alert("2��° ����� ���⵵�ӱ��Ѿ� ���������� �Է��ϼ���.");
					frm['quit_sum_pre_month_[]'].focus();
					return;
				}
			}
		}
		if(frm.quit_count.value > 3) {
			if(frm['quit_name_[]'][0].value != "") {
				if(frm['quit_ssnb_[]'][0].value == "") {
					alert("2��° ����� �ֹε�Ϲ�ȣ�� �Է��ϼ���.");
					frm['quit_ssnb_[]'][0].focus();
					return;
				}
				if(frm['quit_tel_[]'][0].value == "") {
					alert("2��° ����� ��ȭ��ȣ�� �Է��ϼ���.");
					frm['quit_tel_[]'][0].focus();
					return;
				}
				if(frm['quit_date_[]'][0].value == "") {
					alert("2��° ����� �������ٹ����� �Է��ϼ���.");
					frm['quit_date_[]'][0].focus();
					return;
				}
				if(frm['quit_cause_[]'][0].value == "") {
					alert("2��° ����� ���������� �Է��ϼ���.");
					frm['quit_cause_[]'][0].focus();
					return;
				}
				if(frm['quit_sum_now_[]'][0].value == "") {
					alert("2��° ����� �ش翬���ӱ��Ѿ��� �Է��ϼ���.");
					frm['quit_sum_now_[]'][0].focus();
					return;
				}
				if(frm['quit_sum_now_month_[]'][0].value == "") {
					alert("2��° ����� �ش翬���ӱ��Ѿ� ���������� �Է��ϼ���.");
					frm['quit_sum_now_month_[]'][0].focus();
					return;
				}
/*
				if(frm['quit_3month_[]'][0].value == "") {
					alert("2��° ������3������ ����ӱ��� �Է��ϼ���.");
					frm['quit_3month_[]'][0].focus();
					return;
				}
*/
				if(frm['quit_sum_pre_[]'][0].value == "") {
					alert("2��° ����� ���⵵�ӱ��Ѿ��� �Է��ϼ���.");
					frm['quit_sum_pre_[]'][0].focus();
					return;
				}
				if(frm['quit_sum_pre_month_[]'][0].value == "") {
					alert("2��° ����� ���⵵�ӱ��Ѿ� ���������� �Է��ϼ���.");
					frm['quit_sum_pre_month_[]'][0].focus();
					return;
				}
			}
			if(frm['quit_name_[]'][1].value != "") {
				if(frm['quit_ssnb_[]'][1].value == "") {
					alert("3��° ����� �ֹε�Ϲ�ȣ�� �Է��ϼ���.");
					frm['quit_ssnb_[]'][1].focus();
					return;
				}
				if(frm['quit_tel_[]'][1].value == "") {
					alert("3��° ����� ��ȭ��ȣ�� �Է��ϼ���.");
					frm['quit_tel_[]'][1].focus();
					return;
				}
				if(frm['quit_date_[]'][1].value == "") {
					alert("3��° ����� �������ٹ����� �Է��ϼ���.");
					frm['quit_date_[]'][1].focus();
					return;
				}
				if(frm['quit_cause_[]'][1].value == "") {
					alert("3��° ����� ���������� �Է��ϼ���.");
					frm['quit_cause_[]'][1].focus();
					return;
				}
				if(frm['quit_sum_now_[]'][1].value == "") {
					alert("3��° ����� �ش翬���ӱ��Ѿ��� �Է��ϼ���.");
					frm['quit_sum_now_[]'][1].focus();
					return;
				}
				if(frm['quit_sum_now_month_[]'][1].value == "") {
					alert("3��° ����� �ش翬���ӱ��Ѿ� ���������� �Է��ϼ���.");
					frm['quit_sum_now_month_[]'][1].focus();
					return;
				}
/*
				if(frm['quit_3month_[]'][1].value == "") {
					alert("3��° ������3������ ����ӱ��� �Է��ϼ���.");
					frm['quit_3month_[]'][1].focus();
					return;
				}
*/
				if(frm['quit_sum_pre_[]'][1].value == "") {
					alert("3��° ����� ���⵵�ӱ��Ѿ��� �Է��ϼ���.");
					frm['quit_sum_pre_[]'][1].focus();
					return;
				}
				if(frm['quit_sum_pre_month_[]'][1].value == "") {
					alert("3��° ����� ���⵵�ӱ��Ѿ� ���������� �Է��ϼ���.");
					frm['quit_sum_pre_month_[]'][1].focus();
					return;
				}
			}
			if(frm.quit_count.value > 4) {
				if(frm['quit_name_[]'][2].value != "") {
					if(frm['quit_ssnb_[]'][2].value == "") {
						alert("4��° ����� �ֹε�Ϲ�ȣ�� �Է��ϼ���.");
						frm['quit_ssnb_[]'][2].focus();
						return;
					}
					if(frm['quit_tel_[]'][2].value == "") {
						alert("4��° ����� ��ȭ��ȣ�� �Է��ϼ���.");
						frm['quit_tel_[]'][2].focus();
						return;
					}
					if(frm['quit_date_[]'][2].value == "") {
						alert("4��° ����� �������ٹ����� �Է��ϼ���.");
						frm['quit_date_[]'][2].focus();
						return;
					}
					if(frm['quit_cause_[]'][2].value == "") {
						alert("4��° ����� ���������� �Է��ϼ���.");
						frm['quit_cause_[]'][2].focus();
						return;
					}
					if(frm['quit_sum_now_[]'][2].value == "") {
						alert("4��° ����� �ش翬���ӱ��Ѿ��� �Է��ϼ���.");
						frm['quit_sum_now_[]'][2].focus();
						return;
					}
					if(frm['quit_sum_now_month_[]'][2].value == "") {
						alert("4��° ����� �ش翬���ӱ��Ѿ� ���������� �Է��ϼ���.");
						frm['quit_sum_now_month_[]'][2].focus();
						return;
					}
/*
					if(frm['quit_3month_[]'][2].value == "") {
						alert("4��° ������3������ ����ӱ��� �Է��ϼ���.");
						frm['quit_3month_[]'][2].focus();
						return;
					}
*/
					if(frm['quit_sum_pre_[]'][2].value == "") {
						alert("4��° ����� ���⵵�ӱ��Ѿ��� �Է��ϼ���.");
						frm['quit_sum_pre_[]'][2].focus();
						return;
					}
					if(frm['quit_sum_pre_month_[]'][2].value == "") {
						alert("4��° ����� ���⵵�ӱ��Ѿ� ���������� �Է��ϼ���.");
						frm['quit_sum_pre_month_[]'][2].focus();
						return;
					}
				}
				if(frm.quit_count.value > 5) {
					if(frm['quit_name_[]'][3].value != "") {
						if(frm['quit_ssnb_[]'][3].value == "") {
							alert("5��° ����� �ֹε�Ϲ�ȣ�� �Է��ϼ���.");
							frm['quit_ssnb_[]'][3].focus();
							return;
						}
						if(frm['quit_tel_[]'][3].value == "") {
							alert("5��° ����� ��ȭ��ȣ�� �Է��ϼ���.");
							frm['quit_tel_[]'][3].focus();
							return;
						}
						if(frm['quit_date_[]'][3].value == "") {
							alert("5��° ����� �������ٹ����� �Է��ϼ���.");
							frm['quit_date_[]'][3].focus();
							return;
						}
						if(frm['quit_cause_[]'][3].value == "") {
							alert("5��° ����� ���������� �Է��ϼ���.");
							frm['quit_cause_[]'][3].focus();
							return;
						}
						if(frm['quit_sum_now_[]'][3].value == "") {
							alert("5��° ����� �ش翬���ӱ��Ѿ��� �Է��ϼ���.");
							frm['quit_sum_now_[]'][3].focus();
							return;
						}
						if(frm['quit_sum_now_month_[]'][3].value == "") {
							alert("5��° ����� �ش翬���ӱ��Ѿ� ���������� �Է��ϼ���.");
							frm['quit_sum_now_month_[]'][3].focus();
							return;
						}
/*
						if(frm['quit_3month_[]'][3].value == "") {
							alert("4��° ������3������ ����ӱ��� �Է��ϼ���.");
							frm['quit_3month_[]'][3].focus();
							return;
						}
*/
						if(frm['quit_sum_pre_[]'][3].value == "") {
							alert("5��° ����� ���⵵�ӱ��Ѿ��� �Է��ϼ���.");
							frm['quit_sum_pre_[]'][3].focus();
							return;
						}
						if(frm['quit_sum_pre_month_[]'][3].value == "") {
							alert("5��° ����� ���⵵�ӱ��Ѿ� ���������� �Է��ϼ���.");
							frm['quit_sum_pre_month_[]'][3].focus();
							return;
						}
					}
				}
			}
		}
	}
	document.getElementById('save_bt').style.display = "none";
	document.getElementById('save_ing').style.display = "inline";

	frm.action = "4insure_update.php";
	frm.submit();
	return;
}
function join_ok_func() {
	var frm = document.dataForm;
	if(!frm.join_ok.checked) frm.join_ok.checked = true;
}
function quit_ok_func() {
	var frm = document.dataForm;
	if(!frm.quit_ok.checked) frm.quit_ok.checked = true;
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
	if (inputVal.length > 3){
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
		for(i=chk; i>0; i--){
			triple = i * 3;					// 3�� ��� ��� 9,6,3 ��� ���� ������
			end = Number(input.length)-Number(triple);	// �� ���� end ���� ���� �þ� ���� �ȴ�.
			total += input.substring(start,end)+",";	// total�� �տ��� ���� ���ʷ� ���δ�.
			start = end;					// end ���� �������� start ������ ����.
		}
		total +=input.substring(start,input.length);		// ���������� ������ 3�ڸ� ���� �ڿ� ������.
	} else {
		total = inputVal;					// 3�� ����� �Ǳ� �������� ���� �״�� �����ȴ�.
	}
	if(keydown =='Y'){
		type.value=total;					// type �� ���� �������� �־� �ش�.
	}else if(keydown =='N'){
		return total
	}
	return total
}
function delCom(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
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
	//Ű���� ��� ����Ű
	if (event.keyCode < 48 || event.keyCode > 57) {
		//Ű���� ���� ����Ű
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16 , Ctrl+V , Ctrl+C
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16 && !(event.ctrlKey  == true && event.keyCode == 86) && !(event.ctrlKey  == true && event.keyCode == 67)) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function open_comp(frm_name) {
	if(frm_name == 2) frm = document.dataForm2;
	else frm = document.dataForm;
	n = frm.comp_bznb.value;
	if(frm.comp_bznb.value == "") {
		alert("����ڵ�Ϲ�ȣ�� �Է� �� �˻��� �ֽʽÿ�.");
		frm.comp_bznb.focus();
		return;
	}
	window.open("popup/comp_bznb_popup.php?comp_bznb="+n+"&frm="+frm_name, "comp_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function open_jikjong(n) {
	window.open("popup/jikjong_popup.php?n=_"+n, "jikjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function iframe_focus(rowNum,nhicRowNum) {
	//���Լ�
}
function value_set(n,m) {
	//���Լ�
}
//����ڵ�Ϲ�ȣ �ڵ� ������
function checkBznb(inputVal, type, keydown, frm) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	if(frm == 2) main = document.dataForm2;
	else main = document.dataForm;
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
				type.value=total;					// type �� ���� �������� �־� �ش�.
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
//DIV ���� ����
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
	}
}
//�Ǹ޴� ����
function tab_show(tab) {
	var frm = document.dataForm;
	frm.tab.value = tab;
	document.getElementById(tab).style.display="";
	if(tab == "tab1") {
		document.getElementById('tab2').style.display="none";
		document.getElementById('tab_img1').src="./images/4insure_tab01_on.gif";
		document.getElementById('tab_img2').src="./images/4insure_tab02_off.gif";
	} else {
		document.getElementById('tab1').style.display="none";
		document.getElementById('tab_img1').src="./images/4insure_tab01_off.gif";
		document.getElementById('tab_img2').src="./images/4insure_tab02_on.gif";
	}
}
//����պ��� ���� �Ű�
function checkData2() {
	//alert("�غ����Դϴ�.");
	//return;
	var frm = document.dataForm2;
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
	if (frm.comp_adr.value == "")
	{
		alert("������������ �Է��ϼ���.");
		frm.comp_adr.focus();
		return;
	}
	if (frm.comp_tel.value == "")
	{
		alert("��ȭ��ȣ(�����)�� �Է��ϼ���.");
		frm.comp_tel.focus();
		return;
	}
	if (frm.comp_email.value == "")
	{
		alert("�̸����� �Է��ϼ���.");
		frm.comp_email.focus();
		return;
	}
	if (frm.modify_name.value == "")
	{
		alert("������ �Է��ϼ���.");
		frm.modify_name.focus();
		return;
	}
	if (frm.modify_ssnb.value == "")
	{
		alert("�ֹε�Ϲ�ȣ�� �Է��ϼ���.");
		frm.modify_ssnb.focus();
		return;
	}
	if (frm.modify_salary.value == "")
	{
		alert("���� �� ����պ����� �Է��ϼ���.");
		frm.modify_salary.focus();
		return;
	}
	if (frm.modify_date.value == "")
	{
		alert("���� ���� ������ �Է��ϼ���.");
		frm.modify_date.focus();
		return;
	}
	if (!frm.misgy.checked && !frm.missj.checked && !frm.miskm.checked && !frm.misgg.checked)
	{
		alert("�������뿩�θ� ������ �ּ���.");
		frm.misgy.focus();
		return;
	}
	if (frm.modify_reason.value == "")
	{
		alert("��������� �Է��ϼ���.");
		frm.modify_reason.focus();
		return;
	}
	document.getElementById('save_bt2').style.display = "none";
	document.getElementById('save_ing2').style.display = "inline";
	frm.action = "4insure_update_a4_modify.php";
	frm.submit();
	return;
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
	//����� �˸�
	if(obj.name == "quit_date") {
		//alert("�뵿���� �Ű�Ǵ� ������� ������ �ٹ��� ���� ��¥�� �Ű�˴ϴ�.\nex) ������ �ٹ����� 2�� 28���̸� 3�� 1�Ϸ� ������� �Ű��ؾ� ���ܿ� �Ű�Ǵ� ������� 2�� 28�Ϸ� �Ű�˴ϴ�.");
	}
}
</script>
<div style="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="200"><img src="images/logo_kidsnomu.png" /></td>
						<td width="700" style="padding-top:10px">
							<table width="90%" border="0" cellpadding="0" cellspacing="0" id="tables">
								<tr>
									<td>
										<div align="right" class="">
											[ �ѱ�����濵�� ]&nbsp;&nbsp;&nbsp;
											���Ŵ��� : ������&nbsp;&nbsp;&nbsp;
											TEL : 070-4680-7050&nbsp;&nbsp;&nbsp;
											<!--���� : 02-1111-1111&nbsp;&nbsp;&nbsp;-->
											FAX : 055-299-1272 <br>0505-609-0001
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
			<td style="background:#ef8036;height:9px"></td>
		</tr>
	</table>
</div>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" style="padding:10px 10px 10px 10px">

			<!--�Ǹ޴� -->
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_03"> 
						<a href="javascript:tab_show('tab1');"><img src="./images/4insure_tab01_on.gif" border="0" id="tab_img1"></a>
					</td> 
					<td width=2></td> 
					<td id="Tab_cust_tab_04"> 
						<a href="javascript:tab_show('tab2');"><img src="./images/4insure_tab02_off.gif" border="0" id="tab_img2"></a>
					</td> 
					<td width=10></td> 
					<td>���ÿ� �Ű� ���� �ʽ��ϴ�. �Ű��Ͻð��� �ϴ� ȭ�鿡�� �Է� �� "����" ��ư�� Ŭ���Ͽ� �ֽʽÿ�.</td>
				</tr> 
			</table>
			<div style="height:2px;font-size:0px" class="bgtr_tab"></div>
			<div style="height:10px;font-size:0px"></div>
			<div id="tab1">
				<!--Ÿ��Ʋ -->
				<table width="100%" border=0 cellspacing=0 cellpadding=0>
					<tr>     
						<td height="18">
							<table width=100% border=0 cellspacing=0 cellpadding=0>
								<tr>
									<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:8pt;color:black;'>4�뺸�� ���/��� �Ű�</span>
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
				<form name="dataForm" method="post" enctype="multipart/form-data">
					<input type="hidden" name="mode" value="<?=$mode?>">
					<input type="hidden" name="join_count" value="2">
					<input type="hidden" name="quit_count" value="2">
					<input type="hidden" name="tab" value="<?=$tab?>">
					<input type="hidden" name="user_id" value="<?=$member['mb_id']?>">
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
							<td valign="bottom"></td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--�˻� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
						<col width="15%">
						<col width="35%">
						<col width="15%">
						<col width="35%">
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����ڵ�Ϲ�ȣ<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_bznb" id="comp_bznb" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_bznb']?>" maxlength="12" onkeydown="only_number()"  onkeyup="checkBznb(this.value, this,'Y')" >
								<label onclick="open_comp();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
								��) 123-12-12345
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����������<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_adr" id="comp_adr" type="text" class="textfm" style="width:250px;" value="<?=$row1['comp_adr']?>" maxlength="50">
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������Ī<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_name" id="comp_name" type="text" class="textfm" style="width:210px;" value="<?=$row1['comp_name']?>" maxlength="25">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_tel" id="comp_tel" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_tel']?>" maxlength="15"> ��) 055-1234-1234
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�̸���<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_email" id="comp_email" type="text" class="textfm" style="width:210px;" value="<?=$row1['comp_mail']?>" maxlength="30">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ѽ���ȣ<font color="red"></font></td>
							<td nowrap class="tdrow">
								<input name="comp_fax" id="comp_fax" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_fax']?>" maxlength="15"> ��) 055-1234-1234
							</td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<table border=0 cellspacing=0 cellpadding=0> 
						<tr> 
							<td style="background-color:#8db41d" valign="top"> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center;'>�Ի���</td> 
										<td><img src="images/g_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=2></td> 
							<td valign="bottom"> <input type="checkbox" name="join_ok" value="1" class="checkbox" style="height:18px"> </td> 
							<td valign="bottom">�Ի��� �Է½� üũ���ֽʽÿ�.</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--�˻� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
						<col width="20%">
						<col width="30%">
						<col width="20%">
						<col width="30%">
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_name" type="text" class="textfm" style="width:150px;" value="" maxlength="25" onclick="join_ok_func()">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_ssnb" type="text" class="textfm" style="width:100px;" onkeypress="only_number_hyphen()" value="" maxlength="14"> ��) 123456-1234567
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�Ի���<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_date" type="text" class="textfm5" readonly style="width:80px;" value="" maxlength="10">
								<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.join_date);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_jikjong_code" id="join_jikjong_code_undefined" type="text" class="textfm" style="width:30px;" value="" maxlength="3" readonly>
								<input name="join_jikjong" id="join_jikjong_undefined" type="text" class="textfm" style="width:180px;" value="" maxlength="25" readonly>
								<label onclick="open_jikjong();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ּ����ٷνð�<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_time" type="text" class="textfm" style="width:100px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="4">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���ӱ�<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="join_salary" type="text" class="textfm" style="width:150px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="25" onkeyup="checkThousand(this.value, this,'Y')">
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������뿩��<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input type="checkbox" name="isgy" value="1" class="checkbox" checked> ���
								<input type="checkbox" name="issj" value="1" class="checkbox" checked> ����
								<input type="checkbox" name="iskm" value="1" class="checkbox" checked> ����
								<input type="checkbox" name="isgg" value="1" class="checkbox" checked> �ǰ�
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���<font color="red"></font></td>
							<td nowrap class="tdrow">
								<input name="join_note" type="text" class="textfm" style="width:150px;" value="" maxlength="25">
							</td>
						</tr>
					</table>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<table border=0 cellspacing=0 cellpadding=0> 
						<tr>
							<td id=""> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/sb_tab_on_lt.gif"></td> 
										<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
											<a href="javascript:tab_view('children');">�Ǻξ��� ���</a>
										</td> 
										<td><img src="images/sb_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=6></td> 
							<td valign="middle"></td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px;background-color:#226bd4"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--��޴� -->
					<div id="children" style="display:none">
						<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
							<col width="10%">
							<col width="10%">
							<col width="20%">
							<col width="10%">
							<col width="10%">
							<col width="10%">
							<col width="20%">
							<col width="10%">
							<tr>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���ſ���</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ</td>
								<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���ſ���</td>
							</tr>
							<tr>
								<td nowrap class="tdrow">
									<input name="children_relation" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation" type="checkbox" value="1" class="checkbox"> ����
								</td>
								<td nowrap class="tdrow">
									<input name="children_relation2" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name2" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb2" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation2" type="checkbox" value="1" class="checkbox"> ����
								</td>
							</tr>
							<tr>
								<td nowrap class="tdrow">
									<input name="children_relation3" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name3" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb3" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation3" type="checkbox" value="1" class="checkbox"> ����
								</td>
								<td nowrap class="tdrow">
									<input name="children_relation4" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name4" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb4" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation4" type="checkbox" value="1" class="checkbox"> ����
								</td>
							</tr>
							<tr>
								<td nowrap class="tdrow">
									<input name="children_relation5" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name5" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb5" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation5" type="checkbox" value="1" class="checkbox"> ����
								</td>
								<td nowrap class="tdrow">
									<input name="children_relation6" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_name6" type="text" class="textfm" style="width:80px;" value="" maxlength="10">
								</td>
								<td nowrap class="tdrow">
									<input name="children_ssnb6" type="text" class="textfm" style="width:120px;" value="" maxlength="14">
								</td>
								<td nowrap class="tdrow">
									<input name="children_cohabitation6" type="checkbox" value="1" class="checkbox"> ����
								</td>
							</tr>
						</table>
					</div>

					<div style="height:5px;font-size:0px;line-height:0px;"></div>

					<script language="javascript">
					function join_plus(n){
						var frm = document.dataForm;
						if(frm.join_count.value > 5) {
							alert("�ѹ��� �Ű��� �� �ִ� �ο��� 5����� �Դϴ�.");
							return false;
						} else { 
							document.getElementById('join_add_div').style.display = "";
							var Tbl = document.getElementById('join_optable'); 
							tRow = Tbl.insertRow();//tr �߰�
							tCell = tRow.insertCell();//td �߰�
							tCell.className = "tdrowk";
							tCell.colSpan = 2; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_name_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\"\" maxlength=\"25\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_ssnb_[]\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\"\" maxlength=\"14\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�Ի���<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_date_[]\" type=\"text\" class=\"textfm5\" readonly style=\"width:80px;\" value=\"\" maxlength=\"10\" onclick=\"loadCalendar(this);\"> �� <font color=\"red\">Ŭ���� �޷� ǥ��</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_jikjong_code_[]\" id=\"join_jikjong_code_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:30px;\" value=\"\" maxlength=\"3\" readonly><input name=\"join_jikjong_[]\" id=\"join_jikjong_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:180px;\" value=\"\" maxlength=\"25\" readonly><label onclick=\"open_jikjong("+n+");\" style=\"cursor:pointer\"><img src=\"images/search_bt.png\" align=absmiddle></label>";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ּ����ٷνð�<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_time_[]\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\"\" maxlength=\"4\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���ӱ�<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_salary_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, this,'Y')\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�������뿩��<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input type=\"checkbox\" name=\"isgy_[]\" value=\"1\" class=\"checkbox\" checked> ��� <input type=\"checkbox\" name=\"issj_[]\" value=\"1\" class=\"checkbox\" checked> ���� <input type=\"checkbox\" name=\"iskm_[]\" value=\"1\" class=\"checkbox\" checked> ���� <input type=\"checkbox\" name=\"isgg_[]\" value=\"1\" class=\"checkbox\" checked> �ǰ�";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"join_note_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\"\" maxlength=\"25\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���ſ���<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���ſ���<font color=\"red\"></font>";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_relation1_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_name1_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_ssnb1_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_cohabitation1_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> ����";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_relation2_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_name2_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_ssnb2_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_cohabitation2_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> ����";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_relation3_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_name3_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_ssnb3_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_cohabitation3_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> ����";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_relation4_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_name4_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_ssnb4_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"children_cohabitation4_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> ����";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_relation5_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_name5_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_ssnb5_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_cohabitation5_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> ����";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_relation6_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_name6_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\"\" maxlength=\"10\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_ssnb6_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\"\" maxlength=\"14\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"children_cohabitation6_[]\" type=\"checkbox\" value=\"1\" class=\"checkbox\"> ����";

							frm.join_count.value++;
							//alert(frm.join_count.value);
						} 
					}

					function quit_plus(n){
						var frm = document.dataForm;
						var quit_cause_option = "<option value=\"11\">���λ������� ���� �������</option><option value=\"12\">����� ����, �ٷ����Ǻ���, �ӱ�ü�� ������ �������</option><option value=\"22\">���, ����</option><option value=\"23\">�濵�� �ʿ� �� ȸ���Ȳ���� ���Ѱ��� � ���� ���(�Ǿ��޿�)</option><option value=\"26\">�ٷ����� ��å������ ���� ¡���ذ�, �ǰ����</option><option value=\"31\">����</option><option value=\"32\">��ุ��, ��������</option><option value=\"41\">��뺸�� ������, ���߰��</option><option value=\"98\">�Ҹ����� �ϰ�����</option><option value=\"99\">���ٿ� ���� ����</option>";
						if(frm.quit_count.value > 5) {
							alert("�ѹ��� �Ű��� �� �ִ� �ο��� 5����� �Դϴ�.");
							return false;
						} else { 
							document.getElementById('quit_add_div').style.display = "";
							var Tbl = document.getElementById('quit_optable'); 
							tRow = Tbl.insertRow();//tr �߰�
							tCell = tRow.insertCell();//td �߰�
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_name_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;\" value=\"\" maxlength=\"25\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_ssnb_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;\" value=\"\" maxlength=\"25\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">��ȭ��ȣ<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_tel_[]\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\"\" maxlength=\"15\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�������ٹ���<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_date_[]\" type=\"text\" class=\"textfm5\" readonly style=\"width:80px;\" value=\"\" maxlength=\"10\" onclick=\"loadCalendar(this);\"> �� <font color=\"red\">Ŭ���� �޷� ǥ��</font>";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">��������<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<select name=\"quit_cause_[]\" class=\"selectfm\" style=\"width:100%\"><option value=\"\">�����ϼ���</option>"+quit_cause_option+"</select>";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ش翬���ӱ��Ѿ�<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_sum_now_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, this,'Y')\"> �������� <input name=\"quit_sum_now_month_[]\" type=\"text\" class=\"textfm\" style=\"width:30px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"2\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">������3������ ����ӱ�<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_3month_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, this,'Y')\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���⵵�ӱ��Ѿ�<font color=\"red\">*</font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.innerHTML = "<input name=\"quit_sum_pre_[]\" type=\"text\" class=\"textfm\" style=\"width:130px;ime-mode:inactive;\" onclick=\"\" onkeypress=\"only_number()\" value=\"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, this,'Y')\"> �������� <input name=\"quit_sum_pre_month_[]\" type=\"text\" class=\"textfm\" style=\"width:30px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"2\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk_end"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">÷������<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"filename"+n+"\" type=\"file\" class=\"textfm_search\" style=\"width:220px;\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk_end"; 
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.innerHTML = "<input name=\"quit_note_[]\" type=\"text\" class=\"textfm\" style=\"width:100%;\" value=\"\" maxlength=\"25\">";

							frm.quit_count.value++;
							//alert(frm.join_count.value);
						} 
					}
					</script>

					<div id="join_add_div" style="display:none">
						<table border=0 cellspacing=0 cellpadding=0> 
							<tr> 
								<td id=""> 
									<table border=0 cellpadding=0 cellspacing=0> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif"></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
											�Ի���(�߰�)
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
					</div>
					<!--�˻� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed" id="join_optable">
						<col width="10%">
						<col width="10%">
						<col width="20%">
						<col width="10%">
						<col width="10%">
						<col width="10%">
						<col width="20%">
						<col width="10%">
					</table>
	 
					<div style="height:5px;font-size:0px;line-height:0px;"></div>
					<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
						<tr>
							<td width=2></td>
							<td><img src="images/btn_lt.gif"></td>        
							<td background="images/btn_bg.gif" class=ftbutton1 nowrap><label onclick="join_plus(document.dataForm.join_count.value);" style="cursor:pointer">�Ի��� �߰�</label></td>
							<td><img src="images/btn_rt.gif"></td>
							<td width=2></td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<table border=0 cellspacing=0 cellpadding=0> 
						<tr> 
							<td style="background-color:#8db41d" valign="top"> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'>�����</td> 
										<td><img src="images/g_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=2></td> 
							<td valign="bottom"> <input type="checkbox" name="quit_ok" value="1" class="checkbox" style="height:18px"> </td>
							<td valign="bottom">����� �Է½� üũ���ֽʽÿ�.</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--�˻� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
						<col width="20%">
						<col width="30%">
						<col width="20%">
						<col width="30%">
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_name" type="text" class="textfm" style="width:130px;" value="" maxlength="25" onclick="quit_ok_func()">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_ssnb" type="text" class="textfm" style="width:130px;" value="" maxlength="14">
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_tel" type="text" class="textfm" style="width:100px;" value="" maxlength="15"> ��) 055-1234-1234
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������ٹ���<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_date" type="text" class="textfm5" readonly style="width:80px;" value="" maxlength="25">
								<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.quit_date);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
								<!--<span style="color:red;font-weight:bold;">(������ �ٹ� ������)</span>-->
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��������<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<select name="quit_cause" class="selectfm" style="width:100%">
									<option value="">�����ϼ���</option>
									<option value="11">���λ������� ���� �������</option>
									<option value="12">����� ����, �ٷ����Ǻ���, �ӱ�ü�� ������ �������</option>
									<option value="22">���, ����</option>
									<option value="23">�濵�� �ʿ� �� ȸ���Ȳ���� ���Ѱ��� � ���� ���(�Ǿ��޿�)</option>
									<option value="26">�ٷ����� ��å������ ���� ¡���ذ�, �ǰ����</option>
									<option value="31">����</option>
									<option value="32">��ุ��, ��������</option>
									<option value="41">��뺸�� ������, ���߰��</option>
									<option value="98">�Ҹ����� �ϰ�����</option>
									<option value="99">���ٿ� ���� ����</option>
								</select>
							</td>
							<td nowrap class="tdrowk" style="padding-top:4px;padding-bottom:4px;"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0"><b style="color:red;">�ش翬��</b>�ӱ��Ѿ�(<?=date("Y")?>��)<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_sum_now" type="text" class="textfm" style="width:130px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="25" onkeyup="checkThousand(this.value, this,'Y')"> ��������
								<input name="quit_sum_now_month" type="text" class="textfm" style="width:30px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="2"> 
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������3������ ����ӱ�<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_3month" type="text" class="textfm" style="width:130px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="25" onkeyup="checkThousand(this.value, this,'Y')">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0"><b style="color:red;">���⵵</b>�ӱ��Ѿ�(<?=date("Y", strtotime("-1 year"))?>��)<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="quit_sum_pre" type="text" class="textfm" style="width:130px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="25" onkeyup="checkThousand(this.value, this,'Y')"> ��������
								<input name="quit_sum_pre_month" type="text" class="textfm" style="width:30px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="2"> 
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">÷������<font color="red"></font></td>
							<td nowrap class="tdrow">
								<input name="filename" type="file" class="textfm_search" style="width:220px;">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���<font color="red"></font></td>
							<td nowrap class="tdrow">
								<input name="quit_note" type="text" class="textfm" style="width:100%;" value="" maxlength="25">
							</td>
						</tr>
					</table>
					<div style="height:5px;font-size:0px;line-height:0px;"></div>

					<div id="quit_add_div" style="display:none">
					<table border=0 cellspacing=0 cellpadding=0> 
						<tr> 
							<td id=""> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
										�����(�߰�)
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
					</div>
					<!--�˻� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed" id="quit_optable">
						<col width="20%">
						<col width="30%">
						<col width="20%">
						<col width="30%">
					</table>
	 
					<div style="height:5px;font-size:0px;line-height:0px;"></div>
					<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
						<tr>
							<td width=2></td>
							<td><img src="images/btn_lt.gif"></td>        
							<td background="images/btn_bg.gif" class=ftbutton1 nowrap><label onclick="quit_plus(document.dataForm.quit_count.value);" style="cursor:pointer">����� �߰�</label></td>
							<td><img src="images/btn_rt.gif"></td>
							<td width=2></td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:">
						<tr>
							<td align="" style="padding-bottom:15px">
								�� �Ի��� �ǰ����� �Ǻξ��� ��û�� �ֹε�ϻ纻1��<br>
								�� �ӱݱ���� �Ĵ�(10����), ����������(20���� ��, ���������ڸ� �ش�) ����!!<br>
								�� ���������� �ǰ������ ��� ����Ȯ�μ� �ʿ��� (3���� �޿�, �󿩱�, ������, ����ó ����ٶ�)
							</td>
							<td align="right" style="padding-bottom:15px">
								<div style="padding:0 0 4px 0"><a href="files/hwp/samu_reg.hwp"><img src="images/btn_samu_reg.gif" border="0"></a></div>
								<div>
									<a href="files/hwp/leave_confirmation.hwp"><img src="images/btn_leave.png" border="0"></a>
									<a href="files/hwp/leave_confirmation.zip"><img src="images/btn_leave_zip.png" border="0"></a>
								</div>
							</td>
						</tr>
						<tr>
							<td align="center" colspan="2">
								<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
								 <tr>
									 <td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:print();" target="">���</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
								<table border=0 cellpadding=0 cellspacing=0 style="display:inline;" id="save_bt">
									<tr>
										<td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">����</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
								<div id="save_ing" style="display:none"><img src="images/save_ing.gif"></div>
								<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
								 <tr>
									 <td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:close();" target="">�ݱ�</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
								<div style="color:red;font-weight:bold;">�� Ȯ�μ� ������ �ʿ��� ��� ��� ��ư�� ���� Ŭ���Ͻʽÿ�.</div>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div id="tab2" style="display:none">
				<!--Ÿ��Ʋ -->
				<table width="100%" border=0 cellspacing=0 cellpadding=0>
					<tr>     
						<td height="18">
							<table width=100% border=0 cellspacing=0 cellpadding=0>
								<tr>
									<td style='font-size:9pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'>����պ��� ���� �Ű�</span>
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
				<form name="dataForm2" method="post" enctype="multipart/form-data">
					<input type="hidden" name="mode" value="<?=$mode?>">
					<input type="hidden" name="modify_count" value="2">
					<input type="hidden" name="user_id" value="<?=$member['mb_id']?>">
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
							<td valign="bottom"></td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--�˻� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
						<col width="20%">
						<col width="30%">
						<col width="20%">
						<col width="30%">
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����ڵ�Ϲ�ȣ<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_bznb" id="comp_bznb2" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_bznb']?>" maxlength="12" onkeydown="only_number()" onkeyup="checkBznb(this.value,this,'Y',2)" >
								<label onclick="open_comp(2);" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
								��) 123-12-12345
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����������<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_adr" id="comp_adr2" type="text" class="textfm" style="width:250px;" value="<?=$row1['comp_adr']?>" maxlength="50">
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������Ī<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_name" id="comp_name2" type="text" class="textfm" style="width:210px;" value="<?=$row1['comp_name']?>" maxlength="25">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_tel" id="comp_tel2" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_tel']?>" maxlength="15"> ��) 055-1234-1234
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�̸���<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="comp_email" id="comp_email2" type="text" class="textfm" style="width:210px;" value="<?=$row1['comp_mail']?>" maxlength="30">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ѽ���ȣ<font color="red"></font></td>
							<td nowrap class="tdrow">
								<input name="comp_fax" id="comp_fax2" type="text" class="textfm" style="width:100px;" value="<?=$row1['comp_fax']?>" maxlength="15"> ��) 055-1234-1234
							</td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>
					<table border=0 cellspacing=0 cellpadding=0> 
						<tr> 
							<td style="background-color:#8db41d" valign="top"> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center;'>�ٷ���</td> 
										<td><img src="images/g_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=2></td> 
							<td valign="bottom"></td> 
							<td valign="bottom"></td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--�˻� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
						<col width="20%">
						<col width="30%">
						<col width="20%">
						<col width="30%">
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="modify_name" type="text" class="textfm" style="width:150px;" value="" maxlength="25" onclick="">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="modify_ssnb" type="text" class="textfm" style="width:110px;" onkeypress="only_number_hyphen()" value="" maxlength="14"> ��) 123456-1234567
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���� �� ����պ���<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="modify_salary" type="text" class="textfm" style="width:150px;ime-mode:inactive;" onkeypress="only_number()" value="" maxlength="25" onkeyup="checkThousand(this.value, this,'Y')">
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���� ���� ����<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input name="modify_date" type="text" class="textfm" style="width:70px;" value="" maxlength="7"> ��) 2014.02
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������뿩��<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<input type="checkbox" name="misgy" value="1" class="checkbox" checked> ���
								<input type="checkbox" name="missj" value="1" class="checkbox" checked> ����
								<input type="checkbox" name="miskm" value="1" class="checkbox" checked> ����
								<input type="checkbox" name="misgg" value="1" class="checkbox" checked> �ǰ�
							</td>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������<font color="red">*</font></td>
							<td nowrap class="tdrow">
								<select name="modify_reason" class="selectfm" style="">
									<option value="" >����</option>
									<option value="�����λ�" >�����λ�</option>
									<option value="��������" >��������</option>
									<option value="��������" >��������</option>
								</select>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���</td>
							<td nowrap class="tdrow">
								<input name="modify_note" type="text" class="textfm" style="width:250px;ime-mode:active;" value="" maxlength="25">
							</td>
							<td nowrap class="tdrowk"></td>
							<td nowrap class="tdrow">
							</td>
						</tr>
					</table>
					<div style="height:5px;font-size:0px;line-height:0px;"></div>
					<script language="javascript">
					function modify_plus(n){
						var frm = document.dataForm2;
						if(frm.modify_count.value > 20) {
							alert("�ѹ��� �Ű��� �� �ִ� �ο��� 20����� �Դϴ�.");
							return false;
						} else { 
							document.getElementById('modify_add_div').style.display = "";
							var Tbl = document.getElementById('modify_optable'); 
							tRow = Tbl.insertRow();//tr �߰�
							tCell = tRow.insertCell();//td �߰�
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"modify_name_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\"\" maxlength=\"25\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"modify_ssnb_[]\" type=\"text\" class=\"textfm\" style=\"width:110px;\" value=\"\" maxlength=\"14\">";

							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���� �� ����պ���<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"modify_salary_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, this,'Y')\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���� ���� ����<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"modify_date_[]\" type=\"text\" class=\"textfm\" style=\"width:70px;\" value=\"\" maxlength=\"7\">";


							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�������뿩��<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input type=\"checkbox\" name=\"misgy_"+n+"\" value=\"1\" class=\"checkbox\" checked> ��� <input type=\"checkbox\" name=\"missj_"+n+"\" value=\"1\" class=\"checkbox\" checked> ���� <input type=\"checkbox\" name=\"miskm_"+n+"\" value=\"1\" class=\"checkbox\" checked> ���� <input type=\"checkbox\" name=\"misgg_"+n+"\" value=\"1\" class=\"checkbox\" checked> �ǰ�";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�������<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<select name=\"modify_reason_[]\" class=\"selectfm\" style=\"\"><option value=\"\" >����</option><option value=\"�����λ�\" >�����λ�</option><option value=\"��������\" >��������</option><option value=\"��������\" >��������</option></select>";


							tRow = Tbl.insertRow();
							tCell = tRow.insertCell();
							tCell.className = "tdrowk_end"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���<font color=\"red\"></font>";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "<input name=\"modify_note_[]\" type=\"text\" class=\"textfm\" style=\"width:250px;ime-mode:active;\" value=\"\" maxlength=\"25\">";
							tCell = tRow.insertCell();
							tCell.className = "tdrowk_end"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "";
							tCell = tRow.insertCell();
							tCell.className = "tdrow_end"; 
							tCell.colSpan = 2;
							tCell.innerHTML = "";

							frm.modify_count.value++;
							//alert(frm.modify_count.value);
						} 
					}
					</script>
					<div id="modify_add_div" style="display:none">
						<table border=0 cellspacing=0 cellpadding=0> 
							<tr> 
								<td id=""> 
									<table border=0 cellpadding=0 cellspacing=0> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif"></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
											�ٷ���(�߰�)
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
					</div>
					<!--�˻� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed" id="modify_optable">
						<col width="10%">
						<col width="10%">
						<col width="20%">
						<col width="10%">
						<col width="10%">
						<col width="10%">
						<col width="20%">
						<col width="10%">
					</table>
	 					<div style="height:5px;font-size:0px;line-height:0px;"></div>
					<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
						<tr>
							<td width=2></td>
							<td><img src="images/btn_lt.gif"></td>        
							<td background="images/btn_bg.gif" class=ftbutton1 nowrap><label onclick="modify_plus(document.dataForm2.modify_count.value);" style="cursor:pointer">�ٷ��� �߰�</label></td>
							<td><img src="images/btn_rt.gif"></td>
							<td width=2></td>
							<td>�� �ִ� 20����� �Ű� �����մϴ�.</td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:">
						<tr>
							<td align="center">
								<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
								 <tr>
									 <td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:print();" target="">���</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
								<table border=0 cellpadding=0 cellspacing=0 style="display:inline;" id="save_bt2">
									<tr>
										<td width=2></td>
										<td><img src=images/btn_lt.gif></td>
										<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData2();" target="">����</a></td>
										<td><img src=images/btn_rt.gif></td>
									 <td width=2></td>
									</tr>
								</table>
								<div id="save_ing2" style="display:none"><img src="images/save_ing.gif"></div>
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
			</div>
		</td>
  </tr>
</table>

<? include "./inc/bottom.php";?>

</div>
<script language="javascript">
<?
if(!$tab) $tab = "tab1";
?>
tab_show('<?=$tab?>');
</script>
</body>
</html>
