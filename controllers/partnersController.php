<?php
require('../database/db.php');

// Ensure the form is submitted and check if the fields are filled
if (isset($_POST['add'])) {
    // Check if 'name', 'description', and 'photo' are filled
    if (!empty($_POST['name']) && !empty($_POST['description']) && isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Handle photo upload validation
        $photo = $_FILES['photo'];
        $photoName = $photo['name'];
        $photoTmpName = $photo['tmp_name'];
        $photoSize = $photo['size'];
        $photoError = $photo['error'];

        // Define the allowed file extensions and max file size
        $validExtensions = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
        $sizeMax = 8 * 1024 * 1024; // 4MB max file size

        // Set the upload directory relative to the current file
        $uploadDirectory = __DIR__ . "/../asset/images/partners/";

        // Validate photo upload
        if ($photoError === 0) {
            if ($photoSize <= $sizeMax) {
                $photoExtension = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
                if (in_array($photoExtension, $validExtensions)) {
                    $uniquePhotoName = uniqid() . '.' . $photoExtension;
                    $destination = $uploadDirectory . $uniquePhotoName;

                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($photoTmpName, $destination)) {
                        // Insert partner info into the database
                        try {
                            // Prepare the SQL INSERT query
                            $insertPartner = $bdd->prepare('INSERT INTO partners (name, description, photo) VALUES (?, ?, ?)');

                            // Execute the query with form data
                            $insertPartner->execute([$name, $description, $uniquePhotoName]);

                            // Redirect to partners page with a success message
                            echo "<script>
                                alert('Le partenaire a été ajouté avec succès!');
                                window.location.href = '../admin/our_partners.php';
                            </script>";
                        } catch (Exception $e) {
                            $error = "Une erreur est survenue lors de l'ajout du partenaire : " . $e->getMessage();
                        }
                    } else {
                        $error = "Erreur lors de l'importation de la photo du partenaire.";
                    }
                } else {
                    $error = "La photo du partenaire doit être au format jpg, jpeg, gif, png ou webp.";
                }
            } else {
                $error = "La photo du partenaire doit être inférieure à 8 Mo.";
            }
        } else {
            $error = "Veuillez télécharger une photo du partenaire.";
        }
    } else {
        $error = "Veuillez compléter tous les champs du formulaire.";
    }

}

    // EDIT PARTNER LOGIC
    if (isset($_GET['id'])) {
        $partnerId = $_GET['id'];
    
        // Fetch the partner data from the database
        $getPartner = $bdd->prepare('SELECT * FROM partners WHERE id = ?');
        $getPartner->execute([$partnerId]);
        $partner = $getPartner->fetch();
    
        if (!$partner) {
            $error = "Le partenaire n'existe pas.";
        } else {
            // Check if the form is submitted
            if (isset($_POST['edit'])) {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $photo = $_FILES['photo'] ?? null;
    
                // Validate form inputs
                if (!empty($name) && !empty($description)) {
                    try {
                        $photoQuery = '';
                        $photoParams = [];
    
                        // Handle photo upload if a new one is provided
                        if ($photo && !empty($photo['name'])) {
                            $photoName = $photo['name'];
                            $photoTmpName = $photo['tmp_name'];
                            $photoSize = $photo['size'];
                            $photoError = $photo['error'];
    
                            $validExtensions = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                            $sizeMax = 8 * 1024 * 1024; // 8MB max file size
                            $uploadDirectory = __DIR__ . "/../asset/images/partners/";
    
                            if ($photoError === 0) {
                                if ($photoSize <= $sizeMax) {
                                    $photoExtension = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
                                    if (in_array($photoExtension, $validExtensions)) {
                                        $uniquePhotoName = uniqid() . '.' . $photoExtension;
                                        $destination = $uploadDirectory . $uniquePhotoName;
    
                                        // Move the uploaded file to the target directory
                                        if (move_uploaded_file($photoTmpName, $destination)) {
                                            // Add photo update query
                                            $photoQuery = ', photo = ?';
                                            $photoParams = [$uniquePhotoName];
    
                                            // Delete the old photo if it exists
                                            if (!empty($partner['photo'])) {
                                                $oldPhotoPath = $uploadDirectory . $partner['photo'];
                                                if (file_exists($oldPhotoPath)) {
                                                    unlink($oldPhotoPath);
                                                }
                                            }
                                        } else {
                                            $error = "Erreur lors de l'importation de la photo du partenaire.";
                                        }
                                    } else {
                                        $error = "La photo du partenaire doit être au format jpg, jpeg, gif, png ou webp.";
                                    }
                                } else {
                                    $error = "La photo du partenaire doit être inférieure à 8 Mo.";
                                }
                            } else {
                                $error = "Erreur lors du téléchargement de la photo.";
                            }
                        }
    
                        // Proceed with database update if no errors
                        if (!isset($error)) {
                            $updateQuery = "UPDATE partners SET name = ?, description = ? $photoQuery WHERE id = ?";
                            $updateParams = array_merge([$name, $description], $photoParams, [$partnerId]);
    
                            $updatePartner = $bdd->prepare($updateQuery);
                            $updatePartner->execute($updateParams);
    
                            // Redirect to partners page with success message
                            echo "<script>
                                alert('Le partenaire a été modifié avec succès!');
                                window.location.href = '../admin/our_partners.php';
                            </script>";
                        }
                    } catch (Exception $e) {
                        $error = "Une erreur est survenue lors de la modification du partenaire : " . $e->getMessage();
                    }
                } else {
                    $error = "Veuillez compléter tous les champs.";
                }
            }
        }
    }
    



    // DELETE PARTNER LOGIC
    if (isset($_POST['delete_partner'])) {
        $partnerId = $_POST['id'];
    
        // Check if the partner exists in the database
        $checkPartner = $bdd->prepare('SELECT * FROM partners WHERE id = ?');
        $checkPartner->execute([$partnerId]);
        $partner = $checkPartner->fetch();
    
        if (!$partner) {
            $error = "Le partenaire n'existe pas.";
        } else {
            try {
                // Delete the partner's photo file if it exists
                $uploadDirectory = __DIR__ . '/../asset/images/partners/';
                $photoPath = $uploadDirectory . $partner['photo'];
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
    
                // Delete the partner from the database
                $deletePartner = $bdd->prepare('DELETE FROM partners WHERE id = ?');
                $deletePartner->execute([$partnerId]);
    
                // Redirect to partners page with success message
                echo "<script>
                    alert('Le partenaire a été supprimé avec succès!');
                    window.location.href = '../admin/our_partners.php';
                </script>";
            } catch (Exception $e) {
                $error = "Une erreur est survenue lors de la suppression du partenaire : " . $e->getMessage();
            }
        }
    }
    
?>