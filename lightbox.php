<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="lightbox.js"></script>
<link rel="stylesheet" href="lightbox.css">
<!--<script src="hoverbox.css"></script>-->


<p>&nbsp;</p>
<?php
//a wordpress function that returns the url 
function get_site_url() { //it needs to be defined here
    return 'http://localhost/lightbox_gallery';
}

function gallery_function ($directory) {

    $postTitle = 'this anime'; 
  
    $site_url = get_site_url();
    $anime = $directory;
  
    $animeID = str_replace('/', '_', $anime); //ID for div's

    //valid image extensions
    $validFiles = array('jpg', 'png', 'jpeg');

    $counter = 1;  //images counter
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

    sort($small); //sort images in order

    $galleryContent .=  '<div class="row">';
    foreach($small as $num => $picture) {
        $showThisImg = $site_url.'/'.$directory.'/'.$picture;
        $galleryContent .=  '<div class="column">
        <img src="'.$showThisImg.'" onclick="openModal(\''.$animeID.'\');currentSlide('.$num.')" class="hover-shadow cursor">  
        </div>';
    }
    $galleryContent .=  '</div>';

    $counter = $counter-1;

    //display the modal elements
    $galleryContent .=  '<div id="'.$animeID.'" class="modal">
    <span class="close cursor" onclick="closeModal(\''.$animeID.'\')">&times;</span>
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
    <div class="modal-content">';

    foreach($small as $num => $picture) {
    $showThisImg = $site_url.'/'.$directory.'/'.$picture;
    $galleryContent .=  '<div class="mySlides">
        <div class="numbertext">'.$num.' / '.$counter.'</div>
        <img src="'.$showThisImg.'" onclick="plusSlides(1)" class="lightbox_main_image cursor">
        </div>';
    }
    $galleryContent .=  '<div class="caption-container">
    <p id="caption"></p>
    </div>';

    //horizontal scrolling images
    foreach($small as $num => $picture) {
    
        $showThisImg = $site_url.'/'.$directory.'/'.$picture;
        $galleryContent .=  '<div class="column">
        <img class="demo cursor" src="'.$showThisImg.'" style="width:100%" onclick="currentSlide('.$num.')" alt="'.$postTitle.'">
        </div> ';
    }

    $galleryContent .=  '</div>
    </div>';
    
    return $galleryContent; 
}

$directory = 'anime/folder1';
echo gallery_function($directory);

$directory = 'anime/folder2';
echo gallery_function($directory);

?>