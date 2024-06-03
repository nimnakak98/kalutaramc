<?php 

/**
 *
 */
class PGMData
{
	
	/**
	 * @author Srimal
	 * @return array PG merchant data
	 */
	public function getPGMData() {
		$pgmData = array();

	
		
		$password = "70Ja0rR'";
		$merID = "1000000003486";
		$acqID = "454486";
		$purchaseCurrency = "144";
		$version = "1.0.0";
		$signatureMethod = "SHA1";

		$pgmData = array(
			'password'         => $password,
			'merID'            => $merID,
			'acqID'            => $acqID,
			'purchaseCurrency' => $purchaseCurrency,
			'version'          => $version,
			'signatureMethod'  => $signatureMethod
		);

		return $pgmData;
	}
}

?>