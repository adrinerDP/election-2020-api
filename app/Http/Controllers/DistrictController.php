<?php
namespace App\Http\Controllers;

use \GuzzleHttp\Client;

class DistrictController extends Controller {
    protected $client;

    public function __construct(Client $client)
    {
        $this->middleware('json');

        $this->client = $client;
    }

    public function getDistricts($regionId)
    {
        $response = $this->client->request('POST', 'http://policy.nec.go.kr/plc/commiment/initUCACommimentSgg.do', [
            'form_params' => [
                'sgId' => 20200415,
                'subSgId' => 220200415,
                'wiwsidocode' => $regionId
            ]
        ]);

        $response = json_decode($response->getBody()->getContents());
        $districts = collect($response->sgglist);
        $result = $districts->pluck('sggname', 'sggid');
        return $result;
    }
}