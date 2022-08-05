<?php

namespace IPay88\Responses;

use IPay88\Base;

class Response extends Base{
    protected $respMerchantCode;

	protected $respPaymentId;

	protected $respRefNo;

	protected $respAmount;

	protected $respStatus;

	protected $respSignature;

	protected $extraResults;

	protected $mandatoryFields = [
		'MerchantCode',
		'PaymentId',
		'RefNo',
		'Amount',
		'Currency',
		'Status',
		'Signature'
	];

    public function __construct(Array $request, $validation = true)
	{
		parent::__construct();

		$this->respMerchantCode = $request['MerchantCode'];
		$this->respPaymentId = $request['PaymentId'];
		$this->respRefNo = $request['RefNo'];
		$this->respAmount = $request['Amount'];
		$this->resCurrency = $request['Currency'];
		$this->respStatus = $request['Status'];
		$this->respSignature = $request['Signature'];
		$this->extraResults = Arr::except($request, $this->mandatoryFields);

		if($validation){
			self::verifySignature();
		}
	}

    public function generateResponseSignature() : string
	{	
		$payload = [
			$this->merchantKey,
			$this->respMerchantCode,
			$this->respPaymentId,
			$this->respRefNo,
			preg_replace('/[\.\,]/', '', $this->respAmount),
			$this->resCurrency,
			$this->respStatus
		];

		$signature = self::generateSignature( join('',$payload) );

		return $signature;
	}

	public function verifySignature() : bool
	{
		$verified = ($this->respSignature == self::generateResponseSignature());
		
		if(!$verified){
			throw new InvalidSignatureException;		
		}

		return true;
	}

	public function isSuccess() : bool
	{
		return $this->respStatus == 1;
	}

	public function getExtraResults() : Array
	{
		return $this->extraResults;
	}
}