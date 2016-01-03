<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\GeoCode\Manager;
use App\Services\GeoCode\Request;

class GeoCodeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Manager $manager)
	{
		$req1 = (new Request())
			->setAddress('1600+Amphitheatre+Parkway,+Mountain+View,+CA')
			->setLanguage('en');

		// reverse geo coding
		$req2 = (new Request())
			->setLatLong(40.71, -73.96)
			->setLanguage('ru');

		$res1 = json_decode($manager->sendRequest($req1)->toJson());
		$res2 = json_decode($manager->sendRequest($req2)->toJson());

		dd($res1, $res2);
		return view('geocode.index');
	}



}
