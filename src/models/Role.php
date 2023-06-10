<?php
    class Role {
        public $roleId;
        public $name;

        public function __construct(
            int $roleId,
            string $name
        ) {
            $this->roleId = $roleId;
            $this->name = $name;
        }

        public function getRoleId(): int {
            return $this->roleId;
        }

        public function getName(): string {
            return $this->name;
        }
    }