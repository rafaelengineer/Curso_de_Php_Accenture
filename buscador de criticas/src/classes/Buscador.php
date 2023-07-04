<?php

namespace TreinamentoPHP\BuscadorDeCriticas\Classes;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador {
    public function __construct(private ClientInterface $httpClient, private Crawler $crawler)
    {  }

    public function buscar(string $url): array {
        $resposta = $this->httpClient->request('GET', $url);

        $html = $resposta->getBody()->getContents();
        $this->crawler->addHtmlContent($html);

        $data = $this->crawler
        ->filter('div[class="review-card-review-holder"]')
        ->each(function ($contentContainer) {
            
            $rate = $contentContainer->filter('span[class="stareval-note"]')->text();
            $text = $contentContainer->filter('div[class="content-txt review-card-content"]')->text();
        
            return [
                "rate" => $rate,
                "text" => $text
            ];
        });

        return $data;
    }
}