<?
include "inc/analyticstracking.php";

$now_date_type = date("Y-m-d");
?>
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
<script type="text/javascript">
<!--
function getId(id)
{
	return document.getElementById(id);
}
function showM(m) {
	//���� �޴� 14�� ������ ���θ޴� �߰� 150916
	for(i=1;i<=14;i++) {
		hideM(i+"00");
	}
	var box = getId('subMenuBox'+m);
	if(box) {
		box.style.display = 'block';
		//box.style.top = -20;
	}
}
function hideM(m)
{
	var box = getId('subMenuBox'+m);
	if(box) box.style.display = 'none';
}
function next(e){
	var k= (document.all) ? e.keyCode : e.which
	if(k==13 && document.fhead.mb_id.value.length>0) 
		document.fhead.mb_password.focus()
}
function fhead_submit(f)
{
	if (!f.mb_id.value)
	{
		alert("ȸ�����̵� �Է��Ͻʽÿ�.");
		f.mb_id.focus();
		return;
	}
	if (!f.mb_password.value)
	{
		alert("�н����带 �Է��Ͻʽÿ�.");
		f.mb_password.focus();
		return;
	}
	f.action = "./login_check.php";
	f.submit();
}
function privacy_information(url) {
	var f = document.fhead;
	if (!f.mb_id.value) {
		alert("ȸ�����̵� �Է��Ͻʽÿ�.");
		f.mb_id.focus();
		return;
	}
	window.open(url+'?mb_id='+f.mb_id.value, 'privacy_information', 'height=760,width=920,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=no');
}
//���̵� (����ڵ�Ϲ�ȣ �ڵ� ������ �Է�)
function check_bzno(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.fhead;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
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
	if(input.substring(0,1) == "m" || input.substring(0,1) == "u" || input.substring(0,1) == "g" || input.substring(0,1) == "s" || input.substring(0,1) == "y" || input.substring(0,1) == "b") {
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
					main.mb_id.value=total;					// type �� ���� �������� �־� �ش�.
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
function total_pay_popup(url) {
	window.open(url, 'total_pay_popup', 'height=860,width=1260,toolbar=no,directories=no,status=no,linemenubar=no,scrollbars=yes,resizable=yes');
}
// onload 2�� �̻� ���� ���� �Լ�
function addLoadEvent(func) {
    var oldonload = window.onload;
        if(typeof window.onload != 'function') {
            window.onload = func;
        } else {
            window.onload = function() {
                oldonload();
                func();
        }
    }
}
function showMenu_top_reset() {
	showM();
}
addLoadEvent(showMenu_top_reset);
//��� ó�� 160226
function go_work(branch, id) {
	if(confirm("��� üũ�Ͻðڽ��ϱ�?")) {
		//alert('�غ����Դϴ�. '+branch+' '+id);
		work_go_leave_iframe.location.href = "work_go_leave_update.php?type=go&id="+id+"&branch="+branch;
	}
	return;
}
//��� ó��
function leave_work(branch, id) {
	if(confirm("��� üũ�Ͻðڽ��ϱ�?")) {
		work_go_leave_iframe.location.href = "work_go_leave_update.php?type=leave&id="+id+"&branch="+branch;
	}
	return;
}
//-->
</script>
<?
$content_width = 1040;
//����
if($member['mb_level'] <= 6) {
	$subMenuBox1300_top = "290px";
	$subMenuBox200_top = "350px";
	$subMenuBox400_top = "410px";
	$subMenuBox1400_top = "470px";
	$subMenuBox300_top = "530px";
	//Ŀ�´�Ƽ
	$subMenuBox1000_top = "590px";
	//�ڷ��
	$subMenuBox1100_top = "650px";
//����
} else {
	$subMenuBox1300_top = "170px";
	$subMenuBox200_top = "230px";
	//$subMenuBox300_top = "230px";
	$subMenuBox400_top = "290px";
	$subMenuBox1400_top = "350px";
	$subMenuBox1200_top = "410px";
	$subMenuBox300_top = "470px";
	//Ŀ�´�Ƽ
	$subMenuBox1000_top = "530px";
	//�ڷ��
	$subMenuBox1100_top = "590px";
	$subMenuBox800_top = "710px";
}
//�������� ���� ǥ�� �޴� ��ġ 150810
if($member['mb_profile'] == 8) {
	$sql_p_code = " select p_code from a4_manage where user_id='$member[mb_id]' ";
	$row_p_code = sql_fetch($sql_p_code);
	$p_code_8 = $row_p_code['p_code'];
	//echo $p_code;
	if($p_code_8 > 1) {
		//$subMenuBox400_top = "350px";
		//$subMenuBox1300_top = "410px";
		//Ŀ�´�Ƽ
		$subMenuBox1000_top = "530px";
		$subMenuBox1100_top = "590px";
	}
}
?>
<!--�����޴�-->
<div style="display:none">
	<img src="images/menu11_on.gif" border="0" alt="" />
</div>
<style type="text/css">
.submenubox {position:absolute;50px;left:72px;border:1px solid #aaaaaa;display:none;z-index:200;}
</style>
<div id="subMenuBox100" class="submenubox" style="top:110px" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='client_process_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">����ó����Ȳ</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='client_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�ŷ�ó����</div></div>
	<!--<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='client_memo.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�ŷ�ó�湮/����</div></div>-->
<?
//���� ���� �޴�
if($member['mb_level'] > 6) {
	//������� ���� 160823
	if($member['mb_level'] != 7) {
?>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='client_sms_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">���ڸ޼����߼�</div></div>
<?
	}
?>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='client_search.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�ŷ�ó�˻�</div></div>
<?
}
?>
</div>
<?
//���»� ���� �Ұ�
if($member['mb_profile'] < 100) {
?>
<div id="subMenuBox200" class="submenubox" style="top:<?=$subMenuBox200_top?>" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='client_application_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">��������Ȳ</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='client_reapplication.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">���û��Ȳ</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='unpaid_balance.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�̼�����Ȳ</div></div>
	<!--<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='app_family_insurance_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">���������</div></div>-->
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='client_application_cycle.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">��û�ֱ�</div></div>
	<!--<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='reduction_application.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">���������Ⱓ</div></div>-->
	<!--����о� -> ������ ���� �̵� 160830-->
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='support_person_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0;">�������Ȯ��</div></div>
	<!--���������ȸ -> "�������Ȯ��"���� �޴��� ����, "�������Ȯ��2"���� "�ű԰��Ȯ��"���� ����-->
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='acceleration_employment.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0;">�ű԰��Ȯ��</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='reduction_prevention.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0;">���������Ⱓ��ȸ</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='job_time_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0;">���â��</div></div>
</div>
<div id="subMenuBox400" class="submenubox" style="top:<?=$subMenuBox400_top?>" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='samu_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�繫��Ź��Ȳ</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='samu_insure_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�Ǻ����ڽŰ�</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='total_pay_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�����Ѿ׽Ű�</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='total_insure_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�����Ű�</div></div>
	<!--<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='accountant_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">ȸ��繫��</div></div>-->
</div>
<div id="subMenuBox1300" class="submenubox" style="top:<?=$subMenuBox1300_top?>" >
	<!--������������ �޴� ���� ������� �̵� 160405-->
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='electric_charges_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0;">������������</div></div>
	<!--�����߸������� job_invent_recompense.php �޴� �߰� 160824-->
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='job_invent_recompense.php';" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0;">�����߸�������</div></div>
<?
//ù ��ŸƮ �������� 161114
//���� ���� �Ұ� �豹�� ���� �ǰ� 161019
//if($member['mb_level'] > 6) {
?>
	<!--4�뺸������ insure_reduce.php �޴� �߰� 160824 / si4n_nhis_list.php ���Ϸ� ���� 161014-->
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='si4n_nhis_list.php';" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0;">4�뺸������������</div></div>
<?
//}
?>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='kepco_dsm_list.php';" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0;">���¼������</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='job_education_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">������Ʒð���</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='danger_evaluate_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">���輺�򰡰���</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='family_insurance_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0;">���������ȯ��</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='policy_fund_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0;">��å�ڱ�</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='employment_agency.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0;">�η°���</div></div>
</div>
<div id="subMenuBox300" class="submenubox" style="top:<?=$subMenuBox300_top?>" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='settlement_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�����Ȳ</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='settlement_report.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">��꺸��</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='settlement_sales.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">��������</div></div>
<?
//���� ���� �޴�
if($member['mb_level'] > 6) {
	$settlement_pay_url = "settlement_pay.php";
} else {
	$settlement_pay_url = "settlement_pay_branch.php";
}
$electric_charges_collection_url = "electric_charges_collection.php";
?>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='<?=$settlement_pay_url?>'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�޿�����</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='<?=$electric_charges_collection_url?>'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">���ݰ���</div></div>
</div>
<div id="subMenuBox1400" class="submenubox" style="top:<?=$subMenuBox1400_top?>" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right;" onclick="location.href='list_notice.php?bo_table=erp_schedule'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�����ٰ���</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right;" onclick="location.href='schedule_view.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�湮�����ٵ��</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right;" onclick="location.href='list_notice.php?bo_table=erp_job_education'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">������Ʒð���</div></div>
</div>
<?
} else {
	echo "<div id='subMenuBox200'></div>";
	echo "<div id='subMenuBox400'></div>";
	echo "<div id='subMenuBox1300'></div>";
	echo "<div id='subMenuBox300'></div>";
	echo "<div id='subMenuBox1400'></div>";
}
?>
<div id="subMenuBox500" class="submenubox" style="top:290px" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='account_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">����/����</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='account_trade.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">��������</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='account_sale.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�ǸŰ���</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='account_statistics.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">���м�</div></div>
</div>
<div id="subMenuBox600" class="submenubox" style="top:350px" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='pay_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�������(�μ���)</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='pay_allowance.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">��������</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='pay_reflect.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�޿��ݿ�</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='pay_ledger_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�޿�����</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='pay_statistics.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">��/�� ���</div></div>
</div>
<div id="subMenuBox700" class="submenubox" style="top:650px" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='groupware_business_log.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">���ڰ���</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='groupware_pay_stubs.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�޿���</div></div>
<?
//������� ���� 160823
if($member['mb_level'] != 7) {
?>
	<!--<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='groupware_project.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">��������</div></div>-->
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='list_notice.php?bo_table=erp_punctuality'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">���°���</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='groupware_attendance.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">��ٺ�</div></div>
<?
	//������, ��ǥ, ����, ����, ȸ�� ����� 161205
	if($member['mb_id'] == "master" || $member['mb_id'] == "kcmc1001" || $member['mb_id'] == "kcmc1004" || $member['mb_id'] == "kcmc1008") {
?>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='address_book.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�ּҷ�</div></div>
<?
	}
}
?>
</div>
<div id="subMenuBox1200" class="submenubox" style="top:<?=$subMenuBox1200_top?>" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='client_kidsnomu_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">Ű��빫</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='client_program_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�����빫</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='client_construction_list.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�Ǽ�������</div></div>
</div>
<div id="subMenuBox1000" class="submenubox" style="top:<?=$subMenuBox1000_top?>" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='list_notice.php?bo_table=erp_notice'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">��������</div></div>
<?
//���縸 ǥ�� 160126
if($member['mb_level'] > 6) {
?>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='list_notice.php?bo_table=erp_dealer'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">����(������)</div></div>
<? } ?>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='list_notice.php?bo_table=erp_event'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�ֿ�����</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='list_notice.php?bo_table=erp_online'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">Q&#38;A</div></div>
</div>
<div id="subMenuBox1100" class="submenubox" style="top:<?=$subMenuBox1100_top?>" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='list_pds.php?bo_table=erp_pds'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�����ڷ��</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='list_pds.php?bo_table=erp_pds2'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�����ڷ��</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='list_pds.php?bo_table=erp_pds3'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�����ڷ��</div></div>
</div>
<div id="subMenuBox800" class="submenubox" style="<?=$subMenuBox800_top?>" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='setup_info.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">ȸ����������</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='setup_user.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�����/���ѵ��</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='setup_system.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�ý��� ����</div></div>
</div>
<div id="subMenuBox900" class="" style="top:530px" >
	<!--�� �޴�-->
</div>	
<div style="height:50px;background:url('images/top_bar.gif') repeat-x;padding:0 0 0 16px;min-width:1240px;">
	<div style="float:left;margin:4px 0 0 0;"><a href="main.php" onmouseover="showM('900')"><img src="images/logo.png" border="0" alt="" /></a></div>
	<div style="float:left;margin:4px 0 0 60px;">
<?
$mb_profile_code = $member['mb_profile'];
if($member['mb_level'] <= 6) {
	$cnt_where = " and a.damdang_code = '$mb_profile_code' ";
	$cnt_where2 = " and damdang_code = '$mb_profile_code' ";
} else {
	$cnt_where = "";
	$cnt_where2 = "";
}
$sql_cnt = " select count(com_code) as cnt from com_list_gy where 1=1 $cnt_where2 ";
$row_cnt = sql_fetch($sql_cnt);
$total_com_count = $row_cnt['cnt'];
$sql_cnt = " select count(com_code) as cnt from com_list_gy where regdt='$today' $cnt_where2 ";
$row_cnt = sql_fetch($sql_cnt);
$total_com_count_today = $row_cnt['cnt'];
//�繫��Ź
$sql_cnt = " select count(a.com_code) as cnt from com_list_gy a, com_list_gy_opt b where a.com_code = b.com_code and (b.samu_req_yn = '4') $cnt_where ";
$row_cnt = sql_fetch($sql_cnt);
$samu_count = $row_cnt['cnt'];
$sql_cnt = " select count(a.com_code) as cnt from com_list_gy a, com_list_gy_opt b where a.com_code = b.com_code and (b.samu_req_date = '$today') $cnt_where ";
$row_cnt = sql_fetch($sql_cnt);
$samu_count_today = $row_cnt['cnt'];
//�븮�μ���(����)
$sql_cnt = " select count(a.com_code) as cnt from com_list_gy a, com_list_gy_opt b where a.com_code = b.com_code and (b.agent_elect_public_yn = '3') $cnt_where ";
$row_cnt = sql_fetch($sql_cnt);
$agent_elect_public_count = $row_cnt['cnt'];
$sql_cnt = " select count(a.com_code) as cnt from com_list_gy a, com_list_gy_opt b where a.com_code = b.com_code and (b.agent_elect_public_edate = '$today') $cnt_where ";
//echo $sql_cnt;
$row_cnt = sql_fetch($sql_cnt);
$agent_elect_public_count_today = $row_cnt['cnt'];
//���ڹο�(����)
$sql_cnt = " select count(a.com_code) as cnt from com_list_gy a, com_list_gy_opt b where a.com_code = b.com_code and (b.agent_elect_center_yn = '3') $cnt_where ";
$row_cnt = sql_fetch($sql_cnt);
$agent_elect_center_count = $row_cnt['cnt'];
$sql_cnt = " select count(a.com_code) as cnt from com_list_gy a, com_list_gy_opt b where a.com_code = b.com_code and (b.agent_elect_center_edate = '$today') $cnt_where ";
$row_cnt = sql_fetch($sql_cnt);
$agent_elect_center_count_today = $row_cnt['cnt'];
//���α׷� -> �����빫
$sql_cnt = " select count(a.com_code) as cnt from com_list_gy a, com_list_gy_opt2 c where a.com_code = c.com_code and (c.easynomu_process = '3') $cnt_where ";
$row_cnt = sql_fetch($sql_cnt);
$easynomu_count = $row_cnt['cnt'];
$sql_cnt = " select count(a.com_code) as cnt from com_list_gy a, com_list_gy_opt2 c where a.com_code = c.com_code and (c.easynomu_finish_date = '$today') $cnt_where ";
$row_cnt = sql_fetch($sql_cnt);
$easynomu_count_today = $row_cnt['cnt'];
//��ü ���� ��ũ
$total_com_count_total_href = "./client_process_list.php?search_ok=branch";
$samu_count_total_href = "./samu_list.php";
$agent_elect_public_count_total_href = "./client_process_list.php?search_ok=branch&amp;agent_elect_public_yn=3";
$agent_elect_center_count_total_href = "./client_process_list.php?search_ok=branch&amp;agent_elect_center_yn=3";
$easynomu_count_total_href = "./client_process_list.php?search_ok=branch&amp;easynomu_process=3";
//���� �Ϸ� ��ũ
$total_com_count_today_href = "./client_process_list.php?search_ok=branch&amp;stx_search_day_chk=1&amp;search_sday=$today&amp;search_eday=$today&amp;search_day1=1";
$samu_count_today_href = "./samu_list.php?search_ok=branch&amp;stx_search_day_chk=1&amp;search_sday=$today&amp;search_eday=$today&amp;search_day4=1";
$agent_elect_public_count_today_href = "./client_process_list.php?search_ok=branch&amp;stx_search_day_chk=1&amp;search_sday=$today&amp;search_eday=$today&amp;search_day6=1";
$agent_elect_center_count_today_href = "./client_process_list.php?search_ok=branch&amp;stx_search_day_chk=1&amp;search_sday=$today&amp;search_eday=$today&amp;search_day7=1";
$easynomu_count_today_href = "./client_process_list.php?search_ok=branch&amp;stx_search_day_chk=1&amp;search_sday=$today&amp;search_eday=$today&amp;search_day8=1";
?>
		<table border="0" cellpadding="0" cellspacing="0" class="" style="color:white;">
			<tr>
				<td width="70" height="40" align="center">�ŷ�ó<br/><a href="<?=$total_com_count_total_href?>" style="color:white"><?=number_format($total_com_count)?></a> <a href="<?=$total_com_count_today_href?>" style="color:white">(<?=number_format($total_com_count_today)?>)</a></td>
				<td width="80" align="center">�繫��Ź<br/><a href="<?=$samu_count_total_href?>" style="color:white"><?=number_format($samu_count)?></a> <a href="<?=$samu_count_today_href?>" style="color:white">(<?=number_format($samu_count_today)?>)</a></td>
				<td width="80" align="center">�븮�μ���<br/><a href="<?=$agent_elect_public_count_total_href?>" style="color:white"><?=number_format($agent_elect_public_count)?></a> <a href="<?=$agent_elect_public_count_today_href?>" style="color:white">(<?=number_format($agent_elect_public_count_today)?>)</a></td>
				<td width="66" align="center">���ڹο�<br/><a href="<?=$agent_elect_center_count_total_href?>" style="color:white"><?=number_format($agent_elect_center_count)?></a> <a href="<?=$agent_elect_center_count_today_href?>" style="color:white">(<?=number_format($agent_elect_center_count_today)?>)</a></td>
				<td width="66" align="center">���α׷�<br/><a href="<?=$easynomu_count_total_href?>" style="color:white"><?=number_format($easynomu_count)?></a> <a href="<?=$easynomu_count_today_href?>" style="color:white">(<?=number_format($easynomu_count_today)?>)</a></td>
				<td></td>
			</tr>
		</table>
	</div>
	<div id="alert_div_main" style="float:left;background: url('images/loading_bg.png') no-repeat;width:430px;height:40px;border:0 solid red;">
		<!--<div id="alert_div"></div>-->
		<!-- �˸� -->
<?
if($mb_profile_code != "1") {
	$alert_sql_search = " where read_branch = '' ";
} else {
	$alert_sql_search = " where read_main = '' ";
	//������� �ֱ� �˸� 2�� ǥ�� ���� 160215
	$alert_sql_search .= " and ( send_to like '%$mb_id%' ) ";
}
if($member['mb_id'] == "master") $alert_sql_search .= " and alert_code = '90001' ";
else $alert_sql_search .= " and alert_code != '90001' ";

$mb_id = $member['mb_id'];
//���Ŵ��� �ڵ� üũ
$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
$row_manage = sql_fetch($sql_manage);
$manage_code = $row_manage['code'];

//�˸� ���� ���� �� �ش� ���� �ŷ�ó�� ǥ�� search_ok == "ok" ����
if($member['mb_level'] > 6) {
	$alert_sql_search .= " and send_to not like '%branch%' ";
	//���� ������� ����
	if($member['mb_level'] == 7) {
		$alert_sql_search .= " and (send_to like '%$mb_id%' or user_code='$manage_code') ";
	}
	//�׷���� �˸� ���� 161021
	$alert_sql_search .= " and (alert_code != 90013 and alert_code != '90001' and alert_code != '90010') ";
} else {
	$alert_sql_search .= " and ( branch='$mb_profile_code' or branch2='$mb_profile_code' ) ";
	//���� ������� ����
	if($member['mb_level'] == 5) {
		$alert_sql_search .= " and (send_to like '%$mb_id%' or user_code='$manage_code') ";
	}
	//������� ��� ���� ���� 160706
	$alert_sql_search .= " and send_to not like '%contractor%' ";
	//������� ��� ���� ���� / �޸� Ÿ�� 99 ����
	$alert_sql_search .= " and memo_type!=99 ";
	//�뱸����(�������Ȯ��, �ű԰��Ȯ��) ���޻��� ���� �˸� ���� 161007
	if($member['mb_profile'] != 16) $alert_sql_search .= " and user_name != '�뱸����' ";
}
$alert_sql_search .= " and wr_datetime < '$now_date_type 23:59:59' ";
$alert_sql = "select * from erp_alert $alert_sql_search order by idx desc limit 0, 2 ";
//echo $alert_sql;
$alert_result = sql_query($alert_sql);
$now_time = date("Y-m-d H:i:s");
$now = strtotime($now_time);
?>
		<div style="">
			<div style="float:left;background: url('images/top_bar.gif') repeat-x;padding:7px 0 0 20px">
<?
for ($i=0; $alert_row=sql_fetch_array($alert_result); $i++) {
	$alert_idx = $alert_row['idx'];
	$alert_id = $alert_row['com_code'];
	$alert_code = $alert_row['alert_code'];
	$client_process_view = "alert_read_link.php?link_url=process&amp;idx=$alert_idx&amp;id=$alert_id&amp;w=u&amp;page=&amp;alert_code=$alert_code";
	$com_name_full = $alert_row['com_name'];
	$com_name = cut_str($com_name_full, 14, "..");
	$com_name = $com_name;
	$alert_memo_full = $alert_row['memo'];
	$alert_memo = cut_str($alert_memo_full, 28, "..");
	$end = strtotime($alert_row['wr_datetime']);
	$time = $now - $end;
	$on1 = floor($time / 86400);
	$rest_hours = $time % 86400;
	$diff_in_hours = floor($rest_hours / 3600);
	if($on1 == 0 && $diff_in_hours < 2) $new_icon = "<img src='images/icon_new.gif' width='16' height='5' style='vertical-align:middle' alt='���˸�' />";
	else $new_icon = "";
	echo "<div id='blink".$i."'>";
	echo "<img src='images/icon_02_white.gif' width='2' height='2' style='vertical-align:middle' alt='' /><a style='color:white;' href='".$client_process_view."'> ".$com_name." ".$alert_memo."</a>";
	//���˸�, �˸� �������� �и��� ������ ���� 160510
	//echo  $new_icon;
	echo "</div>";
}
if ($i == 0) {
	$no_memo = "���ο� �˸��� �����ϴ�.";
	//$no_memo = iconv("CP949", "UTF-8", rawurldecode($no_memo));
	echo "<div style='color:white;height:40px'><img src='images/icon_02_white.gif' width='2' height='2' style='vertical-align:middle' alt='' /> $no_memo</div>";
}
//����� ���� ���� �˸� ���� ��� ���˸� ��ư ������
//if($member['mb_id'] == "kcmc1004" || $member['mb_id'] == "kcmc1005") $mb_id = "manager";
//else $mb_id = $member['mb_id'];
$sql_my = " select count(*) as cnt from erp_alert where read_main = '' and ( send_to like '%$mb_id%' ) and wr_datetime < '$now_date_type 23:59:59' ";
//echo $sql_my;
$row_my = sql_fetch($sql_my);
if($row_my['cnt'] > 0) $btn_alert_my = "images/btn2_alert_my_blink.gif";
else $btn_alert_my = "images/btn2_alert_my.gif";
?>
			</div>
			<div style="float:left;padding:6px 0 0 14px">
<?
if($member['mb_profile'] == 1 && $member['mb_level'] != 7) {
?>
				<a href="alert_my.php"><img src="<?=$btn_alert_my?>" style="margin:0;vertical-align:middle;" alt="���˸�" border="0" /></a>
<?
}
?>
				<a href="alert_list.php"><img src="images/btn2_alert_total.gif" style="margin:0;vertical-align:middle;" alt="��ü�˸�" border="0" /></a>
			</div>
		</div>
		<!-- �˸� �� -->
	</div>
	<div style="float:left;color:white;">
		<div style="float:left;margin:7px 0 0 0;">
			<div style="width:150px;height:40px"><?=$member['mb_name']?> (<?=$member['mb_nick']?>)<br/>����ڴ� �ݰ����ϴ�.</div>
		</div>
		<div style="float:left;padding:6px 6px 0 0">
			<div style="margin-top:0;"><img src="images/btn_leave_work.png" style="margin:0;cursor:pointer;vertical-align:middle;border:1px solid #cccccc;" onclick="leave_work('<?=$member['mb_profile']?>','<?=$member['mb_id']?>');" alt="���" /></div>
		</div>
		<div style="float:left;margin:7px 10px 0 0;">
			<a href="/bbs/logout.php?url=%2Ferp%2F&amp;site=erp"><img src="images/logout.gif" border="0" alt="�α׾ƿ�" /></a>
			<img src="images/menu17_on.gif" width="0" height="0" alt="" /><!--������Ʒ� �޴� �ѿ��� �̹��� �ε�-->
		</div>
		<iframe name="work_go_leave_iframe" src="work_go_leave_update.php" style="width:0;height:0;background:#ffffff;" frameborder="0"></iframe>
	</div>
</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="table-layout:fixed;">
	<tr>
		<td valign="top" width="72" style="background:url('images/menu_bg.gif') repeat-y;">
<?
$blank_menu = "<span onmouseover=\"showM('900')\"><img src=\"images/blank.gif\" width=\"2\" height=\"60\" alt=\"\" /></span>";

$office_commission = "javascript:alert('�غ����Դϴ�.');";
$allowance_main = "javascript:alert('�غ����Դϴ�.');";
$policy_fund_list = "policy_fund_list.php";
$shipbuilding_list = "shipbuilding_list.php";
$job_education_list = "job_education_list.php";
//$client_program_list = "client_program_list.php";
//Ű��빫 ����ڰ� �����Ƿ� ù��° �޴��� ����(������ ���� �ǰ�) 160707
$client_program_list = "client_kidsnomu_list.php";
$pds_bbs = "list_pds.php?bo_table=erp_pds";
$groupware = "groupware_business_log.php";

$pay_list = "javascript:alert('�غ����Դϴ�.');";
$setup_info = "javascript:alert('�غ����Դϴ�.');";
$remote_help = "remote_help.php";

//���Ѻ� ��ũ
$no_right = "javascript:alert('������ �����ϴ�.');";
if($member['mb_profile'] < 100 || $member['mb_profile'] > 300) {
	$job_time_list = "support_person_list.php";
	$electric_charges_list = "electric_charges_list.php";
	$support_list = "client_application_list.php";
	$samu_list = "samu_list.php";
	$schedule_list = "list_notice.php?bo_table=erp_schedule";
	$account_list = "settlement_list.php";
} else {
	$job_time_list = $no_right;
	$electric_charges_list = $no_right;
	$support_list = $no_right;
	$samu_list = $no_right;
	$schedule_list = $no_right;
	$account_list = $no_right;
}
?>
			<div><?=$blank_menu?><a href="client_view.php" onmouseover='getId("img0").src="images/menu00_on.gif";showM("900");' onmouseout='getId("img0").src="images/menu00.gif"'><img src="images/menu00.gif" name='img0' border="0" id="img0" alt="�űԵ��" /></a></div>
<?
//���� ���� �޴�
if($member['mb_level'] > 6) {
?>
			<div><?=$blank_menu?><a href="client_process_list.php" onmouseover='getId("img1").src="images/menu01_on.gif";showM("100");' onmouseout='getId("img1").src="images/menu01.gif"'><img src="images/menu01.gif" name='img1' border="0" id="img1" alt="����ó����Ȳ" /></a></div>
<?
} else {
?>
			<div><?=$blank_menu?><a href="client_list.php" onmouseover='getId("img11").src="images/menu11_on.gif";showM("900");' onmouseout='getId("img11").src="images/menu11.gif"'><img src="images/menu11.gif" name='img11' border="0" id="img11" alt="�ŷ�ó����" /></a></div>
			<div><?=$blank_menu?><a href="client_process_list.php" onmouseover='getId("img12").src="images/menu12_on.gif";showM("900");' onmouseout='getId("img12").src="images/menu12.gif"'><img src="images/menu12.gif" name='img12' border="0" id="img12" alt="����ó����Ȳ" /></a></div>
			<div><?=$blank_menu?><a href="client_search.php" onmouseover='getId("img13").src="images/menu13_on.gif";showM("900");' onmouseout='getId("img13").src="images/menu13.gif"'><img src="images/menu13.gif" name='img13' border="0" id="img13" alt="�ŷ�ó�˻�" /></a></div>
<?
}
?>
			<div><?=$blank_menu?><a href="<?=$electric_charges_list?>" onmouseover='getId("img19").src="images/menu19_on.gif";showM("1300");' onmouseout='getId("img19").src="images/menu19.gif"'><img src="images/menu19.gif" name='img19' border="0" id="img19" alt="����о�" /></a></div>
<?
//�������� ���� ���� ���� 150826 / ������ ���� ������ ���� ����, ��켮 ������ ��û 161028 / ������ ����(gj0028) ������ ����, ������ �븮 ��û 161101 / ������ ���� ��� 161108 / ������ ����(gj0029) ������ ����, ������ �븮 ���Ϸ� ��û 161208
if($member['mb_profile'] == 8 && $p_code_8 > 1 && $member['mb_id'] != "gj0002" && $member['mb_id'] != "gj0029") {
	$support_list = $no_right;
	$support_sub_menu = 900;
} else {
	$support_sub_menu = 200;
}
?>
			<div><?=$blank_menu?><a href="<?=$support_list?>" onmouseover='getId("img2").src="images/menu02_on.gif";showM("<?=$support_sub_menu?>");' onmouseout='getId("img2").src="images/menu02.gif"'><img src="images/menu02.gif" name='img2' border="0" id="img2" alt="������" /></a></div>
			<div><?=$blank_menu?><a href="<?=$samu_list?>" onmouseover='getId("img5").src="images/menu05_on.gif";showM("400");' onmouseout='getId("img5").src="images/menu05.gif"'><img src="images/menu05.gif" name='img5' border="0" id="img5" alt="�繫��Ź" /></a></div>
			<div><?=$blank_menu?><a href="<?=$schedule_list?>" onmouseover='getId("img20").src="images/menu20_on.gif";showM("1400");' onmouseout='getId("img20").src="images/menu20.gif"'><img src="images/menu20.gif" name='img20' border="0" id="img20" alt="������" /></a></div>
<?
//���� ���� �޴�
if($member['mb_level'] > 6) {
?>
			<div><?=$blank_menu?><a href="<?=$client_program_list?>" onmouseover='getId("img18").src="images/menu18_on.gif";showM("1200");' onmouseout='getId("img18").src="images/menu18.gif"'><img src="images/menu18.gif" name='img18' border="0" id="img18" alt="���α׷�" /></a></div>
<?
}
//��� ����, ��������(������)�� ǥ�� 150810
if($member['mb_profile'] != 8 || $p_code_8 == 1) {
?>
			<div><?=$blank_menu?><a href="<?=$account_list?>" onmouseover='getId("img3").src="images/menu03_on.gif";showM("300");' onmouseout='getId("img3").src="images/menu03.gif"'><img src="images/menu03.gif" name='img3' border="0" id="img3" alt="���" /></a></div>
<?
}
?>
			<div><?=$blank_menu?><a href="list_notice.php?bo_table=erp_notice" onmouseover='getId("img10").src="images/menu10_on.gif";showM("1000");' onmouseout='getId("img10").src="images/menu10.gif"'><img src="images/menu10.gif" name='img10' border="0" id="img10" alt="Ŀ�´�Ƽ" /></a></div>
<?
//����, ��� �����常 ǥ�� 150824
$sql_p_code = " select p_code from a4_manage where user_id='$member[mb_id]' ";
$row_p_code = sql_fetch($sql_p_code);
$p_code = $row_p_code['p_code'];
//ǥ�� : ����, ������, õ������, Ȳ��� ���� 160219, ����4 �ǿ��� �̻� 160303, ���� ������ �븮 160307, ����1 ���̿� ���� 160407 / ���� : ���»� 
if( ($member['mb_profile'] == "1" || $p_code == "1" || $member['mb_profile'] == "34" || $member['mb_id'] == "ps20002" || $member['mb_id'] == "su40002" || $member['mb_id'] == "gj0012" || $member['mb_id'] == "jb10002") && $mb_profile_code != "101" ) {
?>
			<div><?=$blank_menu?><a href="<?=$pds_bbs?>" onmouseover='getId("img21").src="images/menu21_on.gif";showM("1100");' onmouseout='getId("img21").src="images/menu21.gif"'><img src="images/menu21.gif" name='img21' border="0" id="img21" alt="�ڷ��" /></a></div>
<?
}
//���� ���� �޴�
if($member['mb_level'] > 6) {
?>
			<div><?=$blank_menu?><a href="<?=$groupware?>" onmouseover='getId("img7").src="images/menu07_on.gif";showM("700");' onmouseout='getId("img7").src="images/menu07.gif"'><img src="images/menu07.gif" name='img7' border="0" id="img7" alt="�׷����" /></a></div>
<?
}
?>
			<div><?=$blank_menu?><a href="setup_member_info.php" onmouseover='getId("img8").src="images/menu08_on.gif";showM("900");' onmouseout='getId("img8").src="images/menu08.gif"'><img src="images/menu08.gif" name='img8' border="0" id="img8" alt="ȯ�漳��" /></a></div>
			<div><?=$blank_menu?><a href="javascript:alert('������ ������ �� ����ȭ�鿡 �������ֽʽÿ�.');location.href='kcmc_erp.zip';" onmouseover="" onmouseout=""><img src="images/btn_url.gif" border="0" alt="�ٷ����Ӵٿ�ε�" /></a></div>
			<div><?=$blank_menu?><a href="<?=$remote_help?>"><img src="images/btn_remote_help.gif" border="0" alt="��������" /></a></div>
		</td>
