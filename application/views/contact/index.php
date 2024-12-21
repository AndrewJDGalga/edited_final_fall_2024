<main>
    <h2 class="text-horizontal-center logo-font heavy-font">Contact Us</h2>
    <ul id="feedback" class="max-512 margin-horizontal-auto">
    </ul>
    {spinner}
    <form id="form_contact" name="form_contact" action="" class="margin-horizontal-auto max-512">
        <label for="email">What's a good contact email for you?</label>
        <input id="email" name="email" type="email" maxlength="64" required>
        <label for="message">How can we help?</label>
        <textarea id="message" name="message" maxlength="1000" placeholder="Enter your message here..." required></textarea>
        <label for="message" class="small-text">Characters remaining: <span id="message_count">1000</span>/1000</label>
        <div class="margin-zero-auto">
            <button type="reset">Clear</button>
            <button type="submit">Submit</button>
        </div>
    </form>
</main>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script src="assets/js/contact.js"></script>