<?php
include "callAPI.php";

if (isset($_GET["request"])) {
    //saves get request into variable
    $request = $_GET["request"];
    //echo $request;

    //this will display the navigation buttons
    if ($request == "ProductCategory") {
        
        //echo "test";
        //gets url from callApi
        $result = callAPI("/webservice/ProductCategory", "GET");
        //saves body data into variable
        $categories = $result["data"];
        //var_dump($result);
       $html = "";

       //creates navigation buttons with each category in database
        for ($i = 0; $i < count($categories); $i++) {
            $item = $categories[$i];
            $html .= " <input type='button' name='categoryNav' value='" . $categories[$i] . "' onclick=sortCategory('$item') class='nav_btns'>";
        }
        $html .= "<input type='button' name='categoryNav' value='Everything' onclick=sortCategory('Everything') class='nav_btns'>";
        
        echo $html;

        //get single product
    } elseif ($request == "ProductID" && isset($_GET['ProductID'])) {
        // echo "test2";
        $id = $_GET['ProductID'];
        // echo $id;
        $result = callAPI("/webservice/ProductID/" . $id, "GET");
        $idData = $result["data"];
        //var_dump($result);
        //gets all products
    }
    // } elseif ($request == "Everything") {
    //     $result = callAPI("/webservice/Products/", "GET");

    //     //creating array for each product column in database
    //     $productData = $result["data"];
    //     $productName = [];
    //     $productImage = [];
    //     $productDescription = [];
    //     $productPrice = [];
    //     $productQuantity = [];
    //     //pushing data into arrays
    //     for ($i = 0; $i < count($productData); $i++) {
    //         array_push($productName, $productData[$i]["name"]);
    //         array_push($productImage, $productData[$i]["image"]);
    //         array_push($productDescription, $productData[$i]["description"]);
    //         array_push($productPrice, $productData[$i]["price"]);
    //         array_push($productQuantity, $productData[$i]["quantity"]);
    //     }

    //     //creating product cards for main.html
    //     $product_card = "<div class='product_card stacked'>";
    //     $product_card_content = "<div class='product_card_content'>";
    //     $close_div = "</div>";
    //     $html = "";
    //     for ($i = 0; $i < count($productData); $i++) {

    //         $html .=  $product_card . "<div class='product_image'>" . "<img src='" . $productImage[$i] . "'>" . $close_div;
    //         $html .= $product_card_content . "<div class='product_name'><a href='#'>" . $productName[$i] . "</a>" . $close_div;
    //         $html .= "<div class='product_description'>" . $productDescription[$i] . $close_div;
    //         $html .= "<div class='product_price'>" . "$" . $productPrice[$i] . $close_div;
    //         if ($productQuantity[$i] === 0) {
    //             $html .= "<div class='product_quantity' style='color:red;'> OUT OF STOCK </div>";
    //         } else {
    //             $html .= "<div class='product_quantity' " . $productQuantity[$i] . "</div>";
    //             $html .= "<input type= 'button' value = 'Add To Cart' name = 'add_to_cart'>";
    //         }
    //         $html .= $close_div . $close_div;
    //         $html .= $close_div . $close_div;
    //     }

    //     echo $html;
    elseif ($request == "Products" && isset($_GET['start']) && isset($_GET['length']) && isset($_GET['category'])) {

        $start = (int)$_GET['start'];
        $length = (int)$_GET['length'];
        $category = $_GET['category'];
        $header = "?start=$start&length=$length&category=$category"; //send requests formatted like header params
        $result = callAPI("/webservice/Products/".$header, "GET");

        //creating array for each product column in database
        $productData = $result["data"];
        $productName = [];
        $productImage = [];
        $productDescription = [];
        $productPrice = [];
        $productQuantity = [];
        //pushing data into arrays
        for ($i = 0; $i < count($productData); $i++) {
            array_push($productName, $productData[$i]["name"]);
            array_push($productImage, $productData[$i]["image"]);
            array_push($productDescription, $productData[$i]["description"]);
            array_push($productPrice, $productData[$i]["price"]);
            array_push($productQuantity, $productData[$i]["quantity"]);
        }

        //creating product cards for main.html
        $product_card = "<div class='product_card stacked'>";
        $product_card_content = "<div class='product_card_content'>";
        $close_div = "</div>";
        $html = "";
        for ($i = 0; $i < count($productData); $i++) {

            $html .=  $product_card . "<div class='product_image'>" . "<img src='" . $productImage[$i] . "'>" . $close_div;
            $html .= $product_card_content . "<div class='product_name'><a href='#'>" . $productName[$i] . "</a>" . $close_div;
            $html .= "<div class='product_description'>" . $productDescription[$i] . $close_div;
            $html .= "<div class='product_price'>" . "$" . $productPrice[$i] . $close_div;
            if ($productQuantity[$i] === 0) {
                $html .= "<div class='product_quantity' style='color:red;'> OUT OF STOCK </div>";
            } else {
                $html .= "<div class='product_quantity' " . $productQuantity[$i] . "</div>";
                $html .= "<input type= 'button' value = 'Add To Cart' name = 'add_to_cart' class='btn btn-outline-secondary'>";
            }
            $html .= $close_div . $close_div;
            $html .= $close_div . $close_div;
        }

        echo $html;
    } else {
        echo "No request parameter";
        //add caracell
    }
}
