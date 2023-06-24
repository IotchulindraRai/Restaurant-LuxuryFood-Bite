<?php
require_once('path/to/razorpay-php/Razorpay.php');

use Razorpay\Api\Api;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST["full-name"];
    $amount = $_POST["amount"];
    
    // Initialize Razorpay API
    $api = new Api('YOUR_RAZORPAY_KEY', 'YOUR_RAZORPAY_SECRET');

    // Create an order
    $orderData = [
        'receipt' => 'order_receipt', // Replace with your own order receipt ID or logic
        'amount' => $amount * 100, // Amount should be in paise (e.g., 1000 for ₹10.00)
        'currency' => 'INR',
        'payment_capture' => 1, // Auto-capture the payment
    ];

    $order = $api->order->create($orderData);

    // Get the order ID
    $orderId = $order->id;

    // Redirect the user to the Razorpay payment page
    echo '<script src="https://checkout.razorpay.com/v1/checkout.js"></script>';
    echo '<script>';
    echo 'var options = {';
    echo "    key: 'YOUR_RAZORPAY_KEY',"; // Replace with your own Razorpay key
    echo "    amount: $amount * 100,"; // Amount should be in paise
    echo "    currency: 'INR',";
    echo "    name: 'Restaurant Payment',";
    echo "    description: 'Payment for food order',";
    echo "    image: 'path/to/restaurant_logo.png',"; // Replace with your own restaurant logo URL
    echo "    order_id: '$orderId',";
    echo "    handler: function(response) {";
    echo "        // Process the payment on the server-side and handle the response";
    echo "        // Use AJAX or redirect to another page to handle the response";
    echo "    },";
    echo "    prefill: {";
    echo "        name: '$name',"; // Pre-fill the customer's name
    echo "    }";
    echo "};";
    echo "var rzp1 = new Razorpay(options);";
    echo "rzp1.on('payment.failed', function(response) {";
    echo "    // Handle payment failure";
    echo "});";
    echo "rzp1.open();";
    echo '</script>';
}
?>
