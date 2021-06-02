            <h5 class="mt-4 text-capitalize">Personal Information</h5>
            <div class="card border-0 bg-white shadow-sm p-3 my-2">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="firstName">First Name</label>
                        <input
                            class="form-control"
                            type="text"
                            placeholder="{{ $student->first_name }}"
                            readonly
                        />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName">Last Name</label>
                        <input
                            class="form-control"
                            type="text"
                            value="{{ $student->last_name }}"
                            readonly
                        />
                    </div>
                    {{---<div class="form-group col-md-6">
                        <label for="dob">Date of Birth</label>
                        <input
                            class="form-control"
                            type="text"
                            placeholder="Aug 09, 2001"
                            readonly
                        />
                    </div>---}}
                    <div class="form-group col-md-6">
                        <label for="userGenderLabel">Gender</label><br />
                        <div class="form-check form-check-inline">
                            <input
                            class="form-check-input"
                            type="radio"
                            name="userGender"
                            id="gender1"
                            {{ $student->studentProfile->gender == 'male' ? 'checked' : 'disabled'}}
                            />
                            <label class="form-check-label" for="gender1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                            class="form-check-input"
                            type="radio"
                            name="userGender"
                            id="gender2"
                            value="female"
                            {{ $student->studentProfile->gender == 'female' ? 'checked' : 'disabled'}}
                            />
                            <label class="form-check-label" for="gender2">Female</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">E-mail</label>
                        <input
                            class="form-control"
                            type="text"
                            value="{{ $student->email }}"
                            readonly
                        />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone</label>
                        <input
                            class="form-control"
                            type="text"
                            value="{{ $student->phone }}"
                            readonly
                        />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="guardianName">Guardian's Name</label>
                        <input
                            class="form-control"
                            type="text"
                            value="{{ $student->studentProfile->guardian_name }}"
                            readonly
                        />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="guardianPhone">Guardian's Phone</label>
                        <input
                            class="form-control"
                            type="text"
                            value="{{ $student->studentProfile->guardian_phone }}"
                            readonly
                        />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="guardianEmail">Guardian's E-mail</label>
                        <input
                            class="form-control"
                            type="text"
                            value="{{ $student->studentProfile->guardian_email }}"
                            readonly
                        />
                    </div>
                </div>
            </div>