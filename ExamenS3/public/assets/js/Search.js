const searchInput = document.getElementById('searchUsers');

if (searchInput) {
    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const items = document.querySelectorAll('.conversation-item');

        items.forEach(item => {
            // On cherche le nom à l'intérieur de la classe .conversation-name
            const name = item.querySelector('.conversation-name').innerText.toLowerCase();
            
            if (name.includes(query)) {
                item.style.display = 'flex'; // On montre
            } else {
                item.style.display = 'none'; // On cache
            }
        });
        
        // Optionnel : Gérer l'état vide si rien n'est trouvé
        const list = document.getElementById('conversations-list');
        const visibleItems = document.querySelectorAll('.conversation-item[style="display: flex;"]');
        const emptyState = document.getElementById('empty-state');
        
        if (emptyState) {
            emptyState.style.display = (items.length > 0 && visibleItems.length === 0) ? 'block' : 'none';
        }
    });
}