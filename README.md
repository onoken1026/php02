# ①課題番号-プロダクト名

　『業界の変革を支えるAIソリューションに関するアンケート』(データベース活用版)

## ②課題内容（どんな作品か）

- アパレル業界における販売事業者の検品効率化ソリューションのニーズ調査用アンケートサイト
- 桜サーバーのデータベースを活用して、SQLでデータの登録・表示をできるようにした
  

## ③DEMO
https://gsacademy-ko.sakura.ne.jp/php02/php01/post.php


## ④作ったアプリケーション用のIDまたはPasswordがある場合

- ID: 〇〇〇〇〇〇〇〇
- PW: 〇〇〇〇〇〇〇〇

## ⑤工夫した点・こだわった点
【db_connect.php】
・データベース接続の設定:データベースに接続するために必要な情報（ホスト名、データベース名、ユーザー名、パスワード）を設定します。これらの情報を変数として定義し、後に使用します。
・PDO（PHP Data Objects）を使用した接続の確立:PDOは、PHPでデータベースにアクセスするための拡張ライブラリで、データベース接続の抽象化を提供します。PDOを使うことで、異なるデータベース間で同じコードを使用して操作することが容易になります。
またnew PDO($dsn, $user, $password)を使用して、データベースへの接続を確立します。
・エラーハンドリングの設定:PDO::setAttribute()メソッドを使用して、エラーモードをPDO::ERRMODE_EXCEPTIONに設定し、エラーが発生した場合に例外をスローするようにします。これにより、エラーの原因を特定しやすくなります。
データベース接続を他のファイルで再利用する:他のPHPファイルでこの接続情報を利用するためにrequire_once 'db_connect.php';を使用します。これにより、接続コードを繰り返し書く必要がなくなり、保守性が向上します。

--以下、他のPHPファイル----
【post.php】
post.phpはデータの入力フォームを提供し、ユーザーが入力したデータをwrite.phpにPOSTするためのものです。
【write.php】
write.phpでデータを受け取り、データベースに挿入する部分も正しいです
【read.php】
read.phpでデータベース接続を呼び出し、データのフィルタリングとCSV出力を行います。フィルタリング機能も含んでおります。


## ⑥難しかった点・次回トライしたいこと(又は機能)
-  データベース上でSQLによる作業の幅を増やせるようにしたい。(削除や更新など)


## ⑦質問・疑問・感想、シェアしたいこと等なんでも
- [感想]データベースを活用することで、実際に事業やアイデアを検証する際に、リアルタイムにデータ分析しながらPDCAを回し検証することに多いに役立つので、より高度なデータベース連携をできるようにしたいと思う。

