<?php

namespace App\Controller;


use App\Services\MensaCrawlerService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    /**
     * @Route(path="/")
     * @param Request $request
     * @param MensaCrawlerService $mensaCrawlerService
     * @return JsonResponse
     */
    public function api(Request $request, MensaCrawlerService $mensaCrawlerService): JsonResponse
    {
        $university = $request->get('university', null);

        if (!$university) {
            return new JsonResponse(['error' => 'you should specify a university tag'], 400);
        }

        $meals = $mensaCrawlerService->crawlForUniversity($university);

        if (!$meals) {
            return new JsonResponse([], 404);
        }

        return new JsonResponse(json_decode($meals), 200);
    }

}