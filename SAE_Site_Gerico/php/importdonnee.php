<?php

require 'pdo.php';

$csvFile = 'donnee.csv';

if (!file_exists($csvFile) || !is_readable($csvFile)) {
    die("Le fichier CSV n'existe pas ou n'est pas lisible.");
}

if (($handle = fopen($csvFile, 'r')) !== false) {
    fgetcsv($handle);

    $insertEmploye = $pdo->prepare("INSERT INTO Employe (nom, prenom, date_naissance, adresse, date_embauche, num_securite_sociale, salaire_base, fonction, email, num_telephone, identifiant, mot_de_passe, id_departement, admin, est_archive, dernier_depot_fiche, dernier_depot_conge)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $insertDepartement = $pdo->prepare("INSERT INTO Departement (nom_departement, id_responsable) VALUES (?, ?)");

    $insertFicheDePaie = $pdo->prepare("INSERT INTO Fiche_De_Paie (periode, salaire_brut, retenues, salaire_net, chemin_fichier, id_employe, date_depot)
                                        VALUES (?, ?, ?, ?, ?, ?, ?)");

    $insertConges = $pdo->prepare("INSERT INTO Conges (date_debut, date_fin, demi_journee, type_conge, id_employe, date_depot)
                                    VALUES (?, ?, ?, ?, ?, ?)");

    $insertDemandeDeConges = $pdo->prepare("INSERT INTO Demande_De_Conges (id_departement, date_demande, etat, id_conge, id_employe)
                                            VALUES (?, ?, ?, ?, ?)");

    while (($data = fgetcsv($handle)) !== false) {
        $type = strtolower($data[0]);

        if ($type == 'employe') {
            $insertEmploye->execute([
                $data[1], // nom
                $data[2], // prenom
                $data[3], // date_naissance
                $data[4], // adresse
                $data[5], // date_embauche
                $data[6], // num_securite_sociale
                $data[7], // salaire_base
                $data[8], // fonction
                $data[9], // email
                $data[10], // num_telephone
                $data[11], // identifiant
                $data[12], // mot_de_passe
                $data[13], // id_departement
                $data[14], // admin
                $data[15], // est_archive
                $data[16], // dernier_depot_fiche
                $data[17]  // dernier_depot_conge
            ]);
        } elseif ($type == 'departement') {
            $insertDepartement->execute([
                $data[1], // nom_departement
                NULL      // id_responsable (à définir)
            ]);
        } elseif ($type == 'fiche_de_paie') {
            // Insérer dans la table Fiche_De_Paie
            $insertFicheDePaie->execute([
                $data[4], // periode
                $data[5], // salaire_brut
                $data[6], // retenues
                $data[7], // salaire_net
                $data[8], // chemin_fichier
                $data[9], // id_employe
                $data[10] // date_depot
            ]);
        } elseif ($type == 'conges') {
            $insertConges->execute([
                $data[8], // date_debut
                $data[9], // date_fin
                $data[10], // demi_journee
                $data[11], // type_conge
                $data[12], // id_employe
                $data[13]  // date_depot
            ]);
        } elseif ($type == 'demande_de_conges') {
            $insertDemandeDeConges->execute([
                NULL,               // id_departement (à définir)
                $data[13],         // date_demande
                $data[14],         // etat
                NULL,              // id_conge (à définir)
                $data[15]          // id_employe
            ]);
        }
    }

    fclose($handle);
    echo "Données importées avec succès.";
} else {
    echo "Erreur lors de l'ouverture du fichier CSV.";
}
?>
