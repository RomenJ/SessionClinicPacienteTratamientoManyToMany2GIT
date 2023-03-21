<?php

namespace App\Controller;

use App\Entity\Tratamiento;
use App\Form\TratamientoType;
use App\Repository\TratamientoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tratamiento')]
class TratamientoController extends AbstractController
{
    #[Route('/', name: 'app_tratamiento_index', methods: ['GET'])]
    public function index(TratamientoRepository $tratamientoRepository): Response
    {
        return $this->render('tratamiento/index.html.twig', [
            'tratamientos' => $tratamientoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tratamiento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TratamientoRepository $tratamientoRepository): Response
    {
        $tratamiento = new Tratamiento();
        $form = $this->createForm(TratamientoType::class, $tratamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tratamientoRepository->save($tratamiento, true);

            return $this->redirectToRoute('app_tratamiento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tratamiento/new.html.twig', [
            'tratamiento' => $tratamiento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tratamiento_show', methods: ['GET'])]
    public function show(Tratamiento $tratamiento): Response
    {
        return $this->render('tratamiento/show.html.twig', [
            'tratamiento' => $tratamiento,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tratamiento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tratamiento $tratamiento, TratamientoRepository $tratamientoRepository): Response
    {
        $form = $this->createForm(TratamientoType::class, $tratamiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tratamientoRepository->save($tratamiento, true);

            return $this->redirectToRoute('app_tratamiento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tratamiento/edit.html.twig', [
            'tratamiento' => $tratamiento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tratamiento_delete', methods: ['POST'])]
    public function delete(Request $request, Tratamiento $tratamiento, TratamientoRepository $tratamientoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tratamiento->getId(), $request->request->get('_token'))) {
            $tratamientoRepository->remove($tratamiento, true);
        }

        return $this->redirectToRoute('app_tratamiento_index', [], Response::HTTP_SEE_OTHER);
    }
}
