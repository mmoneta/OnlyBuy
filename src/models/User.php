<?php
    class User {
        private $username;
        private $email;
        private $password;
        private $role;
        private $createdDate;
        private $modifiedDate;

        public function __construct(
            string $username,
            string $email,
            string $password,
            string $role,
            string $createdDate,
            string $modifiedDate
        ) {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
            $this->createdDate = $createdDate;
            $this->modifiedDate = $modifiedDate;
        }

        public function getUsername(): string {
            return $this->username;
        }

        public function getEmail(): string {
            return $this->email;
        }

        public function getPassword(): string {
            return $this->password;
        }
    }