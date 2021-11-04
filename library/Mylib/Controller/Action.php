<?php
class Mylib_Controller_Action extends Zend_Controller_Action
{

    public function init()
    {

        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
    }
    public function loadTemplate($template_path, $fileConfig = 'template.ini', $sectionConfig = 'template')
    {

        $fileName = $template_path . "/" . $fileConfig;
        $section = $sectionConfig;
        $config = new Zend_Config_Ini($fileName, $section);

        $config = $config->toArray();

        $baseUrl = $this->_request->getBaseUrl();
        $templateUrl = $baseUrl . $config['url'];
        $cssUrl = $templateUrl . $config['dirCss'];
        $jsUrl = $templateUrl . $config['dirJs'];
        $imgUrl = $templateUrl . $config['dirImg'];

        //nạp title
        $this->view->headTitle($config['title']);
        //nạp meta
        if (count($config['metaHttp']) > 0) {
            foreach ($config['metaHttp'] as $key => $value) {
                $tmp = explode("|", $value);
                $this->view->headMeta()->appendHttpEquiv($tmp[0], $tmp[1]);
            }
        }
        if (count($config['metaName']) > 0) {
            foreach ($config['metaName'] as $key => $value) {
                $tmp = explode("|", $value);
                $this->view->headMeta()->appendName($tmp[0], $tmp[1]);
            }
        }
        //nap css
        if (count($config['fileCss']) > 0) {
            foreach ($config['fileCss'] as $key => $css) {
                $this->view->headLink()->appendStylesheet($cssUrl . $css, 'screen');
            }
        }

        //nạp js
        if (count($config['fileJs']) > 0) {
            foreach ($config['fileJs'] as $key => $Js) {
                $this->view->headScript()->appendFile($jsUrl . $Js, 'text/javascript');
            }
        }

        $this->view->templateUrl = $templateUrl;
        $this->view->cssUrl = $cssUrl;
        $this->view->jsUrl = $jsUrl;
        $this->view->imgUrl = $imgUrl;
        $option = array('layoutPath' => $template_path, 'layout' => $config['layout']);
        Zend_Layout::startMvc($option);
    }
}
