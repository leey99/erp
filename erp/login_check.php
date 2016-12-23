<?
$g4_path = ".."; // common.php 의 상대 경로
include_once("$g4_path/common_erp.php");
//echo $mb_id;
$mb_id       = $_POST[mb_id];
$mb_password = $_POST[mb_password];

$now_time = date("Y-m-d H:i:s");

if (!trim($mb_id) || !trim($mb_password))
    alert("회원아이디나 패스워드가 공백이면 안됩니다.");

/*
// 자동 스크립트를 이용한 공격에 대비하여 로그인 실패시에는 일정시간이 지난후에 다시 로그인 하도록 함
if ($check_time = get_session("ss_login_check_time")) {
    if ($check_time > $g4['server_time'] - 15) {
        alert("로그인 실패시에는 15초 이후에 다시 로그인 하시기 바랍니다.");
    }
}
set_session("ss_login_check_time", $g4['server_time']);
*/

$g4[member_table] = "a4_member";
$mb = get_member($mb_id);
// 가입된 회원이 아니다. 패스워드가 틀리다. 라는 메세지를 따로 보여주지 않는 이유는 
// 회원아이디를 입력해 보고 맞으면 또 패스워드를 입력해보는 경우를 방지하기 위해서입니다.
// 불법사용자의 경우 회원아이디가 틀린지, 패스워드가 틀린지를 알기까지는 많은 시간이 소요되기 때문입니다.
if (!$mb[mb_id] || (sql_password($mb_password) != $mb[mb_password])) {
    alert("가입된 회원이 아니거나 패스워드가 틀립니다.\\n\\n패스워드는 대소문자를 구분합니다.");
}
// 차단된 아이디인가?
if ($mb[mb_intercept_date] && $mb[mb_intercept_date] <= date("Ymd", $g4[server_time])) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb[mb_intercept_date]); 
    alert("회원님의 아이디는 접근이 금지되어 있습니다.\\n\\n처리일 : $date");
}
// 탈퇴한 아이디인가?
if ($mb[mb_leave_date] && $mb[mb_leave_date] <= date("Ymd", $g4[server_time])) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb[mb_leave_date]); 
    alert("탈퇴한 아이디이므로 접근하실 수 없습니다.\\n\\n탈퇴일 : $date");
}
//로그인 10일 초과 접속 제한 (대표님 요청) 151111
if( $mb['mb_today_login'] <= date("Y-m-d H:i:s", strtotime("-10 days")) ) {
    alert("마지막 로그인한지 10일이 초과하여 \\n접근하실 수 없습니다.\\n\\n마지막 로그인 일시 : ".$mb['mb_today_login']."\\n\\n본사로 연락바랍니다. 1544-4519");
}
/*
//메일 인증
if ($config[cf_use_email_certify] && !preg_match("/[1-9]/", $mb[mb_email_certify])) {
    alert("메일인증을 받으셔야 로그인 하실 수 있습니다.\\n\\n회원님의 메일주소는 $mb[mb_email] 입니다.");
}
*/
if ($mb[mb_email_certify] == "0000-00-00 00:00:00") {
    alert("최초 회원가입 시 관리자 승인이 필요합니다. \\n고객센터 1544-4519 연락 바랍니다.");
}
/*
//이용약관 동의
if ($mb[mb_open] != 1) {
  alert($mb[mb_name]."(아이디:".$mb[mb_id].") 담당자님\\n[이용약관과 개인정보처리방침]에 동의하여 주십시오.");
}
*/
$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
@include_once("$member_skin_path/login_check.skin.php");

// 회원아이디 세션 생성
set_session('erp_mb_id', $mb[mb_id]);
//echo $mb[mb_id];
//exit;

// 3.26
// 아이디 쿠키에 한달간 저장
if ($auto_login) {
    // 3.27
    // 자동로그인 ---------------------------
    // 쿠키 한달간 저장
    $key = md5($_SERVER[SERVER_ADDR] . $_SERVER[REMOTE_ADDR] . $_SERVER[HTTP_USER_AGENT] . $mb[mb_password]);
    set_cookie('ck_mb_id', $mb[mb_id], 86400 * 31);
    set_cookie('ck_auto', $key, 86400 * 31);
    // 자동로그인 end ---------------------------
} else {
    set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
}


if ($url) 
{
    $link = urldecode($url);
    // 2003-06-14 추가 (다른 변수들을 넘겨주기 위함)
    if (preg_match("/\?/", $link))
        $split= "&"; 
    else
        $split= "?"; 

    // $_POST 배열변수에서 아래의 이름을 가지지 않은 것만 넘김
    foreach($_POST as $key=>$value) 
    {
				//id_save 추가
        if ($key != "id_save" && $key != "mb_id" && $key != "mb_password" && $key != "x" && $key != "y" && $key != "url") 
        {
            $link .= "$split$key=$value";
            $split = "&";
        }
    }
} 
else
    $link = $g4[path];

//로그인 시 자동 출근 체크 160307
$id = $mb['mb_id'];
$type = "go";
$branch = $mb['mb_profile'];
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y-m-d");

//출퇴근 구분
if($type == "go") {
	$work_code = 1;
	$work_type = "출근";
} else {
	$work_code = 2;
	$work_type = "퇴근";
}

//사업장 기본정보 호출
$sql_work = "select * from work_go_leave where check_time like '$now_date%' and type = '$work_code' and user_id = '$id' ";
$row_work = sql_fetch($sql_work);
if($row_work['idx']) {
	//$check_date = explode(" ", $row_work['check_time']);
	//alert("이미 출근 체크 되었습니다. (".$row_work['check_time'].")","work_go_leave_update.php");
	//exit;
} else {
	//출퇴근 체크
	$sql_common = " branch = '$branch', user_id = '$id', type = '$work_code', check_time = '$now_time' ";
	$sql = " insert work_go_leave set $sql_common ";
	//echo $sql;
	sql_query($sql);
}
//echo $mb[mb_id];
//exit;
//전기공사 업체 로그인 시 자동 전기요금컨설팅 페이지로 이동 160503
//if($id == "el1001") {
//전기공사 업체 : 허수원 사장, 극동전력 안이사 160629
if($mb['mb_level'] == 2) {
	//사룬 전력수요관리 링크 160928
	if($mb['mb_id'] == 'saroon') goto_url("./kepco_dsm_list.php");
	else goto_url("./electric_charges_contractor.php");
	exit;
}
goto_url($link);
?>
