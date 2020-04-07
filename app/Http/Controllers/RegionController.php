<?php
namespace App\Http\Controllers;

use \GuzzleHttp\Client;

class RegionController extends Controller {
    protected $client;

    public function __construct(Client $client)
    {
        $this->middleware('json');

        $this->client = $client;
    }

    public function getRegions()
    {
        $response = $this->client->request('POST', 'http://policy.nec.go.kr/plc/commiment/initUCACommimentRegion.do', [
            'form_params' => [
                'sgId' => 20200415,
                'subSgId' => 220200415
            ]
        ]);

        $response = json_decode($response->getBody()->getContents());
        $regions = collect($response->regionlist);
        $result = $regions->pluck('wiwname', 'wiwid');
        return $result;
    }
}