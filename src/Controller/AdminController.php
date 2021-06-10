<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Skill;
use App\Entity\Training;
use App\Form\Type\UserPasswordType;
use App\Form\Type\UserType;
use App\Repository\NotificationRepository;
use App\Repository\SkillRepository;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        Request $request,
        ValidatorInterface $validator,
        TranslatorInterface $translator,
        UserPasswordEncoderInterface $passwordEncoder,
        SkillRepository $skillRepository,
        UserRepository $userRepository,
        NotificationRepository $notificationRepository,
        TrainingRepository $trainingRepository
    ): Response
    {
        if (!$this->isGranted(User::ROLE_ADMIN))
            return $this->redirectToRoute('app_home');

        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user, ['is_personal' => true]);
        $passwordForm = $this->createForm(UserPasswordType::class, $user);

        $form->handleRequest($request);
        $passwordForm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $errors = $validator->validate($user);
            if (count($errors) > 0)
                return new Response((string)$errors, 400);

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', $translator->trans('Updated data', [], 'admin'));

            return $this->redirectToRoute('admin_home');
        } else if ($passwordForm->isSubmitted()) {
            if (!$passwordForm->isValid()) {
                $errors = $validator->validate($user);
                dd($errors);
            }

            //$data = $request->request->all('user_password');
            //$result = $passwordEncoder->isPasswordValid($user, 'test');
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', $translator->trans('Updated data', [], 'admin'));
        }

        return $this->render(
            'admin/index.html.twig',
            [
                'user' => $user,
                'form' => $form->createView(),
                'notifications' => $notificationRepository->findBy(['isRead' => false]),
                'to_validated_trainings' => $trainingRepository->findBy(['isValidated' => false]),
                'password_form' => $passwordForm->createView(),
                //'related_skills' => $skillRepository->getByOccupationAndTraining($user)
            ]
        );
    }

    /**
     * @Route("/read", name="read")
     */
    public function read(
        Request $request,
        ValidatorInterface $validator,
        TranslatorInterface $translator,
        UserPasswordEncoderInterface $passwordEncoder,
        SkillRepository $skillRepository,
        UserRepository $userRepository,
        NotificationRepository $notificationRepository,
        TrainingRepository $trainingRepository
    ): Response
    {
        
    }
}