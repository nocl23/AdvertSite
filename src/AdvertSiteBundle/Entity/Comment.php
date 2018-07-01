<?php

namespace AdvertSiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AdvertSiteBundle\Repository\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="user", type="string", length=255)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="advertId",type="integer")
     */

    private $advertId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isNoted",type="boolean")
     */

    private $isNoted;

    /**
     * @return bool
     */
    public function isNoted()
    {
        return $this->isNoted;
    }

    /**
     * @param bool $isNoted
     */
    public function setIsNoted($isNoted)
    {
        $this->isNoted = $isNoted;
    }

    /**
     * @return int
     */
    public function getAdvertId()
    {
        return $this->advertId;
    }

    /**
     * @param int $advertId
     */
    public function setAdvertId($advertId)
    {
        $this->advertId = $advertId;
    }

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
     * Set user
     *
     * @param string $user
     *
     * @return Comment
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


}

