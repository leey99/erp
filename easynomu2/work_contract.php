<?
$sub_menu = "600100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sql_common = " from $g4[pibohum_base] ";

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);

$sub_title = "�ٷΰ�༭";
$g4[title] = $sub_title." : ������� : ".$easynomu_name;

$colspan = 11;

$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$id' ";
//echo $sql1;
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);

$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
//echo $sql2;
$result2 = sql_query($sql2);
$row2=mysql_fetch_array($result2);

$sql3 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
//echo $sql3;
$result3 = sql_query($sql3);
$row3=mysql_fetch_array($result3);

//�Ի���
$in_day_array = explode(".",$row1[in_day]);
$in_day = $in_day_array[0]."�� ".$in_day_array[1]."�� ".$in_day_array[2]."��";
//������
if($row1[out_day] == "") {
	$out_day = "��������";
} else {
	$out_day_array = explode(".",$row1[out_day]);
	$out_day = $out_day_array[0]."�� ".$out_day_array[1]."�� ".$out_day_array[2]."��";
}

//ä������
if($row1[work_form] == "") $work_form = "";
else if($row1[work_form] == "1") $work_form = "������";
else if($row1[work_form] == "2") $work_form = "�����";
else if($row1[work_form] == "3") $work_form = "�Ͽ���";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
// ���� �˻� Ȯ��
function del(page,id) 
{
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
function back_url() {
	//location.href = "staff_view.php?id=<?=$id?>&code=<?=$code?>&page=<?=$page?>";
	location.href = "staff_list.php?page=<?=$page?>";
}
function work_contract_ok() {
	document.work_contract_form.submit();
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname06.gif" /></td>
								</tr>
								<tr>
									<td><a href="form_labor.php"   onmouseover="limg2.src='images/menu06_sub02_on.gif'" onmouseout="limg2.src='images/menu06_sub02_off.gif'"><img src="images/menu06_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="form_inspect.php" onmouseover="limg3.src='images/menu06_sub03_on.gif'" onmouseout="limg3.src='images/menu06_sub03_off.gif'"><img src="images/menu06_sub03_off.gif" name="limg3" id="limg3" /></a></td>
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


<script type="text/javascript">
//<![CDATA[
var mbrclick= false;
var rooturl = '<?=$rooturl?>';
var rootssl = '<?=$rootssl?>';
var raccount= 'home';
var moduleid= 'home';
var memberid= 'master';
var is_admin= '0';
var needlog = '�α����Ŀ� �̿��Ͻ� �� �ֽ��ϴ�. ';
var neednum = '���ڸ� �Է��� �ּ���.';
var myagent	= navigator.appName.indexOf('Explorer') != -1 ? 'ie' : 'ns';
//]]>
</script>
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<div id="rcontent" class="center m_side">
	<table border="0">
		<tr>
			<td>
				<div style="padding:2px">
					<form name="work_contract_form" method="post" action="work_contract_ok.php">
					<input type="button" name="history_back_bt" value="�������" onclick="back_url()" /> 
<?
if($row2[work_contract] != 1) {
?>
					<input type="button" name="work_contract_bt" value="�ۼ��Ϸ�" onclick="work_contract_ok()" /> 
<? } ?>
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="hidden" name="code" value="<?=$code?>" />
					</form>
				</div>
			</td>
			<td>���� : <?=$row1[name]?> / �ֹε�Ϲ�ȣ : <?=$row1[jumin_no]?> / �Ի��� : <?=$in_day?> / ä������ : <?=$work_form?></td>
		</tr>
	</table>
<?
$pay_gbn = $row2[pay_gbn];
?>
<form name = "HwpControl" id="HwpControl" method="post">
	<input type="hidden" name="labor" value="labor1" />
	<input type="hidden" name="pay_gbn" value="<?=$pay_gbn?>" />
	<!-- �ٷΰ�༭ -->
	<input type="hidden" name="addtxt11_0" value="����ó�찳����" title="��������1"/>
	<input type="hidden" name="addtxt11_1" value="�ٹ�ȯ�氳����" title="��������3"/>
	<input type="hidden" name="addtxt11_2" value="Ư������" title="��������5"/>
	<input type="hidden" name="addtxt11_3" value="Ư���������" title="��������7"/>
	<input type="hidden" name="addtxt11_4" value="�����Ư������" title="��������9"/>
	<input type="hidden" name="addtxt11_5" value="���Ӽ���" title="��������11"/>
	<input type="hidden" name="addtxt12_0" value="0" title="��������2"/>
	<input type="hidden" name="addtxt12_1" value="0" title="��������4"/>
	<input type="hidden" name="addtxt12_2" value="0" title="��������6"/>
	<input type="hidden" name="addtxt12_3" value="0" title="��������8"/>
	<input type="hidden" name="addtxt12_4" value="0" title="��������10"/>
	<input type="hidden" name="addtxt12_5" value="0" title="��������12"/>

	<input type="hidden" name="today" value="<?=date("Y�� m�� d��")?>" title="���ó�¥"/>
	<input type="hidden" name="job_grade" value="3" title="ȣ��"/>
	<input type="hidden" name="comp_type" value="A" title="���������"/>
	<input type="hidden" name="comp_num" value="<?=$row_a4[biz_no]?> " title="����ڵ�Ϲ�ȣ" />
	<input type="hidden" name="bupin_no" value="<?=$row_a4['bupin_no']?> " title="���ε�Ϲ�ȣ" />
	<input type="hidden" name="comp_name" value="<?=$row_a4[com_name]?> " title="������" />
	<input type="hidden" name="comp_ceo" value="<?=$row_a4[boss_name]?> " title="��ǥ�ڸ�" />
	<input type="hidden" name="comp_upte" value="<?=$row_a4[uptae]?> " title="����" />
	<input type="hidden" name="comp_jongmok" value="<?=$row_a4[upjong]?> " title="����" />
	<input type="hidden" name="comp_tel" value="<?=$row_a4[com_tel]?> " title="�������ȭ" />
	<input type="hidden" name="comp_fax" value="<?=$row_a4[com_fax]?> " title="������ѽ�" />
	<input type="hidden" name="comp_cel" value="<?=$row_a4[boss_hp]?> " title="��ǥ���ڵ���" />
	<input type="hidden" name="comp_email" value=""<?=$row_a4_opt[boss_mail]?> " title="��ǥ��email" />
	<input type="hidden" name="comp_addr1" value="<?=$row_a4[com_juso]?> " title="������ּ�1" />
	<input type="hidden" name="comp_addr2" value="<?=$row_a4[com_juso2]?> " title="������ּ�2" />

	<input type="hidden" name="mb_name" value="<?=$row_a4[com_name]?>" />

	<!-- �ٷΰ�༭ -->
<?
include "inc/work_contract_inc.php";
?>
	<!-- �ѱ� ��Ʈ�� �� -->
	<p style="margin-top:20px;z-index:-1;border:1px solid #ccc;width:">
		<object id="HwpCtrl" width="100%" height="650" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
	</p>
	</form>
	<script type="text/javascript">
	document.getElementById('HwpCtrl').style.height = "710px";
	function setAppendRow1(){
	}

	function setAppendRow2(){
	}

	function setAppendRow3(){
	}

	function setAppendRow4(){
	}

	function setAppendRow5(){
	}

	function setAppendRow6(){
	}
	//toggleLayer('employeeList',this.name);
	</script>
<?
if($member['mb_id'] == "410-86-38857") $work_contract_js = "work_contract_cns";
else if($member['mb_id'] == "140-09-48514") $work_contract_js = "work_contract_20695";
else $work_contract_js = "work_contract";
?>
	<script src="./js/<?=$work_contract_js?>.js" type="text/javascript" charset="euc-kr"></script>
</div>



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