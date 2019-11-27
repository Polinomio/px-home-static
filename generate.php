<?php
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

$destination = get_option('px_home_static_destination'); 
$returnTo = admin_url('options-general.php?page=px_home_static');

$data = file_get_contents(get_site_url());
$filename = $destination . '/index.html';
$handle = fopen($filename,"w");
fwrite($handle, $data);
fclose($handle);

echo '<script>location.href = "'.$returnTo.'"</script>';