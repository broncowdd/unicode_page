<html><head>
	<title>Unicode - html</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAACXBIWXMAAAsTAAALEwEAmpwYAAAA
B3RJTUUH4QkMDRMwGeRdIwAAABl0RVh0Q29tbWVudABDcmVhdGVkIHdpdGggR0lNUFeBDhcAAABd
SURBVCjP1ZLBCsAgDENbKeT/vzg7CJ3UTPHgYZ7CM7G01knayWmSAgAgr7xXIOnuKVIX/gbM7MuU
uttCFJ1M+x6Om/5XICRdfH/IgRY45tv24QIj6XoLxWrcmtIDTac/PQPoDSQAAAAASUVORK5CYII="/>
	<style>
	*{-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}
	html{padding:0;}
	body{margin:0;background:#eee;padding:0;text-align:center;font-family: "Lucida Grande","Arial Unicode MS", sans-serif;}
	h1{
		padding:20px;
		margin:0;
		background:rgba(255,255,255,0.5);
		color:rgba(0,0,0,0.7);
		text-shadow: 0 1px 1px rgba(255,255,255,0.2);
		box-shadow: 0 1px 2px #eee;
	}
	h2{
		padding:10px;
		margin:0;
		color:#222;
		text-shadow: 0 0 1px rgba(0,0,0,0.2);		
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
	.code{top: -7px;position:relative;cursor:pointer;font-family:monospace, courrier;font-size:12px;color:rgba(0,0,0,0.5);padding:2px;margin-top:5px;}
	nav{
		cursor:pointer;
		position:fixed;
		width:200px;
		height:100%;
		background: rgba(255,255,255,0.9);
		box-shadow: 2px 0 5px rgba(0,0,0,0.3);
		left:-190px;
		top:0;
		padding-right:20px;
		text-align:left;
		z-index: 10;
	}
	nav.open{left:0;}
	nav a{
		text-decoration: none;
		display:block;
		border-right:1px solid rgba(0,0,0,0.2);
		padding:5px;
		color:#444;
		text-transform: capitalize;
	}
	nav a:hover{color:black;}
	nav{transition:left 300ms;}
	</style>
		
</head>
<body>

<?php
function unHack($data){
		if (is_string($data)){
			$data=strip_tags($data);
			$data=str_replace(array('/','\\','[',']','{','}',',',';',':','$','='),'',htmlentities(strip_tags($data), ENT_QUOTES));
			return $data;
		}
		if (is_array($data)){
			return array_map('unHack',$data);
		}
	}
function drawunicodes($start=0,$end=0){
	for ($code=$start;$code<$end;$code++){
		echo '<div class="item">';
			echo '<li class="car">&#'.$code.';</li>';		
			echo '<li class="code" onclick="prompt(\'Copy this html code\',\'&amp;#'.$code.';\');">&amp;#'.$code.';</li>';
		echo '</div>';

	}
}
$sets=[
	'maths'				=>		['2100'=>'214f','2150'=>'218b','2200'=>'22ff','27c0'=>'27ef','2980'=>'29ff','2a00'=>'2aff'],
	'technique'			=>		['2300'=>'23ff'],
	'filets'			=>		['2500'=>'257f'],
	'formes'			=>		['2580'=>'259f','25A0'=>'25FF','2b12'=>'2b2f','2b50'=>'2b59',],
	'symboles'			=>		['2600'=>'26ff','2700'=>'27bf'],
	'symboles2'			=>		['1f300'=>'1f5ff'],
	'braille'			=>		['2800'=>'28ff'],
	'plein'				=>		['ff00'=>'ffef'],
	'exposants-indices'	=>		['2070'=>'209c'],
	'monnaies'			=>		['20a0'=>'20be'],
	'fleches'			=>		['27f0'=>'27ff','2798'=>'27be','2190'=>'21ff','2b30'=>'2b4c','2b00'=>'2b11'],
	'entoures'			=>		['2460'=>'24ff','2776'=>'2793',],
	'glagolitique'		=>		['2c00'=>'2c5f'],
	'latin'				=>		['80'=>'24f','2c60'=>'2c7f'],
	'copte'				=>		['2c80'=>'2cff'],
	'georgien'			=>		['2d00'=>'2d2f'],
	'tifinagh'			=>		['2d30'=>'2d7f'],
	'ethiopien'			=>		['2d80'=>'2ddf'],
	'ponctuation'		=>		['2000'=>'206f','2e00'=>'2e7f'],
	'cjc'				=>		['2e80'=>'2eff'],
	'kangxi'			=>		['2f00'=>'2fdf'],
];
$sets_names=array_keys($sets);
natcasesort($sets_names);

$start=33;$end=20000;$name='';
if (!empty($_GET['start'])){
	$start=unHack($_GET['start']);
	if (isset($_GET['hex'])){
		$start=hexdec($start);
	}
}
if (!empty($_GET['end'])){
	$end=unHack($_GET['end']);
	if (isset($_GET['hex'])){
		$end=hexdec($end);
	}
}
if (!empty($_GET['set'])){
	$name=unHack($_GET['set']);
}

if (empty($name)){
?>

<h1>Caractères unicodes de <?php echo $start;?> à <?php echo $end;?></h1>
<?php 
}else{
?>
<h1>Caractères  <?php echo $name;?></h1>
<?php 
}

?>
<nav onclick="toggle_class(this,'open');">
	<h2>Choisissez un groupe</h2>
	<br/>
	<?php
	foreach ($sets_names as  $value) {
		echo '<a href="?set='.$value.'"> '.$value.' </a>';
	}
	?>

	
	<a href="?start=688&end=767"> Space modified letters </a>

</nav>
<?php 
if (empty($name)||empty($sets[$name])){
	drawunicodes($start,$end);
}else{
	foreach ($sets[$name] as $start => $end) {
		drawunicodes(hexdec($start),hexdec($end));
	}
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

<footer>unicode v2 by warriordudimanche.net</footer>
</body></html>
