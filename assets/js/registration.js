document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('registration-form');
  const fullNameInput = document.getElementById('full-name');
  const emailInput = document.getElementById('email');
  const phoneInput = document.getElementById('phone');
  const addressInput = document.getElementById('address');
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirm-password');
  const locationInput = document.getElementById('locations');
  const errorModal = document.getElementById('error-modal');
  const errorModalContent = document.getElementById('error-modal-content');
  const closeButton = document.getElementById('close-button');
  const mgIcon = document.getElementById('notification-icon');

  form.addEventListener('submit', function(event) {
    event.preventDefault();
    if (validateForm()) {  
      registerUser(); 
    }
  });

  closeButton.addEventListener('click', function() {
    errorModal.style.display = 'none';
  });

  function validateForm() {
    let isValid = true;
    if (!validateFullName()) isValid = false;
    if (!validateEmail()) isValid = false;
    if (!validatePhone()) isValid = false;
    if (!validateAddress()) isValid = false;
    if (!validatePassword()) isValid = false;
    if (!validateConfirmPassword()) isValid = false;
    if(!validateLocation()) isValid=false;
    return isValid;
  }
function validateLocation(){
  const location = locationInput.value.trim();
  const locationError = document.getElementById('error-location');
  if(location==""){
    return false;
  }
 
  locationError.textContent= '';
  return true;

}
  function validateFullName() {
    const fullName = fullNameInput.value.trim();
    const fullNameError = document.getElementById('error-full-name');

    if (fullName === '') {
      fullNameError.textContent = 'Please enter your full name';
      return false;
    }

    fullNameError.textContent = '';
    return true;
  }

  function validateEmail() {
    const email = emailInput.value.trim();
    const emailError = document.getElementById('error-email');

    if (email === '') {
      emailError.textContent = 'Please enter your email';
      return false;
    }
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailPattern.test(email)) {
      emailError.textContent = 'Please enter a valid email address';
      return false;
    }

    emailError.textContent = '';
    return true;
  }

  function validatePhone() {
    const phone = phoneInput.value.trim();
    const phoneError = document.getElementById('error-phone');

    if (phone === '') {
      phoneError.textContent = 'Please enter your phone number';
      return false;
    }
    const phonePattern = /^\d{10}$/;

    if (!phonePattern.test(phone)) {
      phoneError.textContent = 'Please enter a valid 10-digit phone number';
      return false;
    }

    phoneError.textContent = '';
    return true;
  }

  function validateAddress() {
    const address = addressInput.value.trim();
    const addressError = document.getElementById('error-address');

    if (address === '') {
      addressError.textContent = 'Please enter your address';
      return false;
    }

    addressError.textContent = '';
    return true;
  }

  function validatePassword() {
    const password = passwordInput.value.trim();
    const passwordError = document.getElementById('error-password');

    if (password === '') {
      passwordError.textContent = 'Please enter your password';
      return false;
    }

    if (password.length < 6) {
      passwordError.textContent = 'Password must be at least 6 characters long';
      return false;
    }

    passwordError.textContent = '';
    return true;
  }

  function validateConfirmPassword() {
    const confirmPassword = confirmPasswordInput.value.trim();
    const confirmPasswordError = document.getElementById('error-confirm-password');
    const password = passwordInput.value.trim();

    if (confirmPassword === '') {
      confirmPasswordError.textContent = 'Please confirm your password';
      return false;
    }

    if (password !== confirmPassword) {
      confirmPasswordError.textContent = 'Passwords do not match';
      return false;
    }

    confirmPasswordError.textContent = '';
    return true;
  }

  function registerUser() {
    const formData = new FormData(form);
    fetch('scripts/registration.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (response.ok) {    
        return response.text();
      } else {   
        throw new Error('Registration failed');
      }
    })
    .then(data => {
      if (data === 'success') {
        errorModalContent.textContent = "Registration successful! Thank you for signing up!"
        mgIcon.src = 'assets/image/bell_icon.png';
        errorModal.style.display = 'block';
        form.reset();
      } else {
        throw new Error('Registration failed: ' + data);
        
      }
    })
    .catch(error => {
      errorModalContent.textContent = error;
      mgIcon.src = 'assets/image/bell_icon.png';
      errorModal.style.display = 'block';
    });
  }
});
// registration.js

document.addEventListener("DOMContentLoaded", function() {
  // Fetch locations from the server when the page loads
  fetchLocations();
});

function fetchLocations() {
  // Make an AJAX request to the PHP script to retrieve locations
  fetch('get_locations.php')
      .then(response => response.json())
      .then(data => {
          // Populate the dropdown list with locations
          const selectElement = document.getElementById('locations');
          data.forEach(location => {
              const option = document.createElement('option');
              option.value = location;
              option.textContent = location;
              selectElement.appendChild(option);
          });
      })
      .catch(error => console.error('Error fetching locations:', error));
}
