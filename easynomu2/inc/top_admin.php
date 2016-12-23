
<? $top_width = "1200"; ?>
<? $content_width = "1200"; ?>
<? $margin_right = "0"; ?>
<?
//사업장DB 옵션
$sql_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
//echo $sql_opt;
$result_opt = sql_query($sql_opt);
$row_opt=mysql_fetch_array($result_opt);
if(!$row_opt[manage_cust_numb]) {
	$manage_name = "이민화";
	$manage_tel = "070-4680-7050";
	$manage_fax = "0505-609-0001";

} else {
	//담당 매니저
	$sql_manage = " select * from a4_manage where code='$row_opt[manage_cust_numb]' ";
	//echo $sql_manage;
	$result_manage = sql_query($sql_manage);
	$row_manage=mysql_fetch_array($result_manage);
	$manage_name = $row_manage[name];
	$manage_tel = $row_manage[tel];
	$manage_fax = $row_manage[fax];
}
?>
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
<!--<div style="">-->
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align=center>
				<table width="<?=$top_width?>" align="center" border="0" cellpadding="0" cellspacing="0" style="margin:0 <?=$margin_right?>px 0 0;">
					<tr>
						<td width="200" align="left"><a href="main.php" target=""><img src="images/logo.png" /></a></td>
						<td style="padding:10px 0 0 0" align="left">
							<table border="0" align="right" cellpadding="0" cellspacing="0" id="tables">
								<tr>
									<td width="320" align="left">
										<marquee behavior=scrol>[ <?=$member['mb_name']?> ] 담당자님 반갑습니다. <?=$easynomu_name?>입니다.</marquee>
									</td>
									<td width="480" align="right">
										<div align="left" style="margin:0 10px 0 30px">
<?
//사업장DB 옵션
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
//echo $sql1;
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//담당 매니저
$sql_manage = " select * from a4_manage where code='$row_com_opt[manage_cust_numb]' ";
//echo $sql_manage;
$result_manage = sql_query($sql_manage);
$row_manage=mysql_fetch_array($result_manage);
if($row1[manage_cust_name]) {
	$manage_cust_name = $row1[manage_cust_name];
	$manage_cust_tel = "직통 : ".$row_manage[tel];
	$manage_cust_fax = "FAX : ".$row_manage[fax];
} else {
	$manage_cust_name = "미지정";
	$manage_cust_tel = "";
	$manage_cust_fax = "";
}
?>
										<?=$easynomu_name?> 담당자 : <?=$manage_cust_name?>&nbsp;&nbsp;&nbsp;
										<?=$manage_cust_tel?>&nbsp;&nbsp;&nbsp;
										<?=$manage_cust_fax?>
										<br>
										사무대행 담당자 : 이민화&nbsp;&nbsp;&nbsp;
										직통 : 070-4680-7050&nbsp;&nbsp;&nbsp;
										<!--직통 : 02-1111-1111&nbsp;&nbsp;&nbsp;-->
										FAX : 0505-609-0001
										<!--<br>프로그램 담당자 : 이영래&nbsp;&nbsp;&nbsp;
										직통 : 070-4680-7044&nbsp;&nbsp;&nbsp;-->
										</div>
									</td>
<?
if($is_admin == "super" && $member['mb_level'] != 6) {
?>
									<td align="left" style="padding:0 10px 0 0"><a href="/admin/member_list.php" target="_blank"><img src="images/btn_admin.png" border="0"></a></td>
<?
} else {
?>
									<td align="left" style="padding:0 10px 0 0"><a href="./files/Easy-Nomu.zip"><img src="images/btn_url.png" border="0"></a></td>
<?
}
?>
									<td align="left" style="padding:0 10px 0 0"><a href="./remote_support.php"><img src="images/btn_cyber.gif" border="0"></a></td>
									<td align="left"><a href="/bbs/logout.php?url=%2Feasynomu%2Flogin.php"><img src="images/btn_logout.gif" border="0"></a></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!--이지노무 2a549c 키즈노무 ef8036-->
			<td style="background:#2a549c;height:9px"></td>
		</tr>
		<tr>
			<td align="center">
				<script type="text/javascript">
				function getId(id)
				{
					return document.getElementById(id);
				}
				function showM(m)
				{
					for(i=1;i<10;i++) {
						hideM(i+"00");
					}
					var box = getId('subMenuBox'+m);
					if(box) {
						box.style.display = 'block';
						box.style.top = 0;
						//box.style.top = -20;
					}
				}
				function hideM(m)
				{
					var box = getId('subMenuBox'+m);
					if(box) box.style.display = 'none';
				}
				</script>
<?
//사업장DB 옵션
$sql_samu_req = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_samu_req = sql_query($sql_samu_req);
$row_samu_req=mysql_fetch_array($result_samu_req);
$samu_req_yn = $row_samu_req[samu_req_yn];
if($member['mb_level'] == 6 && $member['mb_profile'] != 1) {
	$menu7_url = "javascript:alert_no_right();";
	$menu9_url = "javascript:alert_no_right();";
	$menu10_url = "javascript:alert_no_right();";
} else {
	$menu7_url = "4insure_list_admin.php";
	$menu9_url = "total_pay_list_admin.php";
	$menu10_url = "a4_modify_list_admin.php";
}
?>
				<table width="<?=$top_width?>" height="45" border="0" align="center" cellpadding="0" cellspacing="0" style="background:url(./images/menu_bg.gif);margin:0 <?=$margin_right?>px 0 0">
					<tr>
						<td width="145" align="left"><div align="center"><a href='com_list_admin.php'     target="" onmouseover='img1.src="images/menu01_on.gif";' onmouseout='img1.src="images/menu01_off.gif"'><img src='images/menu01_off.gif' name='img1' border="0" id="img1" /></a></div></td>
						<td width="145" align="left"><div align="center"><a href='<?=$menu7_url?>'  target="" onmouseover='img7.src="images/menu07_on.gif";'  onmouseout='img7.src="images/menu07_off.gif"'><img  src='images/menu07_off.gif' name='img7'  border="0" id="img7" /></a></div></td>
						<td width="145" align="left"><div align="center"><a href='<?=$menu10_url?>' target="" onmouseover='img10.src="images/menu10_on.gif";' onmouseout='img10.src="images/menu10_off.gif"'><img src='images/menu10_off.gif' name='img10' border="0" id="img10" /></a></div></td>
						<td width="145" align="left"><div align="center"><a href='<?=$menu9_url?>'  target="" onmouseover='img9.src="images/menu09_on.gif";'  onmouseout='img9.src="images/menu09_off.gif"'><img  src='images/menu09_off.gif' name='img9'  border="0" id="img9" /></a></div></td>
						<td width="145" align="left"><div align="center"><a href='list_notice_admin.php?bo_table=oc_notice' target="" onmouseover='img8.src="images/menu08_on.gif";' onmouseout='img8.src="images/menu08_off.gif"'><img src='images/menu08_off.gif' name='img8' border="0" id="img8" /></a></div></td>
						<td width="<?=$top_width-(145*3)?>"></td>
					</tr>
				</table>
			</td>
    </tr>
	</table>
	<div style="margin-right:<?=$margin_right?>px;width:100%">