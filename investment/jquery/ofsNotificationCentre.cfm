<!--- --------------------------------------------------------------------------
	ofsNotificationCentre.cfm
--------------------------------------------------------------------------- --->
<CFINCLUDE TEMPLATE="ofsSecure.cfm">
<CFSCRIPT>
	this.PageTitle = "Notification Centre";
	this.PageName = "ofsNotificationCentre.cfm";

	objNotifications = CreateObject("component","ofsNotificationCentre");

	this.Mode = "";
	if ( IsDefined("URL.Mode") ) {
	  this.Mode = URL.Mode;
	}

</CFSCRIPT>

<!--- --------------------------------------------------------------------------
	Javascript Section
--------------------------------------------------------------------------- --->

<!--- --------------------------------------------------------------------------
	Mode Section
--------------------------------------------------------------------------- --->

<CFSCRIPT>
   if (this.Mode EQ "MarkAsRead") {
      if ( !fnValidateNtUID() ) {
         location(url="ofsException.cfm");
   	  }
	  else {
         objNotifications.MarkNotificationAsRead(Decrypt(URL.ntUID, Application.EncryptionKey, Application.EncryptionMethod));

         location(url="#this.PageName#");
      }
   }
</CFSCRIPT>

<!--- --------------------------------------------------------------------------
      HTML Section
--------------------------------------------------------------------------- --->
<CFOUTPUT>
<html>
<head>
	<title>#Application.AppTitle# - #this.PageTitle#</title>
	<meta http-equiv="pragma" content="no-cache">
</head>
<body bgcolor=white topmargin=0 >
	<CFINCLUDE TEMPLATE="#Application.Header#">
	<CFSCRIPT>
	   objMenu = CreateObject("component","ofsMenu");
	   objMenu.fnMenuBar();

	   // Get the notifications for this user
	   rsUserNotifications = objNotifications.GetNotifications(rsUser.usId);
	</CFSCRIPT>

<STYLE>

.notification {
	 background-color:##ddd;
	 padding:10px;
	 border:1px solid ##ccc;
	 border-radius:5px;
	 margin:15px;
	 text-align:left;
	font-family: Arial, Verdana, Sans-Serif !important;
	font-size: 20px;
}
.notification-subject {
	font-weight: Bold;
	text-align: left;
	padding:3pt;
	font-size:10pt;
}
.notification-CodeDesc {
	font-weight: Bold;
	text-align: right;
	padding:3pt;
	font-size:8pt;
}
.notification-Content {
	padding:3pt;
	font-size:9pt;
}
.notification-Date {
	text-align: right;
	padding:3pt;
	font-size:9pt;
}

.notification a{
	display:none;
}
.notification:hover a {
  display:block;
}
</STYLE>

	<div class="container">
	<div class="row justify-content-md-center" style="min-height: 400px !important;">
	<div class="col-sm-12 col-md-12 col-lg-8">
	<div class="text-center">
		<h2><strong>Notification Centre</strong></h2>

		<CFIF rsUserNotifications.RecordCount GT 0>
			<CFLOOP QUERY="rsUserNotifications">
			<div class="notification">

				<table width="100%" border="0">
					<tr><td class="notification-subject" width="70%"><strong>#alSubject#</strong></td>
						<td class="notification-codeDesc">#acDescription#</td>
						<td><a href="#this.PageName#?Mode=MarkAsRead&ntUID=#URLEncodedFormat(Encrypt(ntid, Application.EncryptionKey, Application.EncryptionMethod ))#" align="right"><span style="color: red"><i class="fa fa-flag" aria-hidden="true"></i></span></a></td>
					</tr>
					</td><td colspan="3" class="notification-date">#DateTimeFormat(alUpdate, "mmmm dd, yyyy h:nn a")#</td></tr>
					<tr><td colspan="3"><hr style="padding: 0px; margin: 0px;"></td></tr>
					<tr><td class="notification-Content" colspan="3">#alDetail#</td></tr>
				</table>
			</div>
			</CFLOOP>
		<CFELSE>
			<div class="notification">
				<div class="notification-Content" align="center">There are currently no notifications</div>
			</div>
		</CFIF>
	</div>

	<center>
	<input class="btnBlack" type="button" value=" Close " OnClick="javascript:location.href='ofsMenu.cfm';" >
	</center>
	</div></div>
	</div>

	<br><br><br><br>
	<CFINCLUDE TEMPLATE="#Application.Footer#">
</body>
</html>

<!--- -----------------------------------------------------------------------------------------------------------------------
      fnValidateNtUID - prevent user from tampering with the encrypted URL parameter UID.  Example: Mode=MarkAsRead&ntUID=10
------------------------------------------------------------------------------------------------------------------------ --->
<CFFUNCTION NAME="fnValidateNtUID" OUTPUT=TRUE>

	<CFSET bValidUID = "True">

	<CFTRY>
		<CFSET AttemptDecrypt = Decrypt(URL.ntUID, Application.EncryptionKey, Application.EncryptionMethod )>
		<CFCATCH type="any"><CFSET bValidUID = "False"></CFCATCH>
 	</CFTRY>

 	<CFRETURN bValidUID>

</CFFUNCTION>

</CFOUTPUT>

