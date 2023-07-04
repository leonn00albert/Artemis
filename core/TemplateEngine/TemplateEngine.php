<?php
namespace Artemis\Core\TemplateEngine;
use Exception;
class TemplateEngine
{
    protected $templateDir;
    
    public function __construct($templateDir)
    {
        $this->templateDir = $templateDir;
    }
    
    public function render($template, $data = [])
    {
        $templatePath = $this->templateDir . '/' . $template . '.php';
        
        if (!file_exists($templatePath)) {
            print $this->templateDir;
            throw new Exception('Template not found: ' . $template);
        }
        
        extract($data);
        
        ob_start();
        include $templatePath;
        $output = ob_get_clean();
        
        return $output;
    }
}

