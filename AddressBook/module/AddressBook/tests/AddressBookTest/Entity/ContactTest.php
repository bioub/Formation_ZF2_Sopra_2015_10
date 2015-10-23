<?php
namespace AddressBookTest\Entity;

use AddressBook\Entity\Contact;

require_once 'module/AddressBook/src/AddressBook/Entity/Contact.php';

class ContactTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Contact
     */
    protected $contact;

    public function setup() {
        $this->contact = new Contact();
    }

    public function tearDown() {

    }

    public function testGetSetPrenomWithString() {

        $this->contact->setPrenom('Jean');
        $this->assertEquals('Jean', $this->contact->getPrenom());

        $this->contact->setPrenom('Eric');
        $this->assertEquals('Eric', $this->contact->getPrenom());
    }

    public function testInitialPropertiesAreNull() {

        $this->assertNull($this->contact->getPrenom());
    }
}