<?php

namespace AdvertSiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
/**
 * User
 *
 *
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="AdvertSiteBundle\Repository\UserRepository")
 */
class User extends BaseUser
{

    public function __construct()
    {
        parent::__construct();
        $this->note = 4.5;
        $this->roles = array('ROLE_USER');
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float")
     */
    protected $note;


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
     * Set note
     *
     * @param integer $note
     *
     * @return User
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }
}

