<?php

namespace app;

class Auth
{
    private static $exceptedURLs = ["regisztracio", "belepes"];

    private $users;
    private $authenticated = false;

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

    public function login()
    {
        global $data;

        if (!isset($_POST["email"]) || isset($_POST["email"]) && empty($_POST["email"]))
            $data["error"]["message"] = "Nem adta meg az e-mail címet!";

        else if (!isset($_POST["passwd"]) || isset($_POST["passwd"]) && empty($_POST["passwd"]))
            $data["error"]["message"] = "Nem adta meg a jelszavát!";

        else {
            $json = new JSON();
            $this->users = $json->read("users.json");

            if ($user = $this->authenticateUser($_POST)) {
                $this->setSessionDatas($user);

                Helper::getPageURLFromReferer($_POST["redirect_to"]);

                $url = "/fa4zpw/";
                if (isset($_POST["redirect_to"]) && !empty($_POST["redirect_to"]) &&
                    !in_array($_POST["redirect_to"], self::$exceptedURLs)) {
                    $url .= "?page=" . $_POST["redirect_to"];
                }

                return header("Location: {$url}");
            } else {
                $data["error"]["message"] = "Hibás e-mail cím vagy jelszó!";
            }
        }

        return false;
    }

    public function logout()
    {
        session_destroy();

        return header("Location: {$_SERVER["HTTP_REFERER"]}");
    }

    /**
     * @param $email
     * @param null $id
     * @return bool
     */
    private function isEmailExists($email, $id = null)
    {
        if (!$this->users)
            return false;

        foreach ($this->users as $user) {
            if ($user->email == $email) {
                if ($id) {
                    if ($user->id != $id)
                        return true;

                    return false;
                }

                return true;
            }
        }

        return false;
    }

    /**
     * @param $post
     * @return bool
     */
    private function authenticateUser($post)
    {
        if (!$this->users)
            return false;

        foreach ($this->users as $user) {
            if ($user->email == $post["email"] && $user->password == md5($post["passwd"]))
                return $user;
        }

        return false;
    }

    /**
     * @param $user
     */
    private function setSessionDatas($user)
    {
        $_SESSION["user"] = $user;
    }

    /**
     * @param $post
     */
    public function register($post)
    {
        global $data;

        if (!isset($_POST["lastname"]) || isset($_POST["lastname"]) && empty($_POST["lastname"]))
            $data["error"]["message"] = "Nem adta meg a vezetéknevét!";

        else if (!isset($_POST["firstname"]) || isset($_POST["firstname"]) && empty($_POST["firstname"]))
            $data["error"]["message"] = "Nem adta meg a keresztnevét!";

        else if (!isset($_POST["email"]) || isset($_POST["email"]) && empty($_POST["email"]))
            $data["error"]["message"] = "Nem adta meg az e-mail címet!";

        else if (!isset($_POST["passwd"]) || isset($_POST["passwd"]) && empty($_POST["passwd"]))
            $data["error"]["message"] = "Nem adta meg a jelszavát!";

        else if (!isset($_POST["repasswd"]) || isset($_POST["repasswd"]) && empty($_POST["repasswd"]))
            $data["error"]["message"] = "Nem erősítette meg jelszavát!";

        else if ($_POST["passwd"] != $_POST["repasswd"])
            $data["error"]["message"] = "A megadott jelszavak nem egyeznek!";

        else {
            $json = new JSON();
            $this->users = (array)$json->read("users.json");

            if (!$this->isEmailExists($post["email"])) {
                $this->users[] = [
                    "id" => count($this->users) + 1,
                    "firstname" => $post["firstname"],
                    "lastname" => $post["lastname"],
                    "email" => $post["email"],
                    "password" => md5($post["passwd"]),
                    "birthday" => $post["birthday"],
                    "created_at" => time()
                ];

                $json->write("users.json", $this->users);

                header("Location: /fa4zpw/?page=regisztracio&success");
            } else {
                $data["error"]["message"] = "A megadott e-mail címmel már létezik regisztráció!";
            }
        }
    }

    public function update($post)
    {
        global $data;

        if (!isset($_POST["lastname"]) || isset($_POST["lastname"]) && empty($_POST["lastname"]))
            $data["error"]["message"] = "Nem adta meg a vezetéknevét!";

        else if (!isset($_POST["firstname"]) || isset($_POST["firstname"]) && empty($_POST["firstname"]))
            $data["error"]["message"] = "Nem adta meg a keresztnevét!";

        else if (!isset($_POST["email"]) || isset($_POST["email"]) && empty($_POST["email"]))
            $data["error"]["message"] = "Nem adta meg az e-mail címet!";

        else {
            $json = new JSON();
            $this->users = (array)$json->read("users.json");

            if (!$this->isEmailExists($post["email"], $_SESSION["user"]->id)) {
                $this->updateUsers($_SESSION["user"]->id, $post);
                $json->write("users.json", $this->users);

                header("Location: /fa4zpw/?page=profilom&success");
            } else {
                $data["error"]["message"] = "A megadott e-mail címmel már létezik regisztráció!";
            }
        }
    }

    private function updateUsers($userId, $data)
    {
        foreach ($this->users as &$user) {
            if ($user->id == $userId) {
                $user->firstname = $data["firstname"];
                $user->lastname = $data["lastname"];
                $user->email = $data["email"];
                $user->birthday = $data["birthday"];

                $_SESSION["user"]->firstname = $data["firstname"];
                $_SESSION["user"]->lastname = $data["lastname"];
                $_SESSION["user"]->email = $data["email"];
                $_SESSION["user"]->birthday = $data["birthday"];
            }
        }
    }

}