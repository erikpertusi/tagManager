<template>
    <div class="row">
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="Busca..."  v-model="termSearch"/>
        </div>
        <div class="col-sm-3">
            <input type="text" class="form-control" placeholder="Linguagem..."  v-model="language"/>
        </div>
        <div class="col-sm-1">
            <button type="button" class="btn btn-primary" v-on:click="search"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        <div class="col-sm-6 mt-3 mb-3">
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ordenar por
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" v-on:click="setSortOrder('stars', 'desc')">Maior Estrela</a>
                    <a class="dropdown-item" href="#" v-on:click="setSortOrder('stars', 'asc')">Menor Estrela</a>
                    <a class="dropdown-item" href="#" v-on:click="setSortOrder('updated', 'desc')">Atualizado Recentemente</a>
                    <a class="dropdown-item" href="#" v-on:click="setSortOrder('updated', 'asc')">Ultima Atualização Feita</a>
                </div>
            </div>
        </div>
        <br/>
        <div class="col-sm-12">
            <ul class="list-group">
                <li v-for="item in list" :key="item.id" class="list-group-item">
                    <div style="float: left">
                        <b>{{ item.name }}</b>
                    </div>
                    <div style="float: right">
                        <a href="#" data-toggle="modal" data-target="#modal" v-on:click="setItemOpen(item)"><i class="fa fa-tag text-success" aria-hidden="true" title="Associar Tag"></i></a>
                    </div>
                    <br/>
                    <div style="float: left">
                        <small>Author: {{item.owner.login}}</small>
                    </div>
                    <div style="float: right">
                        <i class="fa fa-star text-warning" aria-hidden="true"></i> <small class="text-right">{{item.watchers}}</small>
                    </div>
                    <br/>
                    <small><i class="fa fa-code" aria-hidden="true"></i> {{item.language}}</small>
                </li>
            </ul>
        </div>
        <div class="col-sm-6">
            <a href="#" v-if="page > 1" v-on:click="previousPage">Anterior</a>
        </div>
        <div class="col-sm-6 text-right">
            <a href="#" v-if="next" v-on:click="nextPage">Próxima</a>
        </div>
        <modal-add-tag :item="itemOpen"></modal-add-tag>
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
                termSearch: null,
                language: null,
                sort: '',
                order: 'DESC',
                list: [],
                perPage: 15,
                page: 1,
                url: '',
                total: 0,
                next: false,
                itemOpen: {},
            }
        },
        methods: {
            getSearch() {
                let self = this;
                axios.get(this.url)
                    .then( (response) => {
                        self.list = response.data.items;
                        self.total = response.data.total_count;
                });
            },
            nextPage() {
                this.page++;
            },
            previousPage() {
                this.page--;
            },
            setSortOrder(sort, order) {
                this.sort = sort;
                this.order = order;
            },
            search() {
                this.sort = '';
                this.order = '';
                this.page = 1;
                let url = this.urlGitHub + '?q=' + this.termSearch + '+language:'+this.language+'&sort=' + this.sort + '&order=' + this.order;
                url += '&page='+ this.page +'&per_page=' + this.perPage;
                this.url = url;
            },
            setItemOpen(item) {
                this.itemOpen = item;
            }

        },
        watch: {
            sort: function (val) {
                if (val !== '') {
                    let url = this.urlGitHub + '?q=' + this.termSearch + '+language:' + this.language + '&sort=' + val + '&order=' + this.order;
                    url += '&page=' + this.page + '&per_page=' + this.perPage;
                    this.url = url;
                }
            },
            order: function (val) {
                if (val !== '') {
                    let url = this.urlGitHub + '?q=' + this.termSearch + '+language:' + this.language + '&sort=' + this.sort + '&order=' + val;
                    url += '&page=' + this.page + '&per_page=' + this.perPage;
                    this.url = url;
                }
            },
            page: function (val) {
                let url = this.urlGitHub + '?q=' + this.termSearch + '+language:'+this.language+'&sort=' + this.sort + '&order=' + this.order;
                url += '&page='+ val +'&per_page=' + this.perPage;
                this.url = url;
            },
            url: function (val) {
                this.getSearch();
            },
            total: function (val) {
                let checkNext = Math.ceil(val / this.perPage);
                if (checkNext === this.page) {
                    this.next = false;
                } else {
                    this.next = true;
                }

            }

        },
        mounted() {

        },
    }
</script>
