<?php
    class Product {
        private $productId;
        private $name;
        private $description;
        private $isActive;
        private $isPromo;
        private $images;

        public function __construct(
            int $productId,
            string $name,
            string $description,
            string $isActive,
            string $isPromo,
            array $images
        ) {
            $this->productId = $productId;
            $this->name = $name;
            $this->description = $description;
            $this->isActive = $isActive;
            $this->isPromo = $isPromo;
            $this->images = $images;
        }

        public function addImage(string $image): void {
            array_push($this->images, $image);
        }

        public function getProductId(): int {
            return $this->productId;
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

        public function getImages(): string {
            return $this->images;
        }
    }