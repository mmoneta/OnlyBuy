<?php
    require_once __DIR__.'/BaseModel.php';

    class Product extends BaseModel {
        public $productId;
        public $name;
        public $description;
        public $isActive;
        public $isPromo;
        public $images;

        public function __construct(
            int $productId,
            string $name,
            string $description,
            bool $isActive,
            bool $isPromo,
            array $images,
            string $createdDate,
            string $modifiedDate
        ) {
            parent::__construct($createdDate, $modifiedDate);
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