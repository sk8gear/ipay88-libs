<form id="ipay88form" action="{{ $requestUrl }}" method="POST">	
	<input type='hidden' name='MerchantCode' value="{{ $dataload['MerchantCode'] }}">
	<input type='hidden' name='PaymentId' value="{{ $dataload['PaymentId'] }}">
	<input type='hidden' name='RefNo' value="{{ $dataload['RefNo'] }}">
	<input type='hidden' name='Amount' value="{{ $dataload['Amount'] }}">
	<input type='hidden' name='Currency' value="{{ $dataload['Currency'] }}">
	<input type='hidden' name='ProdDesc' value="{{ $dataload['ProdDesc'] }}">
	<input type='hidden' name='UserName' value="{{ $dataload['UserName'] }}">
	<input type='hidden' name='UserEmail' value="{{ $dataload['UserEmail'] }}">
	<input type='hidden' name='UserContact' value="{{ $dataload['UserContact'] }}">
	<input type='hidden' name='Remark' value="{{ $dataload['Remark'] }}">
	<input type='hidden' name='Lang' value="{{ $dataload['Lang'] }}">
	<input type='hidden' name='SignatureType' value="{{ $dataload['SignatureType'] }}">
	<input type='hidden' name='Signature' value="{{ $dataload['Signature'] }}">
	<input type='hidden' name='ResponseURL' value="{{ $dataload['ResponseURL'] }}">
	<input type='hidden' name='BackendURL' value="{{ $dataload['BackendURL'] }}">	
</form>

<script type="text/javascript">
	window.onload = function(){
		document.getElementById('ipay88form').submit();
	}
</script>