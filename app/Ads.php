<?php

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

    public static function loadAds()
    {
        $json = new JSON();
        self::$ads = (array)$json->read(self::$file);
    }

    private static function attachUsers()
    {
        $auth = new Auth();
        $users = $auth->getUsers();

        foreach (self::$ads as &$ad) {
            foreach ($users as $user) {
                if ($ad->user_id == $user->id)
                    $ad->user = $user;
            }
        }
    }

    private static function attachCategory()
    {
        foreach (self::$ads as &$ad) {
            foreach (self::$categories as $category) {
                if ($ad->category == $category["url"])
                    $ad->category = $category;
            }
        }
    }

    /**
     * @param $userId
     */
    private static function filterUser($userId)
    {
        $ads = [];
        foreach (self::$ads as &$ad)
            if ($ad->user_id == $userId)
                $ads[] = $ad;

        self::$ads = $ads;
    }

    /**
     * @param $category
     */
    private static function filterCategory($category)
    {
        $ads = [];
        foreach (self::$ads as &$ad)
            if ($ad->category["url"] == $category)
                $ads[] = $ad;

        self::$ads = $ads;
    }

    /**
     * @param $items
     * @return array
     */
    private static function getLastItems($items)
    {
        self::$ads = array_values(array_slice(self::$ads, $items * -1, $items, true));
    }

    private static function getProductCount()
    {
        self::loadAds();

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
            $file = new JSON();
            self::$ads = (array)$file->read(self::$file);

            $image = $file->upload($files["image"]);

            if (isset($image["error"]))
                $data["error"]["message"] = $image["error"]["message"];

            else {
                $items = count(self::$ads);

                if ($items)
                    $id = self::$ads[$items - 1]->id + 1;
                else
                    $id = 1;

                self::$ads[] = [
                    "id" => $id,
                    "user_id" => $_SESSION["user"]->id,
                    "title" => $post["title"],
                    "category" => $post["category"],
                    "status" => $post["status"],
                    "city" => $post["city"],
                    "price" => $post["price"],
                    "delivery" => implode(",", $post["delivery"]),
                    "image" => $image["filename"],
                    "description" => $post["description"],
                    "created_at" => time()
                ];

                $file->write(self::$file, self::$ads);

                header("Location: ".Helper::buildURL("/fa4zpw/?page=hirdetesfeladas&success"));
            }
        }
    }

    public function deleteAd($id)
    {
        $file = new JSON();
        $ads = (array)$file->read(self::$file);

        foreach ($ads as $i => &$ad) {
            if ($ad->id == $id)
                unset($ads[$i]);
        }

        $file->write(self::$file, $ads);

        header("Location: ".Helper::buildURL("/fa4zpw/?page={$_GET["page"]}"));
    }

    public function getAds($maxItems = null, $category = null, $userId = null)
    {
        self::loadAds();

        self::attachUsers();
        self::attachCategory();

        if ($category)
            self::filterCategory($category);

        else if ($userId)
            self::filterUser($userId);

        else if ($maxItems)
            self::getLastItems($maxItems);

        foreach (self::$ads as &$ad)
            $ad->delivery = explode(",", $ad->delivery);

        return self::$ads;
    }

    public function getAd($id)
    {
        self::loadAds();

        foreach (self::$ads as $ad)
            if ($ad->id == $id) {
                $ad->delivery = explode(",", $ad->delivery);
                return $ad;
            }

        return null;
    }

    public function update($post, $files)
    {
        global $data;

        if (!isset($post["title"]) || isset($post["title"]) && empty($post["title"]))
            $data["error"]["message"] = "Nem adta meg a címet!";

        else if (!isset($post["category"]) || isset($post["category"]) && empty($post["category"]))
            $data["error"]["message"] = "Nem választotta ki a kategóriát!";

        else if (!isset($post["status"]) || isset($post["status"]) && empty($post["status"]))
            $data["error"]["message"] = "Nem választotta ki az állapotot!";

        else if (!isset($post["city"]) || isset($post["city"]) && empty($post["city"]))
            $data["error"]["message"] = "Nem adta meg a települést!";

        else if (!isset($post["price"]) || isset($post["price"]) && ($post["price"] < 0 || !is_numeric($post["price"])))
            $data["error"]["message"] = "Nem adta meg az árat!";

        else if (!isset($post["delivery"]) || isset($post["delivery"]) && empty($post["delivery"]))
            $data["error"]["message"] = "Nem választotta ki az átvétel módját!";

        else if (!isset($post["description"]) || isset($post["description"]) && empty($post["description"]))
            $data["error"]["message"] = "Nem töltötte ki a leírást!";

        else if (isset($post["description"]) && strlen($post["description"]) < 20)
            $data["error"]["message"] = "Írjon többet a termékről! (min 20. karakter)";

        else {
            $file = new JSON();
            self::$ads = (array)$file->read(self::$file);

            $image = $file->upload($files["image"]);

            if (isset($image["error"]))
                $data["error"]["message"] = $image["error"]["message"];

            else {
                $this->updateAd($post, $image);

                $file->write(self::$file, self::$ads);

                header("Location: ".Helper::buildURL("/fa4zpw/?page=hirdeteseim&success"));
            }
        }
    }

    private function updateAd($data, $newImage)
    {
        foreach (self::$ads as &$ad) {
            if ($ad->id == $data["id"]) {
                $image = $ad->image;

                if (isset($newImage["filename"]))
                    $image = $newImage["filename"];

                $ad->title = $data["title"];
                $ad->category = $data["category"];
                $ad->status = $data["status"];
                $ad->city = $data["city"];
                $ad->price = $data["price"];
                $ad->delivery = implode(",", $data["delivery"]);
                $ad->image = $image;
                $ad->description = $data["description"];
            }
        }
    }

    public function getCategory($url)
    {
        foreach (self::$categories as $category)
            if ($category["url"] == $url)
                return $category;

        return null;
    }

}