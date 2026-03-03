<?php
// Function to generate the Admin Email HTML
function get_admin_email_content($name, $email, $subject, $message) {
    // Keep the beautiful styles as requested by the user
    return "
    <html>
    <head>
        <style>
            body { font-family: 'Arial', sans-serif; color: #333; line-height: 1.6; background-color: #f4f4f4; margin: 0; padding: 20px; }
            .container { max-width: 600px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
            .header { border-bottom: 2px solid #d4a373; padding-bottom: 10px; margin-bottom: 20px; }
            .header h2 { color: #d4a373; margin: 0; font-size: 24px; text-transform: uppercase; }
            .content p { margin: 10px 0; }
            .content strong { color: #1a1a1a; }
            .message-box { background: #fafafa; border: 1px solid #eee; padding: 15px; border-radius: 4px; font-style: italic; margin-top: 20px; }
            .footer { margin-top: 30px; font-size: 12px; color: #888; text-align: center; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>New Inquiry Received</h2>
            </div>
            <div class='content'>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Subject:</strong> $subject</p>
                <div class='message-box'>
                    <strong>Message:</strong><br>
                    " . nl2br($message) . "
                </div>
            </div>
            <div class='footer'>
                This notification was generated from the Brew Haven Contact Us page.
            </div>
        </div>
    </body>
    </html>
    ";
}

// Function to generate the User Confirmation HTML
function get_user_confirmation_content($name, $subject, $message) {
    // Keep the beautiful styles as requested by the user
    return "
    <html>
    <head>
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fdfaf8; margin: 0; padding: 0; }
            .wrapper { padding: 40px 20px; }
            .card { max-width: 550px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 15px 35px rgba(212, 163, 115, 0.15); }
            .banner { background-color: #1a1a1a; padding: 30px; text-align: center; }
            .banner h1 { color: #d4a373; margin: 0; font-size: 28px; letter-spacing: 2px; text-transform: uppercase; font-weight: 300; }
            .banner p { color: #fff; margin: 10px 0 0; font-size: 14px; opacity: 0.8; }
            .body { padding: 40px; color: #444; }
            .body h2 { color: #1a1a1a; font-size: 20px; margin-top: 0; }
            .summary { background-color: #fdfaf8; border-left: 4px solid #d4a373; padding: 20px; margin: 25px 0; border-radius: 4px; }
            .summary h3 { font-size: 12px; color: #999; text-transform: uppercase; margin: 0 0 10px; letter-spacing: 1px; }
            .summary p { margin: 0; font-style: italic; line-height: 1.6; }
            .cta { text-align: center; margin-top: 30px; }
            .btn { display: inline-block; background-color: #d4a373; color: #fff !important; padding: 12px 30px; border-radius: 30px; text-decoration: none; font-weight: 600; font-size: 14px; }
            .footer { background: #fafafa; padding: 20px; text-align: center; font-size: 12px; color: #aaa; border-top: 1px solid #f0f0f0; }
        </style>
    </head>
    <body>
        <div class='wrapper'>
            <div class='card'>
                <div class='banner'>
                    <h1>Brew Haven</h1>
                    <p>THE CAFE EXPERIENCE</p>
                </div>
                <div class='body'>
                    <h2>Hello $name,</h2>
                    <p>Thank you for reaching out to us! We've received your inquiry regarding <strong>$subject</strong> and our team is already on it.</p>
                    
                    <div class='summary'>
                        <h3>Your message summary:</h3>
                        <p>\"" . nl2br($message) . "\"</p>
                    </div>

                    <p>We usually respond within 24 hours. In the meantime, feel free to check out our seasonal menu updates on our website.</p>
                    
                    <div class='cta'>
                        <a href='http://localhost/BrewHaven/menu/menu.html' class='btn'>Explore Our Menu</a>
                    </div>
                </div>
                <div class='footer'>
                    &copy; 2026 Brew Haven. 123 Beverage Lane, Brew Valley, CA 90210.
                </div>
            </div>
        </div>
    </body>
    </html>
    ";
}

// Function to generate the Welcome Newsletter HTML
function get_newsletter_welcome_content($email) {
    return "
    <html>
    <head>
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fdfaf8; margin: 0; padding: 0; }
            .wrapper { padding: 40px 20px; }
            .card { max-width: 550px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 15px 35px rgba(212, 163, 115, 0.15); }
            .banner { background-color: #1a1a1a; padding: 30px; text-align: center; }
            .banner h1 { color: #d4a373; margin: 0; font-size: 28px; letter-spacing: 2px; text-transform: uppercase; font-weight: 300; }
            .banner p { color: #fff; margin: 10px 0 0; font-size: 14px; opacity: 0.8; }
            .body { padding: 40px; color: #444; }
            .body h2 { color: #1a1a1a; font-size: 20px; margin-top: 0; }
            .perk-list { margin: 25px 0; padding: 0; list-style: none; }
            .perk-item { padding: 12px 15px; background: #fdfaf8; border-radius: 8px; margin-bottom: 10px; display: flex; align-items: center; font-size: 14px; }
            .perk-item span { margin-right: 15px; font-size: 18px; }
            .cta { text-align: center; margin-top: 30px; }
            .btn { display: inline-block; background-color: #d4a373; color: #fff !important; padding: 12px 30px; border-radius: 30px; text-decoration: none; font-weight: 600; font-size: 14px; }
            .footer { background: #fafafa; padding: 25px; text-align: center; font-size: 12px; color: #aaa; border-top: 1px solid #f0f0f0; }
        </style>
    </head>
    <body>
        <div class='wrapper'>
            <div class='card'>
                <div class='banner'>
                    <h1>Brew Haven</h1>
                    <p>WELCOME TO THE INNER CIRCLE</p>
                </div>
                <div class='body'>
                    <h2>Hello there!</h2>
                    <p>Thank you for subscribing to our newsletter. You're now on the exclusive list to receive our latest coffee stories, brewing secrets, and seasonal offers.</p>
                    
                    <p><strong>As an insider, here's what you'll get:</strong></p>
                    <div class='perk-list'>
                        <div class='perk-item'> First access to limited-edition roasts</div>
                        <div class='perk-item'> Invitations to private tasting events</div>
                        <div class='perk-item'> Monthly brewing tips from our master baristas</div>
                    </div>

                    <p>Stay tuned! Your first brew update is already being roasted and will arrive in your inbox soon.</p>
                    
                    <div class='cta'>
                        <a href='http://localhost/BrewHaven/home/home.html' class='btn'>Explore Brew Haven</a>
                    </div>
                </div>
                <div class='footer'>
                    You received this because you signed up at brewhaven.com.<br>
                    &copy; 2026 Brew Haven. 123 Beverage Lane, Brew Valley, CA 90210.
                </div>
            </div>
        </div>
    </body>
    </html>
    ";
}
