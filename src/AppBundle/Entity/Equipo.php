<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Validator;

/**
 * Class Equipo
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 * @UniqueEntity("nombre", message="Este nombre de equipo ya existe, elige otro")
 */
class Equipo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(type="blob")
     * @Validator\File(mimeTypes={ "image/png", "image/jpg", "image/jpeg" })
     */
    private $emblema;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $participante1;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $participante2;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $participante3;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $rutaCargaExplosiva;

    /**
     * @ORM\Column(type="string")
     * @Validator\Ip()
     * @var string
     */
    private $ipMaquinaFisica1;

    /**
     * @ORM\Column(type="string")
     * @Validator\Ip()
     * @var string
     */
    private $ipMaquinaFisica2;

    /**
     * @ORM\Column(type="string")
     * @Validator\Ip()
     * @var string
     */
    private $ipMaquinaVirtualWS;

    /**
     * @ORM\Column(type="string")
     * @Validator\Ip()
     * @var string
     */
    private $ipMaquinaVirtualFtp;

    /**
     * @ORM\Column(type="string")
     * @Validator\Ip()
     * @var string
     */
    private $ipMaquinaVirtualWeb;

    /**
     * @ORM\Column(type="string")
     * @Validator\Ip()
     * @var string
     */
    private $ipMaquinaVirtualNucleo;

    /**
     * @ORM\OneToMany(targetEntity="Anotacion", mappedBy="equipo")
     * @var Collection|Anotacion[]
     */
    private $anotaciones;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->anotaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set nombre
     *
     * @param string $nombre
     * @return Equipo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set emblema
     *
     * @param string $emblema
     * @return Equipo
     */
    public function setEmblema($emblema)
    {
        $this->emblema = $emblema;

        return $this;
    }

    /**
     * Get emblema
     *
     * @return string 
     */
    public function getEmblema()
    {
        return $this->emblema;
    }

    /**
     * Set integrante1
     *
     * @param string $participante1
     * @return Equipo
     */
    public function setParticipante1($participante1)
    {
        $this->participante1 = $participante1;

        return $this;
    }

    /**
     * Get integrante1
     *
     * @return string 
     */
    public function getParticipante1()
    {
        return $this->participante1;
    }

    /**
     * Set integrante2
     *
     * @param string $participante2
     * @return Equipo
     */
    public function setParticipante2($participante2)
    {
        $this->participante2 = $participante2;

        return $this;
    }

    /**
     * Get integrante2
     *
     * @return string 
     */
    public function getParticipante2()
    {
        return $this->participante2;
    }

    /**
     * Set integrante3
     *
     * @param string $participante3
     * @return Equipo
     */
    public function setParticipante3($participante3)
    {
        $this->participante3 = $participante3;

        return $this;
    }

    /**
     * Get integrante3
     *
     * @return string 
     */
    public function getParticipante3()
    {
        return $this->participante3;
    }

    /**
     * Set rutaCargaExplosiva
     *
     * @param string $rutaCargaExplosiva
     * @return Equipo
     */
    public function setRutaCargaExplosiva($rutaCargaExplosiva)
    {
        $this->rutaCargaExplosiva = $rutaCargaExplosiva;

        return $this;
    }

    /**
     * Get rutaCargaExplosiva
     *
     * @return string 
     */
    public function getRutaCargaExplosiva()
    {
        return $this->rutaCargaExplosiva;
    }

    /**
     * Set ipMaquinaFisica1
     *
     * @param string $ipMaquinaFisica1
     * @return Equipo
     */
    public function setIpMaquinaFisica1($ipMaquinaFisica1)
    {
        $this->ipMaquinaFisica1 = $ipMaquinaFisica1;

        return $this;
    }

    /**
     * Get ipMaquinaFisica1
     *
     * @return string 
     */
    public function getIpMaquinaFisica1()
    {
        return $this->ipMaquinaFisica1;
    }

    /**
     * Set ipMaquinaFisica2
     *
     * @param string $ipMaquinaFisica2
     * @return Equipo
     */
    public function setIpMaquinaFisica2($ipMaquinaFisica2)
    {
        $this->ipMaquinaFisica2 = $ipMaquinaFisica2;

        return $this;
    }

    /**
     * Get ipMaquinaFisica2
     *
     * @return string 
     */
    public function getIpMaquinaFisica2()
    {
        return $this->ipMaquinaFisica2;
    }

    /**
     * Set ipMaquinaVirtualWS
     *
     * @param string $ipMaquinaVirtualWS
     * @return Equipo
     */
    public function setIpMaquinaVirtualWS($ipMaquinaVirtualWS)
    {
        $this->ipMaquinaVirtualWS = $ipMaquinaVirtualWS;

        return $this;
    }

    /**
     * Get ipMaquinaVirtualWS
     *
     * @return string 
     */
    public function getIpMaquinaVirtualWS()
    {
        return $this->ipMaquinaVirtualWS;
    }

    /**
     * Set ipMaquinaVirtualFtp
     *
     * @param string $ipMaquinaVirtualFtp
     * @return Equipo
     */
    public function setIpMaquinaVirtualFtp($ipMaquinaVirtualFtp)
    {
        $this->ipMaquinaVirtualFtp = $ipMaquinaVirtualFtp;

        return $this;
    }

    /**
     * Get ipMaquinaVirtualFtp
     *
     * @return string 
     */
    public function getIpMaquinaVirtualFtp()
    {
        return $this->ipMaquinaVirtualFtp;
    }

    /**
     * Set ipMaquinaVirtualWeb
     *
     * @param string $ipMaquinaVirtualWeb
     * @return Equipo
     */
    public function setIpMaquinaVirtualWeb($ipMaquinaVirtualWeb)
    {
        $this->ipMaquinaVirtualWeb = $ipMaquinaVirtualWeb;

        return $this;
    }

    /**
     * Get ipMaquinaVirtualWeb
     *
     * @return string 
     */
    public function getIpMaquinaVirtualWeb()
    {
        return $this->ipMaquinaVirtualWeb;
    }

    /**
     * Set ipMaquinaVirtualNucleo
     *
     * @param string $ipMaquinaVirtualNucleo
     * @return Equipo
     */
    public function setIpMaquinaVirtualNucleo($ipMaquinaVirtualNucleo)
    {
        $this->ipMaquinaVirtualNucleo = $ipMaquinaVirtualNucleo;

        return $this;
    }

    /**
     * Get ipMaquinaVirtualNucleo
     *
     * @return string 
     */
    public function getIpMaquinaVirtualNucleo()
    {
        return $this->ipMaquinaVirtualNucleo;
    }

    /**
     * Add anotaciones
     *
     * @param Anotacion $anotacion
     * @return Equipo
     */
    public function addAnotacion(Anotacion $anotacion)
    {
        $this->anotaciones[] = $anotacion;

        return $this;
    }

    /**
     * Remove anotaciones
     *
     * @param Anotacion $anotacion
     */
    public function removeAnotacion(Anotacion $anotacion)
    {
        $this->anotaciones->removeElement($anotacion);
    }

    /**
     * Get anotaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnotaciones()
    {
        return $this->anotaciones;
    }
}
