<?
$sub_menu = "1700200";
include_once("./_common.php");

$sql_common = " from com_list_gy a, job_education b, com_list_gy_opt c ";

$is_admin = "super";
//echo $is_admin;
if($member['mb_level'] == 6) {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and b.delete_yn != '1' and (damdang_code='$member[mb_profile]' or damdang_code2='$member[mb_profile]') ";
} else {
	$sql_search = " where a.com_code = b.com_code and a.com_code = c.com_code and b.delete_yn != '1' ";
	//���� ������� ����
	if($member['mb_level'] == 7) {
		$mb_id = $member['mb_id'];
		//���Ŵ��� �ڵ� üũ
		$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
		$row_manage = sql_fetch($sql_manage);
		$manage_code = $row_manage['code'];
		$sql_search .= " and c.manage_cust_numb='$manage_code' ";
	}
}
$sql_search .= " and a.danger_evaluate_if = '1' ";

// �˻� : ������Ī
if ($stx_com_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_name like '%$stx_com_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ����
if ($stx_uptae) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.uptae like '%$stx_uptae%') ";
	$sql_search .= " ) ";
}
// �˻� : ��ǥ��
if ($stx_boss_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.boss_name like '%$stx_boss_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ��ȭ��ȣ
if ($stx_comp_tel) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_tel like '%$stx_comp_tel%') ";
	$sql_search .= " ) ";
}
// �˻� : �ּ�
if ($stx_com_juso) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.com_juso like '%$stx_com_juso%') ";
	$sql_search .= " ) ";
}
// �˻� : ó����Ȳ
if ($stx_process) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.job_proxy = '$stx_process') ";
	$sql_search .= " ) ";
}
// �˻� : ó������
if ($stx_process_date) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.job_proxy_date = '$stx_process_date') ";
	$sql_search .= " ) ";
}
//�˻� : ����
if($stx_man_cust_name) {
	$sql_search .= " and ( ";
	//���� ó���� �ŷ�ó ����
	if($stx_man_cust_name != 1) {
		$sql_search .= " (a.damdang_code = '$stx_man_cust_name' or a.damdang_code2 = '$stx_man_cust_name') ";
	} else {
		$sql_search .= " (a.damdang_code = '$stx_man_cust_name' and a.damdang_code2 = '') ";
	}
	$sql_search .= " ) ";
}
//�˻� : ���� : �ѱ�����η°��� ��������
if($stx_hrd_korea) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.hrd_korea = '$stx_hrd_korea') ";
	$sql_search .= " ) ";
}
//�˻� : ��������
if($stx_train_kind) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.train_kind = '$stx_train_kind') ";
	$sql_search .= " ) ";
}
//�˻� : �����
if($stx_job_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (b.job_cust_name like '%$stx_job_name%') ";
	$sql_search .= " ) ";
}
//�˻� : ���輺��
if($stx_danger_evaluate_if) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.danger_evaluate_if = '$stx_danger_evaluate_if') ";
	$sql_search .= " ) ";
}
//����
if (!$sst) {
	$sst = "b.idx";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];
//������ 20�� / 100�� / ��ü
if ($stx_count) {
	if($stx_count == "all") $rows = 999;
	else $rows = $stx_count;
} else {
	$rows = 20;
}
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����
$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 11;
$top_sub_title = "images/top17_02.png";
$sub_title = "���輺�򰡰���";
$g4[title] = $sub_title." : ������Ʒ� : ".$easynomu_name;
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_uptae=".$stx_uptae."&stx_boss_name=".$stx_boss_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_comp_juso=".$stx_comp_juso;
$qstr .= "&stx_man_cust_name=".$stx_man_cust_name."&stx_train_kind=".$stx_train_kind."&stx_job_name=".$stx_job_name."&stx_count=".$stx_count."&stx_hrd_korea=".$stx_hrd_korea;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$_SERVER['PHP_SELF']?>";
	frm.submit();
	return;
}
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function checked_ok() {
	//alert("������ ������ �����ڿ��� �����Ͻʽÿ�.");
	//return;
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	if(cnt==0) {
	 alert("���õ� �����Ͱ� �����ϴ�.");
	 return;
	} else{
		if(confirm("���� �����Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			frm.action="job_education_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function open_memo(id) {
	var ret = window.open("./job_education_memo.php?id="+id, "window_memo", "scrollbars=yes,width=760,height=240");
	return;
}
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
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
	}
}
function goCheck_ok(obj) {
	//alert(obj.name+" "+obj.value);
	var id = obj.name.substring(9,14);
	var check_ok = obj.value;
	check_ok_iframe.location.href = "job_education_check_ok_update.php?id="+id+"&check_ok="+check_ok;
	return;
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top" style="padding:10px 20px 20px 20px;min-height:480px;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="">
				<tr>
					<td width="100"><img src="images/top19.gif" border="0" alt="����о�" /></td>
					<td><a href="<?=$_SERVER['PHP_SELF']?>"><img src="<?=$top_sub_title?>" border="0" alt="���輺��" /></a></td>
					<td>
<?
$title_main_no = "19";
include "inc/sub_menu.php";
?>
					</td>
				</tr>
				<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
			</table>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
				<tr>
					<td valign="top" style="padding:10px 0 0 0">
						<!--Ÿ��Ʋ -->	
<?
//��ü ����� ���� ����
if($is_admin == "super") {
	//echo $stx_man_cust_name;
?>
						<!--������ -->
						<table border=0 cellspacing=0 cellpadding=0> 
							<tr> 
								<td id=""> 
									<table border=0 cellpadding=0 cellspacing=0> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif"></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
											�˻�
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
						<form name="searchForm" method="get">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="80">������</td>
									<td nowrap class="tdrow">
										<input name="stx_com_name" type="text" class="textfm" style="width:160px;ime-mode:active;" value="<?=$stx_com_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="80">����</td>
									<td nowrap class="tdrow">
										<input name="stx_uptae" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$stx_uptae?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="80">��ǥ��</td>
									<td nowrap class="tdrow">
										<input name="stx_boss_name" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$stx_boss_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="80">��ȭ��ȣ</td>
									<td nowrap class="tdrow">
										<input name="stx_comp_tel"  type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$stx_comp_tel?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk" width="60">�ּ�</td>
									<td nowrap class="tdrow" colspan="<? if($member['mb_level'] <= 7) echo "3"; ?>">
										<input name="stx_com_juso" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$stx_com_juso?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
<?
if($member['mb_level'] > 7) {
?>
									<td nowrap class="tdrowk" width="60">����</td>
									<td nowrap class="tdrow">
										<select name="stx_man_cust_name" class="selectfm" onchange="goSearch();">
											<option value="">��ü</option>
<?
include "inc/stx_man_cust_name.php";
?>
										</select>
									</td>
<? } ?>
								</tr>
								<tr>
									<td nowrap class="tdrowk" style="font-weight:bold;">ó����Ȳ</td>
									<td nowrap class="tdrow">
										<select name="stx_process" class="selectfm" onchange="goSearch();">
											<option value=""  <? if($stx_process == "")  echo "selected"; ?>>��ü</option>
<?
$job_proxy_count = count($job_proxy_array);
for($i=1;$i<$job_proxy_count;$i++) {
?>
											<option value="<?=$i?>" <? if($stx_process == $i) echo "selected"; ?>><?=$job_proxy_array[$i]?></option>
<?
}
?>
										</select>
									</td>
									<td nowrap class="tdrowk">ó������</td>
									<td nowrap class="tdrow">
										<input name="stx_process_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$stx_process_date?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.searchForm.stx_process_date);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width=2></td></tr></table>
									</td>
									<td nowrap class="tdrowk">��������</td>
									<td nowrap class="tdrow">
										<select name="stx_train_kind" class="selectfm" onchange="goSearch();">
											<option value=""  <? if($stx_train_kind == "")  echo "selected"; ?>>��ü</option>
											<option value="1" <? if($stx_train_kind == "1") echo "selected"; ?>>��ü</option>
											<option value="2" <? if($stx_train_kind == "2") echo "selected"; ?>>����</option>
											<option value="3" <? if($stx_train_kind == "3") echo "selected"; ?>>ȥ��</option>
										</select>
									</td>
									<td nowrap class="tdrowk">�����</td>
									<td nowrap class="tdrow" colspan="">
										<input name="stx_job_name" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$stx_job_name?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
									</td>
									<td nowrap class="tdrowk">����</td>
									<td nowrap class="tdrow">
										<select name="stx_count" class="selectfm" onchange="">
											<option value="20"  <? if($stx_count == "20" || $stx_count == "")  echo "selected"; ?>>20��</option>
											<option value="100"  <? if($stx_count == "100")  echo "selected"; ?>>100��</option>
											<option value="all"  <? if($stx_count == "all")  echo "selected"; ?>>��ü</option>
										</select>
									</td>
									<td nowrap class="tdrowk">����</td>
									<td nowrap class="tdrow">
										<select name="stx_hrd_korea" class="selectfm">
											<option value="">��ü</option>
<?
//��������
$hrd_korea_name = array();
$sql_hrd_korea = " select * from hrd_korea order by idx asc ";
$result_hrd_korea = sql_query($sql_hrd_korea);
for ($i=0; $row_hrd_korea=mysql_fetch_assoc($result_hrd_korea); $i++) {
	$k = $row_hrd_korea['idx'];
	$hrd_korea_name[$k] = $row_hrd_korea['branch_name'];
?>
											<option value="<?=$k?>" <? if($k == $stx_hrd_korea) echo "selected"; ?> ><?=$hrd_korea_name[$k]?></option>
<?
}
?>
										</select>
									</td>
								</tr>
							</table>
						</form>
						<div style="height:10px;font-size:0px;line-height:0px;"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="javascript:goSearch();" target=""><img src="./images/btn_search_big.png" border="0"></a>
										<a href="job_education_excel.php?<?=$qstr?>" target=""><img src="./images/btn_excel_print_big.png" border="0"></a>
									</td>
								</tr>
							</table>
						</form>
						<div style="height:1px;font-size:0px"></div>
<? } ?>
						<!--��޴� -->
						<table border=0 cellspacing=0 cellpadding=0> 
							<tr>
								<td id=""> 
									<table border=0 cellpadding=0 cellspacing=0> 
										<tr> 
											<td><img src="images/g_tab_on_lt.gif"></td> 
											<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
											����Ʈ
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
						<!--����Ʈ -->
						<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="idx">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td class="tdhead_center" width="26"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()" ></td>
									<td class="tdhead_center" width="40">No</td>
									<td class="tdhead_center" width="70">����</td>
									<td class="tdhead_center" width="238">������</td>
									<td class="tdhead_center" width="86">KRAS���̵�</td>
									<td class="tdhead_center">���޸�</td>
									<td class="tdhead_center" width="65">üũList</td>
									<td class="tdhead_center" width="180">÷������</td>
									<td class="tdhead_center" width="68">�����</td>
									<td class="tdhead_center" width="70">��������</td>
									<td class="tdhead_center" width="80">ó����Ȳ</td>
								</tr>
<?
// ����Ʈ ���
for ($i=0; $row = mysql_fetch_assoc($result); $i++) {
	//NO �ѹ�
	$no = $total_count - $i - ($rows*($page-1));
  $list = $i%2;
	$id = $row[idx];
	//���ʱ�����
	if($row['permission_date']) $permission_date = $row['permission_date'];
	else $permission_date = "-";
	$com_name_full = $row[com_name];
	$com_name = cut_str($com_name_full, 28, "..");
	//����
	$upjong = $row['upjong'];
	if($row[upche_div] == "2") {
		$upche_div = "����";
	} else {
		$upche_div = "����";
	}
	//�ּ�
	$com_juso_full = $row['com_juso']." ".$row['com_juso2'];
	$com_juso = cut_str($com_juso_full, 38, "..");
	//�������
	if($row['w_date']) $w_date = $row['w_date'];
	else $w_date = "-";
	//��������
	$hrd_korea_code = $row['hrd_korea'];
	if($hrd_korea_code) $hrd_korea_branch_name = $hrd_korea_name[$hrd_korea_code];
	else $hrd_korea_branch_name = "-";
	//kras���̵�
	if($row['job_kras_id']) $job_kras_id = $row['job_kras_id'];
	else $job_kras_id = "-";
	if($row['job_kras_pw']) $job_kras_pw = $row['job_kras_pw'];
	else $job_kras_pw = "-";
	//����
	$sql_jop_opt = " select * from job_education_opt where mid='$id' and delete_yn != '1' ";
	$row_jop_opt = sql_fetch($sql_jop_opt);
	$train_kind = $row_jop_opt['train_kind'];
	if($train_kind == 1) $train_kind_text = "��ü";
	else if($train_kind == 2) $train_kind_text = "����";
	else if($train_kind == 3) $train_kind_text = "ȥ��";
	else $train_kind_text = "";
	if($train_kind_text) $train_kind_text_display = "<span style='color:blue'>(".$train_kind_text.")</span>";
	else $train_kind_text_display = "";
	//�޸�
	if($row['job_memo']) $memo_full = $row['job_memo'];
	else $memo_full = "���޸� ����";
	$memo = cut_str($memo_full, 48, "..");
	//������
	$damdang_code = $row['damdang_code'];
	if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
	else $branch = "-";
	$damdang_code2 = $row['damdang_code2'];
	if($damdang_code2) $branch = $man_cust_name_arry[$damdang_code2];
	if(!$row[writer_tel]) $row[writer_tel] = "-";
	if(!$row[process_date]) $row[process_date] = "-";
	if(!$row[process_date2]) $row[process_date2] = "-";
	//����
	$sql_comment = " select count(*) as cnt from job_education_comment where mid='$id' and delete_yn != '1' ";
	$row_comment = sql_fetch($sql_comment);
	$comment_count = $row_comment[cnt];
	if($comment_count != 0) $comment_count = "[".$comment_count."]";
	else $comment_count = "";
	//���� �ֽű� new ǥ��
	$sql_comment_new = " select * from job_education_comment where mid='$id' and delete_yn!='1' order by regdt desc limit 0,1 ";
	//echo $sql_comment_new;
	$row_comment_new = sql_fetch($sql_comment_new);
	//echo date("Y-m-d H:i:s", time() - 12 * 3600);
	//echo $row_comment_new[regdt];
	if($row_comment_new[regdt] >= date("Y-m-d H:i:s", time() - 12 * 3600)) { 
		$comment_new = "<img src='images/icon_new.gif' border='0' style='vertical-align:middle;'>";
	} else {
		$comment_new = "";
	}
	$comment_cnt = $comment_count.$comment_new;
	//üũ����Ʈ
	$job_file_check = explode(',',$row['job_file_check']);
	if($job_file_check[0] == 1) $check_list = "���";
	else $check_list = "-";
	//÷������
	$file_list = "";
	if($job_file_check[1] == 1) $file_list .= "��鵵.";
	else $file_list .= "";
	if($job_file_check[2] == 1) $file_list .= "����.";
	else $file_list .= "";
	if($job_file_check[3] == 1) $file_list .= "�����ð�ǥ.";
	else $file_list .= "";
	if($job_file_check[4] == 1) $file_list .= "�����ڷ�.";
	else $file_list .= "";
	if($job_file_check[5] == 1) $file_list .= "HRD��û��.";
	else $file_list .= "";
	if($job_file_check[6] == 1) $file_list .= "�����ڸ��.";
	else $file_list .= "";
	if($job_file_check[7] == 1) $file_list .= "��������.";
	else $file_list .= "";
	//�����
	if($row['job_cust_name']) $job_cust_name = $row['job_cust_name'];
	else $job_cust_name = "-";
	//����å���� �̸�
	if($row['chief_name']) $chief_name = $row['chief_name'];
	else $chief_name = "-";
	//����å���� ����
	if($row['chief_position']) $chief_position = $row['chief_position'];
	else $chief_position = "";
	//����å����
	$chief = $chief_name." ".$chief_position;
	//����
	if($row['teacher_name']) $teacher = $row['teacher_name'];
	else $teacher = "-";
	//����2
	if($row['teacher_name2']) $teacher .= ", ".$row['teacher_name2'];
	//��������
	$education_conduct_report = $row_jop_opt['education_conduct_report'];
	$education_close_date = $row_jop_opt['education_close_date'];
	if(!$education_conduct_report) $education_conduct_report = "-";
	if(!$education_close_date) $education_close_date = "-";
	//ó����Ȳ
	$job_proxy = $row['job_proxy'];
	if($job_proxy) $job_proxy_text = $job_proxy_array[$job_proxy];
	else $job_proxy_text = "-";
	//ó������
	if($row['job_proxy_date']) $job_proxy_date = $row['job_proxy_date'];
	else $job_proxy_date = "-";
	//�������, ���� ����� ȸ�� �� ǥ��
	if($job_proxy == '12') {
		$tr_class = "list_row_now_gr";
		$job_proxy_text_cancel = "<span style='color:red;'>(�������)</span>";
	} else if($job_proxy == '13') {
		$tr_class = "list_row_now_gr";
		$job_proxy_text_cancel = "<span style='color:red;'>(����)</span>";
	} else {
		$tr_class = "list_row_now_wh";
		$job_proxy_text_cancel = "";
	}
	if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
		$com_view = "javascript:alert('�ش� ���� ������ ���� ������Ʒð��� �������� �̵��մϴ�.');self.location.href='job_education_view.php?id=$id&w=u&$qstr&page=$page';";
	} else {
		$com_view = "javascript:alert('�ش� ������ ������ ������ �����ϴ�.');";
	}
?>
								<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
									<td class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$id?>" class="no_borer"></td>
									<td class="ltrow1_center_h22"><?=$no?></td>
									<td class="ltrow1_center_h22"><?=$branch?></td>
									<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
										<a href="<?=$com_view?>" style="font-weight:bold"><?=$com_name?><?=$train_kind_text_display?><?=$job_proxy_text_cancel?></a>
										<br><?=$com_juso?>
									</td>
									<td class="ltrow1_center_h22"><?=$job_kras_id?><br><?=$job_kras_pw?></td>
									<td class="ltrow1_left_h22" title="<?=$memo_full?>">
										<a href="javascript:open_memo('<?=$id?>')"><?=$memo?></a><?=$comment_cnt?>
									</td>
									<td class="ltrow1_center_h22"><?=$check_list?></td>
									<td class="ltrow1_left_h22" style="word-wrap:break-word;"><?=$file_list?></td>
									<td class="ltrow1_center_h22"><?=$job_cust_name?></td>
									<td class="ltrow1_center_h22"><?=$education_conduct_report?><br><?=$education_close_date?></td>
									<td class="ltrow1_center_h22"><?=$job_proxy_text?><br><?=$job_proxy_date?></td>
								</tr>
<?
}
if ($i == 0)
    echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>
								<tr>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
									<td class="tdhead_center"></td>
								</tr>
							</table>

							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "?$qstr&page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
<?
if($is_admin == "super" && $member['mb_level'] != 6) {
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;">
											<tr>
												<td width="2"></td>
												<td><img src="images/btn_lt.gif" /></td>
												<td background="images/btn_bg.gif" class"=ftbutton1" nowrap><a href="javascript:checked_ok();" target="">���û���</a></td>
												<td><img src="images/btn_rt.gif" /></td>
											 <td width="2"></td>
											</tr>
										</table>
<?
}
?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<iframe name="check_ok_iframe" src="check_ok_update.php" style="width:0;height:0" frameborder="0"></iframe>
<? include "./inc/bottom.php";?>
</body>
</html>
