<?php

namespace Desarrolla2\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Desarrolla2\Bundle\BlogBundle\Document\Post;
use Desarrolla2\Bundle\BlogBundle\Document\Comment;
use Desarrolla2\Bundle\BlogBundle\Form\Type\CommentType;
use Desarrolla2\Bundle\BlogBundle\Form\Model\CommentModel;
use Desarrolla2\Bundle\BlogBundle\Model\PostStatus;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\Query\QueryException;
use Symfony\Component\HttpFoundation\Response;

/**
 * PostController
 */
class PostController extends Controller
{
    /**
     * @Route("/{page}", name="_blog_default", requirements={"page" = "\d{1,6}"}, defaults={"page" = "1" })
     * @Method({"GET"})
     * @Template()
     *
     * @param  Request $request
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return array
     */
    public function indexAction(Request $request)
    {
        $paginator = $this->get('knp_paginator');
        $query = $this->get('doctrine_mongodb.odm.document_manager')
            ->getRepository('BlogBundle:Post')->getQueryForGet();

        try {
            $pagination = $paginator->paginate(
                $query,
                $this->getPage(),
                $this->container->getParameter('blog.items')
            );
        } catch (\Exception $e) {
            throw $this->createNotFoundException('Page not found');
        }

        return [
            'page' => $this->getPage(),
            'pagination' => $pagination,
            'title' => $this->container->getParameter('blog.title'),
            'description' => $this->container->getParameter('blog.description'),
        ];
    }

    /**
     *
     * @Route("/post/{slug}" , name="_blog_view", requirements={"slug" = "[\w\d\-]+"})
     * @Method({"GET"})
     * @Template()
     *
     * @param  Request $request
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function viewAction(Request $request)
    {
        $post = $this->get('doctrine_mongodb.odm.document_manager')
            ->getRepository('BlogBundle:Post')
            ->getOneBySlug($request->get('slug', false));

        if (!$post) {
            throw $this->createNotFoundException('The post does not exist');
        }
        if ($post->getStatus() != PostStatus::PUBLISHED) {
            return new RedirectResponse($this->generateUrl('_blog_default'), 302);
        }

        $comments = $this->get('doctrine_mongodb.odm.document_manager')
            ->getRepository('BlogBundle:Comment')->getForPost($post);

        $form = $this->createForm(new CommentType(), new CommentModel($this->createCommentForPost($post)));

        return [
            'post' => $post,
            'comments' => $comments,
            'form' => $form->createView(),
        ];
    }

    /**
     *
     * @Route("/view/post/{slug}" , name="_blog_post_view", requirements={"slug" = "[\w\d\-]+"})
     * @Method({"POST"})
     *
     * @param  Request $request
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return Response
     */
    public function postViewAction(Request $request)
    {
        $post = $this->get('doctrine_mongodb.odm.document_manager')
            ->getRepository('BlogBundle:Post')->getOneBySlug($request->get('slug', false));
        if (!$post) {
            throw $this->createNotFoundException('The post does not exist');
        }

        $this->get('doctrine_mongodb.odm.document_manager')
            ->getRepository('BlogBundle:PostView')
            ->add($post);

        return new Response();
    }

    /**
     * @param  \Desarrolla2\Bundle\BlogBundle\Document\Post $post
     *
     * @return \Desarrolla2\Bundle\BlogBundle\Document\Comment
     */
    protected function createCommentForPost(Post $post)
    {
        $comment = new Comment();
        $comment->setPost($post);

        return $comment;
    }

    /**
     * @return int
     */
    protected function getPage()
    {
        $request = $this->getRequest();
        $page = (int)$request->get('page', 1);
        if ($page < 1) {
            $this->createNotFoundException('Page number is not valid'.$page);
        }

        return $page;
    }
}