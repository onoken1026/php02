<?php
require 'db_connect.php';  // データベース接続ファイルを呼び出し

// CSV出力の処理
if (isset($_GET['download'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data.csv"');

    $file = fopen('php://output', 'w');

    // ヘッダー行
    fputcsv($file, ['回答日時', '会社名', 'メールアドレス', '業種', '従業員数', '平均商品数', '検品方法', '課題', '興味', '期待するメリット', 'チェック項目', '予算', '導入意向', '不安点', '現在のソフトウェア', 'サポートの必要性', '重要視するポイント']);

    // データベースからデータを取得してCSVとして出力
    $stmt = $pdo->query('SELECT * FROM gs_bm_table');
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($file, $row);
    }
    fclose($file);
    exit;
}

// データ取得とフィルタリング用の処理
$sql = 'SELECT * FROM gs_bm_table';
$stmt = $pdo->query($sql);
$responses = $stmt->fetchAll(PDO::FETCH_ASSOC);

// フィルタリング用の選択肢を準備
$filterOptions = [];
foreach ($responses as $response) {
    foreach ($response as $key => $value) {
        if (!isset($filterOptions[$key])) {
            $filterOptions[$key] = [];
        }
        if (!in_array($value, $filterOptions[$key])) {
            $filterOptions[$key][] = $value;
        }
    }
}

// HTMLとCSSの開始部分
echo '<html><head><meta charset="utf-8"><title>データ一覧</title>';
echo '<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 12px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
            white-space: nowrap;
        }
        th {
            background-color: #f8f8f8;
            cursor: pointer;
        }
        .filter-select {
            width: 150px;
            margin-bottom: 20px;
        }
      </style>';
echo '<script>
        function filterTable(column, value) {
            var rows = document.querySelectorAll("table tr");
            rows.forEach(function(row, index) {
                if (index === 0) return;
                var cell = row.getElementsByTagName("td")[column];
                if (cell) {
                    if (value === "" || cell.innerText.indexOf(value) > -1) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            });
        }
      </script>';
echo '</head><body>';

echo '<h1>データ一覧</h1>';
echo '<a href="?download=1">CSVファイルをダウンロード</a>';

echo '<table>';
echo '<tr>';
$headers = ['回答日時', '会社名', 'メールアドレス', '業種', '従業員数', '平均商品数', '検品方法', '課題', '興味', '期待するメリット', 'チェック項目', '予算', '導入意向', '不安点', '現在のソフトウェア', 'サポートの必要性', '重要視するポイント'];

foreach ($headers as $index => $header) {
    echo '<th>' . $header;
    echo '<br><select class="filter-select" onchange="filterTable(' . $index . ', this.value)">';
    echo '<option value="">すべて</option>';
    if (isset($filterOptions[$header])) {
        foreach ($filterOptions[$header] as $option) {
            echo '<option value="' . htmlspecialchars($option) . '">' . htmlspecialchars($option) . '</option>';
        }
    }
    echo '</select>';
    echo '</th>';
}
echo '</tr>';

// データの表示
foreach ($responses as $response) {
    echo '<tr>';
    foreach ($response as $cell) {
        echo '<td>' . htmlspecialchars($cell) . '</td>';
    }
    echo '</tr>';
}

echo '</table>';
echo '</body></html>';
?>
