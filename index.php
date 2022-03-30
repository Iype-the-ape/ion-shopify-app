<?php
include_once("includes/mysql_connect.php");
include_once("includes/shopify.php");

$shopify = new Shopify();
$parameters = $_GET;

include_once("includes/check_token.php");
?>

<?php include_once("header.php"); ?>


    <section>
        <div class="alert columns twelve">
            <dl>
                <dt>
                    <p>Welcome to ION Shopify app</p>
                </dt>
            </dl>
        </div>
    </section>
    <footer></footer>



<?php include_once("footer.php"); ?>