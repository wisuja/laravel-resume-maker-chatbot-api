<?php

namespace App\Http\Controllers;

use App\Libraries\Careerjet_API;
use Illuminate\Http\Request;


class JobSearchController extends Controller
{
    private $careerJet;

    public function __construct()
    {
        $this->careerJet = new Careerjet_API;   
    }

    public function search($keywords, $location = 'Indonesia', $page = 1) {
		$jobs = $this->careerJet->search([
			'keywords' => $keywords,
			'location' => $location,
			'page' => $page ,
            'pagesize' => 5,
			'affid' => env('CAREERJET_AFFID'),
        ])->jobs;

        return $jobs;
    }
}
