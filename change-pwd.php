<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

if(isset($_POST['submitted']))
{
   if($fgmembersite->ChangePassword())
   {
        $fgmembersite->RedirectToURL("changed-pwd.html");
   }
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Login</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
	  <link rel="STYLESHEET" type="text/css" href="style/style.css" />
	  <link rel="STYLESHEET" type="text/css" href="style/pwdwidget.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
	  <script src="scripts/pwdwidget.js" type="text/javascript"></script>   
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
			<div id="pageTitle"><h2>Change Password</h2></div>
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
		
		<!-- Form Code Start -->
		<div id='fg_membersite' class="mainBody">
			<form id='changepwd' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
			
					<input type='hidden' name='submitted' id='submitted' value='1'/>

					<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
					<div class='container'>
						<label for='oldpwd' >Old Password:</label><br/>
						<div class='pwdwidgetdiv' id='oldpwddiv' ></div><br/>
						<noscript>
						<input type='password' name='oldpwd' id='oldpwd' maxlength="50" />
						</noscript>    
						<span id='changepwd_oldpwd_errorloc' class='error'></span>
					</div>

					<div class='container'>
						<label for='newpwd' >New Password:</label><br/>
						<div class='pwdwidgetdiv' id='newpwddiv' ></div>
						<noscript>
						<input type='password' name='newpwd' id='newpwd' maxlength="50" /><br/>
						</noscript>
						<span id='changepwd_newpwd_errorloc' class='error'></span>
					</div>

					<br/>
					<div class='container' id="changeButton">
						<input type='submit' name='Submit' value='Submit' />
					</div>
			</form>
		<!-- client-side Form Validations:
		Uses the excellent form validation script from JavaScript-coder.com-->

		<script type='text/javascript'>
		// <![CDATA[
			var pwdwidget = new PasswordWidget('oldpwddiv','oldpwd');
			pwdwidget.enableGenerate = false;
			pwdwidget.enableShowStrength=false;
			pwdwidget.enableShowStrengthStr =false;
			pwdwidget.MakePWDWidget();
			
			var pwdwidget = new PasswordWidget('newpwddiv','newpwd');
			pwdwidget.MakePWDWidget();
			
			
			var frmvalidator  = new Validator("changepwd");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();

			frmvalidator.addValidation("oldpwd","req","Please provide your old password");
			
			frmvalidator.addValidation("newpwd","req","Please provide your new password");

		// ]]>
		</script>

		</div>
		<!--
		Form Code End (see html-form-guide.com for more info.)
		-->
	</div>

</body>
</html>