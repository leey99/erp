<?
$sub_menu = "700100";
include_once("./_common.php");

$sql_common = " from $g4[pibohum_base] ";

$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where com_code='$com_code' ";
}

//echo $stx_name;
// �˻� : ����
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (name like '$stx_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ���
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}

if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "sabun";
	}
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

$rows = 15;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$sub_title = "��ü����";
$g4[title] = $sub_title." : 4�뺸����� : �����빫";

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

$colspan = 11;
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
</script>
<? include "./inc/top.php"; ?>

<script type="text/javascript">
//<![CDATA[
var mbrclick= false;
var rooturl = 'http://www.easynomu.com/easynomu';
var rootssl = 'https://www.easynomu.com/easynomu';
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

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname07.gif" /></td>
								</tr>
								<tr>
									<td><a href="form_4insure.php" onmouseover="limg1.src='images/menu07_sub01_on.gif'" onmouseout="limg1.src='images/menu07_sub01_off.gif'"><img src="images/menu07_sub01_off.gif" name="limg1" id="limg1" /></a></td>
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
<?
// ������ : ������ڵ�
$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$com_code' ";
//echo $sql_com;
$row_com = sql_fetch($sql_com);
$com_name = $row_com[com_name];
$com_name = cut_str($com_name, 21, "..");
?>
							<div id="rcontent" class="center m_side">
								<form name = "HwpControl" id="HwpControl" method="post">
								<table border="0">
									<tr  valign="top">
										<td style="background:url('./images/tab_bg01.gif') no-repeat;width:460px;height:150px">
											<div style="margin:22px 0 0 28px;">
												<!-- �ٷ��ڸ���Ʈ���� -->
												<div style="float:left;width:40px">
													<img src="./images/tab01.gif">
												</div>
												<div style="width:220px;height:100px;overflow-y:auto;border:1px solid #cccccc;float:left;">
													<?
													// ����Ʈ ���
													for ($i=0; $row=sql_fetch_array($result); $i++) {
														//$page
														//$total_page
														//$rows

														$no = $total_count - $i - ($rows*($page-1));
														$list = $i%2;
														$name = cut_str($row[name], 6, "..");
														$id = $row[com_code]."_".$row[sabun];
													?>
													<input type="checkbox" name="employee[]" value="<?=$id?>" >[<?=$row[sabun]?>] <?=$name?> (<?=$row[in_day]?>)</option><br />
													<?
													}
													if ($i == 0)
															echo "�ڷᰡ �����ϴ�.";
													?>
												</div>
												<div style="float:left;">
													<div style="padding:0 0 0 6px"  ><img src="./images/tab01_btn01_off.gif" name="bohum1" onClick="checkSubmit(this.name,1,4)" style="cursor:pointer" /></div>
													<div style="padding:6px 0 0 6px"><img src="./images/tab01_btn02_off.gif" name="bohum2" onClick="checkSubmit(this.name,1,7)" style="cursor:pointer" /></div>
 													<div style="padding:6px 0 0 6px"><img src="./images/tab01_btn03_off.gif" name="bohum3" onClick="checkSubmit(this.name,1,1)" style="cursor:pointer" /></div>
													<div style="padding:6px 0 0 6px"><img src="./images/tab01_btn04_off.gif" name="bohum4" onClick="checkSubmit(this.name,1,9)" style="cursor:pointer" /></div>
												</div>
											</div>
										</td>
										<td width="10">&nbsp;</td>
										<td style="background:url('./images/tab_bg04.gif') no-repeat;width:440px;height:150px">
											<div style="margin:22px 0 0 24px;">
												<!-- �ٷ��ڸ���Ʈ���� -->
												<div style="float:left;width:40px">
													<img src="./images/tab02_bg.gif">
												</div>
												<div style="float:left;margin:4px 0 0 0">
													<a href="http://total.kcomwel.or.kr" target="_blank"><img src="./images/go01.gif" border="0"></a>
												</div>
												<div style="float:left;margin:4px 0 0 5px">
													<a href="http://www.4insure.or.kr" target="_blank"><img src="./images/go02.gif" border="0"></a>
												</div>
											</div>
										</td>
									</tr>
								</table>
								<?
								//$bohum = "bohum5";
								?>
								<input type="hidden" name="bohum" value="<?=$bohum?>" />
								<!--�ѱ� ��Ʈ�� ������-->
								<input type="hidden" name="comp_type" value="<?=$row_a4[upche_div]?>" title="���������"/>
								<input type="hidden" name="comp_num" value="<?=$row_a4[biz_no]?>" title="����ڵ�Ϲ�ȣ" />
								<input type="hidden" name="comp_name" value="<?=$row_a4[com_name]?>" title="������" />
								<input type="hidden" name="comp_ceo" value="<?=$row_a4[boss_name]?>" title="��ǥ�ڸ�" />
								<input type="hidden" name="comp_upte" value="<?=$row_a4[uptae]?>" title="����" />
								<input type="hidden" name="comp_jongmok" value="<?=$row_a4[upjong]?>" title="����" />
								<input type="hidden" name="comp_tel" value="<?=$row_a4[com_tel]?>" title="�������ȭ" />
								<input type="hidden" name="comp_fax" value="<?=$row_a4[com_fax]?>" title="������ѽ�" />
								<input type="hidden" name="comp_cel" value="<?=$row_a4[boss_hp]?>" title="��ǥ���ڵ���" />
								<input type="hidden" name="comp_email" value="<?=$row_a4[com_mail]?>" title="�����email" />
								<input type="hidden" name="comp_addr1" value="<?=$row_a4[com_juso]?>" title="������ּ�1" />
								<input type="hidden" name="comp_addr2" value="<?=$row_a4[com_juso2]?>" title="������ּ�2" />
								<?
								//$yoyul = 2;
								?>
								<input type="hidden" name="yoyul" value="<?=$yoyul?>" title="�������" />
								<input type="hidden" name="mb_name" value="<?=$com_name?>" />
								<?
								//�ڰ����Ű�
								if($bohum == "bohum1") {
									for($i=0;$i<count($employee);$i++) {
										//echo $employee[$i];
										$employee_array[$i] = explode("_",$employee[$i]);
										//echo $employee_array[$i][1];
										$code  = $employee_array[$i][0];
										$sabun = $employee_array[$i][1];
										$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$sabun' ";
										//echo $sql1;
										$result1 = sql_query($sql1);
										$row1=mysql_fetch_array($result1);
										$extra = 4 - $i;
								?>
								<input type="hidden" name="emp_name" value="<?=$row1[name]?> " />
								<input type="hidden" name="emp_jumin" value="<?=$row1[jumin_no]?> " />
								<input type="hidden" name="emp_jdate" value="<?=$row1[in_day]?> " title="�Ի���"  />
								<input type="hidden" name="emp_pay" value="1,521,090" />
								<input type="hidden" name="emp_jogun" value="209" />
								<?
									}
									for($i=1;$i<$extra;$i++) {
								?>
								<input type="hidden" name="emp_name" value=" " />
								<input type="hidden" name="emp_jumin" value=" " />
								<input type="hidden" name="emp_jdate" value=" " title="�Ի���"  />
								<input type="hidden" name="emp_pay" value=" " />
								<input type="hidden" name="emp_jogun" value=" " />
								<?
									}
								//�ڰݻ�ǽŰ�
								} else if($bohum == "bohum2") {
									for($i=0;$i<count($employee);$i++) {
										$no = $i+1;
										//echo $employee[$i];
										$employee_array[$i] = explode("_",$employee[$i]);
										//echo $employee_array[$i][1];
										$code  = $employee_array[$i][0];
										$sabun = $employee_array[$i][1];
										$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$sabun' ";
										//echo $sql1;
										$result1 = sql_query($sql1);
										$row1=mysql_fetch_array($result1);
										$extra = 7 - $i;
								?>
								<input type="hidden" name="emp_no" value="<?=$no?>" />
								<input type="hidden" name="emp_name" value="<?=$row1[name]?> " />
								<input type="hidden" name="emp_jumin" value="<?=$row1[jumin_no]?> " />
								<input type="hidden" name="emp_cel" value="01023456789" />
								<input type="hidden" name="emp_rdate" value="<?=$row1[out_day]?> " title="�����"  />
								<input type="hidden" name="emp_sayu" value=" "  />
								<input type="hidden" name="emp_cnt1" value="8" />
								<input type="hidden" name="emp_hap1" value="8,558,940" />
								<input type="hidden" name="emp_cnt2" value="0" />
								<input type="hidden" name="emp_hap2" value="0" />
								<input type="hidden" name="emp_pay" value="392,536" />
								<?
									}
									for($i=1;$i<$extra;$i++) {
								?>
								<input type="hidden" name="emp_no" value=" " />
								<input type="hidden" name="emp_name" value=" " />
								<input type="hidden" name="emp_jumin" value=" " />
								<input type="hidden" name="emp_cel" value=" " />
								<input type="hidden" name="emp_rdate" value=" " title="�����"  />
								<input type="hidden" name="emp_sayu" value=" "  />
								<input type="hidden" name="emp_cnt1" value=" " />
								<input type="hidden" name="emp_hap1" value=" " />
								<input type="hidden" name="emp_cnt2" value=" " />
								<input type="hidden" name="emp_hap2" value=" " />
								<input type="hidden" name="emp_pay" value=" " />
								<?
									}
								//�Ǻξ��ڰݽŰ�
								} else if($bohum == "bohum3") {
									//echo $id;
									//echo "employee[0] : ".$employee[0];
									//echo "employee[1] : ".$employee[1];
									$id_array = explode("_",$employee[0]);
									$code = $id_array[0];
									$sabun = $id_array[1];
									$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$sabun' ";
									//echo $sql1;
									$result1 = sql_query($sql1);
									$row1 = mysql_fetch_array($result1);

									$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$sabun' ";
									$result2 = sql_query($sql2);
									$row2 = mysql_fetch_array($result2);

									$sql3 = " select * from pibohum_gg where com_code='$code' and sabun='$sabun' ";
									$result3 = sql_query($sql3);
									//$row3=mysql_fetch_array($result3);
									//����ó
									if(!$row1[add_tel]) {
										$tel_cel = $row2[emp_cel];
									} else {
										$tel_cel = $row1[add_tel];
									}
									//�Ǻξ���
									//fy_apply ���/��� ���� 0 : ���, 1 : ���
								?>
								<input type="hidden" name="date1" value="2013��10��30��" />
								<input type="hidden" name="emp_name" value="<?=$row1[name]?>" />
								<input type="hidden" name="emp_jumin" value="<?=$row1[jumin_no]?>" />
								<input type="hidden" name="emp_cel" value="<?=$tel_cel?>"  />
								<?
									for ($i=0; $row3=sql_fetch_array($result3); $i++) {
								?>
								<input type="hidden" name="relation" value="�� "  />
								<input type="hidden" name="fy_name" value="ȫ�浿 "  />
								<input type="hidden" name="fy_jumin_no" value=" "  />
								<input type="hidden" name="fy_get_loss_date" value=" "  />
								<input type="hidden" name="fy_apply_txt" value="05 "  />
								<?
									}
								//�����Ѿ׽Ű�
								} else if($bohum == "bohum4") {
									for($i=0;$i<count($employee);$i++) {
										$employee_array[$i] = explode("_",$employee[$i]);
										$code  = $employee_array[$i][0];
										$sabun = $employee_array[$i][1];
										$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$sabun' ";
										$result1 = sql_query($sql1);
										$row1 = mysql_fetch_array($result1);
										$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$sabun' ";
										$result2 = sql_query($sql2);
										$row2 = mysql_fetch_array($result2);
										//����ó
										if(!$row1[add_tel]) {
											$tel_cel = $row2[emp_cel];
										} else {
											$tel_cel = $row1[add_tel];
										}
										//������ ���� �� ���� ó��
										if($row1[in_day] == "") $row1[in_day] = " ";
										if($row1[out_day] == "") $row1[out_day] = " ";
								?>
								<input type="hidden" name="emp_name" value="<?=$row1[name]?> " />
								<input type="hidden" name="emp_jumin" value="<?=$row1[jumin_no]?> " />
								<input type="hidden" name="emp_cel" value="<?=$tel_cel?>" />
								<input type="hidden" name="emp_jdate" value="<?=$row1[in_day]?>" />
								<input type="hidden" name="emp_rdate" value="<?=$row1[out_day]?>" />
								<input type="hidden" name="emp_cnt" value="8" />
								<input type="hidden" name="emp_hap" value="8,558,940" />
								<input type="hidden" name="emp_avg" value="1,069,868" />
								<?
									}
									$bohum4_count = 9 - count($employee);
									for($i=0;$i<$bohum4_count;$i++) {
								?>
								<input type="hidden" name="emp_name" value=" " />
								<input type="hidden" name="emp_jumin" value=" " />
								<input type="hidden" name="emp_cel" value=" " />
								<input type="hidden" name="emp_jdate" value=" " />
								<input type="hidden" name="emp_rdate" value=" " />
								<input type="hidden" name="emp_cnt" value=" " />
								<input type="hidden" name="emp_hap" value=" " />
								<input type="hidden" name="emp_avg" value=" " />
								<?
									}
								}
								?>
								<!-- �ѱ� ��Ʈ�� �� -->
								<p style="margin-top:20px;z-index:-1;border:1px solid #ccc;width:">
									<object id="HwpCtrl" width="100%" height="650" align="center" classid="CLSID:BD9C32DE-3155-4691-8972-097D53B10052"></object>
								</p>
								</form>
							</div>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
<script src="./js/hwpcontrol.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript">
<?
if($bohum == "bohum1") {
?>
document.getElementById('HwpCtrl').style.height = "2570px";
<?
} else if($bohum == "bohum2" || $bohum == "bohum3" || $bohum == "bohum4") {
?>
document.getElementById('HwpCtrl').style.height = "1310px";
<?
} else if($bohum == "bohum5") {
?>
function setAppendRow(){
	TableAppendRowContents("tbl_s", new Array("1","�豳��","3","1,521,090","68,450","34,800","2,280","8,890","114,420","68,450","34,800","2,280","8,890","3,800","10,640","128,860","243,280"));
	TableAppendRowContents("tbl_s", new Array("2","������","7","1,834,370","82,550","54,020","3,540","10,090","150,200","82,550","54,020","3,540","10,090","4,580","12,840","167,620","317,820"));
	TableAppendRowContents("tbl_s", new Array("3","�ڻ��","10","2,009,180","90,410","59,170","3,880","11,050","164,510","90,410","59,170","3,880","11,050","5,020","14,060","183,590","348,100"));
	TableAppendRowContents("tbl_s", new Array("4","�չ���","2","1,375,580","61,900","40,510","2,650","7,570","112,630","61,900","40,510","2,650","7,570","3,430","9,620","125,680","238,310"));
	TableAppendRowContents("tbl_s", new Array("5","������","0","1,436,800","64,660","42,310","2,770","9,340","119,080","64,660","42,310","2,770","9,340","0","0","119,080","238,160"));
	TableAppendRowContents("tbl_s", new Array("6","�̲ɴ�","2","1,429,380","66,400","42,100","2,760","9,290","120,550","66,400","42,100","2,760","9,290","3,570","10,000","134,120","254,670"));
	TableAppendRowContents("tbl_s", new Array("7","õ�緡","1","1,434,050","64,530","42,230","2,770","7,890","117,420","64,530","42,230","2,770","7,890","3,580","10,030","131,030","248,450"));
	TableAppendRowContents("tbl_s", new Array("8","����ȣ","10","2,368,760","106,590","69,760","4,570","13,030","193,950","106,590","69,760","4,570","13,030","5,920","16,580","216,450","410,400"));
	TableAppendRowContents("tbl_s", new Array("9","�ϳ���","1","1,974,740","64,530","58,160","3,810","12,840","139,340","64,530","58,160","3,810","12,840","4,930","13,820","158,090","297,430"));
	TableAppendRowContents("tbl_s", new Array("10","��ȳ�","5","1,617,060","72,770","47,620","3,120","8,890","132,400","72,770","47,620","3,120","8,890","4,040","11,310","147,750","280,150"));
	TableAppendRowContents("tbl_s", new Array("","��    ��","","17,001,010","742,790","490,680","32,150","98,880","1,364,500","742,790","490,680","32,150","98,880","38,870","108,900","1,512,270","2,876,770"));
}
<?
}
?>
</script>
</body>
</html>
