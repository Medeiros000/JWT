console.log('Ajax_Post');
function switch_theme(theme_selected) {
    $.ajax({
        url: '../prjv/helpers/theme.php',
        method: 'POST',
        data: {
            theme: theme_selected
        },
        success: function (response) {
            let responseObject = JSON.parse(response);
            console.log(`Success! Theme: ${theme_selected} `+ responseObject.status);
            location.reload();
        },
        error: function (error) {
            console.log('Error: ' + error);
        }
    });
}