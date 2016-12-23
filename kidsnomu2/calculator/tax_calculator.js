	var timer = null;
	var alpha = 100;
	//알림창 닫기(페이드 효과)
	function CloseNotice() {
		NoticeLay.style.filter='progid:DXImageTransform.Microsoft.Alpha(opacity='+alpha+')';
		alpha--;
		if(alpha==0) {
			NoticeLay.style.display='none';
			NoticeLay.style.filter='progid:DXImageTransform.Microsoft.Alpha(opacity=100)';
			alpha = 100;
			clearInterval(timer);
			timer = null;
		}
	}
	//알림창 열기
	function OpenNotice() {
		NoticeLay.style.left = document.body.clientWidth/2;
		NoticeLay.style.top = document.body.clientHeight/2;
		NoticeLay.style.display='';

		alpha = 100;
		if(timer) clearInterval(timer);
		timer = null;
		if(!timer) {
			timer = setInterval(CloseNotice,10);
		}
	}
	//키를 눌렀을때 동장
	function KeyUPCalPay(obj, layer) {
		if(CheckNumber(obj)) {
			if(obj.value.length>0 && obj.value!="0" && layer!="") OpenNotice();
			ChangeMoneyType(obj);
			if(layer.length>0) NumbToKorean(obj, layer);
		}
	}

	function CheckDateBox(obj) {
		if(obj.value.length>0){
			if(!CheckDate(obj.value)) {
				alert('유효한 날짜가 아닙니다.');
				obj.value = '';
				obj.focus();
			}
			else SetDate();
		}
	}
	function CheckDate(textDate) {
		if(textDate && textDate.replaceAll("-","").length<8) return false;

		var y = textDate.substring(0,4);
		var m = textDate.substring(5,7);
		var d = textDate.substring(8,10);

		if(isDateOK(y,m,d)>0) return false;
		else return true;
	}
	//달력을 선택했을때 실행되는 함수
	function calendarEvent(ctlToPlaceValue) {
		SetDate();
	}
	//마지막 일수를 구한다.
	function GetMonthLastDay(yyyy, mm)
	{
	    var monthDD = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
	    var iMaxDay = 0;
	    if (isLeafYear(yyyy) ) {
	        monthDD[1] = 29;
	    }
	    iMaxDay = monthDD[mm - 1];
	    return iMaxDay;
	}
	//윤년인지 체크
	function isLeafYear(YYYY)
	{
	    if ( ( (YYYY%4 == 0) && (YYYY%100 != 0) ) || (YYYY%400 == 0) ) {
	        return true;
	    }
	    return false;
	}
	function isDateOK(yyyy, mm, dd)
	{
	    var revalue  = 1;
	    var iMaxDay = GetMonthLastDay(yyyy, mm);
	    if ( yyyy == "" && mm == "" && dd == "" ) {
	        isTrue = true;
	    } else {
	        if(yyyy < 1901 || yyyy > 9999) revalue=1;
			else if(mm <0 || mm >12 ) revalue=2;
			else if(dd <0 || dd > iMaxDay) revalue =3;
			else revalue =0;
	    }
	    return revalue;
	}
	//키보드 입력값을 받아 다음 포커스로 이동시킨다.
	function KeyControls(top,bottom,next) {
		//ENTER/TAB
		if(event.keyCode == 13 || event.keyCode == 9) {
			if(next && !calform[next].disabled) calform[next].focus();
			return false;
		}
		//화살표위
		else if(event.keyCode == 38) {
			if(top && !calform[top].disabled) calform[top].focus();
			return true;
		}
		//화살표아래
		else if(event.keyCode == 40) {
			if(bottom && !calform[bottom].disabled) calform[bottom].focus();
			return true;
		}
		else if(event.keyCode == 27 || event.keyCode == 112 || event.keyCode == 114 || event.keyCode == 115 || event.keyCode == 116 || event.keyCode == 117 || event.keyCode == 118 || event.keyCode == 119 || event.keyCode == 120 || event.keyCode == 121 || event.keyCode == 122 || event.keyCode == 123 || event.keyCode == 20 || event.keyCode == 16 || event.keyCode == 17 || event.keyCode == 18 || event.keyCode == 25 || event.keyCode == 229) {
			//특수키 동작 안함
			//27=ESC
			//112~123 = F1~F12(F2제외)
			//20=CapsLock
			//16=Shift
			//17=Ctrl
			//18=Alt
			//25=한자
			//229=한/영
			return true;
		}
		else {
			//아무처리 안함
			return true;
		}
	}
	function CheckNumber(fl) {
		t = fl.value.replaceAll(",",'');
		t = t.replaceAll("-",'');
		for(i=0;i<t.length;i++)
		if ((t.charAt(i)<'0' || t.charAt(i)>'9') && t.charAt(i)!='-') {
			alert("숫자만 입력해주세요.") ;
			fl.value="";
			fl.focus() ;
			return false ;
		}
		return true;
	}

	arrKor1 = new Array ('영','일','이','삼','사','오','육','칠','팔','구' );
	arrKor2 = new Array ('일', '만', '억', '조' );
	arrKor3 = new Array ('일','십', '백', '천' );
	//한글로 금액표시
	function NumbToKorean(obj,id) {
		CheckNumber(obj);
		num = obj.value.replaceAll(",","");

		delimiter = ' ';


		bPos = 0;
		sPos = 0;
		digit = 0;

		szDigit = '';
		is_start = false;
		appendFF = false;
		len = num.length;
		szHan = '';

		for (i=len-1;i>=0;i--) {
			szDigit=num.substring(i,i+1);
			digit=parseInt(szDigit);

			if (digit!=0) {
				if (bPos!=0 && sPos==0) {
					if (is_start==true) szHan += delimiter;
					szHan += arrKor2[bPos];
					appendFF=false;
				}
				if (bPos!=0 && appendFF==true) {
					if (is_start==true) szHan += delimiter;
					szHan += arrKor2[bPos];
					appendFF=false;
				}
				if (sPos!=0) szHan += arrKor3[sPos];
				szHan += arrKor1[digit];
				is_start=true;
			}
			else if (sPos==0 && bPos!=0) appendFF=true;
			sPos++;
			if (sPos%4==0) {
				sPos=0;
				bPos++;
				if (bPos>=4) return "(범위초과)";
			}
		}
		if (is_start==false) szHan += "영";

		rslt = '';
		for(i = szHan.length - 1; i >= 0; i--) {
			rslt += szHan.substring(i, i + 1);
		}

		document.all(id).innerText = rslt + " 원";
	}
	function ChangeMoneyType(obj) {
		obj.value = obj.value.ChangeMoneyType();
	}
	//프로토 타입---------------------------------------------------------------------------
	String.prototype.replaceAll = function(searchStr, replaceStr)
	{
		var temp = this;
		while( temp.indexOf( searchStr ) != -1 ) temp = temp.replace( searchStr, replaceStr );
		return temp;
	}
	//3자리마다 컴마를 찍는다.
	String.prototype.ChangeMoneyType = function(){ //프로토타입형
		str=this;
		str = str.replaceAll(",",'');
		str = str.replaceAll(".",'0000');
		str = parseInt(str,10);
		str = str.toString().replace(/[^-0-9]/g,'');
		while(str.match(/^(-?\d+)(\d{3})/)) {
			str = str.replace(/^(-?\d+)(\d{3})/, '$1,$2');
		}

		return str;
	}
