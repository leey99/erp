<?
// 메모리를 많이 잡아먹어서 아래의 코드로 대체
//ini_set('memory_limit', '20M');
//$zipfile = file("./zip.db");

$zipfile = array();
$fp = fopen("./zip.db", "r");
while(!feof($fp)) {
    $zipfile[] = fgets($fp, 4096);
}
fclose($fp);

$search_count = 0;

if ($addr1) 
{
    while ($zipcode = each($zipfile)) 
    {
        if(strstr(substr($zipcode[1],9,512), $addr1))
        {
            $list[$search_count][zip1] = substr($zipcode[1],0,3);
            $list[$search_count][zip2] = substr($zipcode[1],4,3);    
            $addr = explode(" ", substr($zipcode[1],8));

            if ($addr[sizeof($addr)-1]) 
            {
                $list[$search_count][addr] = str_replace($addr[sizeof($addr)-1], "", substr($zipcode[1],8));
                $list[$search_count][bunji] = trim($addr[sizeof($addr)-1]);
            }
            else
                $list[$search_count][addr] = substr($zipcode[1],8);

            $list[$search_count][encode_addr] = urlencode($list[$search_count][addr]);
            $search_count++;
        }    
    }

    if (!$search_count) alert("찾으시는 주소가 없습니다.");
}

/* 기존의 DB에서 불러오는 방식
if ($addr1) 
{
    //$sql = " select * from $g4[zip_table] where zp_dong like '%$addr1%' order by zp_id ";
    $sql = " select * from $g4[zip_table] where zp_dong like '%$addr1%' order by zp_sido, zp_gugun, zp_dong ";
    $result = sql_query($sql);
    $search_count = 0;
    for ($i=0; $row=sql_fetch_array($result); $i++) 
    {
        $list[$i][zip1] = substr($row[zp_code], 0, 3);
        $list[$i][zip2] = substr($row[zp_code], 3, 3);
        $list[$i][addr] = "$row[zp_sido] $row[zp_gugun] $row[zp_dong]";
        $list[$i][bunji] = $row[zp_bunji];
        $list[$i][encode_addr] = urlencode($list[$i][addr]);
        $search_count++;
    }

    if (!$search_count) 
        alert("찾으시는 주소가 없습니다.");
}
*/

$g4[title] = "우편번호 검색";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>우편번호찾기</title>
<link rel="stylesheet" type="text/css" href="../css/style_chongmu.css">
</head>
<script language="javascript">
function find_zip(zip1, zip2, addr1)
{
    var of = opener.document.<?=$frm_name?>;

    of.<?=$frm_zip1?>.value  = zip1;
    of.<?=$frm_zip2?>.value  = zip2;

    of.<?=$frm_addr1?>.value = addr1;

    of.<?=$frm_addr2?>.focus();
    window.close();
    return false;
}

function fncLoad()
{
	var frm = document.frm;
	frm.addr1.focus();
	return;
}

function checkData()
{
	var frm = document.frm;
	if (frm.addr1.value == "")
	{
		alert("동/읍/면 이름을 입력하세요.");
		frm.addr1.focus();
		return;
	}

	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
</script>

<body leftmargin="0" topmargin="0">
<table width="390" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="ececec"><table width="380" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="./images/member_24.gif" width="380" height="45"></td>
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
                <td height="30"><img src="./images/member_25.gif" width="328" height="13"></td>
              </tr>
              <tr>
                <td height="2" bgcolor="01539c"></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td style="padding:15 0 15 0">
							<form name="frm" method="get" action="javascript:checkData();" style="margin:0">
							<input type=hidden name=frm_name  value='<?=$frm_name?>'>
							<input type=hidden name=frm_zip1  value='<?=$frm_zip1?>'>
							<input type=hidden name=frm_zip2  value='<?=$frm_zip2?>'>
							<input type=hidden name=frm_addr1 value='<?=$frm_addr1?>'>
							<input type=hidden name=frm_addr2 value='<?=$frm_addr2?>'>
							<input type=hidden name="gbn" value="cust">

							<table width="100%" border="0" cellspacing="0" cellpadding="10">
								<tr>
									<td align="center" bgcolor="ececec">
										<input name="addr1" value='<?=$addr1?>' type="text"  class="box1" style="width:180px" maxlength="50" style='ime-mode:active'>
										<input type="image" src="./images/btn_01.gif" width="39" height="18" style="margin:0 0 -4 3">
									</td>
								</tr>
							</table>
							</form>
						</td>
          </tr>
          <tr>
            <td height="1" bgcolor="ededed"></td>
          </tr>
          <tr>
						<!-----------주소리스트 시작-------->
            <td style="padding:15 0 15 0">
<? if ($search_count > 0) { ?>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="1" bgcolor="d9d9d9"></td>
              </tr>
              <tr>
                <td height="28" valign="bottom" bgcolor="f8f8f8"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                       <td width="60" height="28" align="center"><font color="254e9f">우편번호</font></td>
                      <td width="1" valign="bottom"><img src="../img/my/line.gif" width="1" height="10"></td>
                      <td align="center"><font color="254e9f">주 소 </font></td>
                    </tr>
                </table>

        <?
        for ($i=0; $i<count($list); $i++) 
        {
            echo "<tr><td height=19><a href='javascript:;' onclick=\"find_zip('{$list[$i][zip1]}', '{$list[$i][zip2]}', '{$list[$i][addr]}');\">{$list[$i][zip1]}-{$list[$i][zip2]} : {$list[$i][addr]} {$list[$i][bunji]}</a></td></tr>\n";
        }
        ?>
        <tr>

</td>
              </tr>
              <tr>
                <td height="1" bgcolor="d9d9d9"></td>
              </tr>
            </table>
<? } ?>
          </td>
					<!-----------주소리스트 끝-------->
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
