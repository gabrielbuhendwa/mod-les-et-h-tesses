<?php 
session_start(); 
require('../database/db.php');

if (isset($_SESSION['id'])) {
    $query = $bdd->prepare("SELECT * FROM users WHERE id = ?");
    $query->execute([$_SESSION['id']]);
    $user = $query->fetch();

    if ($user) {
        $_SESSION['profile_picture'] = $user['profile_picture'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];  
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Policies</title>
    <link rel="stylesheet" href="../asset/css/policy.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
<?php include '../includes/head.php'?>
    <section class="hero-section">
        <div class="content-wrapper">
            <div class="about-content">
                <h1 class="about-title">Politique d'Annulation ou de Modification de Réservation</h1>
                <div class="text-content">
                    <p><strong>Models & Hostesses by General Consulting Group</strong></p>
                    <p><strong>Contact :</strong> contact@generalconsultinggroups.com</p>

                    <h2 class="section-title">1. Annulation de Réservation</h2>

                    <h3 class="section-title">1.1 Annulation par le client</h3>
                    <p>• Toute annulation doit être communiquée par écrit à <a href="mailto:contact@generalconsultinggroups.com">contact@generalconsultinggroups.com</a>.</p>
                    <p>• Les frais d’annulation s’appliquent comme suit :</p>
                    <ul class="styled-list">
                        <li>Plus de 7 jours avant l’événement : 20 % du montant total facturé.</li>
                        <li>Entre 3 et 7 jours avant l’événement : 50 % du montant total facturé.</li>
                        <li>Moins de 3 jours avant l’événement : 100 % du montant total facturé.</li>
                    </ul>

                    <h3 class="section-title">1.2 Annulation par Models & Hostesses</h3>
                    <p>• En cas de circonstances imprévues de notre côté, nous proposerons un remplaçant ou un remboursement total si aucun remplacement n’est possible.</p>

                    <h2 class="section-title">2. Modification de Réservation</h2>

                    <h3 class="section-title">2.1 Par le client</h3>
                    <p>• Toute demande de modification (changement de date, horaire, ou profil de mannequin/hôtesse) doit être envoyée à <a href="mailto:contact@generalconsultinggroups.com">contact@generalconsultinggroups.com</a> au moins 5 jours avant l’événement.</p>
                    <p>• Nous ferons tout notre possible pour satisfaire votre demande, mais nous ne garantissons pas la disponibilité. Des frais supplémentaires peuvent s’appliquer en fonction de la modification.</p>

                    <h3 class="section-title">2.2 Par Models & Hostesses</h3>
                    <p>• Si une modification s’avère nécessaire de notre part (par exemple, indisponibilité de l’hôte/hôtesse réservé), nous fournirons un remplacement équivalent sans frais supplémentaires.</p>

                    <h2 class="section-title">3. Non-Présentation</h2>
                    <p>• En cas de non-présentation du client ou de retard de plus de 2 heures sans notification préalable, la réservation sera considérée comme annulée, et aucun remboursement ne sera effectué.</p>

                    <h2 class="section-title">4. Paiement et Remboursement</h2>
                    <p>• Les remboursements, le cas échéant, seront traités dans un délai de 10 jours ouvrables après confirmation de l’annulation.</p>
                    <p>• Les paiements effectués via des tiers (passerelles de paiement) peuvent inclure des frais de transaction non remboursables.</p>

                    <h2 class="section-title">5. Conditions Spéciales</h2>
                    <p>• Toute réservation soumise à un contrat spécifique (événements à grande échelle, contrats à long terme) peut inclure des termes supplémentaires. Ces derniers prévaudront en cas de divergence avec cette politique générale.</p>

                    <p class="final-section">Nous sommes à votre disposition pour toute question ou assistance à l’adresse suivante : <a href="mailto:contact@generalconsultinggroups.com">contact@generalconsultinggroups.com</a></p>
                </div>
            </div>
        </div>
    </section>
    <?php include '../includes/footer.php'?>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      const menuToggle = document.querySelector('.menu-toggle');
      const mobileMenu = document.querySelector('.mobile-menu');
      const toggleIcon = menuToggle.querySelector('i');

      menuToggle.addEventListener('click', () => {
          // Toggle the mobile menu visibility
          mobileMenu.classList.toggle('open');
          
          // Change the icon between the hamburger and close (X) icon
          toggleIcon.classList.toggle('fa-bars');
          toggleIcon.classList.toggle('fa-xmark');
      });
  });
 </script>
</html>