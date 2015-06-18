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
        $sBaconNumber   = $oBaconizer->getBaconNumber();
        $sBaconName     = $oBaconizer->getBaconName($sBaconNumber);

    	$aData = [];
    	$request = new Request;
    	if($request->ip()) {
    		$sIP = $request->ip();
    	} else {
    		$sIP = 'ip';
    	}

    	$sURL = Input::get('url', null);
    	if(!is_null($sURL)) {
            if(!filter_var($sURL, FILTER_VALIDATE_URL)){
                // show error
                $this->aErrors[] = 'For bacon sake...the URL you provided isnt valid. Do you want a tasty URL or not?';
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
            $aData['errors'] = $this->aErrors;
        }

    	return view('pages.create', $aData);
    }

    public function view($sBaconNumber) {


        $oBaconizer     = new Baconizer;
        $sURL           = $oBaconizer->convertNameToNum($sBaconNumber);
		
        // $oBaconResults = DB::table('sites')->select('san_url')->where('bacon_code', '=', $baconCode)->take(1)->first();
        return redirect()->away($sURL);
    	return view('pages.view', array(
	    		'url' 		=> $sURL,
	    		// 'baconCode'	=> $sBaconNumber,
		));

    }
}
