<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\json_decode;


class UploadFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $config, $file;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($config,$file)
    {
        $this->config = $config;
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client =  new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT),
                'Content-Type' => 'application/json',
            ],
        ]);
        $client->request('POST', Session::get(SESSION_NODE_KEY_BASE_URL_ADS) . (sprintf(API_UPLOAD_V2_POST_FILE)), [
            'http_errors' => false,
            'multipart' => [
                [
                    'name' => 'medias[0][file]',
                    'contents' => fopen($this->file[1], "r"),
                ],
                [
                    'name' => 'medias[0][type]',
                    'contents' => 0,
                ],
                [
                    'name' => 'medias[0][media_id]',
                    'contents' => $this->config['data'][0]['media_id'],
                ]
            ]
        ]);
        unlink($this->file[1]);
    }
}
