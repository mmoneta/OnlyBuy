<?php
    class Product {
        private $name;
        private $description;
        private $isActive;
        private $isPromo;
        private $images;

        public function __construct(
            string $name,
            string $description,
            string $isActive,
            string $isPromo,
            array $images
        ) {
            $this->name = $name;
            $this->description = $description;
            $this->isActive = $isActive;
            $this->isPromo = $isPromo;
            $this->images = $images;
        }

        public function getName(): string {
            return $this->name;
        }

        public function getDescription(): string {
            return $this->description;
        }

        public function getIsActive(): string {
            return $this->isActive;
        }

        public function getIsPromo(): string {
            return $this->isPromo;
        }

        public function getImages(): array {
            return $this->images;
        }
    }