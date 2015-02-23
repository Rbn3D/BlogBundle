<?php
/**
 * This file is part of the planetubuntu package.
 *
 * (c) Daniel González <daniel@desarrolla2.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Desarrolla2\Bundle\BlogBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Desarrolla2\Bundle\BlogBundle\Document\Post
 *
 * @ODM\Document(repositoryClass="Desarrolla2\Bundle\BlogBundle\Document\Repository\SearchQueryRepository")
 */
class SearchQuery
{
    /**
     * @var integer $id
     *
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /**
     *
     * @var string
     *
     * @ODM\Column(name="query", type="string")
     */
    protected $query;

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
     * Set query
     *
     * @param string $query
     *
     * @return SearchQuery
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }
}
