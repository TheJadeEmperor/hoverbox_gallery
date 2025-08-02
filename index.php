<?php
include('hoverbox.php'); 
?>

<h1>Sample Image Gallery</h1><h3>Hover over image to see preview</h3><h3>Click image to open lightbox</h3>

<?php
$atts = array(
    'project_folder' => 'carousel',
    'project_name' => 'gallery 1'
);

echo gallery_function($atts);

?>

<p>&nbsp;</p>
<h1>Sample Video Gallery</h1>
<h3>Hover over video to unmute</h3><h3>Click video to go fullscreen</h3>

<?php
 
$atts = array(
    'project_folder' => 'sample_videos',
    'project_name' => 'gallery 2'
);

echo hoverbox_video($atts);

?>


</body>
</html>