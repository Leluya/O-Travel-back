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
use DateTime;
use Doctrine\DBAL\Connection;

class AppFixtures extends Fixture
{

    private $connexion;

    public function __construct(Connection $connexion)
    {
        $this->connexion = $connexion;
    }

    // we create un truncate function to auto increment at 1
    public function truncate()
    {
        $this->connexion->executeQuery('SET foreign_key_checks = 0');

        $this->connexion->executeQuery('TRUNCATE TABLE destinations');
        $this->connexion->executeQuery('TRUNCATE TABLE tags');
        $this->connexion->executeQuery('TRUNCATE TABLE transports');
        $this->connexion->executeQuery('TRUNCATE TABLE landscapes');
        $this->connexion->executeQuery('TRUNCATE TABLE seasons');
    }

    public function load(ObjectManager $manager): void
    {
        // we call the truncate function
        $this->truncate();

        /**** Tags *****/
        $allTagEnity = [];
        $allTags = [
            'transports en commun',
            'voiture',
            'camping car',
            'bateau',
            'train',
            'fusée spatiale',
            'printemps',
            'été',
            'automne',
            'hiver',
            'littoral',
            'montagneux',
            'plaine',
            'urbain',
            'désertique',
            'tropical',
            'enneigé',
            'volcanique'
        ];
        foreach ($allTags as $tagName)
        {
            $tag = new Tags();
            $tag->setName($tagName);
            $allTagEnity[] = $tag;
            $manager->persist($tag);
        }

        /**** Seasons *****/
        $allSeasonEntity = [];
        $allSeasons = [
            'printemps',
            'été',
            'automne',
            'hiver'
        ];
        foreach ($allSeasons as $seasonName)
        {
            $season = new Seasons();
            $season->setSeason($seasonName);
            $allSeasonEntity[] = $season;
            $manager->persist($season);
        }


        /**** Landscapes *****/
        $allLandscapesEntity =[];
        $allLandscapes = [
            'littoral',
            'montagneux',
            'plaine',
            'urbain',
            'désertique',
            'tropical',
            'enneigé',
            'volcanique'
        ];
         foreach ($allLandscapes as $landsapeName)
         {
             $newLandscape = new Landscapes();
             $newLandscape->setName($landsapeName);
             $allLandscapesEntity[] = $newLandscape;
             $manager->persist($newLandscape);
         }
        
        /**** Ways *****/
        $allWayEntity = [];
        $allWays = [
            'transports en commun',
            'voiture',
            'camping car',
            'bateau',
            'train',
            'fusée spatiale'
        ];
        foreach ($allWays as $wayName)
        {
            $way = new Transports();
            $way->setWay($wayName);
            $allWayEntity[] = $way;
            $manager->persist($way);
        }

        /**** Nigths *****/
        $allNights = [];
        for ($q = 1; $q < 22; $q++)
        {
            $newNight= new Nights();
            $newNight->setNightNb($q);
            $allNights[] = $newNight;
            $manager->persist($newNight);
        }

        /**** Destinations *****/
        $allDestinations = [];
        $states = [
            'Etats-Unis',
            'Ouest Canadien',
            'Canada',
            'Italie',
            'Japon',
            'Norvège',
            'Pays nordique',
            'Australie',
            'Hawaï',
            'Antartique',
            'Amérique du Sud',
        ];
         
        $surnames =[
            'New York',
            'Vancouver',
            'Région de Québec',
            'Rome',
            'Tokyo',
            'fjords',
            'Circuit Norvège, Suède',
            'Côte Est',
            'Circuit des volcans + surf',
            'Croisiére polaire',
            'Bolivie, Paraguay, Uruguay, Argentine',
        ];

        $pictures =[
            'https://cdn.pixabay.com/photo/2019/07/21/07/12/new-york-4352072_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/10/28/23/22/vancouver-4585887_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/04/24/17/25/frontenac-2257154_960_720.jpg',
            'https://cdn.pixabay.com/photo/2019/10/06/08/57/architecture-4529605_960_720.jpg',
            'https://cdn.pixabay.com/photo/2020/07/14/16/02/manga-5404746_960_720.jpg',
            'https://cdn.pixabay.com/photo/2020/02/07/16/20/lofoten-4827611_960_720.jpg',
            'https://cdn.pixabay.com/photo/2022/01/02/19/43/port-6910972_960_720.jpg',
            'https://cdn.pixabay.com/photo/2014/05/26/09/58/sydney-opera-house-354375_960_720.jpg',
            'https://cdn.pixabay.com/photo/2017/02/05/00/05/hawaii-2038861_960_720.jpg',
            'https://cdn.pixabay.com/photo/2016/03/31/21/17/landscape-1296307_960_720.jpg',
            'https://cdn.pixabay.com/photo/2020/05/15/14/21/andes-5173790_960_720.jpg',
        ];


        for ($r = 0; $r < 11; $r++)
        {
            $newDestination = new Destinations();
         
            $newDestination->setState($states[$r]);
           
           
            $newDestination->setSurname($surnames[$r]);

            // load random picure from internet
            $newDestination->setPicture($pictures[$r]);

            $newDestination->setSummary('Aenean blandit, tortor ac pellentesque luctus, arcu enim aliquam augue, ac malesuada est magna a elit. Integer venenatis lacus id elit lacinia tincidunt. Cras purus leo, faucibus dictum dictum id, convallis id neque. Pellentesque consequat lorem a lacus egestas tempor. Nunc rutrum, ipsum interdum ullamcorper porta, metus velit faucibus lorem, in ullamcorper ligula odio a ipsum. In scelerisque enim eget sem vehicula, eu aliquet neque accumsan. Curabitur sit amet eros ut dui congue tristique et nec erat. Pellentesque est lorem, eleifend ac feugiat sit amet, scelerisque ut odio. Cras vel lectus ante. Sed est elit, fermentum sit amet neque a, tincidunt gravida urna. Proin hendrerit ex at lorem cursus tincidunt. Nunc ultricies rhoncus iaculis.');

            $newDestination->setExtract('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur rhoncus maximus ipsum non volutpat. Quisque a velit quis metus consequat pulvinar.');

            $newDestination->setPros('Lorem Ipsum is simply dummy text of the printing and typesetting industry');

            $newDestination->setCreatedAt(new DateTime("now"));
            $newDestination->setUpdatedAt(new DateTime("now"));

            $newDestination->setPricePerNight(mt_rand(200, 3000));

            /** Add transports for each destination */
            for ($g = 1; $g <= mt_rand(1, 3); $g++) {
                // Duplicates data are manage by method addGenre()
                $randomWay = $allWayEntity[mt_rand(0, count($allWayEntity) - 1)];
                $newDestination->addTransport($randomWay);
            }
            /** Add seasons for each destination */
            for ($j = 1; $j <= mt_rand(1, 3); $j++) {
                
                $randomSeason = $allSeasonEntity[mt_rand(0, count($allSeasonEntity) - 1)];
                $newDestination->addSeason($randomSeason);
            }
            /** Add landscapes for each destination */
            for ($k = 1; $k <= mt_rand(1, 3); $k++) {
                
                $randomLandscape = $allLandscapesEntity[mt_rand(0, count($allLandscapesEntity) - 1)];
                $newDestination->addLandscape($randomLandscape);
            }

            /** Add tags for each destination */
            for ($l = 1; $l <= mt_rand(1, 3); $l++) {
                
                $randomTag = $allTagEnity[mt_rand(0, count($allTagEnity) - 1)];
                $newDestination->addTag($randomTag);
            }

            $manager->persist($newDestination);
        }

        $manager->flush();
    }
}
