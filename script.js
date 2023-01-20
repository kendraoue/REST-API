//Kendra Ouellet 000399221
//Script to display products
window.addEventListener("load", function () {
    console.log("ready");
   
  
    //creating overlay variable that targets the overlay id in main.php
    const overlay = document.querySelector("#overlay");
    //adding an event listening to the show-cart-button id. When active, will change the overlay style to block (will show)
    document.querySelector("#show-cart-button").addEventListener("click", () => {
        overlay.style.display = "block";
    });
    //adding an event listening to the sclose-cart-button id. When active, will change the overlay style to none (will not show)
    document.querySelector("#close-cart-button").addEventListener("click", () => {
        overlay.style.display = "none";
    });
   

});


