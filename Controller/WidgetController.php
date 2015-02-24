<?php

/*
 * This file is part of the desarrolla2 package.
 *
 * Short description
 *
 * @author Daniel González <daniel@desarrolla2.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Desarrolla2\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Desarrolla2\Bundle\BlogBundle\Document\Post;

/**
 * WidgetController
 */
class WidgetController extends Controller
{
    /**
     * @Template()
     */
    public function latestCommentAction()
    {
        return [
            'comments' =>
                $this->get('doctrine_mongodb.odm.document_manager')
                    ->getRepository('BlogBundle:Comment')->getLatest(4)
        ];
    }

    /**
     * @Template()
     */
    public function latestCommentRelatedAction(Post $post, $items = 3)
    {
        return [
            'comments' =>
                $this->get('doctrine_mongodb.odm.document_manager')
                    ->getRepository('BlogBundle:Comment')->getLatestRelated($post, $items)
        ];
    }

    /**
     * @Template()
     */
    public function latestPostAction()
    {
        return [
            'posts' =>
                $this->get('doctrine_mongodb.odm.document_manager')
                    ->getRepository('BlogBundle:Post')->getLatest(4)
        ];
    }

    /**
     * @Template()
     */
    public function latestPostRelatedAction(Post $post)
    {
        return [];

        return [
            'posts' =>
                $this->get('doctrine_mongodb.odm.document_manager')
                    ->getRepository('BlogBundle:Post')->getLatestRelated($post, 4)
        ];
    }

    /**
     * @Template()
     */
    public function tagsAction()
    {
        return [
            'tags' =>
                $this->get('doctrine_mongodb.odm.document_manager')
                    ->getRepository('BlogBundle:Tag')->get()
        ];
    }

    /**
     * @Template()
     */
    public function linksAction()
    {
        return [
            'links' =>
                $this->get('doctrine_mongodb.odm.document_manager')
                    ->getRepository('BlogBundle:Link')->getActiveOrdered()
        ];
    }

    /**
     * @Template()
     */
    public function postViewRelatedAction($post, $items = 3)
    {
        return [
            'related' => []
        ];
        $search = $this->get('blog.search');

        return [
            'related' => $search->related($post, $items),
        ];
    }

    /**
     * @Template()
     */
    public function bannerAction()
    {
        return [
            'banner' => $this->get('doctrine_mongodb.odm.document_manager')
                ->getRepository('BlogBundle:Banner')->getRandomActive()
        ];

    }

    /**
     * @Template()
     */
    public function mostAction()
    {
        return [];
    }
}
