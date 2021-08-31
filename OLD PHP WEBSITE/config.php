
<?php 

$itemName = "Demo Product"; 
$itemNumber = "PN12345"; 
$itemPrice = $_SESSION['downpayment']; 
$currency = "PHP"; 
 
// Stripe API configuration  
define('STRIPE_API_KEY', 'sk_test_51JF21kEn9S7qLdoj5DsICuKV0ZKP8EXh55kdMn7tyc8kh469s4QioNz7d3PzuOEXwE4FZnj0Y4k4mOPmG530Q23500NtXxjxPD'); 
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51JF21kEn9S7qLdojZc7iJOcxGYfZ98GTFue9sUAg92uvbBYrbRnm8HmvUhNlMHchWNQuMppof9JsdlX56vvWLl8700SQCAP3xm'); 
  
// Database configuration  
define('DB_HOST', 'MySQL_Database_Host'); 
define('DB_USERNAME', 'MySQL_Database_Username'); 
define('DB_PASSWORD', 'MySQL_Database_Password'); 
define('DB_NAME', 'MySQL_Database_Name');