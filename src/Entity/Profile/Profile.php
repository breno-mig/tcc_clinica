<?php

namespace App\Entity\Profile;

class Profile
{
    private int $id_profile;
    private array $permissions;
    private string $name;
    private int $is_active;

    /**
     * @return int
     */
    public function getIdProfile(): int
    {
        return $this->id_profile;
    }

    /**
     * @param int $id_profile
     * @return Profile
     */
    public function setIdProfile(int $id_profile): Profile
    {
        $this->id_profile = $id_profile;
        return $this;
    }

    /**
     * @return array
     */
    public function getPermissions(): array
    {
        return $this->permissions;
    }

    /**
     * @param array $permissions
     * @return Profile
     */
    public function setPermissions(array $permissions): Profile
    {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param array $name
     * @return Profile
     */
    public function setName(string $name): Profile
    {
        $this->name = $name;
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
     * @return Profile
     */
    public function setIsActive(int $is_active): Profile
    {
        $this->is_active = $is_active;
        return $this;
    }

}