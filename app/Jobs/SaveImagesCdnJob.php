<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Genba\GenbaGraphics;
use App\Models\Genba\GenbaProducts;
use Corbpie\BunnyCdn\BunnyAPI;
use GuzzleHttp\Client;

class SaveImagesCdnJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $productsActiveIds = GenbaProducts::where('status', 'active')->pluck('id');

        // $data = GenbaGraphics::with('product')
        //     ->whereIN('product_id', $productsActiveIds)
        //     //->where('id', '>', 559)
        //     ->where('cdnImageUrl','')
        //     ->get();

        //$bunny = new bunnyAPI();
        //$bunny->apiKey('9fef2929-fb1c-43cc-a23a-9a91158320b87f71b59a-b6b7-4fc0-b730-a4cfb7c7da9f');
        $access_key = '7c46eec6-69e8-4b7d-855879fe15f7-4a77-4e92';
        $storagename = 'epintr';
        //$bunny->zoneConnect($storagename, $access_key);
        //$bunny->jsonHeader();
        //echo $bunny->createFolder('images/thePlaceAmtryToCreate/');

        $data = GenbaGraphics::with('product')
            //->where('id', '>', 559)
            ->whereIN('product_id', $productsActiveIds)
            ->whereNull('cdnImageUrl')
            ->get();

        $client = new Client();

        if (count($data) > 0) {
            foreach ($data as $item) {
                //dd($item);
                //$item->cdnImageUrl='';
                //$item->save();
                //dd($item->cdnImageUrl);
                //$fileType = str_replace(' ', '-', strtolower($item->graphicType));
                //$dameName = str_replace(' ', '-', strtolower(preg_replace("/[^a-zA-Z0-9\s]/", "", $item->product->name)));

                //$bunny->jsonHeader();
                //$bunny->uploadFile($item->imageUrl, 'images/' . $dameName . '/' . $fileType . '/' . $item->fileName);


                //$cdnImagesUrl = 'images/' . $dameName . '/' . $fileType . '/' . $item->fileName;

                $response = $client->request(
                    'POST',
                    'https://cdn.epin.com.tr/webservice.php',
                    [
                        'form_params' => [
                            'action' => 'resize',
                            'apiKey' => 'aok2sc22SSf2f',
                            'imageUrl' => $item->imageUrl,
                        ],
                        'http_errors' => false,
                        // 'body' => json_encode(['Action'=>'Return']),
                    ],
                );
                //dd($response);
                if (!empty($response->getStatusCode()) && $response->getStatusCode() == 200) { // OK
                        //dump(json_decode($response->getBody()->getContents()));
                        //die();
                        $cdnImagesUrl = json_decode($response->getBody()->getContents())->url;
                        $temp = GenbaGraphics::where('id', $item->id)->first();
                        $temp->cdnImageUrl = $cdnImagesUrl;
                        $temp->save();
                    
                }
            }
        }

        // dd();
        // $bunny->jsonHeader();
        // echo $bunny->listAll('/images');
        // die();

        // $data = $bunny->listAllOG();
        // return json_decode($data);
    }
}
