<?
$sub_menu = "600100";
include_once("./_common.php");

$sql_common = " from $g4[pibohum_base] ";

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

$sql_a4_opt = " select * from com_list_gy_opt where com_code = '$com_code' ";
$row_a4_opt = sql_fetch($sql_a4_opt);

$sub_title = "������ ���� ����";
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

//�Ի���
if($row1[in_day]) {
	$in_day_array = explode(".",$row1[in_day]);
	$in_day = $in_day_array[0]."�� ".$in_day_array[1]."�� ".$in_day_array[2]."��";
} else {
	$in_day = " ";
}
//������
if($row1[out_day]) {
	$out_day_array = explode(".",$row1[out_day]);
	$out_day = $out_day_array[0]."�� ".$out_day_array[1]."�� ".$out_day_array[2]."��";
} else {
	$out_day = " ";
}
//����
$sql_position = " select * from com_code_list where item='position' and code=$row2[position] ";
//echo $sql_position;
$result_position = sql_query($sql_position);
$row_position = sql_fetch_array($result_position);
$position = $row_position[name];
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
									<td><a href="form_4insure.php" onmouseover="limg1.src='images/menu06_sub01_on.gif'" onmouseout="limg1.src='images/menu06_sub01_off.gif'"><img src="images/menu06_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="form_labor.php"   onmouseover="limg2.src='images/menu06_sub02_on.gif'" onmouseout="limg2.src='images/menu06_sub02_off.gif'"><img src="images/menu06_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="form_inspect.php" onmouseover="limg3.src='images/menu06_sub03_on.gif'" onmouseout="limg3.src='images/menu06_sub03_off.gif'"><img src="images/menu06_sub03_off.gif" name="limg3" id="limg3" /></a></td>
								</tr>
							</table>
							<table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px">
								<tr>
									<td>
										<a href="http://e-consulting.kr" target="_blank"><img src="./images/banner01.gif" border="0"></a>
										<br>
										<a href="http://cafe.naver.com/kcmcceo" target="_blank"><img src="./images/banner02.gif" border="0"></a>
										<br>
										<a href="http://blog.naver.com/kcmc4519" target="_blank"><img src="./images/banner03.gif" border="0"></a>
									</td>
								</tr>
							</table>
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
var rooturl = 'http://e-consulting.kr/easynomu';
var rootssl = 'https://e-consulting.kr/easynomu';
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
				<input type="hidden" name="id" value="<?=$id?>" />
				<input type="hidden" name="code" value="<?=$code?>" />
				</form>
			</div>
		</td>
		<td>���� : <?=$row1[name]?> / �ֹε�Ϲ�ȣ : <?=$row1[jumin_no]?> / ���� : <?=$position?> / �Ի��� : <?=$in_day?> / ä������ : <?=$work_form?></td>
	</tr>
</table>

<form name = "HwpControl" id="HwpControl" method="post">
<input type="hidden" name="labor" value="retire1" />

<!--������ ���� ����-->
<input type="hidden" name="today" value="<?=date("Y�� m�� d��")?>" title="���ó�¥"/>
<input type="hidden" name="job_grade" value="3" title="ȣ��"/>
<input type="hidden" name="comp_type" value="A" title="���������"/>
<input type="hidden" name="comp_num" value="<?=$row_a4[biz_no]?> " title="����ڵ�Ϲ�ȣ" />
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

<input type="hidden" name="name_k" value="<?=$row1[name]?>" />
<input type="hidden" name="jumin" value="<?=$row1[jumin_no]?>" />
<input type="hidden" name="addr" value="<?=$row1[w_juso]?> " />
<input type="hidden" name="cel" value="<?=$row2[emp_cel]?>" title="�ڵ�����ȣ" />
<input type="hidden" name="tel" value="<?=$row1[add_tel]?>" title="��ȭ��ȣ" />

<input type="hidden" name="jdate" value="<?=$in_day?>" title="�Ի���" />
<input type="hidden" name="edate" value="<?=$out_day?>" title="�����" />
<input type="hidden" name="job_div" value="<?=$work_form?>" />

<input type="hidden" name="employee_id" value="<?=$row1[sabun]?>" title="���" />
<input type="hidden" name="dept" value=" " title="�μ�" />
<input type="hidden" name="jik" value="<?=$position?>" title="����" />

<input type="hidden" name="today_year" value="<?=date("Y")?>" title="�⵵"/>
<input type="hidden" name="today_month" value="<?=date("m")?>" title="��"/>
<input type="hidden" name="today_day" value="<?=date("d")?>" title="��"/>

<!-- �ѱ� ��Ʈ�� �� -->
<p style="margin-top:20px;z-index:-1;border:1px solid #ccc;width:">
	<object id="HwpCtrl" width="100%" height="1292" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
</p>
</form>
<script src="./js/hwpcontrol2.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript">
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
</script>
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
