<?php

namespace Civix\FrontBundle\Form\Type\Poll;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Civix\FrontBundle\Form\Type\Poll\EducationalContext;

class LeaderEvent extends AbstractType
{
    protected $user;
    
    public function __construct(UserInterface $user = null)
    {
        $this->user = $user;
    }

    /**
     * Set form fields
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('leaderEvent', new LeaderEventInfo());
        $builder->add('educationalContext', new EducationalContext());
    }

    /**
     * Get unique name for form
     *
     * @return string
     */
    public function getName()
    {
        return 'leader_event';
    }

    /**
     * Set default form option
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Civix\FrontBundle\Form\Model\LeaderEvent',
            'csrf_protection' => true,
            'csrf_field_name' => '_token'
        ]);
    }
}
