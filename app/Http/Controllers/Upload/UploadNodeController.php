<?php

namespace App\Http\Controllers\Upload;

use App\Jobs\UploadFile;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use function GuzzleHttp\json_decode;
use Exception;

class UploadNodeController extends Controller
{

    public function getClientUpload()
    {
        return new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . Session::get(SESSION_JAVA_TOKEN),
                'Content-Type' => 'application/json',
                'ProjectId' => ENUM_PROJECT_ID_NEST_UPLOAD,
                'Method' => '1'
            ],
        ]);
    }

    public function uploadMedia(Request $request)
    {
        $file = $request->file('file');
        $type = (int)$request->get('type');
        $fileConvert = $this->convertFileUploadTemplate($file);
        $project = ENUM_PROJECT_ID_NEST_UPLOAD;
        $method = ENUM_METHOD_POST;
        $api = API_UPLOAD_GET_FILE_GENERATE;
        $body = [
            'medias' => [
                ['name' => $fileConvert[0], 'type' => $type, 'size' => $fileConvert[2], 'is_keep' => 1],
            ]
        ];
        $config = $this->callApiGatewayTemplate2($project, $method, $api, $body);
        /**
         * API chưa chuyển qua gateway, follow
         */
        try {
            $client = $this->getClientUpload();
            $response = $client->request('POST', $this->getBaseADS(sprintf(API_UPLOAD_V2_POST_FILE)), [
                'http_errors' => false,
                'multipart' => [
                    [
                        'name' => 'medias[0][file]',
                        'contents' => fopen($fileConvert[1], "r+"),
                    ],
                    [
                        'name' => 'medias[0][type]',
                        'contents' => $type,
                    ],
                    [
                        'name' => 'medias[0][media_id]',
                        'contents' => $config['data'][0]['media_id'],
                    ]
                ]
            ]);
            unlink($fileConvert[1]);
            return [
                $config['data'][0]['original']['url'],
                $config['data'][0]['thumb']['url'],
                Session::get(SESSION_NODE_KEY_BASE_URL_ADS_MEDIA),
                $fileConvert[0],
                $config
            ];
        } catch (Exception $e) {
            return $this->catchTemplate($config, $e);
        }
    }
}
