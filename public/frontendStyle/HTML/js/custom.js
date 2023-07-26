// Dane kontaktowe do sekcji głównej
var phoneNumberFooter = "(123) 456-7890";
var emailFooter = "mail@example.com";

// Wyświetlenie danych na stronie dla sekcji stopki
var emailLinkElementFooter = document.createElement('a');
emailLinkElementFooter.href = 'mailto:' + emailFooter;
emailLinkElementFooter.textContent = emailFooter;

var phoneNumberElementFooter = document.createElement('span');
phoneNumberElementFooter.textContent = phoneNumberFooter;

var callToPhoneNumberElementFooter = document.createElement('a');
callToPhoneNumberElementFooter.href = 'tel:' + phoneNumberFooter; // Opcja "callto" dla numeru telefonu
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

// Dane kontaktowe do sekcji głównej
var phoneNumberFooter = "(123) 456-7890";
var emailFooter = "mail@example.com";

// Wyświetlenie danych na stronie dla sekcji stopki
var emailLinkElementFooter = document.createElement('a');
emailLinkElementFooter.href = 'mailto:' + emailFooter;
emailLinkElementFooter.textContent = emailFooter;

var phoneNumberElementFooter = document.createElement('span');
phoneNumberElementFooter.textContent = phoneNumberFooter;

var callToPhoneNumberElementFooter = document.createElement('a');
callToPhoneNumberElementFooter.href = 'tel:' + phoneNumberFooter; // Opcja "callto" dla numeru telefonu
callToPhoneNumberElementFooter.textContent = phoneNumberFooter;

var emailContainerElementFooter = document.getElementById('email');
var phoneNumberContainerElementFooter = document.getElementById('phoneNumber');
var callToPhoneNumberContainerElementFooter = document.getElementById('callToPhoneNumber');

if (emailContainerElementFooter) {
    emailContainerElementFooter.appendChild(emailLinkElementFooter);
}

if (phoneNumberContainerElementFooter) {
    phoneNumberContainerElementFooter.appendChild(phoneNumberElementFooter);
}

if (callToPhoneNumberContainerElementFooter) {
    callToPhoneNumberContainerElementFooter.appendChild(callToPhoneNumberElementFooter);
}
