window.onload = () => {
    const feedback = document.getElementById('feedback');
    const warnings = {
        'email'         : 'Please double-check the provided email address.',
        'message'       : 'Please double-check the provided message.',
        'connection'    : 'Connection error encountered. Please check your connection and reload the page. If the issue persists, please try another browser or device.',
        'sent'          : 'Internal error encountered. Please try again in a few hours.'
    };

    const startSpinner = () => {
        document.querySelector('.loading-spinner').classList.remove('invisible');
    }
    const stopSpinner = () => {
        document.querySelector('.loading-spinner').classList.add('invisible');
    }
    const clearFeedback = () => {
        feedback.innerHTML = "";
    }
    const success = (result) => {
        stopSpinner();
        clearFeedback();
        
        console.log(result);
        if('error_message' in result) feedback.innerHTML += `<li class="text-horizontal-center warning">${warnings['message']}</li>`;

        if('error_email' in result) feedback.innerHTML += `<li class="text-horizontal-center warning">${warnings['email']}</li>`;

        if(('sent_email' in result) && result['sent_email'] === false) feedback.innerHTML = `<li class="text-horizontal-center warning">${warnings['sent']}</li>`;
        
        if(('sent_email' in result) && result['sent_email'] === true) feedback.innerHTML = '<li class="text-horizontal-center success">Email sent. Please expect a response within a few business days.</li>';
    }
    const failure = () => {
        stopSpinner();
        clearFeedback();

        feedback.innerHTML = `<li class="text-horizontal-center warning">${warnings['connection']}</li>`;
    }

    document.forms.form_contact.onsubmit = (e) => {
        e.preventDefault();
        
        $.ajax({
            url: 'process_form',
            beforeSend: startSpinner,
            type: 'post',
            dataType: 'json',
            data: $($('form')[0]).serialize(),
            success: success,
            error: failure
        });
    }

    //simple li'l characters remaining counter
    const message_element = document.getElementById('message');
    message_element.oninput = () => document.getElementById('message_count').innerText = message_element.maxLength - message_element.value.length;
}