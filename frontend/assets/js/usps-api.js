
  var validateUspsAddress = function (address, city, state, zipCode, keepOrigAddress, firstName, lastName, company, email, country) {
    const userDetailsObj = {
      firstName,
      lastName,
      company,
      email,
      country,
      keepOrigAddress
    };
    const xhttp = new XMLHttpRequest();
    let xml = '<AddressValidateRequest USERID="' + uspsUserID + '">' + 
      '<Address>' + 
        '<Address1>' + address + '</Address1>' +
        '<Address2></Address2>' +
        '<City>' + city + '</City>' +
        '<State>' + state + '</State>' +
        '<Zip5>' + zipCode + '</Zip5>' +
        '<Zip4></Zip4>' +
      '</Address>' +
    '</AddressValidateRequest>';
    const url = uspsEndpoint + xml;
    xhttp.open('GET', url, true);

    xhttp.onreadystatechange = (e) => {
      if (xhttp.readyState == 4 && xhttp.status == 200) {
        const errorMessageDoc = xhttp.responseXML.getElementsByTagName("Error");
        if (errorMessageDoc.length){
          const errorMessage = errorMessageDoc[0].getElementsByTagName("Description")[0].textContent;
          if (errorMessage) {
            $('#error-message').html(errorMessage);
            $('#error-message').show();
          }
        } else {
          const returnTextDoc = xhttp.responseXML.getElementsByTagName("ReturnText");
          if (returnTextDoc.length){
            const returnTextMessage = returnTextDoc[0].textContent;
            if (returnTextMessage) {
              $('#warning-message').html(returnTextMessage);
              $('#warning-message').show();
            }
          } else {
            // now save the address, based on response or based on what user entered
            if (keepOrigAddress) {
              saveAddressIntoAPI(
                address,
                '',
                city,
                state,
                zipCode,
                '',
                userDetailsObj
              );
            } else {
              const addressDoc = xhttp.responseXML.getElementsByTagName("Address");
              saveAddressIntoAPI(
                addressDoc[0].getElementsByTagName("Address1")[0].textContent,
                addressDoc[0].getElementsByTagName("Address2")[0].textContent,
                addressDoc[0].getElementsByTagName("City")[0].textContent,
                addressDoc[0].getElementsByTagName("State")[0].textContent,
                addressDoc[0].getElementsByTagName("Zip5")[0].textContent,
                addressDoc[0].getElementsByTagName("Zip4")[0].textContent,
                userDetailsObj
              );
            }
          }
        }
      }
    }

    xhttp.send();
  }
  
  var saveAddressIntoAPI = function(address1, address2, city, state, zipCode5, zipCode4, userDetailsObj) {
    $.ajax({
      type: "POST",
      url: apiEndpoint + '/save.php',
      data: {
        address: {
          address1,
          address2,
          city,
          state,
          zipCode5,
          zipCode4,
        },
        userDetails: userDetailsObj
      },
      success: function(response) {
        if (response.status === 200) {
          $('#success-message').html('Successfully saved the mailing address!');
          $('#success-message').show();
        }
      },
      dataType: "json"
    });
  }