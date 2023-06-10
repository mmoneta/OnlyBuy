<?php
    class BaseModel {
        public $createdDate;
        public $modifiedDate;
        
        public function __construct(
            string $createdDate,
            string $modifiedDate
        ) {
            $this->createdDate = $createdDate;
            $this->modifiedDate = $modifiedDate;
        }
    }