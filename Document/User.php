<?php
/**
 * This file is part of the desarrolla2/blog-bundle project.
 *
 * Copyright (c)
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 */

namespace Desarrolla2\Bundle\BlogBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class User extends Person
{
    /**
     * @ODM\Id(strategy="auto")
     */
    protected $id;

    /**
     * @ODM\ReferenceOne(targetDocument="Profile", mappedBy="user", cascade={"persist", "remove"})
     **/
    protected $profile;

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
     * @return Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param Profile $profile
     */
    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;
    }
}
