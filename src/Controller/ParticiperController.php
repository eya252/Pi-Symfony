<?php

namespace App\Controller;

use App\Entity\Participer;
use App\Form\ParticiperType;
use App\Repository\EvenementRepository;
use App\Repository\ParticiperRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/participer")
 */
class ParticiperController extends AbstractController
{
    /**
     * @Route("/", name="participer_index", methods={"GET"})
     */
    public function index(ParticiperRepository $participerRepository): Response
    {
        return $this->render('participer/index.html.twig', [
            'participers' => $participerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/mesparticipation", name="mes_participer", methods={"GET"})
     */
    public function indexParticipation(ParticiperRepository $participerRepository,UserRepository $userRepository): Response
    {
        return $this->render('participer/mesParticipant.html.twig', [
            'participers' => $participerRepository->findBy(array('idUser'=>$userRepository->find(1))),
        ]);
    }

    /**
     * @Route("/new/{id}", name="participer_new")
     */
    public function new(Request $request,$id, EvenementRepository $evenementRepository,UserRepository $userRepository,EntityManagerInterface $entityManager): Response
    {
        $participer = new Participer();
        $form = $this->createForm(ParticiperType::class, $participer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $participer->setIdEvent($evenementRepository->find($id));
            $participer->setIdUser($userRepository->find(1));
            $entityManager->persist($participer);
            $entityManager->flush();

            return $this->redirectToRoute('mes_participer', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('participer/new.html.twig', [
            'participer' => $participer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="participer_show", methods={"GET"})
     */
    public function show(Participer $participer): Response
    {
        return $this->render('participer/show.html.twig', [
            'participer' => $participer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="participer_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Participer $participer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParticiperType::class, $participer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('mes_participer', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('participer/edit.html.twig', [
            'participer' => $participer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("delete/{id}", name="participer_delete")
     */
    public function delete($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $participer = $em->getRepository(Participer::class)->find($id);
        $em->remove($participer);
        $em->flush();
        return $this->redirectToRoute('mes_participer');
    }
}
