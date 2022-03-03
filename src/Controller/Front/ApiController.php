<?php

namespace App\Controller\Front;

use App\Entity\Destinations;
use App\Entity\Landscapes;
use App\Entity\Seasons;
use App\Entity\Transports;
use App\Repository\DestinationsRepository;
use App\Repository\LandscapesRepository;
use App\Repository\SeasonsRepository;
use App\Repository\TransportsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;


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
    * @Route("/api/destinations/form", name="api", methods={"POST"})
    */
    public function listDestinationsForm(Request $request, DestinationsRepository $destinationsRepository): Response
    {
       $jsonRecu = $request->getContent();
       // dd($jsonRecu);

       $data = json_decode($jsonRecu, true);
       // dd($data);

        // Tableau des id types de paysages envoyés par le form
        $landscapesArray=[];
        if (array_key_exists('selectedLandscapes', $data)) {
            $arraySelectedLandscapes = $data['selectedLandscapes'];
            
            foreach($arraySelectedLandscapes as $value) {
            $landscapesArray[] = $value['id'];
            }
        } /* else{
            return new JsonResponse("Si tu veux vraiment partir, sélectionne au moins un paysage!", Response::HTTP_UNPROCESSABLE_ENTITY);
        } */  
        //dd($landscapesArray);

       // Tableau des id transports envoyés par le form
       $transportsArray=[];
       if (array_key_exists('selectedTransports', $data)) {
            $arraySelectedTransports = $data['selectedTransports'];
            
            foreach($arraySelectedTransports as $value) {
                $transportsArray[] = $value['id'];
            }
       } /* else{
        return new JsonResponse("Si tu veux vraiment partir, sélectionne au moins un transport!", Response::HTTP_UNPROCESSABLE_ENTITY);
       } */
       //dd($transportsArray);
       
       // Tableau des id types de saisons envoyés par le form
       $seasonsArray=[];
       if (array_key_exists('selectedSeasons', $data)) {
           $arraySelectedSeasons = $data['selectedSeasons'];
        
           foreach ($arraySelectedSeasons as $value) {
               $seasonsArray[] = $value['id'];
           }
       } /* else{
           return new JsonResponse("Si tu veux vraiment partir, sélectionne au moins une saison!", Response::HTTP_UNPROCESSABLE_ENTITY);
       } */
       //dd($landscapesArray);

        // Traitement de budget
        $budget = $data['budget'];
        // dd($budget);

        return $this->json(
            $destinationsRepository->findAllFiltered($transportsArray, $landscapesArray, $seasonsArray, $budget),
            200,
            [],
            ['groups' => 'list_destinations']
        );
    }

        /**
    * @Route("/api/user/{id}", name="api_user", methods={"GET"})
    */
    public function showUser(UserRepository $userRepository, $id): Response
    {

        // We send a a JsonResponse
        return $this->json(
            $userRepository->find($id),
            // HTTP Status code
            200,
            // HTTP headers, here none
            [],
            // Group of properties to serialize
            ['groups'=> ['show_user']]
        );

    }
}
