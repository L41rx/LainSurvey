<?php

namespace L41rx\Layer;

use L41rx\Layer\FrontendComponents\Thumbnail;

class Factory
{
    public static function getRandomOption($options) {
        return $options[rand(0, count($options) -1)];
    }

    // Probably broken this one.
    public static function getRandomOptions($options, $min, $max) {
        $selections = [];

        $i = 0;
        while ($i < (rand($min, $max))) {
            $s = $options[floor(rand() * count($options))];

            if (!in_array($s, $selections)) {
                array_push($selections, $s);
                $i++;
            }
        }

        return $selections;
    }

    // todo move createSurveyFromJsonQuestions or similar
}