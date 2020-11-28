<template>
    <div class="row">
        <div class="col-sm-12">
            <input type="text" class="form-control" placeholder="Busca..."  v-model="termSerach" v-on:change="getSearch"/>
        </div>
        <div class="col-sm-6" v-if="termSerach">
            <b>Ordenar por: </b> <a href="#" title="Estrelas" v-on:click="getSearch('stars', '')">Estrelas</a> | <a href="#" title="Data" v-on:click="getSearch('updated', '')">Data</a>
        </div>
        <div class="col-sm-6" v-if="termSerach">
            <a href="#" title="Estrelas" v-on:click="getSearch('', 'ASC')">ASC</a> | <a href="#" title="Data" v-on:click="getSearch('', 'DESC')">DESC</a>
        </div>
        <div class="col-sm-6">
            <ul id="example-1" class="list-group">
                <li v-for="item in list" :key="item.id" class="list-group-item">
                    <a href="#">{{ item.name }}</a>
                </li>
            </ul>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    Tag
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                urlGitHub: 'https://api.github.com/search/repositories',
                tags: [],
                nameTag: null,
                idTag: 0,
                page: 1,
                termSerach: null,
                sort: '',
                order: 'DESC',
                list: [],
            }
        },
        methods: {
            getSearch(sort, order) {
                this.sort = sort;
                this.order = order;
                let self = this;
                let url = this.urlGitHub + '?q=' + this.termSerach + '&sort=' + this.sort + '&order=' + this.order + '&page=2&per_page=100';
                axios.get(url)
                    .then( (response) => {
                        self.list = response.data.items;

                });
            }
        },
        mounted() {

        },
    }
</script>
