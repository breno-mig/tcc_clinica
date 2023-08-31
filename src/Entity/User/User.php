<?php

namespace App\Entity\User;

use App\Commun\ValueObject\Cpf;
use App\Commun\ValueObject\Email;
use App\Commun\ValueObject\Password;
use DateTimeInterface;
use App\Entity\Profile\Profile;

class User
{
    private int $id_user;
    private string $username;
    private Password $password;
    private string $sex;
    private string $picture;
    private Email $email;
    private int $is_active;
    private Cpf $document;
    private DateTimeInterface $birth_date;
    private DateTimeInterface $registration_date;
    private Profile $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     * @return User
     */
    public function setIdUser(int $id_user): User
    {
        $this->id_user = $id_user;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return ?Password
     */
    public function getPassword(): ?Password
    {
        return null;
    }

    /**
     * @param Password $password
     * @return User
     */
    public function setPassword(Password $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     * @return User
     */
    public function setSex(string $sex): User
    {
        $this->sex = $sex;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     * @return User
     */
    public function setPicture(string $picture): User
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @param Email $email
     * @return User
     */
    public function setEmail(Email $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getIsActive(): int
    {
        return $this->is_active;
    }

    /**
     * @param int $is_active
     * @return User
     */
    public function setIsActive(int $is_active): User
    {
        $this->is_active = $is_active;
        return $this;
    }

    /**
     * @return Cpf
     */
    public function getDocument(): Cpf
    {
        return $this->document;
    }

    /**
     * @param Cpf $document
     * @return User
     */
    public function setDocument(Cpf $document): User
    {
        $this->document = $document;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getBirthDate(): DateTimeInterface
    {
        return $this->birth_date;
    }

    /**
     * @param DateTimeInterface $birth_date
     * @return User
     */
    public function setBirthDate(DateTimeInterface $birth_date): User
    {
        $this->birth_date = $birth_date;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getRegistrationDate(): DateTimeInterface
    {
        return $this->registration_date;
    }

    /**
     * @param DateTimeInterface $registration_date
     * @return User
     */
    public function setRegistrationDate(DateTimeInterface $registration_date): User
    {
        $this->registration_date = $registration_date;
        return $this;
    }

    /**
     * @return Profile
     */
    public function getProfile():Profile
    {
        return $this->profile;
    }

    
    /**
     * @param Profile $profile
     * @return User
     */
    public function setProfile(Profile $profile):User
    {
        $this->profile = $profile;

        return $this;
    }
}