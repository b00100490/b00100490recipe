<?php

namespace App\Controller;
use \App\Entity\Recipe;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * summary
     * @Route("/", name="list_all_recipes")
     * @method({"GET"})
     */
    public function index()
    {
        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findAll();

        return $this->render('default/index.html.twig', array('recipes' => $recipes));
    }





    /**
     * @Route("/default/newrecipe", name="new_recipe")
     * Method({"GET", "POST"})
     */

    public function new(Request $request)
    {
        $recipe = new Recipe();

        $form = $this->createFormBuilder($recipe)
            ->add('title',TextType::class, array('attr' =>array('class' => 'form-control')))
            ->add('summary',TextareaType::class, array('attr' =>array('class' => 'form-control')))
            ->add('ingredients',TextareaType::class, array('attr' =>array('class' => 'form-control')))
            ->add('steps',TextareaType::class, array('attr' =>array('class' => 'form-control')))
            ->add('author',TextareaType::class, array('attr' =>array('class' => 'form-control')))
            ->add('comments',TextareaType::class, array('required' => false,'attr' => array('class' => 'form-control')))
            ->add('save',SubmitType::class, array('label' => 'Create','attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $recipe = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('list_all_recipes');
        }

            return $this->render('default/newrecipe.html.twig', array('form' => $form->createView()));
    }




    /**
     * @Route("/default/delete/{id}")
     * @Method({"DELETE"})
     */

    public function delete(Request $request, $id)
    {
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($recipe);
        $entityManager->flush();

        $response = new Response();
        $response->send();

    }


    /**
     * @Route("/default/editrecipe{id}", name="edit_recipe")
     * Method({"GET", "POST"})
     */

    public function edit(Request $request, $id)
    {
        $recipe = new Recipe();

        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        $form = $this->createFormBuilder($recipe)
            ->add('title',TextType::class, array('attr' =>array('class' => 'form-control')))
            ->add('summary',TextareaType::class, array('attr' =>array('class' => 'form-control')))
            ->add('ingredients',TextareaType::class, array('attr' =>array('class' => 'form-control')))
            ->add('steps',TextareaType::class, array('attr' =>array('class' => 'form-control')))
            ->add('author',TextareaType::class, array('attr' =>array('class' => 'form-control')))
            ->add('comments',TextareaType::class, array('required' => false,'attr' => array('class' => 'form-control')))
            ->add('save',SubmitType::class, array('label' => 'Update','attr' => array('class' => 'btn btn-primary mt-3')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('list_all_recipes');
        }

        return $this->render('default/editrecipe.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/default/{id}", name="show")
     */

    public function show($id)
    {
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        return $this->render('default/show.html.twig', array('recipe' => $recipe));

    }


}
