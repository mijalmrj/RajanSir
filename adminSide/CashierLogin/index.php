<!DOCTYPE html>
<html lang="en">

<head>
    <title>Index</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="gradient-background">
    <div class="container">
        <!--Navigation bar-->
        <header class="navbar">
            <div class="navhome">
                <a href="index.html"><img src="logos/coffee_logo.png" id="coffee-logo"></a>
                <a href="index.php">
                    <h2>Northside Café</h2>
                </a>
            </div>

            <div class="main">
            <!--Menu box-->
            <div class="menu-box">
                <div class="title-bar">
                    <h1>CATEGORIES</h1>
                </div>
                <div class="menu-box-grid">
                    <a href="../frontend/coffee_menu.html">
                        <div class="menu-box-item">
                            <img src="../images/coffees_image.png" title="coffees">
                            <h3>Coffees</h3>
                        </div>
                    </a>

                    <a href="../iced_drinks_menu.html">
                        <div class="menu-box-item">
                            <img src="../images/iced_drinks_image.png" title="iced drinks">
                            <h3>Iced Drinks</h3>
                        </div>
                    </a>

                    <a href="../tea_menu.html">
                        <div class="menu-box-item">
                            <img src="../images/teas_image.png" title="teas">
                            <h3>Teas</h3>
                        </div>
                    </a>

                    <a href="../soft_drinks_menu.html">
                        <div class="menu-box-item">
                            <img src="../images/soft_drinks.png" title="soft drinks">
                            <h3>Soft Drinks</h3>
                        </div>
                    </a>
                </div>
            </div>

            <!--Order summary-->
            <div class="order-box">
                <div class="order-box-inner">
                    <div class="order-number"></div>
                    <hr>
                    <div class="order-info"></div>
                    <hr>
                    <div class="payment-method">
                        <h2>Payment Method</h2>
                        <div class="payment-options">
                            <div class="cash-option defaultPaymentBtn">Cash</div>
                            <div class="card-option defaultPaymentBtn">Card</div>
                        </div>
                        <img src="../logos/cash_icon.png">
                        <img src="../logos/card_icon.png">

                        <!-- Cash Calculator -->
                        <div id="cash-calculator" class="calculator" style="display: none;">
                            <h3>Enter Amount Received:</h3>
                            <input type="number" id="cash-amount" placeholder="Amount" />
                            <button id="calculate-change">Calculate Change</button>
                            <div id="change-display"></div>
                        </div>
                    </div>
                </div>
                <!-- Form for payment -->
                <form action="confirmed.html">
                    <button type="submit" class="order-button" id="order-button">Place Order <img src="logos/arrow.png" id="order-arrow"></button>
                </form>
            </div>
        </div>
    </div>
    <style>
    .calculator {
    margin-top: 20px;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.calculator input {
    padding: 10px;
    width: 100%;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
</style>
    <script src="js/paymentMethod.js"></script>
</body>

</html>