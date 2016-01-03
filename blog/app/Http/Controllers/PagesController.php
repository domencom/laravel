<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class PagesController extends Controller {

	public function about()
    {
        return view('pages.about')->with('name', 'Domencom');
    }

}
