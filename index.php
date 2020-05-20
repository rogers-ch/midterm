<?php

/*
 * Created by:                Corey Rogers
 * Date submitted (v1.0):     05/20/2020
 * Assignment:                IT 328 Midterm Part II
 * File Description:          This is controller for midterm programming problem
 *
 */


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');

//Instantiate the F3 Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function() {
    //echo '<h1>Hello world!</h1>';

    $view = new Template();
    echo $view->render('views/home.html');

});


//Survey route
$f3->route('GET|POST /survey', function($f3){
    //echo '<h1>Hello out there</h1>';

    //Create an array of checkbox options
    $surveyOptions = array("This midterm is easy", "I like midterms", "Today is Monday");

    //If the form has been submitted
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        //var_dump($_POST);

        //validate the data
        if(empty($_POST['name']) || !isset($_POST['surveyOptions'])) {
            if (empty($_POST['name'])) {
                $f3->set("errors['name']", "Please enter your name.");
            }
            if (!isset($_POST['surveyOptions'])) {
                $f3->set("errors['surveyOptions']", "Please check at least one box.");
            }
        }
        //data is valid
        else {
            //Store the data in the session array - b/c this form is posting to self, and you don't want to lose data
            // when you go to the summary page
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['surveyOptions'] = $_POST['surveyOptions'];

            //Redirect to summary page
            $f3->reroute('summary');
        }


    }

    //add surveyOptions array to hive
    $f3->set('surveyOptions', $surveyOptions);

    $view = new Template();
    echo $view->render("views/survey.html");

});

//Summary route
$f3->route('GET /summary', function() {
    //echo '<h1>Welcome to my summary</h1>';

    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();

});


//Run fat free
$f3->run();