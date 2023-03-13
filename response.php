
<?php
class Response {
        public $base_url = "views/";
        public function send($input) {
            echo $input;
        }  
        public function status($response_code) {
            return http_response_code($response_code);
            return $this;
        }   
        public function json($arr) {
            echo json_encode($arr);
            return $this;
        }   
        public function render($file) {
            require($this->base_url . $file);
        }   
        public function redirect($path) {
            header("Location: $path"); 
            exit;
        }   
        public function download($file) {
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