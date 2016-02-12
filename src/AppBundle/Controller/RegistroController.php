<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Equipo;
use AppBundle\Form\Type\EquipoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistroController extends Controller
{
    /**
     * @Route("/registro", name="form_registro", methods={"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $equipo = new Equipo();

        $form = $this->createForm('AppBundle\Form\Type\EquipoType', $equipo);

        $form->handleRequest($request);

        // replace this example code with whatever you need
        return $this->render('registro/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
