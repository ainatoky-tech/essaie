//FONCTION AFFICHAGE DE TOUT LES UTILISATEURS 
async function afficherUtilisateurs() {
    const listContainer = document.getElementById('conversations-list');
    const emptyState = document.getElementById('empty-state');

    try {
        // 1. On récupère les données de ton API Flight
        const response = await fetch('/api/utilisateurs');
        const utilisateurs = await response.json();

        // 2. Si pas d'utilisateurs, on montre l'état vide
        if (utilisateurs.length === 0) {
            emptyState.style.display = 'block';
            return;
        } 

        emptyState.style.display = 'none';
        
        // 3. On construit le HTML pour chaque utilisateur
        // Note : On utilise l'ID caché 'idOther' quand on clique
        listContainer.innerHTML = utilisateurs.map(user => `
            <a href="#" class="conversation-item" id="user-item-${user.id}" 
            onclick="selectionnerContact(${user.id}, '${user.nom_utilisateur}', '${user.avatar}')">
                <div class="conversation-avatar">
                    <img src="${user.avatar}" alt="${user.nom_utilisateur}">
                    <div class="online-indicator"></div>
                </div>
                <div class="conversation-info">
                    <div class="conversation-header">
                        <h6 class="conversation-name">${user.nom_utilisateur}</h6>
                        <span class="conversation-time"></span>
                    </div>
                    <p class="conversation-preview">Cliquez pour envoyer un message</p>
                    <div class="conversation-footer">
                        <span class="unread-badge" id="badge-notif-${user.id}" 
                            style="${user.nb_non_lus > 0 ? 'display:block' : 'display:none'}">
                            ${user.nb_non_lus}
                        </span>
                    </div>
                </div>
            </a>
        `).join('');

    } catch (error) {
        console.error("Erreur lors de la récupération des utilisateurs:", error);
    }
}


// Appelée via l'attribut onclick dans ta liste d'utilisateurs
function selectionnerContact(id, nom, avatar) {
    // On enregistre le contact actif dans le navigateur
    localStorage.setItem('activeContactId', id);
    // Mise à jour des données cachées
    document.getElementById('idOther').value = id;
    
    // Mise à jour de l'interface visuelle
    document.getElementById('activeChatName').innerText = nom;
    document.getElementById('activeChatAvatar').src = avatar;
    
    // Bascule des écrans
    document.getElementById('activeChat').style.display = 'block';
    document.getElementById('emptyChat').style.display = 'none';

    // Gestion du style "active" dans la liste
    document.querySelectorAll('.conversation-item').forEach(item => item.classList.remove('active'));
    const selectedItem = document.getElementById(`user-item-${id}`);
    if (selectedItem) selectedItem.classList.add('active');

    // Chargement immédiat des messages
    chargerMessages();
}
// On lance la fonction au chargement de la page
document.addEventListener('DOMContentLoaded', afficherUtilisateurs);












async function chargerMessages() {
    const idOther = document.getElementById('idOther').value; // L'ID du contact cliqué
    const idUser = document.getElementById('idUser').value;   // Ton ID (Session)
    const messagesBody = document.getElementById('messagesBody');

    if (!idOther) return; 

    try {
        const response = await fetch(`/api/messages/${idOther}`);
        const messages = await response.json();

        if (messages.length > 0) {
            fetch(`/api/messages/lire/${idOther}`, { method: 'POST' });
            
            // On cache aussi le badge dans la liste de gauche pour cet utilisateur
            const badge = document.getElementById(`badge-notif-${idOther}`);
            if (badge) badge.style.display = 'none';
        }

        // On vide d'abord pour éviter les résidus d'autres conversations
        messagesBody.innerHTML = '';

        const htmlMessages = messages.map(msg => {
            // Sécurité : On vérifie que le message appartient bien au duo idUser/idOther
            const isRelevant = (msg.id_expediteur == idUser && msg.id_destinataire == idOther) || 
                               (msg.id_expediteur == idOther && msg.id_destinataire == idUser);

            if (!isRelevant) return ''; // On ignore les messages qui n'appartiennent pas à ce duo

            const isMe = msg.id_expediteur == idUser;
            return `
                <div class="message ${isMe ? 'own-message' : ''}">
                    <div class="message-bubble">
                        <div class="message-content"><p>${msg.contenu}</p></div>
                        <div class="message-info">
                            <span class="message-time">${new Date(msg.date_envoi).toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'})}</span>
                        </div>
                    </div>
                </div>`;
        }).join('');

        messagesBody.innerHTML = htmlMessages;

        // Scroll auto
        const container = document.getElementById('chatMessages');
        container.scrollTop = container.scrollHeight;

    } catch (error) {
        console.error("Erreur de filtrage :", error);
    }
}





async function envoyerMessage() {
    const input = document.getElementById('message');
    const idOther = document.getElementById('idOther').value;
    const contenu = input.value.trim();

    if (!contenu || !idOther) return;

    try {
        const response = await fetch('/api/messages/envoyer', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                id_destinataire: idOther,
                contenu: contenu
            })
        });

        const result = await response.json();
        
        if (result.success) {
            input.value = ''; // On vide le champ
            input.style.height = 'auto'; // On reset la hauteur du textarea
            
            // On force un rechargement immédiat pour le confort visuel
            await chargerMessages();
            
            // On force le scroll en bas après son propre message
            const container = document.getElementById('chatMessages');
            container.scrollTop = container.scrollHeight;
        }
    } catch (error) {
        console.error("Erreur lors de l'envoi :", error);
    }
}





async function actualiserBadges() {
    try {
        const response = await fetch('/api/utilisateurs');
        const utilisateurs = await response.json();

        utilisateurs.forEach(user => {
            const badge = document.getElementById(`badge-notif-${user.id}`);
            if (badge) {
                if (user.nb_non_lus > 0) {
                    badge.innerText = user.nb_non_lus;
                    badge.style.display = 'block';
                } else {
                    badge.style.display = 'none';
                }
            }
        });
        let totalNonLus = utilisateurs.reduce((sum, user) => sum + parseInt(user.nb_non_lus), 0);
        if (totalNonLus > 0) {
            document.title = `(${totalNonLus}) Metis - Nouveau message`;
        } else {
            document.title = `Metis`;
        }
        
    } catch (e) { console.error("Erreur badges:", e); }
}




document.addEventListener('DOMContentLoaded', () => {
    const btnEnvoyer = document.getElementById('btnEnvoyer');
    const messageInput = document.getElementById('message');

    // Clic sur le bouton envoyer
    if (btnEnvoyer) {
        btnEnvoyer.addEventListener('click', envoyerMessage);
    }

    // Touche Entrée pour envoyer (sans shift)
    if (messageInput) {
        messageInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                envoyerMessage();
            }
        });

        // Auto-redimensionnement du textarea
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    }

    // Rafraîchissement automatique toutes les 3 secondes (Polling)
    setInterval(() => {
        const idOther = document.getElementById('idOther').value;
        if (idOther) {
            chargerMessages();
        }
        actualiserBadges();
    }, 3000);



    // Si on a un contact enregistré, on essaie de le re-sélectionner
    const lastId = localStorage.getItem('activeContactId');
    if (lastId) {
        // On attend un peu que la liste des utilisateurs soit chargée
        setTimeout(() => {
            const item = document.getElementById(`user-item-${lastId}`);
            if (item) item.click(); 
        }, 500);
    }
});

