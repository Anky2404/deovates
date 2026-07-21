<form id="homeContactForm" class="app-contact-form" method="POST" action="{{ route('front.contact.store') }}" novalidate>
    @csrf

    <div class="app-form-group w-100">
        <label for="hc-name">Full Name</label>
        <input type="text" id="hc-name" name="name" required placeholder="John Doe">
        <span class="app-form-error">Please enter your name.</span>
    </div>

    <div class="app-form-group w-100">
        <label for="hc-email">Email Address</label>
        <input type="email" id="hc-email" name="email" required placeholder="john@example.com">
        <span class="app-form-error">Please enter a valid email.</span>
    </div>

    <div class="app-form-group w-100">
        <label for="hc-phone">Phone Number</label>
        <input type="tel" id="hc-phone" name="phone" placeholder="+91 12345 67890">
        <span class="app-form-error">Please enter a valid phone number.</span>
    </div>

    <div class="app-form-group w-100">
        <label for="hc-message">Message</label>
        <textarea id="hc-message" name="message" rows="4" required placeholder="Tell us about your project..."></textarea>
        <span class="app-form-error">Please enter a message.</span>
    </div>

    <button type="submit" class="app-form-submit">
        <span class="app-form-submit-text">Send Message</span>
        <span class="app-form-submit-loader"></span>
    </button>

    <div class="app-form-success">
        <i class="fa fa-check-circle"></i>
        <p>Thanks! Your message has been noted.</p>
    </div>

</form>
