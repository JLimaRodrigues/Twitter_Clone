<?php

namespace App\Entity;

use App\Repository\AbstractEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
class AbstractEntity
{
    
    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        return $this->$atributo = $valor;
    }

    public function __call($name, $arguments)
    {
        $prefix = substr($name, 0, 3);
        $property = lcfirst(substr($name, 3));

        if ($prefix === 'get') {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        } elseif ($prefix === 'set') {
            if (property_exists($this, $property)) {
                $this->$property = $arguments[0];
                return $this;
            }
        }

        throw new \Exception("Método '$name' não encontrado.");
    }
}
