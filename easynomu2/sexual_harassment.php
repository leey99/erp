<?
$sub_menu = "500400";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$sub_title = "성희롱예방교육";
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
							<div style="background:url('images/sexual_harassment_bg.png') no-repeat;height:1000px">
								<div style="float:left;padding:472px 0 0 87px">
									<iframe frameborder='no' width="513" height="321" scrolling=no name='mplayer' id='62469C4F7A677C9CF679E77B8BF50C066627' src='http://blog.naver.com/MultimediaFLVPlayer.nhn?blogId=jl3399&logNo=220046705791&vid=62469C4F7A677C9CF679E77B8BF50C066627&width=512&height=321&ispublic=true' title='포스트에 첨부된 동영상'></iframe>
								</div>
								<div style="float:left;padding:472px 0 0 76px">
									<img src="images/sexual_harassment_btn.png" usemap="#sexual_harassment_btn" style="border: 0;" /></a>
									<map name="sexual_harassment_btn">
										<area shape="rect" coords="2,1,180,53" href="files/hwp/성희롱예방교육자료.hwp" target="" alt="" />
										<area shape="rect" coords="1,59,179,112" href="files/hwp/성희롱예방(노동부팜플렛).hwp" target="" alt="" />
										<area shape="rect" coords="2,121,179,174" href="files/hwp/성희롱예방교육결과.hwp" target="" alt="" />
										<area shape="rect" coords="0,180,180,230" href="files/hwp/성희롱예방교육참석자명단.hwp" target="" alt="" />
									</map>
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
