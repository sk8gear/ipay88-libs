<?php

namespace IPay88\Requests;

use IPay88\Base;

class RequestBuilder extends Base{
    // Refer to Appendix I.pdf file for MYR gateway. Refer to Appendix II.pdf file for Multi-curency gateway.
	protected $paymentID = '';

	// Unique merchant transaction number / Order
	protected $refNo;

	// Payment amount with two decimals and thousand symbols. Example: 1,278.99
	protected $amount;

	// Refer to Appendix I.pdf file for MYR gateway. Refer to Appendix II.pdf file for Multi-curency gateway.
	protected $currency;

	// Product description
	protected $prodDesc;

	// Customer name
	protected $userName;

	// Customer email for receiving receipt
	protected $userEmail;

	// Customer contact number
	protected $userContact;

	// Merchant remarks
	protected $remark = '';

	// Signature type = "SHA256" SHA-256 signature (refer to 3.1)
	protected $signature;

	//  Payment response page
	protected $responseURL;

	// Backend response page URL (refer to 2.7)
	protected $backendURL;

	public function setPaymentID($paymentID){
		$this->paymentID = $paymentID;
	}

	public function setRefNo($refNo){
		$this->refNo = $refNo;
	}

		// to 2.d.p & with thousand separator
	public function setAmount($amount){
		$this->amount = number_format($amount, 2, '.', ',');
	}

	public function setCurrency($currency){
		$this->currency = $currency;
	}

	public function setProdDesc($prodDesc){
		$this->prodDesc = $prodDesc;
	}

	public function setUserName($userName){
		$this->userName = $userName;
	}

	public function setUserEmail($userEmail){
		$this->userEmail = $userEmail;
	}

	public function setUserContact($userContact){
		$this->userContact = $userContact;
	}

	public function setRemark($remark){
		$this->remark = $remark;
	}

	public function setSignature($signature){
		$this->signature = $signature;
	}

	public function setResponseURL($responseURL){
		$this->responseURL = $responseURL;
	}

	public function setBackendURL($backendURL){
		$this->backendURL = $backendURL;
	}

    public function getRequestSignature(){
        $str = [
            $this->merchantKey,
			$this->merchantCode,
			$this->refNo,
			preg_replace('/[\.\,]/', '', $this->amount),
			$this->currency
        ];

        $this->signature = self::generateHashSignature(join('', $str));

        return $this->signature;
    }

    public function requestArray() : array{
        $this->getRequestSignature();

        return [
            'MerchantCode' => $this->merchantCode,
			'PaymentId' => $this->paymentID,
			'RefNo' => $this->refNo,
			'Amount' => $this->amount,
			'Currency' => $this->currency,
			'ProdDesc' => $this->prodDesc,
			'UserName' => $this->userName,
			'UserEmail' => $this->userEmail,
			'UserContact' => $this->userContact,
			'Remark'=>  $this->remark,
			'Lang' => $this->unicode,
			'SignatureType' => $this->signatureType,
			'Signature' => $this->signature,
			'ResponseURL' => $this->responseURL,
			'BackendURL' => $this->backendURL,
        ];
    }

	/**
	 * 
	 */
    public function makePayment($data = null){		
        // $ch = curl_init($this->requestURL);    
        
        // $payload = json_encode($this->requestArray());
        
        // \curl_setopt($ch, CURLOPT_POST, 1);
        // \curl_setopt($ch, CURLOPT_POSTFILEDS, $this->requestArray());
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $response = \curl_exec($ch);
		
		return view('iPay88::form', [
			"requestUrl" => $this->requestURL,
			"dataload" => $this->requestArray(),
			"data" => $data,
		]);
    }
}