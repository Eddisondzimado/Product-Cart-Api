$allowed_origins = [
    'http://localhost:5173',
    'http://localhost:8000',
    'http://127.0.0.1:8000',
    'https://app.swaggerhub.com/apis/pegcodestechnologies/product-shopping-cart-api/1.0.0'
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if (in_array($origin, $allowed_origins)) {
    header("Access-Control-Allow-Origin: $origin");
}

header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight immediately
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


require "../vendor/autoload.php";
require "../controllers/AuthController.php";
require "../controllers/ProductController.php";
require "../controllers/CartController.php";
require "../middlewares/AuthMiddleware.php";

$method = $_SERVER["REQUEST_METHOD"];
$uri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
$data = json_decode(file_get_contents("php://input"), true);

// login
if ($uri[0] === "login" && $method === "POST") {
    (new AuthController())->login($data);
    exit;
}


// product endpoint

if ($uri[0] === "products") {
    $controller = new ProductController();

    if ($method === "GET") {
        $controller->getAll();
        exit;
    }

    requireAuth();

    if ($method === "POST") $controller->create($data);
    if ($method === "PUT") $controller->update($uri[1], $data);
    if ($method === "DELETE") $controller->delete($uri[1]);

    exit;
}


if ($uri[0] === "cart") {
    $controller = new CartController();

    if ($method === "POST") {
        $controller->add($data);
    }

    if ($method === "GET") {
        $controller->getCart();
    }

    if ($method === "PUT") {
        $id = $uri[1];
        $controller->update($id, $data);
    }

    if ($method === "DELETE") {
        $id = $uri[1];
        $controller->remove($id);
    }

    exit;
}


echo json_encode(["error" => "Route not found"]);
