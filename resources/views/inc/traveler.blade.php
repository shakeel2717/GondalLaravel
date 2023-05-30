<div class="card-body">
    <!-- adults -->
    <div class="card mb-3">
        <div class="card-header text-uppercase">
            {{ $type }} Traveler <strong>{{ $data + 1 }}</strong>
        </div>
        <div class="card-body">
            <!-- personal info -->
            <div class="row">
                <div class="col-md-2">
                    <label class="label-text">Title</label>
                    <select name="title_{{ $type .'_'. $data + 1 }}" class="form-select" required>
                        <option value="Mr">Mr</option>
                        <option value="Miss">Miss</option>
                        <option value="Mrs">Mrs</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="label-text">First Name</label>
                    <input type="text" name="firstname_{{ $type .'_'. $data + 1 }}" class="form-control" placeholder="First Name" required />
                </div>
                <div class="col-md-4">
                    <label class="label-text">Last Name</label>
                    <input type="text" name="lastname_{{ $type .'_'. $data + 1 }}" class="form-control" placeholder="Last Name" required />
                </div>
                <div class="col-md-2">
                    <label class="label-text">Gender</label>
                    <select name="gender_{{ $type .'_'. $data + 1 }}" class="form-select" required>
                        <option value="MALE">Male</option>
                        <option value="FEMALE">Female</option>
                    </select>
                </div>
            </div>

            <!-- nationality and personality -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="label-text">Nationality</label>
                    <select class="form-select form-select" name="nationality_{{ $type .'_'. $data + 1 }}" required>
                        @foreach(countryList() as $country)
                        <option value="{{ $country }}" @if($country=="Pakistan" ) selected @endif>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-5">
                            <label class="label-text">Date of Birth</label>
                            <select class="form-select form-select" name="dob_month_{{ $type .'_'. $data + 1 }}" required>
                                @foreach (monthsList() as $month)
                                <option value="{{ $loop->iteration }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="label-text">Day</label>
                            <select name="dob_day_{{ $type .'_'. $data + 1 }}" class="form-select form-select" required>
                                @for ($i=1; $i < 32; $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="label-text">Year</label>
                            <select class="form-select form-select" name="dob_year_{{ $type .'_'. $data + 1 }}" required>
                                @for ($i=1920; $i < date('Y'); $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                    @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <!-- passport credentials -->
            <div class="row mt-3">
                <div class="col-md-12">
                    <label class="label-text">Passport or ID number</label>
                    <input type="text" name="passport_{{ $type .'_'. $data + 1 }}" class="form-control" placeholder="Passport or ID number" value="" required />
                </div>
                <div class="col-md-12 mt-3">
                    <div class="row">
                        <div class="col-5">
                            <label class="label-text">Passport Expiry Date</label>
                            <select class="form-select form-select" name="passport_month_{{ $type .'_'. $data + 1 }}" required>
                                @foreach (monthsList() as $month)
                                <option value="{{ $loop->iteration }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="label-text">Day</label>
                            <select name="passport_day_{{ $type .'_'. $data + 1 }}" class="form-select form-select" required>
                                @for ($i=1; $i < 32; $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                    @endfor
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="label-text">Year</label>
                            <select class="form-select form-select" name="passport_year_{{ $type .'_'. $data + 1 }}" required>
                                @for ($i=date('Y'); $i < 2035; $i++) <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                    @endfor
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>