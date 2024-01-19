function selectTab(tabName) {
    // Retirer la classe 'active' de tous les onglets
    // document.querySelectorAll('.tab').forEach(tab => {
    //     tab.classList.remove('active');
    //     tab.classList.add('inactive');
    // });

    // Ajouter la classe 'active' à l'onglet cliqué
    if (tabName === 'profil') {
        document.querySelector('.tab:nth-child(1)').classList.add('active');
        document.querySelector('.tab:nth-child(2)').classList.remove('active');
    } else if (tabName === 'notifications') {
        document.querySelector('.tab:nth-child(2)').classList.add('active');
        document.querySelector('.tab:nth-child(1)').classList.remove('active');
    }
}

// Initialise le premier onglet comme actif au chargement de la page
window.onload = () => {
    selectTab('profil');
};

