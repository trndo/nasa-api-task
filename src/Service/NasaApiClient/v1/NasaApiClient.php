<?php


namespace App\Service\NasaApiClient\v1;


use App\Service\NasaApiClient\NasaApiInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NasaApiClient implements NasaApiInterface
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $apiHost;

    public function __construct(
        HttpClientInterface $httpClient,
        ParameterBagInterface $parameterBag
    ) {
        $this->httpClient = $httpClient;
        $this->apiKey = $parameterBag->get('nasa_api_key');
        $this->apiHost = $parameterBag->get('nasa_api_host');
    }

    public function getNeoFeed(string $startDate, string $endDate): array
    {
        $response = $this->httpClient->request(
            'GET',
            sprintf('%s/neo/rest/v1/feed', $this->apiHost),
            [
                'query' => [
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'api_key' => $this->apiKey
                ]
            ]
        );

        return $response->toArray();
    }
}