<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Home page</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
	  <link rel="STYLESHEET" type="text/css" href="style/style.css">
</head>
<body>
	<div id="top">
		<div id="header">
			<div id="topHeader">
				<div id="topNav">
					<ul>
						<li><a href="login-home.php">Home |</a></li>
						<li><a href="reports.php">Students Report |</a></li>
						<li><a href="catalog.php">Course Catalog |</a></li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<div id="topLogin">
				<p>LOGGED IN USER<br /><div class="user"><?= $fgmembersite->UserFullName() ?></div></p>
			</div>
		</div>
	</div>
	<div id="main">
		<div id="mainHeader">
			<div id="pageTitle"><h2>Home Page</h2></div>
		</div>
		<div id="userMenu">
			<ul>
				<p>User Menu</p>
				<li><a href="change-pwd.php">Change Password</a></li>
				<li><a href="register.php">Register Users</a></li>
				<li><a href="confirmreg.php">Confirm Registration</a></li>
				<li><a href="logout.php">Log out</a></li>
			</ul>
		</div>
		<div class="clear"></div>
		<div id='fg_membersite_content' class="mainBody">
		
			<?php
									
				$con = mysql_connect("localhost", "admin_121", "CSC263121");
				if (!$con)
				{
					die('Could not connect: ' . mysql_error());
				}

				mysql_select_db("121sms", $con);

				$createStudentSql = "INSERT INTO `student`(`ssu_id`, `fname`, `lname`, `sex`, `bdate`, `birthplace`, `pp_id`, `phone`, `address`, `cohort`, `chinese_uni`, `major`, `concentration`, `minor`, `advisor`, `city`, `zip`, `state`)
									 VALUES ('$_POST[ssu_id]', '$_POST[fname]', '$_POST[lname]', '$_POST[sex]', '$_POST[bdate]', '$_POST[birthplace]', '$_POST[pp_id]', '$_POST[phone]', '$_POST[address]', '$_POST[cohort]', '$_POST[chinese_uni]', '$_POST[major]', '$_POST[concentration]', '$_POST[minor]', '$_POST[advisor]', '$_POST[city]', '$_POST[zip]', '$_POST[state]')";

				if (!mysql_query($createStudentSql,$con))
				{
					die('Error: ' . mysql_error());
				}
				echo "1 record added";

				mysql_close($con);

			?>
			
		</div>
	</div>
</body>
</html>



















