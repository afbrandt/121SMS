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
			<div id="pageTitle"><h2>Students</h2></div>
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
		
			<!--****************** Students Table BEGIN *********************-->
		
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
				
				// store the record of the "example" table into $row
				$row = mysql_fetch_array( $student );
				// Print out the contents of the entry 

				/*echo "First Name: ".$row['fname']."\n";
				echo "Last Name: ".$row['lname'];*/
			?>
				
			<table id="reportTable">
				<tr>
					<th>No.</th>
					<th>Chinese University</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Gender</th>
					<th>SSU ID#</th>
					<th>Major</th>
					<th>Toefl/IBT/IELTS*</th>
					<th>Total Credits</th>
					<th>GPA **</th>
					<th>Student Operations</th>
				</tr>
				<?php
				for($i=0;$i<mysql_num_rows($student); $i++)
				{
					//calculate the credits of a particular student
					$credits = 0;
					$weightedGrade = 0;
					for($j=0; $j<mysql_num_rows($performanceDb); $j++)
					{
						if (mysql_result($performanceDb, $j, "student_id")==mysql_result($student, $i, "ssu_id"))
						{
							$credits +=	mysql_result($performanceDb, $j, "num_credits");
							$weightedGrade += mysql_result($performanceDb, $j, "num_credits") * mysql_result($performanceDb, $j, "perf_grade");
						}
					}
					
					if ($credits==0) {
						$gpa = 0;
					}
					else if ($credits>0) {
						$gpa = $weightedGrade/$credits;
					}
					
					echo "<tr>";
					echo "<td>".($i+1)."</td>";
					echo "<td>".mysql_result($student, $i, "chinese_uni")."</td>";
					echo "<td>".mysql_result($student, $i, "lname")."</td>";
					echo "<td>".mysql_result($student, $i, "fname")."</td>";
					echo "<td>".mysql_result($student, $i, "sex")."</td>";
					echo "<td>".mysql_result($student, $i, "ssu_id")."</td>";
					echo "<td>".mysql_result($student, $i, "major")."</td>";
					echo "<td>test</td>";
					echo "<td>".$credits."</td>";
					echo "<td>".$gpa."</td>";
					echo	"<td>
								<div class=\"reportButtons\">
									<form action=\"student-details.php\" method=\"post\">
										<input type=\"hidden\" name=\"student_id\" value=\"".mysql_result($student, $i, "ssu_id")."\">
										<input type=\"hidden\" name=\"gpa\" value=\"".$gpa."\">
										<input type=\"hidden\" name=\"credits\" value=\"".$credits."\">
										<div class=\"reportButton\" id=\"detailsButton\"><input type=\"submit\" value=\"View\" /></div>
									</form>
									<form action=\"edit-student.php\" method=\"post\">
										<input type=\"hidden\" name=\"studentQuery\" value=\"".mysql_result($student, $i, "ssu_id")."\">
										<div class=\"reportButton\" id=\"editButton\"><input type=\"submit\" value=\"Edit\" /></div>
									</form>
									<form action=\"delete-student.php\" method=\"post\">
										<input type=\"hidden\" name=\"studentQuery\" value=\"".mysql_result($student, $i, "ssu_id")."\">
										<div class=\"reportButton\" id=\"deleteButton\"><input type=\"submit\" value=\"Delete\" /></div>
									</form>
								</div>
							</td>";
					echo "</tr>";
					
					//updating i to go to next student with <tr class"alt">
					$i+=1;
					if($i<mysql_num_rows($student))
					{
						$credits = 0;
						$weightedGrade = 0;
						for($j=0; $j<mysql_num_rows($performanceDb); $j++)
						{
							if (mysql_result($performanceDb, $j, "student_id")==mysql_result($student, $i, "ssu_id"))
							{
								$credits +=	mysql_result($performanceDb, $j, "num_credits");
								$weightedGrade += mysql_result($performanceDb, $j, "num_credits") * mysql_result($performanceDb, $j, "perf_grade");
							}
						}
						
						if ($credits==0) {
						$gpa = 0;
						}
						else if ($credits>0) {
							$gpa = $weightedGrade/$credits;
						}
						
						echo "<tr class=\"alt\">";
						echo "<td>".($i+1)."</td>";
						echo "<td>".mysql_result($student, $i, "chinese_uni")."</td>";
						echo "<td>".mysql_result($student, $i, "lname")."</td>";
						echo "<td>".mysql_result($student, $i, "fname")."</td>";
						echo "<td>".mysql_result($student, $i, "sex")."</td>";
						echo "<td>".mysql_result($student, $i, "ssu_id")."</td>";
						echo "<td>".mysql_result($student, $i, "major")."</td>";
						echo "<td>test</td>";
						echo "<td>".$credits."</td>";
						echo "<td>".$gpa."</td>";
						echo	"<td>
									<div class=\"reportButtons\">
										<form action=\"student-details.php\" method=\"post\">
											<input type=\"hidden\" name=\"student_id\" value=\"".mysql_result($student, $i, "ssu_id")."\">
											<input type=\"hidden\" name=\"gpa\" value=\"".$gpa."\">
											<input type=\"hidden\" name=\"credits\" value=\"".$credits."\">
											<div class=\"reportButton\" id=\"detailsButton\"><input type=\"submit\" value=\"View\" /></div>
										</form>
										<form action=\"edit-student.php\" method=\"post\">
											<input type=\"hidden\" name=\"studentQuery\" value=\"".mysql_result($student, $i, "ssu_id")."\">
											<div class=\"reportButton\" id=\"editButton\"><input type=\"submit\" value=\"Edit\" /></div>
										</form>
										<form action=\"edit-student.php\" method=\"post\">
											<input type=\"hidden\" name=\"studentQuery\" value=\"".mysql_result($student, $i, "ssu_id")."\">
											<div class=\"reportButton\" id=\"deleteButton\"><input type=\"submit\" value=\"Delete\" /></div>
										</form>
									</div>
								</td>";
						echo "</tr>";
					}
				}
				
				/*
				"<td>".mysql_query("select sum(credits.num_credits) from (Select c.course_subj, c.course_num, c.num_credits, p.student_id from performance p, course c
				where c.course_subj = p.perf_course_subj and c.course_num=p.perf_course_num and student_id) as credits
				where student_id = '".mysql_result($student, $i, "ssu_id")."'")."</td>";

				<div class="student">
					<?php printf("First Name: %s \n", $row['fname']);?><br />
					<?php printf("Last Name: %s \n", $row['lname']);?>
				</div>
				*/
				
				?>
			</table>
		
		<!--******************* Students Table End ********************-->
		
		</div>
		
	</div>
</body>
</html>
