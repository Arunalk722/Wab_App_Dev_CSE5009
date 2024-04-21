function getCookie(name) {
    const cookies = document.cookie.split(';');
    for (let cookie of cookies) {
        const [cookieName, cookieValue] = cookie.trim().split('=');
        if (cookieName === name) {
            return cookieValue;
        }
    }
    return null;
}

const username = getCookie('username');

if (username) {
    document.getElementById('cookieValue').textContent = `Username: ${username}`;
} else {
    document.getElementById('cookieValue').textContent = 'No username cookie found.';
}