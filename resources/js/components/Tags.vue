<template>
    <div class="row">
        <div class="col-sm-6">
            <ul id="example-1" class="list-group">
                <li v-for="item in tags" :key="item.id" class="list-group-item">
                    <a href="#" v-on:click="loadTag(item)">{{ item.name }}</a>
                </li>
            </ul>
            <div class="row">
                <div class="col-sm-6">
                    <a href="#" v-if="page > 1" v-on:click="getTags(false, true)">Anterior</a>
                </div>
                <div class="col-sm-6">
                    <a href="#" v-on:click="getTags(true, false)">Próxima</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Tag
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="string" class="form-control" placeholder="Digite nome da tag" v-model="nameTag">
                        <input type="hidden" class="form-control" v-model="idTag">
                    </div>
                    <button type="button" class="btn btn-success" v-on:click="storeTag()">Salvar</button>
                    <button type="button" class="btn btn-danger" v-if="idTag > 0" v-on:click="deleteTag()">Excluir
                    </button>
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
            deleteTag() {
                let self = this;
                axios.delete('/tags/' + this.idTag)
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
