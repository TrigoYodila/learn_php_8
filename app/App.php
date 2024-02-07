<?php

declare(strict_types = 1);

// obtenir les fichiers des transactions
function getTransactionFiles(string $dirPath):array{
    $files = [];

    //parcours les fichiers du chemin specifié
    foreach (scandir($dirPath) as $file) {
        
        //ne fait rien, continue si l'elt est un dossier
        if(is_dir($file)){
            continue;
        }

        //ajoute dans le tableau si c'est un fichier
        $files[] = $dirPath . $file;
    }

    return $files;
}

// lire chaque ligne de transactions et le pusher dans un tableau
function getTransactions(string $fileName):array{

    if( !file_exists($fileName)){
        trigger_error('File "' . $fileName . '" does not exist. ', E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');

    //supprimer la première ligne
    fgetcsv($file);

    $transactions = [];

    // lecture du fichier ligne par ligne
    while(($transaction = fgetcsv($file)) !== false){  //fgetcsv lit la ligne et renvoi un tableau elts separé par un separateur (, / \ etc...)
        $transactions[] = extractTransaction($transaction);
    }

    return $transactions;
}

// format amount number
function extractTransaction(array $transactionRow):array{
    [$date,$checkNumber,$description,$amount] = $transactionRow;

    $amount = (float) str_replace(['$', ','], '',$amount);

    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount
    ];
}