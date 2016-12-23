<?
$sub_menu = "800900";
include_once("./_common.php");
$title_text = "원격지원";
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$title_text?> : 키즈노무</title>
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
				<table width="<?=$content_width?>" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname08.gif" /></td>
								</tr>
								<tr>
									<td><a href="list_notice.php?bo_table=oc_notice" onmouseover="limg1.src='images/menu08_sub01_on.gif'" onmouseout="limg1.src='images/menu08_sub01_off.gif'"><img src="images/menu08_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="list_notice.php?bo_table=oc_event"  onmouseover="limg2.src='images/menu08_sub02_on.gif'" onmouseout="limg2.src='images/menu08_sub02_off.gif'"><img src="images/menu08_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="list_notice.php?bo_table=oc_free"   onmouseover="limg3.src='images/menu08_sub03_on.gif'" onmouseout="limg3.src='images/menu08_sub03_off.gif'"><img src="images/menu08_sub03_off.gif" name="limg3" id="limg3" /></a></td>
								</tr>
								<tr>
									<td><a href="list_notice.php?bo_table=oc_pds"    onmouseover="limg4.src='images/menu08_sub04_on.gif'" onmouseout="limg4.src='images/menu08_sub04_off.gif'"><img src="images/menu08_sub04_off.gif" name="limg4" id="limg4" /></a></td>
								</tr>
								<tr>
									<td><a href="list_notice.php?bo_table=oc_online" onmouseover="limg5.src='images/menu08_sub05_on.gif'" onmouseout="limg5.src='images/menu08_sub05_off.gif'"><img src="images/menu08_sub05_off.gif" name="limg5" id="limg5" /></a></td>
								</tr>
							</table>
<?
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
												<td style='font-size:9pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$title_text?></span>
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
							<div style="width:910px;height:700px;background:url('./images/remote_support.png') no-repeat;">
								<div style="padding:450px 0 0 460px">
									<div id="ezHelpActivex"></div>
									<script src="http://939.co.kr/runezhelp.js"></script>
									<script>
									runezHelp({
									divid:'ezHelpActivex', //설치될 id
									userid:'15444519', //유저id
									width:'370', //가로길이
									height:'210', //세로 길이
									type:'1', //1:ActiveX부분만, 2:우측부분만, 3: 페이지전체
									set:'A' //A:자동모드(브라우저에 따라 자동으로 표출됨), N:실행파일접속 모드
									}) 
									</script>
								</div>
							</div>
						</td>
					</tr>
				</table>
<? include "./inc/bottom.php";?>
</div>
</body>
</html>
