<?php

namespace SopraBootstrap\View\Helper;


use Zend\Form\FormInterface;
use Zend\Form\View\Helper\Form;

class BootstrapForm extends Form
{
    public function render(FormInterface $form)
    {
        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        $formContent = '';

        foreach ($form as $element) {
            if ($element instanceof FieldsetInterface) {
                throw new \Exception('TODO créer bootstrapFormCollection');
                $formContent.= $this->getView()->formCollection($element);
            } else {
                $formContent.= $this->getView()->bootstrapFormRow($element);
            }
        }

        return $this->openTag($form) . $formContent . $this->closeTag();
    }

}