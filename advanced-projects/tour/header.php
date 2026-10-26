<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'World Vacations'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background: linear-gradient(135deg, #0072ff, #00c6ff);
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        header h1, header h2 { font-weight: 700; font-size: 1.5rem; }
        header a {
            color: white;
            text-decoration: none;
            font-weight: 600;
            background: rgba(255,255,255,0.2);
            padding: 8px 16px;
            border-radius: 20px;
            transition: background 0.3s;
        }
        header a:hover { background: rgba(255,255,255,0.4); }
        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }
        footer {
            background-color: #1e293b;
            color: #cbd5e1;
            text-align: center;
            padding: 25px 20px;
            font-size: 0.9rem;
            margin-top: auto;
        }
        footer p { margin: 5px 0; }
    </style>
</head>
<body>
    <header>
        <h2>🌴 World Vacations</h2>
        <?php if (basename($_SERVER['PHP_SELF']) !== 'index.php'): ?>
            <a href="index.php">&larr; Back to Search</a>
        <?php endif; ?>
    </header>