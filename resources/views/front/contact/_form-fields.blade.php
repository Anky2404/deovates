<form id="{{ $prefix }}ContactForm" class="app-contact-form" novalidate>

    <div class="app-form-group">
        <label for="{{ $prefix }}-name">Full Name</label>
        <input type="text" id="{{ $prefix }}-name" name="name" required placeholder="John Doe">
        <span class="app-form-error">Please enter your name.</span>
    </div>

    <div class="app-form-group">
        <label for="{{ $prefix }}-email">Email Address</label>
        <input type="email" id="{{ $prefix }}-email" name="email" required placeholder="john@example.com">
        <span class="app-form-error">Please enter a valid email.</span>
    </div>

    <div class="app-form-group">
        <label for="{{ $prefix }}-phone">Phone Number</label>
        <input type="tel" id="{{ $prefix }}-phone" name="phone" placeholder="+91 12345 67890">
        <span class="app-form-error">Please enter a valid phone number.</span>
    </div>

    <div class="app-form-group">
        <label for="{{ $prefix }}-message">Message</label>
        <textarea id="{{ $prefix }}-message" name="message" rows="5" required
            placeholder="Tell us about your project..."></textarea>
        <span class="app-form-error">Please enter a message.</span>
    </div>

    <button type="submit" class="app-form-submit">
        <span class="app-form-submit-text">{{ $data['contact_form']['button_text'] ?? 'Send Inquiry' }}</span>
        <span class="app-form-submit-loader"></span>
    </button>

    <div class="app-form-success">
        <i class="fa fa-check-circle"></i>
        <p>Thanks! Your message has been noted.</p>
    </div>

</form>
