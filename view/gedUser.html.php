<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ui/css/style-ged.css">
    <title>GED</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo"></div>
            <div class="menu">
                <ul>
                    <li class="btn">ACCUEIL</li>
                    <li class="btn">GED</li>
                    <li class="btn">PROFIL</li>
                </ul>
            </div>
            <div class="btn-deconnexion">
                <div class="logo"></div><span>Utilisateur(<a href="index.php?controller=publicController&task=deconnexion">Déconnexion</a>)</span>
            </div>
        </nav>
    </header>
   <main>
        <div class="container">
            <div class="form-recherche">
                <form action="#" method="post">
                    <input type="text" name="recherche" id="" placeholder="Nom fichier">
                    <button class="btn btn-recherche">Recherche</button>
                </form>
            </div>
            
            <div class="tab-content">
                <h2>Liste des fichiers</h2>
                <table class="tab-table">
                    <thead>
                        <th><input type="checkbox" name="" id=""></th>
                        <th>ID</th>
                        <th>Nom fichier</th>
                        <th>Importeur</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="" id=""></td><td>1</td><td>fichier A</td><td>Jean</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="" id=""></td><td>2</td><td>fichier B</td><td>Paul</td>
                        </tr>
                    </tbody>
                </table>
                <div class="btn-place">
                    <button class="btn btn-place-tel">Télécharger</button>
                    <button class="btn btn-place-impr">Imprimer</button>
                </div>


            </div>
                <div class="tab-content">
                    <h2>Mes fichiers non validé</h2>
                    <table class="tab-table">
                        <thead>
                            <th><input type="checkbox" name="" id=""></th>
                            <th>ID</th>
                            <th>Nom fichier</th>
                            <th>Importeur</th>
                            <th>status</th>
                        </thead>
                        <tbody>

                        <?php
                        for($i=0;$i<count($param);$i++){
                        ?>
                            <tr>
                                <td><input type="checkbox" name="" id=""></td><td><?=$param[$i]['id_fichier'] ?></td><td><?=$param[$i]['nom_fichier'] ?></td><td><?=$param[$i]['id_user'] ?></td><td><?=$param[$i]['status'] ?> </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="btn-place">
                        <form action="index.php?controller=fileController&task=insert" method="post" enctype="multipart/form-data">
                            <input name="doc[]" type="file" multiple/>
                            <button class="btn" type="submit">Ajouter fichier</button>
                        </form>

                    </div>
            </div>

      
   </main>
</body>
</html>