var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;

var _DEBUG = true; // Debug mode.
var pHwpCtrl;

function InitToolBarJS(){
	HwpControl.HwpCtrl.ReplaceAction("FileNew", "HwpCtrlFileNew");
	HwpControl.HwpCtrl.ReplaceAction("FileSave", "HwpCtrlFileSave");
	HwpControl.HwpCtrl.ReplaceAction("FileSaveAs", "HwpCtrlFileSaveAs");
	HwpControl.HwpCtrl.ReplaceAction("FileOpen", "HwpCtrlFileOpen");
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	HwpControl.HwpCtrl.ShowToolBar(true);

}

function _VerifyVersion(){	 //��ġ Ȯ��
	if(pHwpCtrl.Version == null){
		document.getElementById('HwpCtrl').style.display='none';
		alert("�ѱ�  ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.");
		return false;
	}
	//���� Ȯ��
	CurVersion = pHwpCtrl.Version;
	if(CurVersion < MinVersion){
		alert("HwpCtrl�� ������ ���Ƽ� ���������� �������� ���� �� �ֽ��ϴ�.\n"+
			"�ֽ� �������� ������Ʈ�ϱ⸦ �����մϴ�.\n\n"+
			"���� ����:" + CurVersion + "\n"+
			"���� ����:" + MinVersion + " �̻�"			
			);
	}
	return true;
}

function _GetBasePath(){
	//BasePath�� ���Ѵ�.
	var loc = unescape(document.location.href);
	var lowercase = loc.toLowerCase(loc);
	if (lowercase.indexOf("http://") == 0) // Internet
	{
		return loc.substr(0,loc.lastIndexOf("/") + 1);//BasePath ����
	}
	else // local
	{
		var path;
		path = loc.replace(/.{2,}:\/{2,}/, ""); // file:/// �� ����������.
		return path.substr(0,path.lastIndexOf("/") + 1);//BasePath ����
	}
}

function TableColumnContents(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ // ���̺� ���� Ŀ���� �ִ°�?
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			if(i==4){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else if(i==9){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else{
				dact.Execute(dset);
				pHwpCtrl.Run("TableRightCell");
			}
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("���� Ŀ���� ��ġ�� ǥ�� ���ΰ� �ƴ�.");
		return false;
	}
}

function TableAppendRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false)){
		pHwpCtrl.Run("TableCellBlock");
		pHwpCtrl.Run("TableColPageDown");
		pHwpCtrl.Run("Cancel");
		pHwpCtrl.Run("TableAppendRow");
		return true;
	}else	{
		if (_DEBUG)
			alert("���ʵ�(" + FirstCellName +")�� �������� �ʽ��ϴ�.");
		return false;
	}
}


// ǥ�� ������ ���� �߰��ϰ�, ������ ä���.
function TableAppendRowContents(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents(ColumnArray);
}

function TableAppendRowContents2(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents2(ColumnArray);
}



function TableColumnContents2(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ 
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			dact.Execute(dset);
			pHwpCtrl.Run("TableRightCell");
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("���� Ŀ���� ��ġ�� ǥ�� ���ΰ� �ƴ�.");
		return false;
	}
}

function TableDeleteRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false))
	{
		pHwpCtrl.Run("TableDeleteRow");
	}
}

function OnStart(){
	//BasePath = _GetBasePath();
	pHwpCtrl = HwpControl.HwpCtrl;

	if(!_VerifyVersion()){
		location.href='./';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release �� ���� �̺κ��� �����Ѵ�.

	InitToolBarJS();

	var frm = document.HwpControl;
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	var pay_count = frm.pay_count.value;
	var pay_page = frm.pay_page.value;
	//var paycode_total_chk = frm.paycode_total_chk.value;

	pay_table = 'pay_ledger_ase_'+pay_page+'page.hwp';

	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)) {
		alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
	}else{
		alphabet = "abcdefghijklmnopqrstuvwxyyz";
		for(k=1;k<=pay_page;k++) {
			if(k == 1) {
				p = "";
				u = "";
			} else {
				p = k;
				u = alphabet.charAt(k-1);
			}
			if (pHwpCtrl.MoveToField("[�����"+p+"]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿��⵵"+p+"]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�޿���"+p+"]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���1"+u, true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���2"+u, true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���3"+u, true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���4"+u, true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���5"+u, true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���6"+u, true, true, false)){set.SetItem("Text",frm.g6_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("��Ÿ1"+u, true, true, false)){set.SetItem("Text",frm.b1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ2"+u, true, true, false)){set.SetItem("Text",frm.b2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ3"+u, true, true, false)){set.SetItem("Text",frm.b3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ4"+u, true, true, false)){set.SetItem("Text",frm.b4_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("etc1"+u, true, true, false)){set.SetItem("Text",frm.etc1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("etc2"+u, true, true, false)){set.SetItem("Text",frm.etc2_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���1"+u, true, true, false)){set.SetItem("Text",frm.minus_text.value);act.Execute(set);}
		}
		tr_count = pay_page * 28;
		for(i=0;i<=tr_count;i++) {
			if (pHwpCtrl.MoveToField("����"+i, true, true, false)){set.SetItem("Text",frm.no[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[����"+i+"]", true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[����"+i+"]", true, true, false)){set.SetItem("Text",frm.position[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[ȣ��"+i+"]", true, true, false)){set.SetItem("Text",frm.step[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�Ի���"+i+"]", true, true, false)){set.SetItem("Text",frm.jdate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�����"+i+"]", true, true, false)){set.SetItem("Text",frm.edate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("ä������"+i, true, true, false)){set.SetItem("Text",frm.work_form[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�μ�"+i, true, true, false)){set.SetItem("Text",frm.dept[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("[�⺻�ٷ�"+i+"]", true, true, false)){set.SetItem("Text",frm.w_day[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�⺻����"+i+"]", true, true, false)){set.SetItem("Text",frm.w_ext[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�߰��ٷ�"+i+"]", true, true, false)){set.SetItem("Text",frm.w_night[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[���ϱٷ�"+i+"]", true, true, false)){set.SetItem("Text",frm.w_hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�Ұ�"+i+"]", true, true, false)){set.SetItem("Text",frm.w_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�⺻�ñ�"+i, true, true, false)){set.SetItem("Text",frm.money_time_low[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���ñ�"+i, true, true, false)){set.SetItem("Text",frm.money_time[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�⺻��"+i, true, true, false)){set.SetItem("Text",frm.money_month[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�޿�����"+i, true, true, false)){set.SetItem("Text",frm.pay_gbn[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���1"+i, true, true, false)){set.SetItem("Text",frm.g1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���2"+i, true, true, false)){set.SetItem("Text",frm.g2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���3"+i, true, true, false)){set.SetItem("Text",frm.g3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���4"+i, true, true, false)){set.SetItem("Text",frm.g4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���5"+i, true, true, false)){set.SetItem("Text",frm.g5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���6"+i, true, true, false)){set.SetItem("Text",frm.g6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("����ӱݰ�"+i, true, true, false)){set.SetItem("Text",frm.g_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�⺻����"+i, true, true, false)){set.SetItem("Text",frm.ext[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�߰��ٷ�"+i, true, true, false)){set.SetItem("Text",frm.night[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���ϱٷ�"+i, true, true, false)){set.SetItem("Text",frm.hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��������"+i, true, true, false)){set.SetItem("Text",frm.annual_paid_holiday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���������"+i, true, true, false)){set.SetItem("Text",frm.s_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("��Ÿ1"+i, true, true, false)){set.SetItem("Text",frm.b1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ2"+i, true, true, false)){set.SetItem("Text",frm.b2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ3"+i, true, true, false)){set.SetItem("Text",frm.b3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ4"+i, true, true, false)){set.SetItem("Text",frm.b4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ�����"+i, true, true, false)){set.SetItem("Text",frm.b_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�����"+i, true, true, false)){set.SetItem("Text",frm.tax_exemption[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("����"+i, true, true, false)){set.SetItem("Text",frm.taxation[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("������"+i, true, true, false)){set.SetItem("Text",frm.v_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("etc1"+i, true, true, false)){set.SetItem("Text",frm.etc[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("etc2"+i, true, true, false)){set.SetItem("Text",frm.etc2[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���ݺ���"+i, true, true, false)){set.SetItem("Text",frm.yun[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ǰ�����"+i, true, true, false)){set.SetItem("Text",frm.health[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����"+i, true, true, false)){set.SetItem("Text",frm.yoyang[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��뺸��"+i, true, true, false)){set.SetItem("Text",frm.goyong[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ҵ漼"+i, true, true, false)){set.SetItem("Text",frm.tax_so[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ֹμ�"+i, true, true, false)){set.SetItem("Text",frm.tax_jumin[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����"+i, true, true, false)){set.SetItem("Text",frm.minus[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���ݰ�"+i, true, true, false)){set.SetItem("Text",frm.tax_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("������"+i, true, true, false)){set.SetItem("Text",frm.gongje_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�޿��Ѿ�"+i, true, true, false)){set.SetItem("Text",frm.money_total[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����Ѿ�"+i, true, true, false)){set.SetItem("Text",frm.money_result[i].value);act.Execute(set);}
		}
		for(k=0;k<pay_page;k++) {
			if(k == 0) m = "";
			else m = k+1;
			if (pHwpCtrl.MoveToField("[�⺻�ٷ�s"+m+"]", true, true, false)){set.SetItem("Text",frm['w_day_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�⺻����s"+m+"]", true, true, false)){set.SetItem("Text",frm['w_ext_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�߰��ٷ�s"+m+"]", true, true, false)){set.SetItem("Text",frm['w_night_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[���ϱٷ�s"+m+"]", true, true, false)){set.SetItem("Text",frm['w_hday_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[�Ұ�s"+m+"]", true, true, false)){set.SetItem("Text",frm['w_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�⺻�ñ�s"+m, true, true, false)){set.SetItem("Text",frm['money_time_low_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���ñ�s"+m, true, true, false)){set.SetItem("Text",frm['money_time_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�⺻��s"+m, true, true, false)){set.SetItem("Text",frm['money_month_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�⺻����s"+m, true, true, false)){set.SetItem("Text",frm['ext_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�߰��ٷ�s"+m, true, true, false)){set.SetItem("Text",frm['night_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���ϱٷ�s"+m, true, true, false)){set.SetItem("Text",frm['hday_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��������s"+m, true, true, false)){set.SetItem("Text",frm['annual_paid_holiday_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���������s"+m, true, true, false)){set.SetItem("Text",frm['s_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���1s"+m, true, true, false)){set.SetItem("Text",frm['g1_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���2s"+m, true, true, false)){set.SetItem("Text",frm['g2_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���3s"+m, true, true, false)){set.SetItem("Text",frm['g3_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���4s"+m, true, true, false)){set.SetItem("Text",frm['g4_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���5s"+m, true, true, false)){set.SetItem("Text",frm['g5_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���6s"+m, true, true, false)){set.SetItem("Text",frm['g6_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("����ӱݰ�s"+m, true, true, false)){set.SetItem("Text",frm['g_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("��Ÿ1s"+m, true, true, false)){set.SetItem("Text",frm['b1_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ2s"+m, true, true, false)){set.SetItem("Text",frm['b2_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ3s"+m, true, true, false)){set.SetItem("Text",frm['b3_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ4s"+m, true, true, false)){set.SetItem("Text",frm['b4_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ�����s"+m, true, true, false)){set.SetItem("Text",frm['b_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�����s"+m, true, true, false)){set.SetItem("Text",frm['tax_exemption_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("����s"+m, true, true, false)){set.SetItem("Text",frm['taxation_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("������s"+i, true, true, false)){set.SetItem("Text",frm['v_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("etc1s"+m, true, true, false)){set.SetItem("Text",frm['etc_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("etc2s"+m, true, true, false)){set.SetItem("Text",frm['etc2_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("���ݺ���s"+m, true, true, false)){set.SetItem("Text",frm['yun_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ǰ�����s"+m, true, true, false)){set.SetItem("Text",frm['health_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����s"+m, true, true, false)){set.SetItem("Text",frm['yoyang_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��뺸��s"+m, true, true, false)){set.SetItem("Text",frm['goyong_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ҵ漼s"+m, true, true, false)){set.SetItem("Text",frm['tax_so_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�ֹμ�s"+m, true, true, false)){set.SetItem("Text",frm['tax_jumin_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��Ÿ����s"+m, true, true, false)){set.SetItem("Text",frm['minus_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���ݰ�s"+m, true, true, false)){set.SetItem("Text",frm['tax_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("������s"+m, true, true, false)){set.SetItem("Text",frm['gongje_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�����Ѿ�s"+m, true, true, false)){set.SetItem("Text",frm['tax_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�޿��Ѿ�s"+m, true, true, false)){set.SetItem("Text",frm['money_total_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����Ѿ�s"+m, true, true, false)){set.SetItem("Text",frm['money_result_sum'+m].value);act.Execute(set);}
		}
		//�Ѱ�
		if (pHwpCtrl.MoveToField("[�⺻�ٷ�t]", true, true, false)){set.SetItem("Text",frm.w_day_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�⺻����t]", true, true, false)){set.SetItem("Text",frm.w_ext_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�߰��ٷ�t]", true, true, false)){set.SetItem("Text",frm.w_night_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[���ϱٷ�t]", true, true, false)){set.SetItem("Text",frm.w_hday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[�Ұ�t]", true, true, false)){set.SetItem("Text",frm.w_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�⺻�ñ�t", true, true, false)){set.SetItem("Text",frm.money_time_low_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ñ�t", true, true, false)){set.SetItem("Text",frm.money_time_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�⺻��t", true, true, false)){set.SetItem("Text",frm.money_month_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�⺻����t", true, true, false)){set.SetItem("Text",frm.ext_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�߰��ٷ�t", true, true, false)){set.SetItem("Text",frm.night_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ϱٷ�t", true, true, false)){set.SetItem("Text",frm.hday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��������t", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���������t", true, true, false)){set.SetItem("Text",frm.s_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���1t", true, true, false)){set.SetItem("Text",frm.g1_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���2t", true, true, false)){set.SetItem("Text",frm.g2_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���3t", true, true, false)){set.SetItem("Text",frm.g3_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���4t", true, true, false)){set.SetItem("Text",frm.g4_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���5t", true, true, false)){set.SetItem("Text",frm.g5_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���6t", true, true, false)){set.SetItem("Text",frm.g6_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("����ӱݰ�t", true, true, false)){set.SetItem("Text",frm.g_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("��Ÿ1t", true, true, false)){set.SetItem("Text",frm.b1_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ2t", true, true, false)){set.SetItem("Text",frm.b2_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ3t", true, true, false)){set.SetItem("Text",frm.b3_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ4t", true, true, false)){set.SetItem("Text",frm.b4_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ�����t", true, true, false)){set.SetItem("Text",frm.b_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�����t", true, true, false)){set.SetItem("Text",frm.tax_exemption_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("����t", true, true, false)){set.SetItem("Text",frm.taxation_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("������t", true, true, false)){set.SetItem("Text",frm.v_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("etc1t", true, true, false)){set.SetItem("Text",frm.etc_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("etc2t", true, true, false)){set.SetItem("Text",frm.etc2_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("���ݺ���t", true, true, false)){set.SetItem("Text",frm.yun_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ǰ�����t", true, true, false)){set.SetItem("Text",frm.health_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����t", true, true, false)){set.SetItem("Text",frm.yoyang_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��뺸��t", true, true, false)){set.SetItem("Text",frm.goyong_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ҵ漼t", true, true, false)){set.SetItem("Text",frm.tax_so_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�ֹμ�t", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��Ÿ����t", true, true, false)){set.SetItem("Text",frm.minus_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("���ݰ�t", true, true, false)){set.SetItem("Text",frm.tax_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("������t", true, true, false)){set.SetItem("Text",frm.gongje_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("�޿��Ѿ�t", true, true, false)){set.SetItem("Text",frm.money_total_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����Ѿ�t", true, true, false)){set.SetItem("Text",frm.money_result_sum_t.value);act.Execute(set);}
	}
	pHwpCtrl.MovePos(2);
}
$(document).ready(function(e) {
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X�� �������� �ʴ� ������������ �ѱ���Ʈ���� ����� �� �����ϴ�!');
		location.href='index.php';
	}		
});