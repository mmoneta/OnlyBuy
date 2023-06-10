<?php
    class AppController {
        protected $database;

        private $request;

        public function __construct() {
            $this->request = $_SERVER['REQUEST_METHOD'];
        }

        protected function isAjax(): bool {
            return 'xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '');
        }

        protected function isGet(): bool {
            return $this->request === 'GET';
        }

        protected function isPost(): bool {
            return $this->request === 'POST';
        }

        protected function render(string $template = null, array $variables = []) {
            $templatePath = 'public/views/'.$template.'.php';
            $output = 'File not found';
                    
            if (file_exists($templatePath)){
                extract($variables);
                
                ob_start();
                include $templatePath;
                $output = ob_get_clean();
            }

            print $output;
        }
    }