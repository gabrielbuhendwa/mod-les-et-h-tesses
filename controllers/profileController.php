<?php
session_start();
require('../database/db.php');

// Check if user is authenticated
if (!isset($_SESSION['id'])) {
    header('Location: ../pages/login.php');
    exit;
}

// Fetch the user data from the database
$user_id = $_SESSION['id'];
$query = $bdd->prepare("SELECT * FROM users WHERE id = ?");
$query->execute([$user_id]);
$user = $query->fetch();

if (!$user) {
    die("Profil non trouvé.");
}

// Update profile logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = '';
    $success = '';

    // Retrieve form data
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $address = htmlspecialchars(trim($_POST['address']));
    $new_password = trim($_POST['new_password']);
    $current_password = trim($_POST['current_password']);
    $profile = $_FILES['profile'];

    // Ensure current password is provided
    if (empty($current_password)) {
        $error = "Entrez votre mot de passe avant d'enregistrer vos modifications.";
    } elseif (!password_verify($current_password, $user['password'])) {
        $error = "Mot de passe actuel incorrect.";
    } else {
        // Email validation
        if ($email !== $user['email']) {
            $email_check_query = $bdd->prepare("SELECT id FROM users WHERE email = ?");
            $email_check_query->execute([$email]);
            if ($email_check_query->rowCount() > 0) {
                $error = "Email déjà utilisé.";
            }
        }

        // Phone validation
        if (!preg_match('/^\+[1-9][0-9]{1,3}[0-9]{6,12}$/', $phone)) {
            $error = "Le numéro de téléphone doit commencer par un indicatif de pays (ex. +33) et contenir 8 à 15 chiffres après.";
        }

        // Profile picture validation
        if (!empty($profile['name'])) {
            $sizeMax = 4097152; // 4MB
            $validExtensions = array('jpg', 'jpeg', 'gif', 'jfif', 'png');
            $extensionUpload = strtolower(pathinfo($profile['name'], PATHINFO_EXTENSION));
            if ($profile['size'] > $sizeMax) {
                $error = "La photo de profil ne doit pas dépasser 4MB.";
            } elseif (!in_array($extensionUpload, $validExtensions)) {
                $error = "La photo de profil doit être au format jpg, jpeg, gif, jfif ou png.";
            } else {
                $uniqueName = uniqid() . '.' . $extensionUpload;
                $destination = __DIR__ . "/../asset/images/profiles/" . $uniqueName;
                if (!move_uploaded_file($profile['tmp_name'], $destination)) {
                    $error = "Erreur lors de l'enregistrement de la photo de profil.";
                }
            }
        }

        // Password validation
        if (!empty($new_password)) {
            $password_error = validatePassword($new_password);
            if ($password_error !== true) {
                $error = $password_error;
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            }
        }

        // Update user details if no errors
        if (empty($error)) {
            $update_query = $bdd->prepare("
                UPDATE users SET 
                first_name = :first_name, 
                last_name = :last_name, 
                email = :email, 
                telephone = :phone, 
                address = :address, 
                profile_picture = :profile, 
                password = COALESCE(:password, password) 
                WHERE id = :id
            ");
            $update_query->execute([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'profile' => !empty($profile['name']) ? $uniqueName : $user['profile_picture'],
                'password' => $new_password ? $hashed_password : null,
                'id' => $user_id
            ]);

            // Update session variables to reflect the changes
            $_SESSION['profile_picture'] = !empty($profile['name']) ? $uniqueName : $user['profile_picture'];
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['email'] = $email;

            $_SESSION['status'] = "Vos modifications ont été apportées.";
            header('Location: profile.php');
            exit;
        }
    }
}

// Function to validate password strength
function validatePassword($password) {
    if (strlen($password) < 8 || strlen($password) > 15) {
        return "Le mot de passe doit contenir entre 8 et 15 caractères.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "Le mot de passe doit contenir au moins une lettre majuscule.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        return "Le mot de passe doit contenir au moins une lettre minuscule.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        return "Le mot de passe doit contenir au moins un chiffre.";
    }
    if (!preg_match('/[\W_]/', $password)) {
        return "Le mot de passe doit contenir au moins un caractère spécial.";
    }
    return true;
}
?>
