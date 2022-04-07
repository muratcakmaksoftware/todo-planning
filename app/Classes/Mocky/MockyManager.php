<?php

namespace App\Classes\Mocky;

use App\Enums\Languages\Mocky\MockyLanguageFile;
use App\Enums\Mocky\MockyDetail;
use App\Interfaces\Classes\Mocky\MockyInterface;
use App\Interfaces\Classes\Mocky\MockyManagerInterface;
use App\Interfaces\RepositoryInterfaces\Tasks\TaskRepositoryInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Symfony\Component\HttpFoundation\Response;

class MockyManager implements MockyManagerInterface
{
    /**
     * @var null
     */
    private MockyInterface $mocky;

    /**
     * @param MockyInterface $mocky
     */
    public function __construct(MockyInterface $mocky)
    {
        $this->mocky = $mocky;
    }

    /**
     * API ait veriler çekiliyor
     *
     * @return mixed
     * @throws GuzzleException
     * @throws Exception
     */
    public function getData(): mixed
    {
        $client = new Client([
            'base_uri' => MockyDetail::API_URL->value,
            'timeout' => 2.0,
        ]);

        $response = $client->get($this->mocky->getCode());
        if ($response->getStatusCode() === Response::HTTP_OK) {
            return json_decode($response->getBody());
        } else {
            throw new \Exception(translation(MockyLanguageFile::EXCEPTION, 'StatusCodeError'));
        }
    }

    /**
     * API sınıfına göre veri ayrıştırma yapılır
     *
     * @return array
     * @throws GuzzleException
     */
    private function parse(): array
    {
        return $this->mocky->parse($this->getData());
    }

    /**
     * Ayrıştırılmış verileri dönderir.
     *
     * @return array
     * @throws GuzzleException
     */
    public function getParseData(): array
    {
        return $this->parse();
    }

    /**
     * Ayrıştırılmış verileri veritabanına yükler.
     *
     * @return void
     * @throws GuzzleException
     * @throws BindingResolutionException
     */
    public function load(): void
    {
        app()->make(TaskRepositoryInterface::class)->insert($this->parse());
    }
}
