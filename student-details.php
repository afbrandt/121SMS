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
	  <link rel="STYLESHEET" type="text/css" href="style/student-details.css">
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

			
			// Make a MySQL Connection
			mysql_connect("localhost", "admin_121", "CSC263121") or die(mysql_error());
			mysql_select_db("121sms") or die(mysql_error());

			// Retrieve all the data from the "student" table
			$student = mysql_query("SELECT * FROM student where ssu_id = '".$_POST["student_id"]."'")
			or die(mysql_error());  

			$row = mysql_fetch_array( $student );
			?>
				
				
			<div id="basicInfo">
				<div class="tableTitle">Basic Information</div>
				<div class="tableRow">
					<div class="tableLabel">Name:</div>
					<div class="tableField"><? echo $row["fname"]." ".$row["lname"]?></div>
					<div class="clear"></div>
				</div>
				<div class="altTableRow">
					<div class="tableLabel">SSU ID:</div>
					<div class="tableField"><? echo $row["ssu_id"]?></div>
					<div class="clear"></div>
				</div>
				<div class="tableRow">
					<div class="tableLabel">Chinese School:</div>
					<div class="tableField"><? echo $row["chinese_uni"]?></div>
					<div class="clear"></div>
				</div>
				<div class="altTableRow">
					<div class="tableLabel">Advisor:</div>
					<div class="tableField">
					<?php
						if ($row["advisor"]==null)
							echo "Not set";
						else
							echo $row["advisor"];
					?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div id="result">
				<div class="tableTitle">Results</div>
				<div class="tableRow">
					<div class="tableLabel">Total Credits:</div>
					<div class="tableField"><? echo $_POST["credits"]?></div>
					<div class="clear"></div>
				</div>
				<div class="altTableRow">
					<div class="tableLabel">GPA:</div>
					<div class="tableField"><? echo $_POST["gpa"]?></div>
					<div class="clear"></div>
				</div>
				<div class="tableRow">
					<div class="tableLabel">TOEFL/IBT:</div>
					<div class="tableField"></div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
			
			<div class="semesterPerformance">
				<table id="performance">
					<tr>
						<th>Course Title</th>
						<th>Course Number</th>
						<th>Credit</th>
						<th>Grade</th>
					</tr>
					<?php
					
						$course = mysql_query("SELECT d.dept_name, CONCAT(c.course_subj, ' ', c.course_num) as 'course', c.course_title, c.num_credits FROM course c, department d
	where d.dept_code = c.course_subj;") or die(mysql_error());
				
						$performanceDb = mysql_query("Select c.course_title, CONCAT(c.course_subj, ' ', c.course_num) as 'course', c.num_credits, p.perf_grade
	from performance p, course c where c.course_subj = p.perf_course_subj and c.course_num=p.perf_course_num and student_id='".$_POST["student_id"]."'") or die(mysql_error());
						
						$performanceRow = mysql_fetch_array( $performanceDb );
						
						for($i=0;$i<mysql_num_rows($performanceDb); $i++)
						{
							echo "<tr>";
							echo "<td>".mysql_result($performanceDb, $i, "course_title")."</td>";
							echo "<td>".mysql_result($performanceDb, $i, "course")."</td>";
							echo "<td>".mysql_result($performanceDb, $i, "num_credits")."</td>";
							echo "<td>".mysql_result($performanceDb, $i, "perf_grade")."</td>";
							echo "</tr>";
						}
					?>
				</table>
			</div>
			
		</div>
	</div>
</body>
</html>
