<?php 
error_reporting(E_ALL | E_STRICT);
require_once "config.php";
require_once "login.class.php";
$message           =   "";
$log               =   new Login();
if(isset($_POST['uidLogin']))
{

	$user		=	trim($_POST['user']);
	if(!$_POST['user'])
	{
		$message	=	"Please scan your barcode";

	}
    else{ 
		
		if(eregi('[0-9]{13}',$user)){
			$barcode	=	$user;
			$message	=	$log->barcode_Scanning($barcode);
		}
		else{
			$message="Invalid username or barcode";
		}
	}
}
?>


  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta name="keywords" content="" />

  
  <meta name="description" content="" />

  
  <meta http-equiv="content-type" content="text/html; charset=utf-8" /><title>MUM.MyAttendance.us - Friction Free Attendance Tracking and Reporting</title>
  
<link href="style1.css" rel="stylesheet" type="text/css">
<script type="text/javascript">

/***********************************************

display Clock

***********************************************/

var imageclock=new Object()
	//Enter path to clock digit images here, in order of 0-9, then "am/pm", then colon image:
	imageclock.digits=["clockimages/c0.gif", "clockimages/c1.gif", "clockimages/c2.gif", "clockimages/c3.gif", "clockimages/c4.gif", "clockimages/c5.gif", "clockimages/c6.gif", "clockimages/c7.gif", "clockimages/c8.gif", "clockimages/c9.gif", "clockimages/cam.gif", "clockimages/cpm.gif", "clockimages/colon.gif"]
	imageclock.instances=0
	var preloadimages=[]
	for (var i=0; i<imageclock.digits.length; i++){ //preload images
		preloadimages[i]=new Image()
		preloadimages[i].src=imageclock.digits[i]
	}

	imageclock.imageHTML=function(timestring){ //return timestring (ie: 1:56:38) into string of images instead
		var sections=timestring.split(":")
		if (sections[0]=="0") //If hour field is 0 (aka 12 AM)
			sections[0]="12"
		else if (sections[0]>=13)
			sections[0]=sections[0]-12+""
		for (var i=0; i<sections.length; i++){
			if (sections[i].length==1)
				sections[i]='<img src="'+imageclock.digits[0]+'" />'+'<img src="'+imageclock.digits[parseInt(sections[i])]+'" />'
			else
				sections[i]='<img src="'+imageclock.digits[parseInt(sections[i].charAt(0))]+'" />'+'<img src="'+imageclock.digits[parseInt(sections[i].charAt(1))]+'" />'
		}
		return sections[0]+'<img src="'+imageclock.digits[12]+'" />'+sections[1]+'<img src="'+imageclock.digits[12]+'" />'+sections[2]
	}

	imageclock.display=function(){
		var clockinstance=this
		this.spanid="clockspan"+(imageclock.instances++)
		document.write('<span id="'+this.spanid+'"></span>')
		this.update()
		setInterval(function(){clockinstance.update()}, 1000)
	}

	imageclock.display.prototype.update=function(){
		var dateobj=new Date()
		var currenttime=dateobj.getHours()+":"+dateobj.getMinutes()+":"+dateobj.getSeconds() //create time string
		var currenttimeHTML=imageclock.imageHTML(currenttime)+'<img src="'+((dateobj.getHours()>=12)? imageclock.digits[11] : imageclock.digits[10])+'" />'
		document.getElementById(this.spanid).innerHTML=currenttimeHTML

	}


</script>

<script type="text/javascript">
// scroll function
<!--
function toTop(id){
document.getElementById(id).scrollTop=0
}

defaultStep=6
step=defaultStep
function scrollDivDown(id){
document.getElementById(id).scrollTop+=step
timerDown=setTimeout("scrollDivDown('"+id+"')",10)
}

function scrollDivUp(id){
document.getElementById(id).scrollTop-=step
timerUp=setTimeout("scrollDivUp('"+id+"')",10)
}

function toBottom(id){
document.getElementById(id).scrollTop=document.getElementById(id).scrollHeight
}

function toPoint(id){
document.getElementById(id).scrollTop=100
}
// -->
</script> 
</head>


<body onLoad="document.f1.user.focus()">
<div id="wrapper">
<br />
<!-- Note: This page has minimal design and formatting. We are waiting on a
decision about who will be responsible for designing the MUM attendance
pages<br />
<span style="font-style: italic;">For an example of a page with similar function, but designed and formatted see <a href="http://myattendance.us/">http://myattendance.us/</a></span>
-->
<!-- end #header -->
<div id="sidebar">
<?	date_default_timezone_set("US/Central");

	$date = date("Y-m-d");
	$ampm = date('a', time());
	$time = date('h:i:s', time());
	$ap=strtoupper($ampm);
if($ampm == "am") $wish = "Good Morning,";
if($ampm == "pm") $wish = "Good Afternoon,";
	 
?>

 <div id="clock" style="float: left;">
<script type="text/javascript">

/*
Display date
*/

var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var dayarray=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
document.write("<small><font color='#484895' face='Arial' size='6'><b>"+dayarray[day]+", "+montharray[month]+" "+daym+", "+year+"</b></font></small>")
</script>
<br />
<script>
new imageclock.display()
</script> 
<?php 
   if($message != ""){ 
echo "<br ><br ><p style=\"color: rgb(130, 158, 217); font-size: 20px; text-align: center; width: 978px;\">$wish $message</p>";
}
   else echo "<p style=\"color: rgb(130, 158, 217); font-size: 20px; text-align: left; width: 978px;\">$wish Please scan your Barcode</p>";
?>
</div> 
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="f1">
    <table style="width: 978px; height: 50px;" border="0" cellpadding="3" cellspacing="1" align="left">
      <tbody>
        <tr>
          <td><input type="text" maxlength="40" size="16" name="user" style="background-color: white; border: medium none; color: white;"></td></tr>
         <tr><td><input name="uidLogin" value="true" type="hidden" /><input type="submit" value="Submit" name="submit" style="visibility: hidden;"></td>
        </tr>

      </tbody>
    </table>
  </form>
</div>


  
<?php
require_once "config.php";
date_default_timezone_set("US/Central");
$date = date("Y-m-d");
$k=0;
$ampm = date('a', time());
$q="SELECT * FROM `attendanceTime` WHERE date='$date' ORDER BY `timeId` DESC";
$res=mysql_query($q)or die(mysql_error());
echo "<div id=\"div1\" style=\"width:92%; height:0px;\">";
echo "<div id=\"ScannedText\">";
echo "<ul>";
$count=0;
while($row = mysql_fetch_array($res)){
$count++;
if($count==6) break;
$color =array("red",'green',"blue");
$k++;
if($k==2){
$k=0;
}
	$fn=$row['firstName'];
	$ln=$row['lastName'];
	$i=$row['i'];
	$j=$row['j'];
	$inAM=$row['inAM'];
	$inPM=$row['inPM'];
	$greeting= array("Jai Guru Dev",
			"Life is bliss",
			"TM in the AM and PM",
			"Every hop is a cosmic smile",
			"No one has the right to suffer",
			"Welcome to group program",
			"Glad you made it today",
			"Thanks for coming",
			"Have a blissful,
			 deep program");
	$logmsg= array("Your attendance scan time is",
			"We've recorded your scan time as",
			"The time of your scan is",
			"This is your scan time",
			"You're in the database at");
			$ap=strtoupper($ampm);
	if($ampm == "am" && $inPM !="00:00:00")
	{	
		echo "<li><p class='greeting'>$greeting[$i],<span class=\"name\"> $fn $ln</span><br /> $logmsg[$j] <span class=\"name\">$inAM $ap</span></p></li>" ;
	}
	elseif($ampm == "pm" && $inPM !="00:00:00")
	{
		echo "<li><p class='greeting'>$greeting[$i],<span class=\"name\"> $fn $ln</span><br /> $logmsg[$j] <span class=\"name\">$inPM $ap</span></p></li>" ;
	}
}

?>
</ul>
<div>
</div>  

<!-- end #sidebar -->
<div style="clear: both;">&nbsp;</div>

<div id="footer">
<p><br /><br /><br /><br /><br /><br />Copyright (c) 2011 wakarusa river, A Fairfield, IA Company. All
rights reserved.<br />
</p>
</div>
<!-- end #footer -->
</div>

</body></html>
