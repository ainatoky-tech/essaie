// Fonction pour l'auto-connexion / auto-enregistrement
async function initAutoAuth() {
    // 1. NE PAS rediriger si on est déjà sur login ou register
    const isAuthPage = window.location.pathname === '/login' || window.location.pathname === '/register';

    const savedToken = localStorage.getItem('metis_guest_token');

    try {
        const reponse = await fetch('/api/auto-auth', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ token: savedToken })
        });

        const resultat = await reponse.json();

        if (resultat.success) {
            // On sauvegarde le token (qu'il soit nouveau ou ancien)
            localStorage.setItem('metis_guest_token', resultat.token);
            
            // Mise à jour de l'affichage
            const userDisplay = document.getElementById('user-name-display');
            if(userDisplay) {
                userDisplay.innerText = resultat.username;
            }

            // 2. Redirection UNIQUEMENT si on n'est PAS sur une page d'auth
            // Si on est sur /metis, on reste sur /metis avec le nom mis à jour
            console.log("Session active :", resultat.username);
        }
    } catch (erreur) {
        console.error("Erreur auto-auth:", erreur);
        // Si ça échoue, on remet au moins un texte par défaut
        const userDisplay = document.getElementById('user-name-display');
        if(userDisplay) userDisplay.innerText = "Invité";
    }
}

// Lancement au chargement du DOM
document.addEventListener('DOMContentLoaded', () => {
    initAutoAuth();
});





async function registerForm(){
    console.log("1. Fonction registerForm() appelée");

    let username = document.getElementById('username').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let rememberElementary =document.getElementById('remember');
    let remember = rememberElementary ? rememberElementary.checked : false; // la checkbox
    
    console.log("2. Données récupérées :", { username, email, password, remember });
    
    const formdata ={ 
        username,
        email,
        password,
        remember
    };
    try{
        console.log("3. envoi de la requete AJAX  au serveur ");
        const reponse = await fetch('/register',{
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(formdata)
        });

        console.log("4. Réponse brute reçue du serveur :", reponse.status);

        // Conversion en JSON (ce que ton Flight::json() envoie)
        const resultat = await reponse.json();
        console.log("5.Résultat JSON :", resultat);
 

        if (resultat.success) {
            console.log("6. Succès ! Le PHP a dit :", resultat);
            alert("Compte créé et Cookie déposé !");
            // Ici tu peux rediriger ou mettre à jour l'interface
            document.getElementById('registerForm').reset();
            // Redirection côté client
            window.location.href = resultat.redirect;
        } 
        else {
            console.error("7. Erreur renvoyée par le PHP :", resultat.message);
            alert(resultat.message);
        }

    } catch (erreur) {
        console.error("🔥 Erreur critique (Serveur éteint ou URL fausse) :", erreur);
    }

}



async function loginForm(){
    console.log("1. appel de la fonction asynchrone loginform");
    let email = document.getElementById('email_login').value;
    let password = document.getElementById('password_login').value;
    let rememberCheck = document.getElementById('remember');
    let remember = rememberCheck ? rememberCheck.checked :false;

    console.log("2. donné récupérer  : ",{email,password,remember});

    const formData = {email,password,remember};
    try{
        console.log("3. lancement AJAX ");
        const reponse = await fetch("/login",{
            method:'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(formData)
        });

        console.log("4. Réponse brute reçue du serveur :", reponse.status);
         // Conversion en JSON (ce que ton Flight::json() envoie)
        const resultat = await reponse.json();
        console.log("5.Résultat JSON :", resultat);

        if (resultat.success) {
            console.log("6. Succès ! Le PHP a dit :", resultat);
            alert("Connexion réussie !");
            // Ici tu peux rediriger ou mettre à jour l'interface
            document.getElementById('loginForm').reset();
            // Redirection côté client
            localStorage.removeItem('metis_guest_token');
            window.location.href = resultat.redirect;

        } 
        else {
            console.error("7. Erreur renvoyée par le PHP :", resultat.message);
            alert(resultat.message);
        }

    }catch(erreur) {
        console.error("🔥 Erreur critique (Serveur éteint ou URL fausse) :", erreur);
    }

}


document.getElementById('registerForm')?.addEventListener('submit', function (e) {
    e.preventDefault();
    console.log("📌 Submit register intercepté");
    registerForm();
});

document.getElementById('loginForm')?.addEventListener('submit', function (e) {
    e.preventDefault();
    console.log("📌 Submit login intercepté");
    loginForm();
});