<?php

namespace App\Controller\Front;

use App\Repository\DestinationsRepository;
use App\Repository\LandscapesRepository;
use App\Repository\SeasonsRepository;
use App\Repository\TransportsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ApiController extends AbstractController
{
    /**
     * @Route("/api/transports", name="api_list_transports", methods={"GET"})
     */
    public function listTransports(TransportsRepository $transportsRepository): Response
    {
        // We send a a JsonResponse
        return $this->json(
            $transportsRepository->findAll(),
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['list_transport']]
        );
    }

    /**
     * @Route("/api/landscapes", name="api_list_landscapes", methods={"GET"})
     */
    public function listLandscapes(LandscapesRepository $landscapesRepository): Response
    {

        // We send a a JsonResponse
        return $this->json(
            $landscapesRepository->findAll(),
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['list_landscape']]
        );

    }

    /**
     * @Route("/api/destinations/list", name="api_list_destinations", methods={"GET"})
     */
    public function listDestination(DestinationsRepository $destinationsRepository): Response
    {

        // We send a a JsonResponse
        return $this->json(
            $destinationsRepository->findAll(),
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['list_destination']]
        );

    }

     /**
     * @Route("/api/destinations/{id}", name="api_destinations", methods={"GET"})
     */
    public function showDestination(DestinationsRepository $destinationsRepository, $id): Response
    {

        // We send a a JsonResponse
        return $this->json(
            $destinationsRepository->find($id),
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['show_destination']]
        );

    }

       /**
     * @Route("/api/seasons", name="api_seasons", methods={"GET"})
     */
    public function listSeasons(SeasonsRepository $seasonsRepository): Response
    {

        // We send a a JsonResponse
        return $this->json(
            $seasonsRepository->findAll(),
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['list_season']]
        );

    }
    /**
     * @Route("/api/destinations/form", name="api_destinations_form", methods={"POST"})
     *
     */
    public function formDestination(Request $request, DestinationsRepository $destinationsRepository, LandscapesRepository $landscapesRepository, SeasonsRepository $seasonsRepository, TransportsRepository $transportsRepository)
    {

    }

}
