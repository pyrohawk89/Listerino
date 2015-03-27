<?php
	function loadJSON($json, $assoc = true) { 
		$json = file_get_contents($json);
		$json = json_decode($json, $assoc); 
		return $json; 
	}
	function goBack(){
		if(!isset($_GET['user'])){
			header('location: /');
		} else {
			header('location: /?user='.$_GET['user'].'&list='.$_GET['list']);
		}
	}
	
	//Hacky way to sanitize input
	foreach($_GET as $key => $value){ 
		//allow some tags in, remove rest
		$_GET[$key] = strip_tags($value, "<a><b><i><u><br><hr><pre><em>"); 
	}

	if(!isset($_GET['action']) || !isset($_GET['user'])){
		goBack();
	} else {
		if($_GET['action'] == 'remove'){
			if(!isset($_GET['item_id']) || !isset($_GET['list'])){
				goBack();
			} else {
				if($_GET['user'] == 'xEpicBradx' || $_GET['user'] == 'PyroHawk89') {
					$games = loadJSON('./json/'.strtolower($_GET['user']).'.json');
					unset($games[$_GET['list']][$_GET['item_id']]);
					$games[$_GET['list']] = array_values($games[$_GET['list']]); //Important to fix index's
					file_put_contents('./json/'.strtolower($_GET['user']).'.json', json_encode($games, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
					header('location: /?user='.$_GET['user'].'&list='.$_GET['list'].'&type='.$_GET['type']);
				} else {
					goBack();
				}
			}
		} else if($_GET['action'] == 'add'){
			if(!isset($_GET['list'])){
				goBack();
			} else {
				if($_GET['user'] == 'xEpicBradx' || $_GET['user'] == 'PyroHawk89') {
					if($_GET['type'] == 0){
						$games = loadJSON('./json/'.strtolower($_GET['user']).'.json');
						$tmpCount = count($games[$_GET['list']]);
						$games[$_GET['list']][$tmpCount]['name'] = $_GET['name'];
						$games[$_GET['list']][$tmpCount]['url'] = $_GET['url'];
						if(strtolower($_GET['release']) == "soon"){
							$games[$_GET['list']][$tmpCount]['release'] = $_GET['release']."™";
						} else {
							$games[$_GET['list']][$tmpCount]['release'] = $_GET['release'];
						}
						$games[$_GET['list']][$tmpCount]['banner'] = $_GET['banner'];
						file_put_contents('./json/'.strtolower($_GET['user']).'.json', json_encode($games, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
						header('location: /?user='.$_GET['user'].'&list='.$_GET['list']);
					} elseif($_GET['type'] == 1){
						$games = loadJSON('./json/'.strtolower($_GET['user']).'.json');
						$tmpCount = count($games[$_GET['list']]);
						$games[$_GET['list']][$tmpCount]['col1'] = $_GET['col1'];
						file_put_contents('./json/'.strtolower($_GET['user']).'.json', json_encode($games, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
						header('location: /?user='.$_GET['user'].'&list='.$_GET['list'].'&type=1');
					} elseif($_GET['type'] == 2) {
						$games = loadJSON('./json/'.strtolower($_GET['user']).'.json');
						$tmpCount = count($games[$_GET['list']]);
						$games[$_GET['list']][$tmpCount]['col1'] = $_GET['col1'];
						$games[$_GET['list']][$tmpCount]['col2'] = $_GET['col2'];
						file_put_contents('./json/'.strtolower($_GET['user']).'.json', json_encode($games, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
						header('location: /?user='.$_GET['user'].'&list='.$_GET['list'].'&type=2');
					}
				} else {
					goBack();
				}
			}
		} else if($_GET['action'] == 'remove_list'){
			$games = loadJSON('./json/'.strtolower($_GET['user']).'.json');
			unset($games[$_GET['list_id']]);
			$games = array_values($games); //Important to fix index's
			file_put_contents('./json/'.strtolower($_GET['user']).'.json', json_encode($games, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
			header('location: /?user='.$_GET['user'].'&list=0');
		} else if($_GET['action'] == 'add_list') {
			$games = loadJSON('./json/'.strtolower($_GET['user']).'.json');
			$tmpCount = count($games);
			$games[$tmpCount][0]['list_type'] = $_GET['type'];
			$games[$tmpCount][0]['list_name'] = $_GET['name'];
			file_put_contents('./json/'.strtolower($_GET['user']).'.json', json_encode($games, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
			header('location: /?user='.$_GET['user'].'&list='.$tmpCount.'&type='.$_GET['type']);
		}
	}
?>