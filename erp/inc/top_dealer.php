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
?>
<!--�����޴�-->
<div style="display:none">
	<img src="images/menu11_on.gif" border="0" alt="" />
</div>
<style type="text/css">
.submenubox {position:absolute;50px;left:72px;border:1px solid #aaaaaa;display:none;z-index:200;}
</style>

<div id="subMenuBox700" class="submenubox" style="top:290px" >
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='groupware_business_log.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">���ڰ���</div></div>
	<div style="width:150px;height:30px;background:url('images/sub_menu_bg.gif') no-repeat;cursor:pointer;text-align:right" onclick="location.href='groupware_pay_stubs.php'" onmouseover="this.style.background='url(images/sub_menu_bg_on.gif) no-repeat';this.style.color='#ffffff'" onmouseout="this.style.background='url(images/sub_menu_bg.gif) no-repeat';this.style.color='#0056a9'"><div style="padding:10px 26px 0 0">�޿���</div></div>
</div>

<div id="subMenuBox900" class="" style="top:530px" >
	<!--�� �޴�-->
</div>	
<div style="height:50px;background:url('images/top_bar.gif') repeat-x;padding:0 0 0 16px;min-width:1240px;">
	<div style="float:left;margin:4px 0 0 0;"><a href="main.php" onmouseover="showM('900')"><img src="images/logo.png" border="0" alt="" /></a></div>
	<div style="float:left;margin:4px 0 0 60px;">
<?
$mb_profile_code = $member['mb_profile'];
?>
		<table border="0" cellpadding="0" cellspacing="0" class="" style="color:white;">
			<tr>
				<td width="70" height="40" align="center"></td>
				<td width="80" align="center"></td>
				<td width="80" align="center"></td>
				<td width="66" align="center"></td>
				<td width="66" align="center"></td>
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
} else {
	//���� ���� ����
	if($member['mb_level'] == 4) $alert_sql_search .= " and (send_to like '%$mb_id%' or user_code='$manage_code') ";
	else $alert_sql_search .= " and ( branch='$mb_profile_code' or branch2='$mb_profile_code' ) ";
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
	$client_process_view = "alert_read_link.php?link_url=view_dealer&amp;idx=$alert_idx&amp;id=$alert_id&amp;w=u&amp;page=&amp;alert_code=$alert_code";
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
	echo  $new_icon;
	echo "</div>";
}
if ($i == 0) {
	$no_memo = "���ο� �˸��� �����ϴ�.";
	//$no_memo = iconv("CP949", "UTF-8", rawurldecode($no_memo));
	echo "<div style='color:white;height:40px'><img src='images/icon_02_white.gif' width='2' height='2' style='vertical-align:middle' alt='' /> $no_memo</div>";
}
//����� ���� ���� �˸� ���� ��� ���˸� ��ư ������
if($member['mb_id'] == "kcmc1004" || $member['mb_id'] == "kcmc1005") $mb_id = "manager";
else $mb_id = $member['mb_id'];
$sql_my = " select count(*) as cnt from erp_alert where read_main = '' and ( send_to like '%$mb_id%' ) and wr_datetime < '$now_date_type 23:59:59' ";
//echo $sql_my;
$row_my = sql_fetch($sql_my);
if($row_my['cnt'] > 0) $btn_alert_my = "images/btn2_alert_my_blink.gif";
else $btn_alert_my = "images/btn2_alert_my.gif";
?>
			</div>
			<div style="float:left;padding:7px 0 0 14px">
<?
if($member['mb_profile'] == 1) {
?>
				<img src="<?=$btn_alert_my?>" style="margin:0;cursor:pointer;vertical-align:middle;" onclick="self.location.href='alert_my.php';" alt="���˸�" />
<?
}
?>
				<img src="images/btn2_alert_total.gif" style="margin:0;cursor:pointer;vertical-align:middle;" onclick="self.location.href='alert_list.php';" alt="��ü�˸�" />
			</div>
		</div>
		<map name="plus.gif" id="plus.gif">
			<area shape="rect" coords="-2,0,50,15" href="alert_my.php" alt="" />
			<area shape="rect" coords="1,16,49,31" href="alert_list.php" alt="" />
		</map>
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
$client_program_list = "client_program_list.php";
$pds_bbs = "list_pds.php?bo_table=erp_pds";
$groupware = "groupware_business_log.php";

$pay_list = "javascript:alert('�غ����Դϴ�.');";
$setup_info = "javascript:alert('�غ����Դϴ�.');";
$remote_help = "remote_help.php";

//���Ѻ� ��ũ
$no_right = "javascript:alert('������ �����ϴ�.');";
if($member['mb_profile'] < 100) {
	$job_time_list = "support_person_list.php";
	$support_list = "client_application_list.php";
	$samu_list = "samu_list.php";
	$schedule_list = "list_notice_dealer.php?bo_table=erp_schedule";
	$account_list = "settlement_list.php";
} else {
	$job_time_list = $no_right;
	$support_list = $no_right;
	$samu_list = $no_right;
	$schedule_list = $no_right;
	$account_list = $no_right;
}
$pds_bbs = "list_pds_dealer.php?bo_table=erp_pds";

//���纰 ����
$mb_profile_code = $member['mb_profile'];
if($member['mb_level'] == 6) {
	$cnt_where = " and a.damdang_code = '$mb_profile_code' ";
	$cnt_where2 = " and damdang_code = '$mb_profile_code' ";
} else {
	$cnt_where = "";
	$cnt_where2 = "";
}
//������� ��ü ���� 160503
if($member['mb_level'] != 2) {
	$electric_charges_list = "electric_charges_list.php";
?>
			<div><?=$blank_menu?><a href="client_view_dealer.php" onmouseover='getId("img0").src="images/menu00_on.gif";showM("900");' onmouseout='getId("img0").src="images/menu00.gif"'><img src="images/menu00.gif" name='img0' border="0" id="img0" alt="�űԵ��" /></a></div>
			<div><?=$blank_menu?><a href="client_list_dealer.php" onmouseover='getId("img11").src="images/menu11_on.gif";showM("900");' onmouseout='getId("img11").src="images/menu11.gif"'><img src="images/menu11.gif" name='img11' border="0" id="img11" alt="�ŷ�ó����" /></a></div>
<?
} else {
	$electric_charges_list = "electric_charges_contractor.php";
}
//��� ����, ���¼������ ��ũ 160928
if($member['mb_id'] != 'saroon') {
?>
			<div><?=$blank_menu?><a href="<?=$electric_charges_list?>" onmouseover='getId("img21").src="images/menu_electric_on.gif";showM("900");' onmouseout='getId("img21").src="images/menu_electric.gif"'><img src="images/menu_electric.gif" name='img21' border="0" id="img21" alt="������������" /></a></div>
<?
}
//������� ��ü ���� 160503
if($member['mb_level'] != 2) {
	//����1 ������� �ڷ�� ���� 160401 / ���Ｍ�� �������(�����) ���� 160708 / ������4(��õ) ����� �̻� 160712
	if($mb_profile_code != 36 and $mb_profile_code != 52 and $mb_profile_code != 113) {
?>
			<div><?=$blank_menu?><a href="<?=$pds_bbs?>" onmouseover='getId("img22").src="images/menu21_on.gif";showM("1100");' onmouseout='getId("img22").src="images/menu21.gif"'><img src="images/menu21.gif" name='img22' border="0" id="img22" alt="�ڷ��" /></a></div>
<?
	}
	//����1 ������� ������ ǥ�� 160401
	if($mb_profile_code == 36) {
?>
			<div><?=$blank_menu?><a href="<?=$schedule_list?>" onmouseover='getId("img20").src="images/menu20_on.gif";showM("1400");' onmouseout='getId("img20").src="images/menu20.gif"'><img src="images/menu20.gif" name='img20' border="0" id="img20" alt="������" /></a></div>
<?
	}
}
//���� �Ҽ� ������ ��� �׷���� ǥ�� 160519
if($member['mb_profile'] == 1) {
?>
			<div><?=$blank_menu?><a href="<?=$groupware?>" onmouseover='getId("img7").src="images/menu07_on.gif";showM("700");' onmouseout='getId("img7").src="images/menu07.gif"'><img src="images/menu07.gif" name='img7' border="0" id="img7" alt="�׷����" /></a></div>
<?
}
?>
			<div><?=$blank_menu?><a href="setup_member_info.php" onmouseover='getId("img8").src="images/menu08_on.gif";showM("900");' onmouseout='getId("img8").src="images/menu08.gif"'><img src="images/menu08.gif" name='img8' border="0" id="img8" alt="ȯ�漳��" /></a></div>
			<div><?=$blank_menu?><a href="javascript:alert('������ ������ �� ����ȭ�鿡 �������ֽʽÿ�.');location.href='kcmc_erp.zip';" onmouseover="" onmouseout=""><img src="images/btn_url.gif" border="0" alt="�ٷ����Ӵٿ�ε�" /></a></div>
			<div><?=$blank_menu?><a href="<?=$remote_help?>"><img src="images/btn_remote_help.gif" border="0" alt="��������" /></a></div>
		</td>
