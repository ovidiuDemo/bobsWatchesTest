<?php
    $saveOrigAddressChecked = '';
    if (KEEP_ORIG_ADDRESS) {
        $saveOrigAddressChecked = "checked";
    }

    $countriesOptions = '';
    foreach($countries as $country) {
        $selectedAttr = '';
        if ($country == COUNTRY) {
            $selectedAttr = 'selected="selected"';
        }
        $countriesOptions .= '<option value="' . $country . '"' . $selectedAttr . '">' . $country . '</option>';
    }

    $statesOptions = '';
    foreach($us_states as $stateCode => $state) {
        $selectedAttr = '';
        if ($stateCode == STATE) {
            $selectedAttr = 'selected="selected"';
        }
        $statesOptions .= '<option value="' . $stateCode . '"' . $selectedAttr . '">' . $state . '</option>';
    }
?>
<div class="h-100">
  <div class="d-flex align-items-center h-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="card-body p-5">

              <h1 class="mb-5 text-center">Mailing Form</h1>

              <form id="submit-mailing-addr">
                <div class="row">
                  <div class="col-12 col-md-6 mb-4">
                    <div class="form-outline required" id="first-name-input-container">
                      <label class="form-label" for="firstName">First name</label>
                      <input type="text" id="firstName" class="form-control" name="firstName"
                        value="<?= FIRST_NAME ?>" maxlength="10" />
                      <div class="invalid-feedback">
                        Please provide your first name.
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 mb-4">
                    <div class="form-outline required" id="last-name-input-container">
                      <label class="form-label" for="lastName">Last name</label>
                      <input type="text" id="lastName" class="form-control" name="lastName"
                        value="<?= LAST_NAME ?>" maxlength="10" />
                      <div class="invalid-feedback">
                        Please provide your last name.
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 col-md-6 mb-4">
                    <div class="form-outline" id="company-input-container">
                      <label class="form-label" for="company">Company name</label>
                      <input type="text" id="company" class="form-control" name="company"
                        value="<?= COMPANY ?>" />
                    </div>
                  </div>
                  <div class="col-12 col-md-6 mb-4">
                    <div class="form-outline required" id="email-input-container">
                      <label class="form-label" for="email">Email</label>
                      <input type="email" id="email" class="form-control" name="email" value="<?= EMAIL ?>" />
                      <div class="invalid-feedback">
                        Please provide your email address.
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-outline required" id="address-input-container">
                  <label class="form-label" for="address">Address</label>
                  <input type="text" id="address" class="form-control" name="address" value="<?= ADDRESS ?>" />
                  <div class="invalid-feedback">
                    Please provide your address.
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 col-md-6 mb-4">
                    <div class="form-outline required" id="country-input-container">
                      <label class="form-label" for="country">Country</label>
                      <select class="form-control" aria-label="country" id="country" name="country">
                        <?= $countriesOptions ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 mb-4">
                    <div class="form-outline required" id="state-input-container">
                      <label class="form-label" for="state">State</label>
                      <select class="form-control" aria-label="country" id="country" name="country">
                        <?= $statesOptions ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-6 mb-4">
                    <div class="form-outline required" id="city-input-container">
                      <label class="form-label" for="city">City</label>
                      <input type="text" id="city" class="form-control" name="city" value="<?= CITY ?>" />
                      <div class="invalid-feedback">
                        Please provide your city name.
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 mb-4">
                    <div class="form-outline required" id="zipcode-input-container">
                      <label class="form-label" for="zipCode">Zip code</label>
                      <input type="text" id="zipCode" class="form-control" name="zipCode"
                        value="<?= ZIP_CODE ?>" />
                      <div class="invalid-feedback">
                        Please provide your zip code.
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="keepOrigAddress">Keep your original addres as you
                    entered</label>
                  <input type="checkbox" id="keepOrigAddress" name="keepOrigAddress" />
                </div>

                <button class="btn btn-primary btn-rounded btn-block" id="submit-mailing-address-btn">Validate</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>