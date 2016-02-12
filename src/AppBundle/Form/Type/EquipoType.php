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

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, [
                'label' => 'Nombre del equipo'
            ])
            ->add('emblema', 'Symfony\Component\Form\Extension\Core\Type\FileType', [
                'label' => 'Emblema'
            ])
            ->add('participante1', null, [
                'label' => 'Nombre del participante 1'
            ])
            ->add('participante2', null, [
                'label' => 'Nombre del participante 2'
            ])
            ->add('participante3', null, [
                'label' => 'Nombre del participante 3 (opcional)',
                'required' => false
            ])
            ->add('ipMaquinaFisica1', null, [
                'label' => 'IP Máquina Física 1'
            ])
            ->add('ipMaquinaFisica2', null, [
                'label' => 'IP Máquina Física 2'
            ])
            ->add('ipMaquinaVirtualWS', null, [
                'label' => 'IP Máquina Virtual Windows Server'
            ])
            ->add('ipMaquinaVirtualFtp', null, [
                'label' => 'IP Máquina Virtual FTP'
            ])
            ->add('ipMaquinaVirtualWeb', null, [
                'label' => 'IP Máquina Virtual Web'
            ])
            ->add('ipMaquinaVirtualNucleo', null, [
                'label' => 'IP Máquina Virtual Núcleo'
            ])
            ->add('rutaCargaExplosiva', null, [
                'label' => 'Ruta de la carga explosiva'
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Equipo'
        ]);
    }
}
