<?
$sub_menu = "400100";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");

//현재 날짜 시간
$now_date = date("Y-m-d");
$now_time = date("H:i:s");

//기존 데이터 삭제 후 삽입
$sql_opt_del = " delete from si4n_nhis_pay where com_code='$code' ";
sql_query($sql_opt_del);

for($i=0;$i<$total_count;$i++) {
	//과세소득(변경전) 데이터 있을 경우 실행
	if($_POST['money_for_tax_'.$i]) {
		$sabun[$i] = $_POST['sabun_'.$i];
		$yun[$i] = $_POST['yun_'.$i];
		$health[$i] = $_POST['health_'.$i];
		$yoyang[$i] = $_POST['yoyang_'.$i];
		$goyong[$i] = $_POST['goyong_'.$i];
		$yun2[$i] = $_POST['yun2_'.$i];
		$health2[$i] = $_POST['health2_'.$i];
		$yoyang2[$i] = $_POST['yoyang2_'.$i];
		$goyong2[$i] = $_POST['goyong2_'.$i];

		$c_yun[$i] = $_POST['c_yun_'.$i];
		$c_health[$i] = $_POST['c_health_'.$i];
		$c_yoyang[$i] = $_POST['c_yoyang_'.$i];
		$c_goyong[$i] = $_POST['c_goyong_'.$i];
		$c_sanjae[$i] = $_POST['c_sanjae_'.$i];
		$c_yun2[$i] = $_POST['yun2_'.$i];
		$c_health2[$i] = $_POST['c_health2_'.$i];
		$c_yoyang2[$i] = $_POST['c_yoyang2_'.$i];
		$c_goyong2[$i] = $_POST['c_goyong2_'.$i];
		$c_sanjae2[$i] = $_POST['c_sanjae2_'.$i];

		$tax_exemption_var[$i] = $_POST['tax_exemption_'.$i];

		$money_for_tax_var[$i] = $_POST['money_for_tax_'.$i];
		$money2_for_tax_var[$i] = $_POST['money2_for_tax_'.$i];

		$money_gongje_var[$i] = $_POST['money_gongje_'.$i];
		$money2_gongje_var[$i] = $_POST['money2_gongje_'.$i];

		$money_result_var[$i] = $_POST['money_result_'.$i];

		// 천단위 콤마 제거 DB 저장
		$yun[$i] = preg_replace('@,@', '', $yun[$i]);
		$health[$i] = preg_replace('@,@', '', $health[$i]);
		$yoyang[$i] = preg_replace('@,@', '', $yoyang[$i]);
		$goyong[$i] = preg_replace('@,@', '', $goyong[$i]);
		$yun2[$i] = preg_replace('@,@', '', $yun2[$i]);
		$health2[$i] = preg_replace('@,@', '', $health2[$i]);
		$yoyang2[$i] = preg_replace('@,@', '', $yoyang2[$i]);
		$goyong2[$i] = preg_replace('@,@', '', $goyong2[$i]);

		$c_yun[$i] = preg_replace('@,@', '', $c_yun[$i]);
		$c_health[$i] = preg_replace('@,@', '', $c_health[$i]);
		$c_yoyang[$i] = preg_replace('@,@', '', $c_yoyang[$i]);
		$c_goyong[$i] = preg_replace('@,@', '', $c_goyong[$i]);
		$c_sanjae[$i] = preg_replace('@,@', '', $c_sanjae[$i]);
		$c_yun2[$i] = preg_replace('@,@', '', $c_yun2[$i]);
		$c_health2[$i] = preg_replace('@,@', '', $c_health2[$i]);
		$c_yoyang2[$i] = preg_replace('@,@', '', $c_yoyang2[$i]);
		$c_goyong2[$i] = preg_replace('@,@', '', $c_goyong2[$i]);
		$c_sanjae2[$i] = preg_replace('@,@', '', $c_sanjae2[$i]);

		$tax_exemption_var[$i] = preg_replace('@,@', '', $tax_exemption_var[$i]);

		$money_time_var[$i] = preg_replace('@,@', '', $money_time_var[$i]);

		$money_for_tax_var[$i] = preg_replace('@,@', '', $money_for_tax_var[$i]);
		$money2_for_tax_var[$i] = preg_replace('@,@', '', $money2_for_tax_var[$i]);
		$money_gongje_var[$i] = preg_replace('@,@', '', $money_gongje_var[$i]);
		$money2_gongje_var[$i] = preg_replace('@,@', '', $money2_gongje_var[$i]);
		$money_result_var[$i] = preg_replace('@,@', '', $money_result_var[$i]);

		$sql_common = " 
								yun = '$yun[$i]',
								health = '$health[$i]',
								yoyang = '$yoyang[$i]',
								goyong = '$goyong[$i]',
								yun2 = '$yun2[$i]',
								health2 = '$health2[$i]',
								yoyang2 = '$yoyang2[$i]',
								goyong2 = '$goyong2[$i]',

								c_yun = '$c_yun[$i]',
								c_health = '$c_health[$i]',
								c_yoyang = '$c_yoyang[$i]',
								c_goyong = '$c_goyong[$i]',
								c_sanjae = '$c_sanjae[$i]',
								c_yun2 = '$c_yun2[$i]',
								c_health2 = '$c_health2[$i]',
								c_yoyang2 = '$c_yoyang2[$i]',
								c_goyong2 = '$c_goyong2[$i]',
								c_sanjae2 = '$c_sanjae2[$i]',

								tax_exemption = '$tax_exemption_var[$i]',

								money_for_tax = '$money_for_tax_var[$i]',
								money2_for_tax = '$money2_for_tax_var[$i]',
								money_gongje = '$money_gongje_var[$i]',
								money2_gongje = '$money2_gongje_var[$i]',
								money_result = '$money_result_var[$i]'
								";

		//새로운 데이터 저장
		$sql = "insert si4n_nhis_pay set 
				$sql_common
				, com_code = '$code', sabun = '$sabun[$i]' ";
		//echo $sql."<br><br>";
		sql_query($sql);
	}
}
//exit;
$pay_list_url = "pop_si4n_nhis_calculate2.php";
alert("정상적으로 저장이 되었습니다.","$pay_list_url?id=$code&cnt=$total_count");
?>