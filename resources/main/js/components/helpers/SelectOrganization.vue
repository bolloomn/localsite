<template>
	<div>
        <input type="text" class="input" v-model="smodel.organization.title" @click="chooseSubs" readonly="readonly"/>
        <div class="modal modal-choose-sub is-active" v-if="chooseModal">
            <div class="modal-background" v-on:click="chooseModal = false"></div>
            <div class="modal-card modal-card-small">
                <header class="modal-card-head">
                    <p class="title is-5 has-text-weight-bold has-text-black-ter has-text-left">{{ $store.getters.lang.form_text.select_organization }}</p>
                    <div class="field" :class="{'has-addons':search.length > 0}">
                        <div class="control has-icons-right">
                            <input type="text" class="input" :placeholder="$store.getters.lang.form_text.search_value" v-model="search" />
                            <span class="icon is-small is-right">
                                <i class="fa fa-search" :class="{'has-text-grey':search.length > 0}"></i>
                            </span>
                        </div>
                        <div class="control" v-if="search.length > 0">
                            <div class="button is-dark" @click="search = ''">
                                <span class="icon">
                                    <i class="ion-md-close"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </header>
                <section class="modal-card-body">
                    <div class="formni">
                        <div class="columns is-mobile is-multiline">
                            <div class="column is-12-mobile is-12-tablet">
                                <template v-for="sub in filteredItems">
                                    <div class="field">
                                        <input class="is-checkradio" :id="'subItem'+sub.id" type="radio" :value="{id:sub.id, title:sub.title}" v-model="smodel.organization">
                                        <label :for="'subItem'+sub.id">{{sub.title}}</label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <div class="button is-text" v-on:click="chooseModal = false">{{ $store.getters.lang.messages.is_back_button }}</div>
                    <div class="button is-primary add_button"  v-on:click="saveSubs">
                        <span>{{ $store.getters.lang.messages.is_ok_button }}</span>
                    </div>
                </footer>
                <div class="modal-close is-large" aria-label="close" v-on:click="chooseModal = false"></div>
            </div>
        </div>
	</div>
</template>

<script>
    export default {
        props:[
            'subItems',
            'smodel',
        ],
        data(){
            return {
                subs: this.subItems,
                chooseModal: false,
                search:'',
            }
        },
        watch: {
            smodel: {
                handler: function(newValue) {
                },
                deep: true
            },
            subItems: function(newValue){
                this.subs = newValue
            },
            chooseModal: function (val) {
                if(!val){
                    this.search = '';
                }
            },
        },
        created: function () {
            if(!this.chooseModal){
                this.search = '';
            }
        },
        computed: {
            filteredItems() {
                return this.subs.filter(item => {
                    return item.title.toLowerCase().indexOf(this.search.toLowerCase()) > -1
                })
            },
        },
        methods: {
            // Нэмэх, Засах
            saveSubs: function() {
                this.chooseModal = false
            },
            chooseSubs() {
                this.chooseModal = true;
            }
        }
    }
</script>
