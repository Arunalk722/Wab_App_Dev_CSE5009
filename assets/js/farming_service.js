document.addEventListener("DOMContentLoaded", function() {    
    fetchLocations();   
    setFieldsFromCookie();
});

function fetchLocations() {    
    fetch('scripts/farming_service.php')
        .then(response => response.json())
        .then(data => {
            
            const selectElement = document.getElementById('locations');
            data.forEach(location => {
                const option = document.createElement('option');
                option.value = location.location_name;
                option.textContent = location.location_name;
                selectElement.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching locations:', error));
}

function setFieldsFromCookie() {
    const fullName = getCookie("FullName");
    const emailAddress = getCookie("EmailAddress");
    const phoneNumber = getCookie("PhoneNumber");
    const locations = getCookie("Locations");
    document.getElementById('full-name').value = fullName;
    document.getElementById('email').value = emailAddress;
    document.getElementById('phone').value = phoneNumber;
    document.getElementById('locations').value = locations;
}

function getCookie(cname) {
    const name = cname + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

document.addEventListener('DOMContentLoaded', function() {
    const fullName = document.getElementById('full-name');
    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const services = document.getElementById('services');
    const locations = document.getElementById('locations');
    const form = document.getElementById('farming-form');
    

    form.addEventListener('submit', function(event) {
        event.preventDefault(); 
        if (validateForm()) {
            regService();
        }
    });

    function validateForm() {
        let isValid = true;

        if (!fullName.value.trim()) {
            showError('Please enter your full name.');
            isValid = false;
        }
        if (!email.value.trim()) {
            showError('Please enter your email address.');
            isValid = false;
        } else if (!isValidEmail(email.value.trim())) {
            showError('Please enter a valid email address.');
            isValid = false;
        }
        if (!phone.value.trim()) {
            showError('Please enter your phone number.');
            isValid = false;
        } else if (!isValidPhone(phone.value.trim())) {
            showError('Please enter a valid phone number.');
            isValid = false;
        }
        if (services.selectedIndex === 0) {
            showError('Please select a service.');
            isValid = false;
        }
        if (locations.selectedIndex === 0) {
            showError('Please select a location.');
            isValid = false;
        }

        return isValid;
    }

    function showError(message) {
        errorModalContent.textContent = message;
        errorModal.style.display = 'block';
    }

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPhone(phone) {
        const phoneRegex = /^\d{10}$/;
        return phoneRegex.test(phone);
    }

    function regService() {
        const formData = new FormData(form);
        fetch('scripts/farming_service.php', {
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
                console.log("Response from server:", data); // Log the response message
                if (data === 'success') {           
                    document.getElementById('message-text').textContent = "farming service registered successfully";
                    document.getElementById('custom-dialog').style.display = 'block';         
                    

                } else {
                    throw new Error('Registration failed: ' + data);
                }
            })
            .catch(error => {
                errorModalContent.textContent = error;
                errorModal.style.display = 'block';
            });
            document.getElementById('ok-button').addEventListener('click', function() {
                window.location.href = 'index.html';
            });
    }
});