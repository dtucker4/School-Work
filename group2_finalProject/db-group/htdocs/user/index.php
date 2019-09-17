<?php 
 // Set the page title and include the HTML header:
 $page_title = 'Generic Grocery Store';
 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/header.html';
 ?>

<p><h2 class="text-center">Welcome to our online grocery store.</h2></p>
<div class="row text-center">
    <div class="col">
        <a href="/db-group/htdocs/user/browse.php">
            <img height="250" width="250" src="https://www.shareicon.net/download/2015/09/16/102291_view_512x512.png"/>
            <h1>Browse items</h1>
        </a>
    </div>
    <div class="col">
        <a href="/db-group/htdocs/user/view_cart.php">
            <img height="250" width="250" src="https://d30y9cdsu7xlg0.cloudfront.net/png/2370-200.png"/>
            <h1>Shopping Cart</h1>
        </a>
    </div>
</div>


 <?php  include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/footer.html';
?>