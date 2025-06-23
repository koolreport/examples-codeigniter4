<?php

function getRootPath()
{
    return str_replace("\\","/",realpath(dirname(dirname(__FILE__))));
}

function getRootUrl()
{
    $document_root = $_SERVER["DOCUMENT_ROOT"];
    $script_name = dirname($_SERVER["SCRIPT_NAME"]);
    // echo "document_root=$document_root<br>";
    // echo "script_name=$script_name<br>";
    // echo "<pre>" . json_encode($_SERVER, JSON_PRETTY_PRINT) . "</pre>";
    // exit;
    $root_url = $script_name;
    while(!is_file($document_root.$root_url."/reports.json"))
    {
        $root_url = dirname($root_url);
    }
    return $root_url;
}

function getScriptFile()
{
    if (isset($_SERVER['SCRIPT_FILENAME'])) {
        return $_SERVER['SCRIPT_FILENAME'];
    }

    throw new \Exception('Unable to determine the entry script file path.');
}

function getScriptUrl()
{
    $scriptFile = getScriptFile();
    $scriptName = basename($scriptFile);
    if (isset($_SERVER['SCRIPT_NAME']) && basename($_SERVER['SCRIPT_NAME']) === $scriptName) {
        $scriptUrl = $_SERVER['SCRIPT_NAME'];
    } elseif (isset($_SERVER['PHP_SELF']) && basename($_SERVER['PHP_SELF']) === $scriptName) {
        $scriptUrl = $_SERVER['PHP_SELF'];
    } elseif (isset($_SERVER['ORIG_SCRIPT_NAME']) && basename($_SERVER['ORIG_SCRIPT_NAME']) === $scriptName) {
        $scriptUrl = $_SERVER['ORIG_SCRIPT_NAME'];
    } elseif (isset($_SERVER['PHP_SELF']) && ($pos = strpos($_SERVER['PHP_SELF'], '/' . $scriptName)) !== false) {
        $scriptUrl = substr($_SERVER['SCRIPT_NAME'], 0, $pos) . '/' . $scriptName;
    } elseif (!empty($_SERVER['DOCUMENT_ROOT']) && strpos($scriptFile, $_SERVER['DOCUMENT_ROOT']) === 0) {
        $scriptUrl = str_replace([$_SERVER['DOCUMENT_ROOT'], '\\'], ['', '/'], $scriptFile);
    } else {
        throw new \Exception('Unable to determine the entry script URL.');
    }

    return $scriptUrl;
}
// echo getScriptUrl() . "<br>";
$menu = json_decode(file_get_contents(realpath(dirname(__FILE__))."/../reports.json"),true);
// $root_url = getRootUrl();
// $root_url = rtrim(dirname(getScriptUrl()), '\\/');
$root_url = base_url();
// echo "root_url: $root_url<br>";
