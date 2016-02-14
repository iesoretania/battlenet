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

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EquipoRepository extends EntityRepository
{
    public function getTableroPuntuacionQueryBuilder()
    {
        $em = $this->getEntityManager();

        $tablero = $em->getRepository('AppBundle:Equipo')
            ->createQueryBuilder('e')
            ->select('e AS equipo')
            ->addSelect('SUM(a.puntuacion) AS puntos')
            ->leftJoin('AppBundle:Anotacion', 'a', 'WITH', 'e.id = a.equipo')
            ->groupBy('a.equipo');

        return $tablero;
    }

    public function getTableroPuntuacion()
    {
        return $this->getTableroPuntuacionQueryBuilder()
            ->orderBy('puntos', 'DESC')
            ->getQuery()
            ->getResult();

    }

    public function getEquiposPuntuacion()
    {
        return $this->getTableroPuntuacionQueryBuilder()
            ->orderBy('e.nombre', 'ASC')
            ->getQuery()
            ->getResult();

    }

    public function getPuntuacionEquipo(Equipo $equipo)
    {
        $em = $this->getEntityManager();

        return $em->getRepository('AppBundle:Anotacion')
            ->createQueryBuilder('a')
            ->select('SUM(a.puntuacion)')
            ->where('a.equipo = :equipo')
            ->setParameter('equipo', $equipo)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
