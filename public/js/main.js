// Run Error Message
$('#errorLogin').modal();

// Load Login Elements
// Delay 0.1s
setTimeout(() => {
    
    // Login left
    anime({
        targets: '.logo__login',
        translateX: 150
    });

    // Login right
    anime({
        targets: '.login__right',
        opacity: 1,
        easing: 'easeInOutQuad'
    });

    // Login right background
    anime({
        targets: '.login__background--right',
        left: '36%',
        width: '64%'
    });

    // Page is Login
    if (window.location.href.indexOf('login') != -1) {

        // Sticky footer
        anime({
            targets: '.footer',
            opacity: 1
        });

    }

}, 100);

// Page is not Home
if (window.location.href.indexOf('home') != -1) {

    document.getElementById('loading').style.display = 'block';
}

// Load Page
window.addEventListener('DOMContentLoaded', () => {

    // Set for Home Page
    if (window.location.href.indexOf('home') != -1) {

        // Delay 5.4s
        setTimeout(() => {

            // Remove loading div
            document.getElementById('loading').style.opacity = 0;
            document.getElementById('loading').style.transition = '0.7s opacity';

            // Delay 0.7s
            setTimeout(() => {
                document.getElementById('loading').style.display = 'none';

            }, 700);
        }, 5400);
    }

});