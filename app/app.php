<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();
    $app['debug'] = true;

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
       return $app['twig']->render('index.html.twig', array('stylist' => Stylist::getAll()));
    });

    $app->get("/clients", function() use ($app) {
        return $app['twig']->render('clients.html.twig');
    });

    $app->post("/clients/{id}", function() use ($app) {
        $stylist = Stylist::find($_POST['stylist_id']);
        $client = new Client($_POST['client_name'], $_POST['stylist_id']);
        $client->save();
        return $app['twig']->render('clients.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->get("/clients/{id}", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('clients_edit.html.twig', array('clients' => $client));
    });

    $app->get("/clients/{id}/edit", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('clients_edit.html.twig', array('clients' => $client));
    });

    $app->patch("/clients/{id}", function($id) use ($app) {
        $client_name = $_POST['name'];
        $client = Client::find($id);
        $client->update($client_name);
        return $app['twig']->render('stylists.html.twig', array('stylist' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->post("/clients", function() use ($app) {
        $stylist = Stylist::find($_POST['stylist_id']);
        $client = new Client($_POST['client_name'], $_POST['stylist_id']);
        $client->save();
        return $app['twig']->render('stylists.html.twig', array('clients' => $stylist->getClients()));
    });

    $app->get("/stylists", function() use ($app) {
        return $app['twig']->render('stylists.html.twig', array('stylist' => Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist($_POST['name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylist' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $stylist = Stylist::find($id);
        $stylist->update($name);
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig', array('stylist' => Stylist::getAll()));
    });

    return $app;
 ?>
