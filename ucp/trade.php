<?php
session_start();

include("check.php");
include('../config/config.php');

$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
$qr1 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'sitename'");
$qr2 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'siteonline'");
$qr3 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'offlinemessage'");

while($row = mysqli_fetch_array($qr1)){
    $sitename = $row['conf_value'];
}
while($row = mysqli_fetch_array($qr2)){
    $siteonline = $row['conf_value'];
}
while($row = mysqli_fetch_array($qr3)){
    $offlinemessage = $row['conf_value'];
}

$id = $_SESSION['UID'];
if(!isset($_SESSION["loggedin"]) || empty($_SESSION["loggedin"])){
    header("location: ../login.php");
	exit;
}
?>
<html lang="en" class="active"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="csrf-token" content="MTk5MWNlNjFkMmYyOGE5YjM3OTYxZDEyMzQyYWE0MDU=">
<meta name="robots" content="noodp, noydir">
<meta name="google-site-verification" content="YW87KZKk-q94TWTgngHnf4ej3VUW3mWfFgznDZM_HB4">
<meta name="Description" content="Private Server Community.">
<meta name="Keywords" content="<?php echo $sitename; ?>, WoW, World of Warcraft, Warcraft, Private Server, Private WoW Server, WoW Server, Private WoW Server, wow private server, wow server, wotlk server, cataclysm private server, wow cata server, best free private server, largest private server, wotlk private server, blizzlike server, mists of pandaria, mop, cataclysm, cata, anti-cheat, sentinel anti-cheat, warden">
<link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
<title><?php echo $sitename; ?> | Account Panel</title>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/ui.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/wm-contextmenu.css">
<style>
#categories {
  border-collapse: collapse;
  width: 738px;
}

#categories td, #categories th {
  border: 1px solid #ddd;
  background: #0f0f0f none repeat-x left;
  color: #c1b575;
    border-bottom: 1px solid #1e1e1e;
    border-left: 1px solid transparent;
    border-right: 1px solid transparent;
  padding: 10px;
  font-size: 15px;
}

#categories tr:nth-child(even){background-color: #f2f2f2;}

#categories tr:hover {background-color: #ddd;}

#categories th {
	word-break: break-all;
  padding-top: 6.5px;
  padding-bottom: 6.5px;
  text-align: left;
  background-color: #131313;
  color: #505050;
  box-shadow: -2px 2px 2px transparent;
  border-top-right-radius: 0px;
	border-top-left-radius: 0px;
	border-left: 1px solid transparent;
	border-right: 1px solid transparent;
    border: 1px solid #1e1e1e;
	font-size: 15px;
	vertical-align: text-top;
}

</style>
</head>
<body>
<div class="navigation-wrapper">
    <a href="/" class="navigation-logo"></a>
    <div class="navigation">
        <ul class="navbits">
                        <li><a href="/ucp/ucp.php" title="Account Panel">ACCOUNT PANEL</a></li>
                        <li><a href="/download.php" title="Download">DOWNLOAD</a></li>
						<li><a href="/forum/index.php" title="Forum">FORUM</a></li>
            <!--<li><a href="/information.php" title="Information">INFORMATION</a></li>-->
						<li><a href="/armory/index.php" title="Armory">ARMORY</a></li>
                        <li><a href="/logout.php" title="Logout">LOG OUT</a></li>
                    </ul>        
    </div>
</div>
<div id="page-frame">
    <div class="lordaeron-render"></div>
	<div class="frame-corners tl"></div>
    <div class="frame-corners tr"></div>
    <div class="leftmost-frame"></div>
	<div class="header"></div>
    <div class="center">
        <iframe width="100%" height="100%" src="/images/bg3.jpg" frameborder="0" scrolling="no" allowfullscreen=""></iframe>
    </div>
    <div id="wm-theme-navigation"><a href="javascript:;" data-background="1"></a><a href="javascript:;" data-background="0"></a></div>
    <div class="footer"></div>
    <div class="rightmost-frame"></div>
	<div class="frame-corners bl"></div>
    <div class="frame-corners br"></div>
</div>
<div id="page-content-wrapper">
	<div id="wm-ui-flash-message"></div>
	<div class="frame-corners tl"></div>
    <div class="frame-corners tr"></div>
	<div class="header"></div>
    <div class="center">
        <div id="page-content">
            

<div id="page-navigation" class="wm-ui-generic-frame wm-ui-bottom-border">
<ul>
	<?php
		if(isset($_SESSION["loggedin"])) {
			$nick = $_SESSION["loggedin"];
			$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		}
		$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
		$result = mysqli_query($checkacp,$sql);
		$rows = mysqli_fetch_array($result);
		
		$idcheck = $rows['id'];
		$ipcheck = $rows['last_ip'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkacp,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		$ban= "SELECT * FROM account_banned WHERE id = '" . $idcheck . "' ORDER BY bandate DESC";
		$resultban = mysqli_query($checkacp,$ban);
		$rowsban = mysqli_fetch_array($resultban);
		
		$banip= "SELECT * FROM ip_banned WHERE ip = '" . $ipcheck . "' ORDER BY bandate DESC";
		$resultbanip = mysqli_query($checkacp,$banip);
		$rowsbanip = mysqli_fetch_array($resultbanip);
		
		$mute= "SELECT * FROM account_muted WHERE guid = '" . $idcheck . "'";
		$resultmute = mysqli_query($checkacp,$mute);
		$rowsmute = mysqli_fetch_array($resultmute);
		
		$bandate = date("F j, Y / H:i:s", $rowsban['bandate']);
		$unbandate = date("F j, Y / H:i:s", $rowsban['unbandate']);
		
		$getbantime = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
		$banipdate = date("F j, Y / H:i:s", $rowsbanip['bandate']);
		$unbanipdate = date("F j, Y / H:i:s", $rowsbanip['unbandate']);
		
		$mutedate = date("F j, Y / H:i:s", $rowsmute['mutedate']);
		
		$unixjoin = strtotime($rows['joindate']);
		$joindate = date("F j, Y", $unixjoin);
		
		$now = time();
		$your_date = strtotime($rows['last_login']);
		$datediff = $now - $your_date;
		$esttime = round($datediff / (60 * 60 * 24));
		
		
		?><li><a href="/ucp/ucp.php"><i class="fas fa-user"></i> ACCOUNT</a></li>
		<li><a href="/ucp/characters.php"><i class="fas fa-users-cog"></i> CHARACTERS</a></li>
		<li><a href="/ucp/donate.php"><i class="fas fa-dollar-sign"></i> DONATE</a></li>
		<li><a href="/ucp/store.php"><i class="fas fa-shopping-cart"></i> STORE</a></li>
		<li><a href="/ucp/trade.php" class="active"><i class="fas fa-sync-alt"></i> TRADE</a></li>
		<li><a href="/ucp/support.php"><i class="fas fa-life-ring"></i> SUPPORT</a></li>
		<li><a href="/ucp/lottery.php"><i class="fas fa-ticket-alt"></i> LOTTERY</a></li>
		<li><a href="/ucp/settings.php"><i class="fas fa-cog"></i> SETTINGS</a></li>
		<?php
		$howmuchmess = mysqli_query($conn, "SELECT * FROM messages WHERE status = 0 AND (author_id = '".$idcheck."' OR assigned_to = '".$idcheck."')");
		$rowsmess = mysqli_fetch_array($howmuchmess);
		if(mysqli_num_rows($howmuchmess)>0){
			?>
			<li><a href="/ucp/messages.php"><i class="fas fa-envelope"></i> <?php echo mysqli_num_rows($howmuchmess); ?></a></li>
			<?php
		}else{
			?>
			<li><a href="/ucp/messages.php"><i class="fas fa-envelope"></i> 0</a></li>
			<?php
		}
		?>
		<?php
		$howmuchnotis = mysqli_query($conn, "SELECT * FROM notifications WHERE user = '".$idcheck."' AND readed = 0");
		$rowsnotis = mysqli_fetch_array($howmuchnotis);
		if(mysqli_num_rows($howmuchnotis)>0){
			?>
			<li><a href="/ucp/notifications.php"><i class="fas fa-bell"></i> <?php echo mysqli_num_rows($howmuchnotis); ?></a></li>
			<?php
		}else{
			?>
			<li><a href="/ucp/notifications.php"><i class="fas fa-bell"></i> 0</a></li>
			<?php
		}
		?>
		</ul>
		<ul>
		<?php
		if($rowsgm && $rowsgm['gmlevel']>0){ 
			?>
			<li><a href="/acp/acp.php"><i class="fas fa-user-secret"></i> ADMIN</a></li>
			<?php
		}
		mysqli_close($checkacp);
		?>
        <li><?php
		$dt = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
		echo $dt->format('H:i');
		?></li>
    </ul>
</div>

<div id="content-wrapper">
<?php 
			if(isset($_GET['action'])){
				$action = htmlspecialchars($_GET['action']);
			}

			if($action == "showtrades"){
				if(isset($_GET['class'])){
					$acid = $_GET['class'];
            		$conn = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
            		$nick = $_SESSION["loggedin"];
					$checkac = mysqli_query($conn, 'SELECT * FROM characters WHERE guid="'.$acid.'"');
					$checkownerres = mysqli_query($conn,"SELECT * FROM characters WHERE guid = '" . $acid . "'");
					$ownerchar = mysqli_fetch_array($checkownerres);

					$nick = $_SESSION["loggedin"];
					$checkauth = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
					$sql1 = "SELECT * FROM account WHERE username = '" . $nick . "'";
					$result1 = mysqli_query($checkauth,$sql1);
					$rows = mysqli_fetch_array($result1);
					
					$cmsconn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
					$checkselled = mysqli_query($cmsconn, "SELECT * FROM trades WHERE selled='1'");
					if(mysqli_num_rows($checkselled)>0){
						$deleteselled = mysqli_query($cmsconn, "DELETE FROM trades WHERE selled='1'");
					}
					
					$idcheck = $rows['id'];
						if($acid==1 || $acid==2 || $acid==3 || $acid==4 || $acid==5 || $acid==6 || $acid==7 || $acid==8 || $acid==9 || $acid==11){
							?>
							<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: 483px; width: 250px;">
								<span>AVAILABLE CLASSES</span>
								<table>
									<tbody><tr>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>
											<font color="C79C6E">Warrior</font> <img src="/uploads/account/classes/warrior.gif"> 
											<?php
											if($acid==1){
												?>
												(<a href="trade.php?action=showtrades&class=1"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=1"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="F58CBA">Paladin</font> <img src="/uploads/account/classes/paladin.gif"> 
											<?php
											if($acid==2){
												?>
												(<a href="trade.php?action=showtrades&class=2"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=2"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="ABD473">Hunter</font> <img src="/uploads/account/classes/hunter.gif"> 
											<?php
											if($acid==3){
												?>
												(<a href="trade.php?action=showtrades&class=3"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=3"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="FFF569">Rogue</font> <img src="/uploads/account/classes/rogue.gif"> 
											<?php
											if($acid==4){
												?>
												(<a href="trade.php?action=showtrades&class=4"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=4"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="FFFFFF">Priest</font> <img src="/uploads/account/classes/priest.gif"> 
											<?php
											if($acid==5){
												?>
												(<a href="trade.php?action=showtrades&class=5"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=5"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="C41F3B">Death Knight</font> <img src="/uploads/account/classes/deathknight.gif"> 
											<?php
											if($acid==6){
												?>
												(<a href="trade.php?action=showtrades&class=6"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=6"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="0070DE">Shaman</font> <img src="/uploads/account/classes/shaman.gif"> 
											<?php
											if($acid==7){
												?>
												(<a href="trade.php?action=showtrades&class=7"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=7"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="40C7EB">Mage</font> <img src="/uploads/account/classes/mage.gif"> 
											<?php
											if($acid==8){
												?>
												(<a href="trade.php?action=showtrades&class=8"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=8"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="8787ED">Warlock</font> <img src="/uploads/account/classes/warlock.gif"> 
											<?php
											if($acid==9){
												?>
												(<a href="trade.php?action=showtrades&class=9"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=9"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
											<font color="FF7D0A">Druid</font> <img src="/uploads/account/classes/druid.gif"> 
											<?php
											if($acid==11){
												?>
												(<a href="trade.php?action=showtrades&class=11"><font color="orange">Selected</font></a>)
												<?php
											}else{
												?>
												(<a href="trade.php?action=showtrades&class=11"><font color="lightgreen">Select</font></a>)
												<?php
											}
											?>
											<br>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
									</tr>
								</tbody></table>
							</div>
							<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 50px; width: 736px;">
							<center>Trades for
							<?php
							if($acid==1){
								?>
								<font color="C79C6E">Warrior</font> <img src="/uploads/account/classes/warrior.gif">
								<?php
							}elseif($acid==2){
								?>
								<font color="F58CBA">Paladin</font> <img src="/uploads/account/classes/paladin.gif">
								<?php
							}elseif($acid==3){
								?>
								<font color="ABD473">Hunter</font> <img src="/uploads/account/classes/hunter.gif">
								<?php
							}elseif($acid==4){
								?>
								<font color="FFF569">Rogue</font> <img src="/uploads/account/classes/rogue.gif">
								<?php
							}elseif($acid==5){
								?>
								<font color="FFFFFF">Priest</font> <img src="/uploads/account/classes/priest.gif">
								<?php
							}elseif($acid==6){
								?>
								<font color="C41F3B">Death Knight</font> <img src="/uploads/account/classes/deathknight.gif">
								<?php
							}elseif($acid==7){
								?>
								<font color="0070DE">Shaman</font> <img src="/uploads/account/classes/shaman.gif">
								<?php
							}elseif($acid==8){
								?>
								<font color="40C7EB">Mage</font> <img src="/uploads/account/classes/mage.gif">
								<?php
							}elseif($acid==9){
								?>
								<font color="8787ED">Warlock</font> <img src="/uploads/account/classes/warlock.gif">
								<?php
							}elseif($acid==11){
								?>
								<font color="FF7D0A">Druid</font> <img src="/uploads/account/classes/druid.gif">
								<?php
							}
							?>
							</center>
							</div>
							<table id="categories">
								<tr>
									<th width="5%"><center>Class</center></th>
									<th width="5%"><center>Race</center></th>
									<th width="20%">Character</th>
									<th width="5%"><center>Faction</center></th>
									<th width="5%"><center>Level</center></th>
									<th width="10%">Price</th>
									<th width="5%"><center>Buy</center></th>
								</tr>
								<?php
								if (isset($_GET['page_no']) && $_GET['page_no']!="") {
									$page_no = $_GET['page_no'];
								}else{
									$page_no = 1;
								}
								
								$getcharid = $_GET['class'];
								
								$cmsconn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);

								$total_records_per_page = 10;
								$offset = ($page_no-1) * $total_records_per_page;
								$previous_page = $page_no - 1;
								$next_page = $page_no + 1;
								$adjacents = "2"; 

								$result_count = mysqli_query($cmsconn,"SELECT COUNT(*) As total_records FROM trades WHERE class='$getcharid' AND selled='0'");
								$total_records = mysqli_fetch_array($result_count);
								$total_records = $total_records['total_records'];
								$total_no_of_pages = ceil($total_records / $total_records_per_page);
								$second_last = $total_no_of_pages - 1; // total page minus 1

								$result = mysqli_query($cmsconn,"SELECT * FROM trades WHERE class='$getcharid' AND selled='0' ORDER BY id DESC LIMIT $offset, $total_records_per_page");
								if(mysqli_num_rows($result)>0){
									while($row = mysqli_fetch_array($result)){
										$checkchar = mysqli_connect($db_host, $db_username, $db_password, $chars_db_name, $db_port);
										$resultchardetails = mysqli_query($checkchar,"SELECT * FROM characters WHERE guid = '" . $row['charid'] . "'");
										$rowchardetails = mysqli_fetch_array($resultchardetails);
										?>
										<tr>
										<th><center>
										<?php
										if($rowchardetails['class']==1){
											?>
											<img src="/uploads/account/classes/warrior.gif">
											<?php
										}elseif($rowchardetails['class']==2){
											?>
											<img src="/uploads/account/classes/paladin.gif">
											<?php
										}elseif($rowchardetails['class']==3){
											?>
											<img src="/uploads/account/classes/hunter.gif">
											<?php
										}elseif($rowchardetails['class']==4){
											?>
											<img src="/uploads/account/classes/rogue.gif">
											<?php
										}elseif($rowchardetails['class']==5){
											?>
											<img src="/uploads/account/classes/priest.gif">
											<?php
										}elseif($rowchardetails['class']==6){
											?>
											<img src="/uploads/account/classes/deathknight.gif">
											<?php
										}elseif($rowchardetails['class']==7){
											?>
											<img src="/uploads/account/classes/shaman.gif">
											<?php
										}elseif($rowchardetails['class']==8){
											?>
											<img src="/uploads/account/classes/mage.gif">
											<?php
										}elseif($rowchardetails['class']==9){
											?>
											<img src="/uploads/account/classes/warlock.gif">
											<?php
										}elseif($rowchardetails['class']==11){
											?>
											<img src="/uploads/account/classes/druid.gif">
											<?php
										}else{
											?>
											<img src="/uploads/account/unknown.gif">
											<?php
										}
										?>
										</center></th>
										<th><center>
										<?php
										if($rowschar['rowchardetails']==1){
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fhuman.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/human.gif">
												<?php
											}
										}elseif($rowchardetails['race']==2){
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/forc.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/orc.gif">
												<?php
											}
										}elseif($rowchardetails['race']==3){
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fdwarf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/dwarf.gif">
												<?php
											}
										}elseif($rowchardetails['race']==4){
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fnightelf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/nightelf.gif">
												<?php
											}
										}elseif($rowchardetails['race']==5){
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fundead.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/undead.gif">
												<?php
											}
										}elseif($rowchardetails['race']==6){
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/ftauren.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/tauren.gif">
												<?php
											}
										}elseif($rowchardetails['race']==7){
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fgnome.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/gnome.gif">
												<?php
											}
										}elseif($rowchardetails['race']==8){
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/ftroll.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/troll.gif">
												<?php
											}
										}elseif($rowchardetails['race']==10){
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fbloodelf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/bloodelf.gif">
												<?php
											}
										}elseif($rowchardetails['race']==11){
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fdraenei.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/draenei.gif">
												<?php
											}
										}else{
											?>
											<img src="/uploads/account/unknown.gif">
											<?php
										}
										?>
										</center></th>
										<?php
											$days = intval(intval($rowchardetails['totaltime']) / (3600*24));
											$hours = (intval($rowchardetails['totaltime']) / 3600) % 24;
											$minutes = (intval($rowchardetails['totaltime']) / 60) % 60;
											
											$money = $rowchardetails['money'];
											$gold = intval($money/10000);
											$money = intval($money%10000);
											$silver = intval($money/100);
											$copper = intval($money%100);
										?>
										<th><div class="tooltip" style="font-weight: normal;"><a href='/armory/character.php?charid=<?php echo $rowchardetails['guid']; ?>'><font color="white"><?php echo $rowchardetails['name']; ?></font> <font color="1df701">(?)</font></a>
											<span class="tooltiptext"><font color="FFE4B5">CHARACTER DETAILS</font><br>
											<br><font color="606060">Name: <font color="white"><?php echo $rowchardetails['name']; ?></font> (ID: <font color="white"><?php echo $rowchardetails['guid']; ?></font>)
											<br>Level & XP: <font color="white"><?php echo $rowchardetails['level']; ?></font> (<font color="white"><?php echo $rowchardetails['xp']; ?> XP</font>)
											<br>Money: <img src="/uploads/account/gold.png"> <font color="white"><?php echo $gold; ?></font> / <img src="/uploads/account/silver.png"> <font color="white"><?php echo $silver; ?></font> / <img src="/uploads/account/copper.png"> <font color="white"><?php echo $copper; ?></font>
											<br>Race: 
											<font color="white">
										<?php
										if($rowchardetails['race']==1){
											?>
											Human 
											<?php
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fhuman.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/human.gif">
												<?php
											}
											?>
											<?php
										}elseif($rowchardetails['race']==2){
											?>
											Orc 
											<?php
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/forc.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/orc.gif">
												<?php
											}
											?>
											<?php
										}elseif($rowchardetails['race']==3){
											?>
											Dwarf 
											<?php
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fdwarf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/dwarf.gif">
												<?php
											}
											?>
											<?php
										}elseif($rowchardetails['race']==4){
											?>
											Night Elf 
											<?php
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fnightelf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/nightelf.gif">
												<?php
											}
											?>
											<?php
										}elseif($rowchardetails['race']==5){
											?>
											Undead 
											<?php
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fundead.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/undead.gif">
												<?php
											}
											?>
											<?php
										}elseif($rowchardetails['race']==6){
											?>
											Tauren 
											<?php
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/ftauren.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/tauren.gif">
												<?php
											}
											?>
											<?php
										}elseif($rowchardetails['race']==7){
											?>
											Gnome 
											<?php
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fgnome.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/gnome.gif">
												<?php
											}
											?>
											<?php
										}elseif($rowchardetails['race']==8){
											?>
											Troll 
											<?php
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/ftroll.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/troll.gif">
												<?php
											}
											?>
											<?php
										}elseif($rowchardetails['race']==10){
											?>
											Blood Elf 
											<?php
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fbloodelf.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/bloodelf.gif">
												<?php
											}
											?>
											<?php
										}elseif($rowchardetails['race']==11){
											?>
											Draenei 
											<?php
											if($rowchardetails['gender']==1){
												?>
												<img src="/uploads/account/races/fdraenei.gif">
												<?php
											}else{
												?>
												<img src="/uploads/account/races/draenei.gif">
												<?php
											}
											?>
											<?php
										}else{
											?>
											Unknown <img src="/uploads/account/unknown.gif">
											<?php
										}
										?>
										</font>
											<br>Class: 
											<font color="white">
										<?php
										if($rowchardetails['class']==1){
											?>
											<font color="C79C6E">Warrior</font> <img src="/uploads/account/classes/warrior.gif">
											<?php
										}elseif($rowchardetails['class']==2){
											?>
											<font color="F58CBA">Paladin</font> <img src="/uploads/account/classes/paladin.gif">
											<?php
										}elseif($rowchardetails['class']==3){
											?>
											<font color="ABD473">Hunter</font> <img src="/uploads/account/classes/hunter.gif">
											<?php
										}elseif($rowchardetails['class']==4){
											?>
											<font color="FFF569">Rogue</font> <img src="/uploads/account/classes/rogue.gif">
											<?php
										}elseif($rowchardetails['class']==5){
											?>
											<font color="FFFFFF">Priest</font> <img src="/uploads/account/classes/priest.gif">
											<?php
										}elseif($rowchardetails['class']==6){
											?>
											<font color="C41F3B">Death Knight</font> <img src="/uploads/account/classes/deathknight.gif">
											<?php
										}elseif($rowchardetails['class']==7){
											?>
											<font color="0070DE">Shaman</font> <img src="/uploads/account/classes/shaman.gif">
											<?php
										}elseif($rowchardetails['class']==8){
											?>
											<font color="40C7EB">Mage</font> <img src="/uploads/account/classes/mage.gif">
											<?php
										}elseif($rowchardetails['class']==9){
											?>
											<font color="8787ED">Warlock</font> <img src="/uploads/account/classes/warlock.gif">
											<?php
										}elseif($rowchardetails['class']==11){
											?>
											<font color="FF7D0A">Druid</font> <img src="/uploads/account/classes/druid.gif">
											<?php
										}else{
											?>
											Unknown <img src="/uploads/account/unknown.gif">
											<?php
										}
										?>
										</font>
										<br>Gender: 
										<?php
										if($rowchardetails['gender']==1){
											?>
											<font color="pink">Female</font> <img src="/uploads/account/female.gif">
											<?php
										}else{
											?>
											<font color="lightblue">Male</font> <img src="/uploads/account/male.gif">
											<?php
										}
										?>
										<br>Faction: 
										<?php
										if($rowchardetails['race']==1 || $rowchardetails['race']==3 || $rowchardetails['race']==4 || $rowchardetails['race']==7 || $rowchardetails['race']==11){
											?>
											<font color="blue">Alliance</font> <img src="/uploads/account/alliance.png">
											<?php
										}else{
											?>
											<font color="red">Horde</font> <img src="/uploads/account/horde.png">
											<?php
										}
										?>
										<br>Guild: 
										<?php
										$sql13 = "SELECT * FROM guild_member WHERE guid = '" . $rowchardetails['guid']. "'";
										$resultguild = mysqli_query($checkchar2,$sql13);
										$rowsguild = mysqli_fetch_array($resultguild);
										if(mysqli_num_rows($resultguild)>0){
											$sql14 = "SELECT * FROM guild_member WHERE guid = '" . $rowchardetails['guid']. "'";
											$ifguild = mysqli_query($checkchar2,$sql14);
											$checkguild = mysqli_fetch_array($ifguild);
											
											$guildidthen = $checkguild['guildid'];
											$sql15 = "SELECT * FROM guild WHERE guildid = '" . $guildidthen. "'";
											$ifshowguild = mysqli_query($checkchar2,$sql15);
											$showguild = mysqli_fetch_array($ifshowguild);
											?>
											<font color="white"><?php echo $showguild['name']; ?></font>
											<?php
										}else{
											?>
											<font color="white">None</font>
											<?php
										}
										?>
										<br>Total playtime: <font color="white">Days: <?php echo $days; ?></font> / <font color="white">Hours: <?php echo $hours; ?></font> / <font color="white">Minutes: <?php echo $minutes; ?></font></font>
											</span>
										</div></th>
										<th><center>
										<?php
										if($rowchardetails['race']==1 || $rowchardetails['race']==3 || $rowchardetails['race']==4 || $rowchardetails['race']==7 || $rowchardetails['race']==11){
											?>
											<img src="/uploads/account/alliance.png">
											<?php
										}else{
											?>
											<img src="/uploads/account/horde.png">
											<?php
										}
										?>
										</center></th>
										<th><center><?php echo $rowchardetails['level']; ?></center></th>
										<th><?php echo $row['price']; ?> coins</th>
										<th><center><a href="/ucp/buycharacter.php?action=buy&charid=<?php echo $row['charid']; ?>"><i class="fas fa-shopping-cart"></i></a></center></th>
										</tr>
										<?php
									}
								}else{
									?>
									<tr>
										<th colspan="7">No trades</th>
									</tr>
									<?php
								}
								?>
							</table>
							<?php
							$select2 = mysqli_query($cmsconn, "SELECT * FROM trades WHERE class='$getcharid' AND selled='0' ORDER BY id DESC");
							if (mysqli_num_rows($select2) > 10) {
							?>
							<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="width: 736px; height: 80px;">
								<div id="wm-error-page">
									<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong><br>
									<?php // if($page_no > 1){ echo "<li><a href='?action=showtrades&class=$getcharid&page_no=1'>First Page</a></li>"; } ?>
									
									<b><a <?php if($page_no > 1){ echo "href='?action=showtrades&class=$getcharid&page_no=$previous_page'"; } ?>>Previous&nbsp;&nbsp;</a></b>
									   
									<?php 
									if ($total_no_of_pages <= 10){  	 
										for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
											if ($counter == $page_no) {
												echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
											}else{
												echo "<b><a href='?action=showtrades&class=$getcharid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
											}
										}
									}elseif($total_no_of_pages > 10){
										if($page_no <= 4) {			
											for ($counter = 1; $counter < 8; $counter++){		 
												if ($counter == $page_no) {
													echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
												}else{
													echo "<b><a href='?action=showtrades&class=$getcharid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
												}
											}
											echo "<b><a>...</a></b>";
											echo "<b><a href='?action=showtrades&class=$getcharid&page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
											echo "<b><a href='?action=showtrades&class=$getcharid&page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";
										}elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
											echo "<b><a href='?action=showtrades&class=$getcharid&page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
											echo "<b><a href='?action=showtrades&class=$getcharid&page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
											echo "<b><a>...</a></b>";
											for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
												if ($counter == $page_no) {
													echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
												}else{
													echo "<b><a href='?action=showtrades&class=$getcharid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
												}                  
										   }
										   echo "<b><a>...</a></b>";
										   echo "<b><a href='?action=showtrades&class=$getcharid&page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
										   echo "<b><a href='?action=showtrades&class=$getcharid&page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";      
										}else {
											echo "<b><a href='?action=showtrades&class=$getcharid&page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
											echo "<b><a href='?action=showtrades&class=$getcharid&page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
											echo "<b><a>...</a></b>";

											for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
												if ($counter == $page_no) {
													echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
												}else{
													echo "<b><a href='?action=showtrades&class=$getcharid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
												}                   
											}
										}
									}
									?>
							
									<b><a <?php if($page_no < $total_no_of_pages) { echo "href='?action=showtrades&class=$getcharid&page_no=$next_page'"; } ?>>&nbsp;&nbsp;Next</a></b>
									<?php
									if($page_no < $total_no_of_pages){
										echo "<b><a href='?action=showtrades&class=$getcharid&page_no=$total_no_of_pages'>&nbsp;&nbsp;Last</a></b>";
									}
									?>
								</div>
							</div>
							<?php
							}
							mysqli_close($conn);
						}else{
						?>
							<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
								<div id="wm-error-page">
								<center>
									<p>
										<font size="6">No class selected</font>
									</p>
									<p>
										<font size="5">You have selected class that not exists.</font>
									</p> 
								</center>
								</div>
							</div>
							<?php
							header("refresh:5;url=trade.php");
						}
				}else{
						?>
					<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
						<div id="wm-error-page">
						<center>
							<p>
								<font size="6">No class selected</font>
							</p>
							<p>
								<font size="5">You have selected class that not exists.</font>
							</p> 
						</center>
						</div>
					</div>
					<?php
					header("refresh:5;url=trade.php");
				}
			}else{
				?>
				<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: 350px; width: 200px;">
					<span>AVAILABLE CLASSES</span>
					<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>
								<font color="C79C6E">Warrior</font> <img src="/uploads/account/classes/warrior.gif"> (<a href="trade.php?action=showtrades&class=1"><font color="lightgreen">Select</font></a>)<br>
								<font color="F58CBA">Paladin</font> <img src="/uploads/account/classes/paladin.gif"> (<a href="trade.php?action=showtrades&class=2"><font color="lightgreen">Select</font></a>)<br>
								<font color="ABD473">Hunter</font> <img src="/uploads/account/classes/hunter.gif"> (<a href="trade.php?action=showtrades&class=3"><font color="lightgreen">Select</font></a>)<br>
								<font color="FFF569">Rogue</font> <img src="/uploads/account/classes/rogue.gif"> (<a href="trade.php?action=showtrades&class=4"><font color="lightgreen">Select</font></a>)<br>
								<font color="FFFFFF">Priest</font> <img src="/uploads/account/classes/priest.gif"> (<a href="trade.php?action=showtrades&class=5"><font color="lightgreen">Select</font></a>)<br>
								<font color="C41F3B">Death Knight</font> <img src="/uploads/account/classes/deathknight.gif"> (<a href="trade.php?action=showtrades&class=6"><font color="lightgreen">Select</font></a>)<br>
								<font color="0070DE">Shaman</font> <img src="/uploads/account/classes/shaman.gif"> (<a href="trade.php?action=showtrades&class=7"><font color="lightgreen">Select</font></a>)<br>
								<font color="40C7EB">Mage</font> <img src="/uploads/account/classes/mage.gif"> (<a href="trade.php?action=showtrades&class=8"><font color="lightgreen">Select</font></a>)<br>
								<font color="8787ED">Warlock</font> <img src="/uploads/account/classes/warlock.gif"> (<a href="trade.php?action=showtrades&class=9"><font color="lightgreen">Select</font></a>)<br>
								<font color="FF7D0A">Druid</font> <img src="/uploads/account/classes/druid.gif"> (<a href="trade.php?action=showtrades&class=11"><font color="lightgreen">Select</font></a>)
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
					</tbody></table>
				</div>
				<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 350px; width: 786px;">
					<span>AVAILABLE TRADES</span>
					<table>
						<tbody><tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>First please select an interesting you class.</td>
						</tr>
					</tbody></table>
				</div>
				<?php
			}
			?>
</div>

            <div class="clear"></div>
        </div>
    </div>
    <div class="footer"></div>
	<div class="frame-corners bl"></div>
    <div class="frame-corners br"></div>
</div>

<div id="page-footer">
	Copyright ][ <?php echo $sitename; ?> ][ 2019. All Rights Reserved.
</div>


</body></html>