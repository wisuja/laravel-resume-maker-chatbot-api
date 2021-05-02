<?php

namespace App\Http\Controllers;

use App\Libraries\Careerjet_API;
use App\Models\Cv;
use Illuminate\Http\Request;


class JobSearchController extends Controller
{
    private $careerJet;

    public function __construct()
    {
        $this->careerJet = new Careerjet_API;   
    }

    public function search(Cv $cv, string $keyword) {
        $url_recommendation = $this->searchJobs($keyword);

        $cv->update([
            'url_recommendation' => $url_recommendation
        ]);

        $response = [
            'message' => 'Jobs recommendation',
            'data' => explode('|', $url_recommendation)
        ];

        return response($response, 200);
    }

    public function searchJobs($keyword, $location = 'Indonesia', $page = 1) {
		$jobs = $this->careerJet->search([
			'keywords' => $keyword,
			'location' => $location,
			'page' => $page ,
            'pagesize' => 5,
			'affid' => env('CAREERJET_AFFID'),
        ])->jobs;

        $url_recommendation = [];

        foreach($jobs as $job) {
            array_push($url_recommendation, $job->url);
        }

        $url_recommendation = implode("|", $url_recommendation);

        return $url_recommendation;
    }
}
