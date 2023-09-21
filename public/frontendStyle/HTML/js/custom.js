// Pobieranie wartości z elementów HTML
var emailFooter = document.getElementById('email').textContent;
var phoneNumberFooter = document.getElementById('callToPhoneNumber').textContent;

// Wyświetlanie danych na stronie dla sekcji stopki
var emailLinkElementFooter = document.createElement('a');
emailLinkElementFooter.href = 'mailto:' + emailFooter;
emailLinkElementFooter.textContent = emailFooter;

var phoneNumberElementFooter = document.createElement('span');
phoneNumberElementFooter.textContent = phoneNumberFooter;

var callToPhoneNumberElementFooter = document.createElement('a');
callToPhoneNumberElementFooter.href = 'tel:' + phoneNumberFooter;
callToPhoneNumberElementFooter.textContent = phoneNumberFooter;

var emailContainerElementFooter = document.getElementById('emailfooter');
var phoneNumberContainerElementFooter = document.getElementById('phoneNumberfooter');
var callToPhoneNumberContainerElementFooter = document.getElementById('callToPhoneNumberfooter');

if (emailContainerElementFooter) {
    emailContainerElementFooter.appendChild(emailLinkElementFooter);
}

if (phoneNumberContainerElementFooter) {
    phoneNumberContainerElementFooter.appendChild(phoneNumberElementFooter);
}

if (callToPhoneNumberContainerElementFooter) {
    callToPhoneNumberContainerElementFooter.appendChild(callToPhoneNumberElementFooter);
}
