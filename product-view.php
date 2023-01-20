<!--Kendra Ouellet 000399221-->
<!DOCTYPE html>
<?php
session_start();
include "connect.php";


//initializing variables for product details to be used in the product view page, uses get method to get information with corresponding value

$name = $_GET['name'];
$img = $_GET['image'];
$price = $_GET['price'];
$qty = $_GET['quantity'];
$description = $_GET['description'];

//saving name and quantity value into session variables to use in addCart.php
$_SESSION['name']= $name;
$_SESSION['quantity']= $qty;


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View</title>
    <!-- https://stackoverflow.com/questions/50662906/my-css-file-not-working-in-my-php-file#:~:text=its%20probably%20a%20cache%20issue,problem%20as%20it%20fixed%20mine.&text=its%20very%20simple%2C%20first%20you,the%20css%20file%20with%20php. -->
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Aboreto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Abhaya Libre' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--    had to declare style in page, style from style.css not working in file-->
    <style>
        .product_wrapper {
            margin-top: 1.5rem;
        }

        .product_view_card {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .product_view_image {
            grid-column: 1;
            width: 100%;
            height: 550px;
            object-fit: cover;
            overflow: hidden;
            text-align: center;
        }

        .product_view_info {
            grid-column: 2;
            background: white;
            align-self: end;
            margin: .5rem .5rem 2rem;
            padding: .5rem;
            box-shadow: 0 .25rem 1rem rgb(0 0 0 /.1);
        }

        .product_view_name {
            font-size: 30px;
            line-height: 48px;
        }

        .underline {
            border-bottom: 3px solid black;
            width: 50px;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .product_view_price {
            font-size: 20px;
        }
    </style>
</head>

<body>

    <header class="wrapper">

        <div class="header-row1">
            <div class="logo">
                <h1>Store</h1>
            </div>
            <div class="cart">
                <button id="show-cart-button">
                    <span class="badge" style="color: black;"><?php echo count($_SESSION['cart']); ?></span>
                    <!--Displays the count of cart beside the icon-->
                    <i class="fa fa-shopping-cart"></i>
                </button>
                <div id="overlay">
                    <div id="cart-contents">
                        <button id="close-cart-button">Close</button>
                        <div id="cart_return">
                        </div>
                       
                    </div>

                </div>
        </div>
                <nav class="header-row2">
                    <!--                Nav links for products with the category as its value, will bring user back to main.php when clicked-->
                    <form action="main.php" method="GET">
                        <input type="submit" name="Shirts" value="Shirts" class="nav_btns">
                        <input type="submit" name="Pants" value="Pants" class="nav_btns">
                        <input type="submit" name="Shoes" value="Shoes" class="nav_btns">
                        <input type="submit" name="Accesories" value="Accesories" class="nav_btns">
                        <input type="submit" name="Everything" value="Everything" class="nav_btns">
                    </form>
                </nav>

    </header>
    <main>

        <!--                displaying product values-->

        <div class="product_wrapper">
            <div class="product_view_card">
                <div class="product_view_image">
                    <?php
                    echo "<img src='";
                    echo $img;
                    echo "'>";
                    ?>
                </div>
                <div class="product_view_info">

                    <?php
                    echo "<div class='product_view_name'>";
                    echo $name;
                    echo "</div>";
                    echo "<div class='underline'></div>";
                    echo "<div class='product_view_description'>";
                    echo $description;
                    echo "</div>";
                    echo "<div class='product_view_price'>";
                    echo "$" . $price;
                    echo "</div>";
                    if($qty !=0){
                        echo " <form method = 'GET'><input type= 'button' onclick='fetchRequest()'value = 'Add To Cart' name = 'add_to_cart'><input type ='hidden' value='".$qty."' name='quantity'><input type = 'hidden' value='" . $name . "'name='name'></form>";
                    }
                  
                    echo "<div class='product_view_quantity'>";
                    ?>
                    <p>Available Stock: <?php echo $qty ?> </p>
                    <?php
                    echo "</div>";


                    ?>


                </div>
            </div>
        </div>
        <!-- DISCLAIMER: I wanted to have this whole script in my main script but it breaks code, doesn't know what my fetchRequest 
        method being called in the add to cart button is if I move this into my main script. I believe if this code worked in main script, cart items would show in
            main.php and product-view.php -->
        <script type="text/javascript">
            function fetchRequest() {
                console.log("test");
                let url = "addCart.php";
                console.log(url);
                fetch(url)
                    .then(response => response.json())
                    .then(showCart);
            }

            function showCart(items) {
                console.log(items)
                let cart_view = ""
                for (let i = 0; i < items.length; i++) {
                    let image = items[i]["image"];
                    let name = items[i]["name"];
                    let description = items[i]["description"];
                    let price = items[i]["price"];
                    let quantity = items[i]["quantity"];
                    let quantityCart = 1;
                    let totalPrice = items[i]["price"];
                    let row_number = 0;
                    let close_div = "</div>"


                cart_view += "<div class='panel panel-default'>" +
                    "<div class='table-responsive'>" +
                    "<table class='table'>" +
                    "<tr class='table-active'>" +
                    "<th>Product</th>" +
                    "<th>Price</th>" +
                    "<th>Quantity</th>" +

                    "</tr>"
                cart_view += "<tr class='tablerow'>" + "<td><a href=\"?name=" + name +"&image="+image+"&price="+price+"&description="+description+"&quantity="+quantity+"&remove=" + row_number + "\" class=\"btn btn-danger btn-xs\" onclick=\"return confirm('Are you sure?')\">X</a> " + name + "</td>"
                cart_view += "<td>" + price + " </td>"
                cart_view += "<td>" + quantityCart + "</td>"
                cart_view += "</tr>"

                row_number++;
                cart_view += "<tr class='tableactive'>"
                cart_view += "<td>" + "<a href='?name=" + name +"&image="+image+"&price="+price+"&description="+description+"&quantity="+quantity+"' class='btn btn-danger btn-xs' onclick='return confirm('Are you sure?')'>Empty Cart</a>" + "</td>"
                cart_view += "<td class='text-leftt'>Total</td>"
                cart_view += "<td> " + totalPrice + "</td>"
                cart_view += "</table>"
                cart_view += close_div + close_div;
                };

                document.getElementById("cart_return").innerHTML = cart_view;
            }
             document.querySelector("#show-cart-button").addEventListener("click", () => {
        overlay.style.display = "block";
    });

    document.querySelector("#close-cart-button").addEventListener("click", () => {
        overlay.style.display = "none";
    });
    document.querySelector("#close-cart-button").addEventListener("click", () => {
        overlay.style.display = "none";
    });

        </script>
    </main>
    <footer>
        <p>©2022 Kendra Ouellet</p>
    </footer>
</body>
<!-- <script src="script.js"></script> -->

</html>