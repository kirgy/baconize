<?php namespace App\library {

	use DB;
    class Baconizer {

    	public function __construct(){
	    	$this->aBaconList = array(
	    		0 => 'Bacon',
	    		1 => 'BaconButter',
	    		2 => 'BaconSandwich',
	    		3 => 'CheesyBaconPopcorn',
	    		4 => 'CandianBacon',
	    		5 => 'SmokedBacon',
	    		6 => 'UnsmokedBacon',
	    		7 => 'BaconSalt',
	    		8 => 'BaconToothpaste',
	    		9 => 'Banonaise',
	    	);
	    	$this->aNumMap = array(
	    		'0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
	    	);
    	}

    	public function getBaconNumber() {
    		$sBaconNumber = '';
    		for($i=0; $i<=5; $i++){
    			$sBaconNumber .= (string) $this->aNumMap[rand(0,(count($this->aBaconList)-1))];
    		}

			$aResults = DB::table('sites')->select('san_url')->where('bacon_number', '=', $sBaconNumber)->get();
			if(count($aResults)>0) {
				$sBaconNumber = $this->getBaconNumber();
			}

			return $sBaconNumber;
    	}

    	public function getBaconName($sBaconNumber) {
    		$aChars = str_split($sBaconNumber);
    		foreach($aChars as $sThisNum){
    			$aBaconName[] = $this->aBaconList[$sThisNum];
    		}

    		$sBaconName = implode('-', $aBaconName);
    		return $sBaconName;
    	}

    	public function convertNameToNum($sBaconName) {
    		$aBaconName = explode('-', $sBaconName);
    		$sBaconNumber = '';
    		foreach($aBaconName as $sBaconName) {
    			$iThisNum = array_search($sBaconName, $this->aBaconList);
    			$sBaconNumber .= $iThisNum;
    		}

    		// return $sBaconNumber;
			$sBaconSite = DB::table('sites')->select('san_url')->where('bacon_number', '=', $sBaconNumber)->take(1)->first();


			return $sBaconSite->san_url;
    	}
    }
}