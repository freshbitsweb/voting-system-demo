<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <section class="todoapp">
                            <header class="header">
                                <h1>List of Topics</h1>
                            </header>

                            <section class="main">
                                <ul class="todo-list">
                                    <li class="todo"
                                        v-for="(topic, index) in sortedTopics"
                                        v-bind:class="{ voted: isVoted(topic.votes) }"
                                    >
                                        <div class="view">
                                            <label>
                                                {{ topic.title }} -
                                                <span class="text-muted topic-user-name">
                                                    {{ topic.user ? topic.user.name : 'Admin' }}
                                                </span>
                                            </label>

                                            <button
                                                class="btn btn-sm add-vote-button btn-outline-success"
                                                @click="addVoteToTopic(topic.id, index)"
                                                v-if="! isVoted(topic.votes)"
                                            >
                                                Vote
                                            </button>

                                            <span class="badge badge-sm badge-secondary votes-counter">
                                                {{ topic.votes.length }}
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </section>

                            <header class="header">
                                <input
                                    autocomplete="off"
                                    placeholder="Add new topic?"
                                    class="new-todo"
                                    v-model="title"
                                    v-on:keyup.enter="createNewTopic()"
                                    autofocus
                                >
                            </header>
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
                title: '',
            };
        },

        methods: {
            isVoted: function (votes) {
                return votes.filter(function(vote) {
                    return vote.id == loggedInUserId;
                }).length;
            },

            addVoteToTopic: function (topicId, index) {
                var self = this;

                axios.post("/api/vote-to-topic", {
                    topic_id: topicId,
                }).then(function(response) {
                    var topic = response.data.topic;

                    self.topics.splice(index, 1, topic);
                }).catch(function(error) {
                    console.log(error);
                });
            },

            createNewTopic: function () {
                if (! this.title) {
                    return;
                }

                var self = this;

                axios.post("/api/create-new-topic", {
                    title: self.title,
                }).then(function(response) {
                    var topic = response.data.topic;
                    self.topics.push(topic);
                    self.title = '';
                }).catch(function(error) {
                    console.log(error);
                });
            }
        },

        created: function() {
            var self = this;

            if (! isLoggedIn) {
                self.$root.$router.push({ path: 'login' });
                return;
            }

            axios.get("/api/get-topics")
            .then(function(response) {
                self.topics = response.data.topics;
            }).catch(function(error) {
                console.log(error);
            });
        },

        computed: {
            sortedTopics: function() {
                return this.topics.sort(function(firstTopic, secondTopic) {
                    return secondTopic.votes.length - firstTopic.votes.length;
                });
            }
        }
    };
</script>

<style>
    .todoapp {
        background: #fff;
        margin: 130px 0 40px 0;
        position: relative;
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2),
                    0 25px 50px 0 rgba(0, 0, 0, 0.1);
    }
    .new-todo {
        position: relative;
        margin-top: 10%;
        width: 100%;
        font-size: 24px;
        font-family: inherit;
        font-weight: inherit;
        line-height: 1.4em;
        border: 1px solid #ededed !important;
        color: inherit;
        padding: 6px;
        border: 1px solid #999;
        box-shadow: inset 0 -1px 5px 0 rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        outline: unset;
    }

    .todoapp input::-webkit-input-placeholder {
        font-weight: 300;
        color: #e6e6e6;
    }

    .todoapp input::-moz-placeholder {
        font-weight: 300;
        color: #e6e6e6;
    }

    .todoapp input::input-placeholder {
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

    .todo-list li label {
        word-break: break-all;
        padding: 15px 60px 15px 15px;
        margin-left: 45px;
        margin-bottom: 0;
        display: block;
        line-height: 1.2;
        transition: color 0.4s;
    }

    .todo-list li .votes-counter {
        position: absolute;
        top: 0;
        right: 15px;
        bottom: 0;
        margin: auto 0;
        margin-bottom: 14px;
        height: 28px;
        font-size: 20px;
    }
    .todo-list li .topic-user-name {
        font-size: 15px;
    }
    .todo-list .voted {
        background-color: #00800029;
    }
    .todo-list li .add-vote-button {
        display: none;
        position: absolute;
        top: 0;
        right: 50px;
        bottom: 0;
        margin: auto 0;
        margin-bottom: 13px;
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
</style>
