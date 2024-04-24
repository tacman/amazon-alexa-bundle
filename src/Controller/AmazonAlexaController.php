<?php

namespace MaxBeckers\AmazonAlexaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use MaxBeckers\AmazonAlexaBundle\RequestTransformer\RequestTransformer;
/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class AmazonAlexaController extends AbstractController
{

    public function __construct(private RequestTransformer $requestTransformer)
    {

    }
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function amazonRequestAction(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->get('maxbeckers_amazon_alexa.request_transformer')->transformRequest(
                $request,
                $request->headers->get('SIGNATURECERTCHAINURL'),
                $request->headers->get('SIGNATURE')
            )
        );
    }
}
