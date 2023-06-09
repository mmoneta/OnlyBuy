<?php
    class Files {
        const MAX_FILE_SIZE = 1024 * 1024;
        const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
        const UPLOAD_DIRECTORY = 'public/uploads/';

        private static $instance;

        private function __construct() {}

        public static function getInstance() {
            if (!self::$instance){
                self::$instance = new Files();
            }

            return self::$instance;     
        }

        function getUploadDirectory(): string {
            return self::UPLOAD_DIRECTORY;
        }

        function validate(array $file): bool {
            if ($file['size'] > self::MAX_FILE_SIZE) {
                $this->message[] = 'File is too large for destination file system.';
                return false;
            }
    
            if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
                $this->message[] = 'File type is not supported.';
                return false;
            }
    
            return true;
        }
    }