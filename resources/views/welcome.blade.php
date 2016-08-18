<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HackBoard</title>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="container">
                    <div class="content">
                        <div class="title">HackBoard</div>
                        <h2>User</h2>
                        <div>
                            <p>To create new user: POST /api/v1/user (name, email, password and password_confirmation) => return api_token</p>
                        </div>
                        <h2>Login</h2>
                        <div>
                            <p>To log in: POST /api/v1/login (email, password and api_token <= received from user create)</p>
                        </div>
                        <h2>Tasks (always provide a api_token)</h2>
                        <div>
                            <p>To fetch tasks list: GET /api/v1/task</p>
                            <p>To fetch a task: GET /api/v1/task/1</p>
                            <p>To delete a task: DELETE /api/v1/task/1</p>
                            <p>To update a task: PUT /api/v1/task/1</p>
                            <p>To create a task: POST /api/v1/task</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
