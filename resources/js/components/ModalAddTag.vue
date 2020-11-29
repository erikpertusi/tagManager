<template>
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tags</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-group list-group-horizontal-sm">
                                <li v-for="item in tags" :key="item.id" class="list-group-item" style="cursor:pointer;" v-on:click="storeRepository(item.id)" title="Adicionar Tag">
                                    <i class="fa fa-tag text-success" aria-hidden="true"></i> <b>{{ item.name }}</b>
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
          item: {}
        },
        data() {
            return {
                tags: [],
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
            getTags(next, previous) {
                if (next) {
                    this.page++;
                }
                if (previous) {
                    this.page--;
                }
                let self = this;
                axios.get('./api/tags?p=' + this.page + '&perPage=' + this.perPage).then((response) => {
                    self.tags = response.data.items;
                    self.total = response.data.total_count;
                });
            }
        },
        mounted() {
            this.getTags();
        },
    }
</script>
