<?php

declare(strict_types = 1);

function getTransactionFiles():array{
    $files = [];

    //parcours les fichiers du chemin specifié
    foreach (scandir(FILES_PATH) as $file) {
        
        //ne fait rien, continue si l'elt est un dossier
        if(is_dir($file)){
            continue;
        }

        //ajoute dans le tableau si c'est un fichier
        $files[] = $file;
    }

    return $files;
}