jQuery('span:contains("Share List")').text(function(_, text) {
    return text.replace("Share List", "Share This");
});