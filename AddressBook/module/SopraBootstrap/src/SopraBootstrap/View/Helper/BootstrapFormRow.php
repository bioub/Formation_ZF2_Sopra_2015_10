<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 22/10/15
 * Time: 11:45
 */

namespace SopraBootstrap\View\Helper;

use Zend\Form\Element\Submit;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRow;

class BootstrapFormRow extends FormRow
{
    public function render(ElementInterface $element, $labelPosition = null)
    {
        if ($element->getMessages()) {
            $html = '<div class="form-group has-error">';
        }
        else {
            $html = '<div class="form-group">';
        }

        if ($element->getLabel()) {
            $html .= $this->view->formLabel($element);
            $element->setAttribute('class', 'form-control');
        }

        if ($element instanceof Submit) {
            $element->setAttribute('class', 'btn btn-primary');
        }

        $html .= $this->view->formElement($element);

        if ($element->getMessages()) {
            $html .= '<div class="help-block">';
//            $html .= $this->view->formElementErrors($element);
            $html .= implode('<br>', $element->getMessages());
            $html .= '</div>';
        }

        $html .= '</div>';

        return $html;
    }

}