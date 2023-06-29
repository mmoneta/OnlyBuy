<?php

namespace src\models;

class BaseModel
{
    public string $createdDate;
    public string $modifiedDate;

    public function __construct(
        string $createdDate,
        string $modifiedDate
    ) {
        $this->createdDate = $createdDate;
        $this->modifiedDate = $modifiedDate;
    }
}