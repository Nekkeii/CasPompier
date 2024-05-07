<?php


// Au début de PompierManager.php
include_once 'Pompier.class.php'; // Assurez-vous que le chemin est correct

class PompierManager
{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }
    public function ajouterpompier(Pompier $pompier)
    {
        try {
            // Préparation de la requête SQL pour l'insertion des données du pompier dans la table "pompiers"
            $q = $this->_db->prepare('INSERT INTO pompier(Matricule, Nom, Prenom, DateNaiss, Tel, Sexe, grade_id, caserne) VALUES(:matricule, :nom, :prenom, :ddn, :tel, :sexe, :idGrade, :caserne)');

            // Liaison des valeurs des variables aux paramètres de la requête SQL
            $q->bindValue(':matricule', $pompier->getMatricule());
            $q->bindValue(':nom', $pompier->getNomPompier());
            $q->bindValue(':prenom', $pompier->getPrenomPompier());
            $q->bindValue(':ddn', $pompier->getDateNaissPompier());
            $q->bindValue(':tel', $pompier->getTelPompier());
            $q->bindValue(':sexe', $pompier->getSexePompier());
            $q->bindValue(':idGrade', $pompier->getIdGrade());
            $q->bindValue(':caserne', $pompier->getCaserne());

            // Exécution de la requête préparée
            if ($q->execute()) {
                // Redirection vers la page "inscriptionOK.php"
                header("Location: ../inscriptionOK.php");
                exit; // Assure que le script s'arrête après la redirection
            } else {
                echo "Une erreur s'est produite lors de l'ajout du pompier."; // Affichage du message d'erreur
            }
        } catch (PDOException $e) {
            // Gestion des exceptions PDO
            echo "Erreur lors de l'ajout du pompier : " . $e->getMessage(); // Affichage du message d'erreur PDO
        }
    }

    // Dans votre méthode updatePompier()
    public function updatePompier($matricule, $nom, $prenom, $date_naissance, $telephone, $sexe, $idgrade, $caserne)
    {
        try {
            $q = $this->_db->prepare('UPDATE pompier SET Nom = ?, Prenom = ?, DateNaiss = ?, Tel = ?, Sexe = ?, grade_id = ?, caserne = ? WHERE Matricule = ?');
            $success = $q->execute([$nom, $prenom, $date_naissance, $telephone, $sexe, $idgrade, $caserne, $matricule]);

            if (!$success) {
                // Pour déboguer, imprimez les informations d'erreur
                var_dump($q->errorInfo());
                exit; // Supprimez ou commentez cette ligne une fois le débogage terminé
            }

            return $success;
        } catch (Exception $e) {
            error_log('Erreur de mise à jour : ' . $e->getMessage());
            echo 'Erreur de mise à jour : ' . $e->getMessage();
            return false;
        }
    }

    public function deletePompier($matricule)
    {
        try {
            $q = $this->_db->prepare('DELETE FROM pompier WHERE Matricule = ?');
            $q->execute([$matricule]);
            if ($q->rowCount() > 0) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Aucun enregistrement trouvé avec ce matricule.'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur de suppression : ' . $e->getMessage()];
        }
    }

    public function restaurerPompier($matricule)
    {
        try {
            // Récupération des données du pompier supprimé
            $q = $this->_db->prepare('SELECT * FROM pompierSupprime WHERE Matricule = ?');
            $q->execute([$matricule]);
            $pompierSupprime = $q->fetch(PDO::FETCH_ASSOC);

            if ($pompierSupprime) {
                // Insertion du pompier restauré dans la table "pompier"
                $insertQuery = $this->_db->prepare('INSERT INTO pompier(Matricule, Nom, Prenom, DateNaiss, Tel, Sexe, grade_id, caserne) VALUES(:matricule, :nom, :prenom, :ddn, :tel, :sexe, :idGrade, :caserne)');
                $success = $insertQuery->execute([
                    'matricule' => $pompierSupprime['Matricule'],
                    'nom' => $pompierSupprime['Nom'],
                    'prenom' => $pompierSupprime['Prenom'],
                    'ddn' => $pompierSupprime['DateNaiss'],
                    'tel' => $pompierSupprime['Tel'],
                    'sexe' => $pompierSupprime['Sexe'],
                    'idGrade' => $pompierSupprime['grade_id'],
                    'caserne' => $pompierSupprime['caserne']
                ]);

                if ($success) {
                    // Suppression du pompier restauré de la table "pompierSupprime"
                    $deleteQuery = $this->_db->prepare('DELETE FROM pompierSupprime WHERE Matricule = ?');
                    $deleteQuery->execute([$matricule]);

                    return ['success' => true];
                } else {
                    return ['success' => false, 'message' => 'Erreur lors de l\'insertion du pompier restauré.'];
                }
            } else {
                return ['success' => false, 'message' => 'Aucun pompier supprimé trouvé avec ce matricule.'];
            }
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erreur lors de la restauration du pompier : ' . $e->getMessage()];
        }
    }

    public function getPompier($matricule)
    {
        $q = $this->_db->prepare('SELECT * FROM pompier WHERE Matricule = ?');
        $q->execute([$matricule]);
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Pompier($data['Matricule'], $data['Nom'], $data['Prenom'], $data['DateNaiss'], $data['Tel'], $data['Sexe'], $data['grade_id'], $data['caserne']);
        }

        return null;
    }

}
