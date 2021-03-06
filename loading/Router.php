<?php

    require_once("./loading/autoload.php");

class Router{
    private $ctrChef;
    private $ctrMeal;
    private $ctrUser;
    private $ctrGrade;
    private $ctrpub;
    private $ctrClient;

    public function __construct(){
        $this->ctrChef = new ChefController();
        $this->ctrMeal = new MealController();
        $this->ctrUser = new UserController();
        $this->ctrGrade = new GradeController();
        $this->ctrpub = new PublicController();
        $this->ctrClient = new ClientController();
    }

    // getPath = Pour aller chercher le bon controller
    public function getPath(){
        try{
            if(isset($_GET["action"])){
                switch($_GET["action"]){
                    case "list_chefs" :
                        $this-> ctrChef -> chefsList();
                        break;
                    case "delete_chef" :
                        $this -> ctrChef -> removeChef();
                        break;
                    case "edit_chef" :
                        $this->ctrChef->editChef();
                        break;
                    case "add_chef" :
                        $this->ctrChef->addChef();
                        break;
                    case "list_meals" :
                        $this->ctrMeal->mealsList();
                        break;
                    case "add_meal" :
                        $this->ctrMeal->addMeal();
                        break;
                    case "delete_meal" :
                        $this->ctrMeal->removeMeal();
                        break;
                    case "edit_meal" :
                        $this->ctrMeal->editMeal();
                        break;
                    case "list_users" :
                        $this->ctrUser->usersList(); 
                        break;
                    case "login" :
                        $this->ctrUser->login();
                        break;
                    case "logout" :
                        AuthController::logout(); // Méthode appelée via la class car méthode statique
                        break;
                    case "edit_user" :
                        $this->ctrUser->editUser();
                        break;
                    case "register" :
                        $this->ctrUser->addUser();
                        break;
                    case "list_grades" :
                        $this->ctrGrade->gradesList();
                        break;
                    case "edit_grade" :
                        $this->ctrGrade->editGrade();
                        break;
                    case "add_grade" :
                        $this->ctrGrade->addGrade();
                        break;
                    case "delete_grade" :
                        $this->ctrGrade->removeGrade();
                        break;
                    case "list_clients" : // Liste clients admin
                        $this->ctrClient->clientsList();
                        break;
                    case "accueil" :
                        $this->ctrpub->getPubMeals();
                        break;
                    case "del_meal" : //Essai suppression panier
                        $this->ctrpub->removePanier();
                        break;
                    case "add_menu" : //Essai ajout panier
                        $this->ctrpub->addMenu();
                            break;
                    case "home" :
                        $this->ctrpub->home();
                        break;
                    case "chefs" :
                        $this->ctrpub->chefs();
                        break;
                    case "checkout" :
                        $this->ctrpub->recap();
                        break;
                    case "pay" :
                        $this->ctrpub->payment();
                        break;
                    case "success" :
                        $this->ctrpub->confirmation();
                        break;
                    case "validation" :
                        $this->ctrpub->validation();
                        break;
                    case "cancel" :
                        $this->ctrpub->cancel();
                        break;
                    case "contact" :
                        $this->ctrpub->contact();
                        break;
                    case "about" :
                        $this->ctrpub->about();
                        break;
                    default:
                        throw new Exception("Action non définie");
                }
            }else{
                // $this -> ctrpub -> getPubMeals();
                $this -> ctrpub -> home();
                session_unset();
            }
        }catch (Exception $e){
            $this->page404($e->getMessage());
        }
    }

    private function page404($errorMsg){
        require_once("./views/notFound.php");
    }
}