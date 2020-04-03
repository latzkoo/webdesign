<?php

namespace app;

class Ads
{

    private static $file;
    private static $categories;
    private static $ads;

    public function __construct()
    {
        self::$file = "ads.json";
        self::$categories = [
            ["name" => "Baba-mama", "url" => "baba-mama"],
            ["name" => "Divat, ruházat", "url" => "divat"],
            ["name" => "Ingatlan", "url" => "ingatlan"],
            ["name" => "Jármű", "url" => "jarmu"],
            ["name" => "Műszaki cikkek, elektronika", "url" => "muszaki"],
            ["name" => "Otthon, háztartás", "url" => "otthon"],
            ["name" => "Szabadidő, sport", "url" => "szabadido"]
        ];
    }

    private static function getProductCount()
    {
        $json = new JSON();
        self::$ads = (array)$json->read(self::$file);

        $products = [];

        foreach (self::$ads as $ad) {
            if (!isset($products[$ad->category]))
                $products[$ad->category] = 1;
            else
                $products[$ad->category]++;
        }

        return $products;
    }

    public function getCategories()
    {
        $categories = self::$categories;
        $products = self::getProductCount();

        foreach ($categories as &$category) {
            $category["items"] = isset($products[$category["url"]]) ? $products[$category["url"]] : 0;
        }

        return $categories;
    }

    /**
     * @param $post
     * @param $files
     */
    public function add($post, $files)
    {
        global $data;

        if (!isset($_POST["title"]) || isset($_POST["title"]) && empty($_POST["title"]))
            $data["error"]["message"] = "Nem adta meg a címet!";

        else if (!isset($_POST["category"]) || isset($_POST["category"]) && empty($_POST["category"]))
            $data["error"]["message"] = "Nem választotta ki a kategóriát!";

        else if (!isset($_POST["status"]) || isset($_POST["status"]) && empty($_POST["status"]))
            $data["error"]["message"] = "Nem választotta ki az állapotot!";

        else if (!isset($_POST["city"]) || isset($_POST["city"]) && empty($_POST["city"]))
            $data["error"]["message"] = "Nem adta meg a települést!";

        else if (!isset($_POST["price"]) || isset($_POST["price"]) && ($_POST["price"] < 0 || !is_numeric($_POST["price"])))
            $data["error"]["message"] = "Nem adta meg az árat!";

        else if (!isset($_POST["delivery"]) || isset($_POST["delivery"]) && empty($_POST["delivery"]))
            $data["error"]["message"] = "Nem választotta ki az átvétel módját!";

        else if (!isset($_POST["description"]) || isset($_POST["description"]) && empty($_POST["description"]))
            $data["error"]["message"] = "Nem töltötte ki a leírást!";

        else if (isset($_POST["description"]) && strlen($_POST["description"]) < 20)
            $data["error"]["message"] = "Írjon többet a termékről! (min 20. karakter)";

        else {
            $json = new JSON();
            self::$ads = (array)$json->read(self::$file);

            $image = "";

            self::$ads[] = [
                "id" => count(self::$ads) + 1,
                "user_id" => $_SESSION["user"]->id,
                "title" => $post["title"],
                "category" => $post["category"],
                "status" => $post["status"],
                "city" => $post["city"],
                "price" => $post["price"],
                "delivery" => implode(",", $post["delivery"]),
                "image" => $image,
                "description" => $post["description"],
                "created_at" => time()
            ];

            $json->write(self::$file, self::$ads);

            header("Location: /fa4zpw/?page=hirdetesfeladas&success");

            /*
            print '<pre>';
            print_r($files);
            die();
            */
        }
    }
}