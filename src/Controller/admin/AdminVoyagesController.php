<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller\admin;

/**
 * Description of AdminVoyagesController
 *
 * @author Admin
 */
use App\Repository\VisiteRepository;
use App\Entity\Visite;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminVoyagesController extends AbstractController{
 /**
 * @Route("/admin", name="admin.voyages")
 * @return Response
 */
    public function index(): Response{
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render("admin/admin.voyages.html.twig", [
            'visites' => $visites
        ]);
    }
    /**
     * 
     * @var VisiteRepository
     */
    private $repository;

    /**
    * 
    * @param VisiteRepository $repository
    */
    public function __construct(VisiteRepository $repository){
        $this->repository = $repository;
    }
    /**
     * @Route("/admin/suppr/{id}", name="admin.voyage.suppr")
     * @param Visite $visite
     * @return Response
     */
    public function suppr(Visite $visite): Response{
        $this->repository->remove($visite, true);
        return $this->redirectToRoute('admin.voyages');
    }
}