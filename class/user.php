<?php

    class user extends bdd
    {

        private $id = NULL;
        private $civilite = NULL;
        private $nom = NULL;
        private $prenom = NULL;
        private $mdp = NULL;
        private $mail = NULL;
       

        

        public function inscription($civilite, $prenom, $nom, $mail, $tel, $mdp, $confirmMdp, $bdd)
        {
            
           
            if (strlen($civilite) != 0 && strlen($nom) != 0 && strlen($prenom) != 0 && strlen($mdp) != 0 && strlen($confirmMdp) != 0 && strlen($mail) != 0 && strlen($tel) != 0) 
            {
                if ($mdp == $confirmMdp) 
                {
                    $mailUser = $bdd->execute("SELECT mail FROM utilisateurs WHERE mail = '$mail' ");
                    if (empty($mailUser)) 
                    {
                        $password = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 12));
                        $newUser = $bdd->executeonly("INSERT INTO utilisateurs (civilite, nom, prenom, mdp, mail, tel, id_droits) VALUES ('$civilite', '$nom', '$prenom', '$password', '$mail', '$tel','1')");
                       header('Location:connexion.php');
                        return;
                    }
                    else
                    {
                        echo "<div class='message'>Cette adresse mail est déja utilisée.<br></div>";
                        return ;
                    }
                }
                else
                {
                   echo "<div class='message'>Les mots de passe ne correspondent pas.<br></div>";
                   return ;
                }
            }
            else
            {
               echo "<div class='message'>Veuillez remplir tous les champs.<br></div>";
                return ;
            }
        }

        public function connexion($mail,$password, $bdd)
        {
           
            $log = $bdd->execute("SELECT * FROM utilisateurs WHERE mail = '$mail'");
            
            

            if(!empty($log))
            {
                if($mail == $log[0][5])
                {
                    if(password_verify($password,$log[0][4]))
                    {
                        $_SESSION['id'] = $log[0][0];
                        

                        header('Location:index.php');
                    }
                    else
                    {
                        echo "<div class='message'>Mot de passe ou adresse mail incorrect</div>";
                        return;
                    }
                }
                else
                {
                    echo "<div class='message'>Mot de passe ou adresse mail incorrect</div>";
                    return;
                }
            }
            else
            {
                echo "<div class='message'>Cette adresse mail n'existe pas</div>";
                return;
            }
        }

        public function updateInfo($civilite, $prenom, $nom, $mail, $tel, $bdd)
        {
            $id = $_SESSION["id"];

           
            if (isset($civilite)) 
            {
                $updateCivilite = $bdd->executeonly("UPDATE utilisateurs SET civilite = '$civilite' WHERE id = '$id'");
                header('Location:profil.php');
            }
            if (!empty($prenom)) 
            {
                $updatePrenom = $bdd->executeonly("UPDATE utilisateurs SET prenom = '$prenom' WHERE id = '$id'");
                header('Location:profil.php');
            }
            if (!empty($nom)) 
            {
                $updateNom = $bdd->executeonly("UPDATE utilisateurs SET nom = '$nom' WHERE id = '$id'");
                header('Location:profil.php');
            }
            if (!empty($mail)) 
            {
                $getMail = $bdd->execute("SELECT mail FROM utilisateurs WHERE mail = '$mail'");
                     
                if (!empty($getMail)) 
                {
                    echo "Cette adresse mail existe déja";
                }
                else
                {    
                    $updateMail = $bdd->executeonly("UPDATE utilisateurs SET mail = '$mail' WHERE id = '$id'");
                    header('Location:profil.php');
                }
            }
            if (!empty($tel)) 
            {
                $updateTel = $bdd->executeonly("UPDATE utilisateurs SET tel = '$tel' WHERE id = '$id'");
                header('Location:profil.php');
            }

        }

        public function updatePassword($oldPassword, $newPassword, $confirmNewPassword, $bdd)
        {
            $id = $_SESSION["id"];
            $getOldPassword = $bdd->execute("SELECT mdp FROM utilisateurs WHERE id = '$id'");
            if (password_verify($oldPassword,$getOldPassword[0][0]))
            {
                if ($newPassword == $confirmNewPassword) 
                {
                    $password = password_hash($newPassword, PASSWORD_BCRYPT, array('cost' => 12));
                    $updatePassword = $bdd->executeonly("UPDATE utilisateurs SET mdp = '$password' WHERE id = '$id'");
                    header('Location:profil.php');
                }
            }
        }

        public function preferenceUser($id, $boeuf, $poulet, $dinde, $saumon, $thon, $calamar, $haricots, $pommeDeTerre, $brocolis, $avocat, $choux, $salade, $poivrons, $champignons, $lentilles, $bdd)
        {
            $bdd->executeonly("INSERT INTO preference_user(id_utilisateur, boeuf, poulet, dinde, saumon, thon, calamar, haricots, pommeDeTerre, brocolis, avocat, choux, salade, poivrons, champignon, lentilles) VALUES ('$id', '$boeuf', '$poulet', '$dinde', '$saumon', '$thon', '$calamar', '$haricots', '$pommeDeTerre', '$brocolis', '$avocat', '$choux', '$salade', '$poivrons', '$champignons', '$lentilles')");
            echo "Normalement ca marche";
        }
        

        

        public function disconnect()
        {
            session_unset();
            session_destroy();
            header('location:index.php');
        }

    }
?>

