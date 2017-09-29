<?php

namespace Oenstrom\User;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Oenstrom\User\HTMLForm\LoginForm;
use \Oenstrom\User\HTMLForm\RegisterForm;
use \Oenstrom\User\HTMLForm\ProfileForm;

// use \Anax\Book\HTMLForm\UpdateForm;
/**
 * A User controller class.
 */
class UserController implements InjectionAwareInterface
{
    use InjectionAwareTrait;



    /**
     * @var $data description
     */
    //private $data;



    /**
     * Handler with form to register an user.
     *
     * @return void
     */
    public function getPostRegister()
    {
        $title       = "Skapa konto";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $form        = new RegisterForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "title" => $title,
        ];
        $view->add("user/user-register", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler with form to login an user.
     *
     * @return void
     */
    public function getPostLogin()
    {
        $title       = "Logga in";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $form        = new LoginForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(["use_fieldset" => false, "use_buttonbar" => false]),
        ];
        $view->add("user/user-login", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler to logout an user.
     *
     * @return void
     */
    public function getLogout()
    {
        $session = $this->di->get("session");
        $session->destroy();
        $this->di->get("response")->redirect("");
    }



    /**
     * Handler with form to update an user profile.
     *
     * @return void
     */
    public function getPostProfile()
    {
        $title       = "Din profil";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $auth        = $this->di->get("authHelper");
        $form        = new ProfileForm($this->di);

        $form->check();


        $data = [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "gravatar" => $this->getGravatar($this->di->get("session")->get("email"), true, 256)
        ];

        if ($auth->isAdmin()) {
            $view->add("user/admin/admin-links", []);
        }
        $view->add("user/profile", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param string $size Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $default Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $rating Maximum rating (inclusive) [ g | pg | r | x ]
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source https://gravatar.com/site/implement/images/php/
     */
    private function getGravatar($email, $img = false, $size = 80, $default = 'mm', $rating = 'g', $atts = array())
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$size&d=$default&r=$rating";
        if ($img) {
            $url = '<img src="' . $url . '" alt="' . $email . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }
        return $url;
    }
}
