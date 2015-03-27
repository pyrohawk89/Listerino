<!Doctype html>
<html>
	<head>
		<?php error_reporting(0); ?>
		<link rel="icon" type="image/png" href="/img/icon.png" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
			<!--<link href='http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>-->
		<link rel="stylesheet" type="text/css" href="/css/style.css" />

		<!--// So Meta //-->
		<meta charset="UTF-8" />
		<meta name="robots" content="noindex">
		<meta name="apple-mobile-web-app-title" content="Listerino | <?php echo $page; ?>" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<link rel="apple-touch-icon" href="/img/icon.png" sizes="57x57" />
		<link rel="apple-touch-icon" href="/img/icon.png" sizes="72x72" />
		<link rel="apple-touch-icon" href="/img/icon.png" sizes="76x76" />
		<link rel="apple-touch-icon" href="/img/icon.png" sizes="114x114" />
		<link rel="apple-touch-icon" href="/img/icon.png" sizes="120x120" />
		<link rel="apple-touch-icon" href="/img/icon.png" sizes="144x144" />
		<link rel="apple-touch-icon" href="/img/icon.png" sizes="152x152" />
		<meta name="mobile-web-app-capable" content="yes" />
		<link rel="shortcut icon" sizes="196x196" href="/img/icon.png" />
		<link rel="shortcut icon" sizes="128x128" href="/img/icon.png" />
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="listerino" />
		<meta name="twitter:title" content="Listerino | Listing Thing" />
		<meta name="twitter:description" content="A list thing" />
		<meta name="twitter:image:src" content="/img/icon.png" />
		<meta property="og:title" content="Listerino | Listing Thing" />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="/img/icon.png" />
		<meta property="og:url" content="listerino" />
		<meta property="og:description" content="Listerino | Listing Thing" />
		<meta name="generator" content="FrontPage 4.0" />
		<meta name="description" content="Listing Thing" />
		<meta name="author" content="Giant Faggot" />
		<meta name="copyright" content="Yo Momma" />

		<script src="/js/tab.js"></script>
		<script type="text/javascript" src="/js/functions.js"></script>
		<script>
			var $buoop = {vs:{i:10,f:25,o:17,s:6},c:2};
			function $buo_f(){
			 var e = document.createElement("script");
			 e.src = "//browser-update.org/update.js";
			 document.body.appendChild(e);
			};
			try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
			catch(e){window.attachEvent("onload", $buo_f)}
		</script>
		<?php
			//functions
			function loadJSON($json, $assoc = true) {
				$json = file_get_contents($json);
				$json = json_decode($json, $assoc);
				return $json;
			}
			if(!isset($_GET['user']) || $_GET['user'] != "PyroHawk89" && $_GET['user'] != "xEpicBradx"){
				$page = "Home";
			} else {
				$page = $_GET['user'];
			}
			if(!isset($_GET['list'])){
				$listID = 0;
			} else {
				$listID = $_GET['list'];
			}
			if(!isset($_GET['type'])){
				$listTYPE = 0;
			} else {
				$listTYPE = $_GET['type'];
			}
		?>
		<title>Listerino | <?php echo $page; ?></title>
		<?php if($page == "Home"){ ?>
		<script>
			document.addEventListener('DOMContentLoaded', function(){
				var div = $('#example-tabs');
				var exampleTabs = new SimpleTabs(div);
			}, false);
		</script>
		<?php } ?>
	</head>

	<body>
		<div id="wrapped">
			<div id="side">
				<ul class="tabs group">
					<li<?php if( $page == 'Home' ){ echo ' class="active"'; } ?>>
						<a href="/"><img src="http://i.imgur.com/uk9jUHB.png" height="14"></a>
					</li>
					<li<?php if( $page == 'xEpicBradx' ){ echo ' class="active"'; } ?>>
						<a href="/xEpicBradx/0">Brad</a>
					</li>
					<li<?php if( $page == 'PyroHawk89' ){ echo ' class="active"'; } ?>>
						<a href="/PyroHawk89/0">Pyro</a>
					</li>
				</ul>
				<ul <?php if($page == "Home"){ echo "id='example-tabs'";} ?> class="nav">
					<?php
						if($page == "Home"){
					?>
					<li class="tab-one active">
						<a href="javascript:void(0)">Cat One</a>
					</li>
					<li class="tab-two">
						<a href="javascript:void(0)">Cat Two</a>
					</li>
					<li class="tab-three">
						<a href="javascript:void(0)">Cat Three</a>
					</li>
					<?php
						} else {
							?><li <?php if($_GET['list'] == 0){echo 'class="selected"';}?>><a href="<?php echo "/".$_GET['user']."/0"; ?>">Future Games</a></li><?php
						}
						if($page != "Home"){
							$json = loadJSON('http://'.$_SERVER['HTTP_HOST'].'/json/'.strtolower($_GET['user']).'.json');
							$id = 0;
							foreach ($json as $list) {
								if (is_array($list)) {
									if($id != 0){
										if($_GET['list'] == $id){
											echo '<li class="selected">';
										} else {
											echo '<li>';
										}
										echo '<a href="/'.$_GET['user'].'/'.$id.'/'.$list[0]['list_type'].'">'.$list[0]['list_name'].'</a><a class="remove" href="/update.php?action=remove_list&user='.$_GET['user'].'&list_id='.$id.'">X</a></li>';
									}
									$id++;
								}
							}
						}
						if($page != "Home"){
							?>
							<li>
								<form id="addList" action="/update.php">
									<input type="hidden" name="action" value="add_list"/>
									<input type="hidden" name="user" value="<?php echo $_GET['user']; ?>"/>
									<input type="text" name="name" placeholder="List Name" required>
									<input type="number" name="type" value="1" max="2" min="1">
									<button type="submit">✓</button>
								</form>
								<a href="#" class="add" onClick="toggle('addList');">New list</a>
							</li>
							<?php
						}
					?>
				</ul>
			</div>

			<div class="main">
				<table>
					<tbody>
						<?php
							if($page != 'Home' ){
								if($listID == 0){
									$id = 0;
									foreach( $json[0] as &$game ){
										global $id;
										echo '<tr>';
										echo 	'<td class="banner"><img src="'.$game['banner'].'"/></td>';
										echo 	'<td class="name"><a href="'.$game['url'].'">'.$game['name'].'</a></td>';
										echo 	'<td><p>'.$game['release'].'</p></td>';
										echo 	'<td class="remove"><a href="/update.php?action=remove&user='.$_GET['user'].'&item_id='.$id.'/'.$listID.'/'.$listTYPE.'">X</a></td>'; //to be done via ajax
										echo '</tr>';
										$id++;
									}
								} else if($listID != 0){
									if($listTYPE == 1){
										//List type 1 (1 Col)
										$id = 0;
										foreach ($json[$listID] as $list) {
											if (is_array($list)) {
												global $id;
												if($id != 0){
													echo '<tr>';
													echo 	'<td>'.$list['col1'].'</td>';
													echo 	'<td class="remove"><a href="/update.php?action=remove&user='.$_GET['user'].'&item_id='.$id.'/'.$listID.'/'.$listTYPE.'">X</a></td>';
													echo '</tr>';
												}
												$id++;
											}
										}
									} else if($listTYPE == 2){
										// list type 2 (2 Col)
										$id = 0;
										foreach ($json[$listID] as &$list) {
											if (is_array($list)) {
												global $id;
												if($id != 0){
													echo '<tr>';
													echo 	'<td>'.$list['col1'].'</td>';
													echo 	'<td>'.$list['col2'].'</td>';
													echo 	'<td class="remove"><a href="/update.php?action=remove&user='.$_GET['user'].'&item_id='.$id.'/'.$listID.'/'.$listTYPE.'">X</a></td>';
													echo '</tr>';
												}
												$id++;
											}
										}
									}
								}
							?>
								<tr>
									<td colspan="4">
										<?php if($listTYPE == 0){ ?>
											<form id="addItem" action="/update.php">
												<input type="hidden" name="action" value="add"/>
												<input type="hidden" name="type" value="0"/>
												<input type="hidden" name="user" value="<?php echo $_GET['user']; ?>"/>
												<input type="hidden" name="list" value="<?php echo $_GET['list']; ?>"/>

												<input type="url" name="banner" placeholder="Banner URL">
												<input type="text" name="name" placeholder="Game Name" required>
												<input type="url" name="url" placeholder="Website">
												<input type="text" name="release" placeholder="Release Date">
												<button type="submit">✓</button>
											</form>
										<?php } elseif($listTYPE == 1){ ?>
											<form id="addItem" action="/update.php">
												<input type="hidden" name="action" value="add"/>
												<input type="hidden" name="type" value="1"/>
												<input type="hidden" name="user" value="<?php echo $_GET['user']; ?>"/>
												<input type="hidden" name="list" value="<?php echo $_GET['list']; ?>"/>

												<input type="text" name="col1" class="large" required>
												<button type="submit">✓</button>
											</form>
										<?php } elseif($listTYPE == 2){ ?>
											<form id="addItem" action="/update.php">
												<input type="hidden" name="action" value="add"/>
												<input type="hidden" name="type" value="2"/>
												<input type="hidden" name="user" value="<?php echo $_GET['user']; ?>"/>
												<input type="hidden" name="list" value="<?php echo $_GET['list']; ?>"/>

												<input type="text" name="col1" required>
												<input type="text" name="col2" required>
												<button type="submit">✓</button>
											</form>
										<?php } ?>
											<a href="#" onClick="toggle('addItem');" class="add item">New Item</a>
									</td>
								</tr>
							<?php } else if($page == 'Home'){ ?>
								<div id="tab-one" class="tab-page active-page">
									<img src="http://lorempixel.com/700/699/cats">
								</div>

								<div id="tab-two" class="tab-page">
									<img src="http://lorempixel.com/700/700/cats">
								</div>

								<div id="tab-three" class="tab-page">
									<img src="http://lorempixel.com/700/701/cats">
								</div>
							<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>