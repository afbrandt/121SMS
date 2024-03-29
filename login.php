<?PHP
require_once("./include/membersite_config.php");

if(isset($_POST['submitted']))
{
   if($fgmembersite->Login())
   {
        $fgmembersite->RedirectToURL("login-home.php");
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
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
</head>
<body>
	<div id="top">
		<div id="header">
			<div id="topHeader"></div>
			<div id="topLogin">
				<div class="loginButton"><a href='login.php'>LOGIN</a></div>
			</div>
		</div>
	</div>
	<div id="main">
		<div id="mainHeader">
			<div id="pageTitle"><h2>Login</h2></div>
		</div>
		<div id="userMenu">
		</div>
		<div class="clear"></div>
		
		<!-- Form Code Start -->
		<div id='fg_membersite' class="mainBody">
			<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>

				<input type='hidden' name='submitted' id='submitted' value='1'/>

				<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
				<div class='container'>
					<label for='username' >UserName:</label><br/>
					<input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
					<span id='login_username_errorloc' class='error'></span>
				</div>
				<div class='container'>
					<label for='password' >Password:</label><br/>
					<input type='password' name='password' id='password' maxlength="50" /><br/>
					<span id='login_password_errorloc' class='error'></span>
				</div>

				<div class='container' id="loginButton">
					<input type='submit' name='Submit' value='Submit' />
				</div>
				<div class='short_explanation'><a href='reset-pwd-req.php'>Forgot Password?</a></div>
			</form>
			<!-- client-side Form Validations:
			Uses the excellent form validation script from JavaScript-coder.com-->

			<script type='text/javascript'>
			// <![CDATA[

				var frmvalidator  = new Validator("login");
				frmvalidator.EnableOnPageErrorDisplay();
				frmvalidator.EnableMsgsTogether();

				frmvalidator.addValidation("username","req","Please provide your username");
				
				frmvalidator.addValidation("password","req","Please provide the password");

			// ]]>
			</script>
		</div>
		<!--
		Form Code End (see html-form-guide.com for more info.)
		-->
	
	</div>

</body>
</html>