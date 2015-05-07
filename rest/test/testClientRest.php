<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>test Rest</title>
    </head>
    <body>
        <form method="POST" action="../index.php?ressource=Categorie&action=insert" >
            Code : <input type="text" name="code" id="code" /><br/>
            Nom : <input type="text" name="libelle" id="libelle" /><br/>
            <input type='submit' value='Envoyer la requête'  />
        </form>
    </body>
</html>
