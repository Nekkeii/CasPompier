<?php
class Pompier
{
    private $matricule;
    private $nomPompier;
    private $prenomPompier;
    private $dateNaissPompier;
    private $telPompier;
    private $sexePompier;
    private $idGrade;
    private $caserne; // Nouvelle propriété

    public function __construct($matricule, $nomPompier, $prenomPompier, $dateNaissPompier, $telPompier, $sexePompier, $idGrade, $caserne)
    {
        $this->matricule = $matricule;
        $this->nomPompier = $nomPompier;
        $this->prenomPompier = $prenomPompier;
        $this->dateNaissPompier = $dateNaissPompier;
        $this->telPompier = $telPompier;
        $this->sexePompier = $sexePompier;
        $this->idGrade = $idGrade;
        $this->caserne = $caserne; // Assignation de la nouvelle propriété
    }

    // Getters
    public function getMatricule()
    {
        return $this->matricule;
    }

    public function getNomPompier()
    {
        return $this->nomPompier;
    }

    public function getPrenomPompier()
    {
        return $this->prenomPompier;
    }

    public function getDateNaissPompier()
    {
        return $this->dateNaissPompier;
    }

    public function getTelPompier()
    {
        return $this->telPompier;
    }

    public function getSexePompier()
    {
        return $this->sexePompier;
    }

    public function getIdGrade()
    {
        return $this->idGrade;
    }

    public function getCaserne()
    {
        return $this->caserne; // Ajout du getter pour la nouvelle propriété
    }

    // Setters
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    public function setNomPompier($nomPompier)
    {
        $this->nomPompier = $nomPompier;
    }

    public function setPrenomPompier($prenomPompier)
    {
        $this->prenomPompier = $prenomPompier;
    }

    public function setDateNaissPompier($dateNaissPompier)
    {
        $this->dateNaissPompier = $dateNaissPompier;
    }

    public function setTelPompier($telPompier)
    {
        $this->telPompier = $telPompier;
    }

    public function setSexePompier($sexePompier)
    {
        $this->sexePompier = $sexePompier;
    }

    public function setIdGrade($idGrade)
    {
        $this->idGrade = $idGrade;
    }

    public function setCaserne($caserne)
    {
        $this->caserne = $caserne; // Ajout du setter pour la nouvelle propriété
    }
}
