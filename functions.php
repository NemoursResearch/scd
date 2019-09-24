<?php

add_action('wp_enqueue_scripts', 'scdScripts');
function scdScripts()
{
    wp_enqueue_style('avada-styles', get_theme_root_uri() . '/Avada/style.css');
    wp_enqueue_style('scd-styles', get_stylesheet_directory_uri() . '/style.css', false, '1.0', 'all');
}

add_action('wp_enqueue_scripts', 'avada_scripts');

add_shortcode('scd_json', 'scdJsonFile');

function scdJsonFile($atts)
{
    $jsonFile = $atts['file'] ?? false;
    if (!$jsonFile) {
        return '';
    }
    
    $dir = dirname(__FILE__) .'/';
    $jsonFile = $dir . 'json/' . $jsonFile;
    if (!file_exists($jsonFile)) {
        return 'File does not exist! ' . $jsonFile;
    }
    
    try {
        // format json
        $json = file_get_contents($jsonFile);
        if (is_null($json)) {
            throw new Exception('Error getting contents of file!');
        }
        $json = json_decode($json);
        if (is_null($json)) {
            throw new Exception('Error decoding json!');
        }
        
        // sort
        $years = [];
        foreach ($json as $item) {
            $years[$item->year][] = $item;
        }
        unset($item);
        
        ob_start();
        include_once($dir . 'tpl-json.php');
        $html = ob_get_contents();
        ob_end_clean();
        
        return $html;
    } catch (\Exception $e) {
        return $e->getMessage();
    }
}
