
// Replace SGMB default dropdown label
jQuery('span:contains("Share List")').text(function(_, text) {
    return text.replace("Share List", "Share This");
});

// Bootstrapize the default acf_form submit button
jQuery('.acf-button').addClass('btn btn-primary btn-lg');

// Bootstrapize the default acf_form success message
jQuery('#message.updated').addClass('alert alert-success');