<?php
/**
 * This file is part of the planetubuntu package.
 *
 * (c) Daniel González <daniel@desarrolla2.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Desarrolla2\Bundle\BlogBundle\Manager;

use Desarrolla2\Bundle\BlogBundle\Document\Post;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

/**
 * AbstractManager
 */
abstract class AbstractManager
{
    /**
     * @var \Doctrine\ODM\MongoDB\DocumentManager;
     */
    protected $em;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @param DocumentManager $em
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(DocumentManager $em, EventDispatcherInterface $eventDispatcher)
    {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param int $id
     *
     * @return Post
     */
    public function find($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param mixed $entity
     * @param bool  $flush
     */
    public function persist($entity, $flush = true)
    {
        $this->em->persist($entity);
        if ($flush) {
            $this->em->flush();
        }
    }

    /**
     * @return mixed
     */
    abstract public function create();

    /**
     * @return DocumentRepository
     */
    abstract public function getRepository();
}
