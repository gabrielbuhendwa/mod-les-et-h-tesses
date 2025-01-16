<?php
session_start();
require('../database/db.php');

if (isset($_POST['submit'])) {
    // Sanitize all the text input fields
    $gender = isset($_POST['gender']) ? htmlspecialchars(trim($_POST['gender'])) : null;
    $firstName = isset($_POST['first-name']) ? htmlspecialchars(trim($_POST['first-name'])) : null;
    $lastName = isset($_POST['last-name']) ? htmlspecialchars(trim($_POST['last-name'])) : null;
    $birthDay = isset($_POST['birth-day']) ? htmlspecialchars(trim($_POST['birth-day'])) : null;
    $birthMonth = isset($_POST['birth-month']) ? htmlspecialchars(trim($_POST['birth-month'])) : null;
    $birthYear = isset($_POST['birth-year']) ? htmlspecialchars(trim($_POST['birth-year'])) : null;
    $city = isset($_POST['city']) ? htmlspecialchars(trim($_POST['city'])) : null;
    $code = isset($_POST['code']) ? htmlspecialchars(trim($_POST['code'])) : null;
    $country = isset($_POST['country']) ? htmlspecialchars(trim($_POST['country'])) : null;
    $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : null;
    $whatsapp = isset($_POST['whatsapp']) ? htmlspecialchars(trim($_POST['whatsapp'])) : null;
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
    $instagram = isset($_POST['instagram']) ? htmlspecialchars(trim($_POST['instagram'])) : null;
    $height = isset($_POST['height']) ? htmlspecialchars(trim($_POST['height'])) : null;
    $languages = [];
    for ($i = 1; $i <= 3; $i++) {
        $languages[$i] = isset($_POST["language-$i"]) ? htmlspecialchars(trim($_POST["language-$i"])) : null;
    }
    $hair = isset($_POST['hair']) ? htmlspecialchars(trim($_POST['hair'])) : null;
    $eye = isset($_POST['eye']) ? htmlspecialchars(trim($_POST['eye'])) : null;
    $shoeSize = isset($_POST['shoe-size']) ? htmlspecialchars(trim($_POST['shoe-size'])) : null;

    // File inputs for pictures (Passport, National ID, Driver's License)
    $idCard = $_FILES['id_card']['name'] ?? '';
    $portraitFace = $_FILES['face']['name'] ?? '';
    $portraitProfile = $_FILES['profil']['name'] ?? '';
    $fullBody = $_FILES['front']['name'] ?? '';
    $actionPhoto = $_FILES['action']['name'] ?? '';
    
    //for the day user send the request 
    $request_date = date('Y-m-d H:i:s');


    // Validate all fields are filled, except for file uploads where at least one must be filled
    if (
        !empty($gender) && !empty($firstName) && !empty($lastName) && !empty($birthDay) && !empty($birthMonth) && !empty($birthYear) &&
        !empty($city) && !empty($code) && !empty($country) && !empty($phone) && !empty($whatsapp) && !empty($email) &&
        !empty($height) && !empty($languages[1]) && !empty($languages[2]) &&
        !empty($hair) && !empty($eye) && !empty($shoeSize) //&&
        //!empty($idCard) && !empty($portraitFace) && !empty($portraitProfile) && 
        //!empty($fullBody) && !empty($actionPhoto) && !empty($bathSuit)
    ) {
        // Validate inputs
        if (strlen($firstName) >= 2 && strlen($lastName) >= 2 && strlen($country) >= 2 && strlen($city) >= 2 
            && !preg_match('/[^a-zA-Z]/', $firstName) 
            && !preg_match('/[^a-zA-Z]/', $lastName) 
            && !preg_match('/[^a-zA-Z]/', $country) 
            && !preg_match('/[^a-zA-Z]/', $city)) {

            //name of code
            if (preg_match('/[a-zA-Z]/', $code) && preg_match('/\d/', $code)) {

                    //phone number 
                    $phone = htmlspecialchars(trim($_POST['phone']));
                    if (preg_match('/^\+([0-9]{1,4})[0-9]{7,14}$/', $phone)) {

                        //whatsaap number
                        $whatsapp = htmlspecialchars(trim($_POST['whatsapp']));
                        if (preg_match('/^\+([0-9]{1,4})[0-9]{7,14}$/', $whatsapp)) {
                           
                            //check email
                            $email = htmlspecialchars(trim($_POST['email']));

                            // Validate the email address
                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                               ////check differents pictures as well 
                              // Process Identity Card
                                if (isset($_FILES['id_card']) && !empty($_FILES['id_card']['name'])) {
                                    $sizeMax = 4097152; // 4 MB
                                    $validExtensions = array('jpg', 'jpeg', 'gif', 'png', 'webp');
                                    if ($_FILES['id_card']['size'] <= $sizeMax) {
                                        $extensionUpload = strtolower(pathinfo($_FILES['id_card']['name'], PATHINFO_EXTENSION));
                                        if (in_array($extensionUpload, $validExtensions)) {
                                            $uniqueName = uniqid() . '.' . $extensionUpload;
                                            $destination = __DIR__ . "/../asset/images/models/" . $uniqueName;
                                            $result = move_uploaded_file($_FILES['id_card']['tmp_name'], $destination);
                                            if ($result) {
                                                $idCard = $uniqueName;

                                                // Process Portrait Face
                                                if (isset($_FILES['face']) && !empty($_FILES['face']['name'])) {
                                                    if ($_FILES['face']['size'] <= $sizeMax) {
                                                        $extensionUpload = strtolower(pathinfo($_FILES['face']['name'], PATHINFO_EXTENSION));
                                                        if (in_array($extensionUpload, $validExtensions)) {
                                                            $uniqueName = uniqid() . '.' . $extensionUpload;
                                                            $destination = __DIR__ . "/../asset/images/models/" . $uniqueName;
                                                            $result = move_uploaded_file($_FILES['face']['tmp_name'], $destination);
                                                            if ($result) {
                                                                $portraitFace = $uniqueName;

                                                                // Process Portrait Profile
                                                                if (isset($_FILES['profil']) && !empty($_FILES['profil']['name'])) {
                                                                    if ($_FILES['profil']['size'] <= $sizeMax) {
                                                                        $extensionUpload = strtolower(pathinfo($_FILES['profil']['name'], PATHINFO_EXTENSION));
                                                                        if (in_array($extensionUpload, $validExtensions)) {
                                                                            $uniqueName = uniqid() . '.' . $extensionUpload;
                                                                            $destination = __DIR__ . "/../asset/images/models/" . $uniqueName;
                                                                            $result = move_uploaded_file($_FILES['profil']['tmp_name'], $destination);
                                                                            if ($result) {
                                                                                $portraitProfile = $uniqueName;

                                                                                // Process Full Body
                                                                                if (isset($_FILES['front']) && !empty($_FILES['front']['name'])) {
                                                                                    if ($_FILES['front']['size'] <= $sizeMax) {
                                                                                        $extensionUpload = strtolower(pathinfo($_FILES['front']['name'], PATHINFO_EXTENSION));
                                                                                        if (in_array($extensionUpload, $validExtensions)) {
                                                                                            $uniqueName = uniqid() . '.' . $extensionUpload;
                                                                                            $destination = __DIR__ . "/../asset/images/models/" . $uniqueName;
                                                                                            $result = move_uploaded_file($_FILES['front']['tmp_name'], $destination);
                                                                                            if ($result) {
                                                                                                $fullBody = $uniqueName;

                                                                                                // Process Action Photo
                                                                                                if (isset($_FILES['action']) && !empty($_FILES['action']['name'])) {
                                                                                                    if ($_FILES['action']['size'] <= $sizeMax) {
                                                                                                        $extensionUpload = strtolower(pathinfo($_FILES['action']['name'], PATHINFO_EXTENSION));
                                                                                                        if (in_array($extensionUpload, $validExtensions)) {
                                                                                                            $uniqueName = uniqid() . '.' . $extensionUpload;
                                                                                                            $destination = __DIR__ . "/../asset/images/models/" . $uniqueName;
                                                                                                            $result = move_uploaded_file($_FILES['action']['tmp_name'], $destination);
                                                                                                            if ($result) {
                                                                                                                $actionPhoto = $uniqueName;

                                                                                                                                // All uploads are successful
                                                            
                                                                                                                                try {
                                                                                                                                    // Prepare the SQL INSERT query
                                                                                                                                    $insert_models = $bdd->prepare('INSERT INTO models_request (
                                                                                                                                         gender, first_name, last_name, birth_date, city, code_number, nationality, phone, whatsapp, email, instagram, height, languages,
                                                                                                                                        hair, eye, shoes_size, id_card, face_portrait, profile_portrait, full_body_front_side, action_shot, request_date
                                                                                                                                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

                                                                                                                                    // Format the birth date as "day/month/year"
                                                                                                                                    $birth_date = isset($birthDay) && isset($birthMonth) && isset($birthYear) ? "{$birthDay}/{$birthMonth}/{$birthYear}" : null;

                                                                                                                                    // Format languages (taking up to 3 languages)
                                                                                                                                    $languages_selected = implode(", ", array_filter([$languages[1], $languages[2], $languages[3]]));

                                                                                                                                    // Prepare the values to insert
                                                                                                                                    $values = [
                                                                                                                                        $gender,
                                                                                                                                        $firstName,
                                                                                                                                        $lastName,
                                                                                                                                        $birth_date,
                                                                                                                                        $city,
                                                                                                                                        $code,
                                                                                                                                        $country,
                                                                                                                                        $phone,
                                                                                                                                        $whatsapp,
                                                                                                                                        $email,
                                                                                                                                        $instagram,
                                                                                                                                        $height,
                                                                                                                                        $languages_selected,
                                                                                                                                        $hair,
                                                                                                                                        $eye,
                                                                                                                                        $shoeSize,
                                                                                                                                        $idCard,
                                                                                                                                        $portraitFace,
                                                                                                                                        $portraitProfile,
                                                                                                                                        $fullBody,
                                                                                                                                        $actionPhoto,
                                                                                                                                        $request_date
                                                                                                                                    ];

                                                                                                                                    // Execute the query with the values
                                                                                                                                    $insert_models->execute($values);

                                                                                                                                    // Success message or redirection
                                                                                                                                    $_SESSION['status'] = "Votre inscription a bien été enregistrée. Nous vérifierons votre candidature et vous enverrons un email avec notre réponse, cela peut prendre un peu de temps.";
                                                                                                                                    echo '<script>
                                                                                                                                                setTimeout(function() {
                                                                                                                                                    window.location.href = "../index.php";
                                                                                                                                                }, 20000);
                                                                                                                                        </script>';

                                                                                                                                } catch (Exception $e) {
                                                                                                                                    die('Error: ' . $e->getMessage());
                                                                                                                                }
                                                                                                                                                                            
                                                                                                            } else {
                                                                                                                $error = "Erreur lors de l'importation de la photo en mouvement.";
                                                                                                            }
                                                                                                        } else {
                                                                                                            $error = "La photo en mouvement doit être au format jpg, jpeg, gif, png ou webp.";
                                                                                                        }
                                                                                                    } else {
                                                                                                        $error = "La photo en mouvement doit être inférieure à 4 Mo.";
                                                                                                    }
                                                                                                } else {
                                                                                                    $error = "Veuillez fournir une photo en mouvement.";
                                                                                                }

                                                                                            } else {
                                                                                                $error = "Erreur lors de l'importation de la photo de corps entier.";
                                                                                            }
                                                                                        } else {
                                                                                            $error = "La photo de corps entier doit être au format jpg, jpeg, gif, png ou webp.";
                                                                                        }
                                                                                    } else {
                                                                                        $error = "La photo de corps entier doit être inférieure à 4 Mo.";
                                                                                    }
                                                                                } else {
                                                                                    $error = "Veuillez fournir une photo de corps entier.";
                                                                                }

                                                                            } else {
                                                                                $error = "Erreur lors de l'importation du portrait de profil.";
                                                                            }
                                                                        } else {
                                                                            $error = "Le portrait de profil doit être au format jpg, jpeg, gif, png ou webp.";
                                                                        }
                                                                    } else {
                                                                        $error = "Le portrait de profil doit être inférieur à 4 Mo.";
                                                                    }
                                                                } else {
                                                                    $error = "Veuillez fournir un portrait de profil.";
                                                                }

                                                            } else {
                                                                $error = "Erreur lors de l'importation du portrait de face.";
                                                            }
                                                        } else {
                                                            $error = "Le portrait de face doit être au format jpg, jpeg, gif, png ou webp.";
                                                        }
                                                    } else {
                                                        $error = "Le portrait de face doit être inférieur à 4 Mo.";
                                                    }
                                                } else {
                                                    $error = "Veuillez fournir un portrait de face.";
                                                }

                                            } else {
                                                $error = "Erreur lors de l'importation de la pièce d’identité.";
                                            }
                                        } else {
                                            $error = "La pièce d’identité doit être au format jpg, jpeg, gif, png ou webp.";
                                        }
                                    } else {
                                        $error = "La pièce d’identité doit être inférieure à 4 Mo.";
                                    }
                                } else {
                                    $error = "Veuillez fournir une pièce d’identité.";
                                }
                                //done for images all the 6 

                            } 
                            else {
                                $error = "Veuillez entrer une adresse email valide.";
                            }

                        } 
                        else {
                            $error = "Veuillez entrer un numéro de WhatsApp valide, y compris l'indicatif du pays.";
                        }


                    }
                    else {
                        $error = "Veuillez entrer un numéro de téléphone valide, y compris l'indicatif du pays.";
                    }

                
            } 
            else {
                    $error = "Le code doit contenir à la fois des lettres et des chiffres.";
            }
                
        } 
        else {
            // Set the error message
            $error = "Veuillez fournir des informations valides. Chaque champ doit comporter au moins 2 caractères alphabétiques.";
        }
    }
    else {
        // Handle errors: set the error message for missing fields
        $error = "Veuillez remplir tous les champs requis";
    }
            
}
?>
