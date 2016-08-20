<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Tasks</div>

                    <div class="panel-body">
                        <h3>TODO:</h3>
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
</template>

<script>
    export default {
        ready() {
            console.log('Component ready.')
        }
    }
</script>
