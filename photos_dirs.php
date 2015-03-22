<?
$prefix = '/volume1/Photos';

$accessToken = trim(file($prefix.'/php-access-token.txt')[0]);
if ($_GET['accessToken'] != $accessToken) {
    header("HTTP/1.0 403 Forbidden");
    echo "Forbidden";
    return;
}

$dir = $_GET['dir'];
header('Content-type: text/plain; charset=utf8');
header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($prefix)).' GMT');

chdir($prefix);
if (strpos(realpath(dirname($dir) ? dirname($dir) : '.'), $prefix) !== 0) return;
$dir = escapeshellarg($dir);

passthru("find $dir* -type d -maxdepth 1");
?>
