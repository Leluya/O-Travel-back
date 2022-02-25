<?php

namespace App\DataFixtures\Provider;

class OtravelProvider
{
    // Table with our state
    private $states = [
        'Etats-Unis',
        'Canada',
        'Suisse',
        'Italie',
        'Croatie',
        'Norvège',
        'Suède',
        'Australie',
        'Hawaï',
        'Antartique',
        'Amérique du Sud',
    ];

    // Table with our Surname
    private $surnames[
        'New York',
        'Vancouver',
        'Glacier Express',
        'Rome',
        'Croisiére',
        'fjords',
        'Circuit Norvège, Suède',
        'Melbourne',
        'Circuit des volcans',
        'Croisiére',
        'Bolivie, Paraguay, Uruguay, Argentine',
    ];

    // Table withe the way
    private $ways = [
        'à pied/transports en commun',
        'voiture',
        'camping car',
        'bateau',
        'train',
        'fusée spatiale'
    ];

    // Table withe the lanscape
    private $landscapes = [
        'littoral',
        'montagneux',
        'plaine',
        'urbain',
        'désertique',
        'tropical',
        'enneigé',
        'volcanique'
    ];

    // Table with the season
    private $seasons = [
        'printemps',
        'été',
        'automne',
        'hiver'
    ];

    // Table with the tags
    private $tags = [
        'à pied/transports en commun',
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

    /**
     * To have a random State
     */
    public function destinationState()
    {
        return $this->states[array_rand($this->states)];
    }

    /**
     * To have a random Season
     */
    public function seasons()
    {
        return $this->seasons[array_rand($this->seasons)];
    }

    /**
     * To have a random Tag
     */
    public function tags()
    {
        return $this->tags[array_rand($this->tags)];
    }

     /**
     * To have a random way
     */
    public function ways()
    {
        return $this->ways[array_rand($this->ways)];
    }

     /**
     * To have a random way
     */
    public function landscapes()
    {
        return $this->landscapes[array_rand($this->landscapes)];
    }
    
    /**
    * To have a random way
    */
    public function surnames()
    {
        return $this->surnames[array_rand($this->surnames)];
    }
}