<?php
 $page_title = 'Retail Store';
 include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/header.html';
 ?>
<div class="jumbotron">
            <div class="container">
                <h1 class="display-3">Grocery Store</h1>
                <p>This is the store landing page.</p>
            </div>
        </div>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <h2>For customers</h2>
                    <p>Our online store offersa variety of products for good prices. Check it out! </p>
                    <p><a class="btn btn-secondary" href="/db-group/htdocs/user/index.php" role="button">To the shop &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>For managers</h2>
                    <p>Our Web UI allows managers to reorder goods that are about to run out. </p>
                    <p><a class="btn btn-secondary" href="/db-group/htdocs/admin/index.php" role="button">Check inventory & orders &raquo;</a></p>
                </div>
                <div class="col-md-4">
                    <h2>For vendors</h2>
                    <p>Vendors can check current reorder requests and announce future shippings of products.</p>
                    <p><a class="btn btn-secondary" href="/db-group/htdocs/vendor/viewRestock.php" role="button">Manage reorder requests &raquo;</a></p>
                </div>
            </div>
        </div>


 <?php  include $_SERVER['DOCUMENT_ROOT'] . '/db-group/htdocs/includes/footer.html';
?>