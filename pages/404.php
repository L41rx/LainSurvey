<?php http_response_code(404); ?>
<html>
<head>
    <?php require('head_includes/global_gatg_js.php'); ?>
</head>
<body style="display: flex; margin: 0; padding: 0; height: 100vh; justify-content: center; align-items: center; flex-direction: column;">
<h1>404</h1>
<?php if (isset($failed_route)) { ?>
<p>Sorry. We couldn't locate '<?php echo $failed_route; ?>'.</p>
<p>It can't have been that important...</p>
<?php } ?>
<p>¯\_(ツ)_/¯</p>
</body>
</html>