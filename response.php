
<?php
class Response {
        public $base_url = "views/";
        public function send(string $input) {
            echo $input;
        }  
        public function status(string $response_code) {
            return http_response_code($response_code);
        }   
        public function json(array $arr) {
            echo json_encode($arr);
        }   
        public function render(string $file) {
            require($this->base_url . $file);
        }   
        public function redirect(string $path) {
            header("Location: $path"); 
            exit;
        }   
        public function download(string $file) {
            if(file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                exit;
            }
       
        }   
    }

?>