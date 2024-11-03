document.querySelector(".colonne").style.opacity = 1.0;

const label_username = document.getElementById("label_username");
const input_username = document.getElementById("username");

const label_name = document.getElementById("label_name");
const input_name = document.getElementById("name");

const label_password = document.getElementById("label_password");
const input_password = document.getElementById("password");

const label_password_1 = document.getElementById("label_password_1");
const input_password_1 = document.getElementById("password_1");

const label_email = document.getElementById("label_email");
const input_email = document.getElementById("email");

if (input_name === null) {
} else {
  // code à exécuter si la variable input_name n'est pas nulle
  input_name.addEventListener("click", function () {
    label_name.style.opacity = 1;
    this.placeholder = "";
  });

  input_name.addEventListener("focus", function () {
    label_name.style.opacity = 1;
    this.placeholder = "";
  });

  input_name.addEventListener("blur", function () {
    if (this.value === "") {
      input_name.style.opacity = "1";
      input_name.placeholder = "Name";
      label_name.style.opacity = 0;
    }
  });
}


if (input_username === null) {
} else {
  // Effet d'apparition/disparition sur input et label : USER NAME
  input_username.addEventListener("click", function () {
    label_username.style.opacity = 1;
    this.placeholder = "";
  });

  input_username.addEventListener("focus", function () {
    label_username.style.opacity = 1;
    this.placeholder = "";
  });

  input_username.addEventListener("blur", function () {
    if (this.value === "") {
      input_username.style.opacity = "1";
      input_username.placeholder = "Username / E-mail";
      label_username.style.opacity = 0;
    }
  });
}

if (input_password === null) {
} else {
  // Effet d'apparition/disparition sur input et label : PASSWORD
  input_password.addEventListener("click", function () {
    label_password.style.opacity = 1;
    this.placeholder = "";
  });

  input_password.addEventListener("focus", function () {
    label_password.style.opacity = 1;
    this.placeholder = "";
  });

  input_password.addEventListener("blur", function () {
    if (this.value === "") {
      input_password.style.opacity = "1";
      input_password.placeholder = "●●●●●●●●●●";
      label_password.style.opacity = 0;
    }
  });
}

if (input_password_1 === null) {
} else {
  // Effet d'apparition/disparition sur input et label : PASSWORD_1
  input_password_1.addEventListener("click", function () {
    label_password_1.style.opacity = 1;
    this.placeholder = "";
  });

  input_password_1.addEventListener("focus", function () {
    label_password_1.style.opacity = 1;
    this.placeholder = "";
  });

  input_password_1.addEventListener("blur", function () {
    if (this.value === "") {
      input_password_1.style.opacity = "1";
      input_password_1.placeholder = "●●●●●●●●●●";
      label_password_1.style.opacity = 0;
    }
  });
}

if (input_email === null) {
} else {
  // Effet d'apparition/disparition sur input et label : EMAIL
  input_email.addEventListener("click", function () {
    label_email.style.opacity = 1;
    this.placeholder = "";
  });

  input_email.addEventListener("focus", function () {
    label_email.style.opacity = 1;
    this.placeholder = "";
  });

  input_email.addEventListener("blur", function () {
    if (this.value === "") {
      input_email.style.opacity = "1";
      input_email.placeholder = "mail@example.com";
      label_email.style.opacity = 0;
    }
  });
}

// ===================================================================================================================================
// Partie switch de formulaire via les boutons SIGN UP / SIGN IN

// Ciblage des boutons de switch :
const sign_up_button = document.querySelector('.sign_up_button');
const sign_in_button = document.querySelector('.sign_in_button');

// Event listener
sign_up_button.addEventListener('click', function () {
  sign_in_form.style.display = "none";
  sign_up_form.style.display = "flex";
  sign_up_onglet.style.display = "none";
  sign_in_onglet.style.display = "flex";

  emailAlreadyUseMessage.style.display = "none";
  accountCreatedMessage.style.display = "none";
  accountDisabledMessage.style.display = "none";
  accountLoginErrorMessage.style.display = "none";
});
sign_in_button.addEventListener('click', function () {
  sign_in_form.style.display = "flex";
  sign_up_form.style.display = "none";
  sign_up_onglet.style.display = "flex";
  sign_in_onglet.style.display = "none";

  emailAlreadyUseMessage.style.display = "none";
  accountCreatedMessage.style.display = "none";
  accountDisabledMessage.style.display = "none";
  accountLoginErrorMessage.style.display = "none";
});
