<?php
/*
 * This file is part of the planetubuntu package.
 *
 * (c) Daniel González <daniel@desarrolla2.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Desarrolla2\Bundle\BlogBundle\Manager;

use Desarrolla2\Bundle\BlogBundle\Document\Profile;
use Desarrolla2\Bundle\BlogBundle\Document\User;
use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * ProfileManager
 */
class ProfileManager extends AbstractManager
{
    /**
     * @param User $user
     *
     * @return Profile
     */
    public function get(User $user)
    {
        $profile = $user->getProfile();
        if (!$profile) {
            $profile = new Profile();
            $user->setProfile($profile);
            $profile->setUser($user);

            $this->persist($user, true);
        }

        return $profile;
    }

    /**
     * @return mixed
     */
    public function create()
    {
        throw new \RuntimeException('This method is not available');
    }

    /**
     * @return DocumentRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository('BlogBundle:Profile');
    }


}