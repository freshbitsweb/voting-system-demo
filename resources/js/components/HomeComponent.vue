<style>
    .todoapp {
        background: #fff;
        margin: 130px 0 40px 0;
        position: relative;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2),
                    0 25px 50px 0 rgba(0, 0, 0, 0.1);
    }

    .todoapp input::-webkit-input-placeholder {
        font-style: italic;
        font-weight: 300;
        color: #e6e6e6;
    }

    .todoapp input::-moz-placeholder {
        font-style: italic;
        font-weight: 300;
        color: #e6e6e6;
    }

    .todoapp input::input-placeholder {
        font-style: italic;
        font-weight: 300;
        color: #e6e6e6;
    }

    .todoapp h1 {
        position: absolute;
        top: -115px;
        width: 100%;
        font-size: 70px;
        font-weight: 100;
        text-align: center;
        color: #49505780;
        -webkit-text-rendering: optimizeLegibility;
        -moz-text-rendering: optimizeLegibility;
        text-rendering: optimizeLegibility;
    }

    .new-todo,
    .edit {
        position: relative;
        margin: 0;
        width: 100%;
        font-size: 24px;
        font-family: inherit;
        font-weight: inherit;
        line-height: 1.4em;
        border: 0;
        color: inherit;
        padding: 6px;
        border: 1px solid #999;
        box-shadow: inset 0 -1px 5px 0 rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .new-todo {
        padding: 16px 16px 16px 60px;
        border: none;
        background: rgba(0, 0, 0, 0.003);
        box-shadow: inset 0 -2px 1px rgba(0,0,0,0.03);
    }

    .main {
        position: relative;
        z-index: 2;
        border-top: 1px solid #e6e6e6;
    }

    label[for='toggle-all'] {
        display: none;
    }

    .toggle-all {
        position: absolute;
        top: -55px;
        left: -12px;
        width: 60px;
        height: 34px;
        text-align: center;
        border: none; /* Mobile Safari */
    }

    .toggle-all:before {
        content: '❯';
        font-size: 22px;
        color: #e6e6e6;
        padding: 10px 27px 10px 27px;
    }

    .toggle-all:checked:before {
        color: #737373;
    }

    .todo-list {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .todo-list li {
        position: relative;
        font-size: 24px;
        border-bottom: 1px solid #ededed;
    }

    .todo-list li:last-child {
        border-bottom: none;
    }

    .todo-list li.editing {
        border-bottom: none;
        padding: 0;
    }

    .todo-list li.editing .edit {
        display: block;
        width: 506px;
        padding: 12px 16px;
        margin: 0 0 0 43px;
    }

    .todo-list li.editing .view {
        display: none;
    }

    .todo-list li .toggle {
        text-align: center;
        width: 40px;
        /* auto, since non-WebKit browsers doesn't support input styling */
        height: auto;
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto 0;
        border: none; /* Mobile Safari */
        -webkit-appearance: none;
        appearance: none;
    }

    .todo-list li label {
        word-break: break-all;
        padding: 15px 60px 15px 15px;
        margin-left: 45px;
        margin-bottom: 0;
        display: block;
        line-height: 1.2;
        transition: color 0.4s;
    }

    .todo-list li.completed label {
        color: #d9d9d9;
        text-decoration: line-through;
    }

    .todo-list li .add-vote-button {
        display: none;
        position: absolute;
        top: 0;
        right: 15px;
        bottom: 0;
        margin: auto 0;
        margin-bottom: 12px;
        border-radius: 80px;
        height: 32px;
    }
    .todo-list li .destroy {
        display: none;
        position: absolute;
        top: 0;
        right: 10px;
        bottom: 0;
        width: 40px;
        height: 40px;
        margin: auto 0;
        font-size: 30px;
        color: #e26767;
        margin-bottom: 12px;
        transition: color 0.2s ease-out;
        border: none;
        background: transparent;
    }

    .todo-list li .destroy:hover {
        color: #af5b5e;
    }

    .todo-list li .destroy:after {
        content: '×';
    }

    .todo-list li:hover .destroy {
        display: block;
    }
    .todo-list li:hover .add-vote-button {
        display: block;
    }

    .todo-list li .edit {
        display: none;
    }

    .todo-list li.editing:last-child {
        margin-bottom: -1px;
    }
</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <section class="todoapp">
                            <header class="header">
                                <h1>List Of Topics</h1>

                                <input autocomplete="off" placeholder="Add new topic?" class="new-todo" autofocus>
                            </header>
                            <section class="main">
                                <ul class="todo-list">
                                    <li class="todo" v-for="topic in topics">
                                        <div class="view">
                                            <label>{{ topic.title }}</label>

                                            <button
                                                class="btn btn-sm add-vote-button btn-outline-success"
                                                @click="addVoteToTopic(topic.id)"
                                                v-if="topic.isVoted == false"
                                            >
                                                Add Vote
                                            </button>

                                            <span
                                                class="btn btn-sm add-vote-button btn-danger"
                                                v-if="topic.isVoted != false"
                                            >
                                                Voted
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </section>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                topics: [],
            };
        },

        methods: {
            addVoteToTopic: function (topicId) {
                var self = this;

                axios.post("/api/vote-to-topic", {
                    topic_id: topicId,
                })
                .then(function(response) {
                    self.topics = response.data.topics;
                }).catch(function(error) {
                    console.log(error);
                });
            }
        },
        created: function() {
            var self = this;
            axios.get("/api/get-topics")
            .then(function(response) {
                self.topics = response.data.topics;
            }).catch(function(error) {
                console.log(error);
            });
        }
    };
</script>
