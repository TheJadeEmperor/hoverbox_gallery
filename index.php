<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoverbox Gallery for Images & Videos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="hoverbox.js"></script>
    <link rel="stylesheet" href="hoverbox.css">

    <script>
    $(document).ready(function(){
        let vidArray = $(".hoverbox_video");

        //console.log(vidArray);

        $(vidArray).hover(function(){

        console.log($(this));
            $(this)[0].muted = false;
        });


        $(vidArray).mouseleave(function() {  
            $(this)[0].muted = true;
        });
 
    });  


</script>

</head>
<body>
<p>&nbsp;</p>

<?php
 

function gallery_function($atts) {
    $anime = $atts['project_folder'];
    $postTitle = $atts['project_name'];

    $divID = str_replace('/', '_',  $anime);

    $directory = $anime;

    //valid image extensions
    $validFiles = array('jpg', 'jpeg', 'png');
    
    $counter = 1; //images counter
    if(is_dir($directory))
    if ($handle = opendir($directory)) { //read all files in directory
        //List all the files
        while (false !== ($file = readdir($handle))) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if(in_array($ext, $validFiles)) {   
                $small[$counter] = $file; //add image to array
                $counter++; //increase counter
            }
        }//while
        closedir($handle);
    }//if

    sort($small); //sort image names in order

    //sorting adds a 0 element and shifts all elements back 1
    //this will fix the array 
    foreach ($small as $num => $picture) {
        $small[$num+1] = $picture; 
    }
    unset($small[0]); //delete 0 element

    //    print_r($small); exit;

    //check for thumbnails
    if(is_dir($directory.'/thumbnails')) $showThumbnails = 1;

    $galleryContent .= '
	<table><tr valign="top"><td>
	<ul class="hoverbox">';
    
	foreach($small as $num => $picture) {
		//$num = $num + 1; //offset the 0 element    
		list($name, $ext) = explode('.', $picture); 
		
            if($showThumbnails) {
                $readThisImg = $directory.'/'.$picture;
                $showThisImg = $directory.'/thumbnails/'.$picture;
            }
            else    
                $showThisImg = $readThisImg = $directory.'/'.$picture;
			//$showThisImg = $site_url.'/'.$directory.'/'.$picture;
			
			if(file_exists($readThisImg)) {
				list($width, $height, $type, $attr) = getimagesize($readThisImg);

				if($thumbnails == 1) {
					$galleryContent .= '<li title="'.$anime.'" onclick="openModal(\''.$divID.'\');currentSlide('.$num.')"><a href="#">
					<img src="'.$showThisImg.'" alt="'.$anime.'" class="episode_thumbnail" />
					<img src="'.$showThisImg.'" class="preview_large" alt="'.$anime.'" >
					</a></li>'; 
				}
				else {
                    
                    if($height > $width)
                        $class = 'preview_tall';
                    else
                        $class = 'preview_portrait';
        
					$galleryContent .= '<li title="'.$anime.'" onclick="openModal(\''.$divID.'\');currentSlide('.$num.')"><a>
					<img src="'.$showThisImg.'" alt="'.$anime.'" />
					<img src="'.$showThisImg.'" class="'.$class.'" alt="'.$anime.'" >
					</a></li>'; 
				}					
		   }      
        }//foreach
 
    $galleryContent .= '</ul></td>
    </tr></table>';

    $counter = $counter - 1; //JS arrays start at 0
 
    //display the modal elements
    $galleryContent .=  '<div id="'.$divID.'" class="modal">
    <a class="close cursor" onclick="closeModal(\''.$anime.'\')">&times;</a>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    <div class="modal-content">';

    foreach($small as $num => $picture) {
        $showThisImg = $directory.'/'.$picture;
        $galleryContent .=  '<div class="mySlides">
        <div class="numbertext">'.$num.' / '.$counter.'</div>
        <img src="'.$showThisImg.'" onclick="plusSlides(1)" class="lightbox_main_image cursor">
        </div>';
    }
    $galleryContent .=  '<div class="caption-container">
    <p id="caption">'.$postTitle.'</p>
    </div>
    </div>
    </div>';

    return $galleryContent;
}


function hoverbox_video ($atts) {

    $directory = $atts['project_folder'];

    $validFiles = array('mp4', 'webm', 'avi');

    
    if(is_dir($directory))
    if ($handle = opendir($directory)) { //read all files in directory
        //List all the files
        while (false !== ($file = readdir($handle))) {
            
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if(in_array($ext, $validFiles)) {   
                
               $return .='<video autoplay muted loop class="hoverbox_video">
        <source src="'.$directory.'/'.$file.'" type="video/mp4" />
    </video>';
            }
        }//while
        closedir($handle);
    }//if
    return $return;
}


$atts = array(
    'project_folder' => 'carousel',
    'project_name' => 'gallery 1'
);

echo gallery_function($atts);


?>

<p>&nbsp;</p>

<?php
 

$atts = array(
    'project_folder' => 'sample_videos',
    'project_name' => 'gallery 2'
);

echo hoverbox_video($atts);





?>




</body>
</html>