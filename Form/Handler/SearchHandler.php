<?php

/**
 * This file is part of the desarrolla2 project.
 *
 * Description of CommentHandler
 *
 * @author : Daniel González <daniel@desarrolla2.com>
 * @date : Aug 20, 2012 , 7:38:25 PM
 */

namespace Desarrolla2\Bundle\BlogBundle\Form\Handler;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

class SearchHandler
{
    /**
     * @var  \Symfony\Component\Form\Form
     */
    protected $form;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * @var \Doctrine\ODM\MongoDB\DocumentManager
     */
    protected $em;

    /**
     *
     * @param \Symfony\Component\Form\Form                              $form
     * @param \Symfony\Component\HttpFoundation\Request                 $request
     * @param \Desarrolla2\Bundle\BlogBundle\Document\Comment             $comment
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(Form $form, Request $request, DocumentManager $em)
    {
        $this->form = $form;
        $this->request = $request;
        $this->em = $em;
    }

    /**
     * @return boolean
     */
    public function process()
    {
        $this->form->submit($this->request);

        if ($this->form->isValid()) {
            $query = $this->form->getData()->getQuery();

            return true;
        }

        return false;
    }

}
