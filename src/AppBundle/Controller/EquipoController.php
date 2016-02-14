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

use AppBundle\Entity\Anotacion;
use AppBundle\Entity\Equipo;
use AppBundle\Form\Entity\AnotacionPredefinida;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * @Route("/equipo")
 */
class EquipoController extends Controller
{
    /**
     * @Route("/", name="lista_equipo", methods={"GET"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipos = $em->getRepository('AppBundle:Equipo')->getEquiposPuntuacion();

        return $this->render('equipo/lista.html.twig', array(
            'equipos' => $equipos
        ));
    }

    /**
     * @Route("/detalles/{equipo}", name="form_equipo", methods={"GET", "POST"})
     */
    public function equipoDetalleAction(Equipo $equipo, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm('AppBundle\Form\Type\EquipoType', $equipo, [
            'new' => false
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Guardar el equipo en la base de datos

            // recuperar emblema si se ha cambiado
            /** @var File $filename */
            $file = $form->get('filename_emblema')->getData();

            if ($file) {
                // leer fichero, covertirlo en una imagen png de 300x300 y guardarla
                $strm = fopen($file->getRealPath(), 'rb');
                $imagen = imagecreatefromstring(stream_get_contents($strm));
                $ancho = imagesx($imagen);
                $tmp = imagecreatetruecolor(300, 300);
                imagesavealpha($tmp, true);
                imagecopyresampled($tmp, $imagen, 0, 0, 0, 0, 300, 300, $ancho, $ancho);
                ob_start();
                imagepng($tmp);
                $datos = ob_get_contents();
                ob_end_clean();
                $equipo->setEmblema($datos);
                imagedestroy($tmp);
                imagedestroy($imagen);
            }

            $em->persist($equipo);
            $em->flush();

            $this->addFlash('success', 'Cambios guardados con éxito');
            return $this->redirectToRoute('lista_equipo');
        }
        return $this->render('equipo/form.html.twig', array(
            'form' => $form->createView(),
            'equipo' => $equipo
        ));
    }

    /**
     * @Route("/puntuacion/{equipo}", name="anotaciones_equipo", methods={"GET", "POST"})
     */
    public function anotacionIndexAction(Equipo $equipo, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $anotacionPredefinida = new AnotacionPredefinida();

        $formPredefinido = $this->createForm('AppBundle\Form\Type\AnotacionPredefinidaType', $anotacionPredefinida);
        $formPredefinido->handleRequest($request);

        $anotacion = new Anotacion();
        $anotacion
            ->setEquipo($equipo)
            ->setFechaHora(new \DateTime());

        $formPersonalizado = $this->createForm('AppBundle\Form\Type\AnotacionEquipoType', $anotacion);
        $formPersonalizado->handleRequest($request);

        if ($formPredefinido->isSubmitted() && $formPredefinido->isValid()) {
            $anotacion
                ->setPuntuacion($anotacionPredefinida->getConcepto()->getPuntuacion())
                ->setConcepto($anotacionPredefinida->getConcepto()->getDescripcion());

            $em->persist($anotacion);
            $em->flush();

            $this->addFlash('success', 'Cambios guardados con éxito');
            return $this->redirect($request->getRequestUri());
        }

        if ($formPersonalizado->isSubmitted() && $formPersonalizado->isValid()) {
            $em->persist($anotacion);
            $em->flush();

            $this->addFlash('success', 'Cambios guardados con éxito');
            return $this->redirect($request->getRequestUri());
        }

        return $this->render('equipo/puntuacion.html.twig', array(
            'form_predefinido' => $formPredefinido->createView(),
            'form_personalizado' => $formPersonalizado->createView(),
            'equipo' => $equipo,
            'puntuacion' => $em->getRepository('AppBundle:Equipo')->getPuntuacionEquipo($equipo)
        ));
    }

    /**
     * @Route("/emblema/{equipo}", name="emblema_equipo", methods={"GET"})
     */
    public function getEmblemaAction(Equipo $equipo)
    {
        $callback = function () use ($equipo) {
            echo stream_get_contents($equipo->getEmblema());
        };
        $response = new StreamedResponse($callback);
        $response->headers->set('Content-Type', 'image/png');
        return $response;
    }

    /**
     * @Route("/anotacion/{anotacion}", name="form_anotacion", methods={"GET", "POST"})
     */
    public function modificarAnotacionAction(Anotacion $anotacion, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm('AppBundle\Form\Type\AnotacionType', $anotacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($request->request->has('borrar')) {
                $em->remove($anotacion);
                $this->addFlash('success', 'Puntuación eliminada con éxito');
            } else {
                $this->addFlash('success', 'Cambios guardados con éxito');
            }
            // Guardar la anotación en la base de datos
            $em->flush();

            return $this->redirectToRoute('anotaciones_equipo', ['equipo' => $anotacion->getEquipo()->getId()]);
        }
        return $this->render('anotacion/form.html.twig', array(
            'form' => $form->createView(),
            'anotacion' => $anotacion
        ));
    }
}
