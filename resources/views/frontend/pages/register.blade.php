<small class="margin-bottom-70">Fill all the fields.</small>
<div class="form-row">
    <div class="col form-group">
        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First name" maxlength="40"
            autocomplete="off" onkeypress="return /[a-z ]/i.test(event.key)" value="{{ old('firstname') }}" required>
        <small class="text-muted">
            <span><i class="fas fa-info-circle"></i> Don't Enter Dr. in Name Field.</span>
        </small>
    </div>
    <div class="col form-group">
        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last name" maxlength="40"
            autocomplete="off" onkeypress="return /[a-z ]/i.test(event.key)" value="{{ old('lastname') }}">
    </div>
</div>
<div class="form-row">
    <div class="col form-group">
        <input type="tel" id="phonenumber" name="phonenumber" class="form-control" placeholder="Phone Number"
            maxlength="10" pattern="[6789][0-9]{9}" onkeyup="this.value=this.value.replace(/[^\d]/,'')"
            autocomplete="off" value="{{ old('phonenumber') }}" required>
    </div>
    <div class="col form-group">
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" maxlength="40"
            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" autocomplete="off" value="{{ old('email') }}" required>
    </div>
</div>
<div class="form-row">
    <div class="col form-group">
        <input type="text" id="qualification" name="qualification" class="form-control" maxlength="40"
            placeholder="Qualification" autocomplete="off" value="{{ old('qualification') }}">
    </div>
    <div class="col form-group">
        <input type="text" id="regnumber" name="regnumber" class="form-control" maxlength="40"
            placeholder="Registration No." autocomplete="off" value="{{ old('regnumber') }}" required>
    </div>
</div>
<div class="form-row">
    <div class="col form-group">
        <input type="password" id="password" name="password" class="form-control" minlength="8" maxlength="20"
            placeholder="Password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
            aria-describedby="passwordHelpInline" autocomplete="off" value="{{ old('password') }}" required>
        <span class="eye"><i class="far fa-eye" id="togglePassword"></i></span>
        <small id="passwordHelpInline" class="text-muted">
            <span><i class="fas fa-info-circle"></i> 8-20 char - 1 Caps, 1 Special & 1 Num.</span>
        </small>
    </div>
    <div class="col form-group">
        <input type="password" id="password2" name="password2" class="form-control" placeholder="Confirm Password"
            autocomplete="off" value="{{ old('password2') }}">
    </div>
</div>
<div class="form-row">
    <div class="col form-group">
        <select id="clinichospital" name="clinichospital" class="form-control responsiveSelect2" style="width:100%"
            value="{{ old('clinichospital') }}" required>
            <option value="" Selected disabled>Select Clinic/Hospital</option>
            <option value="New Clinic">{{ 'Add New Clinic / Hospital' }}</option>
            @foreach ($clinics as $item)
                <option value="{{ $item->clinic_id }},{{ $item->clinic_name }}">{{ $item->clinic_name }},
                    {{ $item->location }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-row" id="newclinichospital">
    <div class="col form-group">
        <input type="text" id="clinicname" name="clinicname" class="form-control" placeholder="Clinic Name"
            maxlength="40" autocomplete="off" value="{{ old('clinicname') }}">
    </div>
    <div class="col form-group">
        <input type="text" id="location" name="location" class="form-control" placeholder="Location" maxlength="40"
            autocomplete="off" value="{{ old('location') }}">
    </div>
</div>
<div class="form-row">
    <div class="col form-group">
        <select id="department" name="department" class="form-control responsiveSelect2" style="width:100%" required>
            <option value="" selected disabled>{{ 'Select Department' }}</option>
            @foreach ($deptartment as $item)
                <option value="{{ $item->department_id }},{{ $item->department_name }}">
                    {{ $item->department_name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group checkbox">
            <input type="checkbox" id="privacy" name="privacy" class="form-control" required>
            <label for="privacy">
                I have read and agree to the <a href="{{ url('p/2/privacy-policy') }}" target="_blank">Privacy
                    Policy</a> &
                <a href="{{ url('p/1/terms-conditions') }}" target="_blank">Terms & Conditions</a>.
            </label>
        </div>
    </div>
</div>
