<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class AppExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // Inject dependencies if needed
    }

    public function customCapitalize($value, bool $upperOnPair = true)
    {
        /* Méthode #1 : on parcour# tout le tableau, et on check pour chaque index si paire ou impaire
        for($i = 0; $i < strlen($value); $i++) {

            if($i % 2) {
                $value[$i] = strtolower($value[$i]);
            }
            else {
                $value[$i] = strtoupper($value[$i]);
            }
        }

        return $value;
        */

        // Méthode #2
        // Tout en minuscules
        $value = strtolower($value);

        for($i = ($upperOnPair ? 0 : 1); $i < strlen($value); $i = $i + 2) {

                $value[$i] = strtoupper($value[$i]);
                
            }

        return $value;

        // Boucle pour tous les nombres pairs
    }


    public function fillNumber($value, string $character, int $length): string 
    {
        $strFormat = '%' . $character . $length . 'd';

        return sprintf($strFormat, $value); // 3 digits
    }
}
