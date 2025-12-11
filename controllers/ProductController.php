<?php
require_once __DIR__ . '/../config/db.php';

class ProductController {

    public function getAll() {
        global $con;

        $query = "SELECT * FROM products ORDER BY id DESC";
        $result = mysqli_query($con, $query);

        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $row["tags"] = json_decode($row["tags"], true);
            $row["image_urls"] = json_decode($row["image_urls"], true);
            $row["metadata"] = json_decode($row["metadata"], true);
            $row["variants"] = json_decode($row["variants"], true);

            $products[] = $row;
        }

        echo json_encode($products);
    }

    public function create($data) {
        global $con;

        $name = mysqli_real_escape_string($con, $data["name"]);
        $desc = mysqli_real_escape_string($con, $data["description"]);
        $price = $data["price"];
        $category = mysqli_real_escape_string($con, $data["category"]);
        $tags = mysqli_real_escape_string($con, json_encode($data["tags"]));
        $stock = $data["stockQuantity"];
        $images = mysqli_real_escape_string($con, json_encode($data["imageUrls"]));
        $metadata = mysqli_real_escape_string($con, json_encode($data["metadata"]));
        $variants = mysqli_real_escape_string($con, json_encode($data["variants"]));

        $query = "INSERT INTO products 
            (name,description,price,category,tags,stock_quantity,image_urls,metadata,variants)
            VALUES ('$name','$desc',$price,'$category','$tags',$stock,'$images','$metadata','$variants')";

        mysqli_query($con, $query);

        echo json_encode(["message" => "Product created"]);
    }

    public function update($id, $data) {
    global $con;

    // Safely read values or give defaults
    $name = mysqli_real_escape_string($con, $data["name"] ?? "");
    $desc = mysqli_real_escape_string($con, $data["description"] ?? "");
    $price = $data["price"] ?? 0;
    $category = mysqli_real_escape_string($con, $data["category"] ?? "");
    $tags = mysqli_real_escape_string($con, json_encode($data["tags"] ?? []));
    $stock = $data["stockQuantity"] ?? 0;
    $images = mysqli_real_escape_string($con, json_encode($data["imageUrls"] ?? []));
    $metadata = mysqli_real_escape_string($con, json_encode($data["metadata"] ?? []));
    $variants = mysqli_real_escape_string($con, json_encode($data["variants"] ?? []));

    // Now perform safe update
    $query = "UPDATE products SET
        name='$name',
        description='$desc',
        price=$price,
        category='$category',
        tags='$tags',
        stock_quantity=$stock,
        image_urls='$images',
        metadata='$metadata',
        variants='$variants'
        WHERE id=$id";

    if (!mysqli_query($con, $query)) {
        http_response_code(500);
        echo json_encode([
            "error" => "SQL Error",
            "details" => mysqli_error($con)
        ]);
        return;
    }

    echo json_encode(["message" => "Product updated successfully"]);
}


    public function delete($id) {
        global $con;

        $query = "DELETE FROM products WHERE id=$id";
        mysqli_query($con, $query);

        echo json_encode(["message" => "Product deleted"]);
    }
}
