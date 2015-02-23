<?php

namespace Desarrolla2\Bundle\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Desarrolla2\Bundle\BlogBundle\Document\Tag
 *
 * @ODM\Document(repositoryClass="Desarrolla2\Bundle\BlogBundle\Document\Repository\TagRepository")
 */
class Tag
{
    /**
     * @var integer $id
     *
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /**
     * @ODM\ReferenceMany(targetDocument="Post", mappedBy="tag")
     */
    protected $posts;

    /**
     * @var string $name
     *
     * @ODM\String()
     */
    protected $name;

    /**
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"name"})
     * @ODM\String()
     * @ODM\UniqueIndex(unique=true)
     */
    protected $slug;

    /**
     * @var int $items
     *
     * @ODM\Int
     */
    protected $items;

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
        $this->items = 0;
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     *
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
     * @param  string $name
     *
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = strtolower($name);
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
     *
     * @return Tag
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
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
     *
     * @return Tag
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
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
     * Set slug
     *
     * @param  string $slug
     *
     * @return Tag
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
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

    /**
     * Add posts
     *
     * @param  Desarrolla2\Bundle\BlogBundle\Document\Post $post
     *
     * @return Tag
     */
    public function addPost(\Desarrolla2\Bundle\BlogBundle\Document\Post $post)
    {
        $post->addTag($this);
        $this->posts[] = $posts;
    }

    /**
     * Remove posts
     *
     * @param Desarrolla2\Bundle\BlogBundle\Document\Post $post
     */
    public function removePost(\Desarrolla2\Bundle\BlogBundle\Document\Post $post)
    {
        $this->posts->removeElement($post);
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
     * Set items
     *
     * @param  int $items
     *
     * @return Tag
     */
    public function setItems($items)
    {
        $this->items = (int)$items;
    }

    /**
     * Get items
     *
     * @return int
     */
    public function getItems()
    {
        return $this->items;
    }

}
