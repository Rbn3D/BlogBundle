<?php

namespace Desarrolla2\Bundle\BlogBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Desarrolla2\Bundle\BlogBundle\Document\Comment;

/**
 * CommentModel
 */
class CommentModel
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length( min=5 )
     */
    protected $content;

    /**
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->setContent($comment->getContent());
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}
