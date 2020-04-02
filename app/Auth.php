<?php


namespace app;

class Auth
{
    private static $exceptedURLs = ["regisztracio", "belepes"];

    private $authenticated = false;
    private $user;

    public function __construct()
    {
    }

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        return $this->authenticated;
    }

    /**
     * @param bool $authenticated
     */
    public function setAuthenticated($authenticated)
    {
        $this->authenticated = $authenticated;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function login()
    {
        global $data;

        if (!isset($_POST["email"]) || isset($_POST["email"]) && empty($_POST["email"]))
            $data["error"]["message"] = "Nem adta meg az e-mail címet!";

        else if (!isset($_POST["passwd"]) || isset($_POST["passwd"]) && empty($_POST["passwd"]))
            $data["error"]["message"] = "Nem adta meg a jelszavát!";

        else {
            $json = new JSON();
            $users = $json->read("users.json");

            if ($user = $this->isUser($_POST, $users)) {
                $this->setSessionDatas($user);

                Helper::getPageURLFromReferer($_POST["redirect_to"]);

                $url = "/fa4zpw/";
                if (isset($_POST["redirect_to"]) && !empty($_POST["redirect_to"]) &&
                    !in_array($_POST["redirect_to"], self::$exceptedURLs)) {
                    $url .= "?page=" . $_POST["redirect_to"];
                }

                header("Location: {$url}");
            }
            else {
                $data["error"]["message"] = "Hibás e-mail cím vagy jelszó!";
            }
        }
    }

    public function logout()
    {
        session_destroy();
        return header("Location: {$_SERVER["HTTP_REFERER"]}");
    }

    private function isUser($post, $users)
    {
        if (!$users)
            return false;

        foreach ($users as $user) {
            if ($user->email == $post["email"] && $user->password == $post["passwd"])
                return $user;
        }

        return false;
    }

    /**
     * @param $user
     */
    private function setSessionDatas($user)
    {
        $_SESSION["email"] = $user->email;
        $_SESSION["firstname"] = $user->email;
    }

}