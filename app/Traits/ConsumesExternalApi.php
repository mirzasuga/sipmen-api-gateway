<?php
namespace App\Traits;
use GuzzleHttp\Client;

trait ConsumesExternalApi
{
    /**
     * Send a request to any service
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);
        $base_path = $client->getConfig('base_uri')->getPath();
        $url = $base_path . $requestUrl;
        unset($base_path);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }
        $response = $client->request($method, $url, ['form_params' => $formParams, 'headers' => $headers]);
        return $response->getBody()->getContents();
    }
}
