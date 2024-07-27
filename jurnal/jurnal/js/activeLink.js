// activeLink.js
document.addEventListener('DOMContentLoaded', () => {
    const links = {
        home: '/pages/home.php',
        'total-hadir': '/pages/total_hadir.php',
        kegiatan: '/pages/kegiatan.php',
        catatan: '/pages/catatan.php',
        create: '/pages/create.php'
    };

    const currentPath = window.location.pathname;

    for (const [id, path] of Object.entries(links)) {
        if (currentPath.includes(path)) {
            document.getElementById(id).classList.add('active');
        }
    }
});
