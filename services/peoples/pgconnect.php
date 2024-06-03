<?php
//require_once(DOC_ROOT."PGConnect/PGMData.php");

class PGConnect{

	private $password = "";
	private $merID = "";
	private $acqID = "";
	private $purchaseCurrency = "";
	private $version = "";
	private $signatureMethod = "";
	private $totalConvenienceFee = "";
	private $convenienceFee = "";
	private $serviceFee = "";
	private $totalAmount = "";
	private $paidTaxAmount = ""; /* Actual paid tax amount */


	/**
     * Constructor
     * 
     */
	function __construct() {
		$PGMData = new PGMData();
		$pgmData = $PGMData->getPGMData();

		$this->password = $pgmData['password'];
		$this->merID = $pgmData['merID'];
		$this->acqID = $pgmData['acqID'];
		$this->purchaseCurrency = $pgmData['purchaseCurrency'];
		$this->version = $pgmData['version'];
		$this->signatureMethod = $pgmData['signatureMethod'];

	}
	/**
	 * @author : Srimal
	 * @param $orderID
	 * @param $payAmount
	 * @return array
	 */
	public function getCheckoutFormData($orderID, $payAmount) {
		$data = array();

		$password = $this->password;
		$merID = $this->merID;
		$acqID = $this->acqID;
		$orderID = $orderID;
		$purchaseAmt = $this->generatePurchaseAmount($payAmount);
		$purchaseCurrency = $this->purchaseCurrency;
		$signatureMethod = $this->signatureMethod;

		$str = $password.$merID.$acqID.$orderID.$purchaseAmt.$purchaseCurrency;
		$signature = base64_encode(sha1($str, true));

		$data = array(
			"version"           => $this->version,
			"merID"             => $merID,
			"acqID"             => $acqID,
			"purchaseCurrency"  => $purchaseCurrency,
			"orderID"  			=> $orderID,
			"signatureMethod"   => $signatureMethod,
			"purchaseAmt"       => $purchaseAmt,
			"signature"         => $signature
		);

		return $data;

	}

	private function generatePurchaseAmount($payAmount) {
		// remake form amount to get value from 12 numbers.

		$append = '';

		// totalAmount - add 1.2% to payAmount
		$this->totalConvenienceFee = $payAmount*1.2/100;
		$this->totalConvenienceFee = number_format($this->totalConvenienceFee, 2, '.', '');


		$totalAmount = $payAmount + $this->totalConvenienceFee;
		$totalAmount = number_format($totalAmount, 2, '.', '');
		$this->totalAmount = $totalAmount;

		$this->convenienceFee = $totalAmount*1/100;
		$this->convenienceFee = number_format($this->convenienceFee, 2, '.', '');

		$this->paidTaxAmount = $totalAmount - $this->convenienceFee;
		$this->paidTaxAmount = number_format($this->paidTaxAmount, 2, '.', '');

		$this->serviceFee = $this->totalConvenienceFee - $this->convenienceFee;
		$this->serviceFee = number_format($this->serviceFee, 2, '.', '');

		$value = explode(".", $totalAmount);
		$intPart = $value[0];
		$fracPart = $value[1];

		if($fracPart == null) {
			$fracPart = "00";
		}
		else if (strlen($fracPart) == 1) {
			$fracPart = "0".$fracPart;
		}

		$intLength = strlen($intPart);
		$noOfAppends = 10 - $intLength;

		$append = str_repeat("0", $noOfAppends);

		$purchaseAmt = $append.$intPart.$fracPart;

		return $purchaseAmt;
	}

	public function getTotalConvenienceFee() {
		return $this->totalConvenienceFee;
	}
	public function getConvenienceFee() {
		return $this->convenienceFee;
	}
	public function getServiceFee() {
		return $this->serviceFee;
	}
	public function getTotalAmount() {
		return $this->totalAmount;
	}
	public function getPaidTaxAmount() {
		return $this->paidTaxAmount;
	}
}



?>