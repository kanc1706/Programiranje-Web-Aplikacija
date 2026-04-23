<?php

function isShopOpen($datetime) {
    $day = $datetime->format('N'); 
    $hour = $datetime->format('H');
    $minute = $datetime->format('i');
    $time = $hour . ':' . $minute;
    
}
    $month = $datetime->format('m');
    $day_of_month = $datetime->format('d');
    
    
    $holidays = [
        '01-01', 
        '01-06', 
        '03-08', 
        '05-01', 
        '06-22', 
        '06-25', 
        '08-05', 
        '08-15', 
        '10-08', 
        '11-01', 
        '12-25', 
        '12-26  
    ];
    
    $current_date = $month . '-' . $day_of_month;
    if (in_array($current_date, $holidays)) {
        return false; 
    }
    
    
    if ($day >= 1 && $day <= 5) { 
        if ($hour >= 8 && $hour < 20) {
            return true; 
        }
    } elseif ($day == 6) { 
        if ($hour >= 9 && $hour < 14) {
            return true; 
        }
    } elseif ($day == 7) { 
        return false; 
    }
    
    return false;
}


$now = new DateTime();
$day_name = $now->format('l'); 
$day_croatian = [
    'Monday' => 'Ponedjeljak',
    'Tuesday' => 'Utorak',
    'Wednesday' => 'Srijeda',
    'Thursday' => 'Četvrtak',
    'Friday' => 'Petak',
    'Saturday' => 'Subota',
    'Sunday' => 'Nedjelja'
];

$current_day = $day_croatian[$day_name];
$current_time = $now->format('H:i');
$shop_open = isShopOpen($now);


function getNextOpeningTime($datetime) {
    $day = $datetime->format('N');
    $hour = $datetime->format('H');
    
    $next_opening = clone $datetime;
    
    if ($day >= 1 && $day <= 5) { 
        if ($hour < 8) {
            
            $next_opening->setTime(8, 0);
        } else {
            
            $next_opening->modify('+1 day')->setTime(8, 0);
        }
    } elseif ($day == 6) { 
        if ($hour < 9) {
            
            $next_opening->setTime(9, 0);
        } else {
            
            $next_opening->modify('next monday')->setTime(8, 0);
        }
    } else { 
        $next_opening->modify('next monday')->setTime(8, 0);
    }
    
    return $next_opening;
}

$next_opening = getNextOpeningTime($now);
$next_opening_day = $day_croatian[$next_opening->format('l')];
$next_opening_time = $next_opening->format('H:i');
?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radno vrijeme dućana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            background-color: white;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .status-card {
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .open {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        
        .closed {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        
        .status-icon {
            font-size: 48px;
            margin-bottom: 10px;
        }
        
        .status-text {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .info-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .info-label {
            font-weight: bold;
            color: #495057;
        }
        
        .info-value {
            color: #6c757d;
        }
        
        .hours-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .hours-table th,
        .hours-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        
        .hours-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        .next-opening {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Radno vrijeme dućana</h1>
        
        <div class="status-card <?php echo $shop_open ? 'open' : 'closed'; ?>">
            <div class="status-icon"><?php echo $shop_open ? '🟢' : '🔴'; ?></div>
            <div class="status-text">
                Dućan je <?php echo $shop_open ? 'OTVOREN' : 'ZATVOREN'; ?>
            </div>
            <div>Trenutno vrijeme: <?php echo $current_day . ', ' . $current_time; ?></div>
        </div>
        
        <div class="info-section">
            <h3>Informacije</h3>
            <div class="info-item">
                <span class="info-label">Trenutni dan:</span>
                <span class="info-value"><?php echo $current_day; ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Trenutno vrijeme:</span>
                <span class="info-value"><?php echo $current_time; ?></span>
            </div>
            <div class="info-item">
                <span class="info-label">Status:</span>
                <span class="info-value"><?php echo $shop_open ? 'Otvoreno' : 'Zatvoreno'; ?></span>
            </div>
        </div>
        
        <div class="info-section">
            <h3>Radno vrijeme</h3>
            <table class="hours-table">
                <tr>
                    <th>Dan</th>
                    <th>Radno vrijeme</th>
                </tr>
                <tr>
                    <td>Ponedjeljak - Petak</td>
                    <td>08:00 - 20:00</td>
                </tr>
                <tr>
                    <td>Subota</td>
                    <td>09:00 - 14:00</td>
                </tr>
                <tr>
                    <td>Nedjelja</td>
                    <td>Zatvoreno</td>
                </tr>
                <tr>
                    <td>Državni praznici</td>
                    <td>Zatvoreno</td>
                </tr>
            </table>
        </div>
        
        <?php if (!$shop_open): ?>
            <div class="next-opening">
                <strong>Sljedeće otvaranje:</strong><br>
                <?php echo $next_opening_day . ' u ' . $next_opening_time; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
