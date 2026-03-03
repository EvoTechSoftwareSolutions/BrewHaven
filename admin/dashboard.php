<?php
// Set the correct timezone so dates are right
date_default_timezone_set('Asia/Colombo');

// This is our Admin Dashboard!
// We use this to see everyone who sent us a message and signed up for coffee tips.

// First we need to connect to our database
// We use the file we already made in the php folder
include('../php/db.php');

// Let's get all the contact messages first
// We want the newest ones at the top, so we ORDER BY id DESC
$contact_query = $pdo->query("SELECT * FROM contact_submissions ORDER BY id DESC");
$contacts = $contact_query->fetchAll(PDO::FETCH_ASSOC);

// Now let's get all the newsletter subcribers
$newsletter_query = $pdo->query("SELECT * FROM newsletter_signups ORDER BY id DESC");
$subscribers = $newsletter_query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brew Haven | Admin Dashboard</title>
    <link rel="icon" href="../_resources/common/logo.png" type="image/png">
    
    <!-- External CSS for Admin -->
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>

    <div class="header">
        <h1>Brew <span>Haven</span> | Admin</h1>
        <div>
            <a href="../home/home.html" style="color: #ccc; text-decoration: none; font-size: 14px;">Go to Website</a>
        </div>
    </div>

    <div class="container">
        
        <div class="welcome-msg">
            <h2>Dashboard</h2>
            <p>Welcome back! Here is what's happening at your cafe.</p>
        </div>

        <!-- Section 1: Contact Form Submissions -->
        <div class="card">
            <h3>Contact Submissions</h3>
            
            <?php if (count($contacts) > 0): ?>
                <div class="table-responsive">
                    <table class="contact-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>From</th>
                                <th>Subject</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contacts as $contact): ?>
                                <tr>
                                    <td><span class="badge badge-date"><?php echo date('M d, Y | h:i A', strtotime($contact['created_at'])); ?></span></td>
                                    <td>
                                        <strong><?php echo $contact['name']; ?></strong><br>
                                        <span style="font-size: 12px; color: #999;"><?php echo $contact['email']; ?></span>
                                    </td>
                                    <td><strong><?php echo $contact['subject']; ?></strong></td>
                                    <td class="message-text"><?php echo nl2br($contact['message']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="no-data">No messages yet.</div>
            <?php endif; ?>
        </div>

        <!-- Section 2: Newsletter signups -->
        <div class="card" style="max-width: 600px;">
            <h3>Newsletter Subscribers</h3>
            
            <?php if (count($subscribers) > 0): ?>
                <div class="table-responsive">
                    <table class="newsletter-table">
                        <thead>
                            <tr>
                                <th>Email Address</th>
                                <th>Date Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subscribers as $sub): ?>
                                <tr>
                                    <td><strong><?php echo $sub['email']; ?></strong></td>
                                    <td><span class="badge badge-email"><?php echo date('M d, Y | h:i A', strtotime($sub['subscribed_at'])); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="no-data">No subscribers yet.</div>
            <?php endif; ?>
        </div>

    </div>

</body>
</html>
