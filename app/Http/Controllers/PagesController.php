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
			// validate URL
			$sRawURL 	= $sURL;
			$aParsedURL = parse_url($sURL);

			if($aParsedURL != false && !isset($aParsedURL['scheme'])) {
				$sURL = 'http://' . $sURL;
				$aParsedURL = parse_url($sURL);
			}

			if( $aParsedURL == false || !isset($aParsedURL['host']) ) {
				$this->aErrors[] = 'That URL is not valid dude. In order to supply you with a baconized beauty, you need a valid URL man!';
			} else {
				if(!preg_match('/^[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-]+$/', $aParsedURL['host'])) {
					$this->aErrors[] = 'That URL is not valid dude. In order to supply you with a baconized beauty, you need a valid URL man!';
				} else {
					if(!isset($aParsedURL['scheme'])) {
						// array_unshift($aParsedURL, 'http://');
						$sURL = 'http://' . $sURL;
					}
					$oExistingSite = DB::table('sites')->select('*')->where('san_url', '=', $sURL)->take(1)->first();

					if($oExistingSite) {
						// url has already been created, retrieve it
						$sURL 			= $oExistingSite->san_url;
						$sBaconNumber 	= $oExistingSite->bacon_number;
						$sBaconName 	= $oExistingSite->bacon_code;
					} else {
						// url has never been created before, create it
						$sBaconNumber   = $oBaconizer->getBaconNumber();
						$sBaconName     = $oBaconizer->getBaconName($sBaconNumber);

						DB::table('sites')->insert(
							[
								'raw_url'    	=> $sRawURL,
								'san_url'    	=> $sURL,
								'bacon_number'  => $sBaconNumber,
								'bacon_code' 	=> $sBaconName,
								'view_count' 	=> 0,
								'creator_ip'	=> $sIP,
								'created_at'	=> date('Y-m-d H:i:s'),
								'updated_at'	=> date('Y-m-d H:i:s'),
							]
						);    		
					}

					$aData = array(
						'url' 	      	=> $sURL, 
						'baconNumber'   => $sBaconNumber, 
						'baconName'     => $sBaconName, 
						'baconURL'   	=> App::make('url')->to('/'),
					);
				}				
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
		} else {
			$oView = view('pages.error_baconnotfound', array(
				'url' 		=> $sBaconNumber,
			));
		}
		
		return $oView;
	}
}
