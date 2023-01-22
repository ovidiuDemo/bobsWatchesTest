const onlyLettersRegExp = /[A-Za-z]/;
const onlyNumbersRegExp = /[0-9]/;
const emailRegExp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
const zipCodeRexExp = /(^\d{5}$)|(^\d{5}-\d{4}$)/;

(function($){
  let firstNameIsValid = true;
  let lastNameIsValid = true;
  let emailIsValid = true;
  let addressIsValid = true;
  let cityIsValid = true;
  let zipCodeIsValid = true;

  $('.alert').hide();
  showStatesSelect();

  function hideStatesSelect() {
    $('#state-input-container').hide();
  }

  function showStatesSelect() {
    $('#state-input-container').show();
  }

  $('#country-input-container select').change(function() {
    if ($('#country-input-container select option:selected').val() === 'United States') {
      showStatesSelect();
    } else {
      hideStatesSelect();
    }
  });

  $('#submit-mailing-address-btn').click((evt) => {
    evt.preventDefault();
    evt.stopPropagation();

    submitMailAddressForm(evt);
  });

  function submitMailAddressForm(evt) {
    validateFirstName();
    validateLastName();
    validateEmailAddress();
    validateAddress();
    validateCity();
    validateZipCode();

    if (
      firstNameIsValid &&
      lastNameIsValid &&
      emailIsValid &&
      addressIsValid &&
      cityIsValid &&
      zipCodeIsValid
    ) {
      validateUspsAddress( 
        $("#address-input-container input").val(),
        $("#city-input-container input").val(),  
        $("#state-input-container select option:selected").val(),  
        $("#zipcode-input-container input").val(), 
        $("#keepOrigAddress").is(':checked'),
        $("#first-name-input-container input").val(),
        $("#last-name-input-container input").val(),
        $("#company-input-container input").val(),
        $("#email-input-container input").val(),
        $("#country-input-container select option:selected").val(), 
      );
    }
  }

  // validation first name input
  $("#first-name-input-container input").blur(function () {
    validateFirstName();
  });
  function validateFirstName() {
    const firstNameVal = $('#first-name-input-container input').val();
    if (!firstNameVal) {
      showFirstNameError();
      return false;
    } else {
      if (!onlyLettersRegExp.test(firstNameVal)) {
        showFirstNameError();
        return false;
      }
    }

    return true;
  };

  function showFirstNameError() {
    $('#first-name-input-container .invalid-feedback').show();
    firstNameIsValid = false;
  }

  // validation last name input
  $("#last-name-input-container input").blur(function () {
    validateLastName();
  });
  function validateLastName() {
    const lastNameVal = $('#last-name-input-container input').val();
    if (!lastNameVal) {
      showLastNameError();
      return false;
    } else {
      if (!onlyLettersRegExp.test(lastNameVal)) {
        showLastNameError();
        return false;
      }
    }

    return true;
  };

  function showLastNameError() {
    $('#last-name-input-container .invalid-feedback').show();
    lastNameIsValid = false;
  }

  // validation email address
  $("#email-input-container input").blur(function () {
    validateEmailAddress();
  });
  function validateEmailAddress() {
    const emailVal = $('#email-input-container input').val();
    if (!emailVal) {
      emailIsValid = false;
      $('#email-input-container .invalid-feedback').show();
      return false;
    } else {
      if (!emailRegExp.test(emailVal)) {
        emailIsValid = false;
        $('#email-input-container .invalid-feedback').show();
        return false;
      }
    }

    return true;
  };

  // validation city input
  $("#city-input-container input").blur(function () {
    validateCity();
  });
  function validateCity() {
    const cityNameVal = $('#city-input-container input').val();
    var isValid = true;
    if (!cityNameVal) {
      showCityError();
      return false;
    } else {    
      if (!onlyLettersRegExp.test(cityNameVal)) {
        showCityError();
        return false
      }
    }

    return true;
  }
  
  function showCityError() {
    cityIsValid = false;
    $('#city-input-container .invalid-feedback').show();
  }

  // validation address input
  $("#address-input-container input").blur(function () {
    validateAddress();
  });

  function validateAddress() {
    const addressVal = $('#address-input-container input').val();
    
    if (!addressVal) {
      $('#address-input-container .invalid-feedback').show();
      addressIsValid = false;
      return false;
    }

    return true;
  }

  // validation zip code
  $("#zipcode-input-container input").blur(function () {
    validateZipCode();
  });
  function validateZipCode() {
    const zipCodeVal = $('#zipcode-input-container input').val();
    if (!zipCodeVal) {
      showZipCodeError();
      return false;
    } else {
      if (!zipCodeRexExp.test(zipCodeVal)) {
        showZipCodeError();
        return false;
      }
    }

    return true;
  };

  function showZipCodeError() {
    zipCodeIsValid = false;
    $('#zipcode-input-container .invalid-feedback').show();
  }

})(jQuery); 