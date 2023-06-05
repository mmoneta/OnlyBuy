<?php
    class User {
        private $username;
        private $email;
        private $role;
        private $createdDate;
        private $modifiedDate;

        public function __construct(
            string $username,
            string $email,
            string $role,
            string $createdDate,
            string $modifiedDate
        ) {
            $this->username = $username;
            $this->email = $email;
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

        public function getRole(): string {
            return $this->role;
        }

        public function getCreatedDate(): string {
            return $this->createdDate;
        }

        public function getModifiedDate(): string {
            return $this->modifiedDate;
        }
    }