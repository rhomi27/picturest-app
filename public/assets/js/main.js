
// tabs
function showTab(tabName) {
    if (tabName === 'login') {
        document.getElementById('loginTabContent').style.display = 'block';
        document.getElementById('signupTabContent').style.display = 'none';
    } else if (tabName === 'signup') {
        document.getElementById('loginTabContent').style.display = 'none';
        document.getElementById('signupTabContent').style.display = 'block';
    }
}

// search realtime

