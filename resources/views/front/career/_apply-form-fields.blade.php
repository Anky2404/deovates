<div class="career-apply-header">
    <h4>General Application</h4>
    <p>Tell us about yourself and the kind of role you're looking for.</p>
</div>

<form class="app-contact-form" novalidate>
    <div class="row g-3">
        <div class="col-md-6 app-form-group">
            <label for="{{ $prefix }}-name">Full Name</label>
            <input type="text" id="{{ $prefix }}-name" name="name" required placeholder="John Doe">
            <span class="app-form-error">Please enter your name.</span>
        </div>
        <div class="col-md-6 app-form-group">
            <label for="{{ $prefix }}-email">Email Address</label>
            <input type="email" id="{{ $prefix }}-email" name="email" required placeholder="john@example.com">
            <span class="app-form-error">Please enter a valid email.</span>
        </div>
        <div class="col-md-6 app-form-group">
            <label for="{{ $prefix }}-phone">Phone Number</label>
            <input type="tel" id="{{ $prefix }}-phone" name="phone" required placeholder="+91 12345 67890">
            <span class="app-form-error">Please enter a valid phone number.</span>
        </div>
        <div class="col-md-6 app-form-group">
            <label for="{{ $prefix }}-role">Role You're Interested In</label>
            <input type="text" id="{{ $prefix }}-role" name="role" required placeholder="e.g. Frontend Developer">
            <span class="app-form-error">Please tell us which role you're interested in.</span>
        </div>
        <div class="col-12 app-form-group">
            <label for="{{ $prefix }}-message">Message</label>
            <textarea id="{{ $prefix }}-message" name="message" rows="4" required
                placeholder="Tell us a bit about your experience..."></textarea>
            <span class="app-form-error">Please enter a short message.</span>
        </div>
    </div>

    <button type="submit" class="app-form-submit mt-3">
        <span class="app-form-submit-text">Submit Application</span>
        <span class="app-form-submit-loader"></span>
    </button>

    <div class="app-form-success">
        <i class="fa fa-check-circle"></i>
        <p>Thanks! Your application has been received.</p>
    </div>
</form>
