<?php

namespace src\models;

class User extends BaseModel
{
    public ?string $avatar;
    public string $username;
    public string $email;
    public string $role;

    public function __construct(
        ?string $avatar,
        string $username,
        string $email,
        string $role,
        string $createdDate,
        string $modifiedDate
    ) {
        parent::__construct($createdDate, $modifiedDate);
        $this->avatar = $avatar;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    public function getModifiedDate(): string
    {
        return $this->modifiedDate;
    }
}