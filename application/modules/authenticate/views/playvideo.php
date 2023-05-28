<!DOCTYPE html>
<html>
<body>
<script>
   
        var player =document.getElementById('movie');
        player.load();
</script>
<div id= "show">
	<video  id="movie" src="<?php echo $video;?>" height="100%" width="100%" controls autoplay > </video>
</div>


</body>
</html>

