/** =============================================
Return : String (YYYYMMDD)
Comment: ����⵵�� ���Ѵ� (����:YYYYMMDD)
Usage  :
---------------------------------------------- */
function fn_getDateNowYear()
{
    var dNow = new Date();
    var yyyy = "";
   
    yyyy = dNow.getYear();
    
    yyyy = fn_setFillzeroByVal( yyyy, 4 );
    return yyyy ;
}

/** =============================================
Return : String
Comment: sVal�� ���̸� iLen���� "0"���� ä�� ���� ���� ����
Usage  :
---------------------------------------------- */
function fn_setFillzeroByVal( sVal, iVal )
{
    sStr = sVal + "";

    for (ii = sStr.length; ii < iVal; ii++) {
        sStr =  "0" + sStr;
    }

    return sStr;
}
//===============================================

//===============================================

// event.shiftKey : Ű�ڵ尪
// event.shiftKey, event.altKey, event.ctrlKey : boolean
// event.srcElement : �̺�Ʈ�� �߻��� ��ü
// 8: BackSpace, 46: Del
// ","=44, "-"=45, "."=46, "/"=47
// "0"=48, "9"=57
//"." = 190
// "@"=64, "A"=65, "Z"=90, "a"=97, "z"=122
// 37:LeftArrow, 38:UpArrow, 39:RightArrow, 40:DownArrow **
/** =============================================
Return : event.returnValue = boolean
Comment: Ű�Է½� ���ڸ� �Է� �ް� �Ѵ�.
Usage  : onKeyDown="fn_onKeyOnlyNumber();"
---------------------------------------------- */
function fn_onKeyOnlyNumber()
{

}
//===============================================

/** =============================================
Return : boolean
Comment: ��¥ ��ȿ�� üũ(�и��� yyyy, mm, dd ��)
Usage  :
---------------------------------------------- */
function fn_isYearMonthDay(yyyy, mm, dd)
{
    var revalue  = 1;

    var iMaxDay = fn_MaxdayYearMonth(yyyy, mm);    

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

/** =============================================
Return : int (�ش� ��,���� ����)
Comment: �Է¹��� ��,���� �ִ� ���� ���Ѵ�.
Usage  :
---------------------------------------------- */
function fn_MaxdayYearMonth(yyyy, mm)
{
    var monthDD = new Array(31,28,31,30,31,30,31,31,30,31,30,31);

    var iMaxDay = 0;

    if ( fn_isLeafYear(yyyy) ) {
        monthDD[1] = 29;
    }
    iMaxDay = monthDD[mm - 1];

    return iMaxDay;
}

/** =============================================
Return : boolean
Comment: �Է¹��� �⵵�� �����̸� true
Usage  :
---------------------------------------------- */
function fn_isLeafYear(YYYY)
{
    if ( ( (YYYY%4 == 0) && (YYYY%100 != 0) ) || (YYYY%400 == 0) ) {
        return true;
    }
    return false;
}
//===============================================

														//keydown
function checkThousand(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
		main = document.form1;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
		var chk		= 0;				// chk �� õ������ ���� ���̸� check
		var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
		var start	= 0;
		var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
		var end		= 0;				// start, end substring ������ ���� ����  
		var total	= "";			
		var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
		if (inputVal.length > 3){
			input = delCom(inputVal, inputVal.length);
/*			for(i=0; i<inputVal.length; i++){
				if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
					input += inputVal.substring(i,i+1);	// ���� ��� , �� ����
				}
			}*/
			chk = (input.length)/3;					// input ���� 3�Ƿ� ���� �� ���
			chk = Math.floor(chk);					// �� ������ �۰ų� ���� �� �� �ִ��� ���� ���
			share = (input.length)%3;				// 200,000 �� ���� 3�� ����� ���� �ɷ����� ���� ������ ���
			if (share == 0 ) {						
				chk = chk - 1;					// ���̰� 3�� ����� ���� ���� chk ���� �ϳ� ����.
			}
			for(i=chk; i>0; i--){
				triple = i * 3;					// 3�� ��� ��� 9,6,3 ��� ���� ������
				end = Number(input.length)-Number(triple);	// �� ���� end ���� ���� �þ� ���� �ȴ�.
				total += input.substring(start,end)+",";	// total�� �տ��� ���� ���ʷ� ���δ�.
				start = end;					// end ���� �������� start ������ ����.
			}
			total +=input.substring(start,input.length);		// ���������� ������ 3�ڸ� ���� �ڿ� ������.
		} else {
			total = inputVal;					// 3�� ����� �Ǳ� �������� ���� �״�� �����ȴ�.
		}


		if(keydown =='Y'){
			if ( type =='1' ) {
				main.basic1.value=total;					// type �� ���� �������� �־� �ش�.
			}
			if ( type =='2' ) {
				main.bonus1.value=total;					
			}
			if ( type =='3' ) {
				main.basic2.value=total;					
			}
			if ( type =='4' ) {
				main.bonus2.value=total;					
			}
			if ( type =='5' ) {
				main.basic3.value=total;					
			}
			if ( type =='6' ) {
				main.bonus3.value=total;					
			}
			if ( type =='7' ) {
				main.basic4.value=total;					
			}
			if ( type =='8' ) {
				main.bonus4.value=total;					
			}			
			if ( type =='9' ) {
				main.annualBonus.value=total;					
			}
			if ( type =='10' ) {
				main.vacaBunus.value=total;				
			}
			if ( type =='11' ) {
				main.avrPay.value=total;				
			}
			if ( type =='12' ) {
				main.comPay.value=total;				
			}
		}else if(keydown =='N'){
			return total
		}

		return total
	}



function delCom(inputVal, count){
		var tmp = "";
		for(i=0; i<count; i++){
			if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
				tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
			}
		}
		return tmp;
	}


function roundGo(gap) { 
   if (gap.indexOf(".") == -1) { // ���(����)
     return gap;
   } else { // �Ǽ�
     var lastSu;
    var suArr = gap.split(".");
    var tmp   = suArr[1].substr(0,3);
  
      if (parseInt(tmp.length) >= 3) {
         if (parseInt(suArr[1].charAt(2)) >= 5) {
            //lastSu = suArr[0] + "." + suArr[1].substr(0,1) + (parseInt(suArr[1].charAt(1)) +1);
			lastSu = eval(eval(suArr[0] + "." + suArr[1].substr(0,2)) + 0.01);
         } else {
           lastSu = suArr[0] + "." + suArr[1].substr(0,2);
         }
      } else {
          lastSu = suArr[0] + "." + suArr[1];
      }
   }
         return lastSu;
  }


function myRound(num, pos) 
{ 
	var posV = Math.pow(10, (pos ? pos : 2));
	//return Math.round(num*posV)/posV; //�ݿø�
	return Math.floor(num*posV)/posV;  //����
}


function myCeil(num, pos) 
{ 
	var posV = Math.pow(10, (pos ? pos : 2));
	//return Math.round(num*posV)/posV; //�ݿø�
	return Math.ceil(num*posV)/posV;  //����
}