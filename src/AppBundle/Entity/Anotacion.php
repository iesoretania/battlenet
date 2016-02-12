<?php
/*
  Battlenet

  Copyright (C) 2016: Luis Ramón López López

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU Affero General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU Affero General Public License for more details.

  You should have received a copy of the GNU Affero General Public License
  along with this program.  If not, see [http://www.gnu.org/licenses/].
*/

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Validator;

/**
 * Class Evento
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class Anotacion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $fechaHora;

    /**
     * @ORM\ManyToOne(targetEntity="Equipo", inversedBy="anotaciones")
     * @ORM\JoinColumn(nullable=false)
     * @var Equipo
     */
    private $equipo;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $concepto;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $puntuacion;

    /**
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumn(nullable=false)
     */
    private $estado;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set concepto
     *
     * @param string $concepto
     * @return Anotacion
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;

        return $this;
    }

    /**
     * Get concepto
     *
     * @return string 
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set puntuacion
     *
     * @param integer $puntuacion
     * @return Anotacion
     */
    public function setPuntuacion($puntuacion)
    {
        $this->puntuacion = $puntuacion;

        return $this;
    }

    /**
     * Get puntuacion
     *
     * @return integer 
     */
    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

    /**
     * Set fechaHora
     *
     * @param \DateTime $fechaHora
     * @return Anotacion
     */
    public function setFechaHora($fechaHora)
    {
        $this->fechaHora = $fechaHora;

        return $this;
    }

    /**
     * Get fechaHora
     *
     * @return \DateTime 
     */
    public function getFechaHora()
    {
        return $this->fechaHora;
    }

    /**
     * Set equipo
     *
     * @param Equipo $equipo
     * @return Anotacion
     */
    public function setEquipo(Equipo $equipo)
    {
        $this->equipo = $equipo;

        return $this;
    }

    /**
     * Get equipo
     *
     * @return Equipo
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * Set estado
     *
     * @param Estado $estado
     * @return Anotacion
     */
    public function setEstado(Estado $estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
