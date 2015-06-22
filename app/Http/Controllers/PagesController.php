<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use DB;
use App;
use App\Library\Baconizer;

class PagesController extends Controller
{
	public function __construct() {
		$this->aErrors = [];
	}
	public function home() {
		return view("pages.home");
	}

	public function about() {
		return view("pages.about", array('fname' => 'Chris', 'lname' => 'McKirgan'));
	}

	public function create() {

		$oBaconizer     = new Baconizer;

		$aData = [];
		$request = new Request;
		if($request->ip()) {
			$sIP = $request->ip();
		} else {
			$sIP = 'ip';
		}

		$sURL = Input::get('url', null);
		if(!is_null($sURL)) {
			$sBaconNumber   = $oBaconizer->getBaconNumber();
			$sBaconName     = $oBaconizer->getBaconName($sBaconNumber);
			
			if(!filter_var($sURL, FILTER_VALIDATE_URL)){
				// show error
				$this->aErrors['invalid-url'] = 'For bacon sake...the URL you provided isnt valid. Do you want a tasty URL or not?';
			} else {
				DB::table('sites')->insert(
					[
					'raw_url'    	=> $sURL,
					'san_url'    	=> $sURL,
					'bacon_number'  => $sBaconNumber,
					'bacon_code' 	=> $sBaconName,
					'view_count' 	=> 0,
					'creator_ip'	=> $sIP,
					'created_at'	=> date('Y-m-d H:i:s'),
					'updated_at'	=> date('Y-m-d H:i:s'),
					]
				);    		

				$aData = array(
					'url' 	      	=> $sURL, 
					'baconNumber'   => $sBaconNumber, 
					'baconName'     => $sBaconName, 
					'baconURL'   	=> App::make('url')->to('/'),
				);
			}
		}
		if(count($this->aErrors)) {
			$aData['errors']        = $this->aErrors;
		}

		$aData['submitted_url'] = Input::get('url', null);

		return view('pages.create', $aData);
	}

	public function view($sBaconNumber) {
		$oBaconizer     = new Baconizer;
		$mURL           = $oBaconizer->convertNameToNum($sBaconNumber);

		if($mURL) {
			$sURL 	= $mURL;
			$oView 	= redirect()->away($sURL);
			// $oView 	= "Heres your url brah: {$sURL}";
		} else {
			$oView = view('pages.error_baconnotfound', array(
				//@todo return old bacon url below
				'url' 		=> 'Return the old bacon url here...',
				// 'baconCode'	=> $sBaconNumber,
			));
		}
		
		return $oView;
	}
}
