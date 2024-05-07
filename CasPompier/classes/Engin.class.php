<?php
class Engin
{
    private $numero;
    private $caserne_id;
    private $type_engin_id;
    private $stock;
    private $image;

    public function __construct($numero, $caserne_id, $type_engin_id, $stock, $image)
    {
        $this->numero = $numero;
        $this->caserne_id = $caserne_id;
        $this->type_engin_id = $type_engin_id;
        $this->stock = $stock;
        $this->image = $image;
    }

    // Getters
    public function getNumero()
    {
        return $this->numero;
    }

    public function getCaserneId()
    {
        return $this->caserne_id;
    }

    public function getTypeEnginId()
    {
        return $this->type_engin_id;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getImage()
    {
        return $this->image;
    }

    // Setters
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setCaserneId($caserne_id)
    {
        $this->caserne_id = $caserne_id;
    }

    public function setTypeEnginId($type_engin_id)
    {
        $this->type_engin_id = $type_engin_id;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

   
    
    
}