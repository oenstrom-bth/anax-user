<?php

namespace Oenstrom\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Oenstrom\User\HTMLForm\RegisterForm;
use \Oenstrom\User\HTMLForm\EditUserForm;

/**
 * A User controller class.
 */
class AdminController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait, InjectionAwareTrait;


    /**
     * Get all users.
     *
     * @return void
     */
    public function getUsers()
    {
        $title      = "Alla användare";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $user = new User();
        $user->setDb($this->di->get("db"));

        $data = [
            "users" => $user->findAll(),
        ];

        $view->add("user/admin/admin-links", $data);
        $view->add("user/admin/show-users", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Add a new user.
     */
    public function getPostNewUser()
    {
        $title       = "Skapa ny användare";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $form        = new RegisterForm($this->di);

        $form->check();

        $data = [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "title" => $title,
        ];
        $view->add("user/admin/admin-links", $data);
        $view->add("user/user-form", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Edit an user.
     *
     * @param integer $id the id of the user.
     */
    public function getPostEditUser($id)
    {
        $title       = "Redigera användare";
        $view        = $this->di->get("view");
        $pageRender  = $this->di->get("pageRender");
        $form        = new EditUserForm($this->di, $id);

        $form->check();

        $data = [
            "form" => $form->getHTML(["use_buttonbar" => false]),
            "title" => $title,
        ];
        $view->add("user/admin/admin-links", $data);
        $view->add("user/user-form", $data);
        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Delete an user.
     *
     * @param integer $id the id of the user.
     */
    public function getDeleteUser($id)
    {
        $user = new User();
        $user->setDb($this->di->get("db"));
        $user->find("id", $id);
        if ($user->role !== "admin") {
            $user->delete();
        }
        $this->di->get("response")->redirect("admin/users");
    }
}
