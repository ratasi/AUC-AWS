<?php

namespace AUCBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipo
 *
 * @ORM\Table(name="equipo")
 * @ORM\Entity(repositoryClass="AUCBundle\Repository\EquipoRepository")
 */
class Equipo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=60)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="text")
     */
    private $imagen;

    /**
     * @ORM\OneToMany(targetEntity="Jugador", mappedBy="equipo", fetch="EAGER")
     */
    private $jugador;

    /**
     * @ORM\ManyToMany(targetEntity="Entrenador", mappedBy="equipo", fetch="EAGER")
     */

    private $entrenador;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
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
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Equipo
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jugador = new \Doctrine\Common\Collections\ArrayCollection();
        $this->entrenador = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add jugador
     *
     * @param \AUCBundle\Entity\Jugador $jugador
     *
     * @return Equipo
     */
    public function addJugador(\AUCBundle\Entity\Jugador $jugador)
    {
        $this->jugador[] = $jugador;

        return $this;
    }

    /**
     * Remove jugador
     *
     * @param \AUCBundle\Entity\Jugador $jugador
     */
    public function removeJugador(\AUCBundle\Entity\Jugador $jugador)
    {
        $this->jugador->removeElement($jugador);
    }

    /**
     * Get jugador
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJugador()
    {
        return $this->jugador;
    }

    /**
     * Add entrenador
     *
     * @param \AUCBundle\Entity\Entrenador $entrenador
     *
     * @return Equipo
     */
    public function addEntrenador(\AUCBundle\Entity\Entrenador $entrenador)
    {
        $this->entrenador[] = $entrenador;

        return $this;
    }

    /**
     * Remove entrenador
     *
     * @param \AUCBundle\Entity\Entrenador $entrenador
     */
    public function removeEntrenador(\AUCBundle\Entity\Entrenador $entrenador)
    {
        $this->entrenador->removeElement($entrenador);
    }

    /**
     * Get entrenador
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntrenador()
    {
        return $this->entrenador;
    }
}
