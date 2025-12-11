<?php
require_once __DIR__ . '/../config/db.php';

class CartController {

    public function add($data) {
        global $con;

        $pid = intval($data["productId"]);
        $variant = mysqli_real_escape_string($con, $data["variant"]);
        $qty = intval($data["quantity"]);

        $check = "SELECT * FROM cart_items WHERE product_id=$pid AND variant='$variant' LIMIT 1";
        $checkResult = mysqli_query($con, $check);

        if (mysqli_num_rows($checkResult) > 0) {
         
            $row = mysqli_fetch_assoc($checkResult);
            $newQty = $row['quantity'] + $qty;

            $update = "UPDATE cart_items 
                       SET quantity=$newQty 
                       WHERE id=" . $row['id'];
            mysqli_query($con, $update);

        } else {
          
            $query = "INSERT INTO cart_items(product_id,variant,quantity)
                      VALUES ($pid, '$variant', $qty)";
            mysqli_query($con, $query);
        }

        $this->getCart();
    }



// update cart
    public function update($id, $data) {
        global $con;

        $qty = intval($data["quantity"]);

        $query = "UPDATE cart_items SET quantity=$qty WHERE id=$id";
        mysqli_query($con, $query);

        $this->getCart();
    }

    public function remove($id) {
        global $con;

        $query = "DELETE FROM cart_items WHERE id=$id";
        mysqli_query($con, $query);

        $this->getCart();
    }



    public function getCart() {
        global $con;

        $sql = "SELECT c.*, p.name, p.price
                FROM cart_items c
                JOIN products p ON c.product_id=p.id";

        $result = mysqli_query($con, $sql);

        $items = [];
        $subtotal = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $row["total"] = $row["price"] * $row["quantity"];
            $subtotal += $row["total"];
            $items[] = $row;
        }

        $shipping = 50;
        $vat = $subtotal * 0.20;
        $total = $subtotal + $shipping + $vat;

        echo json_encode([
            "cartItems" => $items,
            "subtotal" => $subtotal,
            "shipping" => $shipping,
            "vat" => $vat,
            "total" => $total
        ]);
    }
}
