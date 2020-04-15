<?php
$canonical_link = '';
$title = '';
$meta_description = '';
$current = 'second-page';
$title_text_page_header = '';
$description_text_page_header = '';
$subtitle_text_page_header = '';
$url_banner_left_page_header = '';
$url_banner_right_page_header = '';
?><!doctype html>
<html lang="en">
<head>
    <?php require_once('partials/_header-default-meta.php'); ?>
</head>
<body class="<?php echo htmlspecialchars($current) ?>">
<?php require_once('partials/_header.php'); ?>
<main>
    <?php require_once('partials/second-page/_section-six.php'); ?>
</main>
<?php require_once('partials/_footer.php'); ?>
<?php require_once('partials/_footer-default-js.php'); ?>
</body>
</html>
