<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $title ?></title>
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:url" content="<?php echo $full_url; ?>">
<?php
foreach ($include_js as $js) {
  echo "<script src=\"js/$js.js\"></script>";
}
foreach ($include_styles as $css) {
  echo "<link rel=\"stylesheet\" href=\"style/$css.css\">";
}
?>
