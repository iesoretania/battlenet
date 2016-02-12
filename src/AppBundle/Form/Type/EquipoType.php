<?php
/**
 * Created by PhpStorm.
 * User: alumno
 * Date: 12/02/16
 * Time: 12:39
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