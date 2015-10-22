<?php

namespace SopraBootstrap\View\Helper;

use Zend\View\Helper\AbstractHelper;

class BootstrapFlashMessenger extends AbstractHelper
{
    public function __invoke()
    {
        $html = '';

        foreach ($this->view->flashMessenger()->getSuccessMessages() as $message) {
            $html .= <<<HTML
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    $message
</div>
HTML;
        }

        return $html;
    }
}