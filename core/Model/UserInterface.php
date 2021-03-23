<?php

namespace Core\Model;

interface UserInterface
{
    public function getId();

    public function getname();

    public function getEmail();

    public function getToken();
}
