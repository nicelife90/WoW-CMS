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
}elseif(isset($_SESSION["loggedin"])){
		$nick = $_SESSION["loggedin"];
		$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
		
		$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
		$result = mysqli_query($checkacp,$sql);
		$rows = mysqli_fetch_array($result);
		
		$idcheck = $rows['id'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkacp,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		if(!$rowsgm || $rowsgm['gmlevel']==0){
			header("location: ../index.php");
			exit;
		}
		mysqli_close($checkacp);
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
<title><?php echo $sitename; ?> | Admin Panel</title>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/ui.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/wm-contextmenu.css">
<style>
#categories {
  border-collapse: collapse;
  width: 100%;
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
  font-weight: normal;
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
			$cmsconn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		}
		$sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
		$result = mysqli_query($checkacp,$sql);
		$rows = mysqli_fetch_array($result);
		
		$idcheck = $rows['id'];
		
		$gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
		$resultgm = mysqli_query($checkacp,$gm);
		$rowsgm = mysqli_fetch_array($resultgm);
		
		$cmssql= "SELECT * FROM news";
		$resultcms = mysqli_query($cmsconn,$cmssql);
		$rowscms = mysqli_fetch_array($resultcms);
		
		$cmssql2= "SELECT * FROM changelogs";
		$resultcms2 = mysqli_query($cmsconn,$cmssql2);
		$rowscms2 = mysqli_fetch_array($resultcms2);
		
		?><li><a href="/acp/acp.php"><i class="fas fa-user-secret"></i> ADMIN</a></li>
            <?php
		    if($rowsgm && $rowsgm['gmlevel']>0){ 
				?>
				<li><a href="/acp/manageaccs.php"><i class="fas fa-user-friends"></i> ACCOUNTS</a></li>
				<li><a href="/acp/support.php" class="active"><i class="fas fa-life-ring"></i> SUPPORT</a></li>
				<?php
                if($rowsgm && $rowsgm['gmlevel']>1){ 
                ?>
                <li><a href="/acp/listcontent.php?action=news"><i class="fas fa-newspaper"></i> NEWS</a></li>  
                <li><a href="/acp/listcontent.php?action=changelogs"><i class="fas fa-exclamation-circle"></i> CHANGELOGS</a></li>
                <li><a href="/acp/logs.php"><i class="fas fa-clipboard-list"></i> LOGS</a></li>
                <?php
				}
				if($rowsgm && $rowsgm['gmlevel']>2){ 
					?>
					<li><a href="/acp/website.php"><i class="fas fa-cogs"></i> WEBSITE</a></li>
					<?php
				}
			    ?>
				</ul>
				<ul>
			    <li><a href="/ucp/ucp.php"><i class="fas fa-user"></i> ACCOUNT</a></li>
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

<div class="content-wrapper">
            <?php
            $ticid = $_GET['ticid'];

            $conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
            $nick = $_SESSION["loggedin"];
            $checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);

            $sql= "SELECT * FROM account WHERE username = '" . $nick . "'";
            $result = mysqli_query($checkacp,$sql);
            $rows = mysqli_fetch_array($result);
            
            $idcheck = $rows['id'];

            $gm= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
            $resultgm = mysqli_query($checkacp,$gm);
            $rowsgm = mysqli_fetch_array($resultgm);
			
			$selectans = mysqli_query($conn, "SELECT * FROM ticket_answers WHERE ticket_id = $ticid ORDER BY id ASC");
            
			$checkreaded = mysqli_query($conn, "SELECT * FROM tickets WHERE id=$ticid AND readed_by_gm='0'");
			if(mysqli_num_rows($checkreaded) != 0){
				$setreaded = mysqli_query($conn, "UPDATE tickets SET readed_by_gm='1' WHERE id=$ticid");
			}
			
            if(isset($ticid)){
                $checktic = mysqli_query($conn, 'SELECT * FROM tickets WHERE id="'.$ticid.'"');
                if(mysqli_num_rows($checktic)>0){
					$rowtic = mysqli_fetch_array($checktic);
		
						if (mysqli_num_rows($selectans) != 0) {
							?>
							<table id='categories'>
							<th colspan='2'><b>Answers:</b></th></tr>
							<?php
							if (isset($_GET['page_no']) && $_GET['page_no']!="") {
								$page_no = $_GET['page_no'];
							}else{
								$page_no = 1;
							}
							
							$cmsconn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
							
							$total_records_per_page = 6;
							$offset = ($page_no-1) * $total_records_per_page;
							$previous_page = $page_no - 1;
							$next_page = $page_no + 1;
							$adjacents = "2"; 

							$result_count = mysqli_query($cmsconn,"SELECT COUNT(*) As total_records FROM `ticket_answers` WHERE ticket_id = $ticid");
							$total_records = mysqli_fetch_array($result_count);
							$total_records = $total_records['total_records'];
							$total_no_of_pages = ceil($total_records / $total_records_per_page);
							$second_last = $total_no_of_pages - 1; // total page minus 1
							
							$select3 = mysqli_query($conn, "SELECT * FROM ticket_answers WHERE ticket_id = $ticid LIMIT $offset, $total_records_per_page");
							
							while ($row = mysqli_fetch_assoc($select3)) {
								if(isset($_SESSION["loggedin"])) {
										$nick = $_SESSION["loggedin"];
										$checkacp = mysqli_connect($db_host, $db_username, $db_password, $auth_db_name, $db_port);
									}
								
								$test = $row['author'];
								
								$sqlauth= "SELECT * FROM account WHERE username = '" . $nick . "'";
								$resultauth = mysqli_query($checkacp,$sqlauth);
								$rowsauth = mysqli_fetch_array($resultauth);
								
								$sql= "SELECT * FROM account WHERE username = '" . $test . "'";
								$result = mysqli_query($checkacp,$sql);
								$rows = mysqli_fetch_array($result);
								
								$sqlauthor="SELECT * FROM account WHERE username = '" . $row['author'] . "'";
								$resultauthor = mysqli_query($checkacp,$sqlauthor);
								$rowsauthor = mysqli_fetch_array($resultauthor);
									
								$avatar = $rows['avatar'];
								$ipcheck = $rows['last_ip'];
								$idcheck = $rowsauth['id'];
								$idgmcheck = $row['author_id'];
								
								$gmmy= "SELECT * FROM account_access WHERE id = '" . $idcheck . "'";
								$resultgmmy = mysqli_query($checkacp,$gmmy);
								$rowsgmmy = mysqli_fetch_array($resultgmmy);
								
								$gm= "SELECT * FROM account_access WHERE id = '" . $idgmcheck . "'";
								$resultgm = mysqli_query($checkacp,$gm);
								$rowsgm = mysqli_fetch_array($resultgm);
								?>
								<tr><th width='25%'><center>
								<?php
									if($rowsgm['gmlevel']==1){
										?>
										<font color="00ba0d">Game Master</font><br>
										<?php
									}elseif($rowsgm['gmlevel']==2){
										?>
										<font color="cf7c00">Administrator</font><br>
										<?php
									}elseif($rowsgm['gmlevel']==3){
										?>
										<font color="c70000">Head Admin</font><br>
										<?php
									}
									?>
									<a href="/ucp/profile.php?id=<?php echo $rowsauthor['id']; ?>">
									<?php
									if($rowsauthor['posts']>=0 && $rowsauthor['posts']<50){
										?>
										<font color="ffffff"><?php echo $row['author']; ?></font>
										<?php
									}elseif($rowsauthor['posts']>=50 && $rowsauthor['posts']<100){
										?>
										<font color="#1df701"><?php echo $row['author']; ?></font>
										<?php
									}elseif($rowsauthor['posts']>=100 && $rowsauthor['posts']<250){
										?>
										<font color="006dd7"><?php echo $row['author']; ?></font>
										<?php
									}elseif($rowsauthor['posts']>=250 && $rowsauthor['posts']<500){
										?>
										<font color="9e34e7"><?php echo $row['author']; ?></font>
										<?php
									}elseif($rowsauthor['posts']>=500){
										?><font color="f57b01"><?php echo $row['author']; ?></font><?php
									}
									?>
								<br><img src="/uploads/avatars/<?php echo $avatar; ?>" width="100px" height="100px"></a>
								<?php
								if($idcheck==$row['author_id']){
								?>
								<br>
								<font color="#1df701">Author</font>
								<?php
								}
								?>
								</center></th>
								<th><span style="float:right; text-align: right;">
								Posted date: <?php echo $row['date_posted']; ?>
								</span><br><?php echo $row['answer']; ?></th></tr>
								<?php
							}
							?>
							</table>
							<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
								<div id="wm-error-page">
									<?php
									if (isset($_SESSION['loggedin'])) {
										$select = mysqli_query($conn, "SELECT * FROM tickets WHERE id = $ticid");
										$row = mysqli_fetch_assoc($select);
										
										$getticid = $_GET['ticid'];
										
										if($row['status']=='0'){
											echo "<div class='content'><form action='/acp/addanswer.php?ticid=".$getticid."' method='POST'>
													  <p>Answer: </p>
													  <textarea cols='80' rows='14' id='comment' name='comment' class='wm-ui-input-generic input-lg2 wm-ui-generic-frame wm-ui-all-border'></textarea><br />
													  <br><input type='submit' value='MAKE ANSWER' class='wm-ui-btn'/>
													  </form></div>";
										}elseif($row['status']=='1'){
											if($rowsgm['gmlevel']>0){
												echo "<div class='content'><form action='/acp/addanswer.php?ticid=".$getticid."' method='POST'>
														  <p>Answer: </p>
														  <textarea cols='80' rows='14' id='comment' name='comment' class='wm-ui-input-generic input-lg2 wm-ui-generic-frame wm-ui-all-border'></textarea><br />
														  <br><input type='submit' value='MAKE ANSWER' class='wm-ui-btn'/>
														  </form></div>";
												echo "Ticket is locked, but you still have permission to answer.";
											}else{
												echo "Ticket is locked, you can not answer.";
											}
										}
									}
									?>
								</div>
							</div>
							<?php
							$select2 = mysqli_query($conn, "SELECT * FROM ticket_answers WHERE ticket_id = $ticid");
							if (mysqli_num_rows($select2) > 6) {
							?>
							<div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
								<div id="wm-error-page">
									<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong><br>
									<?php // if($page_no > 1){ echo "<li><a href='viewticket.php?ticid=$ticid&page_no=1'>First Page</a></li>"; } ?>
									
									<b><a <?php if($page_no > 1){ echo "href='viewticket.php?ticid=$ticid&page_no=$previous_page'"; } ?>>Previous&nbsp;&nbsp;</a></b>
									   
									<?php 
									if ($total_no_of_pages <= 10){  	 
										for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
											if ($counter == $page_no) {
												echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
											}else{
												echo "<b><a href='viewticket.php?ticid=$ticid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
											}
										}
									}elseif($total_no_of_pages > 10){
										if($page_no <= 4) {			
											for ($counter = 1; $counter < 8; $counter++){		 
												if ($counter == $page_no) {
													echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
												}else{
													echo "<b><a href='viewticket.php?ticid=$ticid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
												}
											}
											echo "<b><a>...</a></b>";
											echo "<b><a href='viewticket.php?ticid=$ticid&page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
											echo "<b><a href='viewticket.php?ticid=$ticid&page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";
										}elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
											echo "<b><a href='viewticket.php?ticid=$ticid&page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
											echo "<b><a href='viewticket.php?ticid=$ticid&page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
											echo "<b><a>...</a></b>";
											for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
												if ($counter == $page_no) {
													echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
												}else{
													echo "<b><a href='viewticket.php?ticid=$ticid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
												}                  
										   }
										   echo "<b><a>...</a></b>";
										   echo "<b><a href='viewticket.php?ticid=$ticid&page_no=$second_last'>&nbsp;&nbsp;$second_last&nbsp;&nbsp;</a></b>";
										   echo "<b><a href='viewticket.php?ticid=$ticid&page_no=$total_no_of_pages'>&nbsp;&nbsp;$total_no_of_pages&nbsp;&nbsp;</a></b>";      
										}else {
											echo "<b><a href='viewticket.php?ticid=$ticid&page_no=1'>&nbsp;&nbsp;1&nbsp;&nbsp;</a></b>";
											echo "<b><a href='viewticket.php?ticid=$ticid&page_no=2'>&nbsp;&nbsp;2&nbsp;&nbsp;</a></b>";
											echo "<b><a>...</a></b>";

											for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
												if ($counter == $page_no) {
													echo "<b><u><a>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></u></b>";	
												}else{
													echo "<b><a href='viewticket.php?ticid=$ticid&page_no=$counter'>&nbsp;&nbsp;$counter&nbsp;&nbsp;</a></b>";
												}                   
											}
										}
									}
									?>
							
									<b><a <?php if($page_no < $total_no_of_pages) { echo "href='viewticket.php?ticid=$ticid&page_no=$next_page'"; } ?>>&nbsp;&nbsp;Next</a></b>
									<?php
									if($page_no < $total_no_of_pages){
										echo "<b><a href='viewticket.php?ticid=$ticid&page_no=$total_no_of_pages'>&nbsp;&nbsp;Last</a></b>";
									}
									?>
								</div>
							</div>
							<?php
							}
						}

                }else{
                    ?>
                    <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		            <div id="wm-error-page">
                    <center>
                        <p>
                            <font size="6">Invalid Ticket ID</font>
                        </p>
                        <p>
                            <font size="5">Ticket with that ID not exists.</font>
                        </p> 
                    </center>
                    </div>
                    </div>
                    <?php
                }
            }else{
                ?>
                <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		        <div id="wm-error-page">
                <center>
                    <p>
                        <font size="6">Invalid action</font>
                    </p>
                    <p>
                        <font size="5">You have not selected any actions.</font>
                    </p> 
				</center>
                </div>
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