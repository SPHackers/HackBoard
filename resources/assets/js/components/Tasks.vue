<template>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Tasks</div>

            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th width="5%">ID</th>
                        <th width="80%">Title</th>
                        <th width="15%"></th>
                    </tr>
                    <tr v-for="task in tasks">
                        <td>{{task.id}}</td>
                        <td>{{task.title}}</td>
                        <td>
                            <button v-on:click="deleteTask(task)" type="button" class="btn btn-default">Delete</button>
                        </td>
                    </tr>
                </table>
                <form v-on:submit="onSubmitForm" class="form-inline">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Task" v-model="newTask.title">
                    </div>
                    <div class="form-group">
                        <label for="desc">Desc</label>
                        <input type="text" class="form-control" id="desc" placeholder="Description" v-model="newTask.desc">
                    </div>
                    <button type="submit" class="btn btn-default">Create Task</button>
                </form>
                <p class="bg-success" v-show="newTaskCreated">Task created successfully.</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        ready() {
            this.fetchTasks();
            console.log('Component ready.')
        },

        data: function () {
            return {
                tasks: [],
                newTask: {
                    title: '',
                    desc: '',
                }
            }
        },

        methods: {
            fetchTasks() {
                this.$http.get('/api/v1/task').then((response) => {
                    this.$set('tasks', response.data);
                });
            },
            deleteTask(task) {
                this.$http.delete('/api/v1/task/' + task.id).then(() => {
                    this.tasks.$remove(task);
                });
            },
            onSubmitForm(e) {
                e.preventDefault();
                var newTask = this.newTask;
                this.newTask = {
                    title: '',
                    desc: '',
                };
                var self = this;
                this.$http.post('/api/v1/task', newTask).then((response) => {
                    self.newTaskCreated = true;
                    this.tasks.push(response.data);
                });
            },
        },

    }
</script>
