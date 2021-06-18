<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class AppFixtures extends Fixture
{
    private $_passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->_passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        /*$createdAt = new \DateTime('now');

        // USER
        $user = new User();
        $user->setFirstname('John');
        $user->setLastname('Doe');
        $user->setUsername('user');
        $user->setEmail('user@silk-platform.org');
        $password = $this->_passwordEncoder->encodePassword($user, 'user');
        $apiToken = base64_encode(sha1($createdAt->format('Y-m-d H:i:s').$password, true));
        $user->setTokenCreatedAt($createdAt);
        $user->setCreatedAt($createdAt);
        $user->setApiToken($apiToken);
        $user->setRoles([User::ROLE_USER]);
        $user->setPassword($password);

        // INSTITUTION
        $institution = new User();
        $institution->setUsername('institution');
        $institution->setEmail('institution@silk-platform.org');
        $password = $this->_passwordEncoder->encodePassword($institution, 'institution');
        $apiToken = base64_encode(sha1($createdAt->format('Y-m-d H:i:s').$password, true));
        $institution->setTokenCreatedAt($createdAt);
        $institution->setCreatedAt($createdAt);
        $institution->setApiToken($apiToken);
        $institution->setRoles([User::ROLE_INSTITUTION]);
        $institution->setPassword($password);

        // INSTITUTION
        $admin = new User();
        $admin->setFirstname('Brad');
        $admin->setLastname('Doe');
        $admin->setUsername('admin');
        $admin->setEmail('admin@silk-platform.org');
        $password = $this->_passwordEncoder->encodePassword($admin, 'admin');
        $apiToken = base64_encode(sha1($createdAt->format('Y-m-d H:i:s').$password, true));
        $admin->setTokenCreatedAt($createdAt);
        $admin->setCreatedAt($createdAt);
        $admin->setApiToken($apiToken);
        $admin->setRoles([User::ROLE_ADMIN]);
        $admin->setPassword($password);

        $manager->persist($user);
        $manager->persist($institution);
        $manager->persist($admin);
        $manager->flush();*/

        // Bundle to manage file and directories
        $finder = new Finder();
        $finder->in(__DIR__ . '/SQL');
        $finder->name('*.sql');
        $finder->files();
        $finder->sortByName();

        foreach( $finder as $file ){
            print "Importing: {$file->getBasename()} " . PHP_EOL;

            $sql = $file->getContents();

            $manager->getConnection()->exec($sql);  // Execute native SQL

            $manager->flush();
        }
    }
}
