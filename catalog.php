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
      <title>1+2+1 Program - Generate Reports</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
	  <link rel="STYLESHEET" type="text/css" href="style/style.css">
	  <link rel="STYLESHEET" type="text/css" href="style/reports.css">
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
			<div id="pageTitle"><h2>Reports</h2></div>
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
				// Make a MySQL Connection
				mysql_connect("localhost", "admin_121", "CSC263121") or die(mysql_error());
				mysql_select_db("121sms") or die(mysql_error());

				// Retrieve all the data from the "student" table
				$student = mysql_query("SELECT * FROM student")
				or die(mysql_error());  
				
				// Retrieve all the data from the "performance" table
				$performance = mysql_query("SELECT * FROM performance")
				or die(mysql_error());

				
				$performanceDb = mysql_query("Select c.course_subj, c.course_num, c.num_credits, p.perf_grade, p.student_id from performance p, course c
where c.course_subj = p.perf_course_subj and c.course_num=p.perf_course_num ") or die(mysql_error());
				
			?>
		
		<!--****************** Department Table BEGIN *********************-->

			<p><h2>Course Subjects</h2></p>
			<?php

				// Retrieve all the data from the "student" table
				$department = mysql_query("SELECT * FROM department") or die(mysql_error());  

				// store the record of the "example" table into $row
				$row = mysql_fetch_array( $department );
			?>
				
			<table id="reportTable">
				<tr>
					<th>No.</th>
					<th>Department Code</th>
					<th>Department Name</th>
					<th>Dept Operations</th>
				</tr>
				<?php
				for($i=0;$i<mysql_num_rows($department); $i++)
				{	
					echo "<tr>";
					echo "<td>".($i+1)."</td>";
					echo "<td>".mysql_result($department, $i, "dept_code")."</td>";
					echo "<td>".mysql_result($department, $i, "dept_name")."</td>";
					echo "<td><div class=\"courseButton\" id=\"viewButton\"><a href=\"courses.php?subject=".mysql_result($department, $i, "dept_code")."\">View Courses</a></div></td>";
					echo "</tr>";
					
					//updating i to go to next student with <tr class"alt">
					$i+=1;
					if($i<mysql_num_rows($department))
					{						
						echo "<tr class=\"alt\">";
						echo "<td>".($i+1)."</td>";
						echo "<td>".mysql_result($department, $i, "dept_code")."</td>";
						echo "<td>".mysql_result($department, $i, "dept_name")."</td>";
						echo "<td><div class=\"courseButton\" id=\"viewButton\"><a href=\"courses.php?subject=".mysql_result($department, $i, "dept_code")."\">View Courses</a></div></td>";
						echo "</tr>";
					}
				}
				
				?>
			</table>

		<!--******************* Department Table End ********************-->
	
		
		</div>
		
	</div>
</body>
</html>
