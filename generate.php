<?php
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

$destination = get_option('px_home_static_destination'); 
$returnTo = admin_url('options-general.php?page=px_home_static');

$data = file_get_contents(get_site_url());
$filename = $destination . DIRECTORY_SEPARATOR . 'index.html';
$handle = fopen($filename, "w");

if ($handle) {
    fwrite($handle, $data);
    fclose($handle);
} else {
    $returnTo .= '&error=cant_write';
}

echo '<script>location.href = "'.$returnTo.'"</script>';