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

        return $app['twig']->render("store.html.twig", array('store' => $store, 'brands' => $store->getBrands()));
    });

    $app->post("/store_add_brand/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->addBrand($_POST['brand_id']);

        return $app['twig']->render("store.html.twig", array('store' => $store, 'brands' => $store->getBrands()));
    });

    $app->get("/store_delete/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->deleteStore();

        return $app['twig']->render("stores.html.twig", array('stores' => Store::getAll()));
    });

    return $app;
?>
