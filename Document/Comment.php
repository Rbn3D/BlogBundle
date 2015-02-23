<?php

namespace Desarrolla2\Bundle\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;
use Desarrolla2\Bundle\BlogBundle\Model\Gravatar;

/**
 * Desarrolla2\Bundle\BlogBundle\Document\Comment
 *
 * @ODM\Document(repositoryClass="Desarrolla2\Bundle\BlogBundle\Document\Repository\CommentRepository")
 */
class Comment
{

    /**
     * @var integer $id
     *
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /**
     * @var string $userName
     *
     * @ODM\String()
     */
    protected $userName;

    /**
     * @var string $userEmail
     *
     * @ODM\String()
     */
    protected $userEmail;

    /**
     * @var string $userWeb
     *
     * @ODM\String()
     */
    protected $userWeb;

    /**
     * @var boolean $published
     *
     * @ODM\Boolean()
     */
    protected $published;

    /**
     * @var string $content
     *
     * @ODM\String()
     */
    protected $content;

    /**
     * @var string status
     *
     * @ODM\String()
     */
    protected $status;

    /**
     *
     * @var Post
     *
     * @ODM\ReferenceOne(targetDocument="Post", inversedBy="comments")
     */
    protected $post;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ODM\DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ODM\DateTime
     */
    protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userName = '';
        $this->userEmail = '';
        $this->userWeb = '';
        $this->status = 0;
    }

    public function __toString()
    {
        return $this->getContent();
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
     * Set content
     *
     * @param  string  $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = (string) $content;

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

    /**
     * Set published
     *
     * @param  boolean $published
     * @return Comment
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Comment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param  \DateTime $updatedAt
     * @return Comment
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set post
     *
     * @param  Desarrolla2\Bundle\BlogBundle\Document\Post $post
     * @return Comment
     */
    public function setPost(\Desarrolla2\Bundle\BlogBundle\Document\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return Desarrolla2\Bundle\BlogBundle\Document\Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set userEmail
     *
     * @param  string  $userEmail
     * @return Comment
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set user
     *
     * @param  string  $user
     * @return Comment
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set userWeb
     *
     * @param  string  $userWeb
     * @return Comment
     */
    public function setUserWeb($userWeb)
    {
        $this->userWeb = $userWeb;

        return $this;
    }

    /**
     * Get userWeb
     *
     * @return string
     */
    public function getUserWeb()
    {
        return $this->userWeb;
    }

    /**
     * Set status
     *
     * @param  integer $status
     * @return Comment
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * get Avatar URL
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        return Gravatar::URL . md5(strtolower(trim($this->getUserEmail())));
    }
}
