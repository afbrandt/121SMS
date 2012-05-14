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
	<link rel="STYLESHEET" type="text/css" href="style/create-student.css">
	<link rel="STYLESHEET" type="text/css" href="style/jquery-ui-1.8.20.custom.css">
	<script src="scripts/jquery-1.7.2.min.js"></script>
	<script src="scripts/jquery-ui-1.8.20.custom.min.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>
	<script>
	$(function() {
		var availableTags = [
			"Alabama",
			"Alaska",
			"Arizona",
			"Arkansas",
			"California",
			"Colorado",
			"Connecticut",
			"Delaware",
			"Florida",
			"Georgia",
			"Hawaii",
			"Idaho",
			"Illinois",
			"Indiana",
			"Iowa",
			"Kansas",
			"Kentucky",
			"Louisiana",
			"Maine",
			"Maryland",
			"Massachusetts",
			"Michigan",
			"Minnesota",
			"Mississippi",
			"Missouri",
			"Montana",
			"Nebraska",
			"Nevada",
			"New Hampshire",
			"New Jersey",
			"New Mexico",
			"New York",
			"North Carolina",
			"North Dakota",
			"Ohio",
			"Oklahoma",
			"Oregon",
			"Pennsylvania",
			"Rhode Island",
			"South Carolina",
			"South Dakota",
			"Tennessee",
			"Texas",
			"Utah",
			"Vermont",
			"Virginia",
			"Washington",
			"West Virginia"
		];
		$( "#states" ).autocomplete({
			source: availableTags
		});
	});
	</script>
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
	
	<?php
									
		$con = mysql_connect("localhost", "admin_121", "CSC263121");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}

		mysql_select_db("121sms", $con);
		
		$selectStudentQuery = mysql_query("SELECT * FROM STUDENT WHERE ssu_id='".$_POST["studentQuery"]."'")
		or die(mysql_error());
		
		$student = mysql_fetch_array( $selectStudentQuery );

		mysql_close($con);
	?>
	
	<div id="main">
		<div id="mainHeader">
			<div id="pageTitle"><h2>Edit Student: <?echo $student['fname']?></h2></div>
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
		
			<div id="editStudentForm">
			
				<form action="update.php" method="post">
					<div id="topGroupLeft">
						<div id="personalInfo" class="group">
						<h2 class="groupHeader"><span>Personal Info</span></h2>
							<div id="studentID" class="input"><span>Student ID</span><br /><input type="text" name="ssu_id" value="<?php echo $student['ssu_id'] ?>" /></div>
							<div id="passport" class="input"><span>Passport No.</span><br /><input type="text" name="pp_id" value="<?php echo $student['pp_id'] ?>" /></div>
							<div class="clear"></div>
							<div id="firstname" class="input"><span>First Name</span><br /><input type="text" name="fname" value="<?php echo $student['fname'] ?>" /></div>
							<div id="lastname" class="input"><span>Last Name</span><br /><input type="text" name="lname" value="<?php echo $student['lname'] ?>" /></div>
							<div class="clear"></div>
							<div id="id_sex" class="input">
								<div class="label">Sex: &nbsp&nbsp&nbsp </div>
								<div id="male" class="sex">Male<input type="radio" name="sex" value="M" <?php if($student['sex']=='M') echo "checked"?> /></div>
								<div id="female" class="sex">Female<input type="radio" name="sex" value="F" <?php if($student['sex']=='F') echo "checked"?>/></div>
								<div class="clear"></div>
							</div>
							<div class="clear"></div>
							<div id="birthInfo">
								<div class="input"><span>Birthdate</span><br /><input type="text" id="datepicker" name="bdate" value="<?php echo $student['bdate'] ?>" /></div>
								<div class="input"><span>Birthplace</span><br /><input type="text" name="birthplace" value="<?php echo $student['birthplace'] ?>" /></div>
							</div>
							<div class="clear"></div>						
						</div>
					</div>
					<div id="topGroupRight">
						<div id="contactInfo" class="group">
						<h2 class="groupHeader">Contact Info</span></h2>
							<div id="address" class="input"><span>Address</span><br /><input type="text" name="address" size="44" value="<?php echo $student['address'] ?>" /></div>
							<div class="clear"></div>
							<div id="city" class="input"><span>City</span><br /><input type="text" name="city" size="10" value="<?php echo $student['city'] ?>" /></div>
							<div id="zip" class="input"><span>Zip Code</span><br /><input type="text" name="zip" size="5" maxLength="5" value="<?php echo $student['zip'] ?>" /></div>
							<div id="state" class="input"><span>State</span><br /><input type="text" name="state" id="states" maxLength="14" size="12" value="<?php echo $student['state'] ?>" /></div>
							<div class="clear"></div>
							<div id="phone" class="input"><span>Phone</span><br /><input type="text" name="phone" size="15" value="<?php echo $student['phone'] ?>" /></div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="clear"></div>
					<div id="academicInfo" class="group">
						<h2 class="groupHeader"><span>Academic Info</span></h2>
						<div id="chineseSchool" class="input"><span>Chinese School</span><br /><input type="text" name="chinese_uni" value="<?php echo $student['chinese_uni'] ?>" /></div>
						<div id="cohort" class="input"><span>Cohort</span><br /><input type="text" name="cohort" size="4" maxLength="4" value="<?php echo $student['cohort'] ?>" /></div>
						<div id="major" class="input"><span>Major</span><br /><input type="text" name="major" size="32" value="<?php echo $student['major'] ?>" /></div>
						<div id="minor" class="input"><span>Minor</span><br /><input type="text" name="minor" size="32" value="<?php echo $student['minor'] ?>" /></div>
						<div id="concentration" class="input"><span>Concentration</span><br /><input type="text" name="concentration" size="33" value="<?php echo $student['concentration'] ?>" /></div>
						<div id="advisor" class="input"><span>Advisor</span><br /><input type="text" name="advisor" size="32" value="<?php echo $student['advisor'] ?>" /></div>
						<div class="clear"></div>
					</div>
					<div class="buttons">
						<input type="submit" value="Submit" />
					</div>
					<div class="clear"></div>
				</form>
			</div>
			
		</div>
	</div>
</body>
</html>



















