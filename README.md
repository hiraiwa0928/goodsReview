# 実行手順

1. root権限でユーザー名をusername、パスワードをpasswordとするユーザーを作成する。以下のSQL文を実行させる<br>
<code>
    create user 'sample'@'localhost' identified by 'password';
</code>

2. root権限でcreateDatabase.sqlを発行し、goodsReviewというデータベースを作成する。
3. root権限で作成したユーザーにgoodsReviewデータベースのアクセス許可を与える。以下のSQL文を実行させる<br>
<code>
    grant all privileges ON goodsReview.*TO 'sample'@'localhost';
</code>
4. root権限を抜けて、ユーザー名sampleでログインをする。
5. goodsReviewデータベースを選択し、member.sql、goods.sql、goodsReview.sqlの3つのファイルを実行させる。
6. goodsReviewフォルダ内にある「./display/originalImages」、「./display/changeSizeImages」の二つのフォルダに権限を与えるために、カレントディレクトリをdisplayにした状態で以下のコマンドを入力してください。<br>
<code>
    chmod 777 originalImages<br>
    chmod 777 changeSizeImages
</code>
7. DocumentRootにgoodsReviewフォルダを設置してください。
8. http://localhost にアクセスするとTOPページが表示されます。

# 機能概要

GoodsReviewは、ユーザーが登録した商品に対して、他のユーザーが評価を投稿するWebアプリケーションである。アカウントを作成する場合は、新規会員登録画面で、ユーザー名とパスワードを入力してください。初期情報として、ユーザー名がsampleとuserが登録してあります。どちらもパスワードは「password」です。そして、ログインが完了すると商品の登録とレビューの投稿ができるようになります。TOPページからカテゴリーの画像をクリックすると、商品一覧ページへ画面遷移します。画面の右上に商品登録画面へ移動できるリンクがあります。また、商品の画像をクリックすると、レビュー画面に遷移します。ここでは、商品の情報と投稿されたレビューを見ることができます。レビューを投稿するというボタンをクリックすると、自分が投稿した商品や他のユーザーが登録した商品に対してレビューをすることが出来ます。