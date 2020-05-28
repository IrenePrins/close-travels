<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setFirstname('Irene');
        $user->setLastname('Prins');
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setEmail('ireneprins11@hotmail.com');

        $password = $this->encoder->encodePassword($user, 'test1234');
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();
    }
}
