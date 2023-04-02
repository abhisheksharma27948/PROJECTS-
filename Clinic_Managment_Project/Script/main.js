/* const showHiddenPass = (login-rep_pass,loginPass, loginEye) => {
    const input = document.getElementById(loginPass),
        // input1 = document.getElementById(login-rep_pass),
        iconEye = document.getElementById(loginEye)
    iconEye.addEventListener('click', () => {
        // Change password to text
        if (input.type === 'password') { // Switch to text input.type='text'
            input.type = 'text'
            iconEye.classList.add('ri-eye-line')
            iconEye.classList.remove('ri-eye-off-line')

        } else {
            // Change to password
            input.type = 'password'
            // Icon change
            iconEye.classList.remove('ri-eye-line')
            iconEye.classList.add('ri-eye-off-line')
        }
    })
}
showHiddenPass('login-rep_pass','login-pass', 'login-eye')
*/

/*
const showHiddenPass = (loginRepPass, loginPass, loginEye) => {
    const input = document.getElementById(loginPass),
        repPass = document.getElementById(loginRepPass),
        iconEye = document.getElementById(loginEye)
    iconEye.addEventListener('click', () => {
        // Change password to text
        if (input.type === 'password') { // Switch to text input.type='text'
            input.type = 'text'
            repPass.type = 'text'
            iconEye.classList.add('ri-eye-line')
            iconEye.classList.remove('ri-eye-off-line')

        } else {
            // Change to password
            input.type = 'password'
            repPass.type = 'password'
            // Icon change
            iconEye.classList.remove('ri-eye-line')
            iconEye.classList.add('ri-eye-off-line')
        }
    })

    // Check if password and repeat password fields match
    const form = document.querySelector('.login__form');
    form.addEventListener('signupbtn', (event) => {
        if (input.value !== repPass.value) {
            alert('Password fields do not match!');
            event.preventDefault(); // Prevent the form from submitting
        }
    });
}
showHiddenPass('login-rep_pass', 'login-pass', 'login-eye');
*/


const showHiddenPass = (loginRepPass, loginPass, loginRepEye, loginEye) => {
    const input = document.getElementById(loginPass),
        repPass = document.getElementById(loginRepPass),
        iconEye = document.getElementById(loginEye),
        repIconEye = document.getElementById(loginRepEye)
    iconEye.addEventListener('click', () => {
        // Change password to text
        if (input.type === 'password') { // Switch to text input.type='text'
            input.type = 'text'
            iconEye.classList.add('ri-eye-line')
            iconEye.classList.remove('ri-eye-off-line')

        } else {
            // Change to password
            input.type = 'password'
            // Icon change
            iconEye.classList.remove('ri-eye-line')
            iconEye.classList.add('ri-eye-off-line')
        }
    })

    repIconEye.addEventListener('click', () => {
        // Change repeat password to text
        if (repPass.type === 'password') { // Switch to text input.type='text'
            repPass.type = 'text'
            repIconEye.classList.add('ri-eye-line')
            repIconEye.classList.remove('ri-eye-off-line')

        } else {
            // Change to password
            repPass.type = 'password'
            // Icon change
            repIconEye.classList.remove('ri-eye-line')
            repIconEye.classList.add('ri-eye-off-line')
        }
    })

    // Check if password and repeat password fields match
    const form = document.querySelector('.login__form');
    form.addEventListener('submit', (event) => {
        if (input.value !== repPass.value) {
            alert('Password fields do not match!');
            event.preventDefault(); // Prevent the form from submitting
        }
    });
}
showHiddenPass('login-rep_pass', 'login-pass', 'login-rep_eye', 'login-eye');
