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
		location.href='<?=$PHP_SELF?>';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release �� ���� �̺κ��� �����Ѵ�.

	InitToolBarJS();

	var frm = document.HwpControl;
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	var pay_count = frm.pay_count.value;
	var pay_page = frm.pay_page.value;

	if(pay_page > 1) pay_table = 'settle_report_'+pay_page+'page.hwp';
	else pay_table = 'settle_report.hwp';

	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)) {
		alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
	}else{
		alphabet = "abcdefghijklmnopqrstuvwxyyz";

		if (pHwpCtrl.MoveToField("���⵵", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.service_support_staff.value);act.Execute(set);}

		for(k=1;k<=pay_page;k++) {
			if(k == 1) {
				p = "";
				u = "";
			} else {
				p = k;
				u = alphabet.charAt(k-1);
			}
		}
		if(pay_page == 1) tr_count = 24;
		else if(pay_page == 2) tr_count = 53;
		else tr_count = 53;
		for(i=0;i<=tr_count;i++) {
			if (pHwpCtrl.MoveToField("��ü��"+i, true, true, false)){set.SetItem("Text",frm.com_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����"+i, true, true, false)){set.SetItem("Text",frm.person_charge[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��û"+i, true, true, false)){set.SetItem("Text",frm.application_kind[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("�Ա���"+i, true, true, false)){set.SetItem("Text",frm.main_receipt_date[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("��ü�Ա�"+i, true, true, false)){set.SetItem("Text",frm.client_receipt_fee[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("����"+i, true, true, false)){set.SetItem("Text",frm.p_support[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("����"+i, true, true, false)){set.SetItem("Text",frm.requested_amount[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("����"+i, true, true, false)){set.SetItem("Text",frm.main_income[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�����"+i, true, true, false)){set.SetItem("Text",frm.lawyer_fee[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("����"+i, true, true, false)){set.SetItem("Text",frm.allowance_rate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("�뿪��"+i, true, true, false)){set.SetItem("Text",frm.allowance_pay[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("���"+i, true, true, false)){set.SetItem("Text",frm.remark_text[i].value);act.Execute(set);}
		}
		for(k=0;k<pay_page;k++) {
			if(k == 0) m = "";
			else m = k+1;
		}
		//�Ѱ�
		if (pHwpCtrl.MoveToField("��ü�Ա�s", true, true, false)){set.SetItem("Text",frm.client_receipt_fee_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("����s", true, true, false)){set.SetItem("Text",frm.requested_amount_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("����s", true, true, false)){set.SetItem("Text",frm.main_income_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�����s", true, true, false)){set.SetItem("Text",frm.lawyer_fee_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("�뿪��s", true, true, false)){set.SetItem("Text",frm.allowance_pay_sum_t.value);act.Execute(set);}
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