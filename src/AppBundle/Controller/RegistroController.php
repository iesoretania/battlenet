<?php
/*
  Battlenet

  Copyright (C) 2016: Luis Ramón López López

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU Affero General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU Affero General Public License for more details.

  You should have received a copy of the GNU Affero General Public License
  along with this program.  If not, see [http://www.gnu.org/licenses/].
*/

namespace AppBundle\Controller;

use AppBundle\Entity\Codigo;
use AppBundle\Entity\Equipo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

class RegistroController extends Controller
{
    /**
     * @Route("/registro", name="form_registro", methods={"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $equipo = new Equipo();

        $form = $this->createForm('AppBundle\Form\Type\RegistroType', $equipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Guardar el equipo en la base de datos

            // recuperar emblema y asociar estado "registrado"
            /** @var File $filename */
            $file = $form->get('filename_emblema')->getData();
            $strm = fopen($file->getRealPath(),'rb');
            $equipo
                ->setEmblema(stream_get_contents($strm))
                ->setEstado($em->getRepository('AppBundle:Estado')->find('regi'));

            //marcar el código como utilizado
            /** @var Codigo $token */
            $token = $em->getRepository('AppBundle:Codigo')->findOneBy(['token' => $form->get('token')->getData()]);
            $token
                ->setEquipo($equipo)
                ->setFechaRegistro(new \DateTime());

            $em->persist($equipo);
            $em->flush();

            $this->addFlash('success', 'Equipo registrado con éxito');
            return $this->redirectToRoute('form_registro');
        }

        return $this->render('registro/form.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
