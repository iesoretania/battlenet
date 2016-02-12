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
use Symfony\Component\Validator\Constraints\Image;

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
            ->add('filename_emblema', 'Symfony\Component\Form\Extension\Core\Type\FileType', [
                'mapped' => false,
                'label' => 'Emblema',
                'constraints' => [
                    new Image([
                        'allowPortrait' => false,
                        'allowLandscape' => false,
                        'allowSquare' => true,
                        'maxSize' => '100K',
                        'minHeight' => 100,
                        'minWidth' => 100
                    ])
                ]
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
                'label' => 'IP Enrutador'
            ])
            ->add('ipMaquinaVirtualFtp', null, [
                'label' => 'IP Arsenal'
            ])
            ->add('ipMaquinaVirtualWeb', null, [
                'label' => 'IP Escudo deflector'
            ])
            ->add('ipMaquinaVirtualNucleo', null, [
                'label' => 'IP Puente de mando'
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
