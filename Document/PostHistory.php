<?php

namespace Desarrolla2\Bundle\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Desarrolla2\Bundle\BlogBundle\Document\PostHistory
 *
 * @ODM\Document(repositoryClass="Desarrolla2\Bundle\BlogBundle\Document\Repository\PostHistoryRepository")
 */
class PostHistory
{

    /**
     * @var integer $id
     *
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ODM\String()
     */
    protected $name;

    /**
     * @var string $intro
     *
     * @ODM\String()
     */
    protected $intro;

    /**
     * @var string $content
     *
     * @ODM\String()
     */
    protected $content;

    /**
     * @var \DateTime $created_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ODM\DateTime
     */
    protected $createdAt;

    /**
     *
     * @var Post
     *
     * @ODM\ReferenceOne(targetDocument="Post")
     */
    protected $post;

    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param  string      $name
     * @return PostHistory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set intro
     *
     * @param  string      $intro
     * @return PostHistory
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set content
     *
     * @param  string      $content
     * @return PostHistory
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

    /**
     * Set createdAt
     *
     * @param  \DateTime   $createdAt
     * @return PostHistory
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
     * Set post
     *
     * @param  \Desarrolla2\Bundle\BlogBundle\Document\Post $post
     * @return PostHistory
     */
    public function setPost(\Desarrolla2\Bundle\BlogBundle\Document\Post $post = null)
    {
        $this->post = $post;
        $this->setName($post->getName());
        $this->setIntro($post->getIntro());
        $this->setContent($post->getContent());

        return $this;
    }

    /**
     * Get post
     *
     * @return \Desarrolla2\Bundle\BlogBundle\Document\Post
     */
    public function getPost()
    {
        return $this->post;
    }

}
