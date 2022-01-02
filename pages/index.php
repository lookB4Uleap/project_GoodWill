<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <script>
        $(document).ready(() => {
            $("#year").text((new Date()).getFullYear())

            $("#login-button").click(() => {
                // window.location.href = "/ResApp/pages/login.php"
                // window.location.replace("/ResApp/pages/login.php")
                window.location.replace("/pages/login.php")
            }) 

            let quant = 1
            $(".Quant").each(function() {
                $(this).text(quant)
            })

            $(".Plus-Button").each(function() {
                $(this).click(() => {
                    const Quant = $(this).parent().children(".Quant")
                    let quant = Number(Quant.text())
                    Quant.text(quant + 1)
                    const id = $(this).parent().attr("id")
                    $("#item_quant_"+id).val(quant + 1)
            })
            })

            $(".Minus-Button").each(function() {
                $(this).click(() => {
                    const Quant = $(this).parent().children(".Quant")
                    let quant = Number(Quant.text())
                    if (quant - 1 >= 1)
                    Quant.text(quant - 1)
            })
            })

            $(".Cart-Button").each(function() {
                $(this).click(() => {
                    const Quant = $(this).parent().children(".Quant").text()
                    const id = $(this).parent().attr("id")
                    console.log([id, Quant])
                    // $.post("/", { quant: Number(Quant) })
                })
            })

            $(".Buy-Button").each(function() {
                $(this).click(() => {
                    const item_quant = $(this).parent().children(".Quant").text()
                    const item_id = $(this).parent().attr("id")
                    const item_nm = $(this).parent().parent().children("h3").text()
                    const order_date = new Date();
                    // console.log([item_id, item_quant, item_nm, order_date.getMinutes()])
                    // if (item_quant > 0) {
                    //     $.post("/ResApp/pages/confirm-order.php", {
                    //         item_id: Number(item_id), 
                    //         item_nm: item_nm,
                    //         item_quant: Number(item_quant),
                    //         order_date: order_date
                    //     })
                    // }

                })
            })
        });
    </script>
    <title>Menu</title>
</head>
<body>
    <?php 
        include "../data.php";
        $db = new DataDB("../data.db");
    ?>
    <header class="Header">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="javascript:void(0)">Logo</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Link</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Link</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)">Link</a>
                  </li>
                </ul>
                <?php if (!empty($_SESSION)) { ?>
                <a class="Drop-Down d-flex dropdown-toggle" href="#" style="text-decoration: none; color: #f1f1f1;" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" style="background-color: #f1f1f1;">
                  <li><a class="dropdown-item" href="/pages/cart.php">Cart</a></li>
                  <li><a class="dropdown-item" href="/pages/order-history.php">Order History</a></li>
                  <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                </ul>
                <?php } ?>
                <?php if (empty($_SESSION)) { ?>
                <div class="d-flex nav-item">
                    <button type="button" class="btn btn-primary rounded-pill" style="width:130px; height:35px" id="login-button">Login</button>
                </div>
                <?php } ?>
              </div>
            </div>
          </nav>
    </header>

    <main class="Menu">
        <?php 
            // echo "<h1>".$_SESSION['uid']."</h1>";
            $ret = $db->getUniqueItemCategory();
            foreach($ret as $cat) {
        ?>
            <h1 class="Section-Header"><?php echo strtoupper($cat['category']) ?></h1>
            <?php 
                $res = $db->getMenuItemsByCategory($cat['category']);
                while ($menu_row = $res->fetchArray(SQLITE3_ASSOC)){
                    
            ?>
            <div class="Card-Container">
            <h3><?php echo $menu_row['item_nm'] ?></h3>
            <img src="https://picsum.photos/200" alt="Avatar" style="width:100%">
            <div class="Button-Container" id= "<?php echo $menu_row['id'] ?>" >
                <form action="/pages/confirm-order.php" method="POST" style="display: None" id="<?php echo "Buy".$menu_row['id'] ?>">
                    <input type="number" id="item_id" name="item_id" value="<?php echo $menu_row['id'] ?>">
                    <input type="text" id="item_nm" name="item_nm" value="<?php echo $menu_row['item_nm'] ?>">
                    <input type="number" id="item_price" name="item_price" value="<?php echo $menu_row['item_price'] ?>">
                    <input type="number" id="<?php echo "item_quant_".$menu_row['id'] ?>" name="item_quant" value="1">
                </form>
                <form action="/add_to_cart.php" method="POST" style="display: None" id="<?php echo "Cart".$menu_row['id'] ?>">
                    <input type="number" id="item_id" name="item_id" value="<?php echo $menu_row['id'] ?>">
                    <input type="text" id="item_nm" name="item_nm" value="<?php echo $menu_row['item_nm'] ?>">
                    <input type="number" id="item_price" name="item_price" value="<?php echo $menu_row['item_price'] ?>">
                    <input type="number" id="<?php echo "item_quant_".$menu_row['id'] ?>" name="item_quant" value="1">
                </form>
                <button type="submit" class="Cart-Button" form="<?php echo "Cart".$menu_row['id'] ?>"><i class="fas fa-cart-plus"></i></button>
                <button class="Plus-Button"><i class="fas fa-plus"></i></button>
                <!-- <input type="number" min="0"/> -->
                <div class="Quant" id="quant1"></div>
                <button class="Minus-Button"><i class="fas fa-minus"></i></button>
                <button type="submit" class="Buy-Button" form="<?php echo "Buy".$menu_row['id'] ?>"><i class="fas fa-shopping-cart"></i></button>
            </div>
            </div>
            
            <?php
                }
            ?>
        <?php
            }
        ?>    


        <!-- <h1 class="Section-Header">SECTION 1</h1>

        <div class="Card-Container">
            <h2>Card Image</h2>
            <img src="https://picsum.photos/200" alt="Avatar" style="width:100%">
            <div class="Button-Container">
                <button class="Cart-Button"><i class="fas fa-cart-plus"></i></button>
                <button class="Plus-Button"><i class="fas fa-plus"></i></button>
                <div class="Quant" id="quant1"></div>
                <button class="Minus-Button"><i class="fas fa-minus"></i></button>
                <button class="Buy-Button"><i class="fas fa-shopping-cart"></i></button>
            </div>
        </div>

        <div class="Card-Container">
            <h2>Card Image</h2>
            <img src="https://picsum.photos/200" alt="Avatar" style="width:100%">
            <div class="Button-Container">
                <button class="Cart-Button"><i class="fas fa-cart-plus"></i></button>
                <button class="Plus-Button"><i class="fas fa-plus"></i></button>
                <div class="Quant" id="quant2"></div>
                <button class="Minus-Button"><i class="fas fa-minus"></i></button>
                <button class="Buy-Button"><i class="fas fa-shopping-cart"></i></button>
            </div>
        </div> -->
        
    </main>

    <footer class="Footer">AS &copy 2020-<div id="year"></div></footer>
</body>
</html>