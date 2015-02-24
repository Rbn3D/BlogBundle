<?php

namespace Desarrolla2\Bundle\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Gedmo\Mapping\Annotation as Gedmo;
use Desarrolla2\Bundle\BlogBundle\Model\PostStatus;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Post
 *
 * @ODM\Document(repositoryClass="Desarrolla2\Bundle\BlogBundle\Document\Repository\PostRepository")
 * @MongoDB\Index(keys={"title"="text"})
 */
class Post
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
     * @var string $slug
     *
     * @Gedmo\Slug(fields={"name"})
     * @ODM\String()
     */
    protected $slug;

    /**
     * @var string $source
     *
     * @ODM\String()
     */
    protected $source;

    /**
     * @var string $image
     *
     * @ODM\String()
     */
    protected $image;

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
     * @var int $status
     *
     * @ODM\Int
     */
    protected $status = 0;

    /**
     * @var int $promotion
     *
     * @ODM\Int
     */
    protected $promotion = 0;

    /**
     * @var int $rating
     *
     * @ODM\Int
     */
    protected $rating = 0;

    /**
     * @var int $votes
     *
     * @ODM\Int
     */
    protected $votes = 0;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ODM\ReferenceMany(targetDocument="Tag",inversedBy="tags")
     */
    protected $tags;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ODM\ReferenceMany(targetDocument="Comment", mappedBy="post", cascade={"remove"})
     */
    protected $comments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ODM\ReferenceMany(targetDocument="PostHistory", mappedBy="post", cascade={"remove"})
     */
    protected $history;

    /**
     * @var Author
     *
     * @ODM\ReferenceOne(targetDocument="Author")
     */
    protected $author;

    /**
     * @var \DateTime $created_at
     *
     * @Gedmo\Timestampable(on="create")
     * @ODM\DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime $updated_at
     *
     * @Gedmo\Timestampable(on="update")
     * @ODM\DateTime
     */
    protected $updatedAt;

    /**
     * @var \DateTime $published_at
     *
     * @ODM\DateTime
     */
    protected $publishedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->history = new ArrayCollection();
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
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = (string)$content;

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
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
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

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     *
     * @return Post
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
     * @param \DateTime $updatedAt
     *
     * @return Post
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
     * Set author
     *
     * @param Author $author
     *
     * @return Post
     */
    public function setAuthor(Author $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return Author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Post
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
     * Add tags
     *
     * @param Tag $tags
     *
     * @return Post
     */
    public function addTag(Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param Tag $tags
     * @param Tag $tags
     */
    public function removeTag(Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Clear Tags
     */
    public function removeTags()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     *
     * @return string
     */
    public function getTagsAsString()
    {
        $tags = '';
        foreach ($this->tags as $tag) {
            $tags .= $tag->getName().' ';
        }

        return trim($tags);
    }

    /**
     * Add comments
     *
     * @param Comment $comments
     *
     * @return Post
     */
    public function addComment(Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param Comment $comments
     * @param Comment $comments
     */
    public function removeComment(Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set intro
     *
     * @param string $intro
     *
     * @return Post
     */
    public function setIntro($intro)
    {
        $this->intro = (string)$intro;

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
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return Post
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Add history
     *
     * @param \Desarrolla2\Bundle\BlogBundle\Document\PostHistory $history
     *
     * @return Post
     */
    public function addHistory(\Desarrolla2\Bundle\BlogBundle\Document\PostHistory $history)
    {
        $this->history[] = $history;

        return $this;
    }

    /**
     * Remove history
     *
     * @param \Desarrolla2\Bundle\BlogBundle\Document\PostHistory $history
     */
    public function removeHistory(\Desarrolla2\Bundle\BlogBundle\Document\PostHistory $history)
    {
        $this->history->removeElement($history);
    }

    /**
     * Get history
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * Set source
     *
     * @param string $source
     *
     * @return Post
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return bool
     */
    public function hasSource()
    {
        return (bool)$this->getSource();
    }

    /**
     * Get Status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param int $status
     *
     * @return Post
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get Image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set Image
     *
     * @param string $image
     *
     * @return Post
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Retrieve if is published
     *
     * @return bool
     */
    public function isPublished()
    {
        return (bool)($this->status == PostStatus::PUBLISHED);
    }

    /**
     * Retrieve if has image
     *
     * @return bool
     */
    public function hasImage()
    {
        if (is_null($this->image)) {
            return false;
        }
        if (!strlen(trim($this->image))) {
            return false;
        }

        return true;
    }

    /**
     * @param int $promotion
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;
    }

    /**
     * @return int
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Post
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set votes
     *
     * @param integer $votes
     *
     * @return Post
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;

        return $this;
    }

    /**
     * Get votes
     *
     * @return integer
     */
    public function getVotes()
    {
        return $this->votes;
    }
}
