<html>

<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>CarFinder</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	 <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" media="all" href="css/style1.css">
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}
function myFunction1() {
    document.getElementById("myDropdown1").classList.toggle("show");
}
function myFunction2() {
    document.getElementById("myDropdown2").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

</script>



	<header id="header">
		<div class="container">
			<a href="home.php" id="logo" title="CarFinder">CarFinder</a>
			<div class="menu-trigger"></div>
			<nav id="menu">
				<ul>
				    <li><a href="home.php">Home</a></li>
					<li>
					<div class="dropdown">
						<button onclick="myFunction()" class="dropbtn" style="border:none; padding: 0; background: none;"><a>Type</a></button>
  						<div id="myDropdown" class="dropdown-content">
    					<a href="results.php?type=hatchback">Hatchback</a>
    					<a href="results.php?type=sedan">Sedan</a>
   						<a href="results.php?type=suv">SUV</a>
   						<a href="results.php?type=minivan">Mini Van</a>
   						<a href="results.php?type=muv">MUV</a>
  					    </div>
					</div>
					</li>
 				</ul>
				<ul>
				    <li><a href="#fancy" class="get-contact">Search</a></li>
					<li><a href="contact.php">Contact Us</a></li>
   				</ul>
			</nav>
			<!-- / navigation -->
		</div>
		<!-- / container -->
	
	</header>
	<!-- / header -->



<?php
require_once('inc/db.php');
$f = 0;
$s=0;

$query="SELECT * FROM car WHERE";
if(isset($_GET['search']))
{	
    $i=0;
	$search = mysqli_real_escape_string($db,$_GET['search']);
    $terms = explode(" ",$search);
	$query ="SELECT * FROM car WHERE ";
    foreach ($terms as $each) {
	$i++;
	if($i == 1){
		$query.="keywords LIKE '%$each%'";
	}
	else{
		$query.="OR keywords LIKE '%$each%'";
	}
}
}
else
{
if (isset($_GET['price']))
{
	$s++;
	$price=$_GET['price'];
	if($price==3)
	{
	$query=$query. " price < 300000";
	}	
	else if($price==7)
	{
	$query=$query. " price > 300000 AND price < 700000";
	}
	else if($price==10)
	{
	$query=$query. " price > 700000 AND price < 1000000";
	}
	else if($price==11)
	{
	$query=$query. " price > 1000000";
	}
}
if (isset($_GET['fuel']))
{
	$fuel=$_GET['fuel'];
	$query=$query." AND fuel='$fuel'";
}
if (isset($_GET['mile']))
{
	$mile=$_GET['mile'];
}
if (isset($_GET['type']))
{
	$type=$_GET['type'];
	if($s>0)
	{
		$query=$query." AND type='$type'";
	}
	else
	{
    	$query=$query." type='$type'";
    }
}
$query=$query. " ";
if (isset($_GET['brand1']))
{
    $a=$_GET['brand1'];
	if($f>0)
	{
		$query=$query." OR brand='$a'";
	}
	else
	{
		$query=$query." AND (brand='$a'";
		$f++;
	}
}
if (isset($_GET['brand2']))
{
	$b=$_GET['brand2'];
	
	if($f>0)
	{
		$query=$query." OR brand='$b'";
	}
	else
	{
		$query=$query." AND (brand='$b'";
		$f++;
	}
}
if (isset($_GET['brand3']))
{
	$c=$_GET['brand3'];
	if($f>0)
	{
		$query=$query." OR brand='$c'";
	}
	else
	{
		$query=$query." AND (brand='$c'";
		$f++;
	}
}
if (isset($_GET['brand4']))
{
	$d=$_GET['brand4'];
	
	if($f>0)
	{
		$query=$query." OR brand='$d'";
		
	}
	else
	{
		$query=$query." AND (brand='$d'";
		$f++;
	}
}
if (isset($_GET['brand5']))
{
    $e=$_GET['brand5'];
	
	if($f>0)
	{
		$query=$query." OR brand='$e'";
	
	}
	else
	{
		$query=$query." AND (brand='$e'";
		$f++;
	}
}
if (isset($_GET['brand6']))
{
	$h=$_GET['brand6'];
	if($f>0)
	{
		$query=$query." OR brand='$h'";
	}
	else
	{
		$query=$query." AND (brand='$h'";
		$f++;
	}
}
if (isset($_GET['brand7']))
{
	$g=$_GET['brand7'];
	
	if($f>0)
	{
		$query=$query." OR brand='$g'";
		
	}
	else
	{
		$query=$query." AND (brand='$g'";
		$f++;
	}
}

if (isset($_GET['brand8']))
{
	$h=$_GET['brand8'];
	
	if($f>0)
	{
		$query=$query." OR brand='$h'";
		
	}
	else
	{
		$query=$query." AND (brand='$h'";
		$f++;
	}
}
if($f>0)
{
	$query=$query.")";
	
}
}
//echo $query;
$result=mysqli_query($db,$query);
$n=mysqli_num_rows($result);
if($n >=1)
{        $k=0;
        echo '<ul class="products">';
	while($i= mysqli_fetch_assoc($result))
	{   
        if ($k%3 == 0) 
        {
     	    echo "<br><br><br>"; 
        }
        //echo str_repeat("&nbsp;", 10);
        echo  '<li>';
        echo "<img src='".$i['image']."' width='320' height='240'>";
        echo '<h4><strong><a href="product.php?item='.$i['no'].'">'.$i['brand'].'</a></strong></h4>';
		echo '<p><font color="orange">₹ '.$i['price'].'</font><p>';
		echo  '</li>';
        $k=$k+1;
        //echo str_repeat("&nbsp;", 100);  
		//echo '<h3>'.$i['descr'].'</h3>';
	}	
        echo '</ul>';
        echo "<br>";
}
else
{
	echo "<br><br><br>"; 
	echo "<h2><strong><font size='6'>No Results Found</font></strong></h2>";
	echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>"; 
}
?>


        





	<footer id="footer">
		<div class="container">
			<section>
				<article class="col-1">
					<h3>Contact</h3>
					<ul>
						<li class="address"><a href="#">CompanyName<br>Kolenchery, India, 683550</a></li>
						<li class="mail"><a href="#">CompanyName@gmail.com</a></li>
						<li class="phone last"><a href="#">(+91) 8281170010</a></li>
					</ul>
				</article>
				<article class="col-3">
					<h3></h3>
				</article>
				<article class="col-4">
					<h3></h3>
				</article>
				<article class="col-2">
					<h3>Quick Links</h3>
					<ul>
						<li><a href="home.php">Home</a></li>
						<li class="last"><a href="contact.php">Contact Us</a></li>
					</ul>
				</article>
			</section>
		</div>
		<!-- / container -->
	</footer>
	<!-- / footer -->

	<div id="fancy">
		<h2 style="color: #7e8798; font-size: 60px; font-family: 'BebasNeue'; line-height: 68px; font-weight: 300; text-align: center; padding-bottom: 53px;">Advanced Search</h2>
			<div>

<form action="results.php" method="GET">     
<h3 style="font-weight:bold;"> Price :</h3>
<label class="rad">
<input type="radio" name="price" value="3" checked="checked">
<i></i> Below 3 Lakhs
</label>&nbsp;
<label class="rad">
<input type="radio" name="price" value="7">
<i></i> 3 lakhs to 7 Lakhs
</label>&nbsp;
<label class="rad">
<input type="radio" name="price" value="10">
<i></i> 7 lakhs to 10 Lakhs
</label>&nbsp;
<label class="rad">
<input type="radio" name="price" value="11">
<i></i> Above 10 Lakhs
</label>&nbsp;
<br>
<br>
<h3 style="font-weight:bold;">Fuel Type :</h3>
<label class="rad">
  <input type="radio" name="fuel" value="petrol" checked="checked"/>
  <i></i> Petrol
</label>&nbsp;
<label class="rad">
  <input type="radio" name="fuel" value="diesel" />
  <i></i> Diesel
</label>&nbsp;
<label class="rad">
  <input type="radio" name="fuel" value="cng" />
  <i></i> CNG
</label>
<br><br>
<h3 style="font-weight:bold;"> Brand :</h3>
<label class="ckb">
  <input type="checkbox" name="brand1" value="ford"/>
  <i></i> Ford
</label>
<label class="ckb">
  <input type="checkbox" name="brand2" value="cheverolet"/>
  <i></i> Cheverolet
</label>
<label class="ckb">
  <input type="checkbox" name="brand3" value="mitsubishi"/>
  <i></i> Mitsubishi
</label>
<label class="ckb">
  <input type="checkbox" name="brand4" value="maruthi"/>
  <i></i> Maruti
</label>
<br><br>
<label class="ckb">
  <input type="checkbox" name="brand5" value="honda"/>
  <i></i> Honda
</label>
<label class="ckb">
  <input type="checkbox" name="brand6" value="toyota"/>
  <i></i> Toyota
</label>
<label class="ckb">
  <input type="checkbox" name="brand7" value="renault"/>
  <i></i> Renault
</label>
<label class="ckb">
  <input type="checkbox" name="brand8" value="hyundai"/>
  <i></i> Hyundai
</label>
<br>
<br>
<h3 style="font-weight:bold;"> Mileage :</h3>
<label class="rad">
  <input type="radio" name="mile" value="10"  />
  <i></i> Less than 10
</label>&nbsp;
<label class="rad">
  <input type="radio" name="mile" value="14" />
  <i></i> 10-14
</label>&nbsp;
<label class="rad">
  <input type="radio" name="mile" value="18" />
  <i></i> 14-18
</label>&nbsp;
<label class="rad">
  <input type="radio" name="mile" value="22" checked="checked" />
  <i></i> 18-22
</label>&nbsp;
<label class="rad">
  <input type="radio" name="mile" value="23" />
  <i></i> Above 22
</label>&nbsp;
<br>
<br>
<h3 style="font-weight:bold;"> Type :</h3>
<label>
  <input type="radio" name="type" value="sedan" checked="checked"/>
  <img src="images/Sedan.png">
</label>
<label>
  <input type="radio" value="SUV" name="type"/>
  <img src="images/MUVSUV.png">
</label>
<label>
  <input type="radio" value="hatchback" name="type"/>
  <img src="images/Hatchback.png">
</label>
<label>
  <input type="radio" value="minivan name="type"/>
  <img src="images/Minivan.png">
</label>
<br>
<br>
<button class="myButton">Filter!</button>
</form>
			</div></div>

 

    
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/main.js"></script>
</body>
</html>