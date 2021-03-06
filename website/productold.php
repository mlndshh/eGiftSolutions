<!doctype html>
<?php
//include('session.php');


if (isset($_POST["addtocart"]))
{
	$pid=strval($_POST["addtocart"]);
	$q=$_POST["quantity"];
	$formset=0; //shows which product's quantity was set
	foreach($q as $value)
	{
		if($value!=NULL)
			break;
		$formset++;
	}	
	
	@$qval=$q[$formset];
	if($qval==0)
		$qval=1;
	
	if(isset($_COOKIE["cartarray"])==FALSE)
	{
		$array=array($pid=>$qval);
		$send=json_encode($array);
		setcookie("cartarray",$send,time()+(86400*7),"/");
		echo "<script type='text/javascript'>alert('Product Added to Cart')</script>";
	}
	else
	{
		$receive=$_COOKIE["cartarray"];
		$array=json_decode($receive);
		$array2 = json_decode(json_encode($array), True);
		if(array_key_exists($pid,$array2)==1)
		{
			echo "<script type='text/javascript'>alert('Product Already in Cart')</script>";
			
		}
		else
		{
			$temparray=array($pid=>$qval);
			$array2=array_merge($array2,$temparray);
			$send=json_encode($array2);
			setcookie("cartarray",$send,time()+(86400*7),"/");
			echo "<script type='text/javascript'>alert('Product Added to Cart')</script>";
		}
	}
}
?>
<html>


<head>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-orange.min.css" />
	<link rel="stylesheet" href="styles.css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery.fancybox.min.css">
	<script src="jquery.fancybox.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A catalogue ay">

	<script>
	
	function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

	
	var slideIndex = 1;
	showDivs(slideIndex);

	function plusDivs(n) {
	showDivs(slideIndex += n);
	}

	function currentDiv(n) {
	showDivs(slideIndex = n);
	}

	function showDivs(n) {
	var i;
	var x = document.getElementsByClassName("mySlides");
	var dots = document.getElementsByClassName("demo");
	if (n > x.length) {slideIndex = 1}    
	if (n < 1) {slideIndex = x.length}
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";  
	}
	for (i = 0; i < dots.length; i++) {
		dots[i].className = dots[i].className.replace("mdl-button mdl-js-button mdl-button--raised mybuttonnumber demo", "mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybuttonnumber demo");
	}
	x[slideIndex-1].style.display = "block";  
	dots[slideIndex-1].className = "mdl-button mdl-js-button mdl-button--raised mybuttonnumber demo";
	
	}
</script>
	
	
	
</head>


<body>
	<!--header-->
	<!--form-->
	<form id="sendproduct" method="get" action="product.php">
	</form>
	<form id="sendcategory" method="get" action="category.php">
	</form>
	<form id="cart" method="post" action="home.php">
	</form>
	<?php
	include('session.php');
	$servername = "localhost";
			$username = "admin";
			$password = "admin";

			// Create connection
			$conn = new mysqli($servername, $username, $password);
			// Check connection
			if (mysqli_connect_error()) 
			{
				die("Database connection failed: " . mysqli_connect_error());
			}
	?>
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header class="mdl-layout__header">
			<div class="mdl-layout__header-row">
				<!-- Title -->
				<span class="mdl-layout-title">Gift Shop</span>
				<!-- Add spacer, to align navigation to the right -->
				<div class="mdl-layout-spacer"></div>
	  
				<!-- Navigation. We hide it in small screens. -->
				<nav class="mdl-navigation mdl-layout--large-screen-only">
					<a class="mdl-navigation__link" href="template.html">Home</a>
					<a class="mdl-navigation__link" href="">Products</a>
					<a class="mdl-navigation__link" href="">Contact Us</a>
					<a class="mdl-navigation__link" href="">About Us</a>
					<a class="mdl-navigation__link" href="test.html">Test</a>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
						mdl-textfield--floating-label mdl-textfield--align-right">
						<label class="mdl-button mdl-js-button mdl-button--icon"
							for="fixed-header-drawer-exp">
							<i class="material-icons">search</i>
						</label>
						<div class="mdl-textfield__expandable-holder">
							<input class="mdl-textfield__input" type="text" name="sample"
							id="fixed-header-drawer-exp">
						</div>
					</div>
				</nav>
				
				<!--mobile only to show search bar-->     
				<nav class="mdl-navigation mdl-layout--small-screen-only">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
						mdl-textfield--floating-label mdl-textfield--align-right">
						<label class="mdl-button mdl-js-button mdl-button--icon"
							for="fixed-header-drawer-exp-2">
							<i class="material-icons">search</i>
						</label>
						<div class="mdl-textfield__expandable-holder">
							<input class="mdl-textfield__input" type="text" name="search"id="fixed-header-drawer-exp-2">
						</div>
					</div>
				</nav>
			</div>
		</header>
  <div class="mdl-layout__drawer">
	<span class="mdl-layout-title">Gift Shop</span>
	<nav class="mdl-navigation">
      <a class="mdl-navigation__link hamfont" href="home.php"><i class="material-icons iconspacing">home</i>Home</a>
      <a class="mdl-navigation__link hamfont" href=""><i class="material-icons iconspacing">store</i>Products</a>
	  <a class="mdl-navigation__link hamfont" href="#" id="submenu"><i class="material-icons iconspacing">toc</i>Categories
              <i class="material-icons arrow" role="presentation">arrow_drop_down</i>
 
	  </a>
      <a class="mdl-navigation__link hamfont" href=""><i class="material-icons iconspacing">email</i>Contact Us</a>
      <a class="mdl-navigation__link hamfont" href=""><i class="material-icons iconspacing">info</i>About Us</a>
	 
    </nav>
	<!-- sub menu only visible when clicked on the link above -->
	<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect " for="submenu">
		<?php
		$category="select distinct products.category1 from giftshop.products";
		$categoryres=$conn->query($category);
		while($categoryarray = $categoryres->fetch_assoc())
		{
			$currentcategory=$categoryarray["category1"];
			
			echo "<li class=\"mdl-menu__item\"><button class=\"mdl-menu__item linknostyle\" type=\"submit\" name=\"categoryname\" value=\"$currentcategory\" form=\"sendcategory\">";
			echo $currentcategory . "</button></li>";
		}
		?>
	</ul>
  </div>
  <main class="mdl-layout__content">
    <div class="page-content"><!-- Your content goes here -->
		<div class="mdl-grid">
			<?php
			

			
			
			$prod_id=$_GET['id'];
			$countsql="select count(products_images.product_id) AS count from giftshop.products_images where products_images.product_id=$prod_id ";
			$countres=$conn->query($countsql);
			$countarr= $countres ->fetch_assoc();
			
			
			?>
			
			<div id="wrapper">
			<div class="slideshow" style="max-width:300px">
			
			
			
			<?php
			
			for($i=1;$i<=$countarr["count"];$i++)
			{
				echo "<img class=\"mySlides\" id=\"img$i\" src=\"/giftshop/images/$prod_id/$i.jpg\" style=\"width:100%;\">
				";
				
			}
			
			?>
			
			<script>
			document.getElementById('img1').style.display = "block";
			
			<script type="text/javascript">
			$("[data-fancybox]").fancybox({
				// Options will go here
			});
</script>
			</script>
				
			</div>
			
			<div class="mycenter">
				<div class="w3-section">
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" onclick="plusDivs(-1)">&#10094; Prev</button>
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2" onclick="plusDivs(1)">Next &#10095;</button>
				</div>
			<!--<div id="myModal" class="modal">
				<span class="close cursor" onclick="closeModal()">&times;</span>
				<div class="modal-content">	
			
				<?php
				/*for($i=1;$i<=$countarr["count"];$i++)
				{
					echo "<div class='mySlides'>";
					echo "<div class='numbertext'>";
					echo $i . "/" . $countarr["count"];
					echo "</div>";
					echo "<img src=\"/../images/$prod_id/$i.jpg\" style='width:100%'>";
					echo "</div>";
						
				}*/
				?>
				<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
				<a class="next" onclick="plusSlides(1)">&#10095;</a>
				</div>
				</div>-->
			<?php
			for($i=1;$i<=$countarr["count"];$i++)
			{
				
				echo "<button class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybuttonnumber demo\" id=\"btn$i\" onclick=\"currentDiv($i)\">$i</button>";
				
			}
			?>
			<script>
			document.getElementById('btn1').className="mdl-button mdl-js-button mdl-button--raised mybuttonnumber demo";
			</script>
			
			</div>
			</div>
			<?php
			$prodsql= "Select * from giftshop.products where product_id=$prod_id";
			$prodres=$conn->query($prodsql);
			$prodarr=$prodres->fetch_assoc();
			?>
			<div id="prodinfo">
			<?php
			$p=$prodarr['product_id'];
			$n=$prodarr['name'];
			$d=$prodarr['description'];
			$q=$prodarr['quantity'];
			$pr=$prodarr['price'];
			$c1=$prodarr['category1'];
			$c2=$prodarr['category2'];
			echo "<b>Product ID: </b>".$prodarr['product_id'];
			echo "<br><b>Name: </b>". $prodarr['name'];
			echo "<br><b>Description: </b><p>" .$prodarr['description']."</p>";
			echo "<br><b>Quantity: </b>" .$prodarr['quantity'];
			echo "<br><b>Price: </b>" .$prodarr['price'];
			echo "<br><b>Category 1: </b>" .$prodarr['category1'];
			echo "<br><b>Category 2: </b>" .$prodarr['category2'];
			echo "<br>";
			echo "
							<div class='mdl-textfield mdl-js-textfield textbox'>
								<input class='mdl-textfield__input' type='text' size='4' pattern='-?[0-9]*(\.[0-9]+)?' name='quantity[]' form='cart'>
								<label class='mdl-textfield__label' for='sample2'>Number...</label>
								<span class='mdl-textfield__error'>Input is not a number!</span>
							</div>";
			echo "<br><br><button type=\"submit\"  class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary mybutton2\" name=\"addtocart\" value=\"p$p\" form=\"cart\">
							Add to Cart
							</button>";
			?>
			</div>
		</div>
	</div>
  </main>
</div>
</body>



</html>