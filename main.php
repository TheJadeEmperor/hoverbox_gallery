<!DOCTYPE html> 
<html> 
<body> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 
<video id="myVideo" width="320" height="176" controls autoplay muted class="hoverbox_video">
  <source src="sample_videos/BLWS_ad_web_design.mp4" type="video/mp4"> 
  Your browser does not support HTML5 video.
</video>

<video width="320" height="176" controls autoplay muted class="hoverbox_video">
  <source src="sample_videos/BLWS_ad_web_design.mp4" type="video/mp4"> 
  Your browser does not support HTML5 video.
</video>


<script>
  let vidArray = $(".hoverbox_video");
  
  //console.log(vidArray);

  $(vidArray).hover(function(){

      console.log($(this));
      $(this)[0].muted = false;
  });


  $(vidArray).mouseleave(function() {  
    $(this)[0].muted = true;
  });
 
 
</script> 
 
</body> 
</html>
