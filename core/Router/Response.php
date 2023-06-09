<?php

namespace Artemis\Core\Router;

class Response
{
    public $base_url = "/views/";
    public $view_engine;
    /**
     * @param string $input
     * 
     * @return [type]
     */
    public function send(string $input)
    {
        echo $input;
    }

    /**
     * @param string $response_code
     * 
     * @return [type]
     */
    public function status(string $response_code)
    {
        return http_response_code($response_code);
    }

    /**
     * @param array $arr
     * 
     * @return [type]
     */
    public function json(array $arr)
    {
        echo json_encode($arr);
    }

    /**
     * @param string $file
     * 
     * @return [type]
     */
    public function render(string $file, array $data = [])
    {
        print $this->view_engine->render($file, $data);
    }

    /**
     * @param string $path
     * 
     * @return [type]
     */
    public function redirect(string $path)
    { 
        if($path === "back" || $path === "BACK"){
            $this->status(301);
            header("Location: ". $_SERVER['HTTP_REFERER']);
          
        } else {
            $this->status(301);
            header("Location: $path");
        }

        exit;
    }

    public function location(string $path)
    {
      
        header("Location: $path");
        exit;
    }

    /**
     * @param string $file
     * 
     * @return [type]
     */
    public function download(string $file)
    {
        if (file_exists($file)) {
            header("Content-Description: File Transfer");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=" . basename($file));
            header("Content-Transfer-Encoding: binary");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Pragma: public");
            header("Content-Length: " . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
    }

    /**
     * @param string $type
     * 
     * @return [type]
     */
    public function getContentType(string $type)
    {
        switch ($type) {
            case "html":
                header("Content-Type: text/html");
                break;
            case ".html":
                header("Content-Type: text/html");
                break;
            case "json":
                header("Content-Type: application/json");
                break;
            case 'jpeg':
                header('Content-Type: image/jpeg');
                break;
            case 'png':
                header('Content-Type: image/png');
                break;
            case "application/json":
                header("Content-Type: application/json");
                break;
            default:
                header("Content-Type: " . $type);
                break;
        }
    }
}
