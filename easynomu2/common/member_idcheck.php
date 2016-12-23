<?
$g4_path = "../.."; // common.php 의 상대 경로
include_once("$g4_path/common.php");
//echo $mb_id;
$mb_id       = $user_id;

if (!trim($mb_id)) {
    alert("회원아이디가 공백이면 안됩니다.");
}
$g4[member_table] = "a4_member";
$mb = get_member($mb_id);

if (!$mb[mb_id]) {
    $id_ok = 1;
} else {
    $id_ok = 2;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>아이디 중복확인</title>
<link rel="stylesheet" type="text/css" href="../css/style_chongmu.css">
</head>
<script language="javascript">
	function setData(strid)
	{
		opener.document.dataForm.comp_bznb.value = strid;
		window.close();
	}
	function closeWin()
	{
		window.close();
	}
	function checkData()
	{
		if (document.frm.user_id.value == "")
		{
			alert("아이디를 입력하세요.");
			document.frm.user_id.focus();
			return;
		}
		document.frm.action = "member_idcheck.php";
		document.frm.submit();
		return;
	}
</script>
<body leftmargin="0" topmargin="0">
<table width="390" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="ececec"><table width="380" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="./images/member_23.gif" width="380" height="45"></td>
      </tr>
      <tr>
        <td height="5"></td>
      </tr>
      <tr>
        <td><img src="./images/member_19.gif" width="380" height="10"></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF"><table width="340" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" style="padding:10 0 10 0">
									<?
									if($id_ok == 1) {
									?>
									ㆍ선택하신 아이디는 사용이 가능합니다.<BR> 선택하시겠습니까? 
									<? } else { ?>
									ㆍ선택하신 아이디는 이미 <span style="color:red">사용중</span>입니다.<BR> 다시 입력하시기 바랍니다. 
									<? } ?>
								</td>
              </tr>
              <tr>
                <td height="2" bgcolor="01539c"></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td style="padding:15 0 15 0">
						<form name="frm" method="post" action="javascript:checkData();" style="margin:0">
						<table width="100%" border="0" cellspacing="0" cellpadding="10">

              <tr>
                <td align="center" bgcolor="ececec">
                  <input name="user_id" type="text"  class="box1" style="width:180px" maxlength="15" value="<?=$user_id?>">
                  <input type="image" src="./images/btn_01.gif" width="39" height="18" style="margin:0 0 -4 3"></td>
              </tr>
            </table>
						</form>
						</td>
          </tr>
          <tr>
            <td height="1" bgcolor="ededed"></td>
          </tr>
          <tr>
            <td height="50" align="center">
							<?
							if($id_ok == 1) {
							?>
							<a href="javascript:setData(document.frm.user_id.value);"><img src="./images/btn_join_05.gif" width="65" height="22" hspace="5" border="0"></a>
							<? } ?>
							<a href="javascript:closeWin();"><img src="./images/btn_join_06.gif" width="65" height="22" hspace="5" border="0"></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="5"></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
