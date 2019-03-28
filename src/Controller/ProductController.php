<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Repository\UserProductRepository;
use App\Service\ProductImageUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     *
     * @IsGranted("ROLE_USER")
     */
    public function index(ProductRepository $productRepository, UserProductRepository $userProductRepository): Response
    {
        $userProducts = $userProductRepository->findBy(['user' => $this->getUser()]);

        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
            'userProducts' => $userProducts
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, ProductImageUploader $fileUploader): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fileUploader->upload($product);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_index');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Product $product, ProductImageUploader $fileUploader): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fileUploader->upload($product);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_index', [
                'id' => $product->getId(),
            ]);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods={"DELETE"})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index');
    }
}
