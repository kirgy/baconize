<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

class PagesController extends Controller
{
    public function home() {
    	return view("pages.home");
    }

    public function about() {
    	return view("pages.about", array('fname' => 'Chris', 'lname' => 'McKirgan'));
    }

    public function create() {
    	// $oRequest = new Request;
    	// if($oRequest::isMethod('post')) {
    		// $aData = ['url' => Input::post('url')];
    	// } else {
    		// $aData = array();
    	// }
    	// $POST;
    	$sURL = Input::get('url', null);
    	return view('pages.create', array('url' => $sURL));
    }
}
