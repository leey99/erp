<?
$sub_menu = "160100";
include_once("./_common.php");

$now_date = date("Y.m.d");

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";

$sub_title = "이지헬프";
$g4[title] = $sub_title." : 원격지원 : ".$easynomu_name;

$top_sub_title = "images/top16_01.gif";
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
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">

</script>
<?
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
//콘텐트 넓이
$content_width = "1008";
?>
								<td onmouseover="showM('900')" valign="top">
									<div style="margin:10px 20px 20px 20px;min-height:480px;">
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td width="100"><img src="images/top16.gif" border="0"></td>
												<td width=""><img src="<?=$top_sub_title?>" border="0"></td>
												<td></td>
											</tr>
											<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
										</table>
										<table width="1000" border="0" align="left" cellpadding="0" cellspacing="0" >
											<tr>
												<td valign="top" style="padding:10px 0 0 0">
													<!--타이틀 -->	
													<div id="tab1">
														<div style="margin:10px 0 0 0;background:url('images/remote_help_bg.png') no-repeat;height:732px">
															<div style="padding:406px 0 0 500px">
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
													</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
