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
                <h1 class="about-title">POLICE DE CHARTES POUR MODELS & HOSTESSES</h1>
                <div class="text-content">
                    <p><strong>General Consulting Group</strong></p>
                    <p><strong>PRÉAMBULE</strong></p>
                    <p>La présente charte vise à établir les principes, règles, et engagements qui régissent la collaboration entre General Consulting Group et ses modèles et hôtesses. Elle reflète les valeurs de professionnalisme, de respect mutuel et d’excellence qui définissent notre société.</p>
                    <p>L’adhésion à cette charte est obligatoire pour tous les modèles et hôtesses représentant General Consulting Group.</p>
                    
                    <h2 class="section-title">ARTICLE 1 : PRINCIPES GÉNÉRAUX</h2>
                    <p><strong>1.1. Respect de l’éthique professionnelle :</strong><br>Les modèles et hôtesses doivent adopter un comportement irréprochable lors de toutes prestations, reflétant l’image et les valeurs de General Consulting Group.</p>
                    <p><strong>1.2. Engagement de qualité :</strong><br>Chaque modèle ou hôtesse s’engage à fournir un service de qualité en respectant les consignes et exigences liées aux missions qui leur sont confiées.</p>
            
                    <h2 class="section-title">ARTICLE 2 : DROITS ET OBLIGATIONS</h2>
                    <p><strong>2.1. Obligations des modèles et hôtesses :</strong><br>
                        Se présenter à l’heure pour les missions assignées.<br>
                        Respecter les directives et les instructions fournies par l’équipe encadrante.<br>
                        Maintenir une présentation soignée et un comportement professionnel en toutes circonstances.<br>
                        Garantir la confidentialité des informations relatives aux activités de General Consulting Group.
                    </p>
                    <p><strong>2.2. Obligations de General Consulting Group:</strong><br>
                        Assurer un cadre de travail sécurisant et respectueux.<br>
                        Fournir des informations claires sur les missions confiées.<br>
                        Effectuer les paiements selon les termes définis dans le contrat de collaboration.
                    </p>
                    
                    <h2 class="section-title">ARTICLE 3 : EXCLUSIVITÉ</h2>
                    <p><strong>3.1.</strong> Tout modèle ou hôtesse recruté(e) pour un projet exclusif s’engage à ne pas collaborer avec des entreprises concurrentes durant la période définie par le contrat d’exclusivité.</p>
                    <p><strong>3.2.</strong> Toute infraction à cette clause peut entraîner la résiliation immédiate du contrat.</p>
            
                    <h2 class="section-title">ARTICLE 4 : DROITS D’IMAGE</h2>
                    <p><strong>4.1.</strong> Les modèles et hôtesses accordent à General Consulting Group  le droit d’utiliser leur image à des fins promotionnelles, publicitaires et commerciales liées aux projets de l’entreprise.</p>
                    <p><strong>4.2.</strong> L’utilisation des images respectera les normes légales et éthiques en vigueur.</p>
                    <p><strong>4.3.</strong> Toute réclamation concernant l’utilisation de l’image doit être adressée par écrit dans un délai de 15 jours après sa diffusion.</p>
            
                    <h2 class="section-title">ARTICLE 5 : CODE DE CONDUITE</h2>
                    <p><strong>5.1.</strong> Les modèles et hôtesses doivent faire preuve de respect envers leurs collègues, clients, et supérieurs hiérarchiques.</p>
                    <p><strong>5.2.</strong> Il est strictement interdit de :</p>
                    <ul class="styled-list">
                        <li>Faire preuve de discrimination, de harcèlement ou de tout autre comportement inapproprié.</li>
                        <li>Consommer ou être sous l’influence de substances illicites lors des missions.</li>
                    </ul>
                    
            
                    <h2 class="section-title">ARTICLE 6 : GESTION DES ABSENCES ET RETARDS</h2>
                    <p><strong>6.1.</strong> Toute absence ou retard doit être justifié(e) et signalé(e) à l’avance auprès des responsables de General Consulting Group .</p>
                    <p><strong>6.2.</strong> Une absence injustifiée peut entraîner des sanctions, incluant la suspension ou la résiliation du contrat.</p>
            
                    <h2 class="section-title">ARTICLE 7 : REMUNÉRATION</h2>
                    <p><strong>7.1.</strong> Les modalités de rémunération sont définies dans le contrat de collaboration et seront respectées par General Consulting Group .</p>
                    <p><strong>7.2.</strong> Aucun paiement ne sera effectué en cas de non-respect des obligations contractuelles.</p>
            
                    <h2 class="section-title">ARTICLE 8 : RÉSILIATION</h2>
                    <p><strong>8.1.</strong> En cas de non-respect des termes de cette charte, General Consulting Group se réserve le droit de mettre fin au contrat sans préavis.</p>
                    <p><strong>8.2.</strong> Le modèle ou l’hôtesse peut demander la résiliation du contrat en fournissant un préavis écrit d’au moins 15 jours.</p>
            
                    <h2 class="section-title">ARTICLE 9 : DISPOSITIONS FINALES</h2>
                    <p><strong>9.1.</strong> Cette charte prend effet à la date de signature par les deux parties.</p>
                    <p><strong>9.2.</strong> Toute modification ou mise à jour de la charte sera communiquée par écrit.</p>
                    <p><strong>9.3.</strong> Les parties reconnaissent avoir lu et compris les termes de cette charte et s’engagent à les respecter.</p>
                </div>
            </div>
        </div>


        <div class="content-wrapper">
            <div class="about-content">
                <h1 class="about-title">POLITIQUE DE CHARTES POUR L’EXCLUSIVITÉ DES IMAGES</h1>
                <div class="text-content">
                    <p><strong>Models & Hostesses by General Consulting Group</strong></p>
                    <p><strong>Préambule</strong></p>
                    <p>La présente politique définit les règles et obligations relatives à l’utilisation exclusive des images des modèles et hôtesses travaillant sous la bannière de General Consulting Group. Elle a pour objectif de protéger les droits des parties et d’assurer une collaboration harmonieuse dans le cadre professionnel.</p>
                    
                    <h2 class="section-title">1. Droits d’utilisation des images</h2>
                    <p><strong>1.1.</strong> Les modèles et hôtesses accordent à General Consulting Group le droit exclusif d’utiliser leurs images dans tous supports publicitaires, marketing, et autres projets professionnels validés par l’entreprise.</p>
                    <p><strong>1.2.</strong> L’exclusivité concerne uniquement les images capturées dans le cadre des activités organisées par General Consulting Group ou mandatées par celle-ci.</p>
                    
                    <h2 class="section-title">2. Étendue de l’exclusivité</h2>
                    <p><strong>2.1.</strong> Les images incluent toutes les photographies, vidéos, et autres supports numériques ou imprimés réalisés pour des campagnes publicitaires, événements, ou promotions de produits/services.</p>
                    <p><strong>2.2.</strong> L’utilisation des images s’étend à toutes les plateformes et médias, y compris mais sans s’y limiter :</p>
                    <ul class="styled-list">
                        <li>Sites web officiels de General Consulting Group </li>
                        <li>Réseaux sociaux</li>
                        <li>Affiches publicitaires</li>
                        <li>Catalogues et brochures</li>
                        <li>Contenu audiovisuel</li>
                    </ul>
                    <p><strong>2.3.</strong> Les modèles et hôtesses ne peuvent autoriser l’utilisation des mêmes images par d’autres entreprises ou individus sans l’autorisation écrite de General Consulting Group .</p>
                    
                    <h2 class="section-title">3. Protection de l’image</h2>
                    <p><strong>3.1.</strong> General Consulting Group s’engage à utiliser les images des modèles et hôtesses de manière éthique et respectueuse, en évitant toute utilisation pouvant nuire à leur réputation ou leur intégrité.</p>
                    <p><strong>3.2.</strong> Les images ne seront pas modifiées ou altérées de manière à compromettre la dignité ou l’identité du modèle ou de l’hôtesse.</p>
                    
                    <h2 class="section-title">4. Confidentialité</h2>
                    <p><strong>4.1.</strong> Les images des modèles et hôtesses restent la propriété intellectuelle conjointe de l’entreprise et du modèle concerné. Leur usage est strictement réservé aux projets approuvés par General Consulting Group.</p>
                    <p><strong>4.2.</strong> Toute fuite ou utilisation non autorisée des images sera considérée comme une violation de la présente charte et entraînera des poursuites légales.</p>
                    
                    <h2 class="section-title">5. Engagement des modèles et hôtesses</h2>
                    <p><strong>5.1.</strong> Les modèles et hôtesses s’engagent à ne pas utiliser ou partager les images prises dans le cadre des activités professionnelles de General Consulting Group à des fins personnelles, promotionnelles ou commerciales sans autorisation préalable.</p>
                    <p><strong>5.2.</strong> Ils s’engagent également à ne pas collaborer sur des projets similaires avec des concurrents directs de General Consulting Group pendant la période d’exclusivité définie par contrat.</p>
                    
                    <h2 class="section-title">6. Durée de l’exclusivité</h2>
                    <p><strong>6.1.</strong> La période d’exclusivité des images est précisée dans le contrat ou les termes convenus entre le modèle/l’hôtesse et General Consulting Group.</p>
                    <p><strong>6.2.</strong> À l’expiration de cette période, l’entreprise se réserve le droit de prolonger l’exclusivité sous réserve d’un nouvel accord écrit.</p>
                    
                    <h2 class="section-title">7. Sanctions en cas de non-respect</h2>
                    <p><strong>7.1.</strong> Toute violation des termes de cette politique par le modèle ou l’hôtesse peut entraîner la résiliation immédiate de leur collaboration avec General Consulting Group.</p>
                    <p><strong>7.2.</strong> En cas d’utilisation abusive ou non autorisée des images, des poursuites légales peuvent être engagées pour protéger les droits de l’entreprise.</p>
                </div>
            </div>
        </div>

        <div class="content-wrapper"> 
            <div class="about-content">
                <h1 class="about-title">POLICE DE CHARTE : RÉSILIATION DE CONTRAT</h1>
                <div class="text-content">
                    <p><strong>(Models & Hostesses by General Consulting Group)</strong></p>
                    
                    <p><strong>Préambule</strong></p>
                    <p>Cette charte établit les principes, obligations et conséquences liés à la résiliation du contrat d’un modèle ou d’une hôtesse collaborant avec General Consulting Group . Toute violation des termes stipulés dans cette charte peut entraîner une résiliation immédiate sans préavis ni indemnités, avec des recours légaux possibles à l'encontre de la partie fautive.</p>
                    
                    <h2 class="section-title">1. Motifs de résiliation immédiate</h2>
                    <p>La résiliation sans préavis ni indemnités peut être appliquée dans les cas suivants :</p>
        
                    <h3 class="section-title">1.1. Non-respect de l’exclusivité :</h3>
                    <p>Acceptation ou exécution d’un contrat similaire pour un concurrent ou un tiers sans autorisation écrite de General Consulting Group.</p>
        
                    <h3 class="section-title">1.2. Comportement contraire à l’éthique ou à l’image de l’entreprise :</h3>
                    <ul class="styled-list">
                        <li>Manquement à la confidentialité.</li>
                        <li>Attitude inappropriée, abusive ou contraire aux valeurs de l’entreprise.</li>
                        <li>Engagement dans des activités nuisibles à l’image ou à la réputation de General Consulting Group.</li>
                    </ul>
        
                    <h3 class="section-title">1.3. Non-respect des engagements contractuels :</h3>
                    <ul class="styled-list">
                        <li>Absence non justifiée ou répétée lors des événements ou projets.</li>
                        <li>Retards fréquents impactant le déroulement des activités.</li>
                        <li>Refus de se conformer aux directives raisonnables établies par l’entreprise.</li>
                    </ul>
        
                    <h3 class="section-title">1.4. Fraude ou déclaration mensongère :</h3>
                    <p>Toute tentative de manipulation, fraude, ou fausse déclaration portant préjudice à General Consulting Group.</p>
        
                    <h2 class="section-title">2. Conséquences de la résiliation</h2>
                    <h3 class="section-title">2.1. Résiliation immédiate sans préavis ni indemnité</h3>
                    <p>En cas de violation des termes énoncés, General Consulting Group se réserve le droit de :</p>
                    <ul class="styled-list">
                        <li>Mettre fin immédiatement à toute collaboration.</li>
                        <li>Suspendre ou annuler tout paiement ou avantage en cours, sans recours pour l’intéressé.</li>
                    </ul>
        
                    <h3 class="section-title">2.2. Recours judiciaires possibles</h3>
                    <p>Toute action préjudiciable ou violation grave de cette charte peut entraîner :</p>
                    <ul class="styled-list">
                        <li>Des poursuites judiciaires pour indemnisation des pertes subies par l’entreprise.</li>
                        <li>Des réclamations financières ou légales conformément aux lois locales.</li>
                    </ul>
        
                    <h3 class="section-title">2.3. Exclusion de réengagement</h3>
                    <p>Le modèle ou l’hôtesse résilié(e) sera exclu(e) de toute collaboration future avec General Consulting Group et ses partenaires.</p>
        
                    <h2 class="section-title">3. Engagement légal</h2>
                    <p>En signant cette charte, le modèle ou l’hôtesse déclare avoir pris connaissance des clauses de résiliation et accepte que toute violation des termes définis ci-dessus puisse entraîner les conséquences légales mentionnées.</p>
                </div>
            </div>
        </div>

        
        <div class="content-wrapper"> 
            <div class="about-content">
                <h1 class="about-title">POLICE DE CHARTE ÉTHIQUE POUR LES MODÈLES ET HÔTESSES</h1>
                <div class="text-content">
                    <p><strong>General Consulting Group</strong></p>
                    
                    <p><strong>Préambule</strong></p>
                    <p>General Consulting Group  s’engage à promouvoir un environnement de travail basé sur le respect, l'intégrité et la professionnalité. Cette charte définit les principes éthiques et les responsabilités des modèles et hôtesses dans l’exercice de leurs fonctions, afin de garantir une collaboration harmonieuse et conforme aux valeurs de l’entreprise.</p>
                    
                    <h2 class="section-title">1. Respect et Dignité</h2>
                    <ul class="styled-list">
                        <li>Les modèles et hôtesses doivent adopter un comportement respectueux envers tous les collaborateurs, clients, et partenaires.</li>
                        <li>Toute forme de discrimination, de harcèlement ou de comportement inapproprié est strictement interdite.</li>
                    </ul>
        
                    <h2 class="section-title">2. Professionnalisme et Engagement</h2>
                    <ul class="styled-list">
                        <li>Les modèles et hôtesses doivent faire preuve de ponctualité et de rigueur dans l'exécution de leurs missions.</li>
                        <li>Une tenue vestimentaire et une présentation appropriées, conformes aux exigences de chaque événement ou prestation, sont requises.</li>
                        <li>L’hôtesse ou le modèle est tenu(e) d’informer l’entreprise de toute indisponibilité dans un délai raisonnable.</li>
                    </ul>
        
                    <h2 class="section-title">3. Confidentialité</h2>
                    <ul class="styled-list">
                        <li>Les modèles et hôtesses doivent respecter la confidentialité des informations relatives aux clients, partenaires, et projets de General Consulting Group.</li>
                        <li>Toute divulgation non autorisée d’informations sera considérée comme une faute grave.</li>
                    </ul>
        
                    <h2 class="section-title">4. Image et Représentation de l’Entreprise</h2>
                    <ul class="styled-list">
                        <li>Les modèles et hôtesses doivent agir en tant qu’ambassadeurs de General Consulting Group et représenter l’entreprise avec intégrité.</li>
                        <li>L’utilisation de l’image ou du nom de l’entreprise sans autorisation explicite est interdite.</li>
                    </ul>
        
                    <h2 class="section-title">5. Respect des Lois et Règlements</h2>
                    <ul class="styled-list">
                        <li>Les modèles et hôtesses doivent se conformer aux lois et règlements en vigueur dans le cadre de leurs missions.</li>
                        <li>Toute activité illégale ou contraire à l’éthique est interdite et entraînera des sanctions disciplinaires.</li>
                    </ul>
        
                    <h2 class="section-title">6. Engagement Environnemental et Sociétal</h2>
                    <ul class="styled-list">
                        <li>General Consulting Group  valorise les pratiques respectueuses de l’environnement. Les modèles et hôtesses sont encouragés à adopter des comportements écoresponsables.</li>
                        <li>Les modèles et hôtesses doivent contribuer à promouvoir une image positive de l’entreprise en soutenant les initiatives sociétales et éthiques.</li>
                    </ul>
        
                    <h2 class="section-title">7. Sanctions</h2>
                    <ul class="styled-list">
                        <li>Toute violation des principes énoncés dans cette charte peut entraîner des mesures disciplinaires, pouvant aller jusqu’à la résiliation de la collaboration.</li>
                        <li>En cas de conflit ou d’infraction, un comité interne de General Consulting Group examinera les faits pour prendre une décision équitable.</li>
                    </ul>
        
                    <h2 class="section-title">8. Engagement</h2>
                    <p>Cette charte doit être lue et approuvée par chaque modèle et hôtesse avant le début de toute collaboration.</p>
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