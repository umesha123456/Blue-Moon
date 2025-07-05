<?php
ob_start();
session_start();

// Include password hashing library
require '../lib/phpPasswordHashing/passwordLib.php';

require 'DB.php';
require 'Util.php';
require 'dao/CustomerDAO.php';
require 'dao/AdminDAO.php';
require 'models/Customer.php';
require 'models/Admin.php';
require 'handlers/CustomerHandler.php';
require 'handlers/AdminHandler.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitBtn"])) {
    $errors_ = null;

    // Basic validation
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors_ .= Util::displayAlertV1("Please enter a valid email address", "warning");
    }
    if (empty($_POST["password"])) {
        $errors_ .= Util::displayAlertV1("Password is required.", "warning");
    }

    if (!empty($errors_)) {
        echo $errors_;
        exit;
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Initialize handler and set up Customer object
    $handler = new CustomerHandler();
    $customer = new Customer();
    $customer->setEmail($email);

    // Check if email is admin
    $isAdmin = $handler->handleIsAdmin($email);

    // Secure password check (handler should safely fetch and compare using hashed password)
    if (!$handler->isPasswordMatchWithEmail($password, $customer)) {
        echo Util::displayAlertV1("Incorrect password.", "warning");
        exit;
    }

    // Login success, start session
    if ($isAdmin) {
        $_SESSION["username"] = $email;
        $_SESSION["accountEmail"] = $email;
        $_SESSION["isAdmin"] = [1, "true"];
        echo json_encode($_SESSION["isAdmin"]);
    } else {
        $_SESSION["username"] = $handler->getUsername($email);
        $_SESSION["accountEmail"] = $email;
        $_SESSION["authenticated"] = [1, "false"];

        // Optional: Get phone number if exists
        $customerObj = $handler->getCustomerObj($email);
        if ($customerObj && $customerObj->getPhone()) {
            $_SESSION["phoneNumber"] = $customerObj->getPhone();
        }

        echo json_encode($_SESSION["authenticated"]);
    }
}
