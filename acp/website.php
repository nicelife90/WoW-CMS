<?php
session_start();

include("check.php");
		include('../config/config.php');
		
		$conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
		$qr1 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'sitename'");
		$qr2 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'siteonline'");
        $qr3 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'offlinemessage'");
        $qr4 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmname'");
        $qr5 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmip'");
        $qr6 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmport'");
        $qr7 = mysqli_query($conn, "SELECT `conf_value` FROM `settings` WHERE `conf_key` = 'realmlist'");
		
		while($row = mysqli_fetch_array($qr1)){
			$sitename = $row['conf_value'];
		}
		while($row = mysqli_fetch_array($qr2)){
			$siteonline = $row['conf_value'];
		}
        while($row = mysqli_fetch_array($qr3)){
			$offlinemessage = $row['conf_value'];
        }
        while($row = mysqli_fetch_array($qr4)){
			$realmname = $row['conf_value'];
        }
        while($row = mysqli_fetch_array($qr5)){
			$realmip = $row['conf_value'];
        }
        while($row = mysqli_fetch_array($qr6)){
			$realmport = $row['conf_value'];
        }
        while($row = mysqli_fetch_array($qr7)){
			$realmlist = $row['conf_value'];
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
		
		if(!$rowsgm || $rowsgm['gmlevel']==0 || $rowsgm['gmlevel']==1 || $rowsgm['gmlevel']==2){
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
				<li><a href="/acp/support.php"><i class="fas fa-life-ring"></i> SUPPORT</a></li>
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
					<li><a href="/acp/website.php" class="active"><i class="fas fa-cogs"></i> WEBSITE</a></li>
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

<div id="content-wrapper">
    <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: 700px;">
         <?php
			if (isset($_SESSION['loggedin'])) {
                ?>
				<form action='/acp/websitechanged.php?change=sitename' method='POST'>
					<p>Site name: </p>
					<input type='text' id='sitename' name='sitename' value='<?php echo $sitename; ?>' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/><br /><br>
                    <input type='submit' value='CHANGE SITE NAME' class='wm-ui-btn'/>
                </form>
                <br>
                <form action='/acp/websitechanged.php?change=siteonline' method='POST'>
					<p>Site status: 
                    <?php
                    if($siteonline=='yes'){
                        ?>
                        <font color="1df701">Online</font>
                        <?php
                    }else{
                        ?>
                        <font color="red">Offline</font>
                        <?php
                    }
                    ?>
                    </p>
                    <input type='submit' value='CHANGE SITE STATUS' class='wm-ui-btn'/>
                </form>
                <br>
                <form action='/acp/websitechanged.php?change=offlinemessage' method='POST'>
					<p>Offline message: </p>
					<input type='text' id='offlinemessage' name='offlinemessage' value='<?php echo $offlinemessage; ?>' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/><br /><br>
                    <input type='submit' value='CHANGE OFFLINE MESSAGE' class='wm-ui-btn'/>
                </form>
                <?php
			}else{
				header("location: ../login.php");
			}
		?>   
    </div>
    <div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: 700px;">
	    <?php
			if (isset($_SESSION['loggedin'])) {
                ?>
				<form action='/acp/websitechanged.php?change=realmname' method='POST'>
					<p>Realm Name: </p>
					<input type='text' id='realmname' name='realmname' value='<?php echo $realmname; ?>' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/><br /><br>
                    <input type='submit' value='CHANGE REALM NAME' class='wm-ui-btn'/>
                </form>
                <br>
                <form action='/acp/websitechanged.php?change=realmip' method='POST'>
					<p>Realm IP: </p>
					<input type='text' id='realmip' name='realmip' value='<?php echo $realmip; ?>' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/><br /><br>
                    <input type='submit' value='CHANGE REALM IP' class='wm-ui-btn'/>
                </form>
                <br>
                <form action='/acp/websitechanged.php?change=realmport' method='POST'>
					<p>Realm Port: </p>
					<input type='text' id='realmport' name='realmport' value='<?php echo $realmport; ?>' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/><br /><br>
                    <input type='submit' value='CHANGE REALM PORT' class='wm-ui-btn'/>
                </form>
                <br>
                <form action='/acp/websitechanged.php?change=realmlist' method='POST'>
					<p>Realm List: </p>
					<input type='text' id='realmlist' name='realmlist' value='<?php echo $realmlist; ?>' size='40' maxlenght='30' class='wm-ui-input-generic wm-ui-generic-frame wm-ui-all-border'/><br /><br>
                    <input type='submit' value='CHANGE REALM LIST' class='wm-ui-btn'/>
                </form>
                <?php
			}else{
				header("location: ../login.php");
			}
		?>   
    </div>
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