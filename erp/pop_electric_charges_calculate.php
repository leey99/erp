<?
include_once("./_common.php");
$html_title = "�����ݰ���";
//�⺻���(���̸� ����)
//�����(��)�� ����
$basic[1][1] = 5550;
$summer[1][1] = 81;
$spring[1][1] = 59.2;
$winter[1][1] = 79.3;
//�����(��)��
$basic[2][1] = 6490;
$basic[2][2] = 7470;
//����(����, ��, �ܿ�), ��/�߰�/�ִ����
$summer[2][1][1] = 60.5;
$spring[2][1][1] = 60.5;
$winter[2][1][1] = 67.9;
//���A ���å� �߰�����
$summer[2][1][2] = 86.3;
$spring[2][1][2] = 65.3;
$winter[2][1][2] = 84.8;
//�ִ����
$summer[2][1][3] = 119.8;
$spring[2][1][3] = 84.5;
$winter[2][1][3] = 114.2;
//���A ���å� �����
$summer[2][2][1] = 55.6;
$spring[2][2][1] = 55.6;
$winter[2][2][1] = 63.0;
$summer[2][2][2] = 81.4;
$spring[2][2][2] = 60.4;
$winter[2][2][2] = 79.9;
$summer[2][2][3] = 114.9;
$spring[2][2][3] = 79.6;
$winter[2][2][3] = 109.3;
//�����(��)
$basic[11][1] = 7220;
$basic[11][2] = 8320;
$basic[11][3] = 9810;
//���A ���å�
$summer[11][1][1] = 61.6;
$spring[11][1][1] = 61.6;
$winter[11][1][1] = 68.6;
$summer[11][1][2] = 114.5;
$spring[11][1][2] = 84.1;
$winter[11][1][2] = 114.7;
$summer[11][1][3] = 196.6;
$spring[11][1][3] = 114.8;
$winter[11][1][3] = 172.2;
//���A ���å�
$summer[11][2][1] = 56.1;
$spring[11][2][1] = 56.1;
$winter[11][2][1] = 63.1;
$summer[11][2][2] = 109.0;
$spring[11][2][2] = 78.6;
$winter[11][2][2] = 109.2;
$summer[11][2][3] = 191.1;
$spring[11][2][3] = 109.3;
$winter[11][2][3] = 166.7;
//���A ���å�
$summer[11][3][1] = 55.2;
$spring[11][3][1] = 55.2;
$winter[11][3][1] = 62.5;
$summer[11][3][2] = 108.4;
$spring[11][3][2] = 77.3;
$winter[11][3][2] = 108.6;
$summer[11][3][3] = 178.7;
$spring[11][3][3] = 101;
$winter[11][3][3] = 155.5;
//�Ϲݿ�(��)�� ����
$basic[4][1] = 6160;
$summer[4][1] = 105.7;
$spring[4][1] = 65.2;
$winter[4][1] = 92.3;
//�Ϲݿ�(��)��
$basic[5][1] = 7170;
$basic[5][2] = 8230;
$summer[5][1][1] = 62.7;
$spring[5][1][1] = 62.7;
$winter[5][1][1] = 71.4;
$summer[5][1][2] = 113.9;
$spring[5][1][2] = 70.1;
$winter[5][1][2] = 101.8;
$summer[5][1][3] = 136.4;
$spring[5][1][3] = 81.4;
$winter[5][1][3] = 116.6;
$summer[5][2][1] = 57.4;
$spring[5][2][1] = 57.4;
$winter[5][2][1] = 66.1;
$summer[5][2][2] = 108.6;
$spring[5][2][2] = 64.8;
$winter[5][2][2] = 96.5;
$summer[5][2][3] = 131.1;
$spring[5][2][3] = 76.1;
$winter[5][2][3] = 111.3;
//�Ϲݿ�(��)
$basic[14][1] = 7220;
$basic[14][2] = 8320;
$basic[14][3] = 9810;
$summer[14][1][1] = 61.6;
$spring[14][1][1] = 61.6;
$winter[14][1][1] = 68.6;
$summer[14][1][2] = 114.5;
$spring[14][1][2] = 84.1;
$winter[14][1][2] = 114.7;
$summer[14][1][3] = 196.6;
$spring[14][1][3] = 114.8;
$winter[14][1][3] = 172.2;
$summer[14][2][1] = 56.1;
$spring[14][2][1] = 56.1;
$winter[14][2][1] = 63.1;
$summer[14][2][2] = 109;
$spring[14][2][2] = 78.6;
$winter[14][2][2] = 109.2;
$summer[14][2][3] = 191.1;
$spring[14][2][3] = 109.3;
$winter[14][2][3] = 166.7;
$summer[14][3][1] = 55.2;
$spring[14][3][1] = 55.2;
$winter[14][3][1] = 62.5;
$summer[14][3][2] = 108.4;
$spring[14][3][2] = 77.3;
$winter[14][3][2] = 108.6;
$summer[14][3][3] = 178.7;
$spring[14][3][3] = 101;
$winter[14][3][3] = 155.5;
?>
<html>
<head>
<title><?=$html_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" type="text/css" href="./css/style_chongmu.css">
</head>
<body topmargin="0" leftmargin="0">
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
function getId(id) {
	return document.getElementById(id);
}
//number_format �Լ�
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');    }
    return s.join(dec);
}
function data_calculate() {
	frm = document.dataForm;
	var a5 = Number(frm.a5.value);
	var d5 = frm.d5.value;
	var g5 = frm.g5.value;
	var g6 = frm.g6.value;
	var g7 = frm.g7.value;
	var c9 = Number(frm.c9.value);
	var d9 = Number(frm.d9.value);
	var a13 = Number(frm.a13.value);
	var b13 = Number(frm.b13.value);
	var c13 = Number(frm.c13.value);
	var d13 = Number(frm.d13.value);
	var a17 = 0;
	var use_cost3 = 0;
	var use_sum3 = 0;
	var use_sum6 = 0;
	var use_sum7 = 0;
	var use_sum8 = 0;
	var use_cost6 = 0;
	var use_cost7 = 0;
	var use_cost8 = 0;
	var use_rate3 = 0;
	var use_rate6 = 0;
	var use_rate7 = 0;
	var use_rate8 = 0;
	var basic_rate = 0;
	var basic_rate_sum = 0;
	var use_cost_sum = 0;
	var power_factor = 0;
	var electric_sum = 0;
	var vat = 0;
	var fund = 0;
	var total = 0;

	//�ʼ� �Է� ������ Ȯ��
	if(frm.d5.value == "") {
		alert('������� �����Ͻʽÿ�.');
		frm.d5.focus();
		return;
	}
	if(frm.a5.value == "") {
		alert('������������� �Է��Ͻʽÿ�.');
		frm.a5.focus();
		return;
	}
	if(frm.use_date_s.value == "") {
		alert('���Ⱓ�� �Է��Ͻʽÿ�.');
		return;
	}
	//��뷮
	if(d5 == 1 || d5 == 4) {
		if(frm.d13.value == "") {
			alert('��뷮�� �Է��Ͻʽÿ�.');
			frm.d13.focus();
			return;
		}
		a17 = d13;
	} else {
		if(frm.a13.value == "") {
			alert('�ɾ�(��)�� �Է��Ͻʽÿ�.');
			frm.a13.focus();
			return;
		}
		if(frm.b13.value == "") {
			alert('�ְ�(�߰�)�� �Է��Ͻʽÿ�.');
			frm.b13.focus();
			return;
		}
		if(frm.c13.value == "") {
			alert('����(�ִ�)�� �Է��Ͻʽÿ�.');
			frm.c13.focus();
			return;
		}
		a17 = a13+b13+c13;
	}
	//�����(��)��
	if(d5 == 1) {
		if(g5 == 1) basic_rate = <?=$basic[1][1]?>;
	//�����(��)��
	} else if(d5 == 2) {
		if(g6 == 1) basic_rate = <?=$basic[2][1]?>;
		else if(g6 == 2) basic_rate = <?=$basic[2][2]?>;
	//�����(��)
	} else if(d5 == 11) {
		if(g7 == 1) basic_rate = <?=$basic[11][1]?>;
		else if(g7 == 2) basic_rate = <?=$basic[11][2]?>;
		else if(g7 == 3) basic_rate = <?=$basic[11][3]?>;
	//�Ϲݿ�(��)��
	} else if(d5 == 4) {
		if(g5 == 1) basic_rate = <?=$basic[4][1]?>;
	//�Ϲݿ�(��)��
	} else if(d5 == 5) {
		if(g6 == 1) basic_rate = <?=$basic[5][1]?>;
		else if(g6 == 2) basic_rate = <?=$basic[5][2]?>;
	//�Ϲݿ�(��)
	} else if(d5 == 14) {
		if(g7 == 1) basic_rate = <?=$basic[14][1]?>;
		else if(g7 == 2) basic_rate = <?=$basic[14][2]?>;
		else if(g7 == 3) basic_rate = <?=$basic[14][3]?>;
	}
	//�⺻���
	basic_rate_sum = basic_rate * a5;
	var date1 = frm.use_date_s.value;
	var arr1 = date1.split('.');
	arr1[1] = Number(arr1[1]);
	arr1[2] = Number(arr1[2]);
	var dat1 = new Date(arr1[0], arr1[1], arr1[2]);
	console.log("arr1[1] : "+arr1[1]);
	console.log("dat1 : "+dat1);
	//var lastDay = (new Date(dat1.getFullYear(),dat1.getMonth(),0)).getDate();
	var lastDay = (new Date(arr1[0],arr1[1],0)).getDate();
	//console.log("lastDay : "+lastDay);
	//tMonth = dat1.getMonth();
	tMonth = arr1[1];
	tDay = arr1[2];
	var date2 = frm.use_date_e.value;
	var arr2 = date2.split('.');
	arr2[1] = Number(arr2[1]);
	arr2[2] = Number(arr2[2]);
	tMonth2 = arr2[1];
	tDay2 = arr2[2];
	//alert(tMonth);
	//���Ⱓ ���� ���� ���(����)
	date_day1 = lastDay - tDay + 1;
	console.log("date_day1 : "+date_day1);
	date_day2 = tDay2;
	date_day_sum = date_day1 + date_day2;
	//alert(date_day1+" "+date_day2);
	date_rate1 = date_day1 / date_day_sum;
	date_rate2 = date_day2 / date_day_sum;
	//���Ⱓ��(����) �ܰ�
	if(d5 == 1 || d5 == 4) {
		if(tMonth >=6 && tMonth <=8) {
			if(d5 == 1) use_cost1 = <?=$summer[1][1]?>;
			else if(d5 == 4) use_cost1 = <?=$summer[4][1]?>;
		} else if((tMonth >=3 && tMonth <=5) || (tMonth >=9 && tMonth <=10)) {
			if(d5 == 1) use_cost1 = <?=$spring[1][1]?>;
			else if(d5 == 4) use_cost1 = <?=$spring[4][1]?>;
		} else if((tMonth >=11 && tMonth <=12) || (tMonth >=1 && tMonth <=2)) {
			if(d5 == 1) use_cost1 = <?=$winter[1][1]?>;
			else if(d5 == 4) use_cost1 = <?=$winter[4][1]?>;
		}
		use_rate1 = (d13 * date_rate1).toFixed(0);
		use_sum1 = use_cost1 * use_rate1;

		if(tMonth2 >=6 && tMonth2 <=8) {
			if(d5 == 1) use_cost2 = <?=$summer[1][1]?>;
			else if(d5 == 4) use_cost2 = <?=$summer[4][1]?>;
		} else if((tMonth2 >=3 && tMonth2 <=5) || (tMonth2 >=9 && tMonth2 <=10)) {
			if(d5 == 1) use_cost2 = <?=$spring[1][1]?>;
			else if(d5 == 4) use_cost2 = <?=$spring[4][1]?>;
		} else if((tMonth2 >=11 && tMonth2 <=12) || (tMonth2 >=1 && tMonth2 <=2)) {
			if(d5 == 1) use_cost2 = <?=$winter[1][1]?>;
			else if(d5 == 4) use_cost2 = <?=$winter[4][1]?>;
		}
		use_rate2 = (d13 * date_rate2).toFixed(0);
		use_sum2 = use_cost2 * use_rate2;

		//���·���� �հ�
		use_cost_sum = use_sum1 + use_sum2;

		getId('div_help2').style.display = "none";
		getId('div_help3').style.display = "";
	} else {
		console.log("tMonth : "+tMonth);
		//����
		if(tMonth >=6 && tMonth <=8) {
			//�����(��)���ɾ�(��)
			if(d5 == 2) {
				if(g6 == 1) {
					use_cost1 = <?=$summer[2][1][1]?>;
					use_cost2 = <?=$summer[2][1][2]?>;
					use_cost3 = <?=$summer[2][1][3]?>;
				} else if(g6 == 2) {
					use_cost1 = <?=$summer[2][2][1]?>;
					use_cost2 = <?=$summer[2][2][2]?>;
					use_cost3 = <?=$summer[2][2][3]?>;
				}
			} else if(d5 == 11) {
				if(g7 == 1) {
					use_cost1 = <?=$summer[11][1][1]?>;
					use_cost2 = <?=$summer[11][1][2]?>;
					use_cost3 = <?=$summer[11][1][3]?>;
				} else if(g7 == 2) {
					use_cost1 = <?=$summer[11][2][1]?>;
					use_cost2 = <?=$summer[11][2][2]?>;
					use_cost3 = <?=$summer[11][2][3]?>;
				} else if(g7 == 3) {
					use_cost1 = <?=$summer[11][3][1]?>;
					use_cost2 = <?=$summer[11][3][2]?>;
					use_cost3 = <?=$summer[11][3][3]?>;
				}
			} else if(d5 == 5) {
				if(g6 == 1) {
					use_cost1 = <?=$summer[5][1][1]?>;
					use_cost2 = <?=$summer[5][1][2]?>;
					use_cost3 = <?=$summer[5][1][3]?>;
				} else if(g6 == 2) {
					use_cost1 = <?=$summer[5][2][1]?>;
					use_cost2 = <?=$summer[5][2][2]?>;
					use_cost3 = <?=$summer[5][2][3]?>;
				}
			} else if(d5 == 14) {
				if(g7 == 1) {
					use_cost1 = <?=$summer[14][1][1]?>;
					use_cost2 = <?=$summer[14][1][2]?>;
					use_cost3 = <?=$summer[14][1][3]?>;
				} else if(g7 == 2) {
					use_cost1 = <?=$summer[14][2][1]?>;
					use_cost2 = <?=$summer[14][2][2]?>;
					use_cost3 = <?=$summer[14][2][3]?>;
				} else if(g7 == 3) {
					use_cost1 = <?=$summer[14][3][1]?>;
					use_cost2 = <?=$summer[14][3][2]?>;
					use_cost3 = <?=$summer[14][3][3]?>;
				}
			}
		//��,����
		} else if((tMonth >=3 && tMonth <=5) || (tMonth >=9 && tMonth <=10)) {
			if(d5 == 2) {
				if(g6 == 1) {
					use_cost1 = <?=$spring[2][1][1]?>;
					use_cost2 = <?=$spring[2][1][2]?>;
					use_cost3 = <?=$spring[2][1][3]?>;
				} else if(g6 == 2) {
					use_cost1 = <?=$spring[2][2][1]?>;
					use_cost2 = <?=$spring[2][2][2]?>;
					use_cost3 = <?=$spring[2][2][3]?>;
				}
			} else if(d5 == 11) {
				if(g7 == 1) {
					use_cost1 = <?=$spring[11][1][1]?>;
					use_cost2 = <?=$spring[11][1][2]?>;
					use_cost3 = <?=$spring[11][1][3]?>;
				} else if(g7 == 2) {
					use_cost1 = <?=$spring[11][2][1]?>;
					use_cost2 = <?=$spring[11][2][2]?>;
					use_cost3 = <?=$spring[11][2][3]?>;
				} else if(g7 == 3) {
					use_cost1 = <?=$spring[11][3][1]?>;
					use_cost2 = <?=$spring[11][3][2]?>;
					use_cost3 = <?=$spring[11][3][3]?>;
				}
			} else if(d5 == 5) {
				if(g6 == 1) {
					use_cost1 = <?=$spring[5][1][1]?>;
					use_cost2 = <?=$spring[5][1][2]?>;
					use_cost3 = <?=$spring[5][1][3]?>;
				} else if(g6 == 2) {
					use_cost1 = <?=$spring[5][2][1]?>;
					use_cost2 = <?=$spring[5][2][2]?>;
					use_cost3 = <?=$spring[5][2][3]?>;
				}
			} else if(d5 == 14) {
				if(g7 == 1) {
					use_cost1 = <?=$spring[14][1][1]?>;
					use_cost2 = <?=$spring[14][1][2]?>;
					use_cost3 = <?=$spring[14][1][3]?>;
				} else if(g7 == 2) {
					use_cost1 = <?=$spring[14][2][1]?>;
					use_cost2 = <?=$spring[14][2][2]?>;
					use_cost3 = <?=$spring[14][2][3]?>;
				} else if(g7 == 3) {
					use_cost1 = <?=$spring[14][3][1]?>;
					use_cost2 = <?=$spring[14][3][2]?>;
					use_cost3 = <?=$spring[14][3][3]?>;
				}
			}
		//�ܿ�
		} else if((tMonth >=11 && tMonth <=12) || (tMonth >=1 && tMonth <=2)) {
			if(d5 == 2) {
				if(g6 == 1) {
					use_cost1 = <?=$winter[2][1][1]?>;
					use_cost2 = <?=$winter[2][1][2]?>;
					use_cost3 = <?=$winter[2][1][3]?>;
				} else if(g6 == 2) {
					use_cost1 = <?=$winter[2][2][1]?>;
					use_cost2 = <?=$winter[2][2][2]?>;
					use_cost3 = <?=$winter[2][2][3]?>;
				}
			} else if(d5 == 11) {
				if(g7 == 1) {
					use_cost1 = <?=$winter[11][1][1]?>;
					use_cost2 = <?=$winter[11][1][2]?>;
					use_cost3 = <?=$winter[11][1][3]?>;
				} else if(g7 == 2) {
					use_cost1 = <?=$winter[11][2][1]?>;
					use_cost2 = <?=$winter[11][2][2]?>;
					use_cost3 = <?=$winter[11][2][3]?>;
				} else if(g7 == 3) {
					use_cost1 = <?=$winter[11][3][1]?>;
					use_cost2 = <?=$winter[11][3][2]?>;
					use_cost3 = <?=$winter[11][3][3]?>;
				}
			} else if(d5 == 5) {
				if(g6 == 1) {
					use_cost1 = <?=$winter[5][1][1]?>;
					use_cost2 = <?=$winter[5][1][2]?>;
					use_cost3 = <?=$winter[5][1][3]?>;
				} else if(g6 == 2) {
					use_cost1 = <?=$winter[5][2][1]?>;
					use_cost2 = <?=$winter[5][2][2]?>;
					use_cost3 = <?=$winter[5][2][3]?>;
				}
			} else if(d5 == 14) {
				if(g7 == 1) {
					use_cost1 = <?=$winter[14][1][1]?>;
					use_cost2 = <?=$winter[14][1][2]?>;
					use_cost3 = <?=$winter[14][1][3]?>;
				} else if(g7 == 2) {
					use_cost1 = <?=$winter[14][2][1]?>;
					use_cost2 = <?=$winter[14][2][2]?>;
					use_cost3 = <?=$winter[14][2][3]?>;
				} else if(g7 == 3) {
					use_cost1 = <?=$winter[14][3][1]?>;
					use_cost2 = <?=$winter[14][3][2]?>;
					use_cost3 = <?=$winter[14][3][3]?>;
				}
			}
		}
		use_rate1 = (a13 * date_rate1).toFixed(0);
		use_rate2 = (b13 * date_rate1).toFixed(0);
		use_rate3 = (c13 * date_rate1).toFixed(0);
		use_sum1 = use_cost1 * use_rate1;
		use_sum2 = use_cost2 * use_rate2;
		use_sum3 = use_cost3 * use_rate3;
		//console.log(use_rate1);
		//console.log(use_rate2);
		//console.log(use_rate3);

		//���Ⱓ ���� ��

		//����
		if(tMonth2 >=6 && tMonth2 <=8) {
			//�����(��)���ɾ�(��)
			if(d5 == 2) {
				if(g6 == 1) {
					use_cost6 = <?=$summer[2][1][1]?>;
					use_cost7 = <?=$summer[2][1][2]?>;
					use_cost8 = <?=$summer[2][1][3]?>;
				} else if(g6 == 2) {
					use_cost6 = <?=$summer[2][2][1]?>;
					use_cost7 = <?=$summer[2][2][2]?>;
					use_cost8 = <?=$summer[2][2][3]?>;
				}
			} else if(d5 == 11) {
				if(g7 == 1) {
					use_cost6 = <?=$summer[11][1][1]?>;
					use_cost7 = <?=$summer[11][1][2]?>;
					use_cost8 = <?=$summer[11][1][3]?>;
				} else if(g7 == 2) {
					use_cost6 = <?=$summer[11][2][1]?>;
					use_cost7 = <?=$summer[11][2][2]?>;
					use_cost8 = <?=$summer[11][2][3]?>;
				} else if(g7 == 3) {
					use_cost6 = <?=$summer[11][3][1]?>;
					use_cost7 = <?=$summer[11][3][2]?>;
					use_cost8 = <?=$summer[11][3][3]?>;
				}
			} else if(d5 == 5) {
				if(g6 == 1) {
					use_cost6 = <?=$summer[5][1][1]?>;
					use_cost7 = <?=$summer[5][1][2]?>;
					use_cost8 = <?=$summer[5][1][3]?>;
				} else if(g6 == 2) {
					use_cost6 = <?=$summer[5][2][1]?>;
					use_cost7 = <?=$summer[5][2][2]?>;
					use_cost8 = <?=$summer[5][2][3]?>;
				}
			} else if(d5 == 14) {
				if(g7 == 1) {
					use_cost6 = <?=$summer[14][1][1]?>;
					use_cost7 = <?=$summer[14][1][2]?>;
					use_cost8 = <?=$summer[14][1][3]?>;
				} else if(g7 == 2) {
					use_cost6 = <?=$summer[14][2][1]?>;
					use_cost7 = <?=$summer[14][2][2]?>;
					use_cost8 = <?=$summer[14][2][3]?>;
				} else if(g7 == 3) {
					use_cost6 = <?=$summer[14][3][1]?>;
					use_cost7 = <?=$summer[14][3][2]?>;
					use_cost8 = <?=$summer[14][3][3]?>;
				}
			}
		//��,����
		} else if((tMonth2 >=3 && tMonth2 <=5) || (tMonth2 >=9 && tMonth2 <=10)) {
			if(d5 == 2) {
				if(g6 == 1) {
					use_cost6 = <?=$spring[2][1][1]?>;
					use_cost7 = <?=$spring[2][1][2]?>;
					use_cost8 = <?=$spring[2][1][3]?>;
				} else if(g6 == 2) {
					use_cost6 = <?=$spring[2][2][1]?>;
					use_cost7 = <?=$spring[2][2][2]?>;
					use_cost8 = <?=$spring[2][2][3]?>;
				}
			} else if(d5 == 11) {
				if(g7 == 1) {
					use_cost6 = <?=$spring[11][1][1]?>;
					use_cost7 = <?=$spring[11][1][2]?>;
					use_cost8 = <?=$spring[11][1][3]?>;
				} else if(g7 == 2) {
					use_cost6 = <?=$spring[11][2][1]?>;
					use_cost7 = <?=$spring[11][2][2]?>;
					use_cost8 = <?=$spring[11][2][3]?>;
				} else if(g7 == 3) {
					use_cost6 = <?=$spring[11][3][1]?>;
					use_cost7 = <?=$spring[11][3][2]?>;
					use_cost8 = <?=$spring[11][3][3]?>;
				}
			} else if(d5 == 5) {
				if(g6 == 1) {
					use_cost6 = <?=$spring[5][1][1]?>;
					use_cost7 = <?=$spring[5][1][2]?>;
					use_cost8 = <?=$spring[5][1][3]?>;
				} else if(g6 == 2) {
					use_cost6 = <?=$spring[5][2][1]?>;
					use_cost7 = <?=$spring[5][2][2]?>;
					use_cost8 = <?=$spring[5][2][3]?>;
				}
			} else if(d5 == 14) {
				if(g7 == 1) {
					use_cost6 = <?=$spring[14][1][1]?>;
					use_cost7 = <?=$spring[14][1][2]?>;
					use_cost8 = <?=$spring[14][1][3]?>;
				} else if(g7 == 2) {
					use_cost6 = <?=$spring[14][2][1]?>;
					use_cost7 = <?=$spring[14][2][2]?>;
					use_cost8 = <?=$spring[14][2][3]?>;
				} else if(g7 == 3) {
					use_cost6 = <?=$spring[14][3][1]?>;
					use_cost7 = <?=$spring[14][3][2]?>;
					use_cost8 = <?=$spring[14][3][3]?>;
				}
			}
		//�ܿ�
		} else if((tMonth2 >=11 && tMonth2 <=12) || (tMonth2 >=1 && tMonth2 <=2)) {
			if(d5 == 2) {
				if(g6 == 1) {
					use_cost6 = <?=$winter[2][1][1]?>;
					use_cost7 = <?=$winter[2][1][2]?>;
					use_cost8 = <?=$winter[2][1][3]?>;
				} else if(g6 == 2) {
					use_cost6 = <?=$winter[2][2][1]?>;
					use_cost7 = <?=$winter[2][2][2]?>;
					use_cost8 = <?=$winter[2][2][3]?>;
				}
			} else if(d5 == 11) {
				if(g7 == 1) {
					use_cost6 = <?=$winter[11][1][1]?>;
					use_cost7 = <?=$winter[11][1][2]?>;
					use_cost8 = <?=$winter[11][1][3]?>;
				} else if(g7 == 2) {
					use_cost6 = <?=$winter[11][2][1]?>;
					use_cost7 = <?=$winter[11][2][2]?>;
					use_cost8 = <?=$winter[11][2][3]?>;
				} else if(g7 == 3) {
					use_cost6 = <?=$winter[11][3][1]?>;
					use_cost7 = <?=$winter[11][3][2]?>;
					use_cost8 = <?=$winter[11][3][3]?>;
				}
			} else if(d5 == 5) {
				if(g6 == 1) {
					use_cost6 = <?=$winter[5][1][1]?>;
					use_cost7 = <?=$winter[5][1][2]?>;
					use_cost8 = <?=$winter[5][1][3]?>;
				} else if(g6 == 2) {
					use_cost6 = <?=$winter[5][2][1]?>;
					use_cost7 = <?=$winter[5][2][2]?>;
					use_cost8 = <?=$winter[5][2][3]?>;
				}
			} else if(d5 == 14) {
				if(g7 == 1) {
					use_cost6 = <?=$winter[14][1][1]?>;
					use_cost7 = <?=$winter[14][1][2]?>;
					use_cost8 = <?=$winter[14][1][3]?>;
				} else if(g7 == 2) {
					use_cost6 = <?=$winter[14][2][1]?>;
					use_cost7 = <?=$winter[14][2][2]?>;
					use_cost8 = <?=$winter[14][2][3]?>;
				} else if(g7 == 3) {
					use_cost6 = <?=$winter[14][3][1]?>;
					use_cost7 = <?=$winter[14][3][2]?>;
					use_cost8 = <?=$winter[14][3][3]?>;
				}
			}
		}
		use_rate6 = (a13 * date_rate2).toFixed(0);
		use_rate7 = (b13 * date_rate2).toFixed(0);
		use_rate8 = (c13 * date_rate2).toFixed(0);
		use_sum6 = use_cost6 * use_rate6;
		use_sum7 = use_cost7 * use_rate7;
		use_sum8 = use_cost8 * use_rate8;
		//���·���� �հ�
		use_cost_sum = use_sum1 + use_sum2 + use_sum3 + use_sum6 + use_sum7 + use_sum8;
		use_cost_sum = Math.floor(use_cost_sum);

		getId('div_help2').style.display = "";
		getId('div_help3').style.display = "none";
	}
	//���󿪷� ���󿪷� �迭
	var field = Array();
	var capacitive = Array();
	field[60]=6;field[61]=5.8;field[62]=5.6;field[63]=5.4;field[64]=5.2;field[65]=5;field[66]=4.8;field[67]=4.6;field[68]=4.4;field[69]=4.2;field[70]=4;field[71]=3.8;field[72]=3.6;field[73]=3.4;field[74]=3.2;field[75]=3;field[76]=2.8;field[77]=2.6;field[78]=2.4;field[79]=2.2;field[80]=2;field[81]=1.8;field[82]=1.6;field[83]=1.4;field[84]=1.2;field[85]=1;field[86]=0.8;field[87]=0.6;field[88]=0.4;field[89]=0.2;field[90]=0;field[91]=0.2;field[92]=0.4;field[93]=0.6;field[94]=0.8;field[95]=1;field[96]=1;field[97]=1;field[98]=1;field[99]=1;field[100]=1;
	capacitive[60]=7;capacitive[61]=6.8;capacitive[62]=6.6;capacitive[63]=6.4;capacitive[64]=6.2;capacitive[65]=6;capacitive[66]=5.8;capacitive[67]=5.6;capacitive[68]=5.4;capacitive[69]=5.2;capacitive[70]=5;capacitive[71]=4.8;capacitive[72]=4.6;capacitive[73]=4.4;capacitive[74]=4.2;capacitive[75]=4;capacitive[76]=3.8;capacitive[77]=3.6;capacitive[78]=3.4;capacitive[79]=3.2;capacitive[80]=3;capacitive[81]=2.8;capacitive[82]=2.6;capacitive[83]=2.4;capacitive[84]=2.2;capacitive[85]=2;capacitive[86]=1.8;capacitive[87]=1.6;capacitive[88]=1.4;capacitive[89]=1.2;capacitive[90]=1;capacitive[91]=0.8;capacitive[92]=0.6;capacitive[93]=0.4;capacitive[94]=0.2;capacitive[95]=0;capacitive[96]=0;capacitive[97]=0;capacitive[98]=0;capacitive[99]=0;capacitive[100]=0;
	//���󿪷�
	if(c9 >= 60 && c9 <= 100) field_rate = field[c9];
	else field_rate = 6;
	if(c9 < 90) field_sum = field_rate * basic_rate_sum / 100;
	else field_sum = field_rate * basic_rate_sum / -100;
	//console.log(field_sum);
	//���󿪷�
	if(d9 >= 60 && d9 <= 100) capacitive_rate = capacitive[d9];
	else capacitive_rate = 7;
	capacitive_sum = capacitive_rate * basic_rate_sum / 100;
	//console.log(capacitive_sum);
	power_factor = field_sum + capacitive_sum;

	//�����ݰ� ���
	electric_sum = basic_rate_sum + power_factor + use_cost_sum;
	//�ΰ���ġ��
	vat = electric_sum * 0.1;
	//���»����ݱ��
	fund = Math.floor((electric_sum * 0.037) / 10) * 10;
	//û���ݾ�
	total = Math.floor((electric_sum + vat + fund) / 10) * 10;

	getId('div_help').style.display = "";
	getId('a2').innerHTML = number_format(a5);
	getId('basic_rate').innerHTML = number_format(basic_rate);
	getId('basic_rate_sum').innerHTML = number_format(basic_rate_sum);
	getId('a17').innerHTML = number_format(a17);
	getId('g17').innerHTML = number_format(total);

	//���·���� (��)��
	getId('a13_month6').innerHTML = tMonth;
	getId('a13_month7').innerHTML = tMonth2;
	getId('a13_kwh6').innerHTML = number_format(use_rate1);
	getId('a13_cost6').innerHTML = number_format(use_cost1, 1);
	getId('a13_sum6').innerHTML = number_format(use_sum1, 1);
	getId('a13_kwh7').innerHTML = number_format(use_rate2);
	getId('a13_cost7').innerHTML = number_format(use_cost2, 1);
	getId('a13_sum7').innerHTML = number_format(use_sum2, 1);

	//���·����
	getId('a13_month1').innerHTML = tMonth;
	getId('a13_kwh1').innerHTML = number_format(use_rate1);
	getId('a13_cost1').innerHTML = number_format(use_cost1, 1);
	getId('a13_sum1').innerHTML = number_format(use_sum1, 1);
	getId('b13_kwh1').innerHTML = number_format(use_rate2);
	getId('b13_cost1').innerHTML = number_format(use_cost2, 1);
	getId('b13_sum1').innerHTML = number_format(use_sum2, 1);
	getId('c13_kwh1').innerHTML = number_format(use_rate3);
	getId('c13_cost1').innerHTML = number_format(use_cost3, 1);
	getId('c13_sum1').innerHTML = number_format(use_sum3, 1);
	getId('a13_month2').innerHTML = tMonth2;
	getId('a13_kwh2').innerHTML = number_format(use_rate6);
	getId('a13_cost2').innerHTML = number_format(use_cost6, 1);
	getId('a13_sum2').innerHTML = number_format(use_sum6, 1);
	getId('b13_kwh2').innerHTML = number_format(use_rate7);
	getId('b13_cost2').innerHTML = number_format(use_cost7, 1);
	getId('b13_sum2').innerHTML = number_format(use_sum7, 1);
	getId('c13_kwh2').innerHTML = number_format(use_rate8);
	getId('c13_cost2').innerHTML = number_format(use_cost8, 1);
	getId('c13_sum2').innerHTML = number_format(use_sum8, 1);
	//�����ݰ�
	getId('basic_rate_sum2').innerHTML = number_format(basic_rate_sum);
	getId('use_cost_sum').innerHTML = number_format(use_cost_sum);
	getId('electric_sum').innerHTML = number_format(electric_sum);
	getId('electric_sum2').innerHTML = number_format(electric_sum);
	getId('electric_sum3').innerHTML = number_format(electric_sum);
	getId('electric_sum4').innerHTML = number_format(electric_sum);
	//����
	getId('basic_rate_sum3').innerHTML = number_format(basic_rate_sum);
	getId('basic_rate_sum4').innerHTML = number_format(basic_rate_sum);
	getId('c10').innerHTML = field_rate;
	getId('c10_sum').innerHTML = number_format(field_sum);
	getId('d10').innerHTML = capacitive_rate;
	getId('d10_sum').innerHTML = number_format(capacitive_sum);
	getId('power_factor').innerHTML = number_format(power_factor);
	//������ û���ݾ�
	getId('vat').innerHTML = number_format(vat);
	getId('vat2').innerHTML = number_format(vat);
	getId('fund').innerHTML = number_format(fund);
	getId('fund2').innerHTML = number_format(fund);
	getId('total').innerHTML = number_format(total);
	//���·����
	getId('use_cost_sum2').innerHTML = number_format(use_cost_sum);
}
//����� ���� �� �������� ����Ʈ�ڽ� ǥ�� 160616
function select_rate() {
	frm = document.dataForm;
	var d5 = frm.d5.value;
	//�����(��)�� / �Ϲݿ�(��)��
	if(d5 == 1 || d5 == 4) {
		frm.g5.style.display = "";
		frm.g6.style.display = "none";
		frm.g7.style.display = "none";
		getId('div_use2').style.display = "";
		getId('div_use').style.display = "none";
	} else if(d5 == 2 || d5 == 5) {
		frm.g6.style.display = "";
		frm.g5.style.display = "none";
		frm.g7.style.display = "none";
		getId('div_use').style.display = "";
		getId('div_use2').style.display = "none";
	} else if(d5 == 11 || d5 == 14) {
		frm.g7.style.display = "";
		frm.g5.style.display = "none";
		frm.g6.style.display = "none";
		getId('div_use').style.display = "";
		getId('div_use2').style.display = "none";
	}
}
</script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
//<![CDATA[
function loadCalendar2( obj , obj2 ) {
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date)
	{
		//alert(calendar.id);
		var input_field = obj;
		input_field.value = date;

		//�ÿ�Ⱓ ���
		cal_date(date, obj2);

		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
function cal_date(date, obj2) {
	var input_field2 = obj2;
	var arr1 = date.split('.');
	arr1[1] = Number(arr1[1]);
	arr1[2] = Number(arr1[2]);
	//alert(arr1[2]);
	var dat1 = new Date(arr1[0], arr1[1], arr1[2]);
	//��� ������ ��
	var lastDay = (new Date(dat1.getFullYear(),dat1.getMonth(),0)).getDate();
	//��, �� ���ڸ� ��ȯ
	tMonth = (dat1.getMonth());
	tMonth1 = (dat1.getMonth()+1);
	tDay = (dat1.getDate()-1);
	if(tMonth < 10) tMonth = "0"+tMonth;
	if(tMonth1 < 10) tMonth1 = "0"+tMonth1;
	if(tDay < 10) tDay = "0"+tDay;
	tYear = dat1.getFullYear();
	//���� 1�� ���
	if(arr1[2] == 1) {
		if(tMonth == "00") {
			tYear = dat1.getFullYear()-1;
			tMonth = 12;
		}
		date2 = tYear+"."+tMonth+"."+lastDay;
	} else {
		//alert(tMonth);
		//2�� ���� üũ
		if(tMonth == "02") {
			var lastDay2 = (new Date(dat1.getFullYear(),dat1.getMonth(),0)).getDate();
			if(tDay == "00") {
				tMonth1 = "02";
				tDay = lastDay2;
			}
		}
		date2 = tYear+"."+tMonth1+"."+tDay;
	}
	input_field2.value = date2;
}
//���Ⱓ ��/��/�� �ڵ� period
function checkcomma(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	//���� �Է¸�
	input = delcomma(inputVal, inputVal.length);
	//�齺���̽� �� ����Ʈ+�� �� �� Del
	if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
		if(inputVal.length == 4){
			total += input.substring(0,4)+".";
		} else if(inputVal.length == 7){
			total += inputVal.substring(0,7)+".";
		} else if(inputVal.length == 12) {
			total += inputVal.substring(0,14)+"";
		} else {
			total += inputVal;
		}
		if(keydown =='Y'){
			console.log(inputVal.length);
			//���Ⱓ ������
			if(inputVal.length == 10) cal_date(total, document.dataForm.use_date_e);
			type.value=total;
		}else if(keydown =='N'){
			return total;
		}
	}
	return total;
}
function delcomma(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='.'){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
function check_use_date_e(obj) {
	var f = document.dataForm;
	//if(obj.checked) alert(obj.value);
	if(obj.checked) {
		f.use_date_e.className = "textfm";
		f.use_date_e.readOnly = false;
	} else  {
		f.use_date_e.className = "textfm5";
		f.use_date_e.readOnly = true;
	}
}
//]]>
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px">
	<tr>
		<td style="padding:0 20 0 20">
			<!--Ÿ��Ʋ -->
			<table width="100%" border=0 cellspacing=0 cellpadding=0>
				<tr>     
					<td height="18">
						<table width="100%" border=0 cellspacing=0 cellpadding=0>
							<tr>
								<td style='font-size:8pt;color:#929292;'>
									<img src="./images/title_icon.gif" align="absmiddle" style="margin:0 5px 2px 0;"><span style="font-size:9pt;color:black;"><?=$html_title?></span>
								</td>
								<td align=right class=navi></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height=1 bgcolor=e0e0de></td>
				</tr>
				<tr>
					<td height=2 bgcolor=f5f5f5></td>
				</tr>
				<tr>
					<td height=5></td>
				</tr>
			</table>
			<!--��޴� -->
			<form name="dataForm" style="margin:0;">
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/sb_tab_on_lt.gif"></td> 
									<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
										�������
									</td> 
									<td><img src="./images/sb_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px"></div>
				<!--�˻� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
					<tr>
						<td nowrap class="tdhead_center">�����</td>
						<td nowrap class="tdhead_center">��������</td>
						<td nowrap class="tdhead_center">�����������</td>
					</tr>
					<tr class="list_row_now_wh">
						<td nowrap class="ltrow1_center_h22">
							<select name="d5" class="selectfm" style="vertical-align:middle;" onchange="select_rate()">
								<option value="">����</option>
								<option value="1">�����(��)��</option>
								<option value="2">�����(��)��</option>
								<option value="11">�����(��)</option>
								<option value="4">�Ϲݿ�(��)��</option>
								<option value="5">�Ϲݿ�(��)��</option>
								<option value="14">�Ϲݿ�(��)</option>
							</select>
						</td>
						<td nowrap class="ltrow1_center_h22">
							<select name="g5" class="selectfm" style="vertical-align:middle;display:none;">
								<option value="1">����</option>
							</select>
							<select name="g6" class="selectfm" style="vertical-align:middle;display:none;">
								<option value="1">���A ���å�</option>
								<option value="2">���A ���å�</option>
							</select>
							<select name="g7" class="selectfm" style="vertical-align:middle;display:none;">
								<option value="1">���A ���å�</option>
								<option value="2">���A ���å�</option>
								<option value="3">���A ���å�</option>
							</select>
						</td>
						<td nowrap class="ltrow1_center_h22"><input name="a5"  type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="" maxlength="10">kW</td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>

				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/sb_tab_on_lt.gif"></td> 
									<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
										���Ⱓ
									</td> 
									<td><img src="./images/sb_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px"></div>
				<!--�˻� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable">
					<tr>
						<td nowrap class="tdhead_center">���Ⱓ</td>
						<td nowrap class="tdhead_center">���󿪷�</td>
						<td nowrap class="tdhead_center">���󿪷�</td>
					</tr>
					<tr class="list_row_now_wh">
						<td nowrap class="ltrow1_center_h22" style="width:230px;">
							<input name="use_date_s" type="text" class="textfm" style="width:78px;ime-mode:disabled;float:left;margin-left:20px;" maxlength="10" onkeyup="checkcomma(this.value, this,'Y')" />
							<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar2(document.dataForm.use_date_s, document.dataForm.use_date_e);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
							<input name="use_date_e" type="text" class="textfm5" style="width:78px;ime-mode:disabled;float:left;" readonly maxlength="10" />
							<input type="checkbox" name="manual_use_date_e" onclick="check_use_date_e(this);" value="1" title="�����Է�" style="float:left;">
						</td>
						<td nowrap class="ltrow1_center_h22">
							<input name="c9"  type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="90" maxlength="3" />%
						</td>
						<td nowrap class="ltrow1_center_h22">
							<input name="d9"  type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="95" maxlength="3" />%
						</td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/sb_tab_on_lt.gif"></td> 
									<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
										��뷮
									</td> 
									<td><img src="./images/sb_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px"></div>
				<!--���� / ��-->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;display:none;" id="div_use">
					<tr>
						<td nowrap class="tdhead_center">�ɾ�(��)</td>
						<td nowrap class="tdhead_center">�ְ�(�߰�)</td>
						<td nowrap class="tdhead_center">����(�ִ�)</td>
					</tr>
					<tr class="list_row_now_wh">
						<td nowrap class="ltrow1_center_h22"><input name="a13"  type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="" maxlength="10">kWh</td>
						<td nowrap class="ltrow1_center_h22"><input name="b13"  type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="" maxlength="10">kWh</td>
						<td nowrap class="ltrow1_center_h22"><input name="c13"  type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="" maxlength="10">kWh</td>
					</tr>
				</table>
				<!--��I-->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;display:none;" id="div_use2">
					<tr>
						<td nowrap class="tdhead_center">��뷮</td>
						<td nowrap class="tdhead_center"></td>
						<td nowrap class="tdhead_center"></td>
					</tr>
					<tr class="list_row_now_wh">
						<td nowrap class="ltrow1_center_h22"><input name="d13"  type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="" maxlength="10">kWh</td>
						<td nowrap class="ltrow1_center_h22"></td>
						<td nowrap class="ltrow1_center_h22"></td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>
				<div style="padding:0 0 10px 0;text-align:center;">
					<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:data_calculate();" target="">���</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
				</div>
				<table border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id=""> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/sb_tab_on_lt.gif"></td> 
									<td background="./images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
									���� ���
									</td> 
									<td><img src="./images/sb_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px"></div>
				<!--�˻� -->
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
					<tr>
						<td nowrap class="tdhead_center">�ѻ�뷮</td>
						<td nowrap class="tdhead_center" style="font-weight:bold;">������</td>
					</tr>
					<tr class="list_row_now_wh">
						<td nowrap class="ltrow1_center_h22"><span id="a17"></span>kWh</td>
						<td nowrap class="ltrow1_center_h22"><span id="g17" style="font-weight:bold;"></span>��</td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px;line-height:0px;"></div>
				<input type="hidden" name="electric_charges_payments" />
			</form>
			<div style="display:none;" id="div_help2">
				<strong><span id="a13_month1"></span>�� ����</strong><br />
				�ɾ�(�����)��� : <span id="a13_kwh1"></span>kWh x <span id="a13_cost1"></span>�� = <span id="a13_sum1"></span>��<br />
				�ְ�(�߰���)��� : <span id="b13_kwh1"></span>kWh x <span id="b13_cost1"></span>�� = <span id="b13_sum1"></span>��<br />
				����(�ִ��)��� : <span id="c13_kwh1"></span>kWh x <span id="c13_cost1"></span>�� = <span id="c13_sum1"></span>��<br />
				<strong><span id="a13_month2"></span>�� ����</strong><br />
				�ɾ�(�����)��� : <span id="a13_kwh2"></span>kWh x <span id="a13_cost2"></span>�� = <span id="a13_sum2"></span>��<br />
				�ְ�(�߰���)��� : <span id="b13_kwh2"></span>kWh x <span id="b13_cost2"></span>�� = <span id="b13_sum2"></span>��<br />
				����(�ִ��)��� : <span id="c13_kwh2"></span>kWh x <span id="c13_cost2"></span>�� = <span id="c13_sum2"></span>��<br />
			</div>
			<div style="display:none;" id="div_help3">
				<strong><span id="a13_month6"></span>�� ����</strong><br />
				<span id="a13_kwh6"></span>kWh x <span id="a13_cost6"></span>�� = <span id="a13_sum6"></span>��<br />
				<strong><span id="a13_month7"></span>�� ����</strong><br />
				<span id="a13_kwh7"></span>kWh x <span id="a13_cost7"></span>�� = <span id="a13_sum7"></span>��<br />
			</div>
			<div style="display:none;margin-top:5px;" id="div_help">
				�⺻���(���̸� ����) : <span id="a2"></span>kW x <span id="basic_rate"></span>�� = <span id="basic_rate_sum"></span>��<br />
				���·����(���̸� �����Ͽ� �ջ�) : <span id="use_cost_sum2"></span>��<br />
				���󿪷� : <span id="c10"></span>% x <span id="basic_rate_sum3"></span>�� = <span id="c10_sum"></span>��<br />
				���󿪷� : <span id="d10"></span>% x <span id="basic_rate_sum4"></span>�� = <span id="d10_sum"></span>��<br />
				�����ݰ�(�⺻��� + ������� + ���·����)<br />
				: <span id="basic_rate_sum2"></span>�� + <span id="power_factor"></span>�� + <span id="use_cost_sum"></span>�� = <span id="electric_sum"></span>��<br />
				�ΰ���ġ��(���̸� 4�� 5��) : <span id="electric_sum2"></span>�� x 0.1 = <span id="vat"></span>��<br />
				���»����ݱ��(10���̸� ����) : <span id="electric_sum3"></span>�� x 0.037 = <span id="fund"></span>��<br />
				<strong>û���ݾ�(�����ݰ� + �ΰ���ġ�� + ���»����ݱ��)</strong><br />
				: <span id="electric_sum4"></span>�� + <span id="vat2"></span>�� + <span id="fund2"></span>�� = <span id="total"></span>��
			</div>
			<div style="height:20px;font-size:0px;line-height:0px;"></div>
			<!--����Ʈ -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
				<tr>
					<td align="center">
						<table border="0" cellpadding="0" cellspacing="0" style=display:inline;><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:window.close();" target="">�ݱ�</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
