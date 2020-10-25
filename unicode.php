<html><head>
	<title>Unicode - html</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="utf-8" />

	<link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAACXBIWXMAAAsTAAALEwEAmpwYAAAA
B3RJTUUH4QkMDRMwGeRdIwAAABl0RVh0Q29tbWVudABDcmVhdGVkIHdpdGggR0lNUFeBDhcAAABd
SURBVCjP1ZLBCsAgDENbKeT/vzg7CJ3UTPHgYZ7CM7G01knayWmSAgAgr7xXIOnuKVIX/gbM7MuU
uttCFJ1M+x6Om/5XICRdfH/IgRY45tv24QIj6XoLxWrcmtIDTac/PQPoDSQAAAAASUVORK5CYII="/>
	<link rel="stylesheet" type="text/css" href="unicode_style.css">
		
</head>
<body>

<?php

function uniord($u) {
    $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
    $k1 = ord(substr($k, 0, 1));
    $k2 = ord(substr($k, 1, 1));
    return $k2 * 256 + $k1;
}
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
function drawunicodes($data){
		foreach($data as $chardata){
			$chardata['html_code']=str_replace('&','&amp;',$chardata['html_code']);
			echo '<div class="item" title="'.$chardata['title'].'">';	
				echo '<li class="car">'.$chardata['symbol'].'</li>';		
				echo '<li class="code" onclick="prompt(\'Copy this html code\',\''.$chardata['html_code'].';\');">'.$chardata['html_code'].'</li>';
			echo '</div>';

		}
	
}

function searchIn($in,$search){
	$search=preg_split('#[, ]#',$search);
	foreach ($search as $value) {
		if (stripos($in,$value)!==false){
			return true;
		}
	}
	return false;
}

$unicode_data=json_decode(file_get_contents('unicode_list.json'),true);
ksort($unicode_data);

$names=array_keys($unicode_data);
$nb_caracteres=0;
foreach ($unicode_data as $group) {
	$nb_caracteres+=count($group);
}
$search='';
$favoris=['symbole','math','fleche','carre','cercle','triangle','coeur','etoile','coeur','filet','forme','emoticone personne face','encadre cercle squared regional','domino carte majong jeu'];
 
if (!empty($_GET['search'])){
	$search=unHack($_GET['search']);
	$founded=[];
	foreach ($unicode_data as $block=>$data) {
		if (searchIn($block,$search)!==false){				
				$founded=array_merge($founded,$data);
			}else{
				foreach ($data as $item) {
					if (searchIn($item['title'],$search)){				
						$founded[]=$item;
					}
				}
			}
		
	}

	$unicode_data['Resultat']=$founded;
	$name='Resultat';
}

if (!empty($_GET['set'])){
	$name=unHack($_GET['set']);
	if (empty($unicode_data[$name])){
		$name='';
	}
}
if (empty($name)){
	$name='Emoticones';
}
$data=$unicode_data[$name];
?>
<header>

	<div class="right" id="search">
		<form action="#" method="GET">
			<div>
				<input type="text" name="search" placeholder="Rechercher" value="<?php echo $search;?>"/>
				<span>🔍</span>
			</div>
		</form>
	</div>
	
</header>
<h1><?php echo $name;?></h1>
<nav onclick="toggle_class(this,'open');">
	<div class="icon">☰</div>
	<h2>Favoris</h2>
	<?php
		foreach ($favoris as  $value) {
			echo '<a href="?search='.$value.'"> '.$value.' </a>';
		}
	?>	
	<h2>Groupes</h2>

	<?php
	foreach ($names as  $value) {
		echo '<a href="?set='.$value.'"> '.$value.' </a>';
	}
	?>	

</nav>
<?php 
	drawunicodes($data);
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

<footer>unicode v3 by warriordudimanche.net - <?php echo $nb_caracteres; ?> caractères dans <?php echo count($names); ?> groupes</footer>
</body></html>
