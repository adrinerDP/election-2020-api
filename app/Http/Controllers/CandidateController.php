<?php
namespace App\Http\Controllers;

use \GuzzleHttp\Client;

class CandidateController extends Controller {
    protected $client;

    public function __construct(Client $client)
    {
        $this->middleware('json');

        $this->client = $client;
    }

    public function getCandidates($regionId, $districtId)
    {
        $response = $this->client->request('POST', 'http://policy.nec.go.kr/plc/commiment/initUCACommimentList.do', [
            'form_params' => [
                'sgId' => 20200415,
                'subSgId' => 220200415,
                'sgTypecode' => 2,
                'pageIndex' => 1,
                'elecEndYn' => 'N',
                'hRegionId' => $regionId,
                'hSggId' => $districtId
            ]
        ]);

        $response = json_decode($response->getBody()->getContents());
        $candidates = collect($response->list);
        $result = [];

        foreach ($candidates as $candidate) {
            $PDF = explode('||', $candidate->fileinfo);
            array_push($result, [
                'regionId' => $regionId,
                'districtId' => $districtId,
                'candidateId' => $candidate->huboid,
                'candidateNumber' => $candidate->hbjgiho,
                'candidateName' => $candidate->hbjname,
                'candidateOccupation' => $candidate->hbjjikup,
                'candidateEducation' => $candidate->hbjhakruk,
                'candidateThumbnail' => 'http://policy.nec.go.kr/photo_20200415/'.$candidate->filename,
                'candidateCommitment' => 'http://policy.nec.go.kr/plc/common/downloadFile.do?requestedFileName=선거공보_'.$candidate->hbjname.'.pdf&requestedFullPath='.$PDF[1],
                'partyId' => $candidate->jdid,
                'partyName' => $candidate->jdname,
            ]);
        }

        return $result;
    }
}