<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig');
    });

    $app->get("/stylists", function() use ($app) {
        return $app['twig']->render('stylists.html.twig', array('stylists' => Category::getAll()));
    });

    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist($_POST['name']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app) {
    $stylist = Stylist::find($id);
    return $app['twig']->render('stylist_edit.html.twig', array('stylist' => $stylist));
    });

    $app->patch("/stylists/{id}", function($id) use ($app) {
    $name = $_POST['name'];
    $stylist = Stylist::find($id);
    $stylist->update($name);
    return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'tasks' => $stylist->getTasks()));
    });

    $app->get("/stylists/{id}", function($id) use ($app) {
    $stylist = Stylist::find($id);
    return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'tasks' => $stylist->getTasks()));
    });

    $app->delete("/stylists/{id}", function($id) use ($app) {
    $stylist = Stylist::find($id);
    $stylist->delete();
    return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    return $app;
 ?>
