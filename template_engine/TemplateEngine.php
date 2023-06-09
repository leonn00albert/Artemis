<?php
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
            throw new Exception('Template not found: ' . $template);
        }
        
        extract($data);
        
        ob_start();
        include $templatePath;
        $output = ob_get_clean();
        
        return $output;
    }
}

$templateDir = '/path/to/templates';
$templateEngine = new TemplateEngine($templateDir);

$data = [
    'title' => 'My Website',
    'heading' => 'Welcome to My Website',
    'content' => 'This is the content of my website.',
];

$output = $templateEngine->render('example_template', $data);
echo $output;