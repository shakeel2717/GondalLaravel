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
                        <option value="{{ $country->code }}" @if($country=="Pakistan" ) selected @endif>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        @php
                        if($type == "adult"){
                        $maxDate = now()->addYears(-12)->format('Y-m-d');
                        $minDate = now()->addYears(-150)->format('Y-m-d');
                        } elseif($type == "children"){
                        $maxDate = now()->addYears(-2)->format('Y-m-d');
                        $minDate = now()->addYears(-12)->format('Y-m-d');
                        } elseif($type == "infant"){
                        $maxDate = now()->addDays(-2)->format('Y-m-d');
                        $minDate = now()->addYears(-2)->format('Y-m-d');
                        }
                        @endphp
                        <label class="label-text" for="dob_{{ $type .'_'. $data + 1 }}">Date of Birth</label>
                        <input type="date" class="form-control" id="dob_{{ $type .'_'. $data + 1 }}" name="dob_{{ $type .'_'. $data + 1 }}" min="{{ $minDate }}" max="{{ $maxDate }}" required>
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
                        <div class="col-12">
                            <label class="label-text" for="passport_expiry_{{ $type .'_'. $data + 1 }}">Passport Expiry Date</label>
                            <input type="date" class="form-control" id="passport_expiry_{{ $type .'_'. $data + 1 }}" name="passport_expiry_{{ $type .'_'. $data + 1 }}" min="{{ now()->addMonths(1)->format('Y-m-d') }}" max="{{ now()->addYears(20)->format('Y-m-d') }}" value="{{ now()->addMonths(1)->format('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>