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

			if(substr($sURL, 0, strlen('http://')) !='http://' || substr($sURL, 0, strlen('https://'))  !='https://' ) {
				$sURL = 'http://' . $sURL;
			}

			// URL validation taken from Drupal's URL validator ref: https://api.drupal.org/api/drupal/includes%21common.inc/function/valid_url/7
			if( ! (bool) preg_match("
		      /^                                                      # Start at the beginning of the text
		      (?:ftp|https?|feed):\/\/                                # Look for ftp, http, https or feed schemes
		      (?:                                                     # Userinfo (optional) which is typically
		        (?:(?:[\w\.\-\+!$&'\(\)*\+,;=]|%[0-9a-f]{2})+:)*      # a username or a username and password
		        (?:[\w\.\-\+%!$&'\(\)*\+,;=]|%[0-9a-f]{2})+@          # combination
		      )?
		      (?:
		        (?:[a-z0-9\-\.]|%[0-9a-f]{2})+                        # A domain name or a IPv4 address
		        |(?:\[(?:[0-9a-f]{0,4}:)*(?:[0-9a-f]{0,4})\])         # or a well formed IPv6 address
		      )
		      (?::[0-9]+)?                                            # Server port number (optional)
		      (?:[\/|\?]
		        (?:[\w#!:\.\?\+=&@$'~*,;\/\(\)\[\]\-]|%[0-9a-f]{2})   # The path and query (optional)
		      *)?
		    $/xi", $sURL) ) {
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
