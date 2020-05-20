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


//survey route
$f3->route('GET|POST /survey', function($f3){
    //echo '<h1>Hello out there</h1>';

    //Create an array of checkbox options
    $surveyOptions = array("This midterm is easy", "I like midterms", "Today is Monday");

    //add surveyOptions array to hive
    $f3->set('surveyOptions', $surveyOptions);

    $view = new Template();
    echo $view->render("views/survey.html");

});




//Run fat free
$f3->run();