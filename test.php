<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Circular Progress Bars</title>
    <style>
    .progress {
        width: 200px;
        height: 200px;
        background-color: #f3f3f3;
        border-radius: 50%;
        position: relative;
        display: inline-block;
        margin-right: 20px;
    }

    .progress::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: conic-gradient(#3498db var(--percentage), transparent var(--percentage));
        border-radius: 50%;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
        transform: rotate(calc(90deg + (360deg * var(--percentage))));
    }

    .progress-text {
        font-size: 24px;
        font-family: Arial, sans-serif;
        color: #333;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        height: 150px;
        width: 150px;
        background-color: white;
        border-radius: 50%;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
</head>

<body>
    <?php
$progressBars = [
    ['percentage' => 20, 'label' => '20%'],
    ['percentage' => 80, 'label' => '80%'],
    ['percentage' => 60, 'label' => '60%'],
    // Add more progress bars as needed
];

foreach ($progressBars as $progress) {
    echo '<div class="progress" style="--percentage: ' . $progress['percentage'] . '%;">
            <span class="progress-text">' . $progress['label'] . '</span>
          </div>';
}
?>
</body>

</html>