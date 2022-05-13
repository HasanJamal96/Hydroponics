<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/toplinks.php'); ?>
</head>

<body>
    <?php include('includes/navigation.php'); ?>
<script
  src="https://code.jquery.com/jquery-1.11.3.min.js"
  integrity="sha256-7LkWEzqTdpEfELxcZZlS6wAx5Ff13zZ83lYO2/ujj7g="
  crossorigin="anonymous"></script>

<script>
    $(function(){

	/* Customize speed options here */
	var tl = {
		'speeds': {
			'Very_Fast': 100,
			'Fast': 200,
			'Medium': 500,
			'Slow': 1000,
			'Very_Slow': 2000
		},
		'advancing': false,
		'img':[],
		'currFrame': 0,
		'fadeTime': 500,
		'sitTime': 0,
		'framefront':false,
		'frameback':false,
		'si': 'false'
	};

	var f = $('#mTimeLapse');

	if(f){
		// Setup
		tl.img = f.children('img');
		f.before('<div id="frames"><img id="frame_back"/><img id="frame_front"/></div><div id="controls"><div id="data_stamp"></div><br></div></div>');

		var c = $('#controls');
		c.append('<input type="button" value="Pause" id="pausebutton" onclick="toggleAdvance();"/><br>');
		for(var s in tl.speeds){ if(tl.speeds.hasOwnProperty(s)){
			c.append('<input type="button" value="' + (s.replace(/_/g, ' ') + '" onclick="setSpeed(\'' + s + '\');"/>'));
		}}

		// Go
		tl.framefront = $('#frame_front');
		tl.frameback = $('#frame_back');
		advance();
	}

	function advanceFrame() {
		// console.log('Advancing, currframe is ' + tl.currFrame);

		tl.frameback.attr('src', getFrameAttribute('src'));
		tl.currFrame = ((tl.currFrame + 1) % tl.img.length);
		tl.framefront.attr('src', getFrameAttribute('src'));
		tl.framefront.css({'opacity': 0.0});
		tl.framefront.animate({'opacity': 1.0},{'duration': tl.fadeTime, 'queue':false});

		$('#data_stamp').html(getFrameAttribute('data-stamp'));
		// console.log('\t\t>done');
	}

	function getFrameAttribute(attr) {
		var s = tl.img[tl.currFrame].getAttribute(attr);

		//logging
		// console.log(tl.img[tl.currFrame]);
		// console.log(`${attr} returns ${s}`);

		return s || '';
	}

	function advance() {
		window.clearInterval(tl.si);
		// console.log('Advancing, si=' + tl.si);
		tl.advancing = true;
		$('#pausebutton').attr('value', 'Pause');
		tl.si = setInterval(advanceFrame, (tl.fadeTime + tl.sitTime));
	}

	window.setSpeed = function(name) {
		// console.log('setSpeed ' + name);
		tl.fadeTime = tl.speeds[name] || 500;
		advance();
	};

	window.toggleAdvance = function() {
		tl.advancing = !tl.advancing;
		// console.log('ToggleAdvance - advancing = ' + tl.advancing);

		if(tl.advancing) advance();
		else {
			window.clearInterval(tl.si);
			// console.log('clearInterval cancelled for ' + tl.si);
			$('#pausebutton').attr('value', 'Play');
		}
	};
});
</script>


<!-- Content   offers -->
<div class="main">
  <style>

input {
	background-color: slategray;
	padding:4px 12px;
	margin:4px;
	width:100px;
	color: rgb(183,185,182);
	border:0px;
}

input:hover {
	cursor: pointer;
	color:white;
}

#frames {
	width:70%;
}

#frame_front,
#frame_back {
	position: absolute;
	top:50px;
	left:100px;
	width:60%;
	height:500px;
	margin-left:20%;
}

#controls {
display: grid;
    width: 100%;
    position: initial;
    bottom: 60px;
    left: 25%;
    color: slategray;
    margin: 10px auto;
}

#data_stamp {
	font-family: monospace;
}

#mTimeLapse {
	display: none;
}
      
  </style>
  
  <?php  if(count($images_data)>0){ ?>
	<div id="mTimeLapse">
<?php foreach ($images_data as $img){ ?>
		<img src="<?php echo $img['image_url']; ?>" data-stamp="<?php echo $img['time']; ?>"/>
<?php } ?>

</div>
<?php }else{ ?>
<div class="alert alert-success">
  <strong>Sorry!</strong> Frame has not avaiable between in these dates .
</div>
<?php } ?>


    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>
   
   
   
   
</body>

</html>