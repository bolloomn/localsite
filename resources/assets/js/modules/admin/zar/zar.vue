<template>
    <div>
        <!-- Data table -->
        <div class="boxed">
            <div class="boxed-title">
            	<div class="boxed-item-center title">Зар</div>
            </div>
			<v-server-table ref="tableni" :url="url"  v-if="fetched" :columns="columns" :options="options">
                <div slot="action" slot-scope="props" class="data-action">
                    <router-link :to="'zar/'+props.row.id+'/update'" ><i class="fas fa-pencil-alt"></i></router-link>
                    <div @click="deleting(props.row)">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>
            </v-server-table>

            <div v-else class="main-bodoh is-loading"></div>
            <div class="boxed-item-center absolute">
                 <router-link :to="{ name: 'create_zar'}" class="add_button">+</router-link>
            </div>

            <router-view></router-view>
        </div>

        <!-- Delete modal -->
        <div class="modal is-active" v-if="deletemodal">
            <div class="modal-background" v-on:click="deletemodal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="modal-card-title">{{ $store.getters.lang.messages.delete_data }}</p>
                </header>
                <section class="modal-card-body">
                    <p class="has-text-centered">{{ $store.getters.lang.messages.sure_delete }}</p>
                    <p class="has-text-centered is-size-4"><strong class="has-text-black">{{deleteid.f_name}}</strong></p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-text" v-on:click="deletemodal = false">{{ $store.getters.lang.messages.is_back_button }}</button>
                    <button class="button is-danger add_button" v-on:click="ustga(deleteid)" :class="{'is-loading':is_loading}" :disabled="is_loading">
                        <span>{{ $store.getters.lang.messages.is_delete_button }}</span>
                    </button>
                </footer>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                siteUrl: window.surl,
                url: '/zar',
                deletemodal:false,
                deleteid: false,
                fetched:false,
                is_loading:false,
                user:false,
                columns: ['id', 'title', 'is_pin', 'site_id',   'cat_id',    'phone',   'created_at', 'action',],
                options: {

                    perPage: 25,
                    perPageValues: [25,50,100],
                    pagetitle: "Файлын сан",
                    headings: {
                        id: '№',
                        title: "Гарчиг",
                        cat_id: "Ангилал",
                        price: "Үнэ",
                        phone: "Утас",
                        email: "Имэйл",
                        site_id: "сум",
                        is_pin: "онцлох",
                        created_at: "огноо",
                        action: " ",
                    },
                    filterByColumn: true,
                    sortable: [ 'title', 'is_pin', 'content', 'site_id',   'cat_id',  'phone',  ],
                    filterable: ['title', 'is_pin', 'content', 'site_id',  'cat_id', 'phone', ],
                    columnsDisplay:{
                        content: 'desktop',
                        phone: 'desktop',
                        email: 'desktop',
                        price: 'desktop',
                        created_at: 'desktop',
                    },
                    sortIcon: {
                        base:'fas', 
                        up:'fa-sort-up', 
                        down:'fa-sort-down', 
                        is:'fa-sort' 
                    },
                    listColumns: {
                        is_pin: [
                            {
                                id: 0,
                                text: 'үгүй'
                            },
                            {
                                id: 1,
                                text: 'тийм'
                            },
                        ],
                        cat_id:[],
                        site_id: [],
                    },
                    texts:{
                        count : this.$store.getters.lang.table.count,
                        first : this.$store.getters.lang.table.first,
                        last : this.$store.getters.lang.table.last,
                        filter : this.$store.getters.lang.table.filter,
                        filterPlaceholder: this.$store.getters.lang.table.search_query,
                        limit : this.$store.getters.lang.table.records,
                        page : this.$store.getters.lang.table.page,
                        noResults: this.$store.getters.lang.table.no_results,
                        filterBy : 'Хайх',
                        loading : this.$store.getters.lang.table.loading,
                        defaultOption : 'Бүгд',
                        columns : this.$store.getters.lang.table.columns,
                    },
                    templates: {
                        id: function (h, row, index) {
                            return index;
                        },
                    },

                    rowClassCallback: function(row){
                        if (row.admin_id === 0) {
                            return "has-text-link";
                        }
                    },
                    requestFunction: function (data) {
                        return axios.get(this.url, {
                            params: data
                        }).catch(function (e) {
                            this.dispatch('error', e);
                        }.bind(this));
                    },
                    responseAdapter({data}) {
                        return {
                            data: data.success.data,
                            count: data.success.total
                        };
                    },
                }
            }
        },
        watch: {
            '$route': function(to, from){
                if (from.meta.is_modal) {
                    this.$refs.tableni.refresh();
                }
            },
        },
        created: function () {
            this.fetchData();
        },
        mounted(){

        },
        methods: {
            fetchData(){
                axios.get('/zar_category_select').then((response) => {
                    this.options.listColumns.cat_id = response.data.success;
                    axios.get('site').then((r) => {
                        this.options.listColumns.site_id=r.data.success;
                        console.log(this.options.listColumns.site_id);
                        this.fetched = true;
                    })
                })

            },
            // Устгах
            ustga(row){
                this.is_loading = true;
                axios.delete('/zar/'+row.id).then((response) => {
                    this.deletemodal = false;
                    this.$refs.tableni.refresh();
                    this.is_loading = false;
                    this.$toasted.global.toast_success({message: this.$store.getters.lang.messages.is_deleted_text}); // delete success toast
                })
            },
            deleting(row){
                this.deleteid = row;
                this.deletemodal = true;
            },

        }
    }
</script>
