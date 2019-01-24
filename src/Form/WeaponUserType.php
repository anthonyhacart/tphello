<?php

namespace App\Form;

use App\Entity\WeaponUser;
use App\Entity\User;
use App\Form\Type\QualityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class WeaponUserType extends AbstractType
{
    private $securityChecker;
    private $token;

    public function __construct(AuthorizationCheckerInterface $securityChecker, TokenStorageInterface $token)
    {
        $this->securityChecker = $securityChecker;
        $this->token = $token;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quality', QualityType::class)
            ->add('ammunition')
            ->add('active')
            ->add('user',EntityType::class, [
                'class' => User::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'username',
            ])
            ->add('weapon')
            ->add('submit', SubmitType::class, ['label_format' => 'Ajout d\'une arme'])
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            array($this, 'preSetData')
        );
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $weaponUser = $event->getData();

        if($weaponUser->getId() === null){
            $weaponUser->setActive(false)->setAmmunition(100);
            $form->remove('active')->remove('ammunition');
        }

        if($this->securityChecker->isGranted('ROLE_ADMIN') === false){
            $weaponUser->setUser($this->token->getToken()->getUser());
            $form->remove('user');
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WeaponUser::class,
        ]);
    }
}
