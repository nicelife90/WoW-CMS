<?php
session_start();

include("check.php");
include('config/config.php');

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
<title><?php echo $sitename; ?> | Bugtracker</title>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/ui.css">
<link rel="stylesheet" href="/css/font-awesome.min.css">
<link rel="stylesheet" href="/css/wm-contextmenu.css">
<script async="" src="//www.google-analytics.com/analytics.js"></script><script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="/script/ui.js?v=56"></script>
<script src="/script/jquery.wm-listener.js"></script>
<script src="/script/warmane.js?v=57"></script>
<script src="/script/jquery.wm.bpopup.js"></script>
<script src="/script/jquery.wm-contextmenu.js"></script>
<style>
		#customers {
			  border-collapse: collapse;
			  width: 100%;
			}

			#customers td, #customers th {
			  border: 1px solid #ddd;
			  background: #0f0f0f none repeat-x left;
			  color: #c1b575;
				border-bottom: 1px solid #1e1e1e;
				border-left: 1px solid transparent;
				border-right: 1px solid transparent;
			  padding: 10px;
			  font-size: 15px;
			}

			#customers tr:nth-child(even){background-color: #f2f2f2;}

			#customers tr:hover {background-color: #ddd;}

			#customers th {
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
<noscript>
    &lt;div id="noscript-override"&gt;
        &lt;p&gt;This site makes extensive use of JavaScript.&lt;/b&gt;&lt;br&gt;Please &lt;a href="https://www.google.com/support/adsense/bin/answer.py?answer=12654" target="_blank"&gt;enable JavaScript&lt;/a&gt; in your browser.&lt;/p&gt;
    &lt;/div&gt;
</noscript>
<div class="navigation-wrapper">
    <a href="/" class="navigation-logo"></a>
    <div class="navigation">
        <ul class="navbits">
                        <li><a href="/ucp/ucp.php" title="Account Panel">ACCOUNT PANEL</a></li>
                        <li><a href="/download.php" title="Download">DOWNLOAD</a></li>
						<li><a href="/forum/index.php" title="Forum">FORUM</a></li>
            <!--<li><a href="/information.php" title="Information">INFORMATION</a></li>-->
                        
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
    	    		<li><a href="/">NEWS</a></li>
            		<!--<li><a href="/stream" class="">STREAM</a></li>-->
            		<!--<li><a href="/devlog" class="">DEVLOG</a></li>-->
            		<li><a href="/changelog.php">CHANGELOG</a></li>
            		<li><a href="/bugtracker.php" class="active">BUGTRACKER</a></li>
            </ul>
    <ul>
        <li><?php
		$dt = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
		echo $dt->format('H:i');
		?></li>
    </ul>
</div>


<div class="content-wrapper">
            <?php
            $bugid = $_GET['bgid'];

            $conn = mysqli_connect($db_host, $db_username, $db_password, $cms_db_name, $db_port);
            $nick = $_SESSION["loggedin"];
            
            if(isset($bugid)){
                $checkbug = mysqli_query($conn, 'SELECT * FROM bugtracker WHERE id="'.$bugid.'"');
                if(mysqli_num_rows($checkbug)>0){
					$rowbug = mysqli_fetch_array($checkbug);
                    ?>
                            <div id="content-wrapper">
								<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-left wm-ui-content-fontstyle wm-ui-right-border wm-ui-top-border" style="height: auto;">
									<span>REPORTED BUG DETAILS</span>
									<table>
										<tbody>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>Problem:<br><font color="white"><?php echo $rowbug['title']; ?></font></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>Description:<br><font color="white"><?php echo $rowbug['content']; ?></font></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>Author:<br><font color="white"><?php echo $rowbug['author']; ?></font></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>Reported date:<br><font color="white"><?php echo $rowbug['date']; ?></font></td>
										</tr>
										</tbody>
									</table>
								</div>
								<div id="content-inner" class="wm-ui-generic-frame wm-ui-genericform wm-ui-two-side-page-right wm-ui-content-fontstyle wm-ui-left-border wm-ui-top-border" style="height: auto;">
									<span>OTHER INFORMATIONS</span>
									<table>
										<tbody>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>Solved ?:<br><font color="white"><?php if($rowbug['solved_by']==0){ echo "No"; }else{ echo "Yes";} ?></font></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>Solved by:<br><font color="white"><?php if(empty($rowbug['solved_by'])){ echo "---"; }else{ echo $rowbug['solved_by'];} ?></font></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>Solved date:<br><font color="white"><?php if(empty($rowbug['solved_date'])){ echo "---"; }else{ echo $rowbug['solved_date'];} ?></font></td>
										</tr>
										</tbody>
									</table>
								</div>
                            </div>
                        <?php
                }else{
                    ?>
                    <div id="content-inner" class="wm-ui-content-fontstyle wm-ui-generic-frame">
		            <div id="wm-error-page">
                    <center>
                        <p>
                            <font size="6">Invalid Bug ID</font>
                        </p>
                        <p>
                            <font size="5">Bug with that ID not exists.</font>
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
<script>
$(window).load(function() {
    $('.page-articles-right').height($('.page-articles-left').height()-42);
});
</script>


            <div class="clear"></div>
        </div>
    </div>
    <div class="footer"></div>
	<div class="frame-corners bl"></div>
    <div class="frame-corners br"></div>
</div>

<div id="page-footer">
	<a href="/policies/terms">Terms of Service</a> &nbsp; <a href="/policies/privacy">Privacy Policy</a> &nbsp; <a href="/policies/refund"> Refund Policy </a> &nbsp; <a href="#">Contact Us</a><br>
	Copyright ][ <?php echo $sitename; ?> ][ 2019. All Rights Reserved.
</div>


</body></html>