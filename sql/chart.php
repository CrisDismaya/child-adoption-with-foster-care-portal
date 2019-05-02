<?php

if (isset($_POST['getChartData'])) {
    require_once '../security/pdo.php';
    
    $year = $_POST['year'];
    $stmt = $db->prepare('SELECT chFname, chCreated FROM children WHERE YEAR(chCreated) = ?');
    $stmt->execute([ $year ]);
    $dates = $stmt->fetchAll();

    $months = [
        [
            'name' => 'jan',
            'month' => date('01')
        ],
        [
            'name' => 'feb',
            'month' => date('02')
        ],
        [
            'name' => 'mar',
            'month' => date('03')
        ],
        [
            'name' => 'apr',
            'month' => date('04')
        ],
        [
            'name' => 'may',
            'month' => date('05')
        ],
        [
            'name' => 'jun',
            'month' => date('06')
        ],
        [
            'name' => 'jul',
            'month' => date('07')
        ],
        [
            'name' => 'aug',
            'month' => date('08')
        ],
        [
            'name' => 'sep',
            'month' => date('09')
        ],
        [
            'name' => 'oct',
            'month' => date('10')
        ],
        [
            'name' => 'nov',
            'month' => date('11')
        ],
        [
            'name' => 'dec',
            'month' => date('12')
        ]
    ];

    $sorted = [];
    foreach ($dates as $date) {
        foreach ($months as $month) {
            if (date('m', strtotime($date['chCreated'])) === $month['month']) {
                $sorted[$month['name']][] = $date['chCreated'];
            }
        }
    }

    $data = [];
    foreach ($sorted as $key => $value) {
        $temp = [
            'y' => count($value),
            'label' => $key
        ];

        $data[] = $temp;
    }

    echo json_encode($data);
}

if (isset($_POST['getChartDataParent'])) {
    require_once '../security/pdo.php';
    
    $year = $_POST['year'];

    $stmt = $db->prepare('SELECT fpCreated FROM fosterparent WHERE YEAR(fpCreated) = ?');
    $stmt->execute([ $year ]);
    $dates = $stmt->fetchAll();

    $months = [
        [
            'name' => 'jan',
            'month' => date('01')
        ],
        [
            'name' => 'feb',
            'month' => date('02')
        ],
        [
            'name' => 'mar',
            'month' => date('03')
        ],
        [
            'name' => 'apr',
            'month' => date('04')
        ],
        [
            'name' => 'may',
            'month' => date('05')
        ],
        [
            'name' => 'jun',
            'month' => date('06')
        ],
        [
            'name' => 'jul',
            'month' => date('07')
        ],
        [
            'name' => 'aug',
            'month' => date('08')
        ],
        [
            'name' => 'sep',
            'month' => date('09')
        ],
        [
            'name' => 'oct',
            'month' => date('10')
        ],
        [
            'name' => 'nov',
            'month' => date('11')
        ],
        [
            'name' => 'dec',
            'month' => date('12')
        ]
    ];

    $sorted = [];
    foreach ($dates as $date) {
        foreach ($months as $month) {
            if (date('m', strtotime($date['fpCreated'])) === $month['month']) {
                $sorted[$month['name']][] = $date['fpCreated'];
            }
        }
    }

    $data = [];
    foreach ($sorted as $key => $value) {
        $temp = [
            'y' => count($value),
            'label' => $key
        ];

        $data[] = $temp;
    }

    echo json_encode($data);
}
