<?php

namespace User\Profile;

use Entity\Profile\Profile;

class ProfileUseCase
{
    public function __construct(private Connection $conn){}

    public function fill_profile($profile_to_fill):object
    {
        $profile = new Profile();

        $profile->setIdProfile($profile_to_fill->id_profile)
                ->setName($profile_to_fill->name)
                ->setExtra($profile_to_fill->extra)
                ->setPermissions($profile_to_fill->permissions)
        ;
        return $profile;
    }

    public function get_permission($profile){
        $profile_permission = json_decode($profile['permission']);
    }


}