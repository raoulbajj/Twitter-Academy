//Message d'erreur

const emailAlreadyUseMessage = document.querySelector('.email-already-use');
const accountCreatedMessage = document.querySelector('.account-created');
const accountCreatedRedirectMessage = document.querySelector('.account-created-redirect');
const accountDisabledMessage = document.querySelector('.account-disabled');
const accountLoginErrorMessage = document.querySelector('.account-login-error');

// Ciblage des formulaires :
const sign_up_form = document.querySelector('.sign_up');
const sign_in_form = document.querySelector('.sign_in');

// Ciblage des boutons de switch :
const sign_up_onglet = document.querySelector('.onglets-container-sign-up');
const sign_in_onglet = document.querySelector('.onglets-container-sign-in');

function emailAlreadyUse() {
  emailAlreadyUseMessage.style.display = "flex";
}
function accountCreated() {
  accountCreatedMessage.style.display = "flex";
}
function accountDisabled() {
  accountDisabledMessage.style.display = "flex";
}
function accountLoginError() {
  accountLoginErrorMessage.style.display = "flex";
}
function loadRegister() {
  sign_in_form.style.display = "none";
  sign_up_form.style.display = "flex";
  sign_up_onglet.style.display = "none";
  sign_in_onglet.style.display = "flex";
}