<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Destinations;
use App\Entity\Landscapes;
use App\Entity\Nights;
use App\Entity\Providers;
use App\Entity\Seasons;
use App\Entity\Tags;
use App\Entity\Transports;
use App\Entity\Users;
use App\DataFixtures\Provider\OtravelProvider;
use DateTime;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $otravelProvider = new OtravelProvider;

        /**** Tags *****/
        $allTags = [];
        for ($i = 0; $i < 18; $i++)
        {
            $newTag = new Tags();
            $newTag->setName($otravelProvider->tags());
            $allTags[] = $newTag;
            $manager->persist($newTag);
        }

        /**** Seasons *****/
        $allSeasons = [];
        for ($i = 0; $i < 4; $i++)
        {
            $newSeason = new Seasons();
            $newSeason->setSeason($otravelProvider->seasons());
            $allSeasons[] = $newSeason;
            $manager->persist($newSeason);
        }

        /**** Landscapes *****/
         $allLandscapes = [];
         for ($i = 0; $i < 8; $i++)
         {
             $newLandscape = new Landscapes();
             $newLandscape->setName($otravelProvider->landscapes());
             $allLandscapes[] = $newLandscape;
             $manager->persist($newLandscape);
         }
        
        /**** Ways *****/
        $allWays = [];
        for ($i = 0; $i < 6; $i++)
        {
            $newWay = new Transports();
            $newWay->setWay($otravelProvider->ways());
            $allWays[] = $newWay;
            $manager->persist($newWay);
        }

        /**** Nigths *****/
        $allNights = [];
        for ($i = 1; $i < 22; $i++)
        {
            $newNight= new Nights();
            $newNight->setNightNb($i);
            $allNights[] = $newNight;
            $manager->persist($newNight);
        }

        /**** Destinations *****/
        $allDestinations = [];
        for ($i = 0; $i < 11; $i++)
        {
            $newDestination = new Destinations();

            $newDestination->setState($otravelProvider->destinationState());
            $newDestination->setSurname($otravelProvider->surnames());

            // très utile pour avoir des images différentes aléatoire pendant les tests
            $newDestination->setPicture('https://picsum.photos/id/'.mt_rand(1, 100).'/303/424');

            $newDestination->setSummary('lorem200');

            $newDestination->setExtract('lorem50');

            $newDestination->setPros('lorem20');

            $newDestination->setCreatedAt(new DateTime("now"));
            $newDestination->setUpdatedAt(new DateTime("now"));

            $newDestination->setPricePerNight(mt_rand(400, 4000));

        }

        $manager->flush();
    }
}
