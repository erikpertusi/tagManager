<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tags</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-group list-group-horizontal-sm">
                                <li v-for="item in tags" :key="item.id" class="list-group-item" style="cursor:pointer;" v-on:click="" title="Adicionar Tag">
                                    <i class="fa fa-tag text-success" aria-hidden="true"></i> <b>{{ item.name }}</b>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tags: [],
                nameTag: null,
                idTag: 0,
                page: 1
            }
        },
        methods: {
            loadTag(item) {
                this.nameTag = item.name;
                this.idTag = item.id;
            },
            storeTag() {
                let self = this;
                axios.post('/tags', {name: this.nameTag, id: this.idTag})
                    .then(function (response) {
                        self.getTags();
                    });
            },
            getTags(next, previous) {
                if (next) {
                    this.page++;
                }
                if (previous) {
                    this.page--;
                }
                axios.get('./api/tags?p=' + this.page).then(response => this.tags = response.data);
            }
        },
        mounted() {
            this.getTags();
        },
    }
</script>
