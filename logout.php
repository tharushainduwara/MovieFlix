<?php
session_start();

// Check if user is confirming logout
if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
    // Unset all session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
    
    // Redirect to login page with success message
    header('Location: login.php?logout=success');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - MovieFlix</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .logout-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(229, 9, 20, 0.1), rgba(20, 20, 20, 0.9)), 
                        url('https://source.unsplash.com/random/1920x1080/?cinema,theater') no-repeat center center/cover;
            margin-top: 0;
        }

        .logout-card {
            background: rgba(20, 20, 20, 0.95);
            padding: 50px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(229, 9, 20, 0.3);
            backdrop-filter: blur(10px);
            max-width: 500px;
            width: 90%;
        }

        .logout-icon {
            font-size: 80px;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .logout-title {
            font-size: 32px;
            margin-bottom: 15px;
            color: var(--light);
            font-weight: bold;
        }

        .logout-message {
            font-size: 18px;
            color: var(--gray);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .logout-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-logout {
            background: linear-gradient(135deg, var(--primary), #c40811);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-logout:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(229, 9, 20, 0.4);
        }

        .btn-cancel {
            background: linear-gradient(135deg, #666, #555);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-cancel:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        @media (max-width: 576px) {
            .logout-card {
                padding: 30px 20px;
            }
            
            .logout-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Simple Header for Logout Page -->
    <header>
        <div class="container header-container">
            <div class="logo">MovieFlix</div>
            <div style="margin-left: auto;">
                <a href="index.php" class="btn" style="background: #666;">Cancel</a>
            </div>
        </div>
    </header>

    <div class="logout-container">
        <div class="logout-card">
            <div class="logout-icon">
                <i class="fas fa-door-open"></i>
            </div>
            
            <h2 class="logout-title">Ready to Leave?</h2>
            
            <p class="logout-message">
                Are you sure you want to sign out?<br>
                You'll need to log in again to access your account.
            </p>

            <div class="logout-buttons">
                <a href="logout.php?confirm=true" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Yes, Logout
                </a>
                <a href="index.php" class="btn-cancel">
                    <i class="fas fa-times"></i>
                    Cancel
                </a>
            </div>
        </div>
    </div>
</body>
</html>