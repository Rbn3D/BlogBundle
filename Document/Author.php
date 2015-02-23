<?php

namespace Desarrolla2\Bundle\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Desarrolla2\Bundle\BlogBundle\Document\Author
 *
 * @ODM\Document(repositoryClass="Desarrolla2\Bundle\BlogBundle\Document\Repository\AuthorRepository")
 */
class Author extends Person
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
     * @ODM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string $email
     *
     * @ODM\Column(name="email", type="string", length=255, unique=true)
     */
    protected $email;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"name"})
     * @ODM\Column(name="slug", type="string", length=255, unique=true))
     */
    protected $slug;

    /**
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ODM\OneToMany(targetDocument="Post", mappedBy="author")
     */
    protected $posts;

    /**
     * @var \DateTime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ODM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @Gedmo\Timestampable(on="update")
     * @ODM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @param  string $name
     * @return Author
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
     * Set created_at
     *
     * @param  \DateTime $createdAt
     * @return Author
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updated_at
     *
     * @param  \DateTime $updatedAt
     * @return Author
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add posts
     *
     * @param  Desarrolla2\Bundle\BlogBundle\Document\Post $posts
     * @return Author
     */
    public function addPost(\Desarrolla2\Bundle\BlogBundle\Document\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param Desarrolla2\Bundle\BlogBundle\Document\Post $posts
     */
    public function removePost(\Desarrolla2\Bundle\BlogBundle\Document\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set slug
     *
     * @param  string $slug
     * @return Author
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

}