// Dane kontaktowe do sekcji głównej
var phoneNumber = "(123) 456-7890";
var email = "mail@example.com";

// Wyświetlenie danych na stronie dla sekcji głównej
var emailLinkElement = document.createElement('a');
emailLinkElement.href = 'mailto:' + email;
emailLinkElement.textContent = email;

var phoneNumberElement = document.createElement('span');
phoneNumberElement.textContent = phoneNumber;

var emailContainerElement = document.getElementById('email');
var phoneNumberContainerElement = document.getElementById('phoneNumber');

if (emailContainerElement) {
    emailContainerElement.appendChild(emailLinkElement);
}

if (phoneNumberContainerElement) {
    phoneNumberContainerElement.appendChild(phoneNumberElement);
}


// Dane kontaktowe dla stopki
var phoneNumberFooter = "(123) 456-7890";
var emailFooter = "mail@example.com";

// Wyświetlenie danych na stronie dla stopki
var emailLinkElementFooter = document.createElement('a');
emailLinkElementFooter.href = 'mailto:' + emailFooter;
emailLinkElementFooter.textContent = emailFooter;

var phoneNumberElementFooter = document.createElement('span');
phoneNumberElementFooter.textContent = phoneNumberFooter;

var emailContainerElementFooter = document.getElementById('emailfooter');
var phoneNumberContainerElementFooter = document.getElementById('phoneNumberfooter');

if (emailContainerElementFooter) {
    emailContainerElementFooter.appendChild(emailLinkElementFooter);
}

if (phoneNumberContainerElementFooter) {
    phoneNumberContainerElementFooter.appendChild(phoneNumberElementFooter);
}
