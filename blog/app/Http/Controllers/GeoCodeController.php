<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\GeoCode\Manager;
use App\Services\GeoCode\Query\Geocoding as GeoCodeQuery;
use App\Services\GeoCode\Query\ReverseGeocoding as ReverseGeoCodeQuery;

class GeoCodeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Manager $manager)
    {
        $query1 = (new GeoCodeQuery())
            ->setAddress('1600+Amphitheatre+Parkway,+Mountain+View,+CA')
            ->setLanguage('en');

        $query2 = (new GeoCodeQuery())->setAddress('Winnetka')
            ->setBounds([[34.172,-118.604],[34.236, -118.500]]);

        $query4 = (new GeoCodeQuery())->setAddress('Toledo')
            ->setRegion('es')
            ->setLanguage('ru');

        $query5 = (new GeoCodeQuery())->setAddress('santa cruz')
            ->addComponent('country','ES');

        $query6 = (new GeoCodeQuery())->setAddress('Torun')
            ->addComponent('administrative_area','TX')
            ->addComponent('country','US');

        $query7 = (new GeoCodeQuery())
            ->addComponent('route','Annegatan')
            ->addComponent('administrative_area','Helsinki')
            ->addComponent('country','Finland');


        // reverse geo coding
        $rQuery = (new ReverseGeoCodeQuery())
            ->setLatLong('40.714224', '-73.961452')
            ->setLanguage('ru');

        $rQuery2 = (new ReverseGeoCodeQuery())
            ->setPlaceId('ChIJd8BlQ2BZwokRAFUEcm_qrcA')
            ->setLanguage('en');


        $res1 = json_decode($manager->sendRequest($query1)->toJson());
        $res2 = json_decode($manager->sendRequest($query2)->toJson());
        $res3 = json_decode($manager->sendRequest($query4)->toJson());
        $res4 = json_decode($manager->sendRequest($query5)->toJson());
        $res5 = json_decode($manager->sendRequest($query6)->toJson());
        $res6 = json_decode($manager->sendRequest($query7)->toJson());
        $res7 = json_decode($manager->sendRequest($rQuery)->toJson());
        $res8 = json_decode($manager->sendRequest($rQuery2)->toJson());

        dd($res1, $res2, $res3, $res4, $res5, $res6, $res7, $res8);
        return view('geocode.index');
    }
}
