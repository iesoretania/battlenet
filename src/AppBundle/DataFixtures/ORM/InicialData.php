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

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Concepto;
use AppBundle\Entity\Estado;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class InicialData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $estados = [
            ['regi', 'Registrado'],
            ['fas1', 'Construyendo base'],
            ['fas2', 'Atacando bases enemigas'],
            ['fina', 'Finalizado'],
            ['desc', 'Descalificado']
        ];

        foreach($estados as $it => $datos) {
            $estado = new Estado();
            $estado
                ->setId($datos[0])
                ->setDescripcion($datos[1])
                ->setOrden($it);

            $manager->persist($estado);
        }

        $conceptos = [
            ['Construcción del servidor principal con sistema de enrutamiento', 1000],
            ['Construcción del servidor FTP (Arsenal) y la bomba lógica', 500],
            ['Construcción del servidor web (Escudo) con los datos de acceso', 500],
            ['Construcción del servidor Núcleo', 500],
            ['Base StarKiller enemiga destruída', 5000]
        ];

        foreach($conceptos as $datos) {
            $concepto = new Concepto();
            $concepto
                ->setDescripcion($datos[0])
                ->setPuntuacion($datos[1]);

            $manager->persist($concepto);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
