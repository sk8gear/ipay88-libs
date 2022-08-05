<?php

namespace IPay88;

class Base{
	protected $merchantKey;
	
	protected $merchantCode;
	
	protected $requestURL = "https://payment.ipay88.com.my/ePayment/entry.asp";
	
	protected $requeryURL = "https://payment.ipay88.com.my/ePayment/enquiry.asp";
	
	protected $unicode = "UTF-8";
	
	protected $signatureType = "SHA256";

	public function __construct(){
		$this->merchantKey = config('ipay88.merchantKey');
		$this->merchantCode = config('ipay88.merchantCode');
	}
	
	/**
	*
	*/
	public function setMerchantKey($merchantKey){
		$this->merchantKey = $merchantKey;
	}
	
	/**
	*
	*/
	public function setMerchantCode($merchantCode){
		$this->merchantCode = $merchantCode;
	}
	
	/**
	*
	*/
	public function setRequestURL($requestURL){
		$this->requestURL = $requestURL;		
	}

	/**
	*
	*/
	public function setRequeryURL($requeryURL){
		$this->$requeryURL = $requeryURL;
	}

	/**
	*
	*/
	public function setUnicode($unicode){
		$this->unicode = $unicode;
	}

	/**
	*
	*/
	public function setSignatureType($signatureType){
		$this->signatureType = $signatureType;
	}

	/**
	*
	*/
	public function generateHashSignature(String $source) : String {
		return hash('sha256', $source);
	}
}