<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 23/10/15
 * Time: 10:22
 */

namespace AddressBookTest\Controller;


class ContactControllerTest extends \Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase
{
    public function setup() {
        $this->setApplicationConfig(require 'config/application.config.php');
        //
    }

    public function testShowActionForContact1() {
        $this->dispatch('/contacts/1');

        $this->assertResponseStatusCode(200);
        $this->assertActionName('show');

        // pour un meilleur parcours du DOM utiliser Symfony\DomCrawler
        $this->assertQueryContentRegex('div.container > h2', '/\s*Bill Gates\s*/');
    }

    public function testShowActionForContact1SansBdd() {

    }
}