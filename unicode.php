<html><head>
	<title>Unicode - html</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="utf-8" />
	<style>
	*{-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
	html{padding:0;}
	body{background:#444;padding:0;text-align:center;}
	h1{
		padding:20px;
		margin:0;
		background:rgba(255,255,255,0.5);
		color:rgba(0,0,0,0.7);
		text-shadow: 0 1px 1px rgba(255,255,255,0.2);
		border-radius:3px;
		box-shadow: 0 1px 2px rgba(0,0,0,0.5)
	}
	h2{
		padding:10px;
		margin:0;
		color:rgba(255,255,255,0.9);
		text-shadow: 0 1px 1px rgba(0,0,0,0.2);		
	}
	.item{
		border-top:1px solid rgba(255,255,255,0.3);
		border-bottom:1px solid rgba(0,0,0,0.3);
		box-shadow: 0 1px 1px rgba(0,0,0,0.3);
		overflow:hidden;text-align:center;
		display:inline-block;width:64px;height:96px;
		border-radius:3px;margin:10px;padding:5px;
		background: rgba(255,255,255,0.8);
		vertical-align: bottom
	}
	.item li{list-style: none;display:inline-block;vertical-align: bottom}

	.car{font-size:50px;color:rgba(0,0,0,0.8);}
	.code{cursor:pointer;font-family:monospace, courrier;font-size:12px;color:rgba(0,0,0,0.5);padding:2px;margin-top:5px;}
	nav{
		cursor:pointer;
		position:fixed;
		width:200px;
		height:100%;
		background: rgba(0,0,0,0.8);
		left:-190px;
		top:0;
		padding-right:20px;

	}
	nav.open{left:0;}
	nav a{
		text-decoration: none;
		display:block;
		padding:5px;
		color:#aaa;
	}
	nav a:hover{color:white;}
	nav{transition:left 300ms;}
	</style>
		
</head>
<body>

<?php
$start=33;$end=20000;
if (!empty($_GET['start'])){
	$start=strip_tags($_GET['start']);
}
if (!empty($_GET['end'])){
	$end=strip_tags($_GET['end']);
}
?>
<h1>HTML codes from <?php echo $start;?> to <?php echo $end;?></h1>
<nav onclick="toggle_class(this,'open');">
	<h2>Choose a set</h2>
	<br/>
	<a href="?start=9472&end=9599"> Box drawing </a>
	<a href="?start=8592&end=8703"> Arrows </a>
	<a href="?start=9632&end=9727"> Geometric shapes </a>
	<a href="?start=9728&end=9983"> Symbols </a>
	<a href="?start=8704&end=8959"> Maths </a>
	<a href="?start=9984&end=10175"> Dingbats </a>
	<a href="?start=128&end=591"> Latin extended </a>
	<a href="?start=8448&end=8527"> Letter like symbols </a>
	<a href="?start=688&end=767"> Space modified letters </a>
	<a href="?start=8192&end=8303"> Punctuations </a>

</nav>
<?php

for ($code=$start;$code<$end;$code++){
	echo '<div class="item">';
		echo '<li class="car">&#'.$code.';</li>';		
		echo '<li class="code" onclick="prompt(\'Copy this html code\',\'&amp;#'.$code.';\');">&amp;#'.$code.';</li>';
	echo '</div>';

}


?>
<script>
function toggle_class(el,cl){
		if (el.classList) {
		    el.classList.toggle(cl)
		} else {
		    var classes = el.className.split(' ')
		    var existingIndex = classes.indexOf(cl)
		    if (existingIndex >= 0)
		      classes.splice(existingIndex, 1)
		    else
		      classes.push(cl);
		    el.className = classes.join(' ')
		}
		return false;
	}
</script>

<footer>html entities by warriordudimanche.net</footer>
</body></html>