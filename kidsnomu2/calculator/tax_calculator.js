	var timer = null;
	var alpha = 100;
	//�˸�â �ݱ�(���̵� ȿ��)
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
	//�˸�â ����
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
	//Ű�� �������� ����
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
				alert('��ȿ�� ��¥�� �ƴմϴ�.');
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
	//�޷��� ���������� ����Ǵ� �Լ�
	function calendarEvent(ctlToPlaceValue) {
		SetDate();
	}
	//������ �ϼ��� ���Ѵ�.
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
	//�������� üũ
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
	//Ű���� �Է°��� �޾� ���� ��Ŀ���� �̵���Ų��.
	function KeyControls(top,bottom,next) {
		//ENTER/TAB
		if(event.keyCode == 13 || event.keyCode == 9) {
			if(next && !calform[next].disabled) calform[next].focus();
			return false;
		}
		//ȭ��ǥ��
		else if(event.keyCode == 38) {
			if(top && !calform[top].disabled) calform[top].focus();
			return true;
		}
		//ȭ��ǥ�Ʒ�
		else if(event.keyCode == 40) {
			if(bottom && !calform[bottom].disabled) calform[bottom].focus();
			return true;
		}
		else if(event.keyCode == 27 || event.keyCode == 112 || event.keyCode == 114 || event.keyCode == 115 || event.keyCode == 116 || event.keyCode == 117 || event.keyCode == 118 || event.keyCode == 119 || event.keyCode == 120 || event.keyCode == 121 || event.keyCode == 122 || event.keyCode == 123 || event.keyCode == 20 || event.keyCode == 16 || event.keyCode == 17 || event.keyCode == 18 || event.keyCode == 25 || event.keyCode == 229) {
			//Ư��Ű ���� ����
			//27=ESC
			//112~123 = F1~F12(F2����)
			//20=CapsLock
			//16=Shift
			//17=Ctrl
			//18=Alt
			//25=����
			//229=��/��
			return true;
		}
		else {
			//�ƹ�ó�� ����
			return true;
		}
	}
	function CheckNumber(fl) {
		t = fl.value.replaceAll(",",'');
		t = t.replaceAll("-",'');
		for(i=0;i<t.length;i++)
		if ((t.charAt(i)<'0' || t.charAt(i)>'9') && t.charAt(i)!='-') {
			alert("���ڸ� �Է����ּ���.") ;
			fl.value="";
			fl.focus() ;
			return false ;
		}
		return true;
	}

	arrKor1 = new Array ('��','��','��','��','��','��','��','ĥ','��','��' );
	arrKor2 = new Array ('��', '��', '��', '��' );
	arrKor3 = new Array ('��','��', '��', 'õ' );
	//�ѱ۷� �ݾ�ǥ��
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
				if (bPos>=4) return "(�����ʰ�)";
			}
		}
		if (is_start==false) szHan += "��";

		rslt = '';
		for(i = szHan.length - 1; i >= 0; i--) {
			rslt += szHan.substring(i, i + 1);
		}

		document.all(id).innerText = rslt + " ��";
	}
	function ChangeMoneyType(obj) {
		obj.value = obj.value.ChangeMoneyType();
	}
	//������ Ÿ��---------------------------------------------------------------------------
	String.prototype.replaceAll = function(searchStr, replaceStr)
	{
		var temp = this;
		while( temp.indexOf( searchStr ) != -1 ) temp = temp.replace( searchStr, replaceStr );
		return temp;
	}
	//3�ڸ����� �ĸ��� ��´�.
	String.prototype.ChangeMoneyType = function(){ //������Ÿ����
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
