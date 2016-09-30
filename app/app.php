<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render("index.html.twig");
    });

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render("stores.html.twig", array('stores' => Store::getAll()));
    });

    $app->get("/stores_delete_all", function() use ($app) {
        Store::deleteAll();

        return $app['twig']->render("stores.html.twig", array('stores' => Store::getAll()));
    });

    $app->post("/stores_add", function() use ($app) {
        $store_name = $_POST['store_name'];
        $store = new Store($store_name);
        $store->save();

        return $app['twig']->render("stores.html.twig", array('stores' => Store::getAll()));
    });

    $app->get("/store_brands/{id}", function($id) use ($app) {
        $store = Store::find($id);

        return $app['twig']->render("store.html.twig", array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->post("/store_add_brand/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $brand = Brand::find($_POST['brand_id']);
        $store->addBrand($brand);

        return $app['twig']->render("store.html.twig", array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->patch("/store_update/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store_name = $_POST['store_name'];
        $store->updateStore($store_name);

        return $app['twig']->render("store.html.twig", array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });

    $app->delete("/store_delete/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->deleteStore();

        return $app['twig']->render("stores.html.twig", array('stores' => Store::getAll()));
    });

    $app->get("/brands", function() use ($app) {
        return $app['twig']->render("brands.html.twig", array('brands' => Brand::getAll()));
    });

    $app->get("/brands_delete_all", function() use ($app) {
        Brand::deleteAll();

        return $app['twig']->render("brands.html.twig", array('brands' => Brand::getAll()));
    });

    $app->post("/brands_add", function() use ($app) {
        $brand_name = $_POST['brand_name'];
        $price = $_POST['price'];
        $available = $_POST['available'];
        $brand = new Brand($brand_name, $price, $available);
        $brand->save();

        return $app['twig']->render("brands.html.twig", array('brands' => Brand::getAll()));
    });

    $app->get("/brand_stores/{id}", function($id) use ($app) {
        $brand = Brand::find($id);

        return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->post("/brand_add_store/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $store = Store::find($_POST['store_id']);
        $brand->addStore($store);

        return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->patch("/brand_udpate/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand_name = $_POST['brand_name'];
        $price = $_POST['price'];
        $available = $_POST['available'];
        $brand->updateBrand($brand_name, $price, $available);

        return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });

    $app->delete("/brand_delete/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $brand->deleteBrand();

        return $app['twig']->render("brands.html.twig", array('brands' => Brand::getAll()));
    });

    return $app;
?>
