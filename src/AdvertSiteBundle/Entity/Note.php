<?php

namespace AdvertSiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @ORM\Entity(repositoryClass="AdvertSiteBundle\Repository\NoteRepository")
 */
class Note
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
     * @ORM\Column(name="advertAuthor", type="string", length=255)
     */
    private $advertAuthor;

    /**
     * @var string
     *
     * @ORM\Column(name="commentAuthor", type="string", length=255)
     */
    private $commentAuthor;

    /**
     * @var int
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;


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
     * Set advertAuthor
     *
     * @param string $advertAuthor
     *
     * @return Note
     */
    public function setAdvertAuthor($advertAuthor)
    {
        $this->advertAuthor = $advertAuthor;

        return $this;
    }

    /**
     * Get advertAuthor
     *
     * @return string
     */
    public function getAdvertAuthor()
    {
        return $this->advertAuthor;
    }

    /**
     * Set commentAuthor
     *
     * @param string $commentAuthor
     *
     * @return Note
     */
    public function setCommentAuthor($commentAuthor)
    {
        $this->commentAuthor = $commentAuthor;

        return $this;
    }

    /**
     * Get commentAuthor
     *
     * @return string
     */
    public function getCommentAuthor()
    {
        return $this->commentAuthor;
    }

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return Note
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

