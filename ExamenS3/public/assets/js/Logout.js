document.getElementById('logoutBtn')?.addEventListener('click', async function(e) {
    e.preventDefault(); // Empêche le comportement par défaut si c'est un lien <a>
    console.log("📌 Logout click détecté, nettoyage local et envoi AJAX");

    // 1. SUPPRIMER LE TOKEN INVITE (Crucial pour ne pas être reconnecté direct)
    localStorage.removeItem('metis_guest_token');

    try {
        // Attention : Ta route Flight est en GET ou POST ? 
        // Si c'est Flight::route('GET /logout', ...), utilise method: 'GET'
        const response = await fetch('/logout', { method: 'GET' }); 
        
        console.log("📡 Réponse logout :", response.status);

        // Si ton contrôleur PHP fait un Flight::redirect('/login'), 
        // la réponse fetch suivra la redirection et renverra le HTML de la page login.
        if (response.ok) {
            console.log("✅ Déconnexion réussie");
            window.location.href = '/login';
        } else {
            console.error("❌ Erreur logout serveur");
            alert("Erreur lors de la déconnexion");
        }

    } catch (error) {
        console.error("🔥 Erreur critique logout :", error);
        alert("Erreur serveur ou réseau !");
    }
});