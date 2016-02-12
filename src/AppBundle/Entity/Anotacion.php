<?php
/**
 * Created by PhpStorm.
 * User: alumno
 * Date: 12/02/16
 * Time: 12:09
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
