<?php

namespace MinePlus\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends Admin
{
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', 'text', array('disabled' => true))
            ->add('email', 'email')
            ->add('password', 'password');
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }
    
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username')
            ->add('email', 'email')
            ->add('lastLogin')
            ->add('enabled', null, array('editable' => true));
    }
    
}

?>
