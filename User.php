<?php

class User
{
    private int|null $idUser;
    private string|null $firstname;
    private string|null $lastname;
    private string|null $email;
    private string|null $password;

    /**
     * @param int|null $idUser
     * @param string|null $firstname
     * @param string|null $lastname
     * @param string|null $email
     * @param string|null $password
     */
    public function __construct(int    $idUser = null, string $firstname = null, string $lastname = null,
                                string $email = null, string $password = null)
    {
        $this->idUser = $idUser;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->password = $password;
    }
    // No need for setters

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }


}