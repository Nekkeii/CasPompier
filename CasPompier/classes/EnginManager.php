<?php

require_once 'Engin.class.php'; // Assurez-vous que le chemin est correct

class EnginManager
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function add(Engin $engin)
    {
        $stmt = $this->db->prepare("INSERT INTO engin (Numéro, Caserne_id, Type_Engin_id, Stock, Image) VALUES (:numero, :caserne_id, :type_engin_id, :stock, :image)");
        $stmt->bindValue(':numero', $engin->getNumero());
        $stmt->bindValue(':caserne_id', $engin->getCaserneId());
        $stmt->bindValue(':type_engin_id', $engin->getTypeEnginId());
        $stmt->bindValue(':stock', $engin->getStock());
        $stmt->bindValue(':image', $engin->getImage());

        return $stmt->execute();
    }

    public function updateEngin(Engin $engin)
    {
        $stmt = $this->db->prepare("UPDATE engin SET Caserne_id = :caserne_id, Type_Engin_id = :type_engin_id, Stock = :stock, Image = :image WHERE Numéro = :numero");
        $stmt->bindValue(':numero', $engin->getNumero());
        $stmt->bindValue(':caserne_id', $engin->getCaserneId());
        $stmt->bindValue(':type_engin_id', $engin->getTypeEnginId());
        $stmt->bindValue(':stock', $engin->getStock());
        $stmt->bindValue(':image', $engin->getImage());

        return $stmt->execute();
    }




    public function delete($numero)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM engin WHERE Numéro = :numero");
            $stmt->bindValue(':numero', $numero, PDO::PARAM_INT); // Assurez-vous que le type de paramètre est correct.
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Pour le débogage, vous pouvez enregistrer l'erreur avec error_log ou l'afficher.
            error_log($e->getMessage());
            return false;
        }
    }

    // Méthode pour récupérer un engin spécifique
    public function get($numero)
    {
        $stmt = $this->db->prepare("SELECT * FROM engin WHERE Numéro = :numero");
        $stmt->bindValue(':numero', $numero);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            // Créer et retourner un objet Engin avec les données récupérées
            return new Engin($row['Numéro'], $row['Caserne_id'], $row['Type_Engin_id'], $row['Stock'], $row['Image']);
        } else {
            // Retourner null si aucun engin n'a été trouvé
            return null;
        }
    }

    public function getListByCaserneId($caserneId)
    {
        try {
            // Prépare une requête SQL pour récupérer les engins de la caserne spécifiée
            $q = $this->db->prepare('SELECT * FROM engin WHERE Caserne_id = ?');
            $q->execute([$caserneId]);

            // Récupérer tous les engins et les stocker dans un tableau
            $engins = [];
            while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
                $engins[] = new Engin(
                    $data['Numéro'],
                    $data['Caserne_id'],
                    $data['Type_Engin_id'],
                    $data['Stock'],
                    $data['Image']
                );
            }
            return $engins;
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération des engins pour la caserne ID $caserneId: " . $e->getMessage());
            return []; // Retourne un tableau vide en cas d'erreur
        }
    }

    public function getEngin($numero)
    {
        $q = $this->db->prepare('SELECT * FROM engin WHERE Numéro = ?');
        $q->execute([$numero]);
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new Engin(
                $data['Numéro'],
                $data['Caserne_id'],
                $data['Type_Engin_id'],
                $data['Stock'],
                $data['Image']
            );
        }

        return null;
    }


    // Méthode pour récupérer tous les engins
    public function getList()
    {
        $engins = [];
        // Modifier la requête pour sélectionner toutes les informations nécessaires
        $stmt = $this->db->query("SELECT Numéro, Caserne_id, Type_Engin_id, Stock, Image FROM engin");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Passer toutes les informations à l'objet Engin
            $engins[] = new Engin(
                $row['Numéro'],
                $row['Caserne_id'],
                $row['Type_Engin_id'],
                $row['Stock'],
                $row['Image']
            );
        }
        return $engins;
    }

}