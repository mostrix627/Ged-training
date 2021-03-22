
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="../ui/css/style.css"/>
    <title>Accueil</title>
</head>
<body>
<div class="container">
    <header class="header">
        <div class="nav">
            <div class="logo"></div>
            <div class="connexion btn">Connexion</div>
        </div>
        <div class="menu">
            <ul>
                <li class="btn btn-menu">Accueil</li>
                <li class="btn btn-menu">GED</li>
            </ul>
        </div>
    </header>
    <main class="main">
        <div class="connexion">
            <form action="index.php?controller=publicController&task=authentification" method="post" class="authent" id="authent">
                <h1>Connexion</h1>
                <div class="form-items">
                    <div class="form-item"><label for="email">Mail</label><input type="text" name="email" id="email"></div>
                    <div class="form-item"><label for="password">Mot de passe</label><input type="password" name="password" id="password"></div>
                    <div class="form-item"><?php
                    if(isset($param['message_erreur_form'])){
                        echo "<div class='error'>".$param['message_erreur_form'].'</div>';
                    }
                    ?> <div class="form-item">
                            <input type="submit" value="connexion" name="connexion" class="btn">
                </div>


            </form>
        </div>

        <div class="text-main">
            <h1>Gestionnaire de fichier</h1>
            <div class="text-main-content">
                nondum ripis induit ipsa caesa abscidit praebebat motura inclusum premuntur
                nondum ripis induit ipsa caesa abscidit praebebat motura inclusum premuntur
                nondum ripis induit ipsa caesa abscidit praebebat motura inclusum premuntur
            </div>
        </div>
    </main>



</div>

</body>
</html>




