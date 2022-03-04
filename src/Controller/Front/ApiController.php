<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Entity\Users;
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
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Models\JsonError;
use Exception;


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

    /**
    * @Route("/api/user/form", name="api", methods={"POST"})
    */
    public function createUser(EntityManagerInterface $entityManager, Request $request, SerializerInterface $serializerInterface,ValidatorInterface $validator): Response
    {
         $data = $request->getContent();
         try {
            $newUser = $serializerInterface->deserialize($data, Users::class, 'json');
         } catch (Exception $e) {
             return new JsonResponse("Un ou plusieurs champ(s) manquant!", Response::HTTP_UNPROCESSABLE_ENTITY);
         }
         
        $errors = $validator->validate($newUser);
        if (count($errors) > 0) {
            //dd($errors);
            $myJsonError = new JsonError(Response::HTTP_UNPROCESSABLE_ENTITY, "Des erreurs de validation ont été trouvées");
            $myJsonError->setValidationErrors($errors);
    
            return $this->json($myJsonError, $myJsonError->getError());
        }

         $entityManager->persist($newUser);
         $entityManager->flush();

         return $this->json(
             $newUser,
             Response::HTTP_CREATED,
             [], 
             ['groups' => ['show_user']]
         );

    }

    /**
     *@Route("/api/user/login", name="api", methods={"POST"})
     */
    public function loginUser(Request $request, SerializerInterface $serializerInterface, UserRepository $userRepository)
    {
        $data = $request->getContent();

        $userPost = $serializerInterface->deserialize($data, User::class, 'json');
        // dd($user);
       
        $user = $userRepository->findByEmail( $userPost->getEmail());
        // dd($userPost->getPassword());

        //$password = $userRepository->findByPassword( $userPost->getPassword());
        // dd($password);
        //if ($user !== NULL && $password !== NULL){ 
         if ((count($user) > 0) && (password_verify($userPost->getPassword(), $user[0]->getPassword()))){
            return $this->json(
                $user,
                200,
                [],
                ['groups' => ['show_user']]
            );
        }
        
        return new JsonResponse("email et/ou mot de passe incorrect", 401);

    }


}
