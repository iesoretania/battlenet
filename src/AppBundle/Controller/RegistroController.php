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

        if ($form->isSubmitted() && $form->isValid()) {
            // Guardar el equipo en la base de datos
            $strm = fopen($equipo->getEmblema()->getRealPath(),'rb');
            $equipo->setEmblema(stream_get_contents($strm));
            $this->getDoctrine()->getManager()->persist($equipo);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Equipo registrado con éxito');
            return $this->redirectToRoute('form_registro');
        }

        return $this->render('registro/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
