<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: Arial, Helvetica, sans-serif;
            }

            body {
                background-image: url(background.jpg);
                background-position: center;
                background-size: cover;
                background-attachment: fixed;
            }

            .detail_cfs {
                height: 100%;
                width: 100%;
                position: absolute;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
            }

            .post_detail {
                width: 450px;
                height: 500px;
                margin: auto;
                background: #fff;
                padding: 30px;
            }

            .close_btn {
                position: relative;
                width: 24px;
                height: 24px;
                left: 420px;
                top: 0px;
                background-color: red;
            }

            .post_detail h1 {
                margin-top: 20px;
                font-size: 30px;
            }

            .post_detail h3 {
                font-size: 20px;
                font-style: normal;
                font-weight: 400;
                line-height: 23px;
                letter-spacing: 0em;
                margin-top: 40px;
                margin-bottom: 20px;
            }

            .post_detail-time {
                font-size: 15 px;
            }

            .post_detail-status {
                font-size: 20px;
                margin-top: 40px;
                display: flex;
                /* justify-content: space-evenly; */
            }

            .status {
                margin-right: 50px;
                font-family: Roboto;
                font-size: 20px;
                font-style: normal;
                font-weight: 400;
                line-height: 23px;
                letter-spacing: 0em;
            }

            .post_detail-tag {
                display: flex;
                flex-wrap: wrap;
                align-content: space-around;
                gap: 10px 20px;
            }

            .tag {
                border: 1px solid #d1d1d1;
                box-sizing: border-box;
                border-radius: 4px;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <div class="detail_cfs">
            <div class="post_detail">
                <div class="close_btn"></div>
                <h1>Thông tin chi tiết</h1>
                <div class="post_detail-time">đăng bài lúc:</div>
                <div class="post_detail-status">
                    <div class="status view">
                        Lượt xem
                        <div class="view-count">1</div>
                    </div>
                    <div class="status like">
                        Lượt thích
                        <div class="view-count">123456</div>
                    </div>
                    <div class="status comment">
                        Bình luận
                        <div class="view-count">123456</div>
                    </div>
                </div>
                <h3>Chủ đề</h3>
                <div class="post_detail-tag">
                    <div class="tag">Thiết kế</div>
                    <div class="tag">Lịch sử</div>
                    <div class="tag">Khoa học viễn tưởng</div>
                    <div class="tag">Thiết kế</div>
                    <div class="tag">Lịch sử</div>
                    <div class="tag">Khoa học viễn tưởng</div>
                </div>
            </div>
        </div>
    </body>
</html>
