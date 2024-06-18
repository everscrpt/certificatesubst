<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Model\Setting;
use App\Traits\DateFunctions;
use Goutte;
use Illuminate\Http\Request;
use Storage;

class SearchController extends Controller
{
    use DateFunctions;

    private $maxItemPerSite = 10;

    private $maxItemOwnSite = 10;

    private $displayExternalLink = true;

    private $searchResults = [];

    private $dateRangeStart = '';

    private $dateRangeEnd = '';

    private $adLandingPage = 'https://ontarioconstructionnews.com/';

    private $strictSearch = false;

    public function search(Request $request)
    {

        if (! isset($request->search) || ! isset($request->dateStart) || ! isset($request->dateEnd)) {
            return redirect('/');
        }
        // $dateBetween = $request->dateBetween;

        // $dateArray = explode('-',$dateBetween);

        // $this->dateRangeStart = $this->getFormattedDate(trim($dateArray[0]), 'd/m/Y', 'Y-m-d');
        // $this->dateRangeEnd = $this->getFormattedDate(trim($dateArray[1]), 'd/m/Y', 'Y-m-d');

        $searchKeyword = $request->search;

        if ($searchKeyword[0] == '"' && $searchKeyword[strlen($searchKeyword) - 1] == '"') {
            // do something
            $this->strictSearch = true;

        }

        $this->dateRangeStart = $this->getFormattedDate($request->dateStart, 'd/m/Y', 'Y-m-d');
        $this->dateRangeEnd = $this->getFormattedDate($request->dateEnd, 'd/m/Y', 'Y-m-d');

        $this->searchResults = [];

        $resultFromOntario = [];
        $resultFromConstruct = [];
        $resultFromLink = [];

        $resultFromOntario = $this->scrapeOntarioConstructionNews($request);
        $resultFromConstruct = $this->scrapeConstructConnect($request);
        $resultFromLink = $this->scrapeLink2Build($request);

        $mixResult = $resultFromConstruct;
        $mixResult = array_merge($mixResult, $resultFromLink);

        if ($this->strictSearch) {

            //filter other website data
            $newResult = [];
            foreach ($mixResult as $result) {

                if ($this->arraySearchStr($result, trim($request['search'], '"'))) {
                    array_push($newResult, $result);
                }

            }
            $mixResult = $newResult;

            //filter own website data
            $newResult = [];
            foreach ($resultFromOntario as $result) {

                // dd($this->arraySearchStr($result,trim($request['search'],'"')));

                if ($this->arraySearchStr($result, trim($request['search'], '"'))) {
                    array_push($newResult, $result);
                }

            }
            $resultFromOntario = $newResult;

        }

        // dd($mixResult);

        shuffle($mixResult);

        // Get Search Ocn
        $search_data = Setting::select('value')->where(['key' => 'search_ocn'])->first();
        $search_ocn = json_decode($search_data->value);

        if (count($resultFromOntario)) {
            $this->searchResults = $resultFromOntario;
        } else {
            $this->searchResults = [
                [
                    'ad' => true,
                    'url' => $search_ocn->image,
                    'landingPage' => $search_ocn->link,
                ],
            ];
        }

        $certificates = array_merge($this->searchResults, $mixResult);
        $resultCount = count($certificates);

        // foreach($certificates as $certificate){

        //     if(!isset($certificate['owner'])){
        //         dd($certificate);
        //     }
        // }

        // $previousPageLink
        // $previousPageLink

        // Get Page Data
        $searchData = Setting::select('value')->where(['key' => 'search_setting'])->first();

        $data = json_decode($searchData->value);

        $pageTitle = $data->title;
        $page_desc = $data->meta_description;

        $pagination = $this->pagination($request);

        $totalResult = count($mixResult) + count($resultFromOntario);

        return view('web.search', compact('certificates', 'data', 'pageTitle', 'page_desc', 'pagination', 'totalResult'));

    }

    private function pagination($request)
    {

        $pagination = [];

        if ($request->page) {
            $page = $request->page;
        } else {
            $page = 1;
        }

        $params = [
            'search' => $request['search'],
            // 'dateBetween' => $request['dateBetween'],
            'dateStart' => $request['dateStart'],
            'dateEnd' => $request['dateEnd'],
        ];

        // if(isset($request['dateBetween']) && !empty($request['sdate'])){
        //     $params['sdate'] = $request['sdate'];
        // }

        // if(isset($request['edate']) && !empty($request['edate'])){
        //     $params['edate'] = $request['edate'];
        // }

        $pagination['page'] = $page;

        $params['page'] = $page - 1;
        $searchUrl = route('search', $params);
        $pagination['previousPageLink'] = $searchUrl;

        $params['page'] = $page + 1;
        $searchUrl = route('search', $params);
        $pagination['nextPageLink'] = $searchUrl;

        if ($page > 1) {
            $params['page'] = 1;
            $searchUrl = route('search', $params);
            $pagination['pageOne'] = $searchUrl;
            $pagination['pageOneVal'] = $params['page'];
        }

        $params['page'] = $page + 3;
        $searchUrl = route('search', $params);
        $pagination['nPlusTwo'] = $searchUrl;
        $pagination['nPlusTwoVal'] = $params['page'];

        return $pagination;

    }

    private function scrapeConstructConnect($request)
    {

        $searchResultsSiteWise = [];

        $params = [
            'phrase' => trim($request['search'], '"'),
            'date' => 'custom',
            'date_from' => $this->dateRangeStart,
            'date_to' => $this->dateRangeEnd,
        ];

        if (isset($request['sdate']) && ! empty($request['sdate'])) {
            $params['date_from'] = $request['sdate'];
        }

        if (isset($request['edate']) && ! empty($request['edate'])) {
            $params['date_to'] = $request['edate'];
        }

        if (isset($request['page']) && ! empty($request['page'])) {
            $params['ccpage'] = $request['page'];
        }

        $url = 'https://canada.constructconnect.com/dcn/certificates-and-notices?'.http_build_query($params);

        // die($url);

        $crawler = Goutte::request('GET', $url);

        $crawler = $crawler->filter('.search-results__wrapper');

        $crawler->filter('.search-results__wrapper .cards-item')->each(function ($card) use (&$searchResultsSiteWise) {

            $certificate = ['ad' => false, 'owner_data' => []];
            $certificate['site'] = 'dailycommercialnews.com';
            $certificate['title'] = $card->filter('.cards-title a')->text();

            if ($this->displayExternalLink) {
                $certificate['link'] = 'https://canada.constructconnect.com'.$card->filter('.cards-title a')->attr('href');
            } else {
                $certificate['link'] = '#';
            }

            $line = 1;

            $card->filter('.cards-header dl')->each(function ($dl) use (&$line, &$certificate) {

                $attr = $dl->filter('dt')->text();

                switch ($attr) {
                    case 'Published':   $certificate['date_of_publish'] = $dl->filter('dd')->text();
                        break;

                    case 'Location of premises':    $certificate['location'] = $dl->filter('dd')->text();
                        break;
                }

            });

            $elements = [];

            $line = 1;

            $card->filter('.cards-inner > dl')->each(function ($dl) use (&$line, &$certificate, &$elements) {

                $tmpElement = [];

                $dl->children()->each(function ($child) use (&$tmpElement) {
                    $attr = $child->text();
                    array_push($tmpElement, $attr);
                });

                if (isset($tmpElement[0]) && isset($tmpElement[1])) {
                    // $certificate[$tmpElement[0]] = $tmpElement[1];
                    array_push($certificate['owner_data'], [
                        'title' => $tmpElement[0],
                        'data' => $tmpElement[1],
                    ]);
                }

                if (isset($tmpElement[2]) && isset($tmpElement[3])) {
                    array_push($certificate['owner_data'], [
                        'title' => $tmpElement[2],
                        'data' => $tmpElement[3],
                    ]);
                }
            });

            array_push($searchResultsSiteWise, $certificate);

        });

        $searchResultsSiteWise = array_slice($searchResultsSiteWise, 0, $this->maxItemPerSite);

        return array_merge($this->searchResults, $searchResultsSiteWise);
    }

    private function scrapeConstructConnectFetchAll($request)
    {

        $searchResultsSiteWise = [];

        $params = [
            'phrase' => trim($request['search'], '"'),
            'date' => 'custom',
            'date_from' => $this->dateRangeStart,
            'date_to' => $this->dateRangeEnd,
        ];

        if (isset($request['sdate']) && ! empty($request['sdate'])) {
            $params['date_from'] = $request['sdate'];
        }

        if (isset($request['edate']) && ! empty($request['edate'])) {
            $params['date_to'] = $request['edate'];
        }

        for ($i = 1; $i < 15; $i++) {

            if (isset($request['page']) && ! empty($request['page'])) {
                $params['ccpage'] = $i;
            }

            $url = 'https://canada.constructconnect.com/dcn/certificates-and-notices?'.http_build_query($params);

            // die($url);

            $crawler = Goutte::request('GET', $url);

            $crawler = $crawler->filter('.search-results__wrapper');

            $crawler->filter('.search-results__wrapper .cards-item')->each(function ($card) use (&$searchResultsSiteWise) {

                $certificate = ['ad' => false, 'owner_data' => []];
                $certificate['site'] = 'dailycommercialnews.com';
                $certificate['title'] = $card->filter('.cards-title a')->text();

                if ($this->displayExternalLink) {
                    $certificate['link'] = 'https://canada.constructconnect.com'.$card->filter('.cards-title a')->attr('href');
                } else {
                    $certificate['link'] = '#';
                }

                $line = 1;

                $card->filter('.cards-header dl')->each(function ($dl) use (&$line, &$certificate) {

                    $attr = $dl->filter('dt')->text();

                    switch ($attr) {
                        case 'Published':   $certificate['date_of_publish'] = $dl->filter('dd')->text();
                            break;

                        case 'Location of premises':    $certificate['location'] = $dl->filter('dd')->text();
                            break;
                    }

                });

                $elements = [];

                $line = 1;

                $card->filter('.cards-inner > dl')->each(function ($dl) use (&$line, &$certificate, &$elements) {

                    $tmpElement = [];

                    $dl->children()->each(function ($child) use (&$tmpElement) {
                        $attr = $child->text();
                        array_push($tmpElement, $attr);
                    });

                    if (isset($tmpElement[0]) && isset($tmpElement[1])) {
                        // $certificate[$tmpElement[0]] = $tmpElement[1];
                        array_push($certificate['owner_data'], [
                            'title' => $tmpElement[0],
                            'data' => $tmpElement[1],
                        ]);
                    }

                    if (isset($tmpElement[2]) && isset($tmpElement[3])) {
                        array_push($certificate['owner_data'], [
                            'title' => $tmpElement[2],
                            'data' => $tmpElement[3],
                        ]);
                    }
                });

                array_push($searchResultsSiteWise, $certificate);

            });

        }

        return array_merge($this->searchResults, $searchResultsSiteWise);
    }

    private function scrapeLink2Build($request, $fetchAll = false)
    {

        if ($fetchAll === true) {
            $url = 'https://certificates.link2build.ca/';
        } else {
            $dateStart = $this->getFormattedDate($this->dateRangeStart, 'Y-m-d', 'm/d/Y');
            $dateEnd = $this->getFormattedDate($this->dateRangeEnd, 'Y-m-d', 'm/d/Y');
            // DateText: 04/01/2020 - 04/30/2020
            $params = [
                'Search' => trim($request['search'], '"'),
                'DateText' => $dateStart.' - '.$dateEnd,
            ];
            $url = 'https://certificates.link2build.ca/?'.http_build_query($params);
        }

        // if(isset($request['sdate']) && !empty($request['sdate'])){
        //     $params['date_from'] = $request['sdate'];
        // }

        // if(isset($request['edate']) && !empty($request['edate'])){
        //     $params['date_to'] = $request['edate'];
        // }

        // die($url);
        $crawler = Goutte::request('GET', $url);

        $crawler = $crawler->filter('.datatable');

        $searchResultsSiteWise = [];

        $crawler->filter('tbody tr')->each(function ($tr) use (&$searchResultsSiteWise) {
            // $certificate = ['ad' => false];
            $certificate = ['ad' => false, 'owner_data' => []];
            $certificate['site'] = 'link2build.ca';
            $certificate['title'] = $tr->filter('td a')->text();

            if ($this->displayExternalLink) {
                $certificate['link'] = 'https://certificates.link2build.ca'.$tr->filter('td a')->attr('href');
            } else {
                $certificate['link'] = '#';
            }

            $columnNo = 1;
            $tr->filter('td')->each(function ($columns) use (&$columnNo, &$certificate) {
                $objectText = $columns->text();

                if ($columnNo == 1) {
                    // $certificate['location'] = $objectText;
                    $certificate['location'] = trim(str_replace($certificate['title'], '', $objectText));
                }

                if ($columnNo == 2) {
                    $certificate['date_of_publish'] = $objectText;
                }

                if ($columnNo == 3) {
                    // $certificate['owner'] = $objectText;
                    $o_data = [
                        'title' => 'Owner',
                        'data' => $objectText,
                    ];

                    array_push($certificate['owner_data'], $o_data);
                }

                if ($columnNo == 4) {
                    // $certificate['contractor'] = $objectText;
                    $o_data = [
                        'title' => 'Contractor',
                        'data' => $objectText,
                    ];

                    array_push($certificate['owner_data'], $o_data);

                }

                $columnNo++;
            });

            array_push($searchResultsSiteWise, $certificate);

        });

        if ($fetchAll === true) {
            return $searchResultsSiteWise;
        }

        if ($request['page']) {
            $page = $request['page'];
        } else {
            $page = 1;
        }

        $startIndex = $this->maxItemPerSite * ($page - 1);

        $searchResultsSiteWise = array_slice($searchResultsSiteWise, $startIndex, $this->maxItemPerSite);

        return array_merge($this->searchResults, $searchResultsSiteWise);
    }

    private function scrapeOntarioConstructionNews($request, $fetchAll = false)
    {

        //contractor_name_like=&date_published=custom&date_published_from=2020-04-01&date_published_to=2020-04-30

        if ($fetchAll) {
            $params = [
                'per_page' => 200, // set a high value to fetch all
                'search' => trim($request['search'], '"'),
                'date_published' => 'custom',
                'date_published_from' => $this->dateRangeStart,
                'date_published_to' => $this->dateRangeEnd,
            ];
        } else {
            $params = [
                'per_page' => $this->maxItemOwnSite,
                'search' => trim($request['search'], '"'),
                'date_published' => 'custom',
                'date_published_from' => $this->dateRangeStart,
                'date_published_to' => $this->dateRangeEnd,
            ];
        }

        if (isset($request['page']) && ! empty($request['page'])) {
            $params['certificates_page'] = $request['page'];
        }

        // if(isset($request['sdate']) && !empty($request['sdate'])){
        //     $params['date_from'] = $request['sdate'];
        // }

        // if(isset($request['edate']) && !empty($request['edate'])){
        //     $params['date_to'] = $request['edate'];
        // }

        $url = 'https://ontarioconstructionnews.com/certificates/?'.http_build_query($params);

        // die($url);

        $crawler = Goutte::request('GET', $url);

        $crawler = $crawler->filter('.ocn-certificates-table');

        $searchResultsSiteWise = [];

        $crawler->filter('.ocn-certificate-row')->each(function ($tr) use (&$searchResultsSiteWise) {

            $certificate = ['ad' => false, 'owner_data' => []];
            $certificate['site'] = 'ontarioconstructionnews.com';
            $certificate['title'] = $tr->filter('td a')->text();
            $certificate['link'] = $tr->filter('td a')->attr('href');

            $columnNo = 1;
            $tr->filter('td')->each(function ($columns) use (&$columnNo, &$certificate) {
                $objectText = $columns->text();

                if ($columnNo == 1) {
                    // $certificate['location'] = $objectText;
                    $certificate['location'] = trim(str_replace($certificate['title'], '', $objectText));
                }

                if ($columnNo == 2) {
                    // $certificate['date_of_publish'] = $objectText;
                    $certificate['date_of_publish'] = $this->getFormattedDate(trim($objectText), 'y/m/d', 'F j, Y');

                }

                if ($columnNo == 3) {
                    $o_data = [
                        'title' => 'Owner',
                        'data' => $objectText,
                    ];

                    array_push($certificate['owner_data'], $o_data);
                }

                if ($columnNo == 4) {
                    $o_data = [
                        'title' => 'Contractor',
                        'data' => $objectText,
                    ];

                    array_push($certificate['owner_data'], $o_data);
                }

                $columnNo++;
            });

            // dd($certificate);

            array_push($searchResultsSiteWise, $certificate);

        });

        $searchResultsSiteWise = array_slice($searchResultsSiteWise, 0, $this->maxItemOwnSite);

        return array_merge($this->searchResults, $searchResultsSiteWise);
    }

    private function getAd()
    {
        $path = storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'ads');
        if (! \file_exists($path)) {
            \mkdir($path, 0777, true);
            exit('Please create ad directory');
        }

        $files = scandir($path);

        $adFiles = [];

        $count = 0;
        foreach ($files as $file) {

            $mime_type = mime_content_type($path.DIRECTORY_SEPARATOR.$file);
            if ($mime_type == 'directory' && $count++ < 20) {
                continue;
            }

            array_push($adFiles, $file);
        }

        if (count($adFiles)) {
            $adFile = \array_rand($adFiles);

            $randomAd = $adFile;

            return Storage::url('ads/'.$file);
        } else {
            return null;
        }
    }

    private function arraySearchStr($array, $search)
    {

        foreach ($array as $key => $child) {

            if (is_array($child)) {
                if ($this->arraySearchStr($child, $search) === true) {
                    return true;
                }
            } elseif (stripos($child, $search) !== false) {
                return true;
            }
        }

        return false;
    }

    public function getLatestPosts()
    {

        $request = [
            'search' => '',
            'page' => 1,
        ];

        $searchKeyword = '';

        $this->dateRangeStart = date('Y-m-d');
        $this->dateRangeEnd = date('Y-m-d');

        $this->searchResults = [];

        $resultFromOntario = [];
        $resultFromConstruct = [];
        $resultFromLink = [];

        $resultFromOntario = $this->scrapeOntarioConstructionNews($request, true);
        $resultFromConstruct = $this->scrapeConstructConnectFetchAll($request);

        // get one day before posts and log last post date to [Setting]

        //GET LAST CERTIFICATES SEND FROM SETTINGS FOR LINK2BUILD
        $lastSend = Setting::select('value')->where(['key' => 'link2build_last_send_date'])->first()->value;

        //GET ALL FROM LINK2BUILD
        $rawResultFromLink = $this->scrapeLink2Build($request, true);

        //GET LATEST CERTIFICATE AVAILABLE IN LINK2BUILD
        $lastDate = $rawResultFromLink[0]['date_of_publish'];

        //IF NEW CERTIFICATES AVAILABLE THEN PUSH IT IN THE LIST
        if (strtotime($lastDate) > strtotime($lastSend)) {

            Setting::where(['key' => 'link2build_last_send_date'])
                ->update(['value' => date('Y-m-d', strtotime($lastDate))]);

            foreach ($rawResultFromLink as $certificate) {
                if (strtotime($certificate['date_of_publish']) > strtotime($lastSend)) {
                    array_push($resultFromLink, $certificate);
                }
            }
        }

        $mixResult = $resultFromConstruct;
        $mixResult = array_merge($mixResult, $resultFromLink);

        shuffle($mixResult);

        // Get Search Ocn
        $search_data = Setting::select('value')->where(['key' => 'search_ocn'])->first();
        $search_ocn = json_decode($search_data->value);

        if (count($resultFromOntario)) {
            $this->searchResults = $resultFromOntario;
        }

        $certificates = array_merge($this->searchResults, $mixResult);

        return $certificates;
    }
}
