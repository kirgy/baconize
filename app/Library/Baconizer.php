<?php namespace App\library {

	use DB;
	class Baconizer {

		public function __construct(){
			$this->aBaconList = array(
				'0'	=> 'StreakyBacon',
				'1'	=> 'MiddleBacon',
				'2'	=> 'BackBacon',
				'3'	=> 'JowlBacon',
				'4'	=> 'CandianBacon',
				'5'	=> 'SmokedBacon',
				'6'	=> 'UnsmokedBacon',
				'7'	=> 'SlabBacon',
				'8'	=> 'Pancetta',
				'9'	=> 'Fatback',
				'a'	=> 'GypsyBacon',
				'b'	=> 'IrishBacon',
				'c'	=> 'CottageBacon',
				'd'	=> 'PeamealBacon',
			);
		}

		public function getBaconNumber() {
			$sBaconNumber = '';
			for($i=0; $i<=5; $i++){

				$aNumMap = array_keys($this->aBaconList);
				$sBaconNumber .= (string) $aNumMap[rand(0,(count($this->aBaconList)-1))];
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

			if(!is_object($sBaconSite)){
				$mReturn = false;
			} else {
				$mReturn = $sBaconSite->san_url;
			}

			return $mReturn;
		}
	}
}