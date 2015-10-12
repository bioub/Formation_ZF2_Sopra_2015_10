<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 12/10/15
 * Time: 10:30
 */

namespace Sopra\Entity;


class Societe
{
    protected $nom;

    /**
     * @var \SplObjectStorage
     */
    protected $contacts;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     * @return Societe
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return \SplObjectStorage
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param Contact $contact
     * @return Societe
     */
    public function addContact(Contact $contact)
    {
        $this->contacts->attach($contact);
        return $this;
    }


}