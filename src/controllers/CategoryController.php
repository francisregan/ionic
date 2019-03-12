<?php
namespace App\Controllers;

use Psr\Container\ContainerInterface;

session_start();

class CategoryController
{
    protected $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function manageCategories($request, $response, $args)
    {
        $result = $this->container->db->query("SELECT * FROM ioniccloud.category");
        $results = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($results, $row);
        }
        return json_encode($results);
    }

    public function showCategory($request, $response, $args)
    {
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'add-category'));
    }

    public function addCategory($request, $response, $args)
    {

        $category_random = $_SESSION['cat_res'];
        if (!$category_random) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-category'));
        }

        $_SESSION['cat_res'] = false;

        $data = $request->getParsedBody();
        $name = filter_var($data['name'], FILTER_SANITIZE_STRING);
        $value = filter_var($data['type'], FILTER_SANITIZE_STRING);

        $sqli = $this->container->db;
        $result = $sqli->query("insert into ioniccloud.category (name, type)
    VALUES ('$name','$value')");

        if (mysqli_affected_rows($sqli) == 1) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-category'));
        }

        echo ("<script>window.alert('Record Not Added');</script>");
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'add-category'));
    }
}
