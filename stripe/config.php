<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "sk_test_51N5TmNSJBUE8BOD61x3BvGv3aYSL0V8Q7S7nNDWVlsaG6OfO0jN8BcMHifqnHr9vc4cJ03eMOjGH0qkrcfoHCtNl004vWlhuPh",
        "publishableKey" => "pk_test_51N5TmNSJBUE8BOD6Y9Zy2KYCJ4iqhkFG9PqZk1M5lKiSXUbWR0LX8dMEgIYlE5xxnPocMcUfpPAWXBjeRUPEiQfM00nK7ODaWr"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>