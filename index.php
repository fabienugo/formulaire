<?php

    //Déclaration des différentes variables
    $firstname = $name = $email = $phone = $message = "";
    $firstnameError = $nameError = $emailError = $phoneError = $messageError = "";
    $isSuccess = false;
    $emailTo ="fabien.ugo@hotmail.fr";

    // Ce "if" ne marche que lorsqu'on a envoyer notre requête POST
    // i.e quand on a envoyer le formulaire
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $firstname = verifyInput($_POST["firstname"]);
        $name = verifyInput($_POST["name"]);
        $email = verifyInput($_POST["email"]);
        $phone = verifyInput($_POST["phone"]);
        $message = verifyInput($_POST["message"]);
        $isSuccess = true;
        $emailText = "";
        
        if(empty($firstname)){
            $firstnameError = "Je veux connaitre ton prénom !";
            $isSuccess = false;
        }else{
            $emailText .= "Prénom : $firstname \n";
        }
        
        if(empty($name)){
            $nameError = "Je veux connaitre ton nom !";
            $isSuccess = false;

        }else {
            $emailText .= "Nom : $name \n";
        }
        
        if(empty($message)){
            $messageError = "Je veux connaitre ton message !";
            $isSuccess = false;

        }else {
            $emailText .= "Message : $message \n";
        }
        
        if(!isEmail($email)){
            $emailError = "Ce n'est pas un email valide !";
            $isSuccess = false;

        }else {
            $emailText .= "Email : $email \n";
        }
        
        if(!isPhone($phone)){
            $phoneError = "Ce n'est pas un numéro de téléphone valide !";
            $isSuccess = false;
        } else{
            $emailText .= "Telephone : $phone \n";
        }
        if($isSuccess){
            $headers ="from: $firstname $name <$email> \r\nReply-To: $email";
            mail($emailTo, "Un message de votre site", $emailText, $headers);
            $firstname = $name = $email = $phone = $message = ""; //Permet de vider les inputs
            
        }
    }
                    //-----------------------------//

    //Fonction qui permet de vérifier le num de tel, l'email et de sécuriser les inputs
    function isPhone($var){
        return preg_match("/^[0-9 ]*$/", $var);
    }

    function isEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var) {
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);       
        
        return $var;
    }
                    //-------------------------------//
?>


<!DOCTYPE html>

<html>
    <head>
        <title>Contactez-moi !</title>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <script src="js/script.js"></script>
    </head>

    
    <body>
        <div class="container">
            <div class="divider"></div>
            <div class="heading">
                <h2>Contactez-moi</h2>
            </div>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <form id="contact-form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstname">Prénom<span class="blue"> *</span></label>
                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Votre prénom" value="<?php echo $firstname ?>">
                                <p class="comments">Messages d'erreur</p>
                            </div>                                                    
                            <div class="col-md-6">
                                <label for="name">Nom<span class="blue"> *</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" value="<?php echo $name ?>">
                                <p class="comments">Messages d'erreur</p>
                            </div>                           
                            <div class="col-md-6">
                                <label for="email">Email<span class="blue"> *</span></label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Votre email" value="<?php echo $email ?>">
                                <p class="comments">Messages d'erreur</p>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Téléphone</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Votre téléphone" value="<?php echo $phone ?>">
                                <p class="comments">Messages d'erreur</p>
                            </div>
                            <div class="col-md-12">
                                <label for="message">Message<span class="blue"> *</span></label>
                                <textarea class="form-control" id="message" name="message" placeholder="Votre message" rows="4" value="<?php echo $message ?>"></textarea>
                                <p class="comments">Messages d'erreur</p>
                            </div>
                            <div class="col-md-12">
                                <p class="blue"><strong>Ces informations sont requises</strong></p>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="bouton1" value="envoyer"> 
                            </div>
                        </div>
                        
                        <p class="thank-you">Votre message à bien été envoyé. Merci de m'avoir contacté !</p>
                    </form>
                    
                </div>
            </div>
        </div>
    </body>
</html>