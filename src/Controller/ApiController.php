<?php

namespace App\Controller;


use App\Services\MensaCrawlerService;
use App\Utils\StringUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    /**
     * @Route(path="/")
     * @param Request $request
     * @param MensaCrawlerService $mensaCrawlerService
     * @return Response
     */
    public function api(Request $request, MensaCrawlerService $mensaCrawlerService): Response
    {
        $university = $request->get('university', null);
        $timestamp = $request->get('timestamp', null);

        if (!$university) {
            return new JsonResponse(['error' => 'you should specify a university tag'], 400);
        }

        $meals = $mensaCrawlerService->crawlForUniversity($university, $timestamp);

        if (!$meals) {
            return new JsonResponse([], 404);
        }

        $response = new Response(StringUtils::encodeUtf8($meals), 200, ['Content-Type' => "application/json"]);
        $response->setCharset('UTF-8');

        return $response;
    }

}