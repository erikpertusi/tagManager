<template>
    <div class="modal fade" id="modalRepository" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Repositorios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-group">
                                <li v-for="item in repositories" :key="item.id" class="list-group-item">
                                    <a :href="item.link" target="_blank"><b>{{ item.name }}</b></a>
                                    <br/>
                                    <div style="float: left">
                                        <small>Author: {{item.owner}}</small>
                                    </div>
                                    <div style="float: right">
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i> <small class="text-right">{{item.stars}}</small>
                                    </div>
                                    <br/>
                                    <small><i class="fa fa-code" aria-hidden="true"></i> {{item.language}}</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
          repositories: {}
        },
        data() {
            return {
                list: [],
                page: 1,
                perPage: 50,
                total: 0,
                next: false,
                idRepository: 0,
            }
        },
        methods: {
            storeRepository(idTag) {
                let item = this.$props.item;
                let data = {
                    name: item.name,
                    owner: item.owner.login,
                    link: item.html_url,
                    language: item.language,
                    stars: item.watchers,
                };
                let self = this;
                axios.post('/repositories', data)
                    .then(function (response) {
                        self.idRepository = response.data.id;
                        self.setTagToRepository(idTag)

                    });
            },
            setTagToRepository(idTag) {
                let data = {
                    idTag: idTag,
                    idRepository: this.idRepository
                };
                axios.post('/tagRepository', data)
                    .then(function (response) {
                        $('#modal').modal('toggle');
                    });
            },
        },
        watch: {
            /*item: function (val) {
                this.getRepository();
            },*/
        },
        mounted() {
        },
    }
</script>
