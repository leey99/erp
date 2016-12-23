<?
$sub_menu = "500500";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sub_title = "개인정보보호교육";
$g4[title] = $sub_title." : 노무관리 : ".$easynomu_name;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
</script>
<? include "./inc/top.php"; ?>
<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
include "./inc/left_menu5.php";
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--타이틀 -->
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

							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<div style="height:700px">
								<div style="padding:4px 0 0 0;text-align:center">
									<img src="images/privacy_policy_statement_title.png">
								</div>
								<div style="padding:2px 0 0 0">
									<img src="images/privacy_policy_statement_download.png" usemap="#privacy_policy_statement_download" style="border: 0;" /></a>
									<map name="privacy_policy_statement_download">
    <area shape="rect" coords="113,20,312,54" href="files/hwp/1_개인정보보호법_주요내용.pdf" target="" alt="" />
    <area shape="rect" coords="316,20,514,56" href="files/hwp/2_개인정보위반_사례_및_대응.pdf" target="" alt="" />
    <area shape="rect" coords="517,20,738,53" href="files/hwp/3_개인정보_수집이용_서식_개선.pdf" target="" alt="" />
    <area shape="rect" coords="743,19,909,53" href="files/hwp/개인정보_보호법_교육_참석자_확인서.hwp" target="" alt="" />
									</map>
								</div>
								<div style="padding:20px 0 0 0">
									<img src="images/privacy_policy_statement_content.png">
								</div>
							</div>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
<iframe name="bonus_iframe" src="bonus_list_update.php" style="width:0;height:0" frameborder="0"></iframe>
</body>
</html>
