<?php
require 'includes/renderer/xml.php';
require 'includes/renderer/json.php';
require 'includes/media.php';

if (isset($_GET['model'])) {
    $filename = 'includes/' . strtolower($_GET['model']) . '.php';
    if (file_exists($filename)) {
        $model = $_GET['model'];
    } else {
        echo "The model " . $_GET['model'] . " does not exist";  
    }
} else {
    $model = 'media';
}

if (isset($_GET['function'])) {
    $function = $_GET['function'];
} else {
    $function = 'get_all_media';
}

$param = @$_GET['param'];

if (isset($_GET['format'])) {
    $filename = 'includes/renderer/' . strtolower($_GET['format']) . '.php';
    if (file_exists($filename)) {
        $renderer = new $_GET['format']($model, $function, $param);
        echo $renderer->response;
    } else {
        echo "The renderer " . $_GET['format'] . " does not exist";
    }
} else {
    $JSON = new JSON($model, $function, $param);
    echo $JSON->response;
}
?>