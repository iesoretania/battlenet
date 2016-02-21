<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Equipo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/emblema/{equipo}", name="emblema_equipo", methods={"GET"})
     * @Cache(expires="+15 minutes", public=true)
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
     * @Route("/", name="portada")
     */
    public function indexAction()
    {
        return $this->marcadorAction();
    }

    /**
     * @Route("/clasificacion", name="marcador")
     */
    public function marcadorAction()
    {
        $equipos = $this->getDoctrine()->getManager()->getRepository('AppBundle:Equipo')->getTableroPuntuacion();
        return $this->render('default/marcador.html.twig', [
            'equipos' => $equipos,
            'refresco' => 15
        ]);
    }
}
