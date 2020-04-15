<?php

/**
 * Description of View
 *
 * @author pes2704
 */
class Starter_View_View {
    
    private $templateFilePath;
    

    public function __construct($templateFilePath) {
        $this->templateFilePath = $templateFilePath;
    }
    
    public function render($data) {
        return $this->protectedIncludeScope($this->templateFilePath, $data);
    }

    private function protectedIncludeScope($includeFilePath, array $data) {
        
        try {
            $level = ob_get_level();
            extract($data);
            ob_start();
            include $includeFilePath; 
            $result = ob_get_clean();
        } catch (Throwable $e) {
            while (ob_get_level() > $level) {
                ob_end_clean();   
            }
            throw $e;
        } catch (Exception $e) {
            while (ob_get_level() > $level) {
                ob_end_clean();
            }
            throw $e;
        }    
        return $result;                         
    }   
}