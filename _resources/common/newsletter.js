// This script handles the Newsletter signup for all pages with premium status styling
document.addEventListener('DOMContentLoaded', function () {

    var newsForm = document.getElementById('newsletterForm');

    if (newsForm) {
        newsForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Check if running on Live Server (Port 5500)
            if (window.location.port === '5500' || window.location.port === '5501') {
                var statusDiv = document.getElementById('newsletterStatus');
                statusDiv.className = 'form-status error';
                statusDiv.innerHTML = '<i class="fas fa-exclamation-triangle"></i> <strong>PHP Error:</strong> Requires XAMPP.';
                statusDiv.style.display = 'flex';
                return;
            }

            var btn = newsForm.querySelector('.btn-subscribe');
            var statusDiv = document.getElementById('newsletterStatus');
            var originalText = btn.innerHTML;

            // Loading state
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subscribing...';
            statusDiv.style.display = 'none';

            var formData = new FormData(newsForm);

            fetch('../php/newsletter-handler.php?v=' + Date.now(), {
                method: 'POST',
                body: formData
            })
                .then(function (response) {
                    return response.text();
                })
                .then(function (responseText) {
                    try {
                        var data = JSON.parse(responseText);
                        statusDiv.style.display = 'flex';

                        // Apply premium styling classes
                        if (data.status === 'success') {
                            statusDiv.className = 'form-status success';
                            statusDiv.innerHTML = '<i class="fas fa-check-circle"></i> ' + data.message;
                            newsForm.reset();
                        } else if (data.status === 'info') {
                            statusDiv.className = 'form-status info';
                            statusDiv.innerHTML = '<i class="fas fa-info-circle"></i> ' + data.message;
                        } else {
                            statusDiv.className = 'form-status error';
                            statusDiv.innerHTML = '<i class="fas fa-times-circle"></i> ' + data.message;
                        }
                    } catch (e) {
                        statusDiv.style.display = 'flex';
                        statusDiv.className = 'form-status error';
                        statusDiv.innerHTML = '<i class="fas fa-bug"></i> Server Error. Check console.';
                        console.error('PHP Output:', responseText);
                    }
                })
                .catch(function (error) {
                    statusDiv.style.display = 'flex';
                    statusDiv.className = 'form-status error';
                    statusDiv.innerHTML = '<i class="fas fa-wifi"></i> Connection Error.';
                })
                .finally(function () {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                });
        });
    }
});
